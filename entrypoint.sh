#!/bin/sh

# Ensure SQLite exists and is writable
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chmod -R 777 /var/www/html/database

# Set APP_KEY if not set (optional)
if [ -z "$APP_KEY" ]; then
    php artisan key:generate
fi

# Clear caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run migrations & seed database
php artisan migrate --seed

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=8000
