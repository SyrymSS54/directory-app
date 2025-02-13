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

# # Устанавливаем права на storage и cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache


RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN a2enmod rewrite

# Открываем порт 80
EXPOSE 80