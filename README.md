# yii2-multilingual-dict
Dictionary for multilingual dictionary (mainly use for technical term).

## Installation

### Install
```shell
composer require umbalaconmeogia/yii2-m10l-dict
```

### Run migration

```shell
yii migrate --migrationNamespaces=umbalaconmeogia\\m10ldict\\migrations
```

```shell
yii migrate/down --migrationPath=@vendor/umbalaconmeogia/yii2-m10l-dict/src/migrations
```

Add migration path (for basic template, it is `config/console.php`)

```php
[
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => [
                '@app/migrations',
                '@umbalaconmeogiayii/i18n/migrations',
            ],
        ],
    ],
]
```

### Configure module to access to web functions

Listing the module in the `modules` property of the application configuration (for basic template, it is `config/web.php`).

```php
[
    'modules' => [
        'm10ldict' => [
            'class' => 'umbalaconmeogia\m10ldict\Module',
        ],
    ],
]
```

### Access

To use function of dictionary, access to `m10ldict/dictionary/index` such as below
```
http://localhost/m10l-dict-demo/index.php?r=m10ldict/dictionary/index
```