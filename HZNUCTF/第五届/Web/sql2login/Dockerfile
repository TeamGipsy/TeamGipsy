FROM ctftraining/base_image_nginx_mysql_php_56

COPY ./src /var/www/html
# COPY my.cnf /etc/my.cnf.d/mariadb-server.cnf
COPY flag.sh /flag.sh
RUN sh -c "ln -s /var/run/mysqld/mysqld.sock /tmp/mysql.sock"
EXPOSE 80

# RUN rm -r /var/www/html/index.php && \
#     rm -rf /tmp/* && \
#     rm -rf /etc/apk 



# COPY db.sql /var/db.sql

# COPY ./service/docker-entrypoint.sh /docker-entrypoint.sh

# RUN sh -c 'mysqld_safe &' \
#     && sleep 10s \
#     && mysqladmin -uroot password '123456' \
#     && mysql -e "source /var/db.sql;" -uroot \
#     && chmod -R 777 /docker-entrypoint.sh \
#     && chmod -R 777 /var/db.sql \
#     && chown -R www-data:www-data /var/www/html 

# CMD /docker-entrypoint.sh

