# FROM php:7.4-apache
FROM ctftraining/base_image_nginx_mysql_php_73

# Install mysqli extension
# RUN docker-php-ext-install mysqli
#USER apache
RUN chmod 777 /usr/lib/mariadb/plugin/

COPY ./src /var/www/html
COPY php.ini /usr/local/etc/php/conf.d
COPY flag.sh /flag.sh
COPY my.cnf /etc/my.cnf.d/mariadb-server.cnf

# ENV MYSQL_ROOT_PASSWORD=asd222!!@332asc
# ENV MYSQL_DATABASE=ctf
# USER www-data


EXPOSE 80 3306