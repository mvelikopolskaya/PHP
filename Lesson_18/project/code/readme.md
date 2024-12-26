CREATE TABLE application1.users (
id_user INT PRIMARY KEY AUTO_INCREMENT,
user_login VARCHAR(45),
user_name VARCHAR(45),
user_lastname VARCHAR(45),
user_birthday_timestamp INT,
user_password_hash VARCHAR(255),
token VARCHAR(255))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE application1.users (
id_user_role INT PRIMARY KEY AUTO_INCREMENT,
id_user INT,
role VARCHAR(45)

docker container run -it -v ${pwd}/code:/data/mysite.local/ myapp/php-cli composer require monolog/monolog
