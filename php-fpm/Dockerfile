FROM php:7.2.9-fpm

RUN apt-get update && apt-get install -y libssl-dev zlib1g-dev git zip libzip-dev libpng-dev
RUN pecl install xdebug-2.6.0
RUN docker-php-ext-install bcmath
RUN docker-php-ext-configure gd
RUN docker-php-ext-enable xdebug bcmath

RUN echo 'xdebug.remote_port=9000' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_enable=1' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_connect_back=1' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.profiler_enable=0' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.profiler_output_dir=/var/www/html/profile' >> /usr/local/etc/php/php.ini
RUN echo 'upload_max_filesize = 10M' >> /usr/local/etc/php/php.ini
RUN echo 'post_max_size = 10M' >> /usr/local/etc/php/php.ini