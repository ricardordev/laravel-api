## Getting Started

It's just an example of how to use **Laravel as an API Gateway**, with **Sanctum authentication**.

After cloning, remember to configure your .env file and run: 

```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate
```

Remember to check "storage" and "bootstrap/cache" folders permissions if needed:

```bash
sudo chmod -R 775 storage bootstrap/cache
```

## Migrations, Models and Controllers

There is an example Migration, Model and Controller called "Transaction". But you can create your own models, migrations and controllers, as you wish with: 

```bash
php artisan make:migration create_transactions_table
php artisan make:model ModelName
php artisan make:controller ControllerName --api
```

## Creating Test User

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

## Endpoints example

### POST api/auth - Creating token

```bash
curl -X POST http://localhost/api/auth \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"email": "email@test.com", "password": "12345678", "device_name": "mydevice"}'
```

Expected result:

```json
{"token":"1|ra6p2y8u..."}
```

### POST api/transactions - Creating transaction

```bash
curl -X POST http://localhost/api/transactions \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{"amount": "100", "type": "credit"}'
```

Note: "hash" is generated automatically by the model and used to update and delete transactions.

### GET api/transactions - Listing transactions

```bash
curl -X GET http://localhost/api/transactions \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### GET api/transactions/{hash} - Show transaction by hash

```bash
curl -X GET http://localhost/api/transactions/YOUR_HASH_HERE \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### PUT api/transactions/{hash} - Update transaction

```bash
curl -X PUT http://localhost/api/transactions/YOUR_HASH_HERE \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{"amount": "100", "type": "credit"}'
```

### DELETE api/transactions/{hash} - Delete transaction

```bash
curl -X DELETE http://localhost/api/transactions/YOUR_HASH_HERE \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

## Learning Laravel

Docs: [https://laravel.com/docs](https://laravel.com/docs)
Laracasts: [https://laracasts.com](https://laracasts.com)
Learn: [https://laravel.com/learn](https://laravel.com/learn)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

```bash
ricardo albrecht - ricardoalbrecht1@gmail.com
```