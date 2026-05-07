# P-Link (Internal Link Shortener)

Aplikasi pemendek URL (link shortener) sederhana yang dirancang khusus untuk kebutuhan internal instansi menggunakan domain sendiri. Aplikasi ini mengutamakan keamanan dengan membatasi akses hanya bagi pengguna yang emailnya telah didaftarkan oleh Administrator.

## 🎯 Tujuan Proyek
- Menyediakan layanan pemendek URL mandiri (self-hosted) untuk menjaga kedaulatan data instansi.
- Memudahkan distribusi link internal dengan *custom slug* yang mudah diingat.
- Integrasi Single Sign-On (SSO) menggunakan akun Google resmi instansi.
- Pembuatan QR Code otomatis untuk kebutuhan media cetak/display.

## 🛠️ Stack Teknologi
- **Framework:** Laravel 12
- **Starter Kit:** Laravel Breeze (Blade + Tailwind CSS)
- **Database:** MySQL
- **Authentication:** Laravel Socialite (Google OAuth 2.0)
- **Tools:** Simple QR Code (Generator)

## 🔄 Tahapan yang Telah Dilalui
- [x] **Inisiasi Proyek:** Instalasi Laravel 12 dan konfigurasi environment.
- [x] **Skema Database:** Pembuatan migrasi untuk tabel `users` (dengan field `google_id`, `avatar`, `is_admin`) dan tabel `links` (dengan field `original_url`, `slug`, `clicks`).
- [x] **Autentikasi Dasar:** Instalasi Laravel Breeze dan konfigurasi aset via Vite.
- [x] **Integrasi Google OAuth:** Setup Laravel Socialite dan pembuatan `SocialiteController`.
- [x] **Keamanan Login:** Implementasi logika login terbatas (hanya email terdaftar yang bisa masuk).
- [x] **Middleware:** Pembuatan `AdminMiddleware` untuk proteksi rute khusus administrator.

## 🚀 Tahapan yang Akan Dilakukan
- [ ] **Manajemen User (Admin):**
    - Pembuatan CRUD User (Index, Create, Delete).
    - Halaman untuk mendaftarkan email pegawai agar bisa login.
- [ ] **Manajemen Link:**
    - Form pembuatan link dengan input *custom slug*.
    - Validasi slug unik dan pencegahan penggunaan *reserved words*.
    - Integrasi generator QR Code pada tabel daftar link.
- [ ] **Dashboard & Statistik:**
    - Implementasi filter data (Admin melihat semua, Pengguna melihat milik sendiri).
    - Pencatatan jumlah klik (Counter) setiap kali shortlink diakses.
- [ ] **Logic Redirect:**
    - Pembuatan routing utama untuk menangani pengalihan link dari `domain.com/slug` ke target URL.
- [ ] **Finalisasi UI/UX:**
    - Penyesuaian navigasi berdasarkan role.
    - Pembersihan tampilan dashboard agar minimalis dan elegan.

---
*Dibuat untuk kebutuhan sistem informasi internal instansi.*