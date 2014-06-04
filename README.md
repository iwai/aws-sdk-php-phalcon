AWS Service Provider for Phalcon
===================

[![Latest Stable Version](https://poser.pugx.org/iwai/aws-sdk-php-phalcon/v/stable.svg)](https://packagist.org/packages/iwai/aws-sdk-php-phalcon) [![Total Downloads](https://poser.pugx.org/iwai/aws-sdk-php-phalcon/downloads.svg)](https://packagist.org/packages/iwai/aws-sdk-php-phalcon) [![Latest Unstable Version](https://poser.pugx.org/iwai/aws-sdk-php-phalcon/v/unstable.svg)](https://packagist.org/packages/iwai/aws-sdk-php-phalcon) [![License](https://poser.pugx.org/iwai/aws-sdk-php-phalcon/license.svg)](https://packagist.org/packages/iwai/aws-sdk-php-phalcon)

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

Example
=======

```php

// Get the Amazon S3 client
$s3 = $this->getDI()->get('aws')->get('s3');

// Create a list of the buckets in your account
$buckets = array();
foreach ($s3->getIterator('ListBuckets') as $bucket) {
    $buckets[] = $bucket['Name'];
}

var_dump($buckets);

```
