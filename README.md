# Digital Library Website

Adalah sebuah situs perpusatkaan online yang saya kembangkan untuk memenuhi pre test dari perusahaan detik.com

Situs ini saya kembangkan dengan framework Laravel 10 dengan library tambahan seperti Tailwind CSS, Flowbite CSS, Vite, Laravel Breeze, dsb.

## Fitur-fitur yang tersedia

Situs ini memiliki fitur sebagai berikut:

1. **Login dan Register (Authentication Feature)** -> Sebuah fitur yang berguna untuk autentikasi data user dan sebagai jembatan antara "guest" (Non Authenticate User) dengan "admin & member" (Authenticate User).

2. **Search and Filter** -> Sebuah fitur yang berguna untuk analisa data dan sebagai tempat untuk me-manage data. Fitur ini tersedia hanya bagi "Authenticate User" saja.

3. **Export PDF** -> Sebuah fitur yang berguna untuk mengekspor data buku menjadi sebuah file PDF. Fitur ini tersedia hanya bagi "Authenticate User" saja.

4. **Action Master** -> Sebuah fitur basic CRUD (create, read, update, delete).

## Pembatasan Hak Akses

Pada beberapa route, terdapat Middleware (Peranti tengah) yang mengecek apakah role user yang telah terautentikasi adalah role tertentu atau tidak. 

## Role yang dimiliki

Pada situs ini saya membagi role menjadi dua bagian, yaitu admin dan member.

1. admin -> adalah role yang memiliki kemampuan create, view, edit, dan delete.

2. member -> adalah role yang memiliki kemampuan create, view, edit, dan delete.

namun, member tidak dapat mengakses beberapa route. role member disini lebih difokuskan pada pembuatan dan manage data buku serta kategori. Yang artinya role admin memiliki kendali penuh atas situs ini.


## Penggunaan

Sebelum menjalankan website secara lokal, terdapat kebutuhan yang perlu dilakukan, yaitu:

1. Lakukan perintah **composer install** pada terminal

```bash
composer install
```

2. Lakukan perintah **npm install** pada terminal

```bash
npm install
```

3. Periksa file .env dan lakukan konfigurasi. Pastikan data-data dibawah ini terisi dengan benar:

**(diutamakan)**
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=(nama database)
- DB_USERNAME=(username dari database)
- DB_PASSWORD=(password user)

**(optional)**
- APP_NAME="Your website name"
- APP_ENV=local
- APP_URL=http://localhost

**(optional)**
- DB_CONNECTION=pgsql
- DB_HOST=127.0.0.1
- DB_PORT=5432
- DB_DATABASE=(nama database)
- DB_USERNAME=(username dari database)
- DB_PASSWORD=(password user)

4. Pastikan untuk melakukan migrasi tabel dari laravel migration files ke database:

```bash
php artisan migrate
```

**NOTE**: Bila terdapat error, cek pada file **/storage/logs/laravel.log**

5. Lakukan seeding data dari file seeder:

```bash
php artisan db:seed
```

**NOTE**: Fungsi seed disini adalah untuk mempermudah agar kita dapat login tanpa harus melakukan register user baru. Untuk melihat data user yang telah di seed, silahkan cek file **/database/seeders/UserSeeder.php**

6. Aktifkan koneksi dengan database:

### Phpmyadmin
Untuk pengguna phpmyadmin dapat melakukan aktivasi sesuai perangkat yang dipakai.

Lalu, buatlah user baru di phpmyadmin, seperti berikut:

- username: digital_library
- password: (dapat mengikuti file .env atau buat baru)
- host: 127.0.0.1

### Postgresql
Jika memakai postgresql sebagai database utamanya, maka perlu menjalankan perintah (terminal):

```bash
psql -h 127.0.0.1 -d nama_database -U nama_username -p 5432
```

Lalu anda perlu memasukkan password yang sudah dibuatkan di file .env.example:

```bash
Password for user nama_username: 
```

### Pembuatan user baru di postgresql
**NOTE**: Untuk membuat user pada postgresql cukup mudah, berikut langkahnya:

- Lakukan perintah di terminal seperti berikut:

```bash
sudo -u postgres psql
```

lalu, lakukan perintah berikut:

```bash
CREATE USER [nama_username] WITH PASSWORD '[password]';
```

**NOTE**: Untuk username dan password bisa dilihat di file .env.example

### Penambahan privileges pada user yang telah dibuat

Setelah user baru selesai dibuat maka, lakukan perintah berikut:

```bash
sudo -u postgres psql
```

Lalu, lakukan perintah berikut:

```bash
ALTER USER [nama_username] WITH CREATEROLE CREATEDB;
```

**NOTE**: CREATEROLE dan CREATEDB adalah privileges yang berguna untuk memberikan hak penuh kepada user untuk dapat membuat ROLE baru dan DATABASE baru.

7. Lakukan pengetesan dengan menjalankan perintah berikut:

```bash
php artisan serve
```

serta,

```bash
npm run dev
```

**NOTE**: perintah **npm run dev** berguna untuk menjalankan library **Vite** karena projek ini menggunakan library seperti Tailwind CSS dan Flowbite CSS. Dengan perintah ini juga, perubahan tampilan dari sisi Front End menjadi lebih mudah.

8. Silahkan menjelajahi situs tersebut, pastikan untuk tetap logout setelah selesai menggunakan situs tersebut.

## Credits

My big thanks to all the open source libraries and framework I use:

- Laravel Framework:
https://laravel.com/

- Tailwind CSS library
https://tailwindcss.com/

- Flowbite Library
https://flowbite.com/

- DOMPdf Package
https://github.com/barryvdh/laravel-dompdf