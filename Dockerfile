# Laravel本番環境向けDockerfile

FROM php:8.3-fpm

# 必要なパッケージをインストール
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Composerインストール
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ作成
WORKDIR /var/www

# Laravelコードをコピー
COPY . .

# vendor ディレクトリ作成（composer install）
RUN composer install --no-dev --optimize-autoloader

# Laravel設定
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# パーミッション
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www/storage

EXPOSE 9000
CMD ["php-fpm"]

# Nginx のインストール
RUN apt-get update && apt-get install -y nginx

# Nginx の設定ファイルをコピー
COPY nginx/default.conf /etc/nginx/sites-available/default