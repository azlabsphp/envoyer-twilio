<?php

use Drewlabs\Envoyer\Contracts\NotificationResult;
use Drewlabs\Envoyer\Drivers\Twilio\TwilioAdapter;
use Drewlabs\Envoyer\Message;
use PHPUnit\Framework\TestCase;
use Drewlabs\Envoyer\Drivers\Twilio\Result;

class TwilioAdapterTest extends TestCase
{

    public function test_twilio_send_request()
    {
        $adapter = TwilioAdapter::test('key', 'secret');
        $message = Message::new()->from('22990667812')->to('22890667723')->content('Hi!');

        // Act
        /**
         * @var Result
         */
        $result = $adapter->sendRequest($message);

        // Assert
        $this->assertInstanceOf(NotificationResult::class, $result);

        $this->assertEquals('Message 22990667812 -> 22890667723: Hi!', $result->getBody());
    }

}