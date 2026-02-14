<?php
// Railway Debug Script - DELETE AFTER FIXING
echo "<h1>Railway Debug Info</h1>";

echo "<h2>Environment Variables</h2>";
echo "APP_KEY: " . (getenv('APP_KEY') ? 'SET ✓' : 'NOT SET ✗') . "<br>";
echo "APP_ENV: " . getenv('APP_ENV') . "<br>";
echo "APP_DEBUG: " . getenv('APP_DEBUG') . "<br>";
echo "DB_CONNECTION: " . getenv('DB_CONNECTION') . "<br>";

echo "<h2>File Checks</h2>";
echo ".env exists: " . (file_exists(__DIR__.'/.env') ? 'YES ✓' : 'NO ✗') . "<br>";
echo "vendor exists: " . (file_exists(__DIR__.'/vendor') ? 'YES ✓' : 'NO ✗') . "<br>";
echo "public/build exists: " . (file_exists(__DIR__.'/public/build') ? 'YES ✓' : 'NO ✗') . "<br>";
echo "storage writable: " . (is_writable(__DIR__.'/storage') ? 'YES ✓' : 'NO ✗') . "<br>";

echo "<h2>PHP Info</h2>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Laravel Path: " . __DIR__ . "<br>";

echo "<h2>Try Laravel</h2>";
try {
    require __DIR__.'/vendor/autoload.php';
    $app = require_once __DIR__.'/bootstrap/app.php';
    echo "Laravel Bootstrap: SUCCESS ✓<br>";
} catch (Exception $e) {
    echo "Laravel Bootstrap: FAILED ✗<br>";
    echo "Error: " . $e->getMessage() . "<br>";
}

echo "<hr><p>Delete this file after debugging: railway-debug.php</p>";
