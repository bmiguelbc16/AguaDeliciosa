#!/bin/bash

php artisan migrate --force
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
chmod -R 777 public/
chmod -R 777 storage/
