# About Project

Project ini merupakan project kolaborasi dari inosoft bootcamp.

# Tech Stack

-   [![Laravel][laravel.com]][laravel-url]
-   [![Vue][vue.js]][vue-url]

## Members

-   [Bintang Prayoga](https://github.com/bintang-prayoga) (Frontend)
-   [Nando Septian](https://github.com/NandoCraz) (Frontend)
-   [Akmal Luthfi](https://www.github.com/akmalluthfi) (Backend)
-   [Daffa Sayekti](https://github.com/daffasayekti) (Backend)
-   [Ricko Haikal](https://github.com/rhaikal) (Backend)
-   [Whisnumurty Galih](https://github.com/whisnumurtyga) (Backend)

## Installation

Clone the project

```bash
  git clone https://github.com/bintang-prayoga/bootcamp-final.git
```

Navigate to the application directory

```bash
    cd bootcamp-final
```

Install composer dependencies

```bash
  composer Install
```

Install npm dependencies

```bash
  npm Install
```

Copy env.example

> Setting your database and email configuration

```bash
  cp .env-example .env
```

Generate application key

```bash
  php artisan key:generate
```

Migrate and seed the database

```bash
  php artisan migrate --seed
```

Generate jwt secrect key

```bash
  php artisan jwt:secret
```

Run the project

```bash
  php artisan serve
```

[laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[laravel-url]: https://laravel.com
[vue.js]: https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vuedotjs&logoColor=4FC08D
[vue-url]: https://vuejs.org/
