### Upgrade in general
```ssh
php doctrine orm:schema-tool:update --force
```
or if you use Docker
```ssh
docker exec -ti file-sharing-webserver php doctrine orm:schema-tool:update --force
```

### Upgrade from 3.4.0 to 3.5.0
```ssh
php doctrine dbal:import sql/version-3.5.0-migration.sql
php doctrine orm:schema-tool:update --force
```

### Upgrade from 3.2.0 to 3.3.0
```ssh
php doctrine dbal:import sql/version-3.3.0-migration.sql
php doctrine orm:schema-tool:update --force
```

### Upgrade from 3.1.0 to 3.2.0
```ssh
php doctrine dbal:import sql/version-3.2.0-migration.sql
php doctrine orm:schema-tool:update --force
```
