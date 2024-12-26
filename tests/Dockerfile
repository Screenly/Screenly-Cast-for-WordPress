ARG PHP_VERSION=7.4
FROM php:${PHP_VERSION}-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    default-mysql-client \
    && docker-php-ext-install zip mysqli pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html/wp-content/plugins/screenly-cast

# Copy composer files
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --prefer-dist --no-progress

# Copy the rest of the application
COPY . .

# Set up entrypoint
COPY tests/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["composer", "test"]