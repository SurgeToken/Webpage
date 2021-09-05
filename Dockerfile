FROM php:7.3-apache
RUN pecl install redis && docker-php-ext-enable redis
COPY . /var/www/html/