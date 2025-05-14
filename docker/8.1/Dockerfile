# Use the official PHP 8.1 FPM base image
FROM php:8.1-fpm

# Install system deps + PHP extensions
RUN apt-get update \
  && apt-get install -y \
       zip unzip git supervisor sqlite3 libpng-dev libonig-dev libzip-dev \
  && docker-php-ext-install pdo_mysql zip gd opcache \
  && pecl install redis swoole \
  && docker-php-ext-enable redis swoole \
  && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Install PHP deps & optimize
RUN composer install --no-dev --optimize-autoloader \
  && php artisan clear-compiled \
  && php artisan optimize

CMD ["php-fpm"]
