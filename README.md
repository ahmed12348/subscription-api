# Laravel 11 Subscription API

Backend RESTful API for subscription management with Stripe and PayPal integration.

## Features
- User Authentication (Laravel Sanctum)
- Subscription Plans Management
- Stripe Checkout
- PayPal Checkout

## Tech Stack
- Laravel 11
- MySQL/PostgreSQL
- Stripe PHP SDK
- PayPal REST API
- PHP 8.2+

## Quick Setup

### 1. Install Dependencies
```bash
composer install
cp .env.example .env
php artisan key:generate
```

### 2. Database Configuration
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=subscription_api
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Payment Gateways
```env
# Stripe
STRIPE_KEY=pk_test_51OqXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
STRIPE_SECRET=sk_test_51OqXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

# PayPal
PAYPAL_CLIENT_ID=your_paypal_client_id_here
PAYPAL_CLIENT_SECRET=your_paypal_client_secret_here
PAYPAL_SANDBOX=true
```

### 4. Run Migrations
```bash
php artisan migrate --seed
php artisan serve
```

## API Endpoints

### Authentication
| Method | Endpoint | Auth |
|--------|----------|------|
| POST | `/api/register` | ❌ |
| POST | `/api/login` | ❌ |
| POST | `/api/logout` | ✅ |

### Plans
| Method | Endpoint | Auth |
|--------|----------|------|
| GET | `/api/plans` | ❌ |

### Checkout
| Method | Endpoint | Auth |
|--------|----------|------|
| POST | `/api/checkout/stripe` | ✅ |
| POST | `/api/checkout/paypal` | ✅ |

## Postman Collection

