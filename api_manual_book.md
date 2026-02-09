# Buku Panduan API Backend

Dokumen ini menjelaskan cara menggunakan API yang telah dibuat untuk aplikasi Anda.

## 1. Autentikasi (Login)

Semua operasi **Create**, **Update**, dan **Delete** membutuhkan autentikasi menggunakan **Bearer Token**. Operasi **Read** (GET) bersifat publik.

### Login
- **Endpoint**: `POST /api/login`
- **Body**:
  ```json
  {
    "email": "admin@example.com",
    "password": "password"
  }
  ```
- **Response**:
  ```json
  {
    "message": "Login successful",
    "token": "1|laravel_sanctum_token_string...",
    "user": { ... }
  }
  ```
> **PENTING**: Simpan `token` yang didapat dari respon ini. Anda harus mengirimkannya di header setiap request yang membutuhkan login.

### Menggunakan Token
Tambahkan header berikut pada request Anda:
`Authorization: Bearer <token_anda>`

## 2. Daftar Endpoint

Berikut adalah daftar endpoint yang tersedia. Ganti `{{baseUrl}}` dengan URL aplikasi Anda (misal: `http://localhost:8000`).

### Profile (Sambutan, Sejarah, dll)
- **GET** `{{baseUrl}}/api/profiles`
  - Filter by type: `{{baseUrl}}/api/profiles?type=sambutan`
- **GET** `{{baseUrl}}/api/profiles/{id}`
- **POST** `{{baseUrl}}/api/profiles` (Butuh Token)
- **PUT** `{{baseUrl}}/api/profiles/{id}` (Butuh Token)
- **DELETE** `{{baseUrl}}/api/profiles/{id}` (Butuh Token)

### Kejuruan (Jurusan)
- **GET** `{{baseUrl}}/api/kejuruans`
- **GET** `{{baseUrl}}/api/kejuruans/{id}`
- **POST** `{{baseUrl}}/api/kejuruans` (Butuh Token)
- **PUT** `{{baseUrl}}/api/kejuruans/{id}` (Butuh Token)
- **DELETE** `{{baseUrl}}/api/kejuruans/{id}` (Butuh Token)

### Berita (News)
- **GET** `{{baseUrl}}/api/news`
- **GET** `{{baseUrl}}/api/news/{id}`
- **POST** `{{baseUrl}}/api/news` (Butuh Token)
- **PUT** `{{baseUrl}}/api/news/{id}` (Butuh Token)
- **DELETE** `{{baseUrl}}/api/news/{id}` (Butuh Token)

### Galeri
- **GET** `{{baseUrl}}/api/galleries`
- **GET** `{{baseUrl}}/api/galleries/{id}`
- **POST** `{{baseUrl}}/api/galleries` (Butuh Token)
- **PUT** `{{baseUrl}}/api/galleries/{id}` (Butuh Token)
- **DELETE** `{{baseUrl}}/api/galleries/{id}` (Butuh Token)

### Prestasi (Achievements)
- **GET** `{{baseUrl}}/api/achievements`
- **GET** `{{baseUrl}}/api/achievements/{id}`
- **POST** `{{baseUrl}}/api/achievements` (Butuh Token)
- **PUT** `{{baseUrl}}/api/achievements/{id}` (Butuh Token)
- **DELETE** `{{baseUrl}}/api/achievements/{id}` (Butuh Token)

### Slider
- **GET** `{{baseUrl}}/api/sliders`
- **GET** `{{baseUrl}}/api/sliders/{id}`
- **POST** `{{baseUrl}}/api/sliders` (Butuh Token)
- **PUT** `{{baseUrl}}/api/sliders/{id}` (Butuh Token)
- **DELETE** `{{baseUrl}}/api/sliders/{id}` (Butuh Token)

### Pesan (Inbox)
- **POST** `{{baseUrl}}/api/inbox`
  - Endpoint ini **PUBLIK** (tidak butuh token) agar pengunjung bisa mengirim pesan.

## 3. Contoh Payload (JSON) untuk Input Data

Berikut adalah contoh format JSON yang harus dikirimkan pada **Body** request saat melakukan `POST` (Create) atau `PUT` (Update).

### A. Profile (Sambutan Kepala Sekolah)
**Endpoint**: `POST /api/profiles`
```json
{
    "title": "Sambutan Kepala Sekolah",
    "type": "sambutan",
    "content": "<p>Selamat datang di website kami...</p>",
    "extras": null
}
```

### B. Profile (Mitra Industri)
**Endpoint**: `POST /api/profiles`
```json
{
    "title": "PT. Astra Honda Motor",
    "type": "mitra",
    "content": "Mitra strategis dalam pengembangan kurikulum TSM.",
    "extras": {
        "link": "https://www.astra-honda.com"
    }
}
```

### C. Kejuruan (Jurusan)
**Endpoint**: `POST /api/kejuruans`
```json
{
    "nama": "Teknik Komputer dan Jaringan",
    "slug": "tkj",
    "deskripsi": "Jurusan yang mempelajari jaringan komputer...",
    "visi_misi": "Menjadi jurusan unggulan...",
    "ikon": "heroicon-o-cpu-chip",
    "extras": {
        "kepala_jurusan": "Budi Santoso, S.Kom"
    }
}
```

### D. Berita (News)
**Endpoint**: `POST /api/news`
```json
{
    "title": "Siswa Kami Juara 1 LKS Provinsi",
    "slug": "siswa-kami-juara-1-lks-provinsi",
    "content": "<p>Alhamdulillah siswa kami berhasil meraih...</p>",
    "status": "published"
}
```

### E. Galeri Foto
**Endpoint**: `POST /api/galleries`
```json
{
    "title": "Kegiatan Upacara Bendera",
    "description": "Dokumentasi upacara hari senin tanggal 12 Januari 2026"
}
```

### F. Prestasi (Achievement)
**Endpoint**: `POST /api/achievements`
```json
{
    "title": "Juara 1 Lomba Web Design",
    "winner_name": "Ahmad Dani",
    "rank": "Juara 1",
    "level": "provinsi",
    "date_achieved": "2026-01-10",
    "description": "Lomba diadakan di Universitas Indonesia..."
}
```

### G. Slider (Banner Depan)
**Endpoint**: `POST /api/sliders`
```json
{
    "title": "PPDB Tahun Ajaran 2026/2027 Telah Dibuka!",
    "subtitle": "Segera daftarkan diri anda sekarang juga.",
    "link": "https://ppdb.sekolah.sch.id",
    "is_active": true
}
```

### H. Kirim Pesan (Inbox)
**Endpoint**: `POST /api/inbox`
```json
{
    "name": "Orang Tua Siswa",
    "email": "ortu@example.com",
    "subject": "Pertanyaan tentang PPDB",
    "message": "Halo admin, kapan jadwal tes masuk dimulai?"
}
```

## 4. Tips Pengujian
Gunakan aplikasi seperti **Postman** atau **Insomnia** untuk menguji API ini.
1. Lakukan **Login** terlebih dahulu untuk mendapatkan Token.
2. Pada tab **Authorization**, pilih tipe **Bearer Token** dan masukkan token yang didapat.
3. Pada tab **Body**, pilih **raw** dan format **JSON**.
4. Masukkan contoh JSON di atas sesuai fitur yang ingin dites.
