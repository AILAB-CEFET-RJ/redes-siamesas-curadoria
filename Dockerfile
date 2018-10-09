FROM nimmis/apache:14.04

# disable interactive functions
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && \
apt-get install -y php5 libapache2-mod-php5  \
php5-fpm php5-cli php5-mysqlnd php5-pgsql php5-sqlite php5-redis \
php5-apcu php5-intl php5-imagick php5-mcrypt php5-json php5-gd php5-curl && \
php5enmod mcrypt && \
rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

VOLUME ./www:/var/www/html