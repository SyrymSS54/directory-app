# Базовый образ PHP + Apache
FROM php:8.2-apache

# Устанавливаем необходимые модули PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo_mysql gd

# Копируем файлы Laravel
COPY . /var/www/html

# Устанавливаем права на storage и cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Открываем порт 80
EXPOSE 80