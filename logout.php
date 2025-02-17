<?php
session_start();

// Destroy all session data and log out the user
session_unset(); // Clears all session variables
session_destroy(); // Destroys the session

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out</title>
    <link rel="website icon" type="webp" href="assets/img/csi.webp">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #1e1e1e;
            color: #ecf0f1;
        }

        .message {
            text-align: center;
            opacity: 1;
            transition: opacity 1s ease-in-out;
        }
    </style>
    <script>
        setTimeout(() => {
            document.querySelector('.message').style.opacity = 0;
        }, 500); // Start fade-out after 0.5 seconds

        setTimeout(() => {
            window.location.href = "login.php?success=logout";
        }, 1500); // Redirect after 1.5 seconds
    </script>
</head>

<body>
    <div class="message">
        <h1>Logging Out...</h1>
        <p>You will be redirected shortly.</p>
    </div>
</body>

</html>