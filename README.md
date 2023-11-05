# WBPO

## Setup

1. Run `composer install`
2. Copy `.env.example` to `.env`
3. Generate APP key `php artisan key:generate`
4. Enter correct DB credentials in `.env`
5. Run migrations `php artisan migrate`
6. Run web server `php artisan serve`
7. Run job worker `php artisan horizon`

## Usage

Example API requests are prepared in `requests.http`