<?php
require 'vendor/autoload.php';

use Google\Cloud\PubSub\PubSubClient;

$pubSub = new PubSubClient([
    'projectId' => 'data-stoor'
]);

// Get an instance of a previously created topic.
$topic = $pubSub->topic('kopet');

// Publish a message to the topic.
$e = $topic->publish([
    'data' => 'My new yosh.',
    'attributes' => [
        'location' => 'Detroit'
    ]
]);
print_r($e);