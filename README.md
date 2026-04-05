# Candid Admin Panel

Admin panel for the Candid platform. Built with Laravel (PHP) and the Metronic UI kit. It connects to the same PostgreSQL database used by the main NestJS backend.

---

## What you need installed first

Before anything, make sure you have these on your computer:

| Tool | How to check | Download |
|------|-------------|---------|
| PHP 8.2 or higher | `php -v` in terminal | https://www.php.net/downloads |
| Composer | `composer -v` in terminal | https://getcomposer.org/download |
| PostgreSQL | running via Docker or locally | https://www.docker.com/products/docker-desktop |

> **Note:** The admin panel does not create any database tables itself. The tables are created by the main `candid_backend` NestJS project. You need to run that project's migrations first, or get a database dump from the project owner.

---

## Setup (step by step)

### 1. Clone the repository

```bash
git clone https://github.com/kruzimatov/candid_admin.git
cd candid_admin
```

### 2. Install PHP dependencies

```bash
composer install
```

This downloads all the PHP packages the project needs. It may take a minute.

### 3. Create your environment file

```bash
cp .env.example .env
```

Then open `.env` in any text editor and fill in your database details:

```
DB_HOST=127.0.0.1
DB_PORT=5432          # change this if your PostgreSQL runs on a different port
DB_DATABASE=candid-pms-db
DB_USERNAME=postgres
DB_PASSWORD=          # your PostgreSQL password

ADMIN_EMAIL=admin@candid.com
ADMIN_PASSWORD=       # choose any password you want to log in with
```

### 4. Generate the app key

```bash
php artisan key:generate
```

This sets a secret key used for sessions and encryption. Only needs to be done once.

### 5. Start the server

```bash
php artisan serve
```

The panel will be available at **http://localhost:8000**

Log in with the `ADMIN_EMAIL` and `ADMIN_PASSWORD` you set in `.env`.

---

## What you can do in the panel

| Section | What it manages |
|---------|----------------|
| **Dashboard** | Overview counts and recent activity |
| **Users** | All registered accounts, toggle active/inactive |
| **Students** | Create, view, edit, delete student accounts |
| **Teachers** | Create, view, edit, delete teachers, verify/unverify |
| **Employers** | Create, view, edit, delete employer accounts |
| **Universities** | Create, view, edit, delete universities, activate/deactivate |
| **Projects** | View student projects, approve/unapprove, delete |
| **Vacancies** | View job postings, delete |
| **Recommendations** | View teacher recommendations, delete |

---

## Troubleshooting

**"could not find driver" or database connection error**
- Make sure PostgreSQL is running
- Double-check `DB_HOST`, `DB_PORT`, `DB_PASSWORD` in your `.env`
- Make sure the database `candid-pms-db` actually exists

**"relation does not exist" error on any page**
- The database tables haven't been created yet
- You need to run the migrations from the `candid_backend` project:
  ```bash
  cd ../candid_backend
  npm install
  npm run migrate:up
  ```

**Blank page or "500 error"**
- Run `php artisan key:generate` if you haven't already
- Check the log file at `storage/logs/laravel.log` for the actual error message

**Login not working**
- Make sure `ADMIN_EMAIL` and `ADMIN_PASSWORD` in `.env` match what you're typing
- These are not stored in the database — they come directly from the `.env` file

---

## Project structure (for the curious)

```
app/
  Http/Controllers/Admin/   ← one controller per section (Students, Teachers, etc.)
  Models/                   ← database models
resources/
  views/
    admin/                  ← all the HTML pages
    layouts/                ← the main layout with sidebar
routes/
  web.php                   ← all URL routes
```
