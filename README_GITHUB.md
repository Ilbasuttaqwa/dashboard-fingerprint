# Dashboard Fingerprint - Sistem Absensi Fingerprint

![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.3-blue.svg)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange.svg)
![License](https://img.shields.io/badge/License-MIT-green.svg)

## 📋 Deskripsi

Dashboard Fingerprint adalah sistem manajemen absensi berbasis web yang terintegrasi dengan perangkat fingerprint. Sistem ini dirancang untuk memudahkan pengelolaan absensi karyawan dengan fitur-fitur modern dan antarmuka yang user-friendly.

## ✨ Fitur Utama

### 👨‍💼 Admin Dashboard
- **Manajemen Pegawai**: CRUD data pegawai lengkap
- **Manajemen Jabatan**: Pengaturan jabatan dan gaji
- **Sistem Absensi**: Monitoring absensi real-time
- **Laporan**: Export data absensi ke Excel
- **Penggajian**: Kalkulasi gaji otomatis
- **Manajemen Cabang**: Multi-cabang support
- **Jadwal Kerja**: Pengaturan shift kerja
- **Pengaturan Libur**: Manajemen hari libur

### 👤 User Dashboard
- **Profil Pegawai**: Lihat dan edit profil
- **Riwayat Absensi**: Tracking kehadiran
- **Slip Gaji**: Download slip gaji
- **Pengajuan Izin**: Submit izin/sakit

### 🔧 Integrasi Fingerprint
- **Real-time Sync**: Sinkronisasi data fingerprint
- **Multi-device Support**: Mendukung berbagai merek fingerprint
- **Automatic Processing**: Proses absensi otomatis

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 10.x
- **Frontend**: Bootstrap 5, jQuery
- **Database**: MySQL 8.0
- **Authentication**: Laravel Sanctum
- **Export**: Laravel Excel
- **Charts**: Chart.js
- **Icons**: Font Awesome

## 📦 Instalasi

### Prasyarat
- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js & NPM (opsional)

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/username/dashboard-fingerprint.git
   cd dashboard-fingerprint
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Setup Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database**
   Edit file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=dashboard_fingerprint
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Migrasi Database**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Setup Storage**
   ```bash
   php artisan storage:link
   ```

7. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   ```

   Akses aplikasi di: `http://localhost:8000`

## 🚀 Deployment

Untuk deployment ke production, gunakan script yang telah disediakan:

### Windows (PowerShell)
```powershell
.\deploy.ps1
```

### Linux/Mac (Bash)
```bash
./deploy.sh
```

Atau ikuti panduan lengkap di:
- [DEPLOYMENT_GUIDE.md](DEPLOYMENT_GUIDE.md)
- [DEPLOYMENT_CHECKLIST.md](DEPLOYMENT_CHECKLIST.md)
- [README_DEPLOYMENT.md](README_DEPLOYMENT.md)

## 👥 Default Login

### Admin
- **Email**: admin@gmail.com
- **Password**: password

### User Demo
- **Email**: user@gmail.com
- **Password**: password

## 📁 Struktur Project

```
dashboard-fingerprint/
├── app/
│   ├── Http/Controllers/     # Controllers
│   ├── Models/              # Eloquent Models
│   └── Services/            # Business Logic
├── database/
│   ├── migrations/          # Database Migrations
│   └── seeders/            # Database Seeders
├── resources/
│   └── views/              # Blade Templates
├── public/                 # Public Assets
├── storage/               # File Storage
└── routes/                # Route Definitions
```

## 🔧 Konfigurasi Fingerprint

Untuk mengintegrasikan dengan perangkat fingerprint:

1. Pastikan perangkat fingerprint terhubung ke jaringan
2. Konfigurasi IP dan port perangkat di admin panel
3. Sinkronisasi data pegawai ke perangkat
4. Test koneksi dan sinkronisasi data

Panduan lengkap: [FINGERPRINT_INTEGRATION.md](FINGERPRINT_INTEGRATION.md)

## 📊 Fitur Laporan

- **Laporan Harian**: Absensi per hari
- **Laporan Bulanan**: Rekap bulanan
- **Laporan Pegawai**: Per individu
- **Export Excel**: Download laporan
- **Grafik Statistik**: Visualisasi data

## 🛡️ Keamanan

- **Authentication**: Multi-level user access
- **Authorization**: Role-based permissions
- **CSRF Protection**: Laravel built-in protection
- **SQL Injection Prevention**: Eloquent ORM
- **XSS Protection**: Blade templating

## 🤝 Kontribusi

1. Fork repository ini
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📝 License

Project ini menggunakan [MIT License](LICENSE).

## 📞 Support

Jika Anda memiliki pertanyaan atau membutuhkan bantuan:

- **Email**: support@example.com
- **Issues**: [GitHub Issues](https://github.com/username/dashboard-fingerprint/issues)
- **Documentation**: [Wiki](https://github.com/username/dashboard-fingerprint/wiki)

## 🙏 Acknowledgments

- Laravel Framework
- Bootstrap CSS Framework
- Font Awesome Icons
- Chart.js Library
- Semua kontributor yang telah membantu

---

**Dashboard Fingerprint** - Solusi modern untuk manajemen absensi perusahaan Anda! 🚀