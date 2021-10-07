ARG PHP_VERSION
FROM php:${PHP_VERSION}-fpm
ARG PHP_ERROR_LOG_PATH
ARG X_DEBUG
ARG X_DEBUG_ERROR_LOG_PATH
ARG MEMPROF_LOG_PATH
ARG TIMEZONE
LABEL version="1.0"
LABEL description="PHP-${PHP_VERSION} container"
LABEL maintainer = "Vladimir Valyakin"
ENV TZ=${TIMEZONE}
ENV ADMIN="Vladimir"
ENV MEMPROF_LOG_PATH=${MEMPROF_LOG_PATH}
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone \
    && apt update && apt install -y \
    curl \
    wget \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libonig-dev \
    libzip-dev \
    libmcrypt-dev \
    libjudy-dev \
    libz-dev \
    libpq-dev \
    && docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo_mysql zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && pecl install xdebug \
    memprof \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install opcache \
    && docker-php-ext-install sockets \
    && docker-php-ext-enable memprof \
    && docker-php-ext-install pdo \
    pgsql pdo_pgsql \
    && touch /tmp/profile.heap
COPY ./conf/php/php.ini /usr/local/etc/php/php.ini
COPY ./conf/X-Debug/x-debug.ini /usr/local/etc/php/xdebug.ini
COPY ./conf/php-fpm.d/zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf
RUN if [ ${X_DEBUG} = true ]; then \
 cat /usr/local/etc/php/xdebug.ini >> /usr/local/etc/php/php.ini ; \
fi
RUN if [ ${X_DEBUG} = 1 ]; then \
 cat /usr/local/etc/php/xdebug.ini >> /usr/local/etc/php/php.ini ; \
fi
WORKDIR /var/www/html
CMD ["php-fpm"]