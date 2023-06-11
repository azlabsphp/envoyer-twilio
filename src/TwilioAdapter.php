<?php

namespace Drewlabs\Envoyer\Drivers\Twilio;

use Drewlabs\Envoyer\Contracts\ClientInterface;
use Drewlabs\Envoyer\Contracts\NotificationInterface;
use Drewlabs\Envoyer\Contracts\NotificationResult;
use Twilio\Rest\Client;
use Drewlabs\Envoyer\Contracts\ClientSecretKeyAware;
use Drewlabs\Envoyer\Drivers\Twilio\Testing\TwilioClient;

class TwilioAdapter implements ClientInterface
{

    /**
     * @var \Closure(NotificationInterface $instance): MessageIntanceInterface
     */
    private $request = false;

    /**
     * Creates class instance
     * 
     * @param ClientSecretKeyAware $server 
     */
    public function __construct(ClientSecretKeyAware $server)
    {
        $this->request = function(NotificationInterface $instance) use ($server) {
            $message =  (new Client($server->getClientId(), $server->getClientSecret()))->messages->create($instance->getReceiver()->__toString(), [
                'From' => $instance->getSender()->__toString(),
                'Body' => (string)$instance->getContent(),
                'SendAt' => date(\DateTimeImmutable::ATOM)
            ]);
            return new TwilioMessageInstanceAdapter($message);
        };
    }

    /**
     * Creates a twilio adapter instance
     * 
     * @param string $client 
     * @param string $secret 
     * @return static 
     */
    public static function new(string $client, string $secret)
    {
        return new static(new ClientSecretKey($client, $secret));
    }

    /**
     * Creates a fake twiter adapter
     * 
     * @param string $client 
     * @param string $secret 
     * @return static 
     */
    public static function test(string $client, string $secret)
    {
        /**
         * @var static
         */
        $instance = (new \ReflectionClass(__CLASS__))->newInstanceWithoutConstructor();
        // Set the request instance of the adapter object
        $instance->request = function(NotificationInterface $instance) use ($client, $secret) {
            return (new TwilioClient($client, $secret))->messages->create($instance->getReceiver()->__toString(), [
                'From' => $instance->getSender()->__toString(),
                'Body' => (string)$instance->getContent(),
                'SendAt' => date(\DateTimeImmutable::ATOM)
            ]);
        };
        return $instance;
    }

    public function sendRequest(NotificationInterface $instance): NotificationResult
    {
        return new Result(($this->request)($instance));
    }
}
