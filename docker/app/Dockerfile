FROM php:8.1.1-fpm

# Copy from php.ini-production and set up php.ini
#RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini && \
#  sed -i -e 's/max_execution_time = 30/max_execution_time = 3600/' /usr/local/etc/php/php.ini && \
#  sed -i -e 's/memory_limit = 128M/memory_limit = 512M/' /usr/local/etc/php/php.ini && \
#  sed -i -e 's/post_max_size = 8M/post_max_size = 64M/' /usr/local/etc/php/php.ini && \
#  sed -i -e 's/upload_max_filesize = 2M/upload_max_filesize = 8M/' /usr/local/etc/php/php.ini

RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      git && \
      docker-php-ext-install pdo_mysql && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY php.ini /usr/local/etc/php/conf.d/php.ini

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

WORKDIR /var/www
