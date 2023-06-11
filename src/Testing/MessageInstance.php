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

namespace Drewlabs\Envoyer\Drivers\Twilio\Testing;

use Drewlabs\Envoyer\Drivers\Twilio\MessageIntanceInterface;

class MessageInstance implements MessageIntanceInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTimeInterface
     */
    private $at;

    /**
     * @var string
     */
    private $body;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * Creates class instance.
     *
     * @param int $statusCode
     */
    public function __construct(int $id, \DateTimeInterface $at, string $body, $statusCode = 200)
    {
        $this->id = $id;
        $this->at = $at;
        $this->body = $body;
        $this->statusCode = $statusCode;
    }

    public function getCreatedAt()
    {
        return $this->at->format(\DateTimeImmutable::ATOM);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStatusCode()
    {
        return $this->statusCode ?? 200;
    }

    public function getBody()
    {
        return $this->body;
    }
}
