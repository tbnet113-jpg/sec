# SocialNet — Web Application Mock Project

PHP + MySQL social network mock app, deployable on **Linux + Nginx + PHP-FPM** (and runnable locally on Windows with Apache/XAMPP or `php -S` if document root is configured correctly).

## Required URLs

| Page | URL |
|------|-----|
| Admin — create user | `/admin/newuser.php` |
| Sign in | `/socialnet/signin.php` |
| Home | `/socialnet/index.php` |
| Settings (edit profile text) | `/socialnet/setting.php` |
| Profile (`owner` optional) | `/socialnet/profile.php` · `/socialnet/profile.php?owner=username` |
| About | `/socialnet/about.php` |
| Sign out | `/socialnet/signout.php` |

## Database

Import `db.sql` on a fresh environment:

```bash
mysql -u root -p < db.sql
```

Database name: `socialnet`. Table: `account` with columns `id`, `username`, `fullname`, `password`, `description`, and an extra **`created_at`** timestamp (not required by the brief; safe to ignore in app logic).

## Configuration

Connection settings are read from **environment variables** (recommended on Linux). Defaults match a typical local MySQL install:

| Variable | Default |
|----------|---------|
| `DB_HOST` | `127.0.0.1` |
| `DB_PORT` | `3306` |
| `DB_NAME` | `socialnet` |
| `DB_USER` | `root` |
| `DB_PASS` | empty string |

**Examples**

Linux/macOS:

```bash
export DB_USER=socialnet
export DB_PASS='your-secret'
php-fpm ...
```

Windows PowerShell (e.g. XAMPP MySQL on port 3307):

```powershell
$env:DB_PORT = "3307"
$env:DB_PASS = ""
```

## Nginx

Adjust paths and PHP-FPM socket/version, then include or symlink the sample file:

- See `nginx.conf.example`

Document root must be the **project root** (the folder that contains `admin/` and `socialnet/`) so paths `/admin/...` and `/socialnet/...` resolve correctly.

## Run flow

1. Import `db.sql`.
2. Set environment variables if defaults do not match your MySQL user/password/port.
3. Open `/admin/newuser.php` and create a user.
4. Sign in at `/socialnet/signin.php`.
5. Use the menubar on Home, Setting, Profile, About; SignOut clears the session and sends you to the sign-in page.

## Before submission

1. Edit **`socialnet/about.php`**: set your real **student name** and **student number**.
2. Create a **public** GitHub repository and push this project (including `db.sql`).
3. Submit the repository HTTPS URL via the course form.

## Extensions (beyond the brief)

Documented here for markers:

- Passwords stored with `password_hash()` / `password_verify()`.
- Optional `created_at` on `account` for auditing.
- Environment-based DB config for deployment.

Add any further features you build to this section.
