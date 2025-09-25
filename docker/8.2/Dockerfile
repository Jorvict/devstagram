FROM php:8.3-fpm

# Instala dependencias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    nano \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl


# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


RUN groupadd -g 1000 sail \
    && useradd -u 1000 -g sail -m sail \
    && chown -R sail:sail /var/www

RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm

WORKDIR /var/www
COPY . .
RUN composer install
