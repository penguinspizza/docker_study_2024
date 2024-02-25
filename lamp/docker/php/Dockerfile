# PHP8.2.6-apacheイメージをベースに使用
FROM php:8.2.6-apache

# set -x: デバッグ情報を出力する
RUN set -x && \
    apt-get update && \
    apt-get install -y libonig-dev && \
    docker-php-ext-install pdo_mysql mysqli mbstring