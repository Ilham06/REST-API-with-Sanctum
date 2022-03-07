REST API Data Mahasiswa sederhana dengan Sanctum Authentication.
Case dari Database Mata Kuliah Sistem Basis Data.

- CRUD Mahasiswa.
- Input Nilai Mata Kuliah (Pivot).
- Validasi.

Cara Install

Clone Repo
Install Composer (Composer Install)
Setup env
Generate Key (php artisan key:generate)
Buat Database
Migrate dan Jalankan seeder
Jalankan Server

Endpoint
- api/login : login.

- api/ : data seluruh mahasiswa.
- api/create : tambah data mahasiswa, form input(nama,nim,semester).
- api/update/{id} : update data mahasiswa, form input(nama,nim,semester).
- api/show/{id} : detail data mahasiswa.
- api/{id} : hapus data mahasiswa.

- api/khs/create : tambah nilai, form input(id_mahasiswa,id_mk,periode,semester,nilai).
- api/khs/update/{id} : update nilai, form input(id_mk,periode,semester,nilai)
- api/khs/delete/{id} : hapus data nilai.

