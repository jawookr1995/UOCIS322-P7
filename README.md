# UOCIS322 - Project 7 #

## Author: Theodore Yun
## Email: jawookr1995@gmail.com
## This web service app contains three services, brevetsapp, api, and website.

### How brevetsapp work
- It is ACP calculator page.

- It has two buttons which are submit and dislay.

- After you filling out the value in the chart, if you hit the "submit" button, your database will be stored into MongoDB database.

- If no value is inserted in ACP calculator page, "submit" button would cause error.

- After data is passed, if you hit "display" the database will be displayed in separate page.

### How to approach to application

- http://<host:port>/

- If you put your host machine in our case, testium would be fit for hostname, and assigned port should be included.

- In "docker-compose.yml" you can find applicable port number.


### How api works

* This is a Restful service that includes the following functionalities:

* Three basic APIs that exposes what is stored in MongoDB.three basic APIs:

  * "http://host:port/listAll" should return all open and close times in the database
  * "http://host:port/listOpenOnly" should return open times only
  * "http://host:port/listCloseOnly" should return close times only
* Two different representations: one in csv and one in json. For the above, JSON is the default representation for the above three basic APIs.

  * "http://host:port/listAll/csv" should return all open and close times in CSV format

  * "http://host:port/listOpenOnly/csv" should return open times only in CSV format

  * "http://host:port/listCloseOnly/csv" should return close times only in CSV format

  * "http://host:port/listAll/json" should return all open and close times in JSON format

  * http://host:port/listOpenOnly/json" should return open times only in JSON format

  * "http://host:port/listCloseOnly/json" should return close times only in JSON format

* A query parameter getting top "k" open and close times. For examples, see below.

  * "http://host:port/listOpenOnly/csv?top=3" should return top 3 open times only (in ascending order) in CSV format
  * "http://host:port/listOpenOnly/json?top=5" should return top 5 open times only (in ascending order) in JSON format
  * "http://host:port/listCloseOnly/csv?top=6" should return top 5 close times only (in ascending order) in CSV format
  * "http://host:port/listCloseOnly/json?top=4" should return top 4 close times only (in ascending order) in JSON format
  
- If you go to designated port for api, you will see all the types of listing. (Check detail in "docker-compose.yml")

- However for this assignment we need token in the link for the verification. If you visit http://<host:port>/ (in my case it is at port 5118). you can see the login, register, and logout button. First of all you have to register for username and password. 

-After you submit the registration you can go to http://<host:port>/api/login for login or go back to index page and hit login button. If you hit the login button with "remember me" user's token will be generated and authentication duration will be displayed.

- If you get the token and include that followed by correct api link representation. For example, if you go to testium.cs.uoregon.edu::5218/listAll/json?eyJhbGciOiJIUzI1NiIsImlhdCI6MTYyMzI5ODUwMiwiZXhwIjoxNjIzMjk5MTAyfQ. which includes token after the api representaion, you can see the data for all the json value with authentication. If token value is empty, then it would say "Token value is not included in link" with 401 error. If wrong token is inserted, then it would say "Worng Token, cannot verify"



## What is web

- It is basic brevet calculator that we can calculate brevet times. by inserting date you want, and each brevet distance, you will automaticlally get open time and close time, and if you hit submit, the data will be stored in database. And then If you hit the display button, you can see all the list that you recentaly submitted.



# Credits

- Michal Young, Ram Durairajan, Steven Walton, Joe Istas.