# Stage 1: build & runtime in one container
FROM php:8.1-fpm

# install OS packages and PHP build tools
RUN apt-get update \
  && apt-get install -y \
       build-essential \
       autoconf \
       zip unzip git supervisor sqlite3 \
       libpng-dev libonig-dev libzip-dev libxml2-dev \
  && docker-php-ext-install pdo_mysql zip gd opcache \
  && pecl install redis swoole \
  && docker-php-ext-enable redis swoole \
  && rm -rf /var/lib/apt/lists/*

# install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# install PHP dependencies & optimize
RUN composer install --no-dev --optimize-autoloader \
  && php artisan clear-compiled \
  && php artisan optimize

CMD ["php-fpm"]
