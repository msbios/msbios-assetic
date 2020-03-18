FROM php:7.3-fpm as scratch

ARG APP_ENV
ENV APP_ENV=${APP_ENV}

COPY .docker/php-fpm/php_${APP_ENV}.ini /usr/local/etc/php/php.ini
COPY .docker/php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf
# RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# RUN pecl install -o -f redis \
#     && rm -rf /tmp/pear \
#     && docker-php-ext-enable redis

RUN apt-get update && apt-get install -y libpq-dev libicu-dev unzip wget git \
    && docker-php-ext-install pdo pdo_mysql intl pcntl mbstring

RUN wget https://getcomposer.org/installer -O - -q | php -- --install-dir=/bin --filename=composer --quiet

ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /var/www/html

# DEV env (local)
FROM scratch as dev

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# PROD env (kubernetes)
FROM scratch as prod

USER www-data:www-data
CMD ["php-fpm"]
EXPOSE 9000