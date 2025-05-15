# → builder: install PHP, Node, build everything
FROM php:8.1-fpm AS builder

# Install system & build deps
RUN apt-get update && apt-get install -y \
    build-essential autoconf pkg-config curl gnupg ca-certificates \
    libcurl4-openssl-dev libzip-dev libpng-dev libjpeg62-turbo-dev \
    libfreetype6-dev libwebp-dev libxpm-dev libonig-dev libxml2-dev \
    libssl-dev zip unzip git supervisor sqlite3 \
  && rm -rf /var/lib/apt/lists/*

# PHP extensions + PECL
RUN docker-php-ext-configure gd \
      --with-jpeg --with-freetype --with-webp --with-xpm \
  && docker-php-ext-install pdo_mysql mbstring zip gd opcache xml bcmath curl \
  && pecl install redis swoole \
  && docker-php-ext-enable redis swoole

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Node.js 16
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
  && apt-get update && apt-get install -y nodejs \
  && npm install -g npm@9 \
  && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html
COPY . .

# Build frontend
RUN npm ci && npm run production

# Install PHP deps & optimize
RUN composer install --no-dev --optimize-autoloader \
  && php artisan key:generate --ansi \
  && php artisan clear-compiled \
  && php artisan config:cache

# Fix perms
RUN chown -R www-data:www-data storage bootstrap/cache public \
  && chmod -R 775 storage bootstrap/cache public

# → final: runtime php-fpm
FROM php:8.1-fpm

WORKDIR /var/www/html
COPY --from=builder /var/www/html /var/www/html

# Expose FPM port
EXPOSE 9000
CMD ["php-fpm"]
