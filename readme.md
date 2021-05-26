# Ebay REST PHP Sdk

## Getting Started

### Requirements

* PHP ^7.3

### Installation

You can install this package by using Composer.

```bash
composer require covergenius/ebay-rest-php-sdk
```

### Creating the client

The `create()` method for the available APIs allows a config as an array to be passed to it. This accepts the typical 
configuration that you would pass to the Guzzle client. See the Guzzle docs https://docs.guzzlephp.org/en/stable/quickstart.html

```php
use CoverGenius\EbayRestPhpSdk\Api\FulfillmentApi;

$fulfillmentApi = FulfillmentApi::create([
    'base_uri' => 'https://api.sandbox.ebay.com',
    'headers' => [
        'Authorization' => 'Bearer ACCESS_TOKEN',
    ]
]);
```

Alternatively, you can create a new GuzzleHttp Client instance to pass into the API class' constructor.

```php
use CoverGenius\EbayRestPhpSdk\Api\FulfillmentApi;
use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'https://api.sandbox.ebay.com',
    'headers' => [
        'Authorization' => 'Bearer ACCESS_TOKEN',
    ]
]);

$fulfillmentApi = new FulfillmentApi($client);
```

## Available APIs

### Fulfillment API

- https://developer.ebay.com/api-docs/sell/fulfillment/static/overview.html

## Accessing the response

```php
use CoverGenius\EbayRestPhpSdk\Api\FulfillmentApi;

$config = [];

$fulfillmentApi = FulfillmentApi::create($config);

$order = $fulfillmentApi->getOrder(['orderId' => 'ORDER_ID']);

// via getter
$order->offsetGet('orderId');

// via array key
$order['orderId'];
```

## Testing

### Running tests

Run `composer test` to test all suites. Alternatively, you can run the commands below.

```bash
composer test -- --filter testName

composer test -- --group groupName
```

### VCR tests

#### Important

- You will need to generate a new access token and add it to the `EBAY_ACCESS_TOKEN` variable in your `.env` file. 
Using your valid access token, you may delete a vcr tape associated with the test you want to re-record.
  
- Resource IDs such as the `orderId`, `refundId` etc. may need to be updated if they do not exist in the sandbox
account you're using for re-recording tests.
  
#### Steps

1. Delete the old VCR file associated with the test you want to re-record.
2. Re-run your tests.
