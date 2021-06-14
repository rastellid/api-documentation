FROM php:8.0.7-fpm

RUN apt-get update && apt-get install -y curl

RUN docker-php-ext-install pdo pdo_mysql

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
	mv composer.phar /usr/local/bin/composer

COPY config/php.ini /etc/php.ini
COPY config/php-fpm.conf /etc/php.conf

RUN chown -R www-data:www-data .

WORKDIR /var/www/app