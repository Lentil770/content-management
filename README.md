# Content Management App

## Full Stack Laravel App for Content App - Readings, Library (of physical books), and Videos databases.

### Dependencies

Laravel Version 9

Using Google Sign in, Google Tags, Sentry error tracking.
Using Laravel Excel for uploading .xlsx files

### Setup locally

Create Database
use .env.example to setup .env file (fill in missing fields)
run 'composer install' in console/command line from project root directory
run 'php artisan key:generate' from command line
Run Database migrations with 'php artisan migrate'
Run Seeders with 'php artisan db:seed'
Run 'php artisan serve' to run app. (ensure your database is also live)

### Setup Production Notes

ensure redirect url for production site is added in google cloud console.
