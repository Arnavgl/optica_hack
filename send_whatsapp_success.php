<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Page</title>
    <link rel="stylesheet" href="confirmcss.css">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Adlam:wght@500&display=swap');
      footer {
        background-color: black;
        padding: 8px;
        text-align: center;
        position: fixed;
        width: 100%;
        bottom: 0;
        font-family: 'Noto Sans Adlam', sans-serif;
        text-transform: none;
        font-size: 1.45em;
      }
      footer p {
        margin:auto;
        font-size: 18px;
        color: white;
      }
    </style>
</head>
<body>

    <div id="container">
        <div id="success-box">
          <div class="dot"></div>
          <div class="dot two"></div>
          <div class="face">
            <div class="eye"></div>
            <div class="eye right"></div>
            <div class="mouth happy"></div>
          </div>
          <div class="shadow scale"></div>
          <div class="message"><h1 class="alert">Success!</h1><p><b>YAY! Message Sent Successfully.</b></p></div>
          <button class="button-box" onclick="location.href='index.php'"><h1 class="green"><b>continue</b></h1></button>
        </div>
      </div>
      <footer>
        <p>&copy; 2024 Code Sprinters. All Rights Reserved.</p>
     </footer>

</body>
</html>
