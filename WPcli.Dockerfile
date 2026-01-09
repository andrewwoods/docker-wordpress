FROM wordpress:cli
WORKDIR /var/www/html

RUN wp package install runcommand/media-sizes
