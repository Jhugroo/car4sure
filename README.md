Installation
  Run command "docker-compose up -d"
  Inside php container , run commands:
    - composer install
    - php bin/console doctrine:fixtures:load

Usage
  Create an account on the registration page then proceed to login
  Create Drivers and Vehicles first as they will be referenced in the policies
  Create Policies as needed
