<?php

use allejo\VCR\VCRCleaner;
use VCR\VCR;

require __DIR__ . '/../vendor/autoload.php';

$dotEnv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../', '.env');
$dotEnv->load();

VCR::configure()
    ->setCassettePath(__DIR__ . '/../tests/vcr')
    ->setStorage('yaml')
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
