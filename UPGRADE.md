### Upgrade in general
```ssh
php doctrine orm:schema-tool:update --force
```

### Upgrade from 3.1.0 to 3.2.0
```ssh
php doctrine orm:schema-tool:update --force
php doctrine dbal:import sql/version-3.2.0-migration.sql
```