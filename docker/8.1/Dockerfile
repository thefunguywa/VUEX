FROM php:8.1-fpm

# 1) Install system packages and headers
RUN apt-get update \
 && apt-get install -y \
      build-essential autoconf pkg-config \
      libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
      libonig-dev libxml2-dev libssl-dev \
      zip unzip git sqlite3 \
 && rm -rf /var/lib/apt/lists/*

# 2) Configure & install PHP extensions
RUN docker-php-ext-configure gd --with-jpeg --with-freetype \
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
 && docker-php-ext-enable redis swoole

# 3) Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 4) Copy app & run composer
COPY . .
RUN composer install --no-dev --optimize-autoloader \
 && php artisan key:generate --ansi \
 && php artisan clear-compiled \
 && php artisan optimize

CMD ["php-fpm"]
