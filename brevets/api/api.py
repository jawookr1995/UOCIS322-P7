import flask
from flask import Flask, request, session
from flask_restful import Resource, Api, reqparse
import os
from flask_wtf.csrf import CSRFProtect
from pymongo import MongoClient
from random import randint
from wtforms import Form, BooleanField, StringField, validators, PasswordField
from passlib.apps import custom_app_context as pwd_context
from itsdangerous import (TimedJSONWebSignatureSerializer \
                                  as Serializer, BadSignature, \
                                  SignatureExpired)
import time
from flask import Flask, request, render_template, redirect, url_for, flash
from flask_login import (LoginManager, current_user, login_required,
                            login_user, logout_user, UserMixin, 
                            confirm_login, fresh_login_required)

# Instantiate the app
app = Flask(__name__)
api = Api(app)

login_manager = LoginManager()
login_manager.init_app(app)
login_manager.login_view = ('/api/login')

app.config['SECRET_KEY'] = "not actually secret"

client = MongoClient(os.environ['DB_PORT_27017_TCP_ADDR'], 27017)
db = client.tododb
users = db.userdb

#form for register and log in.
class RegisterForm(Form):
    username = StringField('Username', validators=[validators.DataRequired(message=u'Enter username')])
    password = PasswordField('Password', validators=[validators.DataRequired(message=u'Enter password')])
    
class LoginForm(Form):
    username = StringField('Username', validators=[validators.DataRequired(message=u'Enter username')])
    password = PasswordField('Password', validators=[validators.DataRequired(message=u'Enter password')])
    remember = BooleanField('Remember Me')

class UserInfo(UserMixin):
    def __init__(self, user_id):
        self.id = str(user_id)

@app.route("/api/register", methods=["GET", "POST"])
def register():

    # get the form for registering as users
    form = RegisterForm(request.form)
    username = form.username.data
    password = form.password.data
    password = hash_password(password)
    
    Id = "" 

    # if user has submitted the info
    if form.validate():
        # get user name from db
        item = db.tododb.find_one({"username":username})
        # give random id for username
        Id = randint(1,50000)

        # if username and password cannot be found, then return 400 error
        if (username == None) or (password == None):
            return 'no username or password given', 400
        if item != None:
            return 'try a different username', 400

        # hash the password
        hashVal = hash_password(password)

        # add new info of user into database
        new = {"_id": Id, 'username': username, 'password': hashVal}
        users.insert_one(new)

        result = {'location': Id, 'username': username, 'password': hashVal}
        
        return flask.jsonify(result=result), 201

    # If error happens or nothing submitted in register, go back to registration page
    return flask.render_template('register.html', form=form)

@login_manager.user_loader
def load_user(user_id):
    userInfo = users.find({"_id": int(user_id)})
    if (userInfo == None): return None
    return UserInfo(user_id)

#encrypts password so its not the say 10 characters user entered
def hash_password(password):
    return pwd_context.encrypt(password)

#checks if password matches on login
def verify_password(password, hashVal):
    return pwd_context.verify(password, hashVal)

#generate our token
def generate_auth_token(user_id, expiration=600):
    s = Serializer(app.config['SECRET_KEY'], expires_in=expiration)
    # pass index of user
    token = s.dumps({'id': user_id})
    return {'token': token, 'duration': expiration}

#verify our token
def verify_auth_token(token):
    s = Serializer(app.config['SECRET_KEY'])
    try:
        data = s.loads(token)
    except SignatureExpired:
        return None    # valid token, but expired
    except BadSignature:
        return None    # invalid token
    return "Success"

@app.route("/api/login", methods=["GET", "POST"])
def login():
    #get our form and its values
    form = LoginForm(request.form)
    if (request.method == "POST") and (form.validate()):
        username = form.username.data
        password = form.password.data
        rememberl = form.remember.data
        #get our user info from userclass
        userInfo = users.find({"username":username})

        try:
            userInfo[0]
        except IndexError:
            return redirect(url_for("register"))
        
        #get our password from userInfo and make sure its right for the user   
        entry = userInfo[0]
        hashVal = entry['password']
        if verify_password(password, hashVal) is True:

            #now get the username ID and create an active session
            #entryTwo=userInfo[0]
            actID = entry['_id']
            session['user_id'] = actID
            user = UserInfo(actID)
            
            #log the user in
            login_user(user, remember = rememberl)
            return redirect(request.args.get("next") or url_for("token"))

        #if they ran into an issue and they get here, they'll be sent back to register
        else: return redirect(url_for("register"))

    #login page          
    return flask.render_template('login.html', form=form)

