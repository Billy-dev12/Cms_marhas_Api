# 📚 Dokumentasi API - SMK Marhas CMS

> **Base URL**: `http://localhost:8000/api`

## 📑 Daftar Isi

1. [Autentikasi](#autentikasi)
2. [Profile Sekolah](#profile-sekolah)
3. [Kejuruan (Jurusan)](#kejuruan-jurusan)
4. [Berita (News)](#berita-news)
5. [Galeri](#galeri)
6. [Prestasi (Achievement)](#prestasi-achievement)
7. [Slider](#slider)
8. [Inbox (Kontak)](#inbox-kontak)
9. [Media Upload](#media-upload)
10. [Error Handling](#error-handling)

---

## 🔐 Autentikasi

API ini menggunakan **Laravel Sanctum** untuk autentikasi. Endpoint yang dilindungi memerlukan Bearer Token.

### Login

**POST** `/login`

**Request Body:**
```json
{
  "email": "admin@example.com",
  "password": "password123"
}
```

**Response (200 OK):**
```json
{
  "message": "Login successful",
  "token": "1|abc123xyz...",
  "user": {
    "id": 1,
    "name": "Admin",
    "email": "admin@example.com"
  }
}
```

**Response (401 Unauthorized):**
```json
{
  "message": "Invalid credentials"
}
```

---

### Logout

**POST** `/logout` 🔒 *(Requires Authentication)*

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200 OK):**
```json
{
  "message": "Logged out successfully"
}
```

---

### Get Current User

**GET** `/user` 🔒 *(Requires Authentication)*

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200 OK):**
```json
{
  "id": 1,
  "name": "Admin",
  "email": "admin@example.com"
}
```

---

## 🏫 Profile Sekolah

### Get All Profiles

**GET** `/profile`

**Query Parameters:**
- [type](file:///e:/FILE%20BACKUP/Jawa%20pkl/Pkl%20day%209/PKL%20day%201/app/Http/Controllers/Api/ProfileController.php#22-28) (optional): Filter berdasarkan tipe profil
  - Nilai yang valid: `sambutan`, `sejarah`, `visi_misi`, `sarana`, `kurikulum`, `kontak`, `profil`, `struktur`, `ekstrakurikuler`, `mitra`

**Example:**
```
GET /profile?type=sambutan
```

**Response (200 OK):**
```json
[
  {
    "id": 1,
    "title": "Sambutan Kepala Sekolah",
    "type": "sambutan",
    "content": "<p>Selamat datang...</p>",
    "extras": null,
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z",
    "image": {
      "id": 1,
      "mediable_type": "App\\Models\\Profile",
      "mediable_id": 1,
      "file_path": "profiles/abc123.jpg"
    }
  }
]
```

---

### Get Profile Types

**GET** `/profile/tipe`

**Response (200 OK):**
```json
[
  "sambutan",
  "sejarah",
  "visi_misi",
  "profil"
]
```

---

### Get Single Profile

**GET** `/profile/{id}`

**Response (200 OK):**
```json
{
  "id": 1,
  "title": "Sambutan Kepala Sekolah",
  "type": "sambutan",
  "content": "<p>Selamat datang...</p>",
  "extras": null,
  "image": {
    "id": 1,
    "file_path": "profiles/abc123.jpg"
  }
}
```

**Response (404 Not Found):**
```json
{
  "message": "Data tidak ditemukan."
}
```

---

### Create Profile

**POST** `/profile` 🔒 *(Requires Authentication)*

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
title: Sambutan Kepala Sekolah
type: sambutan
content: <p>Selamat datang di SMK Marhas...</p>
extras[key]: value (optional, JSON array)
image: [file] (optional, max 2MB)
```

**Response (201 Created):**
```json
{
  "message": "Profile created successfully",
  "data": {
    "id": 1,
    "title": "Sambutan Kepala Sekolah",
    "type": "sambutan",
    "content": "<p>Selamat datang...</p>",
    "extras": null,
    "image": {
      "id": 1,
      "file_path": "profiles/abc123.jpg"
    }
  }
}
```

---

### Update Profile

**PUT** `/profile/{id}` 🔒 *(Requires Authentication)*

> **⚠️ Catatan Penting**: Untuk upload file dengan method PUT, gunakan **POST** dengan parameter `_method=PUT`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
_method: PUT
title: Sambutan Kepala Sekolah (Updated)
content: <p>Konten baru...</p>
image: [file] (optional)
```

**Response (200 OK):**
```json
{
  "message": "Profile updated successfully",
  "data": {
    "id": 1,
    "title": "Sambutan Kepala Sekolah (Updated)",
    "type": "sambutan",
    "content": "<p>Konten baru...</p>",
    "image": {
      "id": 1,
      "file_path": "profiles/new123.jpg"
    }
  }
}
```

---

### Delete Profile

**DELETE** `/profile/{id}` 🔒 *(Requires Authentication)*

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200 OK):**
```json
{
  "message": "Profile deleted successfully"
}
```

---

## 🎓 Kejuruan (Jurusan)

### Get All Kejuruan

**GET** `/jurusan`

**Response (200 OK):**
```json
[
  {
    "id": 1,
    "nama": "Teknik Komputer dan Jaringan",
    "slug": "tkj",
    "deskripsi": "Jurusan yang mempelajari...",
    "visi_misi": "Visi: Menjadi...",
    "ikon": "jurusan-icons/icon.png",
    "extras": null,
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z",
    "media": [
      {
        "id": 1,
        "file_path": "kejuruans/image.jpg"
      }
    ]
  }
]
```

---

### Get Single Kejuruan

**GET** `/jurusan/{id}`

**Response (200 OK):**
```json
{
  "id": 1,
  "nama": "Teknik Komputer dan Jaringan",
  "slug": "tkj",
  "deskripsi": "Jurusan yang mempelajari...",
  "visi_misi": "Visi: Menjadi...",
  "ikon": "jurusan-icons/icon.png",
  "media": [
    {
      "id": 1,
      "file_path": "kejuruans/image.jpg"
    }
  ]
}
```

---

### Create Kejuruan

**POST** `/jurusan` 🔒 *(Requires Authentication)*

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
nama: Teknik Komputer dan Jaringan
slug: tkj
deskripsi: Jurusan yang mempelajari...
visi_misi: Visi: Menjadi... (optional)
ikon: [file] (optional, max 1MB)
image: [file] (optional, max 2MB)
extras[key]: value (optional)
```

**Response (201 Created):**
```json
{
  "message": "Kejuruan created successfully",
  "data": {
    "id": 1,
    "nama": "Teknik Komputer dan Jaringan",
    "slug": "tkj",
    "deskripsi": "Jurusan yang mempelajari...",
    "ikon": "jurusan-icons/icon.png",
    "media": [
      {
        "id": 1,
        "file_path": "kejuruans/image.jpg"
      }
    ]
  }
}
```

---

### Update Kejuruan

**PUT** `/jurusan/{id}` 🔒 *(Requires Authentication)*

> **⚠️ Catatan**: Untuk upload file, gunakan **POST** dengan `_method=PUT`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
_method: PUT
nama: Teknik Komputer dan Jaringan (Updated)
deskripsi: Deskripsi baru...
ikon: [file] (optional)
image: [file] (optional)
```

**Response (200 OK):**
```json
{
  "message": "Kejuruan updated successfully",
  "data": {
    "id": 1,
    "nama": "Teknik Komputer dan Jaringan (Updated)",
    "slug": "tkj",
    "deskripsi": "Deskripsi baru...",
    "media": [...]
  }
}
```

---

### Delete Kejuruan

**DELETE** `/jurusan/{id}` 🔒 *(Requires Authentication)*

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200 OK):**
```json
{
  "message": "Kejuruan deleted successfully"
}
```

---

## 📰 Berita (News)

### Get All News

**GET** `/berita`

> Hanya menampilkan berita dengan status `published`

**Response (200 OK):**
```json
[
  {
    "id": 1,
    "title": "Judul Berita",
    "slug": "judul-berita",
    "content": "<p>Isi berita...</p>",
    "status": "published",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z",
    "image": {
      "id": 1,
      "file_path": "news/image.jpg"
    }
  }
]
```

---

### Get Single News

**GET** `/berita/{id}`

**Response (200 OK):**
```json
{
  "id": 1,
  "title": "Judul Berita",
  "slug": "judul-berita",
  "content": "<p>Isi berita...</p>",
  "status": "published",
  "image": {
    "id": 1,
    "file_path": "news/image.jpg"
  }
}
```

---

### Create News

**POST** `/berita` 🔒 *(Requires Authentication)*

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
title: Judul Berita
slug: judul-berita
content: <p>Isi berita...</p>
status: published (atau 'draft')
image: [file] (optional, max 2MB)
```

**Response (201 Created):**
```json
{
  "message": "News created successfully",
  "data": {
    "id": 1,
    "title": "Judul Berita",
    "slug": "judul-berita",
    "content": "<p>Isi berita...</p>",
    "status": "published",
    "image": {
      "id": 1,
      "file_path": "news/image.jpg"
    }
  }
}
```

---

### Update News

**PUT** `/berita/{id}` 🔒 *(Requires Authentication)*

> **⚠️ Catatan**: Untuk upload file, gunakan **POST** dengan `_method=PUT`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
_method: PUT
title: Judul Berita (Updated)
content: <p>Konten baru...</p>
status: published
image: [file] (optional)
```

**Response (200 OK):**
```json
{
  "message": "News updated successfully",
  "data": {
    "id": 1,
    "title": "Judul Berita (Updated)",
    "content": "<p>Konten baru...</p>",
    "status": "published",
    "image": {...}
  }
}
```

---

### Delete News

**DELETE** `/berita/{id}` 🔒 *(Requires Authentication)*

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200 OK):**
```json
{
  "message": "News deleted successfully"
}
```

---

## 📸 Galeri

### Get All Galleries

**GET** `/galeri`

**Response (200 OK):**
```json
[
  {
    "id": 1,
    "title": "Kegiatan Upacara",
    "description": "Upacara bendera hari Senin",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z",
    "media": [
      {
        "id": 1,
        "file_path": "galleries/img1.jpg"
      },
      {
        "id": 2,
        "file_path": "galleries/img2.jpg"
      }
    ]
  }
]
```

---

### Get Single Gallery

**GET** `/galeri/{id}`

**Response (200 OK):**
```json
{
  "id": 1,
  "title": "Kegiatan Upacara",
  "description": "Upacara bendera hari Senin",
  "media": [
    {
      "id": 1,
      "file_path": "galleries/img1.jpg"
    },
    {
      "id": 2,
      "file_path": "galleries/img2.jpg"
    }
  ]
}
```

---

### Create Gallery

**POST** `/galeri` 🔒 *(Requires Authentication)*

> **✨ Fitur**: Mendukung upload **multiple images** sekaligus

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
title: Kegiatan Upacara
description: Upacara bendera hari Senin
images[]: [file1] (optional, max 2MB per file)
images[]: [file2]
images[]: [file3]
```

**Response (201 Created):**
```json
{
  "message": "Gallery created successfully",
  "data": {
    "id": 1,
    "title": "Kegiatan Upacara",
    "description": "Upacara bendera hari Senin",
    "media": [
      {
        "id": 1,
        "file_path": "galleries/img1.jpg"
      },
      {
        "id": 2,
        "file_path": "galleries/img2.jpg"
      }
    ]
  }
}
```

---

### Update Gallery

**PUT** `/galeri/{id}` 🔒 *(Requires Authentication)*

> **⚠️ Catatan**: Untuk upload file, gunakan **POST** dengan `_method=PUT`
> 
> **✨ Fitur**: Upload gambar baru akan **ditambahkan** ke galeri (tidak menghapus yang lama)

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
_method: PUT
title: Kegiatan Upacara (Updated)
description: Deskripsi baru
images[]: [file1] (optional, akan ditambahkan ke galeri)
images[]: [file2]
```

**Response (200 OK):**
```json
{
  "message": "Gallery updated successfully",
  "data": {
    "id": 1,
    "title": "Kegiatan Upacara (Updated)",
    "description": "Deskripsi baru",
    "media": [
      {
        "id": 1,
        "file_path": "galleries/old_img.jpg"
      },
      {
        "id": 2,
        "file_path": "galleries/new_img1.jpg"
      },
      {
        "id": 3,
        "file_path": "galleries/new_img2.jpg"
      }
    ]
  }
}
```

---

### Delete Gallery

**DELETE** `/galeri/{id}` 🔒 *(Requires Authentication)*

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200 OK):**
```json
{
  "message": "Gallery deleted successfully"
}
```

---

## 🏆 Prestasi (Achievement)

### Get All Achievements

**GET** `/prestasi`

> Diurutkan berdasarkan `date_achieved` (terbaru)

**Response (200 OK):**
```json
[
  {
    "id": 1,
    "title": "Juara 1 Lomba Coding",
    "winner_name": "Ahmad Fauzi",
    "rank": "Juara 1",
    "level": "nasional",
    "date_achieved": "2024-01-15",
    "description": "Lomba coding tingkat nasional",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z",
    "image": {
      "id": 1,
      "file_path": "achievements/trophy.jpg"
    }
  }
]
```

---

### Get Single Achievement

**GET** `/prestasi/{id}`

**Response (200 OK):**
```json
{
  "id": 1,
  "title": "Juara 1 Lomba Coding",
  "winner_name": "Ahmad Fauzi",
  "rank": "Juara 1",
  "level": "nasional",
  "date_achieved": "2024-01-15",
  "description": "Lomba coding tingkat nasional",
  "image": {
    "id": 1,
    "file_path": "achievements/trophy.jpg"
  }
}
```

---

### Create Achievement

**POST** `/prestasi` 🔒 *(Requires Authentication)*

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
title: Juara 1 Lomba Coding
winner_name: Ahmad Fauzi
rank: Juara 1
level: nasional (kecamatan|kabupaten|provinsi|nasional|internasional)
date_achieved: 2024-01-15
description: Lomba coding tingkat nasional
image: [file] (optional, max 2MB)
```

**Response (201 Created):**
```json
{
  "message": "Achievement created successfully",
  "data": {
    "id": 1,
    "title": "Juara 1 Lomba Coding",
    "winner_name": "Ahmad Fauzi",
    "rank": "Juara 1",
    "level": "nasional",
    "date_achieved": "2024-01-15",
    "description": "Lomba coding tingkat nasional",
    "image": {
      "id": 1,
      "file_path": "achievements/trophy.jpg"
    }
  }
}
```

---

### Update Achievement

**PUT** `/prestasi/{id}` 🔒 *(Requires Authentication)*

> **⚠️ Catatan**: Untuk upload file, gunakan **POST** dengan `_method=PUT`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
_method: PUT
title: Juara 1 Lomba Coding (Updated)
winner_name: Ahmad Fauzi
rank: Juara 1
level: internasional
date_achieved: 2024-01-15
description: Deskripsi baru
image: [file] (optional)
```

**Response (200 OK):**
```json
{
  "message": "Achievement updated successfully",
  "data": {
    "id": 1,
    "title": "Juara 1 Lomba Coding (Updated)",
    "level": "internasional",
    "image": {...}
  }
}
```

---

### Delete Achievement

**DELETE** `/prestasi/{id}` 🔒 *(Requires Authentication)*

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200 OK):**
```json
{
  "message": "Achievement deleted successfully"
}
```

---

## 🎨 Slider

### Get All Sliders

**GET** `/slider`

> Hanya menampilkan slider dengan `is_active = true`

**Response (200 OK):**
```json
[
  {
    "id": 1,
    "title": "Selamat Datang di SMK Marhas",
    "subtitle": "Mencetak Generasi Unggul",
    "link": "https://example.com",
    "is_active": true,
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z",
    "image": {
      "id": 1,
      "file_path": "sliders/banner.jpg"
    }
  }
]
```

---

### Get Single Slider

**GET** `/slider/{id}`

**Response (200 OK):**
```json
{
  "id": 1,
  "title": "Selamat Datang di SMK Marhas",
  "subtitle": "Mencetak Generasi Unggul",
  "link": "https://example.com",
  "is_active": true,
  "image": {
    "id": 1,
    "file_path": "sliders/banner.jpg"
  }
}
```

---

### Create Slider

**POST** `/slider` 🔒 *(Requires Authentication)*

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
title: Selamat Datang di SMK Marhas
subtitle: Mencetak Generasi Unggul (optional)
link: https://example.com (optional)
is_active: true (boolean, default: false)
image: [file] (required, max 2MB)
```

**Response (201 Created):**
```json
{
  "message": "Slider created successfully",
  "data": {
    "id": 1,
    "title": "Selamat Datang di SMK Marhas",
    "subtitle": "Mencetak Generasi Unggul",
    "link": "https://example.com",
    "is_active": true,
    "image": {
      "id": 1,
      "file_path": "sliders/banner.jpg"
    }
  }
}
```

---

### Update Slider

**PUT** `/slider/{id}` 🔒 *(Requires Authentication)*

> **⚠️ Catatan**: Untuk upload file, gunakan **POST** dengan `_method=PUT`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
_method: PUT
title: Selamat Datang di SMK Marhas (Updated)
subtitle: Subtitle baru
is_active: false
image: [file] (optional)
```

**Response (200 OK):**
```json
{
  "message": "Slider updated successfully",
  "data": {
    "id": 1,
    "title": "Selamat Datang di SMK Marhas (Updated)",
    "is_active": false,
    "image": {...}
  }
}
```

---

### Delete Slider

**DELETE** `/slider/{id}` 🔒 *(Requires Authentication)*

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200 OK):**
```json
{
  "message": "Slider deleted successfully"
}
```

---

## 📧 Inbox (Kontak)

### Get All Messages

**GET** `/kontak` 🔒 *(Requires Authentication)*

> Hanya admin yang bisa melihat pesan masuk

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200 OK):**
```json
[
  {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "subject": "Pertanyaan tentang pendaftaran",
    "message": "Saya ingin bertanya...",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
]
```

---

### Get Single Message

**GET** `/kontak/{id}` 🔒 *(Requires Authentication)*

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200 OK):**
```json
{
  "id": 1,
  "name": "John Doe",
  "email": "john@example.com",
  "subject": "Pertanyaan tentang pendaftaran",
  "message": "Saya ingin bertanya..."
}
```

---

### Send Message (Public)

**POST** `/kontak`

> **✨ Endpoint publik** - Tidak memerlukan autentikasi

**Request Body (JSON):**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "subject": "Pertanyaan tentang pendaftaran",
  "message": "Saya ingin bertanya tentang syarat pendaftaran..."
}
```

**Response (201 Created):**
```json
{
  "message": "Message sent successfully",
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "subject": "Pertanyaan tentang pendaftaran",
    "message": "Saya ingin bertanya..."
  }
}
```

---

### Delete Message

**DELETE** `/kontak/{id}` 🔒 *(Requires Authentication)*

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200 OK):**
```json
{
  "message": "Message deleted successfully"
}
```

---

## 📁 Media Upload

### Upload Media

**POST** `/media/upload` 🔒 *(Requires Authentication)*

> **✨ Endpoint khusus** untuk upload gambar ke model yang sudah ada

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
file: [file] (required, max 2MB)
model_type: profile (profile|kejuruan|news|gallery|achievement|slider)
model_id: 1 (ID dari record yang ingin ditambahkan gambar)
```

