# �� ScreenShot - Movie Scene Collection Platform

<div align="center">
  <img src="public/images/sslogo.png" alt="ScreenSpot Logo" width="200">
  
  [![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
  [![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
  [![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC.svg)](https://tailwindcss.com)
  [![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
</div>

## 📖 Overview

ScreenShot is just a website for movie collection. will be soon adding more features, fixing some bug etc.

## 🚀 Quick Start

### Prerequisites

Before you begin, ensure you have the following installed:

- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.0
- **npm** >= 9.0
- **MySQL** >= 8.0 or **PostgreSQL** >= 13.0
- **Git**

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/screenshot-be.git
   cd screenshot-be
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   Edit `.env` file and update database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=screenshot_db
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run database migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the database (optional)**
   ```bash
   php artisan db:seed
   ```

8. **Create storage link**
   ```bash
   php artisan storage:link
   ```

9. **Build assets**
   ```bash
   npm run build
   ```

10. **Start the development server**
    ```bash
    php artisan serve
    ```

Your application will be available at `http://localhost:8000`

## 🛠️ Development

### Running in Development Mode

```bash
# Start Laravel development server
php artisan serve

# In another terminal, start Vite for asset compilation
npm run dev

# Or use the combined development script
composer run dev
```

### Database Management

```bash
# Create a new migration
php artisan make:migration create_table_name

# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Refresh database and seed
php artisan migrate:fresh --seed
```

### Testing

```bash
# Run all tests
php artisan test

# Run tests with coverage
php artisan test --coverage
```

## 📁 Project Structure
