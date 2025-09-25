#!/bin/bash

echo "Starting Laravel application setup..."

# Wait for database to be ready
echo "Waiting for database connection..."
max_attempts=30
attempt=1

while [ $attempt -le $max_attempts ]; do
    echo "Database connection attempt $attempt/$max_attempts"
    if php artisan migrate:status --no-interaction > /dev/null 2>&1; then
        echo "Database connection established!"
        break
    fi
    if [ $attempt -eq $max_attempts ]; then
        echo "Database connection failed after $max_attempts attempts"
        exit 1
    fi
    sleep 2
    attempt=$((attempt + 1))
done

# Run migrations
echo "Running database migrations..."
php artisan migrate --force --no-interaction

# Generate application key if not exists
php artisan key:generate --no-interaction

# Clear and cache config for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage symlink if not exists (ignore if already exists)
php artisan storage:link 2>/dev/null || echo "Storage link already exists"

# Set proper permissions
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache

echo "Laravel application setup completed!"

# Start Apache in foreground
apache2-foreground
