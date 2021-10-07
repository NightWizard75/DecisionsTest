<?php
file_put_contents('start.sh', '#!/bin/bash' . PHP_EOL);
file_put_contents('start.sh', 'php -r "sleep(5);"' . PHP_EOL, FILE_APPEND);
file_put_contents('start.sh', 'cd /var/www/html/application.loc/' . PHP_EOL, FILE_APPEND);
file_put_contents('start.sh', 'echo Установка зависимостей:' . PHP_EOL, FILE_APPEND);
file_put_contents('start.sh', 'composer install' . PHP_EOL, FILE_APPEND);
file_put_contents('start.sh', 'dir=/var/www/html/application.loc/vendor/bin' . PHP_EOL, FILE_APPEND);
file_put_contents('start.sh', 'echo Создаются таблицы в базе...' . PHP_EOL, FILE_APPEND);
file_put_contents('start.sh', 'php ${dir}/phinx migrate' . PHP_EOL, FILE_APPEND);
file_put_contents('start.sh', 'echo Происходит наполнение данными...' . PHP_EOL, FILE_APPEND);
file_put_contents('start.sh', 'php ${dir}/phinx seed:run' . PHP_EOL, FILE_APPEND);
file_put_contents('start.sh', 'echo Установка завершена!' . PHP_EOL, FILE_APPEND);

