<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading...</title>
    <link rel="website icon" type="png" href="assets/img/lms.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- todo style in loaing  -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #212529;
            /* Darker background */
            font-family: Arial, sans-serif;
            text-align: center;
            color: #ecf0f1;
            /* Light text color for contrast */
            margin: 0;
            padding: 0;
        }

        .loading-container {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .loader {
            border: 12px solid #34495e;
            /* Darker border */
            border-top: 12px solid #FABC3F;
            border-radius: 50%;
            width: 100px;
            /* Increased size */
            height: 100px;
            /* Increased size */
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        h1 {
            margin-top: 20px;
            font-size: 2rem;
            /* Larger font size */
            color: #ecf0f1;
        }

        p {
            font-size: 1.2rem;
            /* Slightly larger font size */
            color: #bdc3c7;
            /* Softer text color */
        }

        .blinking {
            font-weight: 30px;
            color: #FABC3F;
            animation: blink 2s steps(5, start) infinite;
            /* Blink animation */
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }
        }

        .loading-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 5px;
            background-color: #FABC3F;
            /* Loading bar color */
            animation: loading 3s linear infinite;
        }

        @keyframes loading {
            0% {
                width: 0%;
            }

            50% {
                width: 100%;
            }

            100% {
                width: 0%;
            }
        }
    </style>
</head>

<body>
    <div class="loading-container">
        <div class="loader"></div>
        <h1>Welcome Back!</h1>
        <p><i class="bi bi-arrow-clockwise"></i> Retrieving your information...</p>
        <p>Please wait while we prepare everything for you.</p>
        <p class="blinking"><i class="bi bi-hourglass-split"></i> Fetching updates from our server...</p> <!-- Blinking effect -->
    </div>
    <div class="loading-bar"></div>

    <script>
        // Redirect after a delay
        const redirectUrl = "<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : './login.php'; ?>";
        setTimeout(function() {
            window.location.href = redirectUrl;
        }, 3000); // Adjust the delay as needed
    </script>
</body>

</html>