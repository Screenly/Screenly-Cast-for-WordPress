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
    curl \
    && docker-php-ext-install zip mysqli pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html/wp-content/plugins/screenly-cast

# Copy the entire plugin first
COPY . .

# Configure git to trust the directory and install dependencies
RUN git config --global --add safe.directory /var/www/html/wp-content/plugins/screenly-cast

# Copy test files
COPY tests/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["vendor/bin/phpunit"]
