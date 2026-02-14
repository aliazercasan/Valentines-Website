@echo off
echo ====================================
echo Valentine's Day App Verification
echo ====================================
echo.

echo Checking PHP version...
php -v | findstr /C:"PHP"
echo.

echo Checking Composer...
composer --version | findstr /C:"Composer"
echo.

echo Checking Node.js...
node -v
echo.

echo Checking NPM...
npm -v
echo.

echo Checking database file...
if exist database\database.sqlite (
    echo [OK] Database file exists
) else (
    echo [ERROR] Database file missing
)
echo.

echo Checking .env file...
if exist .env (
    echo [OK] Environment file exists
) else (
    echo [ERROR] .env file missing
)
echo.

echo Checking vendor directory...
if exist vendor (
    echo [OK] Composer dependencies installed
) else (
    echo [ERROR] Run: composer install
)
echo.

echo Checking node_modules...
if exist node_modules (
    echo [OK] NPM dependencies installed
) else (
    echo [ERROR] Run: npm install
)
echo.

echo Checking built assets...
if exist public\build (
    echo [OK] Assets built
) else (
    echo [ERROR] Run: npm run build
)
echo.

echo Checking routes...
php artisan route:list --columns=Method,URI,Name | findstr /C:"home" /C:"login" /C:"dashboard"
echo.

echo ====================================
echo Verification Complete!
echo ====================================
echo.
echo If all checks passed, run:
echo php artisan serve
echo.
echo Then visit: http://localhost:8000
echo Demo: http://localhost:8000/m/demo123456
echo.
pause
