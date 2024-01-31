# Use the official PHP 7.4 Apache base image
FROM php:7.4-apache

# Install PostgreSQL client and server, PDO extension
RUN apt-get update && apt-get install -y \
    libpq-dev \
    postgresql \
    postgresql-contrib \
    && docker-php-ext-install pdo pdo_pgsql

# Install cURL
RUN apt-get install -y libcurl4-openssl-dev \
    && docker-php-ext-install curl

# Copy application files into the container
COPY . /var/www/html

# Expose port 80
EXPOSE 80

# Start PostgreSQL service and Apache
CMD service postgresql start && apache2-foreground