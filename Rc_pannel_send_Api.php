<?php

// Include the CSV processing logic
include 'process_csv.php';

// Initialize variables for redirect URLs
$successRedirect = 'send_whatsapp_success.php';
$errorRedirect = 'send_whatsapp_error.php';

if (isset($_POST['submit'])) {

    // Check if both message and CSV are provided
    if (!empty($_POST['message']) && !empty($phoneNumbers)) {

        // Message input from the form
        $message = $_POST['message'];
        $appKey = 'f55ddb55-c82f-4ab3-ae1c-8e21aca193ff';
        $authKey = '2I9a8pDGs9XPYALceOfcE4tBmO20giHixwslQ4FiJ5Ia2z4ZPW';
        $sandbox = 'false';

        // Flag to check if any message was successfully sent
        $messageSent = false;

        // Loop through each phone number and send the WhatsApp message
        foreach ($phoneNumbers as $mobno) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://whats-api.rcsoft.in/api/create-message',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'appkey' => $appKey,
                    'authkey' => $authKey,
                    'to' => $mobno,
                    'message' => $message,
                    'sandbox' => $sandbox,
                ),
            ));

            $response = curl_exec($curl);

            // Display HTTP status code for debugging
            $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            echo "HTTP Status Code: $httpStatus";

            if ($response === false) {
                echo "Error: " . curl_error($curl);
            }
            else {
                
                
                // Parse the response (assuming it's in JSON format)
                $responseData = json_decode($response, true);
            
                if (isset($responseData['error'])) {
                    if ($httpStatus == 401) {
                        echo "Authentication failed. Please check your credentials.";
                    } else {
                        echo "Error sending message to $mobno: " . $responseData['error'];
                    }
                } else {
                    $messageSent = true;
                    echo "Message sent to $mobno: " . $response;
                }
            }

            curl_close($curl);
        }

        // Redirect based on the result
        if ($messageSent) {
            header("Location: $successRedirect");
            exit;
        } else {
            header("Location: $errorRedirect");
            exit;
        }

    }
}
?>