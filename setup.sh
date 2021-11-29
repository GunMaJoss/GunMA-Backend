#!/bin/bash

#defineContainer
PhpContainerName=gunma_php
MysqlContainerName=gunma_mysql
WebServerContainerName=gunma_webserver

#migrate
docker exec $PhpContainerName \
  php artisan migrate \

#Change permission storage
sudo chmod 777 -R storage