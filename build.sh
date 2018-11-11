#!/usr/bin/env bash

docker build --tag zigift-shop-nginx -f docker/nginx/Dockerfile docker/nginx
docker build --tag zigift-shop-php -f docker/php/Dockerfile docker/php

docker-compose up -d
