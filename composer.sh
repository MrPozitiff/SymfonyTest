#!/bin/sh

docker exec -it zigift_php /bin/bash -c "cd /var/www && php -d memory_limit=2g /usr/local/bin/composer $1 $2 $3 $4"
