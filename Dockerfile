FROM php:8.2.28-cli

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY . /var/www

RUN php artisan key:generate
RUN composer install

RUN apt-get update
RUN apt-get -y install nodejs npm
RUN npm install
RUN npm run build

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

EXPOSE 8000
CMD ["php","artisan","serve","--host=0.0.0.0"]