FROM php:7.4-fpm-alpine AS build

WORKDIR /var/www/html/app

RUN docker-php-ext-install tokenizer mysqli pdo_mysql

COPY . /var/www/html/app/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

RUN chmod 777 -R /var/www/html/app/storage