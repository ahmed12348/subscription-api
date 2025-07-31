<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# 📦 Laravel 11 Subscription API

A robust **backend RESTful API** built with Laravel 11 that provides subscription management with multiple payment gateways.

## ✨ Features

- 🔐 **User Authentication** via Laravel Sanctum
- 📋 **Subscription Plans** management (seeded data)
- 💳 **Stripe Checkout** integration
- 💰 **PayPal Checkout** integration
- 🛡️ **Token-based Authentication**
- 📊 **Database Seeding** with sample plans
- 🧪 **API Testing** ready

---

## 🚀 Tech Stack

- **Framework:** Laravel 11
- **Authentication:** Laravel Sanctum
- **Database:** MySQL/PostgreSQL
- **Payment Gateways:** 
  - Stripe PHP SDK
  - PayPal REST API (via Guzzle)
- **Testing:** Postman/Insomnia
- **PHP Version:** 8.2+

---

## ⚙️ Installation & Setup

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL/PostgreSQL
- Node.js (for frontend assets)

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/subscription-api.git
cd subscription-api
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup

Update your `.env` file with database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=subscription_api
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Payment Gateway Configuration

#### Stripe Configuration
```env
STRIPE_KEY=your_stripe_publishable_key
STRIPE_SECRET=your_stripe_secret_key
```

#### PayPal Configuration
```env
PAYPAL_CLIENT_ID=your_paypal_client_id
PAYPAL_CLIENT_SECRET=your_paypal_client_secret
PAYPAL_SANDBOX=true
```

### 6. Run Migrations & Seed Data

```bash
php artisan migrate --seed
```

This will create:
- Users table
- Plans table (with seeded data)
- Personal access tokens table
- Cache and jobs tables

### 7. Start the Development Server

```bash
php artisan serve
```

Your API will be available at `http://localhost:8000`

---

## 📚 API Endpoints

### Authentication Endpoints

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| `POST` | `/api/register` | Register a new user | ❌ |
| `POST` | `/api/login` | Login and get access token | ❌ |
| `POST` | `/api/logout` | Logout (revoke token) | ✅ |

### Subscription Plans

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| `GET` | `/api/plans` | Get all subscription plans | ❌ |

### Checkout Endpoints

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| `POST` | `/api/checkout/stripe` | Create Stripe checkout session | ✅ |
| `POST` | `/api/checkout/paypal` | Create PayPal checkout session | ✅ |

---

## 🔧 API Usage Examples

### 1. User Registration

```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

**Response:**
```json
{
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "created_at": "2024-01-01T00:00:00.000000Z"
  },
  "token": "1|abc123..."
}
```

### 2. User Login

```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
```

### 3. Get Subscription Plans

```bash
curl -X GET http://localhost:8000/api/plans
```

**Response:**
```json
[
  {
    "id": 1,
    "name": "Basic Plan",
    "price": "9.99",
    "currency": "USD",
    "interval": "monthly"
  },
  {
    "id": 2,
    "name": "Pro Plan",
    "price": "99.99",
    "currency": "USD",
    "interval": "yearly"
  }
]
```

### 4. Stripe Checkout

```bash
curl -X POST http://localhost:8000/api/checkout/stripe \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "plan_id": 1
  }'
```

**Response:**
```json
{
  "checkout_url": "https://checkout.stripe.com/pay/cs_test_..."
}
```

### 5. PayPal Checkout

```bash
curl -X POST http://localhost:8000/api/checkout/paypal \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "plan_id": 1
  }'
```

**Response:**
```json
{
  "approval_url": "https://www.sandbox.paypal.com/checkoutnow?token=..."
}
```

---

## 🧪 Testing with Postman

### 1. Authentication Flow

1. **Register/Login** to get your access token
2. **Copy the token** from the response
3. **Set Authorization Header** in Postman:
   - Type: `Bearer Token`
   - Token: `your_token_here`

### 2. Testing Protected Endpoints

- Add the `Authorization` header to all protected routes
- Test checkout endpoints with valid `plan_id`
- Verify JSON responses

### 3. Postman Collection

Create a collection with these requests:
- Register User
- Login User
- Get Plans
- Stripe Checkout
- PayPal Checkout
- Logout

---

## 📁 Project Structure

```
subscription-api/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php      # User authentication
│   │       ├── PlanController.php      # Plan management
│   │       └── CheckoutController.php  # Payment processing
│   └── Models/
│       ├── User.php                    # User model
│       └── Plan.php                    # Plan model
├── config/
│   ├── stripe.php                      # Stripe configuration
│   └── paypal.php                      # PayPal configuration
├── database/
│   ├── migrations/                     # Database migrations
│   └── seeders/
│       └── PlanSeeder.php              # Sample plans data
└── routes/
    └── api.php                         # API routes
```

---

## 🔐 Environment Variables

Create a `.env` file with these variables:

```env
# Application
APP_NAME="Subscription API"
APP_ENV=local
APP_KEY=base64:your_key_here
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=subscription_api
DB_USERNAME=root
DB_PASSWORD=

# Stripe
STRIPE_KEY=your_stripe_publishable_key
STRIPE_SECRET=your_stripe_secret_key

# PayPal
PAYPAL_CLIENT_ID=your_paypal_client_id
PAYPAL_CLIENT_SECRET=your_paypal_client_secret
PAYPAL_SANDBOX=true
```

---

## 🚨 Troubleshooting

### Common Issues

1. **SSL Certificate Error (WAMP/XAMPP)**
   - Download `cacert.pem` from https://curl.se/ca/cacert.pem
   - Add to `php.ini`: `curl.cainfo = "path/to/cacert.pem"`

2. **Database Connection Error**
   - Verify database credentials in `.env`
   - Ensure database exists
   - Check if MySQL service is running

3. **Payment Gateway Errors**
   - Verify API keys are correct
   - Check if using sandbox/test keys for development
   - Ensure proper webhook configuration (if needed)

### Development Tips

- Use **Postman** or **Insomnia** for API testing
- Enable **APP_DEBUG=true** for detailed error messages
- Check **storage/logs/laravel.log** for error logs
- Use **php artisan route:list** to see all available routes

---

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 👨‍💻 Author

**Your Name** - [GitHub Profile](https://github.com/yourusername)

Feel free to reach out for questions or contributions!

---

## 📞 Support

If you encounter any issues or have questions:

- Create an issue on GitHub
- Check the troubleshooting section above
- Review Laravel documentation for framework-specific questions

---

**Happy Coding! 🚀**
