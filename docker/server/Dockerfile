FROM php:8.2-apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY ./ /var/www/html
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN a2enmod rewrite
RUN /etc/init.d/apache2 restart
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug
RUN apt-get update
RUN apt-get install -y git zip
