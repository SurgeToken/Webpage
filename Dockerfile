FROM php:7.4.22-apache
RUN pecl install redis && docker-php-ext-enable redis
COPY . /var/www/html/