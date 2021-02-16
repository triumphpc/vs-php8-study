FROM php:8-cli-alpine

# Переопределеяем настройки jit
COPY /docker/php/opcache.ini /usr/local/etc/php/conf.d/

WORKDIR /src

# копирует все из src в текущую рабочую директорию
COPY /src .

ENTRYPOINT ["php", "vendor/bin/phpunit", "."]