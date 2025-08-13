# Panduan Deployment Laravel Dashboard Fingerprint

## Informasi Hosting
- **Domain**: afms.my.id
- **Dashboard Hosting**: https://dnva.me/go.
- **Provider**: DomaiNesia

## Langkah-langkah Deployment

### 1. Persiapan File

#### A. Compress Project
1. Buat file ZIP dari seluruh project (kecuali folder `node_modules` jika ada)
2. Pastikan file `.env.example` sudah ada
3. Exclude folder berikut saat compress:
   - `node_modules/`
   - `storage/logs/*.log`
   - `.git/`

#### B. File yang Harus Ada
- ✅ `.env.example`
- ✅ `composer.json`
- ✅ `artisan`
- ✅ Semua folder: `app/`, `config/`, `database/`, `public/`, `resources/`, `routes/`, `storage/`

### 2. Upload ke Hosting

1. **Login ke Dashboard Hosting**: https://dnva.me/go.
2. **Masuk ke File Manager** atau gunakan FTP
3. **Upload file ZIP** ke folder `public_html/`
4. **Extract file ZIP** di dalam `public_html/`

### 3. Konfigurasi Environment

#### A. Setup File .env
1. Copy `.env.example` menjadi `.env`
2. Edit file `.env` dengan konfigurasi hosting:

```env
APP_NAME="Dashboard Fingerprint"
APP_ENV=production
APP_KEY=base64:bB4M/qU7J0bq/E08w0K7CDo4D8V61eHu54bfuoEU2ZQ=
APP_DEBUG=false
APP_URL=https://afms.my.id

LOG_CHANNEL=stack
LOG_LEVEL=error

# Database Configuration (sesuaikan dengan hosting)
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nama_database_hosting
DB_USERNAME=username_database_hosting
DB_PASSWORD=password_database_hosting

SESSION_DRIVER=database
SESSION_LIFETIME=120

CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

#### B. Generate Application Key (jika diperlukan)
Jika APP_KEY kosong, jalankan:
```bash
php artisan key:generate
```

### 4. Setup Database

#### A. Buat Database di Hosting
1. Login ke cPanel/Dashboard hosting
2. Buat database MySQL baru
3. Buat user database dan berikan privileges
4. Catat nama database, username, dan password

#### B. Import Database
1. Export database dari local: `dashboard_fingerprint`
2. Import ke database hosting melalui phpMyAdmin
3. Atau jalankan migration:
```bash
php artisan migrate --force
php artisan db:seed --force
```

### 5. Set Permissions

Set permission folder berikut:
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod -R 644 .env
```

### 6. Konfigurasi Web Server

#### A. Document Root
Pastikan document root mengarah ke folder `public/`

#### B. .htaccess (untuk Apache)
File `.htaccess` sudah ada di folder `public/`

#### C. Nginx Configuration (jika menggunakan Nginx)
```nginx
server {
    listen 80;
    server_name afms.my.id;
    root /path/to/your/project/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 7. Optimisasi untuk Production

Jalankan command berikut di hosting:

```bash
# Install dependencies
composer install --optimize-autoloader --no-dev

# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Clear application cache
php artisan cache:clear
```

### 8. Testing

1. **Akses website**: https://afms.my.id
2. **Test login admin**:
   - Email: admin@example.com
   - Password: password
3. **Test fitur utama**:
   - Dashboard
   - Manajemen Pegawai
   - Absensi
   - Laporan

### 9. Troubleshooting

#### A. Error 500
- Cek file `.env` sudah benar
- Cek permission folder `storage/` dan `bootstrap/cache/`
- Cek log error di `storage/logs/laravel.log`

#### B. Database Connection Error
- Pastikan konfigurasi database di `.env` benar
- Test koneksi database

#### C. Asset Not Loading
- Pastikan document root mengarah ke folder `public/`
- Cek file `.htaccess`

### 10. Maintenance

#### A. Backup Database
Buat backup database secara berkala

#### B. Update Application
1. Backup database dan files
2. Upload file baru
3. Jalankan migration jika ada
4. Clear cache

#### C. Monitor Logs
Cek log error secara berkala di `storage/logs/`

## Kontak Support

- **Hosting Support**: DomaiNesia.com
- **Dashboard**: https://dnva.me/go.

---

**Catatan**: Pastikan PHP version di hosting minimal 8.2 dan extension yang diperlukan sudah terinstall (MySQL, OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, Fileinfo).