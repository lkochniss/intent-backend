FROM ubuntu

# upgrade system
RUN apt-get update && apt-get upgrade -yq

# install part1
RUN apt-get install -yq \
    nginx \
    php5-cli php5-fpm \
    supervisor \
    --no-install-recommends

# Append "daemon off;" to the beginning of the configuration
RUN echo "daemon off;" >> /etc/nginx/nginx.conf

# Expose ports
EXPOSE 80
EXPOSE 443

# add symfony vhost
ADD etc/nginx/sites-available/symfony /etc/nginx/sites-available/default

# add supervisor configs
ADD etc/supervisor/conf.d/*.conf /etc/supervisor/conf.d/

CMD ["/usr/bin/supervisord"]

# install part2
RUN apt-get install -yq \
    curl \
    php5-intl \
    php5-mysql \
    php5-sqlite \
    --no-install-recommends

# requirements for symfony app
RUN echo "date.timezone = Europe/Paris" >> /etc/php5/cli/php.ini
RUN echo "date.timezone = Europe/Paris" >> /etc/php5/fpm/php.ini

#CMD php -S 0.0.0.0:80 -t /intent-backend
