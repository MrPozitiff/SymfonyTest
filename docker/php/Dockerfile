FROM php:7.2-fpm

RUN apt-get update && \
    apt-get -y install \
        uchardet \
        software-properties-common \
        zlib1g-dev \
        git \
        libmagickwand-dev --no-install-recommends \
        wget && \

    pecl install imagick &&  \
    docker-php-ext-enable imagick && \

    useradd -ms /bin/bash php-fpm && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --quiet && \
    rm composer-setup.php && \
    mv composer.phar /usr/local/bin/composer && \
    rm -rf /var/lib/{apt,dpkg,cache,log}/

RUN docker-php-ext-install bcmath zip pdo_mysql xml intl

EXPOSE 9000
