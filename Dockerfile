FROM php:7-apache
RUN pecl install redis && docker-php-ext-enable redis
COPY . /var/www/html/