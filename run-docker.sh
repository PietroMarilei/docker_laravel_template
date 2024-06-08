#!/bin/bash

docker run -d -p 8080:80 --name sailfor5_php72 -v "$PWD/SailFor5":/var/www/html php:7.2-apache
docker run -d -p 80:80 --name portal_7_php82 -v "$PWD/portal_7":/var/www/html php:8.2-apache
