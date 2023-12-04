#!/bin/bash

# getting local ip
if [ -e ./Docker/conf/.local_ip ]; then
    rm ./Docker/conf/.local_ip
fi
touch ./Docker/conf/.local_ip
echo $(hostname -I | awk '{print $1}') >> ./Docker/conf/.local_ip

# building the assets
npm run build

# run the application stack
docker compose up -d --build --force-recreate

# run the migrations
docker compose exec php-apache bash -c "php artisan migrate:fresh --seed"
