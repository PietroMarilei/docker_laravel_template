ARG PHP_VERSION
# ARG COMPOSER_VERSION

FROM ${PHP_VERSION}

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN apt-get update -y \
    && apt-get install -y libmariadb-dev \ 
    git curl libmcrypt-dev default-mysql-client \ 
    iputils-ping iproute2 net-tools zlib1g-dev \
    zip libzip-dev libpng-dev \ 
    && docker-php-ext-install mysqli \ 
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install zip gd \
    && docker-php-ext-enable mysqli zip

RUN install-php-extensions xdebug

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

RUN chmod +x /usr/local/bin/composer

COPY ./conf/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/

RUN a2enmod proxy proxy_http rewrite
RUN a2ensite 000-default.conf
RUN service apache2 restart

WORKDIR /var/www/html

### Laravel permissions
# RUN chown -R www-data:www-data /var/www/html/bootstrap/cache
# RUN chown -R www-data:www-data /var/www/html/storage/logs/laravel.log
# RUN chown -R www-data:www-data /var/www/html/storage/framework/

### VTiger Permissions
# RUN chown -R www-data:www-data /var/www/html/storage

EXPOSE 8000