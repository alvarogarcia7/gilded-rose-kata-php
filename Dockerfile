FROM composer:2.7

RUN apk add --no-cache $PHPIZE_DEPS \
    && apk add --update linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug