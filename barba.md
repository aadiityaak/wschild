# Barba.js (v2) — Catatan Implementasi & Referensi Cepat

Dokumen ini merangkum konsep inti Barba.js v2 dan pola implementasinya (khususnya untuk situs multi-halaman seperti WordPress) agar mudah dipakai sebagai referensi saat membangun page transition.

Sumber utama: https://barba.js.org/docs/

---

## 1) Apa itu Barba.js

Barba.js membantu membuat transisi halus antar halaman dengan pendekatan seperti SPA: halaman berikutnya diambil (prefetch), dimasukkan sebagai “container” baru, lalu container lama dilepas setelah transisi selesai. Dengan begitu navigasi terasa lebih cepat dan tidak terjadi “flash reload”.  
Rujukan: https://barba.js.org/docs/getstarted/intro/ dan https://barba.js.org/docs/getstarted/lifecycle/

---

## 2) Struktur Markup Wajib (Wrapper & Container)

Konsep paling penting Barba adalah:

- `data-barba="wrapper"`: pembungkus utama.
- `data-barba="container"`: bagian yang akan diganti saat pindah halaman.
- `data-barba-namespace`: nama unik per halaman (dipakai untuk rule transitions & views).

Contoh struktur default:

```html
<body data-barba="wrapper">
  <header>...</header>

  <main data-barba="container" data-barba-namespace="home">
    ...
  </main>

  <footer>...</footer>
</body>
```

Rujukan: https://barba.js.org/docs/getstarted/markup/

Catatan penting:

- Elemen di dalam `wrapper` tapi di luar `container` tidak akan di-update saat navigasi.
- Barba akan menambahkan `next.container` ke akhir `wrapper` (secara default). Kalau Anda melakukan cross-fade, Anda perlu mengatur posisi container dengan CSS supaya tidak “loncat” layout.

---

## 3) Instalasi

### Opsi A — Bundler (disarankan)

```bash
npm install @barba/core
```

```js
import barba from "@barba/core";

barba.init({});
```

Rujukan: https://barba.js.org/docs/getstarted/install/

### Opsi B — CDN (cepat untuk trial)

```html
<script src="https://unpkg.com/@barba/core"></script>
<script>
  barba.init({});
</script>
```

Rujukan: https://barba.js.org/docs/getstarted/install/

---

## 4) Basic Transition (leave + enter)

Transition adalah inti Barba. Minimal Anda akan mendefinisikan:

- `leave()`: animasi saat meninggalkan halaman sekarang (`current`).
- `enter()`: animasi saat memasuki halaman baru (`next`).

Contoh dasar:

```js
barba.init({
  transitions: [
    {
      name: "default-transition",
      leave() {},
      enter() {},
    },
  ],
});
```

Rujukan: https://barba.js.org/docs/getstarted/basic-transition/

### Contoh dengan GSAP (opacity)

```js
barba.init({
  transitions: [
    {
      name: "opacity-transition",
      leave(data) {
        return gsap.to(data.current.container, { opacity: 0 });
      },
      enter(data) {
        return gsap.from(data.next.container, { opacity: 0 });
      },
    },
  ],
});
```

Rujukan: https://barba.js.org/docs/getstarted/basic-transition/

---

## 5) Lifecycle & Hook Order (gambaran mental)

Barba memproses pindah halaman dengan:

- prefetch halaman berikutnya
- simpan ke cache
- append `next.container` ke `wrapper`
- remove `current.container` setelah transisi selesai

Rujukan: https://barba.js.org/docs/getstarted/lifecycle/

Hook yang sering dipakai (urutan normal, tanpa sync):

- `before` → `beforeLeave` → `leave` → `afterLeave`
- `beforeEnter` → `enter` → `afterEnter`
- `after`

Detail tabel hooks: https://barba.js.org/docs/advanced/hooks/

---

## 6) Transitions Lanjutan: Rules & Sync Mode

### Rules (from/to)

Anda bisa memilih transisi spesifik berdasarkan kondisi:

- `from`: berlaku ketika meninggalkan namespace/route tertentu
- `to`: berlaku ketika memasuki namespace/route tertentu

Contoh rule namespace:

