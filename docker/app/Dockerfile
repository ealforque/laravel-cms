FROM php:8.1-fpm-buster

RUN apt-get update
RUN apt-get install -y git zip unzip libsodium-dev autoconf g++ make default-mysql-client
RUN docker-php-ext-install bcmath pdo_mysql sockets pcntl

# xdebug
RUN pecl install xdebug
ADD xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN docker-php-ext-enable xdebug

# Composer
COPY ./composer.json ./composer.json
COPY ./composer.lock ./composer.lock

RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer
ENV PATH /root/.composer/vendor/bin:$PATH
RUN composer install --no-ansi --no-dev --no-interaction --no-plugins --no-progress --no-scripts --optimize-autoloader
RUN mkdir -p storage/app
RUN mkdir -p storage/framework/cache
RUN mkdir -p storage/logs

# Application
COPY ./app ./app
COPY ./bootstrap ./bootstrap
COPY ./config ./config
COPY ./database ./database
COPY ./public ./public
COPY ./resources ./resources
COPY ./routes ./routes
COPY ./tests ./tests
COPY ./artisan ./artisan
COPY ./phpunit.xml ./phpunit.xml

RUN composer install

EXPOSE 9000