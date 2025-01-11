# php_salsabilaputrf

## Catatan:
Dalam pengerjaan soal ini, karena menggunakan XAMPP sebagai server lokal, perlu dilakukan penyesuaian konfigurasi root folder Apache agar dapat menjalankan file proyek yang disimpan di luar direktori default `C:\xampp\htdocs`.

## Soal 2

### Penambahan Tombol **Reset**

Pada tampilan No.4 (tampilan akhir), saya menambahkan tombol **Reset**. Fungsi dari tombol **Reset** ini adalah untuk menghapus semua data yang telah disimpan dalam session, sehingga form dapat diisi kembali dari awal.

Tombol **Reset** akan memanggil fungsi berikut:
- `session_unset()` untuk menghapus data yang tersimpan dalam session.
- `session_destroy()` untuk menghancurkan session.

Dengan menggunakan tombol **Reset**, status aplikasi akan kembali ke langkah pertama, memungkinkan pengguna untuk mulai mengisi form dari awal.

## Soal 3

### Penggunaan **MySQLi dengan Parameter Binding**

Pada Soal 3, saya menggunakan **MySQLi dengan Parameter Binding** sebagai metode yang lebih aman dibandingkan dengan **Dynamic Query** dalam menangani input dari pengguna. Dengan **Parameter Binding**, data yang dimasukkan oleh pengguna tidak langsung disisipkan ke dalam query, melainkan diikat terlebih dahulu melalui `bind_param()`, yang mengurangi potensi risiko **SQL Injection**. Hal ini memastikan bahwa query yang dijalankan tetap aman meskipun input pengguna mengandung karakter khusus. Sebaliknya, pada **Dynamic Query**, input pengguna langsung dimasukkan ke dalam query string, yang membuka peluang terjadinya **SQL Injection** jika tidak ada validasi yang ketat terhadap input yang diterima.

