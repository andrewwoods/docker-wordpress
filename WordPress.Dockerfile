FROM wordpress:6.9-php8.3

# WORKDIR /tmp
# RUN curl https://getcomposer.org/download/latest-stable/composer.phar --output composer.phar --silent && \
#  chmod a+x composer.phar && \
#  mv composer.phar /usr/local/bin/composer;

WORKDIR /usr/src/wordpress

RUN set -eux; \
	ln -s wp-config-docker.php /var/www/html/wp-config.php;
