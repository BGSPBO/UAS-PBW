# Dockerfile untuk Laravel di Render.com

# Gunakan image PHP dengan Apache
FROM php:8.2-apache

# Install dependency sistem
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Aktifkan mod_rewrite Apache
RUN a2enmod rewrite

# Copy file Laravel ke /var/www/html
COPY . /var/www/html

# Set direktori kerja
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependency Laravel
RUN composer install --no-dev --optimize-autoloader

# Set permission
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

# Jalankan Apache
CMD ["apache2-foreground"]
