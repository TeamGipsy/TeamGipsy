#!/bin/sh
# docker-compose build && docker-compose up -d
echo $FLAG > /flag
export FLAG="FLAG IN /flag"
# chmod 0400 /flag