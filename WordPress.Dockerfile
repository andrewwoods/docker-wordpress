FROM wordpress:6.9-php8.3

WORKDIR /usr/src/wordpress

RUN set -eux; \
	ln -s wp-config-docker.php /var/www/html/wp-config.php;
