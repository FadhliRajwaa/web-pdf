#!/bin/bash

echo "Starting Laravel application setup..."

# Wait for database to be ready if using external database
if [ ! -z "$DATABASE_URL" ]; then
    echo "Waiting for database connection..."
    php artisan migrate --force
fi

# Generate application key if not exists
php artisan key:generate --no-interaction

# Clear and cache config for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage symlink if not exists
php artisan storage:link || true

# Set proper permissions
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache

echo "Laravel application setup completed!"

# Start Apache in foreground
apache2-foreground
