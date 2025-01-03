# How to setup

- composer install
- php bin/console tailwind:init
- php bin/console tailwind:build --watch

##  Database acties
- symfony console doctrine:database:create
- symfony console doctrine:migrations:migrate

## Database vullen
- symfony console doctrine:fixtures:load
