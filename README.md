Menu module for Yii 2
=====================

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require fonclub/yii2-menu "*"
```

or add

```
"fonclub/yii2-menu": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply modify your application configuration as follows:

```php
'modules' => [
    ...
    'menu' => [
        'class' => 'fonclub\menu\Module',
    ],
],
```

Import the translations and use category 'fonclub/menu':
```
yii i18n/import @fonclub/menu/messages
```

To use the module, execute yii migration
```
yii migrate/up --migrationPath=@vendor/fonclub/yii2-menu/migrations
```
