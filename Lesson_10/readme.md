docker container run -it -v ${pwd}/code:/data/mysite.local/ myapp/php-cli composer init
Package name (<vendor>/<name>) [root/mysite.local]: geekbrains/application1

docker container run -it -v ${pwd}/code:/data/mysite.local/ myapp/php-cli composer require "twig/twig:^3.0"

http://mysite.local/user/save/?name=Иван&birthday=05-05-1991
