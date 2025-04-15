FROM laravelphp/php-fpm:8.0

# サーバーの設定
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    curl \
    sudo \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql \
    && groupadd --force -g ${WWWGROUP:-1000} sail  

# 作業ディレクトリ設定
WORKDIR /var/www/html

# Composerインストール
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# サーバーが起動したときに実行するコマンド
CMD ["php-fpm"]
