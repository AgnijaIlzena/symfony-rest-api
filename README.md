## Initialize REST API
composer install

## Run and stop server
symfony serve -d --allow-http
### ou
symfony server:start --no-tls   
symfony serve:stop

## Data Base
### Fill the credentials of data base in .env. MySQL is used in the project.
### Create data base. MySQL is configured.
symfony console doctrine:database:create
### Create and execute migrations
php bin/console make:migration  
php bin/console doctrine:migrations:migrate  

###  Run command to import JSON data in the database (located in data/dataset.json).
php bin/console app:import-investment-data

## REST API endpoints
### To access REST API in dev env, configured base url is "http://127.0.0.1:8000/api/"
