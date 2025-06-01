ARG PHP_VER=fpm-alpine

FROM php:${PHP_VER}

ARG USER_ID=1000
ARG XDEBUG_VER=

# $PHPIZE_DEPS (autoconf   dpkg-dev dpkg   file   g++   gcc   libc-dev   make   pkgconf   re2c)
RUN set -eux && \
    apk add --no-cache --update \
        autoconf \
        g++ \
        make \
        curl \
        git \
        zip \
        linux-headers \
        libpng \
        libjpeg-turbo \
        libwebp \
        freetype && \
    \
    apk add --no-cache --virtual .build-deps \
        libpng-dev \
        libjpeg-turbo-dev \
        libwebp-dev \
        freetype-dev && \
    \
    pecl channel-update \
        pecl.php.net && \
    \
    pecl install -f \
        xdebug${XDEBUG_VER} && \
    \
    docker-php-ext-configure gd \
		--with-jpeg \
		--with-webp \
		--with-freetype && \
    \
    docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        mysqli \
        gd && \
    \
    docker-php-ext-enable \
        xdebug && \
    \
    apk del --purge \
        autoconf \
        g++ \
        make && \
    \
    apk del .build-deps && \
    rm -rf /var/cache/apk/* && \
    mkdir /.composer && \
    chown -R ${USER_ID}:${USER_ID} /.composer

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

COPY ./config/. $PHP_INI_DIR/

WORKDIR /var/www

ENTRYPOINT [ "php-fpm" ]
