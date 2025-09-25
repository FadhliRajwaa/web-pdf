# Deploy Laravel Medical Report System ke Render

## Files yang Dibuat untuk Deployment

1. **Dockerfile** - Konfigurasi container PHP 8.2 dengan Apache
2. **apache-config.conf** - Konfigurasi Apache untuk Laravel
3. **startup.sh** - Script startup untuk inisialisasi aplikasi
4. **.dockerignore** - Files yang diabaikan saat build
5. **.env.production** - Template environment variables
6. **render.yaml** - Konfigurasi Render deployment

## Langkah-langkah Deploy ke Render

### 1. Persiapan Repository
```bash
# Pastikan semua files sudah dicommit ke Git
git add .
git commit -m "Add deployment configuration"
git push origin main
```

### 2. Setup di Render Dashboard

1. Login ke [Render.com](https://render.com)
2. Click "New" → "Web Service"
3. Connect repository GitHub Anda
4. Pilih repository project ini

### 3. Konfigurasi Web Service

**Build & Deploy:**
- **Environment**: `Docker`
- **Dockerfile Path**: `./Dockerfile`
- **Build Command**: (kosongkan, sudah ada di Dockerfile)
- **Start Command**: `/usr/local/bin/startup.sh`

### 4. Environment Variables

Set environment variables berikut di Render dashboard:

```
APP_NAME=Sistem Laporan Medis
APP_ENV=production
APP_DEBUG=false
APP_KEY=(akan di-generate otomatis)
APP_URL=https://your-app-name.onrender.com

# Database (jika menggunakan external DB)
DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password

# Atau gunakan DATABASE_URL format
DATABASE_URL=mysql://user:password@host:port/database
```

### 5. Setup Database

**Option 1: Render PostgreSQL (Recommended)**
1. Create PostgreSQL database di Render
2. Update `DB_CONNECTION=pgsql` di environment variables
3. Install pdo_pgsql di Dockerfile jika perlu

**Option 2: External MySQL**
1. Gunakan MySQL hosting (PlanetScale, Railway, dll)
2. Set DB credentials di environment variables

### 6. Build dan Deploy

1. Click "Create Web Service"
2. Render akan:
   - Build Docker image
   - Run migrations
   - Deploy aplikasi
   - Provide URL public

### 7. Post-Deploy Tasks

Setelah deploy berhasil, jalankan via Render shell:

```bash
# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Clear caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link
```

## Troubleshooting

### Common Issues:

1. **Build Failed**: Check Dockerfile syntax dan dependencies
2. **Database Connection**: Verify DATABASE_URL atau DB credentials
3. **File Permissions**: Startup script handles storage permissions
4. **Static Assets**: Vite build included in Dockerfile

### Logs:
```bash
# Check logs di Render dashboard atau via CLI
render logs --service=your-service-name
```

## Production Optimizations

- ✅ PHP OPcache enabled
- ✅ Laravel config/route/view caching
- ✅ Apache mod_rewrite for clean URLs
- ✅ Security headers configured
- ✅ Storage directory permissions
- ✅ Asset compilation with Vite

## Domain Setup

1. Di Render dashboard, go to Settings
2. Add custom domain
3. Configure DNS CNAME pointing to Render URL
4. SSL certificate auto-generated

Aplikasi akan tersedia di: `https://your-app-name.onrender.com`
