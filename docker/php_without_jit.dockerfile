FROM php:8-cli-alpine

WORKDIR /src

# копирует все из src в текущую рабочую директорию
COPY /src .

ENTRYPOINT ["php", "vendor/bin/phpunit", "."]