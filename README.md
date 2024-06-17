Installation
  Run command "docker-compose up -d"
  Inside php container , using bash, run commands below in folder /var/www/symfony_docker:
    - "composer install"
    - "php bin/console doctrine:fixtures:load"

Usage
  Create an account on the registration page then proceed to login
  Create Drivers and Vehicles first as they will be referenced in the policies
  Create Policies as needed
