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
git clone https://github.com/somealeksandr/finance-management
cd finance-management
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

## Email Server Setup

### For testing email notifications, you can use MailHog or Mailtrap.

### 1. MailHog:
###  * Configure your .env file for MailHog:
```dotenv
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```
### * Run MailHog:
```bash
mailhog
```
### Emails will be accessible at http://localhost:8025.

### 2. Mailtrap:
### Set up your Mailtrap account and use the provided SMTP settings in .env:
```dotenv
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
```

## Running Tests

### To run the tests, use the following command:

```bash
php artisan test
```

### The tests cover key functionalities, such as creating transactions, filtering and balance checking.
