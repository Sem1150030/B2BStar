# ⭐ Star – B2B Marketplace Platform

Star is a B2B marketplace platform where **brands** can showcase and sell products to **retailers**.  
It’s built with **Laravel 12**, **Livewire**, **Tailwind CSS**, **Flux**, and **MySQL**.

---

## ✨ Features

- **Role-based access**:
  - Brands: Add/manage products, pricing, and stock
  - Retailers: Browse catalog, place wholesale orders, request quotes
  - Admins: Oversee and manage the platform
- **Product catalog** with categories, variants, and search
- **Wholesale pricing tiers** and bulk discounts
- **Order management** (pending → confirmed → shipped → completed)
- **Messaging / RFQ** between retailers and brands
- **Analytics dashboards** for brands and retailers
- **Modern UI** powered by Tailwind CSS + Flux

---

## 🛠️ Tech Stack

- [Laravel 12](https://laravel.com/) – backend framework  
- [Livewire](https://livewire.laravel.com/) – reactive components  
- [Tailwind CSS](https://tailwindcss.com/) – styling  
- [Flux](https://flux.dev/) – state management  
- [MySQL](https://www.mysql.com/) – relational database  

---

## 🚀 Getting Started

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL

### Installation

```bash
# Clone the repository
git clone https://github.com/yourusername/star-b2b.git

cd star-b2b

# Install PHP dependencies
composer install

# Install JS dependencies
npm install && npm run dev

# Copy .env and set up environment variables
cp .env.example .env

# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate --seed

# Start development server
php artisan serve
