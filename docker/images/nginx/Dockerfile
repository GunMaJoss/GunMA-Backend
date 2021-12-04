FROM wyveo/nginx-php-fpm:php74

WORKDIR /usr/share/nginx/html
COPY . /usr/share/nginx/html
RUN composer install
ADD docker/images/nginx/nginx.conf /etc/nginx/conf.d/default.conf
