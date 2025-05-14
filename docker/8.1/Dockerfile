FROM php:8.1-fpm

# 1) install build tools & all -dev headers GD, curl, SSL, etc. need
RUN apt-get update && apt-get install -y \
    build-essential autoconf pkg-config \
    libcurl4-openssl-dev \
    libzip-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    libwebp-dev libxpm-dev libonig-dev libxml2-dev libssl-dev \
    zip unzip git supervisor sqlite3 \
  && rm -rf /var/lib/apt/lists/*

# 2) configure & install PHP extensions + PECL
RUN docker-php-ext-configure gd \
      --with-jpeg \
      --with-freetype \
      --with-webp \
      --with-xpm \
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
  && rm -rf /tmp/pear

# 3) Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# 4) Install PHP deps & optimize
RUN composer install --no-dev --optimize-autoloader \
  && php artisan key:generate --ansi \
  && php artisan clear-compiled \
  && php artisan optimize

CMD ["php-fpm"]
