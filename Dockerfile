FROM gumadesarrollo/php:7.4-apache-sqlsrv-prod

WORKDIR /var/www/html

RUN mkdir estadistica

WORKDIR /var/www/html/estadistica

COPY . .

RUN composer install --ignore-platform-reqs

RUN chmod -R 777 storage

EXPOSE 80