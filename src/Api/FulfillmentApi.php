<?php

namespace CoverGenius\EbayRestPhpSdk\Api;

use CoverGenius\EbayRestPhpSdk\AbstractClient;
use GuzzleHttp\Command\Guzzle\Description;

/**
 * @method \GuzzleHttp\Command\Result getOrder(array $params)
 * @method \GuzzleHttp\Command\Result issueRefund(array $params)
 * @package CoverGenius\EbayRestPhpSdk\Api\FulfillmentApi
 */
class FulfillmentApi extends AbstractClient
{
    /**
     * Refund reasons.
     * - https://developer.ebay.com/api-docs/sell/fulfillment/types/api:ReasonForRefundEnum
     */
    const OTHER_ADJUSTMENT_REFUND_REASON = 'OTHER_ADJUSTMENT'; // If there is no specific reason.
    const BUYER_CANCEL_REFUND_REASON = 'BUYER_CANCEL';
    const SELLER_CANCEL_REFUND_REASON = 'SELLER_CANCEL';
    const ITEM_NOT_RECEIVED_REFUND_REASON = 'ITEM_NOT_RECEIVED';
    const BUYER_RETURN_REFUND_REASON = 'BUYER_RETURN';
    const ITEM_NOT_AS_DESCRIBED_REFUND_REASON = 'ITEM_NOT_AS_DESCRIBED';
    const SHIPPING_DISCOUNT_REFUND_REASON = 'SHIPPING_DISCOUNT';

    /**
     * Refund status. Ebay mentioned that the correct refund status to expect is "PENDING" because their API is async.
     * - https://developer.ebay.com/api-docs/sell/fulfillment/types/sel:RefundStatusEnum
     */
    const FAILED_REFUND_STATUS = 'FAILED';
    const PENDING_REFUND_STATUS = 'PENDING';
    const REFUNDED_REFUND_STATUS = 'REFUNDED';

    /**
     * The possible payment states of an order, or in case of a refund request, the possible states of a buyer refund.
     * - https://developer.ebay.com/api-docs/sell/fulfillment/types/sel:OrderPaymentStatusEnum
     */
    const FAILED_ORDER_PAYMENT_STATUS = 'FAILED';
    const FULLY_REFUNDED_ORDER_PAYMENT_STATUS = 'FULLY_REFUNDED';
    const PAID_ORDER_PAYMENT_STATUS = 'PAID';
    const PARTIALLY_REFUNDED_ORDER_PAYMENT_STATUS = 'PARTIALLY_REFUNDED';
    const PENDING_ORDER_PAYMENT_STATUS = 'PENDING';

    /**
     * Build service description object
     */
    protected function buildDescription(string $baseUri): Description
    {
        return new Description([
            'baseUri' => $baseUri,
            'operations' => [
                'getOrder' => [
                    'httpMethod' => 'GET',
                    'uri' => '/sell/fulfillment/v1/order/{orderId}',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'orderId' => [
                            'location' => 'uri',
                            'type' => 'string',
                            'required' => true,
                        ],
                    ]
                ],
                'issueRefund' => [
                    'httpMethod' => 'POST',
                    'uri' => '/sell/fulfillment/v1/order/{orderId}/issue_refund',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'orderId' => [
                            'location' => 'uri',
                            'type' => 'string',
                            'required' => true,
                        ],
                        'reasonForRefund' => [
                            'location' => 'json',
                            'type' => 'string',
                            'required' => true,
                        ],
                        'orderLevelRefundAmount' => [
                            'location' => 'json',
                            'type' => 'object',
                            'required' => false,
                            'properties' => [
                                'value' => [
                                    'type' => 'string',
                                    'required' => true,
                                ],
                                'currency' => [
                                    'type' => 'string',
                                    'required' => true,
                                ],
                            ]
                        ],
                        'refundItems' => [
                            'location' => 'json',
                            'type' => 'array',
                            'required' => false,
                            'items' => [
                                'type' => 'object',
                                'required' => true,
                                'properties' => [
                                    'lineItemId' => [
                                        'type' => 'string',
                                        'required' => true,
                                    ],
                                    'refundAmount' => [
                                        'type' => 'object',
                                        'properties' => [
                                            'value' => [
                                                'type' => 'string',
                                                'required' => true,
                                            ],
                                            'currency' => [
                                                'type' => 'string',
                                                'required' => true,
                                            ],
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
            ],
            'models' => [
                'getResponse' => [
                    'type' => 'object',
                    'additionalProperties' => [
                        'location' => 'json'
                    ]
                ]
            ]
        ]);
    }
}
