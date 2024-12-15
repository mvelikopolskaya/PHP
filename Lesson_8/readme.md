Для запуска заданий 1-4:
docker build -t lesson_8 .

docker run -it -v ${pwd}/code:/code lesson_8 php /code/app.php

Выполнение задания п.5 в папке php-cli

Запуск:

docker run --rm -v ${pwd}/php-cli/:/cli php:8.2-cli php /cli/task_2_a.php

docker run --rm -v ${pwd}/php-cli/:/cli php:8.2-cli php /cli/task_2_b.php
