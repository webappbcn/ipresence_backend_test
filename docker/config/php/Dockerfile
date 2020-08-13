FROM php:7.3.7-fpm-stretch

RUN mkdir /srv ; exit 0
RUN mkdir /srv/www/ ; exit 0
RUN mkdir /srv/www/vhosts/ ; exit 0
RUN mkdir /srv/www/vhosts/ipresence && mkdir /srv/www/vhosts/ipresence/cache
RUN mkdir /srv/www/vhosts/ipresence/cache/api && mkdir /srv/www/vhosts/ipresence/cache/api/dev && chmod 1777 /srv/www/vhosts/ipresence/cache/api/dev

## Install Xdebug
RUN pecl install xdebug
RUN mkdir /usr/local/xdebug
RUN cp $(find /usr/local/lib/php/extensions/ -name xdebug.so) /usr/local/xdebug/xdebug.so

RUN apt-get update && apt-get install -y \
        libmcrypt-dev \
        libicu-dev \
        libpq-dev \
        libbz2-dev \
        #php-pear \
        git \
        unzip \
        libzip-dev \
        mc \
        vim \
        wget \
        libevent-dev \
        librabbitmq-dev \
        libxslt-dev \
        gettext \
    && docker-php-ext-install iconv \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip \
    && docker-php-ext-install bz2 \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install intl \
    && docker-php-ext-install pgsql pdo pdo_pgsql \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install opcache \
    && docker-php-ext-enable  opcache \
    && docker-php-ext-install pcntl \
    && docker-php-ext-enable  pcntl \
    && docker-php-ext-enable  xdebug \
    && docker-php-ext-install xsl


# Install composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN cd / \
    && git clone https://github.com/nikic/php-ast.git \
    && cd php-ast \
    && phpize \
    && ./configure \
    && make install \
    && cd .. && rm -rf php-ast

RUN cd / \
    && git clone https://github.com/phan/phan.git \
    && cd phan \
    && composer install \
    && chmod a+x phan \
    && ln -s /phan/phan /usr/local/bin/phan



EXPOSE 9001
EXPOSE 9000
EXPOSE 22

 ## Set PHP running to allow persistent containers
 ## execute commands on persistent containers with
 ## docker exec container_name command flag1 flag2 value1 value2 ...
 CMD ["php-fpm"]