### Import Collection
1. Download the Postman collection: [Subscription API Collection](https://github.com/yourusername/subscription-api/blob/main/Subscription_API.postman_collection.json)
2. Open Postman
3. Click "Import" → "Upload Files" → Select the JSON file
4. Or copy the collection JSON below and import via "Raw text"

### Collection JSON
```json
{
  "info": {
    "name": "Laravel Subscription API",
    "description": "Complete API collection for Laravel 11 Subscription API with Stripe and PayPal integration",
    "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
  },
  "variable": [
    {
      "key": "base_url",
      "value": "http://localhost:8000",
      "type": "string"
    },
    {
      "key": "auth_token",
      "value": "",
      "type": "string"
    }
  ],
  "item": [
    {
      "name": "Authentication",
      "item": [
        {
          "name": "Register User",
          "request": {
            "method": "POST",
            "header": [
              {
                "key": "Content-Type",
                "value": "application/json"
              }
            ],
            "body": {
              "mode": "raw",
              "raw": "{\n  \"name\": \"John Doe\",\n  \"email\": \"john@example.com\",\n  \"password\": \"password123\",\n  \"password_confirmation\": \"password123\"\n}"
            },
            "url": {
              "raw": "{{base_url}}/api/register",
              "host": ["{{base_url}}"],
              "path": ["api", "register"]
            }
          }
        },
        {
          "name": "Login User",
          "event": [
            {
              "listen": "test",
              "script": {
                "exec": [
                  "if (pm.response.code === 200) {",
                  "    const response = pm.response.json();",
                  "    pm.collectionVariables.set('auth_token', response.access_token);",
                  "}"
                ]
              }
            }
          ],
          "request": {
            "method": "POST",
            "header": [
              {
                "key": "Content-Type",
                "value": "application/json"
              }
            ],
            "body": {
              "mode": "raw",
              "raw": "{\n  \"email\": \"john@example.com\",\n  \"password\": \"password123\"\n}"
            },
            "url": {
              "raw": "{{base_url}}/api/login",
              "host": ["{{base_url}}"],
              "path": ["api", "login"]
            }
          }
        },
        {
          "name": "Logout",
          "request": {
            "method": "POST",
            "header": [
              {
                "key": "Authorization",
                "value": "Bearer {{auth_token}}"
              }
            ],
            "url": {
              "raw": "{{base_url}}/api/logout",
              "host": ["{{base_url}}"],
              "path": ["api", "logout"]
            }
          }
        }
      ]
    },
    {
      "name": "Plans",
      "item": [
        {
          "name": "Get All Plans",
          "request": {
            "method": "GET",
            "url": {
              "raw": "{{base_url}}/api/plans",
              "host": ["{{base_url}}"],
              "path": ["api", "plans"]
            }
          }
        }
      ]
    },
    {
      "name": "Checkout",
      "item": [
        {
          "name": "Stripe Checkout",
          "request": {
            "method": "POST",
            "header": [
              {
                "key": "Authorization",
                "value": "Bearer {{auth_token}}"
              },
              {
                "key": "Content-Type",
                "value": "application/json"
              }
            ],
            "body": {
              "mode": "raw",
              "raw": "{\n  \"plan_id\": 1\n}"
            },
            "url": {
              "raw": "{{base_url}}/api/checkout/stripe",
              "host": ["{{base_url}}"],
              "path": ["api", "checkout", "stripe"]
            }
          }
        },
        {
          "name": "PayPal Checkout",
          "request": {
            "method": "POST",
            "header": [
              {
                "key": "Authorization",
                "value": "Bearer {{auth_token}}"
              },
              {
                "key": "Content-Type",
                "value": "application/json"
              }
            ],
            "body": {
              "mode": "raw",
              "raw": "{\n  \"plan_id\": 1\n}"
            },
            "url": {
              "raw": "{{base_url}}/api/checkout/paypal",
              "host": ["{{base_url}}"],
              "path": ["api", "checkout", "paypal"]
            }
          }
        }
      ]
    }
  ]
}
```

### How to Use the Collection

1. **Set Environment Variables:**
   - `base_url`: `http://localhost:8000` (or your server URL)
   - `auth_token`: Will be automatically set after login

2. **Testing Flow:**
   - **Register User** → Create a new account
   - **Login User** → Get authentication token (automatically saved)
   - **Get All Plans** → View available subscription plans
   - **Stripe/PayPal Checkout** → Test payment integration
   - **Logout** → Clear authentication token

3. **Authentication:**
   - The login request automatically saves the token
   - All protected endpoints use the saved token
   - No need to manually copy-paste tokens

## API Usage Examples

### 1. Register User
**Endpoint:** `POST /api/register`

**Request Body:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**cURL:**
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

### 2. Login User
**Endpoint:** `POST /api/login`

**Request Body:**
```json
{
  "email": "john@example.com",
  "password": "password123"
}
```

**cURL:**
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
```

**Response:**
```json
{
  "access_token": "1|abc123...",
  "token_type": "Bearer"
}
```

### 3. Get Plans
**Endpoint:** `GET /api/plans`

**cURL:**
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
**Endpoint:** `POST /api/checkout/stripe`

**Request Body:**
```json
{
  "plan_id": 1
}
```

**cURL:**
```bash
curl -X POST http://localhost:8000/api/checkout/stripe \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"plan_id": 1}'
```

**Response:**
```json
{
  "url": "https://checkout.stripe.com/pay/cs_test_..."
}
```

### 5. PayPal Checkout
**Endpoint:** `POST /api/checkout/paypal`

**Request Body:**
```json
{
  "plan_id": 1
}
```

**cURL:**
```bash
curl -X POST http://localhost:8000/api/checkout/paypal \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"plan_id": 1}'
```

**Response:**
```json
{
  "url": "https://www.sandbox.paypal.com/checkoutnow?token=..."
}
```

### 6. Logout
**Endpoint:** `POST /api/logout`

**cURL:**
```bash
curl -X POST http://localhost:8000/api/logout \
  -H "Authorization: Bearer YOUR_TOKEN"
```

## Testing with Postman

1. Import the collection above
2. Set `base_url` variable to your server URL
3. Run the requests in order (Register → Login → Test endpoints)
4. The login request automatically saves your token
5. All protected endpoints will use the saved token

## Project Structure
```
app/Http/Controllers/
├── AuthController.php      # Authentication
├── PlanController.php      # Plans management
└── CheckoutController.php  # Payment processing

config/
├── stripe.php             # Stripe config
└── paypal.php             # PayPal config

database/
└── seeders/PlanSeeder.php # Sample plans
```

## Troubleshooting

### SSL Certificate Error (WAMP/XAMPP)
- Download `cacert.pem` from https://curl.se/ca/cacert.pem
- Add to `php.ini`: `curl.cainfo = "path/to/cacert.pem"`

### Database Issues
- Verify credentials in `.env`
- Ensure database exists
- Check MySQL service is running

### Payment Gateway Errors
- Verify API keys are correct
- Use sandbox keys for development
- Check webhook configuration if needed

### Postman Issues
- Ensure `base_url` variable is set correctly
- Check that login request runs successfully to set token
- Verify all headers are included in requests

## License
MIT License
