<?php

namespace CoverGenius\EbayRestPhpSdk;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;

abstract class AbstractClient extends GuzzleClient
{
    /**
     * EbayClient constructor. We setup our own constructor along with the parent
     * GuzzleClient constructor to make this more testable. This will allow us
     * to pass an instance of the Client with a mocked handler in our tests.
     */
    public function __construct(ClientInterface $client)
    {
        $baseUri = $client->getConfig('base_uri');

        parent::__construct(
            $client,
            $this->buildDescription("$baseUri"),
            null,
            null,
            null,
            $client->getConfig(),
        );
    }

    /**
     * Creates a new instance.
     */
    public static function create(array $config = []): self
    {
        $configDefaults = array_merge([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'timeout' => 15,
        ], $config);

        return new static(new Client($configDefaults));
    }

    /**
     * Build service description object
     */
    abstract protected function buildDescription(string $baseUri): Description;
}
