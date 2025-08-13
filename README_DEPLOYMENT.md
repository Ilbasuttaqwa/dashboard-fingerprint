# 🚀 Quick Deployment Guide - Dashboard Fingerprint

## 📋 Informasi Hosting
- **Domain**: afms.my.id
- **Dashboard**: https://dnva.me/go.
- **Provider**: DomaiNesia

## ⚡ Quick Start (5 Menit)

### 1. Persiapan File
```bash
# Buat ZIP dari project (exclude node_modules, .git)
zip -r dashboard-fingerprint.zip . -x "node_modules/*" ".git/*" "storage/logs/*.log"
```

### 2. Upload & Extract
1. Login ke https://dnva.me/go.
2. Upload `dashboard-fingerprint.zip` ke `public_html/`
3. Extract file di hosting

### 3. Konfigurasi Database
```env
# Edit file .env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://afms.my.id

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_pass
```

### 4. Setup Database
1. Buat database MySQL di cPanel
2. Import database atau jalankan:
```bash
php artisan migrate --force
php artisan db:seed --force
```

### 5. Set Permissions
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

### 6. Cache & Optimize
```bash
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🔧 Script Otomatis

Gunakan script deployment otomatis:
```bash
# Upload deploy.sh ke hosting dan jalankan
chmod +x deploy.sh
./deploy.sh
```

## 🧪 Testing

1. **Akses**: https://afms.my.id
2. **Login Admin**:
   - Email: admin@example.com
   - Password: password

## 📁 File Penting

- ✅ `.env` - Konfigurasi production
- ✅ `public/.htaccess` - Web server config
- ✅ `DEPLOYMENT_GUIDE.md` - Panduan lengkap
- ✅ `deploy.sh` - Script otomatis

## 🆘 Troubleshooting

| Error | Solusi |
|-------|--------|
| 500 Error | Cek `.env` dan permissions |
| Database Error | Cek konfigurasi DB di `.env` |
| Assets 404 | Pastikan document root ke `public/` |
| HTTPS Issues | Uncomment HTTPS redirect di `.htaccess` |

## 📞 Support

- **Hosting**: DomaiNesia.com
- **Dashboard**: https://dnva.me/go.

---

**🎯 Target**: Website live dalam 5-10 menit!

**📋 Checklist Deployment**:
- [ ] File uploaded & extracted
- [ ] Database created & configured
- [ ] .env file configured
- [ ] Permissions set
- [ ] Cache optimized
- [ ] Website accessible
- [ ] Login tested
- [ ] Features working

**🔥 Pro Tips**:
- Backup database sebelum deploy
- Test di subdomain dulu
- Monitor error logs setelah deploy
- Setup SSL certificate
- Enable HTTPS redirect setelah SSL aktif