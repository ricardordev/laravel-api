# Laravel API Gateway

A minimal reference implementation of an **API Gateway built with Laravel**, featuring Sanctum token authentication and a full CRUD example with the `Transaction` model.

> [!IMPORTANT]
> **Disclaimer:** This is example code. For production use, implement proper security measures.

---

## Getting Started

Clone the repository, configure the `.env` file, and run the setup commands:

```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate
```

If needed, fix storage permissions:

```bash
sudo chmod -R 775 storage bootstrap/cache
```

---

## Creating a Test User

```bash
php artisan tinker
```

```php
\App\Models\User::create([
    'name' => 'Test User',
    'email' => 'email@test.com',
    'password' => Hash::make('12345678'),
]);
```

---

## Extending the Project

The `Transaction` migration, model, and controller are included as a working example. To add your own resources:

```bash
php artisan make:migration create_your_table
php artisan make:model ModelName
php artisan make:controller ControllerName --api
```

---

## Endpoints

### POST /api/auth

```bash
curl -X POST http://localhost/api/auth \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"email":"email@test.com","password":"12345678","device_name":"mydevice"}'
```
`Expected result:`
```json
{"token":"1|ra6p2y8u..."}
```

### POST /api/transactions

```bash
curl -X POST http://localhost/api/transactions \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{"amount": "100", "type": "credit"}'
```

Note: "hash" is generated automatically by the model and used to update and delete transactions.

### GET /api/transactions

```bash
curl -X GET http://localhost/api/transactions \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### GET /api/transactions/{hash}

```bash
curl -X GET http://localhost/api/transactions/{hash} \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### PUT /api/transactions/{hash}

```bash
curl -X PUT http://localhost/api/transactions/{hash} \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{"amount": "100", "type": "credit"}'
```

### DELETE /api/transactions/{hash}

```bash
curl -X DELETE http://localhost/api/transactions/{hash} \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

---

## Deployment & Verification

You can interact with the API through the following execution contexts:

* Localhost: run `php artisan serve` and check the URL in your terminal
* Public running: [https://laravel.rdev.eti.br](https://laravel.rdev.eti.br)

```bash
ricardo albrecht - ricardoalbrecht1@gmail.com
```
