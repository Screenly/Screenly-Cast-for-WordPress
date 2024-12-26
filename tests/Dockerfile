ARG PHP_VERSION=7.4
FROM php:${PHP_VERSION}-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    default-mysql-client \
    libxml2-utils \
    subversion \
    && docker-php-ext-install zip mysqli

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html/wp-content/plugins/screenly-cast

# Copy the entire plugin first
COPY . .

# Configure git to trust the directory and install dependencies
RUN git config --global --add safe.directory /var/www/html/wp-content/plugins/screenly-cast \
    && composer install --prefer-dist --no-interaction --no-progress

# Copy test files
COPY tests/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["composer", "test"]