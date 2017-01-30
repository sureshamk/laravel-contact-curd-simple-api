## Contact simple curd Contact application in laravel 5.3

[Sample api collection postman link ](https://www.getpostman.com/collections/c8e857b644bcc11496a4)

### Installation ###

* `git clone https://github.com/sureshamk/laravel-contact-curd-simple-api.git appName`
* `cd appName`
* `composer install`
* `php artisan key:generate`
* Create a database and inform *.env*
* `php artisan migrate --seed` to create and populate tables
* Inform *config/mail.php* for email sends
* `php artisan vendor:publish` to publish filemanager
* `php artisan serve` to start the app on http://localhost:8000/