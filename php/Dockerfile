FROM php:7.4-fpm-alpine

RUN apk update \
	&& apk upgrade \
	&& apk add composer \
	&& docker-php-ext-install pdo_mysql \
	&& rm -rf /var/cache/apk/*

WORKDIR /app

CMD ["php-fpm"]
