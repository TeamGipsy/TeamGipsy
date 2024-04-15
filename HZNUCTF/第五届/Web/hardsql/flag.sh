#!/bin/sh
# docker-compose build && docker-compose up -d
whoami
echo $FLAG > /flag
chown -R mysql:mysql /flag
chmod 0400 /flag
export FLAG="FLAG in /flag"