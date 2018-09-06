AppProva
=======

This is a small POC and MVP for Software Engineer test.

This project was made using PHP as programming language with Symfony 3.4 LTS as framework and using DDD, TDD and SOLID concepts.

Pre-requisites
------  

For run this project, you need to have `docker` and `docker-compose` installed.

Run
------  

* Clone this repo
* Execute `docker-composer up`
* Open `http://0.0.0.0:4000` in your browser.
* Open `http://0.0.0.0:4000/manager` in your browser for manage data.


Tests
------  
* Clone this repo
* Execute `docker-composer up`
* Execute `docker exec -it approva_appprova-test-symfony-php-fpm_1 php /var/www/html/composer.phar run tests`

Reference
------ 
* https://secure.php.net/
* https://symfony.com/
* https://www.docker.com/
