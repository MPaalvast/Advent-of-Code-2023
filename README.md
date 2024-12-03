# How to setup

- composer install
- npm install
- npm run watch

##  Database acties
- symfony console doctrine:database:create
- symfony console doctrine:migrations:migrate

## Dagen toevoegen
- symfony console doctrine:fixtures:load --group=init

## Jaar toevoegen
- symfony console doctrine:fixtures:load --group={jaar}

Beschikbare jaren
- 2023
- 2024