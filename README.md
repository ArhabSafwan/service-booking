
# 🛠️ Simple Service Booking System (API-Based) – Laravel 12

This is a basic service booking system built with Laravel 12 that allows **customers** to register, log in, view services, and book them. An **admin** user can manage services and view all bookings.

This project was developed to demonstrate API development, authentication, database relationships, validation, and clean code organization.

---

## ✅ Features

### 🔐 Authentication (Laravel Sanctum)
- Customer registration and login
- Admin login (via seeded credentials)
- Token-based authentication using Sanctum

### 👥 User Roles
- Customer (default)
- Admin (via `is_admin` flag in the `users` table)

### 📦 Models & Relationships
- `User` (has many `bookings`)
- `Service` (has many `bookings`)
- `Booking` (belongs to `user` and `service`)

### 📡 API Endpoints

#### Public
- `POST /api/register` – Register as customer
- `POST /api/login` – Login (admin or customer)

#### Authenticated (Customer)
- `GET /api/services` – List available services
- `POST /api/bookings` – Book a service
- `GET /api/bookings` – View your bookings

#### Authenticated (Admin)
- `POST /api/services` – Create a service
- `PUT /api/services/{id}` – Update a service
- `DELETE /api/services/{id}` – Delete a service
- `GET /api/admin/bookings` – View all bookings

---

## 🚀 Getting Started

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/service-booking-api.git
cd service-booking-api
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Setup `.env` and Generate Key
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database
Update your `.env` file with your database credentials:

```
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_pass
```

### 5. Run Migrations & Seed Admin User and Services
```bash
php artisan migrate --seed
```

Admin credentials will be seeded like:
```json
{
  "email": "asafwan72@gmail.com",
  "password": "123456",
  "is_admin": true
}
```

Services will be seeded like:
```json
{
    "name": "Haircut",
    "description": "Professional haircut by our expert stylists.",
    "price": 25.00,
    "status": "true",
    "created_at": "yy-mm-ddT00:00:00.000000Z",
    "updated_at": "yy-mm-ddT00:00:00.000000Z"
  }
```

### 6. Serve the API
```bash
php artisan serve
```

API will be available at: `http://127.0.0.1:8000`

---

## 🧪 How to Test the API (Postman)

1. Import the included Postman collection (if provided).
2. Set the base URL: `http://127.0.0.1:8000/api`
3. Register/login a user and copy the `Bearer` token.
4. Use the token in `Authorization > Bearer Token` for subsequent requests.

---

### Postman Collection

You can test the API using the provided Postman collection:

- **File:** `postman/Servcie Booking System.postman_collection.json`
- **How to use:**
  1. Open Postman
  2. Go to `File` > `Import`
  3. Select the downloaded `.json` file
  4. Use the collection to test all available endpoints

---

## 🖼️ Screenshots (Optional)

<details>
<summary>Sample JSON to book a service</summary>

```json
{
  "service_id": 2,
  "booking_date": "2025-08-01",
}
```
</details>

---

## ✅ To-Do (Optional Enhancements)
- Add unit/feature tests
- Swagger/OpenAPI documentation
- Live deployment on Render/Railway
- Admin panel frontend (bonus)

---

## 📁 Project Structure
- `app/Models`: Contains `User`, `Service`, `Booking`
- `app/Http/Controllers/Api`: All API Controllers
- `routes/api.php`: All API routes
- `database/seeders`: Admin user and service seeder

---

## 👤 Author
**Arhab Safwan**  
📧 Email: [asafwan72@gmail.com](mailto:asafwan72@gmail.com)

---

## 📝 License
This project is open source and free to use for educational and demo purposes.