#logout the user and send them back to the index page to choose from options
@app.route("/api/logout")
@login_required
def logout():
    logout_user()
    return "You are now logged out"

#index page with login, logout, and register
@app.route("/")
def index():
    return flask.render_template("index.html")

#sets up our token               
@app.route("/api/token", methods=['GET'])
@login_required
def token():
    #get user_id from login session
    user_id = session.get('user_id')
    #generate a token to tie to the user
    tokenInfo = generate_auth_token(user_id, 600)
    #get token in proper form
    retToken = tokenInfo['token']
    retToken = retToken.decode('utf-8')
    
    #now return the token and the duration in json
    result = {'token': retToken, 'duration': 60}
    return flask.jsonify(result=result)

class ListAllJSON(Resource):
    def get(self):
        token = request.args.get('token')
        if token == None: return 'please enter a token value in your link', 401
        verify = verify_auth_token(token)
        if verify == None: return 'token could not be verified', 401
        else:
            parser = reqparse.RequestParser()
            parser.add_argument('top', type=int, location='args')
            args = parser.parse_args()

            items = []
            _dist_date_time = db.tododb.find({}, { "distance": 1, "begin_date": 1, "begin_time": 1})
            dist_date_time = []
            i = 0
            dist_date_time.append(["distance", "begin_date", "begin_time"])
            for ddt in _dist_date_time:
                if i == 0:
                    dist_date_time.append([ddt['distance'], ddt['begin_date'], ddt['begin_time']])
                i += 1
            _items = db.tododb.find({}, { "distance": 0, "begin_date": 0, "begin_time": 0}).sort("km")

            header = []
            header.append(["miles", "km", "location", "open", "close"])
            i = 0
            for item in _items:
                if i - 1 == args['top']:
                    break
                if i > 0:
                    items.append([item['miles'], item['km'], item['location'], item['open'], item['close']])
                i += 1
            return {'header': header, 'items': items, 'ddt': dist_date_time}

class ListOpenOnlyJSON(Resource):
    def get(self):
        token = request.args.get('token')
        if token == None: return 'please enter a token value in your link', 401
        verify = verify_auth_token(token)
        if verify == None: return 'token could not be verified', 401
        else:
            parser = reqparse.RequestParser()
            parser.add_argument('top', type=int, location='args')
            args = parser.parse_args()

            items = []
            _dist_date_time = db.tododb.find({}, { "distance": 1, "begin_date": 1, "begin_time": 1})
            dist_date_time = []
            i = 0
            dist_date_time.append(["distance", "begin_date", "begin_time"])
            for ddt in _dist_date_time:
                if i == 0:
                    dist_date_time.append([ddt['distance'], ddt['begin_date'], ddt['begin_time']])
                i += 1
            _items = db.tododb.find({}, { "miles": 1, "km": 1, "open": 1}).sort("km")

            header = []
            header.append(["miles", "km", "open"])
            i = 0
            for item in _items:
                if i - 1 == args['top']:
                    break
                if i > 0:
                    items.append([item['miles'], item['km'], item['open']])
                i += 1
            return {'header': header, 'items': items, 'ddt': dist_date_time}

class ListCloseOnlyJSON(Resource):
    def get(self):
        token = request.args.get('token')
        if token == None: return 'please enter a token value in your link', 401
        verify = verify_auth_token(token)
        if verify == None: return 'token could not be verified', 401
        else:
            parser = reqparse.RequestParser()
            parser.add_argument('top', type=int, location='args')
            args = parser.parse_args()

            items = []
            _dist_date_time = db.tododb.find({}, { "distance": 1, "begin_date": 1, "begin_time": 1})
            dist_date_time = []
            i = 0
            dist_date_time.append(["distance", "begin_date", "begin_time"])
            for ddt in _dist_date_time:
                if i == 0:
                    dist_date_time.append([ddt['distance'], ddt['begin_date'], ddt['begin_time']])
                i += 1
            _items = db.tododb.find({}, { "miles": 1, "km": 1, "close": 1}).sort("km")

            header = []
            header.append(["miles", "km", "close"])
            i = 0
            for item in _items:
                if i - 1 == args['top']:
                    break
                if i > 0:
                    items.append([item['miles'], item['km'], item['close']])
                i += 1
            return {'header': header, 'items': items, 'ddt': dist_date_time}

