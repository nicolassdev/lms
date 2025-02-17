<?php
session_start(); // Start the session
$userRole = isset($_SESSION['user_role']) ? ucfirst(strtolower($_SESSION['user_role'])) : 'Guest'; // Get user role
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading...</title>
    <link rel="website icon" type="webp" href="assets/img/csi.webp">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #1e1e1e;
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

        .modal-notification {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            z-index: 1050;
            background-color: #0d6efd;
            color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            padding: 15px;
            border-radius: 5px;
            animation: fadeIn 0.5s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="loading-container">
        <div class="loader"></div>
        <h1>Welcome <?php echo $userRole; ?></h1>
        <p><i class="bi bi-arrow-clockwise"></i> Retrieving your information...</p>
        <p class="blinking">
            <i class="bi bi-hourglass-split"></i> Fetching updates from our server...
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const redirectUrl = "<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : './login.php'; ?>";
        const statusMessage = "<?php echo isset($_GET['status']) ? $_GET['status'] : ''; ?>";

        if (statusMessage === 'success') {
            const notification = document.createElement('div');
            notification.classList.add('modal-notification');
            notification.innerHTML = `
                <small><b>Welcome back, <?php echo $userRole; ?>!</b><br>
                Your dashboard is being prepared.</small>
            `;
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 3000);
        }

        setTimeout(function() {
            window.location.href = redirectUrl;
        }, 3000);
    </script>
</body>


</html>