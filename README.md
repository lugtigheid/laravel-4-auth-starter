# WIP


# Laravel 4 Basic Bootstrap Authentication with Sentry and OAuth

My personal starting point for any laravel app that requires authentification.

- Laravel 4.2.*
- Sentry 2.1.*
- Bootstrap 3.1.1


# Local Installation

### Env setup

1. install composer : https://getcomposer.org
2. clone the repo and cd into it
3. Setup your local machine name `boostrap/start.php` : `$env = $app->detectEnvironment`

### Laravel vendors installation

1. `composer install`

### App configuration

1. configs in `app\config\**.php` (database, keys, keywords, local...)

### Database installation

1. `php artisan migrate`
2. `php artisan db:seed`

### Launch locally

1 `php artisan serve`
2. Visit [localhost:8000](http://localhost:8000) in your browser


#Standard account

- **Username :** user@user.com
- **Password :** sentryuser

#Admin account

- **Username :** admin@admin.com
- **Password :** sentryadmin