```js
barba.init({
  transitions: [
    {
      name: "home-to-contact",
      from: { namespace: ["home"] },
      to: { namespace: ["contact"] },
      leave() {},
      enter() {},
    },
  ],
});
```

Rujukan: https://barba.js.org/docs/advanced/transitions/

### Sync mode (cross-fade)

`sync: true` menjalankan `leave` dan `enter` secara bersamaan (lebih cocok untuk cross-fade).  
Rujukan: https://barba.js.org/docs/advanced/transitions/#Sync-mode

```js
barba.init({
  transitions: [
    {
      name: "crossfade",
      sync: true,
      leave() {},
      enter() {},
    },
  ],
});
```

---

## 7) Views: Jalankan Kode Per Halaman (Per Namespace)

Views cocok untuk:

- init komponen hanya pada halaman tertentu
- cleanup/destroy saat meninggalkan halaman tertentu

```js
barba.init({
  views: [
    {
      namespace: "index",
      beforeLeave(data) {},
    },
    {
      namespace: "contact",
      beforeEnter(data) {},
    },
  ],
});
```

Rujukan: https://barba.js.org/docs/advanced/views/

---

## 8) Global Hooks: Tempat Aman untuk “Re-init” Script

Karena Barba membuat situs berperilaku seperti SPA, event seperti `DOMContentLoaded` hanya terjadi sekali (di load awal). Script yang hanya dipasang saat `DOMContentLoaded` sering perlu dipanggil ulang lewat hooks setelah container baru masuk.

Pola umum:

- Buat fungsi `initX()` yang aman dipanggil berkali-kali (idempotent).
- Panggil `initX()` di `barba.hooks.afterEnter(...)` atau `barba.hooks.after(...)`.

Rujukan hooks global: https://barba.js.org/docs/advanced/hooks/#Global-hooks

---

## 9) Plugin Prefetch (@barba/prefetch)

Plugin ini melakukan prefetch link yang masuk viewport (IntersectionObserver).  
Rujukan: https://barba.js.org/docs/plugins/prefetch/

```js
import barba from "@barba/core";
import barbaPrefetch from "@barba/prefetch";

barba.use(barbaPrefetch);
barba.init();
```

---

## 10) Catatan WordPress: Update body class

Di WordPress, class pada `<body>` bisa berbeda tiap halaman. Karena `<body>` berada di luar container, Barba tidak otomatis memperbaruinya. Salah satu pola adalah mengekstrak class body dari HTML halaman berikutnya lalu mengganti class pada `document.body`.

Contoh dari dokumentasi:

```js
import barba from "@barba/core";

barba.init({
  transitions: [
    {
      enter() {},
      beforeEnter: ({ next }) => {
        const matches = next.html.match(/<body.+?class="([^""]*)"/i);
        document.body.setAttribute("class", (matches && matches.at(1)) ?? "");
      },
    },
  ],
});
```

Rujukan: https://barba.js.org/docs/advanced/third-party/#WordPress

---

## 11) Catatan Praktis untuk Theme Ini (pola JS yang umum)

Di theme ini, beberapa script dipasang lewat `document.addEventListener("DOMContentLoaded", ...)`. Dengan Barba:

- Kode di dalam `DOMContentLoaded` tidak otomatis jalan lagi saat pindah halaman via Barba.
- Solusinya: pindahkan logika inti ke fungsi `init...()` lalu panggil di hook Barba (mis. `afterEnter`) agar re-bind event, re-scan DOM, dan re-init animasi untuk container baru.

Contoh pola:

```js
function initHeaderScroll() {
  const header = document.querySelector(".sticky-header");
  if (!header) return;
  // pastikan tidak mendaftarkan listener ganda (gunakan guard/cleanup)
}

barba.hooks.afterEnter(() => {
  initHeaderScroll();
});
```

---

## 12) Checklist Implementasi Cepat

- Pastikan markup `wrapper/container/namespace` sudah benar.
- Pastikan animasi `leave/enter` me-return Promise (atau GSAP tween) agar Barba menunggu animasi selesai.
- Jika memakai `sync: true`, pastikan CSS container mencegah layout bergeser.
- Pastikan script per halaman diinisialisasi ulang lewat Views atau global hooks.
- (WordPress) pertimbangkan update `body` class jika layout/style bergantung pada body class.

