FROM php:8.0.7-fpm

RUN apt-get update && apt-get install -y curl  libzip-dev zip unzip wget

RUN docker-php-ext-install pdo pdo_mysql zip

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
	mv composer.phar /usr/local/bin/composer

RUN wget https://github.com/FriendsOfPHP/PHP-CS-Fixer/releases/download/v3.0.0/php-cs-fixer.phar -O php-cs-fixer
RUN chmod a+x php-cs-fixer
RUN mv php-cs-fixer /usr/local/bin/php-cs-fixer

COPY config/php.ini /etc/php.ini
COPY config/php-fpm.conf /etc/php.conf

RUN chown -R www-data:www-data .

WORKDIR /var/www/app