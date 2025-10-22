# Mude de php:8.2-fpm para php:8.2-cli
FROM php:8.2-cli

WORKDIR /var/www/html

# Instala dependências
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

# Copia código
COPY . .

# Permissões
RUN chown -R www-data:www-data /var/www/html

# Expõe porta (opcional)
EXPOSE 8000

# Start command: usa $PORT do Railway
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
