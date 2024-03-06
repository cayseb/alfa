FROM php:8.3.3-fpm-alpine

RUN apk add --no-cache \
#      php8-ctype \
#      php8-curl \
#      php8-dom \
#      php8-fileinfo \
#      php-json \
#      php8-mbstring \
#      php8-openssl \
#      pcre \
#      php8-pdo \
#      php8-tokenizer \
#      php8-xml \
      freetype \
      libjpeg-turbo \
      libpng \
      freetype-dev \
      libpq-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      # --with-png=/usr/include/ \ # No longer necessary as of 7.4; https://github.com/docker-library/php/pull/910#issuecomment-559383597
      --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd \
    && apk del --no-cache \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && rm -rf /tmp/*

RUN apk add libzip-dev

RUN docker-php-ext-install pdo pdo_pgsql zip bcmath

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
#ctype curl dom fileinfo json mbstring openssl pcre pdo tokenizer xml
