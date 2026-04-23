# Design System (Wschild)

_Modern Tech Aesthetic, Driven by Space Grotesk_

## 1. Visual Theme & Atmosphere

Wschild adalah sebuah WordPress child theme yang dirancang dengan estetika "Modern Tech Lab" — bersih, presisi, dan minimalis. Desain ini berfokus pada kejelasan informasi dengan sentuhan futuristik melalui penggunaan animasi halus dan tipografi geometris.

Berbeda dengan desain tradisional yang seringkali terasa berat, Wschild menggunakan palet warna netral (Slate & White) dengan aksen biru yang memberikan kesan profesional namun tetap dinamis. Penggunaan _glassmorphism_ pada header dan elemen interaktif memberikan kedalaman visual tanpa mengganggu navigasi.

**Karakteristik Utama:**

- **Tipografi Geometris:** Menggunakan **Space Grotesk** untuk memberikan kesan teknis dan modern pada seluruh elemen.
- **Minimalis & Bersih:** Dominasi warna putih dan slate ringan untuk fokus pada konten.
- **Interaktivitas Halus:** Menggunakan GSAP untuk animasi _reveal_ dan _scramble_ yang memberikan kesan premium.
- **Gooey Effects:** Implementasi filter SVG pada tombol untuk interaksi yang organik dan unik.
- **Glassmorphism:** Header transparan dengan efek _blur_ untuk kesan kedalaman.

## 2. Color Palette & Roles

| Color | Name             | Hex Code / RGBA          | Role                           |
| :---: | :--------------- | :----------------------- | :----------------------------- |
|  ⬛   | **Brand Black**  | `#000000`                | Primary CTA, Dark Backgrounds  |
|  🟦   | **Sky Blue**     | `#0284c7`                | Accent, Badges, Information    |
|  ⬜   | **Pure White**   | `#ffffff`                | Primary Background             |
|  🌫️   | **Slate 900**    | `#0f172a`                | Primary Text                   |
|  🌫️   | **Slate 50**     | `#f8fafc`                | Alternative Section Background |
|  🌫️   | **Slate Border** | `rgba(15, 23, 42, 0.08)` | Standard Borders & Dividers    |

### Surface & Background

- **Primary Canvas** (`#ffffff`): Latar belakang utama halaman.
- **Alt Section** (`#f8fafc`): Digunakan untuk membedakan antar seksi halaman.
- **Glass Header** (`rgba(255, 255, 255, 0.8)` with 10px blur): Memberikan kesan modern dan tetap terbaca saat di-scroll.

### Accent & Semantic

- **Badge Sky** (`rgba(2, 132, 199, 0.12)`): Latar belakang badge informasi.
- **Highlight White** (`rgba(255, 255, 255, 0.76)`): Digunakan pada kartu fitur atau highlight.

## 3. Typography Rules

### Font Family

- **Primary Font**: `Space Grotesk`, fallback: `sans-serif`.
- **Enqueued via**: Google Fonts (weights 300-900).

### Hierarchy

| Role                 | Size (Clamp/Fixed)         | Weight  | Line Height | Letter Spacing |
| :------------------- | :------------------------- | :------ | :---------- | :------------- |
| **Hero Title**       | `clamp(32px, 4.2vw, 46px)` | 600-800 | 1.08        | -0.02em        |
| **Section Heading**  | 32px - 40px                | 700     | 1.2         | Normal         |
| **Subtitle / Intro** | 18px                       | 400     | 1.6         | Normal         |
| **Body Standard**    | 16px                       | 400     | 1.6         | Normal         |
| **Buttons / Nav**    | 16px                       | 700     | 1.0         | 0.02em         |
| **Labels / Badges**  | 12px - 14px                | 600     | 1.2         | 0.02em         |

### Principles

- **Tight Headings**: Judul menggunakan line-height yang ketat (1.08) dan tracking negatif (-0.02em) untuk kesan yang lebih padat dan profesional.
- **Readable Body**: Teks isi menggunakan line-height 1.6 untuk keterbacaan yang maksimal.
- **Uppercase Labels**: Penggunaan uppercase pada elemen label kecil untuk memperkuat estetika teknis.

## 4. Component Stylings

### Buttons

- **Primary Button**: Background Hitam (`#000000`), teks Putih.
- **Ghost Button**: Background Slate sangat tipis (`rgba(15, 23, 42, 0.04)`), teks Slate 900.
- **Shape**: Pill-shaped (99px radius).
- **Gooey Interaction**: Menggunakan filter SVG `#gooey` untuk efek penggabungan visual saat hover/animasi.

### Cards & Containers

- **Main Container**: Maksimal 1100px, terpusat secara horizontal.
- **Highlights Card**: Padding 14px, radius 14px, border tipis (`0.08` opacity slate).
- **Glassmorphism**: Digunakan pada header dengan backdrop-filter blur 10px.

### Badges

- **Style**: Pill-shaped, semi-transparan sky blue.
- **Typography**: Space Grotesk, 600 weight, 0.02em letter spacing.

## 5. Animation & Interactivity (Tech Stack)

Wschild menggunakan kombinasi library modern untuk pengalaman pengguna yang dinamis:

- **GSAP (GreenSock)**: Digunakan untuk _reveal animations_, _scramble text effects_, _parallax scroll_ pada kartu harga, serta efek _mouse-follow tilt_ pada elemen hero.
- **Alpine.js**: Mengelola state interaktif seperti _pricing toggle_ dan _mobile menu_ (collapse).
- **Interactive Depth**: Penggunaan efek parallax dan rotasi 3D pada gambar hero yang merespon gerakan mouse.
- **Smooth Scroll**: Implementasi animasi scroll yang halus untuk navigasi antar seksi.

## 6. Layout Principles

- **Base Unit**: 8px.
- **Section Spacing**: Padding vertikal standar 56px.
- **Hero Spacing**: Padding atas 72px, bawah 56px dengan latar belakang radial gradient lembut (Amber & Emerald).

## 7. Do's and Don'ts

### Do

- Gunakan **Space Grotesk** untuk semua elemen teks.
- Pertahankan penggunaan warna Slate untuk teks (`#0f172a`) daripada Hitam pekat agar lebih nyaman dibaca.
- Gunakan `wschild-container` untuk menjaga konsistensi lebar konten.
- Manfaatkan animasi GSAP untuk elemen-elemen kunci agar situs terasa "hidup".

### Don't

- Jangan menggunakan font serif.
- Hindari penggunaan warna-warna neon yang terlalu kontras.
- Jangan menghilangkan efek blur pada header karena itu adalah bagian dari identitas visual.
- Hindari penggunaan bayangan (shadow) yang terlalu berat; gunakan border tipis atau ring shadow sebagai gantinya.
