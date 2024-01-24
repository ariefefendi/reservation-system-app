## Implementation DDD (Domain-driven Design) on Backend RestFull Api - Laravel 8

Name : Arif Efendi
email : arifefendi304@gmail.com
Wa : 6283845478148

## Documentation :

https://documenter.getpostman.com/view/3765556/2s9YynkirH

NOTE :
Im so sorry, :

-   just here for task finished.

Mission not yet created :

-   unit testing.
-   Seeder data migration.

For Use this program :

-   you must register and login for get "Bearer Token"
-   1. you must insert data master Table exit ( tb_table_exis )
-   2. and then ready to order Reservations.
-   3. and exit order, you must run destroyOrder, this program can be updated in status master table exis
       deleted data in reservations and update report reservation on 'report_reservation'.

Running :
Run php artisan

## install laravel v8

composer create-project laravel/laravel example-app "8.5.\*"

## install sanctum

composer require laravel/sanctum

## publish sanctum

php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

## Setup Karnel

'api' => [
\Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
'throttle:api',
\Illuminate\Routing\Middleware\SubstituteBindings::class,
],

## Configurasi sanctum

<?php
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
}

jalankan migrate
-------------------------------------------------------------
php artisan migrate
