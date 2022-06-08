FROM php:8.0-fpm

RUN apt-get update
RUN apt-get install -y nodejs npm
RUN apt-get install -y libzip-dev zip unzip
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install pdo pdo_mysql zip gd \
    && curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-enable gd

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html

RUN composer install