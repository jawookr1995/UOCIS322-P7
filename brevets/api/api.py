from flask import Flask
from flask_restful import Resource, Api, reqparse
import os
from pymongo import MongoClient

# Instantiate the app
app = Flask(__name__)
api = Api(app)

client = MongoClient(os.environ['DB_PORT_27017_TCP_ADDR'], 27017)
db = client.tododb

class ListAllJSON(Resource):
    def get(self):
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
