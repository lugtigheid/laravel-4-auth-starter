# WIP


# Laravel 4 Basic Authentication

My personal starting point for any laravel app that requires authentification.

- **Core:** laravel/framework 4.2.*
- **Authentication:** cartalyst/sentry 2.1.*
- **Tools:** laracasts/validation 1.0, way/generators 2.*
- **Templating:** Bootstrap 3.1.1

# Local Installation

### Env setup & Laravel deployment

1. clone the repo and cd into it
2. `composer install`
3. setup your local machine name `boostrap/start.php` : `$env = $app->detectEnvironment`
4. configs in `app\config\**.php` (database, keys, keywords, local...)

### Database installation

1. `php artisan migrate`
2. `php artisan db:seed`


# User accounts

### Standard account

- **Username :** user@user.com
- **Password :** sentryuser

### Admin account

- **Username :** admin@admin.com
- **Password :** sentryadmin