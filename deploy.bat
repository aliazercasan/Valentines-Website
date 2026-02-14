@echo off
echo ====================================
echo Building for Production Deployment
echo ====================================
echo.

echo Step 1: Installing dependencies...
call composer install --optimize-autoloader --no-dev
echo.

echo Step 2: Installing NPM packages...
call npm install
echo.

echo Step 3: Building assets for production...
call npm run build
echo.

echo Step 4: Optimizing Laravel...
call php artisan config:cache
call php artisan route:cache
call php artisan view:cache
echo.

echo ====================================
echo Build Complete!
echo ====================================
echo.
echo Your application is ready for deployment.
echo.
echo Next steps:
echo 1. Upload all files to InfinityFree via FTP
echo 2. Point your domain to the 'public' folder
echo 3. Update .env file on the server
echo 4. Run migrations on the server
echo.
pause
