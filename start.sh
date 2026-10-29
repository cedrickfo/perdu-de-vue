
#!/bin/sh
set -e

cd /app

mkdir -p database
touch database/database.sqlite

export DB_CONNECTION=sqlite
export DB_DATABASE=/app/database/database.sqlite
export SESSION_DRIVER=file
export CACHE_STORE=file


php artisan migrate:fresh --seed --force


exec php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
