# Restaurant Management System

A modern restaurant management system built with Laravel, featuring menu management, reservations, and admin controls.

## Features

- 🍽️ Menu Management
  - Create, edit, and delete menu items
  - Category organization
  - Special tags (Vegetarian, Gluten-free, Featured)
  - Image upload support
  - Price and availability management

- 📅 Reservation System
  - Book tables
  - Manage reservation status
  - Time slot management
  - Capacity tracking

- 👤 User Management
  - Authentication and Authorization
  - Admin dashboard
  - Staff management

## Prerequisites

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL or PostgreSQL
- Git

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/restaurant-app.git
cd restaurant-app
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install NPM dependencies:
```bash
npm install
```

4. Create environment file:
```bash
copy .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your database in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=restaurant_app
DB_USERNAME=root
DB_PASSWORD=
```

7. Run migrations and seeders:
```bash
php artisan migrate --seed
```

8. Link storage:
```bash
php artisan storage:link
```

9. Build assets:
```bash
npm run build
```

## Running the Application

1. Start the Laravel development server:
```bash
php artisan serve
```

2. Start the Vite development server:
```bash
npm run dev
```

3. Access the application at `http://localhost:8000`

## Default Admin Credentials

```
Email: admin@example.com
Password: password
```

## Testing

Run the test suite:
```bash
php artisan test
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
