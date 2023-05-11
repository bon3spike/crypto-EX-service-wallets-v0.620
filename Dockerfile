#syntax=docker/dockerfile:1.4

# The different stages of this Dockerfile are meant to be built into separate images
# https://docs.docker.com/develop/develop-images/multistage-build/#stop-at-a-specific-build-stage
# https://docs.docker.com/compose/compose-file/#target

# Prod image

##############################################################
##############################################################
##############################################################
#################### BACKEND IMAGE ###########################
##############################################################
##############################################################
##############################################################
FROM php:8.2-cli-alpine AS php_back

ENV APP_ENV=prod

WORKDIR /srv/app

# php extensions installer: https://github.com/mlocati/docker-php-extension-installer
COPY --from=mlocati/php-extension-installer --link /usr/bin/install-php-extensions /usr/local/bin/

# persistent / runtime deps
RUN apk add --no-cache \
		acl \
		file \
		gettext \
		git \
    	make \
    	ffmpeg \
	;

RUN set -eux; \
    install-php-extensions \
    	mcrypt \
    	intl \
    	zip \
    	apcu \
		opcache \
    	exif \
    	sockets \
    	gd \
    	mbstring \
    	bcmath \
    	calendar\
    	pcntl \
    	grpc \
    	protobuf \
    	redis \
    	uuid \
    	yaml \
    	pdo_mysql \
    ;

COPY --from=composer/composer:2-bin --link /composer /usr/bin/composer

# prevent the reinstallation of vendors at every changes in the source code
COPY composer.* ./
RUN set -eux; \
    if [ -f composer.json ]; then \
		composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress; \
		composer clear-cache; \
    fi

# copy sources
COPY --link  . .
RUN rm -Rf docker/

RUN set -eux; \
	mkdir -p var/cache var/log; \
    if [ -f composer.json ]; then \
		composer dump-autoload --classmap-authoritative --no-dev; \
		composer run-script --no-dev post-install-cmd; \
		chmod +x bin/console; sync; \
    fi

###> recipes ###
###< recipes ###


COPY --from=composer/composer:2-bin --link /composer /usr/bin/composer

# prevent the reinstallation of vendors at every changes in the source code
COPY composer.* ./
RUN set -eux; \
    if [ -f composer.json ]; then \
		composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress; \
		composer clear-cache; \
    fi

# copy sources
COPY --link  . .
RUN rm -Rf docker/

RUN set -eux; \
	#mkdir -p var/cache var/log; \
    if [ -f composer.json ]; then \
		composer dump-autoload --classmap-authoritative --no-dev; \
		composer run-script --no-dev post-install-cmd; \
		chmod +x bin/console; sync; \
    fi

COPY --from=ghcr.io/roadrunner-server/roadrunner:2.12.1 /usr/bin/rr /usr/local/bin/rr

RUN chmod +x /usr/local/bin/rr


# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"

COPY --from=composer/composer:2-bin --link /composer /usr/bin/composer

# prevent the reinstallation of vendors at every changes in the source code
COPY composer.* ./
RUN set -eux; \
    if [ -f composer.json ]; then \
		composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress; \
		composer clear-cache; \
    fi

# copy sources
COPY --link  . .
RUN rm -Rf docker/

RUN set -eux; \
	#mkdir -p var/cache var/log; \
    if [ -f composer.json ]; then \
		composer dump-autoload --classmap-authoritative --no-dev; \
		composer run-script --no-dev post-install-cmd; \
		chmod +x bin/console; sync; \
    fi

# Install Temporal CLI
COPY --from=temporalio/admin-tools /usr/local/bin/tctl /usr/local/bin/tctl
# Setup RoadRunner
COPY docker/wait-for-temporal.sh /srv/wait-for-temporal.sh
RUN chmod +x /srv/wait-for-temporal.sh
