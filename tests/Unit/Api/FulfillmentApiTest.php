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
        $order = FulfillmentApi::create($this->config())->getOrder([
            'orderId' => '09-06721-09981'
        ]);

        $this->assertEquals('09-06721-09981', $order->offsetGet('orderId'));
    }

    /**
     * @vcr fulfillment/issue_refund_success
     */
    public function testIssueRefund()
    {
        $refund = FulfillmentApi::create($this->config())->issueRefund([
            'orderId' => '09-06721-09981',
            'reasonForRefund' => FulfillmentApi::BUYER_CANCEL_REFUND_REASON,
            'orderLevelRefundAmount' => [
                'currency' => 'USD',
                'value' => '0.01',
            ]
        ]);

        $this->assertEquals('5018168125', $refund->offsetGet('refundId'));
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
