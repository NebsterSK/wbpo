# WBPO

## Setup

1. Run `composer install`
2. Copy `.env.example` to `.env`
3. Generate APP key `php artisan key:generate`
4. Enter correct DB credentials in `.env`
5. Run migrations `php artisan migrate`
6. Run seeder `php artisan db:seed`
7. Run web server `php artisan serve`
8. In another terminal run job worker `php artisan horizon`

## Usage

Example API requests are prepared in `requests.http` file.
They can be run directly in PHPStorm or replicated in Postman.
User and API token were generated in seeder.

1. Get signed URL of `payments.store` endpoint by calling `Signature` GET request
2. Send `Store` POST request with given signature
3. Check DB for stored Payment