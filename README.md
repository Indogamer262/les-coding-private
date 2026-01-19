# Les Coding Private

## Anggota Kelompok :
* 2472008 - Christian Anthony Hermawan
* 2472029 - Henry Ferdynand Budiana
* 2472042 - Gavin Malik Setiawan

## Specifciation : 
* PHP 8.2.12
* MySQL 8.0.32

## Cara menjalankan di localhost

1. Extract arsip .zip

2. Buka XAMPP dan jalankan mysql dan apache

3. Jalankan phpMyAdmin di http://localhost/phpmyadmin

4. Buat database baru dengan nama "les_coding"

5. Import database les_coding.sql dari folder SQL ke phpmyadmin

6. Konfirguasi kredensial servername, username dan password MySQL server di util/dbLesCoding.php, sesuaikan kredensial sesuai dengan user MySQL pada server

7. Buka terminal dan masuk ke "Prod" ini.

8. Jalankan server PHP built-in:

	php -S localhost:8000 -t .

9. Buka di browser:

	http://localhost:8000/

## Cara menjalankan di server

1. Extract arsip .zip lalu pindahkan isi folder prod ke root folder PHP server

2. Jika belum, aktifkan server PHP, beserta server MySQL, aplikasi seperti XAMPP menyediakan kedua ini.

3. Buka di browser:
* Jika belum import SQL, gunakan phpmyadmin untuk import file .sql pada database dengan nama les_coding yang tersedia di dalam arsip

* Konfirguasi kredensial MySQL server di util/dbLesCoding.php, sesuaikan kredensial sesuai dengan user MySQL pada server

* Sesuaikan dengan IP address/url server di server 