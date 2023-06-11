<?php

namespace Drewlabs\Envoyer\Drivers\Twilio;

use Drewlabs\Envoyer\Contracts\ClientSecretKeyAware;

class ClientSecretKey implements ClientSecretKeyAware
{
    /**
     * 
     * @var string|null
     */
    private $client;

    /**
     * 
     * @var string|null
     */
    private $secret;

    /**
     * Creates class instance.
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public function __construct(string $client = null, string $secret = null)
    {

        $this->client = $client;
        $this->secret = $secret;
    }

    public function getClientId(): string
    {
        return $this->client ?? '';
    }

    public function getClientSecret(): string
    {
        return $this->secret ?? '';
    }
}