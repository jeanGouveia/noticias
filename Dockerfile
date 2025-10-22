FROM php:8.2-cli

WORKDIR /var/www/html

# Instala dependências
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip git unzip curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

# Instala dependências
RUN composer install --no-dev --optimize-autoloader --no-interaction

# CRIA DIRETÓRIOS DE STORAGE E DÁ PERMISSÃO
RUN mkdir -p storage/logs \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    && chown -R www-data:www-data storage \
    && chmod -R 775 storage

# Permissões gerais
RUN chown -R www-data:www-data /var/www/html

EXPOSE $PORT

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=$PORT"]
