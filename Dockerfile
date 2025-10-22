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

# CRIA STORAGE COM PERMISSÃO ROOT
RUN mkdir -p \
    storage/logs \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
    && chown -R root:root storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# MIGRAÇÕES AUTOMÁTICAS
RUN php artisan migrate --force || echo "Migrações falharam, mas continuando..."

# Start com $PORT
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=$PORT"]
