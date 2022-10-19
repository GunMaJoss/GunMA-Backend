FROM wyveo/nginx-php-fpm:php81

WORKDIR /usr/share/nginx/html
COPY . /usr/share/nginx/html
RUN composer install 
RUN php artisan migrate
RUN php artisan optimize
RUN php artisan shield:generate
RUN php artisan db:seed
RUN npm run dev
ADD docker/nginx.conf /etc/nginx/conf.d/default.conf
