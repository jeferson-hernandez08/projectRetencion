# -------------------------------
# Etapa 1: Construcción de dependencias con Composer
# -------------------------------
FROM php:8.2-cli AS composer_builder

# Instalar herramientas necesarias + dependencias para GD y ZIP
RUN apt-get update && apt-get install -y \
    unzip git curl libpng-dev libjpeg-dev libfreetype6-dev libzip-dev

# Instalar extensiones GD y ZIP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip

# ✅ Habilitar extensión ZIP explícitamente
RUN docker-php-ext-enable zip

# Instalar Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar archivos de Composer y ejecutar instalación
WORKDIR /app
COPY composer.json composer.lock* ./

# ✅ Importante: ignorar comprobación de plataforma en Composer (por seguridad extra)
RUN composer install --no-interaction --no-progress --prefer-dist --ignore-platform-req=ext-zip

# -------------------------------
# Etapa 2: Imagen final con Apache + PHP
# -------------------------------
FROM php:8.2-apache

# Instalar dependencias necesarias del sistema (PostgreSQL + ZIP + GD)
RUN apt-get update && apt-get install -y \
    libpq-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev unzip git

# Instalar extensiones necesarias
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql zip gd

# Habilitar mod_rewrite (muy importante para rutas dinámicas)
RUN a2enmod rewrite

# Copiar dependencias desde la etapa anterior
COPY --from=composer_builder /app/vendor /var/www/html/vendor

# Copiar todo el código de la aplicación al contenedor
COPY . /var/www/html/

# Establecer el directorio público (donde está tu index.php)
WORKDIR /var/www/html/public

# Configurar Apache para permitir .htaccess
RUN echo "<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" > /etc/apache2/conf-available/app.conf \
    && a2enconf app

# Exponer el puerto 80
EXPOSE 80

# Comando por defecto de inicio
CMD ["apache2-foreground"]
