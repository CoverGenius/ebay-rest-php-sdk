# Ebay REST PHP Sdk

## Getting Started
TBD

## Available APIs

### Fulfillment API

https://developer.ebay.com/api-docs/sell/fulfillment/static/overview.html

* getOrder
* issueRefund

## Accessing the response

```php
<?php

use CoverGenius\EbayRestPhpSdk\Api\FulfillmentApi;

$fulfillmentApi = FulfillmentApi::create([
    'headers' => [
        'Authorization' => 'Bearer ACCESS_TOKEN',
    ]
]);

$order = $fulfillmentApi->getOrder([
    'orderId' => 'ORDER_ID',
]);

// via getter
$order->offsetGet('orderId');

// via array key
$order['orderId'];
```

## Testing

Run `composer test` to test all suites.

### Testing individual files or groups

```bash
composer test -- --filter testName

composer test -- --group groupName
```

### VCR tests

Note: You will need to generate a new access token and add it to the `EBAY_ACCESS_TOKEN` variable in your `.env` file. 
Once you have a valid access token you can delete a vcr tape associated with the test you want to re-record.
