# Twilio Driver

Twilio Adapter is an implementation of `drewlabs/envoyer` driver or client interface that uses twilio `messages REST API` internally to send text message to phone number endpoint.

## Usage

```php
use Drewlabs\Envoyer\Contracts\NotificationResult;
use Drewlabs\Envoyer\Drivers\Twilio\TwilioAdapter;
use Drewlabs\Envoyer\Message;

// Create an adapter instance
$adapter = TwilioAdapter::new('key', 'secret');

// Create message instance
$message = Message::new()->from('22990667812')->to('22890667723')->content('Hi!');

// Send message using the adapter
$result = $adapter->sendRequest($message); // NotificationResult
```
