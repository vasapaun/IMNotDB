# Base image with PHP + Composer
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    curl \
    npm \
    nodejs \
    && docker-php-ext-install pdo_mysql

# Set working directory
WORKDIR /var/www/html

# Copy composer.json and install dependencies
COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Copy Node files and install
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Copy the rest of the Laravel app
COPY . .

# Expose port 9000
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
