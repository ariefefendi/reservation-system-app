# Laravel RESTful API with Modular Architecture (DDD Principles)

A RESTful API project built with **Laravel 8** using a **Modular Architecture** inspired by **Domain-Driven Design (DDD) principles**. The project leverages **Laravel Sanctum** for secure API authentication and organizes business logic into feature-oriented modules, improving maintainability, readability, and scalability.

---

# Features

* RESTful API
* Modular Feature-Based Architecture
* DDD-Inspired Design
* Laravel Sanctum Authentication
* Reservation Management
* Table Management
* CRUD Operations
* Business Logic Separation
* Validation Layer
* Exception Handling
* JSON API Response
* MySQL Database

---

# Technology Stack

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

# Main Dependencies

* Laravel Framework 8.54
* Laravel Sanctum
* Guzzle HTTP Client
* Carbon
* Laravel Tinker

---

# Architecture

This project adopts a **Modular Architecture** while applying several **DDD (Domain-Driven Design) principles**. Instead of implementing a full DDD structure, business logic is organized into independent feature modules, making the application easier to maintain and extend.

```text
                Client
                   │
                   ▼
          Laravel REST API
                   │
                   ▼
        Authentication Module
        Reservation Module
        Table Number Module
        Report Reservation Module
                   │
                   ▼
      Validation • Business Logic
      Exception Handling • Queries
                   │
                   ▼
             MySQL Database
```

Each module encapsulates its own responsibilities, including:

* Business Logic
* Validation
* Exception Handling
* Query Processing
* HTTP Controller

This approach reduces code coupling while keeping each business feature self-contained.

---

# Project Structure

```text
app/
│
├── Http/
│   ├── Controllers/
│   │
│   ├── Authentication/
│   ├── Reservations/
│   ├── TableNumber/
│   └── ReportReservations/
│       ├── src/
│       │   ├── businessQuery/
│       │   ├── exceptions/
│       │   ├── setability/
│       │   └── validations/
│       │
│       └── ReportReservationsController.php
│
├── Models/
├── Middleware/
└── ...
```

The application is organized by **feature modules** rather than placing all business logic into a single controller layer.

---

# Authentication

Authentication is implemented using **Laravel Sanctum**.

Protected endpoints require a valid **Bearer Token**.

Authentication flow:

1. Register a new account.
2. Login.
3. Receive a Bearer Token.
4. Access protected REST API endpoints.

---

# API Documentation

Complete API documentation is available through **Postman Documenter**.

```
https://documenter.getpostman.com/view/3765556/2s9YynkirH
```

---

# ⚙️ Installation

## Clone Repository

```bash
git clone https://github.com/yourusername/your-repository.git
```

## Install Dependencies

```bash
composer install
```

## Configure Environment

```bash
cp .env.example .env
```

Update your database configuration inside the `.env` file.

## Generate Application Key

```bash
php artisan key:generate
```

## Run Migration

```bash
php artisan migrate
```

## Install Laravel Sanctum

```bash
composer require laravel/sanctum
```

Publish Sanctum configuration.

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

Run migration again if necessary.

```bash
php artisan migrate
```

## Start Development Server

```bash
php artisan serve
```

Application URL

```
http://127.0.0.1:8000
```

---

# Business Workflow

The reservation process follows these steps:

1. Register a user account.
2. Authenticate and obtain a Bearer Token.
3. Create master table data.
4. Create reservation records.
5. Process reservation transactions.
6. Complete or close reservations.
7. Automatically update reservation reports.

---

# Current Implementation

The project currently includes:

* Laravel 8 RESTful API
* Modular Architecture
* DDD Principles
* Laravel Sanctum Authentication
* Reservation Module
* Table Management
* Validation Layer
* Exception Handling
* Business Query Layer
* CRUD Operations

---

# Future Improvements

Planned enhancements include:

* Unit Testing
* Feature Testing
* Database Seeders
* Repository Pattern
* Service Layer
* API Versioning
* Swagger / OpenAPI Documentation
* Docker Support
* CI/CD Pipeline

---

# License

This project is intended for educational purposes and serves as a reference implementation of a **Laravel RESTful API** using a **Modular Architecture inspired by Domain-Driven Design (DDD) principles**.
