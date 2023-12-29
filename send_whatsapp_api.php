<?php

//Connecting Twilio API

require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

// Twilio credentials
$accountSid = 'AC2ce8955f2a65a44c00da2a0dfdd63cbd';
$authToken = 'd9950fc82fc9d06ed2882d376023ad22';
$fromWhatsappNumber = '+14155238886';

// Create Twilio client
$client = new Client($accountSid, $authToken);

function sendWhatsappMessage($to, $message) {
    global $client, $fromWhatsappNumber;

    try {
        $message = $client->messages
            ->create("whatsapp:$to", // To
                [
                    "from" => "whatsapp:$fromWhatsappNumber", // From
                    "body" => $message,
                ]
            );

        echo "Message sent to $to: " . $message->sid . PHP_EOL;
    } catch (Exception $e) {
        echo "Error sending message to $to: " . $e->getMessage() . PHP_EOL;
    }
}

?>
