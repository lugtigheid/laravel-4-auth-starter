# WIP


# Laravel 4 Basic Authentication

My personal starting point for any laravel app that requires authentification.

- Laravel 4.2.*
- Sentry 2.1.*
- Bootstrap 3.1.1


# Local Installation

### Env setup & Laravel deployment

1. `composer install`
2. clone the repo and cd into it
3. configs in `app\config\**.php` (database, keys, keywords, local...)
4. setup your local machine name `boostrap/start.php` : `$env = $app->detectEnvironment`

### Database installation

1. `php artisan migrate`
2. `php artisan db:seed`


# Users accounts

### Standard account

- **Username :** user@user.com
- **Password :** sentryuser

### Admin account

- **Username :** admin@admin.com
- **Password :** sentryadmin