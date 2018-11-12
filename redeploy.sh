#!/bin/sh

export $(cat .env.dist | xargs)

docker-compose -f docker-compose.yml stop
docker-compose -f docker-compose.yml rm -f

docker-compose -f docker-compose.yml up -d

docker exec zigift_php /bin/bash -c "cd /var/www && composer install"

docker exec -it zigift_nginx /bin/bash -c "chown -R www-data:www-data /var/www/var/*"
