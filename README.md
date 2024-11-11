# Financial Transaction Management System

This project is a financial transaction management system for users that allows creating transactions, viewing transaction lists, filtering by date and type, and calculating the current balance. Additionally, there is an automatic notification feature when the balance drops below a certain threshold.

## Requirements

To run the project, you need the following tools:

- PHP 8.0 or higher
- Composer
- MySQL
- Laravel 10.x
- MailHog or Mailtrap for testing emails (optional)

## Installation and Setup

### 1. Clone the Repository

First, clone the project repository:

```bash
git clone https://github.com/your-username/project-name.git
cd project-name
```

### 2. Install dependencies

```bash
composer install
```

### 3. Configure the environment

Copy the `.env.example` file to `.env` and configure your database and other environment variables:

```bash
cp .env.example .env
```

Update the `.env` file with your database credentials:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

### 4. Generate application key

```bash
php artisan key:generate
```

### 5. Run migrations

```bash
php artisan migrate
```

### 6. Seed the database

```bash
php artisan db:seed
```

### 7. Serve the application

You can serve the application locally using Laravel's built-in server:

```bash
php artisan serve
```

The application will be accessible at `http://localhost:8000`.

## API Endpoints

- `POST /api/transactions`: Create new transaction.
- `GET /api/transactions`: Return all transactions with pagination.
- `GET /api/users/{user}/transactions`: Return user transactions with pagination.
- `GET /api/users/{user}/balance`: Return balance user.

## Running Tests

### To run the tests, use the following command:

```bash
php artisan test
```

### The tests cover key functionalities, such as creating transactions, filtering and balance checking.
