# TaskLaravel
[![Build Status](https://travis-ci.org/sadhakbj/TaskLaravel.svg?branch=master)](https://travis-ci.org/sadhakbj/TaskLaravel)

Simple blog application using Laravel 5.2 following Repository design pattern. 
This application implements the major concetps of Laravel framework like:
 * Routing
 * Controller
 * Model
 * Events
 * Mail
 * Middleware
 * Logging


## Install

TaskLaravel can be cloned from github repository and installed. Following the procedure given below:

* git clone `git@github.com:sadhakbj/TaskLaravel.git`
* cd TaskLaravel

## Run

The app can be run with the command below:

* install the application dependencies using command: `composer install`
* Copy .env file `cp .env.example .env`
* Update database and email configuration
* use command `php artisan serve` to start the server (--port can be optional)
* access `http://localhost:8000`

## Framework

The application is written in PHP based on the [Laravel](http://laravel.com) framework, current version of Laravel 
used for this project is 5.2.
 
## Running Tests

Tests can be run through command `./vendor/bin/phpunit`

## Check code quality

We follow [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) for 
coding standard  

## Coding Conventions

We have followed PSR-2 coding convention.


## Tools Used:
* Bootstrap 
* Jquery