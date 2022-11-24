FROM php:7.4-fpm

ENV TZ=Europe/Moscow

RUN apt update
RUN docker-php-ext-install mysqli pdo pdo_mysql

EXPOSE 3306

WORKDIR /var/www

#RUN apt-get install -y supervisor

#CMD ["/usr/bin/supervisord"]