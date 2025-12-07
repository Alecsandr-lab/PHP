FROM php:8.2-apache

# Обновление и установка системных зависимостей
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    default-mysql-client

# Установка расширений PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli \
    gd \
    zip \
    mbstring \
    exif \
    pcntl \
    bcmath

# Включение mod_rewrite для Apache
RUN a2enmod rewrite

WORKDIR /var/www/html

# Копирование исходного кода
#
# Установка прав
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html