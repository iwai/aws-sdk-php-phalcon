AWS Service Provider for Phalcon
===================

A simple Phalcon service provider for including the AWS SDK for PHP.

Installation
============

```json
{
    "require": {
        "iwai/aws-sdk-php-phalcon": "*"
    }
}
```

Usage
=====

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Aws\Phalcon\AwsServiceProvider;
use Phalcon\Mvc\Application;

$app = new Application();

$eventsManager = new Phalcon\Events\Manager();
$app->setEventsManager($eventsManager);

$eventsManager->attach("application:boot", new AwsServiceProvider(array(
    'key'    => 'your-aws-access-key-id',
    'secret' => 'your-aws-secret-access-key',
    'region' => 'us-east-1',
)));

echo $app->handle()->getContent();

```