# 🚀 InfinityFree Deployment Guide

## Prerequisites
- InfinityFree account (free hosting)
- FTP client (FileZilla recommended)
- Your project built locally

## Step 1: Build Your Project Locally

Run the deployment script:
```bash
deploy.bat
```

Or manually:
```bash
composer install --optimize-autoloader --no-dev
npm install
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Step 2: Prepare Your Files

### Files to Upload:
```
✅ app/
✅ bootstrap/
✅ config/
✅ database/
✅ public/
✅ resources/
✅ routes/
✅ storage/
✅ vendor/
✅ .htaccess (in public folder)
✅ artisan
✅ composer.json
✅ composer.lock
```

### Files NOT to Upload:
```
❌ node_modules/
❌ .env (create new on server)
❌ .git/
❌ tests/
❌ *.md files (optional)
```

## Step 3: Configure InfinityFree

### 3.1 Create Database
1. Login to InfinityFree control panel
2. Go to MySQL Databases
3. Create a new database
4. Note down:
   - Database name
   - Database username
   - Database password
   - Database host

### 3.2 Upload Files via FTP

1. **Connect to FTP:**
   - Host: `ftpupload.net` or your FTP hostname
   - Username: Your InfinityFree username
   - Password: Your InfinityFree password
   - Port: 21

2. **Upload Structure:**
   ```
   /htdocs/
   ├── public/          (this becomes your web root)
   │   ├── index.php
   │   ├── .htaccess
   │   └── build/
   └── laravel/         (create this folder for Laravel files)
       ├── app/
       ├── bootstrap/
       ├── config/
       ├── database/
       ├── resources/
       ├── routes/
       ├── storage/
       ├── vendor/
       └── artisan
   ```

3. **Important:** Upload the contents of your `public` folder to `/htdocs/public/` and everything else to `/htdocs/laravel/`

## Step 4: Update index.php

Edit `/htdocs/public/index.php` to point to the correct Laravel location:

```php
<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../laravel/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../laravel/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../laravel/bootstrap/app.php')
    ->handleRequest(Request::capture());
```

## Step 5: Create .env File

Create a new `.env` file in `/htdocs/laravel/` with:

```env
APP_NAME="Valentine's Day"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://yourdomain.infinityfreeapp.com

DB_CONNECTION=mysql
DB_HOST=your_db_host
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password

SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

LOG_CHANNEL=stack
LOG_LEVEL=error
```

## Step 6: Generate Application Key

Since you can't run artisan commands on InfinityFree, generate the key locally:

```bash
php artisan key:generate --show
```

Copy the generated key and paste it in your `.env` file on the server.

## Step 7: Set Permissions

Via FTP, set these folder permissions to 755:
- `/htdocs/laravel/storage/` (and all subfolders)
- `/htdocs/laravel/bootstrap/cache/`

## Step 8: Run Migrations

Since InfinityFree doesn't allow SSH, you have two options:

### Option A: Use phpMyAdmin
1. Go to phpMyAdmin in InfinityFree control panel
2. Import your database structure manually
3. Or run SQL queries from your migration files

### Option B: Create a Migration Script

Create `/htdocs/public/migrate.php`:

```php
<?php
// Remove this file after running migrations!
require __DIR__.'/../laravel/vendor/autoload.php';

$app = require_once __DIR__.'/../laravel/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$status = $kernel->call('migrate', ['--force' => true]);

echo $status === 0 ? 'Migrations completed!' : 'Migration failed!';

// Delete this file after successful migration
```

Visit `https://yourdomain.infinityfreeapp.com/migrate.php` then DELETE the file immediately.

## Step 9: Update .htaccess

Make sure `/htdocs/public/.htaccess` has:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

## Step 10: Test Your Application

1. Visit your domain: `https://yourdomain.infinityfreeapp.com`
2. Test registration and login
3. Create a test message
4. Verify envelope animations work
5. Test sharing functionality

## Troubleshooting

### Issue: 500 Internal Server Error
**Solution:**
- Check `.env` file exists and has correct values
- Verify `APP_KEY` is set
- Check folder permissions (755 for storage and bootstrap/cache)
- Enable error display temporarily: `APP_DEBUG=true`

### Issue: Assets not loading
**Solution:**
- Verify `public/build/` folder was uploaded
- Check `APP_URL` in `.env` matches your domain
- Clear browser cache

### Issue: Database connection error
**Solution:**
- Double-check database credentials in `.env`
- Verify database exists in InfinityFree panel
- Use the correct database host (not localhost)

### Issue: Routes not working
**Solution:**
- Verify `.htaccess` file is in public folder
- Check if mod_rewrite is enabled (it should be on InfinityFree)
- Clear route cache: delete `bootstrap/cache/routes-v7.php`

## Important Notes

⚠️ **InfinityFree Limitations:**
- No SSH access (can't run artisan commands)
- No Node.js (must build assets locally)
- Limited PHP execution time
- No cron jobs (for scheduled tasks)
- Shared hosting environment

✅ **Best Practices:**
- Always build assets locally before uploading
- Keep `APP_DEBUG=false` in production
- Use file-based sessions and cache
- Regularly backup your database
- Monitor your resource usage

## Security Checklist

- [ ] `APP_DEBUG=false` in production
- [ ] Strong `APP_KEY` generated
- [ ] Database credentials secured
- [ ] Remove `migrate.php` after use
- [ ] `.env` file not in public folder
- [ ] Storage folders have correct permissions
- [ ] Remove unnecessary files (tests, docs)

## Performance Tips

1. **Enable Caching:**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

2. **Optimize Composer:**
   ```bash
   composer install --optimize-autoloader --no-dev
   ```

3. **Minify Assets:**
   Already done by `npm run build`

## Support

If you encounter issues:
1. Check InfinityFree forums
2. Review Laravel logs in `storage/logs/`
3. Enable debug mode temporarily to see errors
4. Verify all deployment steps were followed

---

**Congratulations!** Your Valentine's Day app is now live on InfinityFree! 🎉💕
