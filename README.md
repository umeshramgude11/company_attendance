# ![Laravel Example App](logo.png)


 ### This is Attendance portal for companies, create by using laravel  [Attenance Portal](https://github.com/gothinkster/realworld-example-apps) 


----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/9.x/installation)


Clone the repository

    git clone git@github.com:gothinkster/laravel-realworld-example-app.git

Switch to the repo folder

    cd laravel-realworld-example-app

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

    
**Make sure you set the create a database & add connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes users, articles, comments, tags, favorites and follows. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Open the DummyDataSeeder and set the property values as per your requirement

    database/seeders/Company_userSeeder.php
    database/seeders/UserSeeder.php

Run the database seeder and you're done

    php artisan db:seed --class=Company_userSeeder
    php artisan db:seed --class=UserSeeder;

***Note*** : names and users details created randomely
so one company user created to initally login to the tool and later add users. UserName and password: admin
on the landing page click on login link of Are you a company? use above details to login
    

# Code overview

## Folders

- `app` - Contains all the Eloquent models
- `app/Http/Controllers/mwadmin` - Contains all the controllers
- `app/Http/Middleware` - Contains Auth middleware

- `config` - Contains all the application configuration files
- `database/migrations` - Contains all the database migrations
- `database/seeders` - Contains the database seeder
- `routes` - Contains all the api routes defined in web.php file


## Environment variables

- `.env` - Environment variables can be set in this file

----------
 
# Authentication
 

----------
