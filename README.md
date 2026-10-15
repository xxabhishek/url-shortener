# URL Shortener - Laravel Assignment

A multi-company URL Shortener service built using **Laravel 12** and **MySQL**.

## Features

- Multi Company Support
- Roles: SuperAdmin, Admin, Member
- Invitation System
- Role based Short URL creation & listing
- Public Short URL redirection

---

## Requirements

- PHP 8.2 or higher
- Composer
- MySQL
- XAMPP / Laragon / Local server

---

## Local Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/xxabhishek/url-shortener.git
cd url-shortener

# Instatll Dependency
composer install

# Environment Configuration
Bashcp .env.example .env
php artisan key:generate

#DB Connections
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=url_shortener
DB_USERNAME=root
DB_PASSWORD=

#Migratuob
#added migratio files run :
php artisan migrate:fresh

#seeder
php artisan db:seed #(check user seeder and get superadmin credentials)
