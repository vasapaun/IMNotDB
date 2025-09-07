# Use official PHP + Composer image
FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite zip

# Install Composer globally
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Install Node.js and npm (for Vite/Tailwind)
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

# Set working directory
WORKDIR /var/www/html

# Copy composer & npm files
COPY composer.json composer.lock ./
COPY package.json package-lock.json ./

# Install PHP and JS dependencies
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Copy the app
COPY . .

# Make sure database folder exists
RUN mkdir -p database
RUN touch database/database.sqlite
RUN chmod -R 777 database

# Copy entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Expose port
EXPOSE 8000

# Run the entrypoint
ENTRYPOINT ["/entrypoint.sh"]
