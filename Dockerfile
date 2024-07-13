# Dockerfile

FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install intl mbstring pdo pdo_mysql xml zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory #Container Working-Directory Path
WORKDIR /var/www/html 

# Copy existing application directory contents
COPY . .

# Install application dependencies
RUN composer install --ignore-platform-reqs --no-scripts --no-autoloader

# Copy existing application directory permissions
#Container Directory Paths Permissions
RUN chown -R www-data:www-data /var/www/html 

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

