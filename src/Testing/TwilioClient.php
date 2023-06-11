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

/**
 * @property TwilioMessages $messages
 * @property string password
 * @property string username
 */
class TwilioClient
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var TwilioMessages
     */
    private $messages;

    /**
     * Creates class instance.
     */
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->messages = new TwilioMessages();
    }

    /**
     * PHP properties accessor magic method.
     *
     * @param mixed $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
    }
}
