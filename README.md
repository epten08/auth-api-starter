# Laravel 11 API Boilerplate 🚀

An open-source API boilerplate built with **Laravel 11**, following best practices for **authentication, logging, rate-limiting**, and **repository pattern**.

## 📌 Features
- ✅ **Authentication** (Sanctum)
- ✅ **Form Request Validation**
- ✅ **Rate Limiting**
- ✅ **Repository & Service Pattern**
- ✅ **Exception Handling with JSON Responses**
- ✅ **Docker Support**
- ✅ **API Documentation (Swagger)**

---

## 🚀 Installation

1️⃣ Clone the Repository
```bash
git clone https://github.com/epten08/auth-api-starter.git
cd auth-api-starter
```

2️⃣ Install Dependencies
```bash
composer install
```

3️⃣ Set Up Environment Variables
```bash
cp .env.example .env
```

4️⃣ Generate Application Key
```bash
php artisan key:generate
```

5️⃣ Run Migrations
```bash
php artisan migrate
```

6️⃣ Start the Development Server
```bash
php artisan serve
```

## 🧪 Running Tests

To run the tests, use the following command:
```bash
php artisan test
```

## 📚 API Documentation

API documentation is generated using Swagger. To view the documentation, start the development server and navigate to `/api/documentation`.

## 🐳 Docker Support

This project includes Docker support. To start the application using Docker, run the following commands:
```bash
docker-compose up -d
```

## 🤝 Contributing

Contributions are welcome! Please open an issue or submit a pull request for any changes.

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).