**Behavior:**
- Untuk `profile`, `kejuruan`, `news`, `achievement`, `slider`: **Mengganti** gambar lama (single image)
- Untuk `gallery`: **Menambahkan** gambar baru (multiple images)

**Response (201 Created):**
```json
{
  "message": "Image uploaded successfully",
  "data": {
    "id": 1,
    "mediable_type": "App\\Models\\Profile",
    "mediable_id": 1,
    "file_path": "profiles/abc123.jpg",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
}
```

**Response (404 Not Found):**
```json
{
  "message": "Record not found. Please check your model_id.",
  "error": "ModelNotFoundException"
}
```

**Response (422 Validation Error):**
```json
{
  "message": "Validation failed",
  "errors": {
    "file": ["The file field is required."],
    "model_type": ["The selected model type is invalid."]
  }
}
```

---

## ⚠️ Error Handling

API ini menggunakan **centralized error handling** dengan pesan dalam Bahasa Indonesia.

### Common Error Responses

#### 401 Unauthorized
```json
{
  "message": "Anda belum login. Silakan login terlebih dahulu.",
  "error": "Unauthenticated"
}
```

#### 404 Not Found
```json
{
  "message": "Data tidak ditemukan."
}
```

#### 422 Validation Error
```json
{
  "message": "Data yang diberikan tidak valid.",
  "errors": {
    "title": ["The title field is required."],
    "email": ["The email must be a valid email address."]
  }
}
```

