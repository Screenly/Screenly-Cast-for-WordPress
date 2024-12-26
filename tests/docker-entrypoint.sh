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
    curl -o /tmp/wordpress.tar.gz "https://wordpress.org/wordpress-${WP_VERSION}.tar.gz"
    tar --strip-components=1 -zxmf /tmp/wordpress.tar.gz -C "$WP_CORE_DIR"
    rm /tmp/wordpress.tar.gz

    # Download test suite
    svn co --quiet https://develop.svn.wordpress.org/trunk/tests/phpunit/includes/ "$WP_TESTS_DIR/includes"
    svn co --quiet https://develop.svn.wordpress.org/trunk/tests/phpunit/data/ "$WP_TESTS_DIR/data"
    curl -o "$WP_TESTS_DIR/wp-tests-config.php" https://develop.svn.wordpress.org/trunk/wp-tests-config-sample.php

    # Configure test suite
    sed -i "s:dirname( __FILE__ ) . '/src/':'$WP_CORE_DIR/':" "$WP_TESTS_DIR/wp-tests-config.php"
    sed -i "s/youremptytestdbnamehere/wordpress_test/" "$WP_TESTS_DIR/wp-tests-config.php"
    sed -i "s/yourusernamehere/root/" "$WP_TESTS_DIR/wp-tests-config.php"
    sed -i "s/yourpasswordhere/wordpress/" "$WP_TESTS_DIR/wp-tests-config.php"
    sed -i "s|localhost|db-test|" "$WP_TESTS_DIR/wp-tests-config.php"
fi

echo "Running command: $@"
exec "$@"