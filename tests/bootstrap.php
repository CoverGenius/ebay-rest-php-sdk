<?php

use allejo\VCR\VCRCleaner;
use VCR\VCR;

require __DIR__ . '/../vendor/autoload.php';

$dotEnv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../', '.env');
$dotEnv->load();

var_dump(getenv('BASE_URI'));

VCR::configure()
    ->setCassettePath(__DIR__ . '/../tests/vcr')
    ->setStorage('json')
    ->enableLibraryHooks(['stream_wrapper', 'curl'])
    ->enableRequestMatchers(['method', 'url', 'host', 'body'])
    ->setMode('once');

VCRCleaner::enable([
    'request' => [
        'ignoreHeaders' => [
            'X-Api-Key',
            'Authorization',
            'User-Agent',
        ]
    ]
]);

VCR::turnOn();
VCR::turnOff();