#### 500 Internal Server Error
```json
{
  "message": "Terjadi kesalahan pada server. Silakan coba lagi nanti.",
  "error": "Error details..."
}
```

---

## 📝 Catatan Penting

### 1. **File Upload dengan PUT Method**
Karena keterbatasan HTTP, untuk upload file dengan method `PUT`, gunakan **POST** dengan parameter `_method=PUT`:

```
POST /api/profile/1
_method: PUT
title: Updated Title
image: [file]
```

### 2. **Bearer Token Authentication**
Untuk endpoint yang dilindungi (🔒), sertakan token di header:

```
Authorization: Bearer 1|abc123xyz...
```

### 3. **File Size Limits**
- **Gambar umum**: Max 2MB
- **Icon kejuruan**: Max 1MB

### 4. **Image Storage**
Semua gambar disimpan di `storage/app/public/` dengan struktur:
- `profiles/` - Gambar profil sekolah
- `kejuruans/` - Gambar jurusan
- `jurusan-icons/` - Icon jurusan
- `news/` - Gambar berita
- `galleries/` - Gambar galeri
- `achievements/` - Gambar prestasi
- `sliders/` - Gambar slider

### 5. **Polymorphic Relationships**
API ini menggunakan **polymorphic relationships** untuk media:
- Satu model bisa memiliki banyak gambar (Gallery)
- Satu model hanya memiliki satu gambar (Profile, News, dll.)

