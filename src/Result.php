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

use Drewlabs\Envoyer\Contracts\NotificationResult;

class Result implements NotificationResult
{
    /**
     * @var MessageIntanceInterface
     */
    private $message;

    /**
     * Creates class instance.
     */
    public function __construct(MessageIntanceInterface $message)
    {
        $this->message = $message;
    }

    public function isOk()
    {
        return $this->message->getStatusCode() >= 200 && $this->message->getStatusCode() <= 204;
    }

    public function date()
    {
        return $this->message->getCreatedAt();
    }

    public function id()
    {
        return $this->message->getId();
    }

    public function getStatusCode()
    {
        return $this->message->getStatusCode();
    }

    public function getBody()
    {
        return $this->message->getBody();
    }
}
