<?php
 /**
  * AwsServiceProvider.php
  *
  * @copyright   Copyright (c) 2013 Yuji Iwai.
  * @package     
  * @subpackage  
  * @version     $Id$
  */

namespace Aws\Phalcon;

use Phalcon\Mvc\Application;
use Aws\Common\Aws;
use Aws\Common\Client\UserAgentListener;
use Guzzle\Common\Event;
use Guzzle\Service\Client;

class AwsServiceProvider {

    const DEFAULT_REGION = 'us-east-1';

    private $options;

    /**
     * @param array $options
     */
    function __construct($options = null)
    {
        if (!$options)
            throw new Application\Exception('No configuration given');

        if (!isset($options['key']))
            throw new Application\Exception('Not key configuration given');
        if (!isset($options['secret']))
            throw new Application\Exception('Not key configuration given');
        if (!isset($options['region']))
            $options['region'] = self::DEFAULT_REGION;

        $this->options = $options;
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
        $options = $this->options;

        $app->getDI()->setShared('aws', function () use ($options) {
            $aws = Aws::factory($options);

            $aws->getEventDispatcher()->addListener('service_builder.create_client', function (Event $event) {
                $clientConfig = $event['client']->getConfig();

                $commandParams = $clientConfig->get(Client::COMMAND_PARAMS) ?: array();

                $clientConfig->set(Client::COMMAND_PARAMS, array_merge_recursive($commandParams, array(
                    UserAgentListener::OPTION => 'Phalcon/' . Application::VERSION
                )));
            });

            return $aws;
        });
    }
}