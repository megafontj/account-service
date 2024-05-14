FROM php:8.2.11-fpm

# Install composer
RUN echo "Installing composer" \
    && cd /tmp \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Install system dependencies
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        apt-utils \
        nano \
        wget \
        dialog \
        vim \
        libzip-dev \
        zip \
        unzip \
        libpq-dev \
        libcurl4-openssl-dev \
        zlib1g-dev \
        libbz2-dev \
        locales \
        libmcrypt-dev \
        libicu-dev \
        libonig-dev \
        libxml2-dev \
        curl \
        git

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    curl \
    xml \
    zip \
    bz2 \
    intl \
    sockets

RUN apt-get install -y nodejs npm

# Set working directory
WORKDIR /var/www/html

CMD ["php-fpm"]