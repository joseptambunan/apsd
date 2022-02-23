Spesifikasi : 
  PHP : 7.*
  Laravel : 8.*
  Mysql : 5.*\
  
How to run my code 
 - composer install
 - Create Database with name aps
 - run this command php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"
 - run this command php artisan config:cache
 - run this command php artisan make:job RegisterUser
 - run this command php artisan queue:table
 - run this command php artisan migrate
 - for test please run this link 
 - via browser :  localhost/user/token
 - via curl : curl -X GET \
  http://localhost/user/token \
  -H 'cache-control: no-cache' \
  -H 'postman-token: 1798c437-a00c-5225-c426-d30ddbb9e99d'
