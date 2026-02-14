# 💌 Valentine's Day Envelope App

A modern, professional, responsive Valentine's Day web application where users can create and share personalized messages in beautiful animated envelopes.

## ✨ Features

### For Authenticated Users
- Create an account with just username and password
- Write custom Valentine's messages
- Generate unique shareable links
- Preview messages before sharing
- View all created messages in dashboard

### For Guests
- Open animated envelopes via shared links
- View personalized Valentine's messages
- Copy links to share with others
- Beautiful, romantic animations

## 🎨 Design Features

- **Modern UI**: Clean, professional design with Tailwind CSS
- **Smooth Animations**: Alpine.js powered envelope opening animation
- **Fully Responsive**: Works perfectly on mobile, tablet, and desktop
- **Valentine Theme**: Pink and red color scheme with heart animations
- **Interactive Elements**: Click-to-open envelope with floating hearts

## 🚀 Getting Started

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM

### Installation

1. Install PHP dependencies:
```bash
composer install
```

2. Install Node dependencies:
```bash
npm install
```

3. Set up environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Run migrations:
```bash
php artisan migrate
```

5. Build assets:
```bash
npm run build
```

6. Start the development server:
```bash
php artisan serve
```

Visit `http://localhost:8000` to see the application.

## 📱 Usage

### Creating a Message

1. Register or login with a username and password
2. Click "Create Message" from the dashboard
3. Write your Valentine's message (up to 1000 characters)
4. Click "Create & Preview" to see your envelope
5. Copy the shareable link and send it to your Valentine!

### Viewing a Message

1. Open the shared link (e.g., `http://localhost:8000/m/abc123xyz`)
2. Click on the envelope to open it
3. Enjoy the animated reveal with floating hearts
4. Read the personalized message
5. Copy the link to share with others

## 🗄️ Database Schema

### Users Table
- `id`: Primary key
- `username`: Unique username
- `password`: Hashed password
- `remember_token`: For "remember me" functionality
- `timestamps`: Created/updated timestamps

### Messages Table
- `id`: Primary key
- `user_id`: Foreign key to users table
- `message_text`: The Valentine's message content
- `share_slug`: Unique 10-character slug for sharing
- `timestamps`: Created/updated timestamps

## 🛠️ Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Blade Templates
- **Styling**: Tailwind CSS
- **Interactivity**: Alpine.js
- **Database**: SQLite (easily switchable to MySQL/PostgreSQL)
- **Build Tool**: Vite

## 🎯 Key Routes

- `/` - Home page
- `/register` - User registration
- `/login` - User login
- `/dashboard` - User dashboard (auth required)
- `/messages/create` - Create new message (auth required)
- `/m/{slug}` - View shared message (public)

## 🎨 Customization

### Colors
The app uses a Valentine's Day color scheme. To customize, edit the Tailwind classes in the Blade templates:
- Primary: `red-500`
- Secondary: `pink-500`
- Background: `pink-50`, `red-50`

### Animations
Envelope animations are controlled in `resources/views/messages/show.blade.php` using Alpine.js and custom CSS.

## 📝 License

This project is open-source and available under the MIT License.

## 💝 Perfect For

- Valentine's Day surprises
- Romantic gestures
- Long-distance relationships
- Anniversary messages
- Just because moments

---

Made with ❤️ for spreading love on Valentine's Day
