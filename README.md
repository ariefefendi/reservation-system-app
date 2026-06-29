# Laravel 8 RESTful API with Domain-Driven Design (DDD)

A RESTful API project built with **Laravel 8** following the **Domain-Driven Design (DDD)** architectural approach. The project uses **Laravel Sanctum** for API authentication and demonstrates a clean separation between business domains, application logic, and infrastructure.

---

## Features

* RESTful API
* Domain-Driven Design (DDD)
* Laravel Sanctum Authentication
* CRUD API
* Reservation Management
* Table Management
* API Token Authentication
* JSON Response
* MySQL Database
* Clean Project Structure

---

## Technology Stack

| Layer              | Technology         |
| ------------------ | ------------------ |
| Framework          | Laravel 8          |
| Language           | PHP 7.3+ / PHP 8.x |
| Authentication     | Laravel Sanctum    |
| Database           | MySQL              |
| API                | RESTful API        |
| Dependency Manager | Composer           |
| Frontend Build     | Laravel Mix        |

---

## Composer Dependencies

* Laravel Framework 8.54
* Laravel Sanctum
* Guzzle HTTP
* Carbon
* Laravel Tinker

---

## Architecture

This project follows the **Domain-Driven Design (DDD)** approach to improve maintainability and scalability by separating business logic into domain-oriented modules.

```text
Client
   │
   ▼
REST API
   │
   ▼
Application Layer
   │
   ▼
Domain Layer
   │
   ▼
Infrastructure Layer
   │
   ▼
MySQL Database
```

---

## Authentication

Authentication is implemented using **Laravel Sanctum**.

Every protected endpoint requires a valid **Bearer Token**.

Workflow:

1. Register a new user.
2. Login.
3. Receive a Bearer Token.
4. Access protected API endpoints.

---

## API Documentation

Complete API documentation is available via Postman Documenter.

> https://documenter.getpostman.com/view/3765556/2s9YynkirH

---

## Installation

### Clone Repository

```bash
git clone https://github.com/yourusername/your-repository.git
```

### Install Composer Dependencies

```bash
composer install
```

### Configure Environment

```bash
cp .env.example .env
```

Configure your database credentials inside `.env`.

### Generate Application Key

```bash
php artisan key:generate
```

### Run Database Migration

```bash
php artisan migrate
```

### Install Laravel Sanctum

```bash
composer require laravel/sanctum
```

Publish Sanctum assets.

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

Run migration again if necessary.

```bash
php artisan migrate
```

### Start Development Server

```bash
php artisan serve
```

Default URL

```
http://127.0.0.1:8000
```

---

## Reservation Workflow

The application follows the following business process:

1. Register an account.
2. Login to obtain a Bearer Token.
3. Create master table data.
4. Create reservation records.
5. Complete the reservation process.
6. Close the reservation.
7. Update reservation reports automatically.

---

## Project Status

Current implementation includes:

* RESTful API
* Domain-Driven Design (DDD)
* Laravel Sanctum Authentication
* Reservation Module
* Table Management
* CRUD Operations

---

## Future Improvements

The following features are planned for future development:

* Unit Testing
* Feature Testing
* Database Seeders
* API Versioning
* Request Validation
* Exception Handling
* Docker Support
* Swagger / OpenAPI Documentation
* CI/CD Pipeline

---

## License

This project is intended for educational purposes and serves as a reference implementation of **RESTful API development using Laravel 8 and Domain-Driven Design (DDD)**.
