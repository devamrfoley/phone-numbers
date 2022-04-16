## About
This project is to list & filter phone numbers by country and validate if it's right or not a valid number.

## Requirements
PHP7.3+, Composer and SQLite 3 installed.

## Run the project

> git clone git@github.com:devamrfoley/phone-numbers.git
> cd phone-numbers
> cp .env.example .env
> validate the absolute path for DB_DATABASE inside .env file
> composer install
> php artisan key:generate
> php artisan test
> php artisan serve
> visit http://127.0.0.1:8000 in your browser