## Migration

To run with namespace (the migration class should decrlare namespace)
```shell
yii migrate --migrationNamespaces=umbalaconmeogia\\m10ldict\\migrations
```

To run without namespace (the migration class should not decrlare namespace)
```shell
yii migrate/down --migrationPath=@vendor/umbalaconmeogia/yii2-m10l-dict/src/migrations
```
