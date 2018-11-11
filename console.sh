#!/bin/sh

docker exec -it zigift_php /bin/bash -c "php /var/www/bin/console $1 $2 $3 $4"
