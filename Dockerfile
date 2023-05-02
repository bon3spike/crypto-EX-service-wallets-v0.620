FROM php:8.2-cli-alpine AS php_back

RUN apk update && apk add --no-cache \
  nano \
  bash \
  libzip-dev \
  unzip \
  oniguruma-dev

# Install PHP Extensions
ENV CFLAGS="$CFLAGS -D_GNU_SOURCE"
RUN docker-php-ext-install zip \
  && docker-php-ext-install opcache sockets mbstring \
  && docker-php-ext-enable opcache sockets mbstring

# Protobuf and GRPC
ENV PROTOBUF_VERSION "3.19.2"
RUN pecl channel-update pecl.php.net
RUN pecl install protobuf-${PROTOBUF_VERSION} grpc \
    && docker-php-ext-enable protobuf grpc

# Install Temporal CLI
COPY --from=temporalio/admin-tools /usr/local/bin/tctl /usr/local/bin/tctl

# Install Composer
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

WORKDIR /srv/app

# Wait for Temporal service to start up
COPY /docker/wait-for-temporal.sh /usr/local/bin
RUN chmod +x /usr/local/bin/wait-for-temporal.sh

RUN composer install

# Setup RoadRunner
RUN vendor/bin/rr get --no-interaction \
    && mv rr /usr/local/bin/rr \
    && chmod +x /usr/local/bin/rr