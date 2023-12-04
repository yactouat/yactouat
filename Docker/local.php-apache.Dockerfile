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

# XDebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# dev PHP conf (display errors, XDebug, etc.)
COPY ./Docker/conf/php-dev.ini /usr/local/etc/php/conf.d/php-dev.ini
RUN echo "\n" >> /usr/local/etc/php/conf.d/php-dev.ini
# ! this file won't exist if you don't build the stack with `sh ./start.sh`
COPY ./Docker/conf/.local_ip /tmp/.local_ip
RUN echo "xdebug.client_host=$(cat /tmp/.local_ip)" >> /usr/local/etc/php/conf.d/php-dev.ini

# copy Apache virtual host
COPY ./Docker/conf/apache.conf /etc/apache2/sites-available/000-default.conf

# enabling Apache mod rewrite
RUN a2enmod rewrite

# cleaning up
RUN apt-get autoremove -y && apt-get clean && rm -rf /var/lib/apt/lists/*

# create system user ("yactouat" with uid 1000) 
RUN useradd -G www-data,root -u 1000 -d /home/yactouat yactouat
RUN mkdir -p /home/yactouat/ && chown -R yactouat:yactouat /home/yactouat

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
RUN php composer.phar install
RUN rm composer.phar

# running Apache as non-root user `yactouat`
CMD ["bash", "-c", "sleep 10 && php artisan migrate:fresh --force && php artisan db:seed --force && php ./scripts/clear-cache.php && apache2-foreground"]
