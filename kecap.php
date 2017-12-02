<?php
# Includes the autoloader for libraries installed with composer
require __DIR__ . '/vendor/autoload.php';

use Google\Cloud\Speech\SpeechClient;

$speech = new SpeechClient([
    'projectId' => 'data-stoor',
    'languageCode' => 'en-US'
]);

// Recognize the speech in an audio file.
$results = $speech->recognize(
    fopen(__DIR__ . '/audio.mp3', 'r')
);

foreach ($results as $result) {
    echo $result->topAlternative()['transcript'] . "\n";
}