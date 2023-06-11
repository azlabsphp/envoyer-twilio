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

use Drewlabs\Envoyer\Contracts\NotificationResult;
use Drewlabs\Envoyer\Drivers\Twilio\Result;
use Drewlabs\Envoyer\Drivers\Twilio\TwilioAdapter;
use Drewlabs\Envoyer\Message;
use PHPUnit\Framework\TestCase;

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

        $this->assertSame('Message 22990667812 -> 22890667723: Hi!', $result->getBody());
    }
}
