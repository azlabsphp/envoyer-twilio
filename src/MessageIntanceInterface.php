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

interface MessageIntanceInterface
{
    /**
     * return created date time of the message.
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * returns the message id value.
     *
     * @return string|int
     */
    public function getId();

    /**
     * returns the message status code value.
     *
     * @return int
     */
    public function getStatusCode();

    /**
     * Returns the message isntance body.
     *
     * @return string
     */
    public function getBody();
}
