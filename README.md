Create database name "munircrm"

Then after run below commands

composer install

php artisan migrate

php artisan db:seed --class=AdminTableDataSeeder

check in public folder, if storage folder is exist then delete it.

after run below commands

php artisan storage:link

php artisan optimize:clear

now you can open below link

http://localhost/munircrm

