FROM wyveo/nginx-php-fpm:php74

WORKDIR /usr/share/nginx/html
COPY . /usr/share/nginx/html
RUN composer install
RUN php artisan migrate
ADD docker/images/nginx/nginx.conf /etc/nginx/conf.d/default.conf
