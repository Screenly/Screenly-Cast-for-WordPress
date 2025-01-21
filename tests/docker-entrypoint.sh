#!/bin/bash
set -e

echo "Testing MySQL connection..."
while ! mysqladmin ping -h db-test -u root -pwordpress --silent; do
    echo "Waiting for MySQL..."
    sleep 1
done
echo "MySQL connection successful"

# Create test database if it doesn't exist
mysql -h db-test -u root -pwordpress -e "CREATE DATABASE IF NOT EXISTS wordpress_test"

# Download and configure WordPress test suite
if [ ! -d "$WP_TESTS_DIR" ]; then
    echo "Setting up WordPress test suite..."
    mkdir -p "$WP_TESTS_DIR" "$WP_CORE_DIR"

    # Download WordPress
    if [[ $WP_VERSION == 'latest' ]]; then
        curl -O https://wordpress.org/latest.tar.gz
        tar --strip-components=1 -zxmf latest.tar.gz -C "$WP_CORE_DIR"
        rm latest.tar.gz
    else
        curl -O https://wordpress.org/wordpress-$WP_VERSION.tar.gz
        tar --strip-components=1 -zxmf wordpress-$WP_VERSION.tar.gz -C "$WP_CORE_DIR"
        rm wordpress-$WP_VERSION.tar.gz
    fi

    # Install WordPress test suite
    svn co --quiet https://develop.svn.wordpress.org/tags/$WP_VERSION/tests/phpunit/includes/ "$WP_TESTS_DIR/includes"
    svn co --quiet https://develop.svn.wordpress.org/tags/$WP_VERSION/tests/phpunit/data/ "$WP_TESTS_DIR/data"

    # Download wp-tests-config-sample.php from the appropriate version
    curl -o "$WP_TESTS_DIR/wp-tests-config.php" \
        https://develop.svn.wordpress.org/tags/$WP_VERSION/wp-tests-config-sample.php

    # Configure test suite
    sed -i "s:dirname( __FILE__ ) . '/src/':'$WP_CORE_DIR/':" "$WP_TESTS_DIR/wp-tests-config.php"
    sed -i "s/youremptytestdbnamehere/wordpress_test/" "$WP_TESTS_DIR/wp-tests-config.php"
    sed -i "s/yourusernamehere/root/" "$WP_TESTS_DIR/wp-tests-config.php"
    sed -i "s/yourpasswordhere/wordpress/" "$WP_TESTS_DIR/wp-tests-config.php"
    sed -i "s|localhost|db-test|" "$WP_TESTS_DIR/wp-tests-config.php"

    # Create wp-content directory
    mkdir -p "$WP_CORE_DIR/wp-content/plugins"
fi

# Install dependencies if they're not already installed
if [ ! -d "vendor" ]; then
    composer install --no-interaction
fi

echo "Running command: $@"
exec "$@"
