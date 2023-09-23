# php:5.6-apacheベースのイメージを使用
FROM php:5.6-apache

# 必要なPHP拡張をインストール
RUN docker-php-ext-install pdo pdo_mysql

# Apacheのmod_rewriteを有効化
RUN a2enmod rewrite

# .htaccessの使用を許可するためのApache設定変更
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# アプリケーションのファイルをコンテナにコピー
COPY src/ /var/www/html/

# Apacheのドキュメントルートを変更
ENV APACHE_DOCUMENT_ROOT /var/www/html/src/webroot

# PHPのタイムゾーン設定
RUN echo "date.timezone=Asia/Tokyo" > /usr/local/etc/php/conf.d/timezone.ini

# DebianのaptリポジトリのURLをアーカイブ版に変更し、stretch-updatesを削除
RUN sed -i -e 's/deb.debian.org/archive.debian.org/g' \
           -e 's|security.debian.org|archive.debian.org/|g' \
           -e '/stretch-updates/d' /etc/apt/sources.list

# 必要なツールと拡張のインストール (zip, unzip, git)
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \
 && docker-php-ext-install zip

# Composerのインストール
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
