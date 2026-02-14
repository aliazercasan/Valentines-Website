# Railway Deployment Guide

## What Was Fixed

The styling issue was caused by improper asset serving in production. Here's what was configured:

1. **railway-start.sh** - Production startup script with proper caching
2. **nixpacks.toml** - Build configuration that runs `npm run build` (not `npm run dev`)
3. **ASSET_URL** - Added to ensure Vite assets are served correctly

## Environment Variables to Set in Railway

Make sure these are set in your Railway project settings:

```
APP_KEY=base64:your-generated-key-here
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.railway.app
```

To generate APP_KEY locally, run:
```bash
php artisan key:generate --show
```

## Database Configuration

If using Railway MySQL, these are automatically set:
- MYSQLHOST
- MYSQLPORT
- MYSQLDATABASE
- MYSQLUSER
- MYSQLPASSWORD

## Deploy Steps

1. Commit and push your changes:
```bash
git add .
git commit -m "Fix production asset serving"
git push
```

2. Railway will automatically:
   - Install PHP and Node dependencies
   - Run `npm run build` to compile assets
   - Execute railway-start.sh on startup
   - Run migrations
   - Cache routes and config

## Verify Deployment

After deployment, check:
- ✅ Styles are loading (Tailwind CSS)
- ✅ Alpine.js animations work
- ✅ Navigation works
- ✅ Database connections work

## Troubleshooting

If styles still don't load:
1. Check Railway logs for build errors
2. Verify APP_URL matches your Railway domain
3. Ensure `public/build` directory exists after build
4. Check that manifest.json exists in `public/build`
