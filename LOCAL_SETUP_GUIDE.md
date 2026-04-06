# Local Development Setup Guide (Mac)

Follow these steps to get your Laravel and Vite project running locally on your Mac.

## 1. Prerequisites
Ensure you have the following installed on your system:
*   **PHP (8.2 or higher)**: Check with `php -v`
*   **Composer**: Check with `composer -v`
*   **Node.js & NPM**: Check with `node -v` and `npm -v`
*   **SQLite**: The project is pre-configured for SQLite.

## 2. Installation
Open your terminal in the project directory and run these commands:

```bash
# 1. Install PHP dependencies
composer install

# 2. Setup environment file
cp .env.example .env

# 3. Generate application key
php artisan key:generate

# 4. Install Node dependencies
npm install
```

## 3. Database Setup
The project uses a local SQLite database for development.

```bash
# Create the SQLite file
touch database/database.sqlite

# Run migrations
php artisan migrate
```

## 4. Running the Project
The project includes a convenient `dev` script that runs both the backend and frontend simultaneously:

```bash
composer run dev
```

### Manual Method (Optional)
If the above command fails, open two terminal tabs:

**Tab 1 (Backend):**
```bash
php artisan serve
```
*Access at: [http://127.0.0.1:8000](http://127.0.0.1:8000)*

**Tab 2 (Frontend/Vite):**
```bash
npm run dev
```

---

## 5. Troubleshooting
*   **Permissions**: If you see permission errors, run:
    `chmod -R 775 storage bootstrap/cache`
*   **Vite Assets**: If the styles are missing, ensure `npm run dev` is running.
*   **Cache**: To clear all Laravel caches, run:
    `php artisan optimize:clear`
