#!/bin/bash

echo "🚂 Railway Startup Script"

# Create .env if it doesn't exist
if [ ! -f .env ]; then
    echo "📝 Creating .env file..."
    cp .env.example .env
fi

# Set APP_KEY from environment variable
if [ ! -z "$APP_KEY" ]; then
    echo "🔑 Setting APP_KEY..."
    sed -i "s|APP_KEY=.*|APP_KEY=$APP_KEY|g" .env
fi

# Set other environment variables
echo "⚙️ Configuring environment..."
sed -i "s|APP_ENV=.*|APP_ENV=${APP_ENV:-production}|g" .env
sed -i "s|APP_DEBUG=.*|APP_DEBUG=${APP_DEBUG:-false}|g" .env
sed -i "s|APP_URL=.*|APP_URL=${APP_URL:-http://localhost}|g" .env

# Database configuration
if [ ! -z "$MYSQLHOST" ]; then
    echo "🗄️ Configuring database..."
    sed -i "s|DB_CONNECTION=.*|DB_CONNECTION=mysql|g" .env
    sed -i "s|DB_HOST=.*|DB_HOST=$MYSQLHOST|g" .env
    sed -i "s|DB_PORT=.*|DB_PORT=$MYSQLPORT|g" .env
    sed -i "s|DB_DATABASE=.*|DB_DATABASE=$MYSQLDATABASE|g" .env
    sed -i "s|DB_USERNAME=.*|DB_USERNAME=$MYSQLUSER|g" .env
    sed -i "s|DB_PASSWORD=.*|DB_PASSWORD=$MYSQLPASSWORD|g" .env
fi

# Session and cache
sed -i "s|SESSION_DRIVER=.*|SESSION_DRIVER=file|g" .env
sed -i "s|CACHE_STORE=.*|CACHE_STORE=file|g" .env
sed -i "s|QUEUE_CONNECTION=.*|QUEUE_CONNECTION=sync|g" .env

# Create storage directories
echo "📁 Setting up storage..."
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
chmod -R 775 storage bootstrap/cache

# Clear caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Run migrations
echo "🔄 Running migrations..."
php artisan migrate --force || echo "⚠️ Migrations failed or already run"

echo "✅ Setup complete!"
echo "🚀 Starting server..."

# Start the server
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
