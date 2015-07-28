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
    acl \
    curl \
    php5-intl \
    php5-mysql \
    php5-sqlite \
    --no-install-recommends

# requirements for symfony app
RUN echo "date.timezone = Europe/Paris" >> /etc/php5/cli/php.ini
RUN echo "date.timezone = Europe/Paris" >> /etc/php5/fpm/php.ini

RUN mkdir /app
RUN mkdir /app/cache
RUN mkdir /app/logs

RUN sudo chown -R www-data:www-data /app/cache
RUN sudo chown -R www-data:www-data /app/logs

ADD app/console /app/console

RUN sudo chown www-data:www-data /app/console

#RUN HTTPDUSER=`ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
#RUN sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX /app/cache /app/logs
#RUN sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX /app/cache /app/logs

RUN ls -al /app/cache
RUN ls -al /app/logs

#ADD . /intent-backend

#WORKDIR /intent-backend
#VOLUME /intent-backend
