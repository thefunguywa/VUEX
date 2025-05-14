# docker/8.1/Dockerfile
FROM php:8.1-fpm

# 1) install build-tools & all needed -dev headers
RUN apt-get update \
  && apt-get install -y \
       build-essential autoconf pkg-config \
       libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
       libonig-dev libxml2-dev libssl-dev \
       zip unzip git supervisor sqlite3 \
  && docker-php-ext-configure gd --with-jpeg --with-freetype \
  && docker-php-ext-install pdo_mysql zip gd opcache \
  && pecl install redis swoole \
  && docker-php-ext-enable redis swoole \
  && rm -rf /var/lib/apt/lists/*

# 2) install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# 3) install PHP deps & optimise
RUN composer install --no-dev --optimize-autoloader \
  && php artisan clear-compiled \
  && php artisan optimize

CMD ["php-fpm"]
