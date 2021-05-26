<?php

namespace CoverGenius\EbayRestPhpSdk\Tests\Unit\Api;

use CoverGenius\EbayRestPhpSdk\Api\FulfillmentApi;
use PHPUnit\Framework\TestCase;

class FulfillmentApiTest extends TestCase
{
    /**
     * @vcr fulfillment/get_order_success
     */
    public function testGetOrder()
    {
        var_dump($this->config());

        $order = FulfillmentApi::create($this->config())->getOrder([
            'orderId' => 'ORDER_ID'
        ]);

        $this->assertEquals('ORDER_ID', $order->offsetGet('orderId'));
    }

    /**
     * @vcr fulfillment/issue_refund_success
     */
    public function testIssueRefund()
    {
        $refund = FulfillmentApi::create($this->config())->issueRefund([
            'orderId' => 'ORDER_ID',
            'reasonForRefund' => FulfillmentApi::OTHER_ADJUSTMENT_REFUND_REASON,
        ]);

        $this->assertEquals('ORDER_ID', $refund->offsetGet('refundId'));
    }

    /**
     * Return config.
     */
    protected function config(): array
    {
        return [
            'base_uri' => getenv('BASE_URI'),
            'headers' => [
                'Authorization' => 'Bearer ' . getenv('ACCESS_TOKEN'),
            ],
        ];
    }
}
