FROM ubuntu:14.04

ENV DEBIAN_FRONTEND noninteractive

# upgrade system
RUN apt-get update #&& apt-get upgrade -yq

# install
RUN apt-get install -yq \
    nginx \
    php5-cli php5-fpm \
    supervisor \
    acl \
    curl \
    php5-intl \
    php5-mysql \
    php5-sqlite \
    --no-install-recommends

RUN echo "daemon off;" >> /etc/nginx/nginx.conf

ADD etc/nginx/sites-available/symfony /etc/nginx/sites-available/default

ADD etc/supervisor/conf.d/*.conf /etc/supervisor/conf.d/

ADD etc/mysql/my.cnf /etc/mysql/my.cnf

RUN echo "date.timezone = Europe/Paris" >> /etc/php5/cli/php.ini
RUN echo "date.timezone = Europe/Paris" >> /etc/php5/fpm/php.ini

RUN mkdir /app
RUN mkdir /app/cache
RUN mkdir /app/logs
RUN mkdir /upload

RUN chown -R www-data:www-data /app
RUN chown -R www-data:www-data /upload

RUN ls -al /
RUN ls -al /app/cache
RUN ls -al /app/logs
RUN ls -al /upload

# Expose ports
EXPOSE 80
EXPOSE 443

CMD ["/usr/bin/supervisord"]
