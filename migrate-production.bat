@echo off
echo Running migration and seeding for production database...

REM Set these environment variables before running:
REM set DB_CONNECTION=pgsql
REM set DB_HOST=your-production-host
REM set DB_PORT=5432
REM set DB_DATABASE=your-database
REM set DB_USERNAME=your-username
REM set DB_PASSWORD=your-password

set APP_ENV=production

echo Checking database connection...
php artisan migrate:status

echo Running migrations...
php artisan migrate --force

echo Running seeders...
php artisan db:seed --force

echo Production database setup completed!
pause
