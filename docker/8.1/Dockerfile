# docker/8.1/Dockerfile
FROM php:8.1-fpm

# 1) install build tools & all the -dev headers so extensions compile
RUN apt-get update \
 && apt-get install -y \
      build-essential autoconf pkg-config \
      libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
      libonig-dev libxml2-dev libssl-dev \
      zip unzip git supervisor sqlite3 \
 && docker-php-ext-configure gd --with-jpeg --with-freetype \
 && docker-php-ext-install \
      pdo_mysql \
      mbstring \
      zip \
      gd \
      opcache \
      xml \
      bcmath \
      curl \
 && pecl install redis swoole \
 && docker-php-ext-enable redis swoole \
 && rm -rf /var/lib/apt/lists/*

# 2) bring in Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# 3) install PHP dependencies (no artisan optimize here)
RUN composer install --no-dev --optimize-autoloader

# 4) generate your APP_KEY so Laravel boots cleanly
RUN php artisan key:generate --ansi

CMD ["php-fpm"]
