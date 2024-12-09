# Use Ubuntu 12.04 as it's the last version that supports PHP 5.3
FROM ubuntu:12.04

# Add old releases repository since 12.04 is EOL
RUN sed -i -e 's/archive.ubuntu.com\|security.ubuntu.com/old-releases.ubuntu.com/g' /etc/apt/sources.list

# Install PHP 5.3 and required extensions
RUN apt-get update && apt-get install -y \
    php5-cli \
    php5-mysql \
    php5-curl \
    php5-dev \
    mysql-client \
    subversion \
    wget \
    build-essential \
    && rm -rf /var/lib/apt/lists/*

# Install Xdebug 2.2.7 (last version compatible with PHP 5.3)
RUN wget http://xdebug.org/files/xdebug-2.2.7.tgz && \
    tar -xvzf xdebug-2.2.7.tgz && \
    cd xdebug-2.2.7 && \
    phpize && \
    ./configure && \
    make && \
    cp modules/xdebug.so /usr/lib/php5/20090626/ && \
    echo "zend_extension=/usr/lib/php5/20090626/xdebug.so" > /etc/php5/cli/conf.d/20-xdebug.ini && \
    cd .. && \
    rm -rf xdebug-2.2.7*

# Install PHPUnit 4.8 globally (compatible with PHP 5.3)
RUN wget https://phar.phpunit.de/phpunit-4.8.phar && \
    chmod +x phpunit-4.8.phar && \
    mv phpunit-4.8.phar /usr/local/bin/phpunit

# Set up WordPress test environment
ENV WP_TESTS_DIR=/tmp/wordpress-tests-lib \
    WP_CORE_DIR=/tmp/wordpress

# Download WordPress
RUN mkdir -p $WP_CORE_DIR && \
    wget -nv -O /tmp/wordpress.tar.gz http://wordpress.org/wordpress-4.4.tar.gz && \
    tar --strip-components=1 -zxmf /tmp/wordpress.tar.gz -C $WP_CORE_DIR && \
    rm /tmp/wordpress.tar.gz && \
    wget -nv -O $WP_CORE_DIR/wp-content/db.php http://raw.github.com/markoheijnen/wp-mysqli/master/db.php

# Install WordPress test suite
RUN mkdir -p $WP_TESTS_DIR && \
    svn co --quiet http://develop.svn.wordpress.org/branches/4.4/tests/phpunit/includes/ $WP_TESTS_DIR/includes && \
    svn co --quiet http://develop.svn.wordpress.org/branches/4.4/tests/phpunit/data/ $WP_TESTS_DIR/data && \
    wget -nv -O $WP_TESTS_DIR/wp-tests-config.php http://develop.svn.wordpress.org/branches/4.4/wp-tests-config-sample.php && \
    sed -i "s:dirname( __FILE__ ) . '/src/':'$WP_CORE_DIR/':" "$WP_TESTS_DIR"/wp-tests-config.php && \
    sed -i "s/youremptytestdbnamehere/wordpress_test/" "$WP_TESTS_DIR"/wp-tests-config.php && \
    sed -i "s/yourusernamehere/root/" "$WP_TESTS_DIR"/wp-tests-config.php && \
    sed -i "s/yourpasswordhere/wordpress/" "$WP_TESTS_DIR"/wp-tests-config.php && \
    sed -i "s|localhost|db-test|" "$WP_TESTS_DIR"/wp-tests-config.php

# Set working directory
WORKDIR /var/www/html/wp-content/plugins/screenly-cast-root

# Create entrypoint script
RUN echo '#!/bin/bash\n\
echo "Testing MySQL connection..."\n\
while ! mysql -h db-test -u root -pwordpress -e "SELECT 1" >/dev/null 2>&1; do\n\
  echo "Waiting for MySQL..."\n\
  sleep 1\n\
done\n\
echo "MySQL connection successful"\n\
mysql -h db-test -u root -pwordpress -e "CREATE DATABASE IF NOT EXISTS wordpress_test"\n\
cd /var/www/html/wp-content/plugins/screenly-cast-root\n\
phpunit --coverage-text --colors=never --coverage-php /tmp/coverage.php "$@" && \\\n\
echo "Coverage JSON:" && \\\n\
php -r "\$coverage = unserialize(file_get_contents(\"/tmp/coverage.php\")); \$json = array(); \
foreach (\$coverage->getTests() as \$test) { \
  \$json[\"tests\"][] = array(\"name\" => \$test->getName(), \"size\" => \$test->getSize()); \
} \
\$json[\"summary\"] = array( \
  \"classes\" => \$coverage->getNumTestedClassesAndTraits() . \"/\" . \$coverage->getNumClassesAndTraits(), \
  \"methods\" => \$coverage->getNumTestedMethods() . \"/\" . \$coverage->getNumMethods(), \
  \"lines\" => \$coverage->getNumExecutedLines() . \"/\" . \$coverage->getNumExecutableLines() \
); \
echo json_encode(\$json, JSON_PRETTY_PRINT);"' > /usr/local/bin/run-tests.sh && \
    chmod +x /usr/local/bin/run-tests.sh

# Default command
CMD ["/usr/local/bin/run-tests.sh"]