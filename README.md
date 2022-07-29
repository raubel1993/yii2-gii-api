Generator api rest for Yii 2
============================
Generator api rest for Yii 2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist rgl/yii2-gii-api "*"
```

or add

```
"rgl/yii2-gii-api": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
$config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'as GiiBehaviors' => \rgl\gii\GiiBehaviors::class,
];
```