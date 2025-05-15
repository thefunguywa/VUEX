FROM php:8.1-fpm

# 1) install build tools & -dev headers + curl for NodeSource
RUN apt-get update && apt-get install -y \
    build-essential autoconf pkg-config \
    libcurl4-openssl-dev \
    libzip-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    libwebp-dev libxpm-dev libonig-dev libxml2-dev libssl-dev \
    zip unzip git supervisor sqlite3 \
    curl gnupg ca-certificates \
  && rm -rf /var/lib/apt/lists/*

# 2) configure & install PHP extensions + PECL
RUN docker-php-ext-configure gd \
      --with-jpeg \
      --with-freetype \
      --with-webp \
      --with-xpm \
  && docker-php-ext-install \
      pdo_mysql mbstring zip gd opcache xml bcmath curl \
  && pecl install redis swoole \
  && docker-php-ext-enable redis swoole \
  && rm -rf /tmp/pear

# 3) Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4) Install Node.js (16.x)
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
  && apt-get update && apt-get install -y nodejs \
  && npm install -g npm@9 \
  && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# 5) Copy all code
COPY . .

# 6) Build frontend assets
RUN npm ci \
  && npm run production

# 7) Fix permissions, install PHP deps, generate key & cache config
RUN chown -R www-data:www-data storage bootstrap/cache \
  && chmod -R 775 storage bootstrap/cache \
  && composer install --no-dev --optimize-autoloader \
  && php artisan key:generate --ansi \
  && php artisan clear-compiled \
  && php artisan config:cache

CMD ["php-fpm"]
