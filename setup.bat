@echo off
echo ====================================
echo Valentine's Day App Setup
echo ====================================
echo.

echo Installing Composer dependencies...
call composer install
echo.

echo Installing NPM dependencies...
call npm install
echo.

echo Setting up environment file...
if not exist .env (
    copy .env.example .env
    echo .env file created
) else (
    echo .env file already exists
)
echo.

echo Generating application key...
call php artisan key:generate
echo.

echo Creating database...
if not exist database\database.sqlite (
    type nul > database\database.sqlite
    echo SQLite database created
) else (
    echo Database already exists
)
echo.

echo Running migrations...
call php artisan migrate
echo.

echo Seeding demo data...
call php artisan db:seed --class=DemoSeeder
echo.

echo Building assets...
call npm run build
echo.

echo ====================================
echo Setup Complete!
echo ====================================
echo.
echo To start the application, run:
echo php artisan serve
echo.
echo Then visit: http://localhost:8000
echo.
pause
