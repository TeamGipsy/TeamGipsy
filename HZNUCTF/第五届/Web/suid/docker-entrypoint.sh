#! /bin/sh
whoami
# flag
echo $FLAG > /flag
chmod 0400 /flag
export FLAG="no"

docker-php-entrypoint apache2-foreground
