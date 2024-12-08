# Use Ubuntu 12.04 as it's the last version that supports PHP 5.3
FROM ubuntu:12.04

# Add old releases repository since 12.04 is EOL
RUN sed -i -e 's/archive.ubuntu.com\|security.ubuntu.com/old-releases.ubuntu.com/g' /etc/apt/sources.list

# Install PHP 5.3 and required extensions
RUN apt-get update && apt-get install -y \
    php5-cli \
    php5-mysql \
    php5-curl \
    mysql-client \
    subversion \
    wget \
    && rm -rf /var/lib/apt/lists/*

# Install PHPUnit 4.8 globally (compatible with PHP 5.3)
RUN wget https://phar.phpunit.de/phpunit-4.8.phar && \
    chmod +x phpunit-4.8.phar && \
    mv phpunit-4.8.phar /usr/local/bin/phpunit

# Set working directory
WORKDIR /var/www/html/wp-content/plugins/screenly-cast

# Install WordPress test suite
COPY bin/install-wp-tests.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/install-wp-tests.sh

# Create entrypoint script
RUN echo '#!/bin/bash\n\
/usr/local/bin/install-wp-tests.sh wordpress_test root wordpress db-test 4.4\n\
cd /var/www/html/wp-content/plugins/screenly-cast\n\
exec phpunit "$@"' > /usr/local/bin/run-tests.sh && \
    chmod +x /usr/local/bin/run-tests.sh

# Default command
CMD ["/usr/local/bin/run-tests.sh"]