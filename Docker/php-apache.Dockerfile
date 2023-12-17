FROM php:8.2-apache

# Install system dependencies required for Composer
RUN apt-get update && apt-get upgrade -y && apt-get install -y \
    curl \
    git \
    libpq-dev \
    unzip \
    zip

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
  && docker-php-ext-install pgsql pdo_pgsql

# Configure PHP for production
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# configure PHP for Cloud Run and containerized environments
RUN docker-php-ext-install -j "$(nproc)" opcache
# specific ini options for Cloud Run and opcache
RUN set -ex; \
  { \
    echo "; Cloud Run enforces memory & timeouts"; \
    echo "memory_limit = -1"; \
    echo "max_execution_time = 0"; \
    echo "; File upload at Cloud Run network limit"; \
    echo "upload_max_filesize = 32M"; \
    echo "post_max_size = 32M"; \
    echo "; Configure Opcache for Containers"; \
    echo "opcache.enable = On"; \
    echo "opcache.validate_timestamps = Off"; \
    echo "; Configure Opcache Memory (Application-specific)"; \
    echo "opcache.memory_consumption = 32"; \
  } > "$PHP_INI_DIR/conf.d/cloud-run.ini"



# copy Apache virtual host
COPY ./Docker/conf/apache.conf /etc/apache2/sites-available/000-default.conf

# enabling Apache mod rewrite
RUN a2enmod rewrite

# cleaning up
RUN apt-get autoremove -y && apt-get clean && rm -rf /var/lib/apt/lists/*

# create system user ("yactouat" with uid 1000) 
RUN useradd -G www-data,root -u 1000 -d /home/yactouat yactouat
RUN mkdir -p /home/yactouat/ && chown -R yactouat:yactouat /home/yactouat

# downloading webp
RUN wget https://storage.googleapis.com/downloads.webmproject.org/releases/webp/libwebp-1.3.2-linux-x86-64.tar.gz \
    && tar -xzf libwebp-1.3.2-linux-x86-64.tar.gz \
    && cp libwebp-1.3.2-linux-x86-64/bin/dwebp /usr/local/bin/dwebp \
    && cp libwebp-1.3.2-linux-x86-64/bin/cwebp /usr/local/bin/cwebp \
    && rm -rf libwebp-1.3.2-linux-x86-64 \
    && rm libwebp-1.3.2-linux-x86-64.tar.gz

# changing user 
USER yactouat

# copy existing application directory with the right permissions
COPY --chown=yactouat:yactouat . /var/www/html

# going to app' directory inside container
WORKDIR /var/www/html

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN php composer.phar install --no-dev
RUN rm composer.phar

# running migrations and Apache as non-root user `yactouat`
CMD ["bash", "-c", "php artisan migrate --force && php artisan db:seed --force && php ./scripts/clear-cache.php && apache2-foreground"]
