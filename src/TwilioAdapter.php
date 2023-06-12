<?php

declare(strict_types=1);

/*
 * This file is part of the drewlabs namespace.
 *
 * (c) Sidoine Azandrew <azandrewdevelopper@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Drewlabs\Envoyer\Drivers\Twilio;

use Drewlabs\Envoyer\Contracts\ClientInterface;
use Drewlabs\Envoyer\Contracts\ClientSecretKeyAware;
use Drewlabs\Envoyer\Contracts\NotificationInterface;
use Drewlabs\Envoyer\Contracts\NotificationResult;
use Drewlabs\Envoyer\Drivers\Twilio\Testing\TwilioClient;
use Twilio\Rest\Client;

class TwilioAdapter implements ClientInterface
{
    /**
     * @var \Closure(NotificationInterface): MessageIntanceInterface
     */
    private $request = false;

    /**
     * Creates class instance.
     */
    public function __construct(ClientSecretKeyAware $server)
    {
        $this->request = static function (NotificationInterface $instance) use ($server) {
            $message = (new Client($server->getClientId(), $server->getClientSecret()))->messages->create($instance->getReceiver()->__toString(), [
                'From' => $instance->getSender()->__toString(),
                'Body' => (string) $instance->getContent(),
                'SendAt' => date(\DateTimeImmutable::ATOM),
            ]);

            return new TwilioMessageInstanceAdapter($message);
        };
    }

    /**
     * Creates a twilio adapter instance.
     *
     * @return static
     */
    public static function new(string $client, string $secret)
    {
        return new static(new ClientSecretKeyServer($client, $secret));
    }

    /**
     * Creates a fake twiter adapter.
     *
     * @return static
     */
    public static function test(string $client, string $secret)
    {
        /**
         * @var static
         */
        $instance = (new \ReflectionClass(__CLASS__))->newInstanceWithoutConstructor();
        // Set the request instance of the adapter object
        $instance->request = static function (NotificationInterface $instance) use ($client, $secret) {
            return (new TwilioClient($client, $secret))->messages->create($instance->getReceiver()->__toString(), [
                'From' => $instance->getSender()->__toString(),
                'Body' => (string) $instance->getContent(),
                'SendAt' => date(\DateTimeImmutable::ATOM),
            ]);
        };

        return $instance;
    }

    public function sendRequest(NotificationInterface $instance): NotificationResult
    {
        return new Result(($this->request)($instance));
    }
}
