AppProva
=======

This is a small POC and MVP for Software Engineer test.

Pre-requisites
------  

For run this project, you need to have `docker` and `docker-compose` installed.

Run
------  

* Clone this repo
* Execute `docker-composer up`
* Open `http://0.0.0.0:4000` in your browser.
* Open `http://0.0.0.0:4000/manager` in your browser for manager data.


Tests
------  
* Clone this repo
* Execute `docker-composer up`
* Execute `docker exec -it approva_appprova-test-symfony-php-fpm_1 php /var/www/html/composer.phar run tests`