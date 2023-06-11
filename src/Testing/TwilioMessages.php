<?php

namespace Drewlabs\Envoyer\Drivers\Twilio\Testing;

use DateTimeImmutable;

class TwilioMessages
{

    public function create(string $to, array $options = []): MessageInstance
    {
        $body = sprintf("Message %s -> %s: %s", $options['From'] ?? '', $to, $options['Body']);
        return new MessageInstance(time() . rand(1000, 100000), new DateTimeImmutable(), $body, 200);
    }
}
