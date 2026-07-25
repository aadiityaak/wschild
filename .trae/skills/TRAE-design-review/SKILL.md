---
name: "TRAE-design-review"
description: "Audit UI/UX dan kualitas CSS pada codebase WordPress/Wschild. Invoke ketika user meminta review desain, analisa tampilan, perbaikan CSS, audit komponen, atau tanya 'apa yang kurang bagus dari ini'."
---

# TRAE Design Review

Skill ini melakukan audit desain menyeluruh terhadap komponen frontend di theme Wschild. Mencakup PHP template, CSS, dan interaksi JS.

## Ruang Lingkup Audit (7 Pilar)

Analisis wajib mencakup ketujuh pilar berikut. Jika suatu pilar tidak relevan (misal komponen tidak punya gambar), sebutkan "T/A" dan lanjut.

### 1. Tipografi

- **Font pairing**: Apakah hanya satu font family? Kombinasi display font (heading) + readable font (body) menciptakan hierarki yang lebih kuat.
- **Hierarki**: Apakah ukuran, weight, dan spacing antar heading/body/keterangan sudah bertingkat jelas?
- **Line-height & letter-spacing**: Pastikan body text line-height >= 1.5, heading letter-spacing ada di -0.02em ~ -0.03em.
- **Font loading**: Cek `wp_enqueue_style` di `functions.php` — apakah Google Fonts di-load dengan proper fallback? Apakah ada font-display: swap?

### 2. Warna & Kontras

- **Contrast ratio**: Body text terhadap background harus >= 4.5:1. Gunakan nilai hardcoded: `#666` di atas `#fff` = ~5.2:1 (borderline), `#888` = ~3.7:1 (gagal), `#4a4a4a` = ~8.5:1 (aman).
- **Konsistensi palette**: Apakah warna tombol, aksen, text konsisten antar komponen? Bandingkan dengan komponen sejenis di halaman lain.
- **Konflik CSS**: Cek apakah ada dua rule berbeda yang mempengaruhi properti warna/background elemen yang sama.

### 3. Layout & Spacing

- **Grid/Flex ratio**: Apakah proporsi kolom seimbang? Grid `1fr 30%` untuk konten + gambar portrait terlalu timpang.
- **Whitespace**: Padding section >= 60px, gap antar elemen >= 20px.
- **Container overflow**: Pastikan tidak ada elemen yang keluar container di mobile (cek `overflow: hidden` dan `max-width` pada gambar).
- **Responsivitas**: Cek media query breakpoints — apakah layout berubah pas di 768px dan 480px?

### 4. Aksesibilitas

- **prefers-reduced-motion**: Untuk animasi (GSAP, typing), cek apakah ada fallback seperti `window.matchMedia('(prefers-reduced-motion: reduce)')`.
- **Focus state**: Interactive element (link, button) harus punya `:focus-visible` style.
- **Alt text**: Gambar harus punya atribut `alt` yang deskriptif.
- **Skip link / heading order**: Pastikan heading tidak loncat (h1 → h3 tanpa h2).

### 5. Kualitas Kode CSS

- **`!important`**: Setiap penggunaan `!important` harus dipertanyakan. Ini tanda specificity conflict yang perlu diselesaikan di akarnya.
- **Selector specificity**: Cek apakah override terjadi karena selector yang kurang/tidak spesifik (contoh: `.class1--modifier` vs `.class1`).
- **Redundansi**: Dua rule yang men-set properti sama dengan nilai berbeda → konflik.
- **Naming convention**: Apakah konsisten pakai BEM? (`.block__element--modifier`)
- **Magic numbers**: Hindari nilai arbitrer tanpa komentar.

### 6. Konsistensi Antar Komponen

- Bandingkan dengan komponen sejenis di template/halaman lain. Contoh: hero home vs hero landing page — apakah styling-nya konsisten?
- Periksa apakah ada shared class yang dipakai dengan intent berbeda.

### 7. Kualitas Markup & Script

- **Inline script**: Script yang panjang (>10 baris) di inline PHP template harus dipindahkan ke file JS terpisah dan di-enqueue.
- **Data attributes**: Apakah data untuk script sudah di-pass lewat data attributes dengan rapi?
- **Semantic HTML**: Gunakan `<section>`, `<article>`, `<nav>` untuk struktur, bukan `<div>` semua.
- **PHP escaping**: Cek `esc_html`, `esc_url`, `esc_attr`, `wp_kses_post`.

## Format Output

Untuk setiap komponen yang direview, output dalam format:

```
## [Nama Komponen]
File: [path/to/file.php]
File CSS: [path/to/style.css#Lstart-Lend]

| Pilar | Masalah | Prioritas |
|-------|---------|-----------|
| ... | ... | High/Medium/Low |

### Detail Perbaikan

#### [Pilar] - [Judul Masalah]
**Ditemukan:** ... (kutip kode yang relevan)
**Dampak:** ...
**Saran:** ...

---

## Ringkasan Prioritas
| Prioritas | Masalah | Pilar |
|-----------|---------|-------|
```

## Aturan Penting

1. **Harus baca file CSS terkait**. Jangan hanya analisa dari PHP template — `style.css`, semua file di `assets/css/`, dan hardcoded inline style harus diperiksa.
2. **Harus baca `functions.php`** untuk konteks enqueue font/script/style.
3. **Harus bandingkan** dengan komponen sejenis di template lain (minimal 1 pembanding) untuk pilar konsistensi.
4. **Berikan saran konkret** — sebutkan nilai spesifik (warna hex, ukuran px, properti CSS), bukan saran abstrak.
5. **Jangan rekomendasikan rewrite total**
