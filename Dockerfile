FROM php:7.4-apache

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . /var/www/html

RUN docker-php-ext-install mysqli

CMD ["apache2-foreground"]
