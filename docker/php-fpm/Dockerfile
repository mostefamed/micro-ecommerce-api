FROM php:8.1-fpm-alpine

RUN apk update && apk add \
    bash \
    git \
    vim \
    nano
RUN curl -sSLf \
        -o /usr/local/bin/install-php-extensions \
        https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions && \
    chmod +x /usr/local/bin/install-php-extensions && \
install-php-extensions mcrypt mongodb @composer

WORKDIR /app

COPY docker-entrypoint.sh /docker-entrypoint.sh

RUN chmod +x /docker-entrypoint.sh

ENTRYPOINT ["/docker-entrypoint.sh","php-fpm","-F"]

EXPOSE 9000