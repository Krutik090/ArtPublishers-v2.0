<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.
Below is a complete, production‑ready **`README.md`** plus an **MIT `LICENSE`** for your **ArtPublishers‑v2.0** repository. They replace the default Laravel boiler‑plate and clearly explain what your project does, how to run it, and how others can contribute.

---

```markdown
# 🎨 ArtPublishers v2.0

*An end‑to‑end Laravel 11 application that lets artists publish, manage and showcase their work while administrators curate content and keep the platform safe.*

---

## ✨ Key Features

| Module | Highlights |
|--------|------------|
| **Public site** | Responsive gallery, category & location filters, slug‑based art detail pages, visitor reviews |
| **Artist dashboard** | Register / log‑in, CRUD for art pieces, image & video galleries, Toastr feedback, DataTables listing |
| **Admin panel** | Hero‑section editor, category / location / amenity management, approve or reject pending art, moderate reviews, profile & password tools |
| **Tech inside** | Laravel 11, PHP 8.2, MySQL, Vite/ESBuild, Blade, Bootstrap 5, Yajra DataTables, Yoeunes Toastr |

> All routes are defined in **`routes/web.php`** and grouped by *frontend*, *user account* and *admin* middleware :contentReference[oaicite:0]{index=0}.  
> Dependencies are declared in **`composer.json`** :contentReference[oaicite:1]{index=1}.

---

## 🗂 Directory Map

ArtPublishers-v2.0
├─ app/ # Models, controllers, jobs, policies
├─ resources/
│ ├─ views/ # Blade templates (frontend & admin)
│ └─ js/, css/ # Vite assets
├─ routes/
│ └─ web.php # All HTTP routes
├─ public/ # Publicly served assets
├─ database/
│ ├─ migrations/ # Schema
│ └─ seeders/ # Optional demo data
├─ .env.example # Sample environment file
├─ composer.json # PHP dependencies & autoload
└─ package.json # Node / Vite build

---

## 🚀 Quick Start (Local)

1. **Clone & install PHP deps**

   ```bash
   git clone https://github.com/Krutik090/ArtPublishers-v2.0.git
   cd ArtPublishers-v2.0
   composer install --no-interaction --prefer-dist
````

2. **Configure environment**

   ```bash
   cp .env.example .env
   php artisan key:generate
   # edit DB_, MAIL_, etc. in .env
   ```

3. **Prepare database**

   ```bash
   php artisan migrate --seed   # add --seed if you created seeders
   ```

4. **Serve**

   ```bash
   php artisan serve
   # visit http://127.0.0.1:8000
   ```

---

## 🛠 Common Artisan Commands

```bash
# run automated tests
php artisan test

# clear & rebuild caches
php artisan optimize:clear && php artisan optimize
```

---

## 🤝 Contributing

1. Fork the repo & create a feature branch.
2. Follow PSR‑12 style (`composer run pint`).
3. Submit a clear PR; describe **why** and **how**.

Bug reports & feature requests are welcome via GitHub Issues.

---

## 📜 License

Released under the **MIT License**. See [`LICENSE`](LICENSE) for full text.

---

## 👤 Author

**Krutik Thakar** — [@Krutik090](https://github.com/Krutik090)

Feel free to connect and share feedback!

````

---

## `LICENSE` (MIT)

Create a file named **`LICENSE`** in the repository root with the following content:

```text
MIT License

Copyright (c) 2025 Krutik Thakar

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
````

---
