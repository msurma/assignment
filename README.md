### Setup

```
docker-compose up -d
docker-compose exec php php composer.phar install
docker-compose exec php bin/console doctrine:database:create
docker-compose exec php bin/console doctrine:schema:create
```

OpenAPI: http://localhost:8080/api