FROM composer:latest

WORKDIR /src

# Будет игнорировать все ошибки зависимостей от окружения
ENTRYPOINT ["composer", "--ignore-platform-reqs"]