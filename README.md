# Task Demo

A Laravel-based REST API with JWT authentication and MySQL database.

## Requirements

- PHP 8.1 or higher
- Composer
- MySQL 5.7 or higher

## Installation

1. Clone the repository
```bash
git clone https://github.com/your-username/task_demo.git
cd task_demo
```

2. Install PHP dependencies
```bash
composer install
```

3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
```

4. Configure Database
Update your `.env` file with your MySQL credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

5. Run Migrations
```bash
php artisan migrate
```

## API Authentication Endpoints

### Register
```
POST /api/auth/register
{
    "name": "User Name",
    "email": "user@example.com",
    "password": "password",
    "password_confirmation": "password"
}
```

### Login
```
POST /api/auth/login
{
    "email": "user@example.com",
    "password": "password"
}
```

### Protected Routes
Add the JWT token to your requests:
```
Authorization: Bearer {your_jwt_token}
```

## Running the Application

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Testing

```bash
php artisan test
```

## Security

- JWT tokens expire after 60 minutes (configurable in config/jwt.php)
- Tokens can be blacklisted using the logout endpoint
- Refresh tokens are available for extended sessions
