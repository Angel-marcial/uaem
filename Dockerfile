FROM php:8.1-cli

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_pgsql pgsql gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar el directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos de la aplicación
COPY . .

# Establecer la variable de entorno para permitir superusuario en Composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# Instalar dependencias de Composer
RUN composer install

# Instalar la dependencia de Firebase para Laravel
RUN composer require kreait/laravel-firebase

# Publicar los archivos de configuración de Firebase para Laravel
RUN php artisan vendor:publish --provider="Kreait\Laravel\Firebase\ServiceProvider" --tag=config

# Establecer permisos adecuados
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto 8000
EXPOSE 8000

# Comando para ejecutar Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
