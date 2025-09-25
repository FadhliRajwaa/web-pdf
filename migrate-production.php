<?php

// Set production environment variables
// You need to set these environment variables before running this script:
// DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD

putenv('APP_ENV=production');

// Check if required environment variables are set
$required_vars = ['DB_CONNECTION', 'DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD'];
foreach ($required_vars as $var) {
    if (!getenv($var)) {
        echo "Error: Environment variable $var is not set\n";
        echo "Please set all required database environment variables before running this script.\n";
        exit(1);
    }
}

echo "=== Production Database Migration & Seeding ===\n";
echo "Host: " . getenv('DB_HOST') . "\n";
echo "Database: " . getenv('DB_DATABASE') . "\n\n";

// Check database connection
echo "1. Checking database connection...\n";
$output = shell_exec('php artisan migrate:status 2>&1');
echo $output . "\n";

// Run migrations
echo "2. Running migrations...\n";
$output = shell_exec('php artisan migrate --force 2>&1');
echo $output . "\n";

// Run seeders
echo "3. Running seeders...\n";
$output = shell_exec('php artisan db:seed --force 2>&1');
echo $output . "\n";

echo "Production database setup completed!\n";
