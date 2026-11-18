# 📚 Vellum

**Vellum** is a full-featured virtual library platform built with the **TALL stack** (Tailwind CSS, Alpine.js, Livewire, Laravel). It allows users to explore an extensive catalog of books integrated with the Gutendex API, manage their profiles, participate in an interactive book club, and more.

This project demonstrates modern Laravel capabilities, including Livewire (Volt) components, file uploads with cropping, relational database modeling, and reactive JavaScript interactions.

---

## 🚀 Key Features

### 🔐 Authentication & Account Management
- Custom Vellum login, registration, and profile management flow

### 📊 Dynamic Dashboard
- Personalized user greetings
- Interactive carousels powered by Splide.js for **Top Downloads**, **Favorites**, and **Genres**

### 🔍 Book Discovery
- Genre tab navigation built with Alpine.js
- Tag filtering (Main Genres and Additional Tags)

### 📖 Book Details Modal
- Synopsis, authors, and book cover preview
- 1–5 star rating system with automatic average recalculation
- Real-time favorites toggle

### 👤 Profile Management
- Update name and email
- Profile picture upload with interactive cropping (Cropper.js)
- Secure account deletion

### 📚 Interactive Book Club
- Join/Leave club membership
- Book of the month and reading history
- Discussion forum with comments

### 🔄 External Integration
- Live book metadata fetched from the **Gutendex API**
- Reactive UI updates powered by Livewire

---

## 🛠️ Tech Stack

- **Backend:** Laravel 11, PHP 8.2+
- **Frontend:** Livewire 3 (Volt), Blade Templates, Tailwind CSS, Alpine.js
- **JavaScript Libraries:** Splide.js (carousels), Cropper.js (image cropping)
- **Database:** MySQL / PostgreSQL with Eloquent ORM

---

## 📦 Local Setup

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL or PostgreSQL

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/isahlopess/vellum.git
cd vellum

# 2. Install PHP and JavaScript dependencies
composer install
npm install

# 3. Set up environment variables
cp .env.example .env
php artisan key:generate

# 4. Configure your database credentials in .env
# Edit: DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 5. Run database migrations
php artisan migrate

# 6. Create the storage symlink
php artisan storage:link

# 7. (Optional) Seed initial data
php artisan db:seed

# 8. Compile frontend assets
npm run dev

# 9. Start the development server
php artisan serve
```
