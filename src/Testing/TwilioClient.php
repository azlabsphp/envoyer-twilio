<?php

namespace Drewlabs\Envoyer\Drivers\Twilio\Testing;

/**
 * @property TwilioMessages $messages
 * @property string password
 * @property string username
 */
class TwilioClient
{
    /**
     * 
     * @var string
     */
    private $username;

    /**
     * 
     * @var string
     */
    private $password;

    /**
     * @var TwilioMessages
     */
    private $messages;

    /**
     * Creates class instance
     * 
     * @param string $username 
     * @param string $password 
     */
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->messages = new TwilioMessages;
    }

    /**
     * PHP properties accessor magic method
     * 
     * @param mixed $name 
     * @return mixed 
     */
    public function __get($name)
    {
        return $this->$name;
    }
}
