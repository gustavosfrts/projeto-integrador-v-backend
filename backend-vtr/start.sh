#!/bin/bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --force
php artisan serve --host=0.0.0.0