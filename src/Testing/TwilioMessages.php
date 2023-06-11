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

class TwilioMessages
{
    public function create(string $to, array $options = []): MessageInstance
    {
        $body = sprintf('Message %s -> %s: %s', $options['From'] ?? '', $to, $options['Body']);

        return new MessageInstance(time().random_int(1000, 100000), new \DateTimeImmutable(), $body, 200);
    }
}
