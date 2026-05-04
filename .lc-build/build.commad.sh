#!/bin/bash

composer install --no-dev --prefer-dist -o
npm ci
npm run build

php artisan key:generate --force
php artisan migrate --force
php artisan storage:link
php artisan optimize:clear