
# About Project
Project ini merupakan project kolaborasi dari inosoft bootcamp.

## Members
- [Bintang Prayoga](https://github.com/bintang-prayoga) (Frontend)
- [Nando Septian](https://github.com/NandoCraz) (Frontend)
- [Akmal Luthfi](https://www.github.com/akmalluthfi) (Backend)
- [Daffa Sayekti](https://github.com/daffasayekti) (Backend)
- [Ricko Haikal](https://github.com/rhaikal) (Backend)
- [Whisnumurty Galih](https://github.com/whisnumurtyga) (Backend)

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
