# About Laravel JWT Quotation App

Laravel JWT Quotation App is a Laravel-based web app serving as D.J. Griffin's submission to Battleface.net's Coding Challenge. This web app uses a combination of Laravel's authentication system and [jwt-auth](https://github.com/tymondesigns/jwt-auth) for user authentication. jwt-auth is a JWT authentication library used to replace the default authentication guard with a JWT-based one. Please follow the steps below to get it working.



# Use Instructions

## Create Datebase

- Create a database on your web server. I named mine 'laravel_jwt_app'.
- If you chose a name other than 'laravel_jwt_app', replace it in the .env file at DB_DATABASE.
- Enter your database username and password at DB_USERNAME and DB_PASSWORD in .env.



## Create Tables & Seed Database

Run the command `php artisan migrate:fresh --seed` to create the needed tables and seed the database with a new user.



## Setup Server
 
- Add the code to your existing localhost webserver setup or use php artisan serve.
- If using php artisan serve, go to http://127.0.0.1:8000.



## Login

Login using the email `admin@email.com` and the password `A^r+K<:jeRU*BH\Y4S?W`. These credentials were present in .env when seeding the database.

![Screenshot1](login-form.png?raw=true)



## Use App

Use the quotation app the way required. :smiley:

![Screenshot1](quotation-form.png?raw=true)
