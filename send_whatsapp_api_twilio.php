<?php

//Connecting Twilio API

require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

// Twilio credentials
$accountSid = ''; //write account sid
$authToken = ''; //write auth token
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

// Debugging: Output received data
echo "Received POST data: " . print_r($_POST, true) . PHP_EOL;

// Process form data if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form inputs
    $message = $_POST['message'] ?? '';
    $phoneNumbers = $_POST['phoneNumbers'] ?? '';

    // Debugging: Output extracted data
    echo "Extracted message: $message" . PHP_EOL;
    echo "Extracted phone numbers: $phoneNumbers" . PHP_EOL;

    // Validate inputs (you can add more validation as needed)
    if (empty($message) || empty($phoneNumbers)) {
        echo "Please provide both a message and phone numbers.";
    } else {
        // If there's only one phone number, send a single message
        if (strpos($phoneNumbers, ',') === false) {
            sendWhatsappMessage($phoneNumbers, $message);
        } else {
            // If there are multiple phone numbers, split and send individual messages
            $phoneNumbersArray = explode(',', $phoneNumbers);
            foreach ($phoneNumbersArray as $phoneNumber) {
                sendWhatsappMessage(trim($phoneNumber), $message);
            }
        }
    }
}

?>
