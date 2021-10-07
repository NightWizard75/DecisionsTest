#!/bin/bash
php -r "sleep(5);"
cd /var/www/html/application.loc/
echo Установка зависимостей:
composer install
dir=/var/www/html/application.loc/vendor/bin
echo Создаются таблицы в базе...
php ${dir}/phinx migrate
echo Происходит наполнение данными...
php ${dir}/phinx seed:run
echo Установка завершена!
