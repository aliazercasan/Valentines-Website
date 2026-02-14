# 🚂 Railway Deployment Setup

## Environment Variables to Set in Railway

Go to your Railway project → Variables tab and add these:

```env
APP_NAME=Valentine's Day
APP_ENV=production
APP_KEY=base64:YOUR_KEY_HERE
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

## Steps to Deploy

1. **Connect GitHub Repository**
   - Go to Railway dashboard
   - Click "New Project"
   - Select "Deploy from GitHub repo"
   - Choose your repository

2. **Add MySQL Database**
   - Click "New" → "Database" → "Add MySQL"
   - Railway will automatically set the database variables

3. **Set Environment Variables**
   - Copy the variables above
   - Replace `YOUR_KEY_HERE` with your actual app key
   - Railway will auto-fill the MySQL variables

4. **Deploy**
   - Railway will automatically:
     - Install dependencies
     - Run `npm run build`
     - Start your application

5. **Run Migrations**
   - Go to your service settings
   - Click on "Deploy" tab
   - Add a custom start command temporarily:
   ```bash
   php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
   ```
   - After first deployment, change it back to:
   ```bash
   php artisan serve --host=0.0.0.0 --port=$PORT
   ```

## Troubleshooting

### Assets Not Loading
If CSS/JS aren't loading, check:
1. Build logs show `npm run build` completed
2. `public/build/` directory exists
3. `APP_URL` matches your Railway domain

### Database Connection Issues
- Verify MySQL service is running
- Check that database variables are set
- Ensure migrations ran successfully

### 500 Error
- Set `APP_DEBUG=true` temporarily to see errors
- Check deployment logs
- Verify `APP_KEY` is set

## Custom Domain

To use a custom domain:
1. Go to Settings → Domains
2. Click "Add Domain"
3. Enter your domain
4. Update DNS records as shown
5. Update `APP_URL` environment variable

---

Your app should now be live at: `https://your-app.railway.app` 🚀
