<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_FILES['csvFileInput']['tmp_name'])) {
        
        $file = $_FILES['csvFileInput']['tmp_name'];

        if ($file) {
            $csvContent = file_get_contents($file);
            $lines = explode("\n", $csvContent);

            // Assuming the first line contains headers and the phone number column is named 'phone'
            $headers = explode(",", trim($lines[0]));
            $phoneNumberIndex = array_search('phone', $headers);
            $phoneNumbers = [];

            foreach ($lines as $i => $line) {
                // Skip the header line
                if ($i === 0) {
                    continue;
                }

                $data = explode(",", trim($line));
                
                if (isset($data[$phoneNumberIndex])) {
                    $phoneNumbers[] = $data[$phoneNumberIndex];
                }
            }

            // Remove any occurrences of the word 'phone' from the extracted phone numbers
            $phoneNumbers = array_filter($phoneNumbers, function($phoneNumber) {
                return strtolower($phoneNumber) !== 'phone';
            });

            // Now, 'phoneNumbers' array contains all phone numbers from the CSV file without the word 'phone'
            // echo implode(', ', $phoneNumbers);
        }
    } 
}

?>
