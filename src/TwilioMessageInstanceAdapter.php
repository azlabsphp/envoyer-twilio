<?php

namespace Drewlabs\Envoyer\Drivers\Twilio;

use Twilio\Rest\Api\V2010\Account\MessageInstance;

class TwilioMessageInstanceAdapter implements MessageIntanceInterface
{
    /**
     * @var MessageInstance
     */
    private $instance;

    /**
     * Creates adapter instance
     * 
     * @param MessageInstance $instance 
     */
    public function __construct(MessageInstance $instance)
    {
        $this->instance = $instance;
    }

    public function getCreatedAt()
    {
        return $this->instance->dateSent ?? $this->instance->dateCreated;
    }

    public function getId()
    {
        return $this->instance->sid;
    }

    public function getStatusCode()
    {
        return null !== ($errorCode = $this->instance->errorCode) ? $errorCode : 200;
    }

    public function getBody()
    {
        return $this->instance->body;
    }
}
