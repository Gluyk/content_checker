FROM php:7.4-fpm-alpine

RUN apk update \
	&& apk upgrade \
	&& apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS \
	&& apk add composer tini \
	&& pecl install xdebug \
	&& docker-php-ext-install pdo_mysql \
	&& docker-php-ext-enable xdebug \
	&& apk del .phpize-deps \
	&& rm -rf /var/cache/apk/*

WORKDIR /app

ENTRYPOINT ["/sbin/tini", "--"]
CMD ["php-fpm"]

#xdebug: $PHPIZE_DEPS





