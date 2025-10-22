FROM php:8.2-cli

WORKDIR /var/www/html

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    unzip \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copia Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia o código
COPY . .

# === INSTALA DEPENDÊNCIAS DO COMPOSER ===
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Permissões
RUN chown -R www-data:www-data /var/www/html

# Expõe porta
EXPOSE 8000

# Start com $PORT do Railway
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
