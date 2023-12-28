<!DOCTYPE html>
<html lang="en">
<head>
    <title>WhatsApp Bulk Messaging System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>

    <div class="container mt-5">
        <div class="card">
            <h1 class="text-center mb-4">WhatsApp Bulk Messaging System</h1>

            <form action="send_whatsapp_api.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Write your message here."></textarea>
                </div>

                <div class="form-group">
                    <label for="csvFileInput">Upload CSV:</label>
                    <input type="file" class="form-control-file" id="csvFileInput" name="csvFileInput" accept=".csv">
                </div>

                <!-- Adding a hidden input field to store phone numbers -->
                <input type="hidden" name="phoneNumbers" id="phoneNumbersInput" value="">

                <button type="button" class="btn btn-success" onclick="processCSV()">Process CSV</button>
                <br><br>
                <input type="submit" class="btn btn-primary" name="submit" value="Send">
                </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 Code Sprinters. All rights reserved.</p>
    </footer>

    <script>
        function processCSV() {
            // Using AJAX to call the PHP script
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                    // Setting the phone numbers in the hidden input field
                    document.getElementById('phoneNumbersInput').value = xhr.responseText;
                }
            };

            var formData = new FormData();
            formData.append('csvFileInput', document.getElementById('csvFileInput').files[0]);
            xhr.open('POST', 'process_csv.php', true);
            xhr.send(formData);
        }
    </script>
    
</body>
</html>
