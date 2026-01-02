# Dashboard Admin Modern - Sistem Les Privat Coding

## Deskripsi
Dashboard Admin modern telah dibuat dengan desain yang responsif dan palet warna yang profesional.

## Palet Warna
- **Biru Tua**: #111e3f (Sidebar navigation)
- **Putih**: #ffffff (Background utama dan cards)
- **Hijau Mint/Emerald**: #047857 (Ikon Total Pengajar)
- **Oranye Hangat**: #ea580c (Ikon Pembelian dan warning cards)
- **Ungu**: #7c3aed (Ikon Paket Aktif)
- **Biru**: #1e3a8a (Ikon Total Murid)

## Komponen Utama

### 1. Header (Putih)
- Tombol toggle sidebar untuk mobile
- Nama user dan informasi role
- Avatar dengan inisial

### 2. Sidebar (Biru Tua)
- Logo "Les Coding"
- Menu navigasi dengan ikon:
  - Dashboard
  - Manajemen Akun
  - Paket Belajar
  - Riwayat Pembelian
  - Jadwal Kursus
  - Riwayat Absensi

### 3. Halaman Utama - Dashboard
Struktur:
1. **Welcome Header** - Sapaan "Selamat datang di Sistem Les Privat Coding General"

2. **Statistik Cards (Grid 4 Kolom)**
   - Total Murid: 156 (Ikon Biru)
   - Total Pengajar: 24 (Ikon Hijau)
   - Paket Aktif: 89 (Ikon Ungu)
   - Pembelian Bulan Ini: 34 (Ikon Oranye)

3. **Pembelian Terbaru** (2/3 width)
   - Tabel dengan kolom: Murid, Paket, Tanggal, Status
   - Data contoh:
     - Ahmad Fauzi - React Intermediate - 02 Jan 2026 - Aktif
     - Siti Nurhaliza - Python Basics - 01 Jan 2026 - Aktif
     - Budi Santoso - JavaScript Pro - 31 Des 2025 - Aktif
     - Rini Wijaya - Web Development - 30 Des 2025 - Aktif

4. **Paket Mendekati Kadaluwarsa** (1/3 width)
   - Warning cards dengan border oranye
   - Data:
     - Rahman Hidayat - React Advanced - 2 pertemuan - 3 hari
     - Lisa Wijaya - JavaScript Basics - 1 pertemuan - 5 hari
     - Doni Sutrisno - Python Pro - 3 pertemuan - 7 hari

5. **Statistik Pertemuan Hari Ini**
   - Total Jadwal: 15 (Ikon Biru)
   - Selesai: 8 (Ikon Hijau)
   - Belum Dimulai: 7 (Ikon Abu-abu)

## File yang Dimodifikasi
1. `/resources/views/admin/dashboard.php` - Konten dashboard utama
2. `/resources/views/partials/topbar.php` - Header dengan styling putih
3. `/resources/views/partials/sidebar.php` - Sidebar dengan background biru tua (#111e3f)
4. `/public/css/style.css` - Tambahan CSS untuk warna dan styling komponen

## Responsive Design
- **Mobile**: Grid 1 kolom untuk cards
- **Tablet**: Grid 2 kolom untuk cards
- **Desktop**: Grid 4 kolom untuk stats cards, 2/3-1/3 split untuk pembelian & kadaluwarsa

## Feature
- Hover effects pada cards
- Transition smooth untuk interactive elements
- Color-coded status badges
- Professional shadow dan border styling
- SVG icons untuk statistik