class ListAllcsv(Resource):
    def get(self):
        token = request.args.get('token')
        if token == None: return 'please enter a token value in your link', 401
        verify = verify_auth_token(token)
        if verify == None: return 'token could not be verified', 401
        else:
            parser = reqparse.RequestParser()
            parser.add_argument('top', type=int, location='args')
            args = parser.parse_args()

            _dist_date_time = db.tododb.find({}, { "distance": 1, "begin_date": 1, "begin_time": 1})
            i = 0
            ret = "\"distance\",\"begin_date\",\"begin_time\"\n"
            for ddt in _dist_date_time:
                if i == 0:
                   ret += "\"" + ddt['distance'] + "\",\"" + ddt['begin_date'] + "\",\"" + ddt['begin_time'] + "\"\n"
                i += 1
            _items = db.tododb.find({}, { "distance": 0, "begin_date": 0, "begin_time": 0}).sort("km")

            ret += "\"miles\",\"km\",\"location\",\"open\",\"close\"\n"
            i = 0
            for item in _items:
                if i - 1 == args['top']:
                    break
                if i > 0:
                    ret += "\"" + str(item['miles']) + "\",\"" + str(item['km']) + "\",\"" + item['location'] + "\",\"" + item['open'] + "\",\"" + item['close']+ "\"\n"
                i += 1

            return ret

class ListOpenOnlycsv(Resource):
    def get(self):
        token = request.args.get('token')
        if token == None: return 'please enter a token value in your link', 401
        verify = verify_auth_token(token)
        if verify == None: return 'token could not be verified', 401
        else:
            parser = reqparse.RequestParser()
            parser.add_argument('top', type=int, location='args')
            args = parser.parse_args()

            _dist_date_time = db.tododb.find({}, { "distance": 1, "begin_date": 1, "begin_time": 1})
            i = 0
            ret = "\"distance\",\"begin_date\",\"begin_time\"\n"
            for ddt in _dist_date_time:
                if i == 0:
                   ret += "\"" + ddt['distance'] + "\",\"" + ddt['begin_date'] + "\",\"" + ddt['begin_time'] + "\"\n"
                i += 1
            _items = db.tododb.find({}, { "distance": 0, "begin_date": 0, "begin_time": 0}).sort("km")

            ret += "\"miles\",\"km\",\"location\",\"open\"\n"
            i = 0
            for item in _items:
                if i - 1 == args['top']:
                    break
                if i > 0:
                    ret += "\"" + str(item['miles']) + "\",\"" + str(item['km']) + "\",\"" + item['location'] + "\",\"" + item['open'] + "\"\n"
                i += 1

            return ret

class ListCloseOnlycsv(Resource):
    def get(self):
        token = request.args.get('token')
        if token == None: return 'please enter a token value in your link', 401
        verify = verify_auth_token(token)
        if verify == None: return 'token could not be verified', 401
        else:
            parser = reqparse.RequestParser()
            parser.add_argument('top', type=int, location='args')
            args = parser.parse_args()

            _dist_date_time = db.tododb.find({}, { "distance": 1, "begin_date": 1, "begin_time": 1})
            i = 0
            ret = "\"distance\",\"begin_date\",\"begin_time\"\n"
            for ddt in _dist_date_time:
                if i == 0:
                   ret += "\"" + ddt['distance'] + "\",\"" + ddt['begin_date'] + "\",\"" + ddt['begin_time'] + "\"\n"
                i += 1
            _items = db.tododb.find({}, { "distance": 0, "begin_date": 0, "begin_time": 0}).sort("km")

            ret += "\"miles\",\"km\",\"location\",\"close\"\n"
            i = 0
            for item in _items:
                if i - 1 == args['top']:
                    break
                if i > 0:
                    ret += "\"" + str(item['miles']) + "\",\"" + str(item['km']) + "\",\"" + item['location'] + "\",\"" + "\",\"" + item['close']+ "\"\n"
                i += 1

            return ret

api.add_resource(ListAllJSON, '/listAll', '/listAll/json')
api.add_resource(ListOpenOnlyJSON, '/listOpenOnly', '/listOpenOnly/json')
api.add_resource(ListCloseOnlyJSON, '/listCloseOnly', '/listCloseOnly/json')
api.add_resource(ListAllcsv, '/listAll/csv')
api.add_resource(ListOpenOnlycsv, '/listOpenOnly/csv')
api.add_resource(ListCloseOnlycsv, '/listCloseOnly/csv')

# Run the application
if __name__ == '__main__':
    app.run(host='0.0.0.0', port=80, debug=True)
