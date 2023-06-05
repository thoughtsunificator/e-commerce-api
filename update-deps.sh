#!/bin/sh

docker compose down -v
docker system prune -a --volumes

docker compose pull --include-deps
docker compose build --no-cache

composer recipes:update