### 6. **Status Values**
- **News**: `draft` atau `published`
- **Slider**: `is_active` (boolean)
- **Achievement Level**: `kecamatan`, `kabupaten`, `provinsi`, `nasional`, `internasional`
- **Profile Type**: `sambutan`, `sejarah`, `visi_misi`, `sarana`, `kurikulum`, `kontak`, `profil`, `struktur`, `ekstrakurikuler`, `mitra`

---

## 🚀 Contoh Penggunaan dengan cURL

### Login
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@example.com",
    "password": "password123"
  }'
```

### Get All News
```bash
curl -X GET http://localhost:8000/api/berita
```

### Create News (with Authentication)
```bash
curl -X POST http://localhost:8000/api/berita \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -F "title=Judul Berita" \
  -F "slug=judul-berita" \
  -F "content=<p>Isi berita...</p>" \
  -F "status=published" \
  -F "image=@/path/to/image.jpg"
```

### Update News (with File Upload)
```bash
curl -X POST http://localhost:8000/api/berita/1 \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -F "_method=PUT" \
  -F "title=Judul Berita Updated" \
  -F "image=@/path/to/new-image.jpg"
```

### Upload Multiple Images to Gallery
```bash
curl -X POST http://localhost:8000/api/galeri \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -F "title=Kegiatan Upacara" \
  -F "description=Upacara bendera" \
  -F "images[]=@/path/to/image1.jpg" \
  -F "images[]=@/path/to/image2.jpg" \
  -F "images[]=@/path/to/image3.jpg"
```

---

## 📞 Support

Jika ada pertanyaan atau masalah, silakan hubungi tim developer.

**Happy Coding! 🚀**
