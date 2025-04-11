# How to setup

- composer install
- php bin/console tailwind:init
- php bin/console tailwind:build --watch
- 
- symfony console asset-map:compile

##  Database acties
- symfony console doctrine:database:drop --force
- symfony console doctrine:database:create
- symfony console doctrine:migrations:migrate

## Database vullen
- symfony console doctrine:fixtures:load
