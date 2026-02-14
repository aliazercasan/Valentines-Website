# 🚂 Railway Deployment Setup

## Critical: Environment Variables

Go to your Railway project → Variables tab and add these **REQUIRED** variables:

```env
APP_NAME=Valentine's Day
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app.railway.app

DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}

SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

LOG_CHANNEL=stack
LOG_LEVEL=error
```

## Step-by-Step Deployment

### 1. Generate APP_KEY Locally
```bash
php artisan key:generate --show
```
Copy the output (e.g., `base64:xxxxx...`)

### 2. Add MySQL Database in Railway
- Click "New" → "Database" → "Add MySQL"
- Railway will auto-populate: `MYSQLHOST`, `MYSQLPORT`, `MYSQLDATABASE`, `MYSQLUSER`, `MYSQLPASSWORD`

### 3. Set Environment Variables
In Railway Variables tab, add:
- `APP_KEY` = (paste the key from step 1)
- `APP_ENV` = `production`
- `APP_DEBUG` = `false`
- `APP_URL` = `https://your-app.railway.app` (use your actual Railway URL)
- `SESSION_DRIVER` = `file`
- `CACHE_DRIVER` = `file`
- `QUEUE_CONNECTION` = `sync`
- `DB_CONNECTION` = `mysql`

### 4. Deploy from GitHub
- Connect your GitHub repository
- Railway will automatically build and deploy

### 5. Run Migrations (One-Time)
After first deployment, go to your service:
- Click "Settings" → "Deploy"
- Under "Custom Start Command", temporarily add:
```bash
php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
```
- Redeploy
- After successful migration, remove the custom command (or change back to default)

### 6. Debug (If 500 Error)
Visit: `https://your-app.railway.app/railway-debug.php`
This will show what's missing. **Delete this file after fixing!**

## Common Issues

### Issue: 500 Error
**Cause**: Missing APP_KEY or wrong environment variables
**Fix**: 
1. Ensure `APP_KEY` is set in Railway variables
2. Check `APP_ENV=production`
3. Visit `/railway-debug.php` to see what's wrong

### Issue: Database Connection Error
**Cause**: MySQL not connected or wrong credentials
**Fix**:
1. Ensure MySQL database is added in Railway
2. Verify `DB_CONNECTION=mysql`
3. Check that Railway auto-populated MySQL variables

### Issue: Assets Not Loading
**Cause**: Build didn't complete or wrong APP_URL
**Fix**:
1. Check build logs for `npm run build` success
2. Verify `APP_URL` matches your Railway domain
3. Check `public/build/` directory exists in deployment

### Issue: Storage Errors
**Cause**: Storage directories not writable
**Fix**: Already handled in `nixpacks.toml` - redeploy if needed

## Checklist

Before deploying:
- [ ] `APP_KEY` generated and set
- [ ] MySQL database added
- [ ] All environment variables set
- [ ] Repository pushed to GitHub
- [ ] Railway connected to GitHub repo

After deploying:
- [ ] Visit your app URL
- [ ] Run migrations (one-time)
- [ ] Test registration
- [ ] Test message creation
- [ ] Delete `railway-debug.php`

---

Your app should now be live! 🚀💕
