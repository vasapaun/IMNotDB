#!/bin/sh

# Ensure SQLite exists
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chmod -R 777 /var/www/html/database

# Ensure .env exists
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Generate APP_KEY if needed
if [ -z "$APP_KEY" ]; then
    php artisan key:generate
fi

# Clear caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run migrations and seed database
php artisan migrate --seed

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=8000
