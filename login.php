 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="website icon" type="webp" href="assets/img/csi.webp">
     <link rel="stylesheet" href="assets/css/login.css?v=<?php echo time(); ?>" />
     <title>Login</title>

 </head>

 <?php
    // Start the session
    session_start();
    // Check if the user role is set
    if (isset($_SESSION['user_role'])) {
        // Check user role and redirect accordingly
        $user_role = strtolower($_SESSION['user_role']);

        if ($user_role === "admin") {

            header('Location: /lms/admin/index.php'); // Change to the actual homepage path
            exit();
        } elseif ($user_role === "principal") {

            header('Location: /lms/principal/index.php');
            exit();
        } elseif ($user_role === "teacher") {

            header('Location: /lms/faculty/index.php');
            exit();
        } elseif ($user_role === "student") {
            // If logged in, redirect to the homepage
            header('Location: /lms/index.php'); // Change to the actual homepage path
            exit(); // Exit after redirection to prevent further code execution
        }
    }

    // USING SWITCH CASE TO IDENTIFY THE USER TYPE 
    // if (isset($_SESSION['user_role'])) {
    //     switch (strtolower($_SESSION['user_role'])) {
    //         case 'admin':
    //             header('Location: /lms/admin/index.php');
    //             break;
    //         case 'teacher':
    //             header('Location: /lms/faculty/index.php');
    //             break;
    //         case 'student':
    //             header('Location: /lms/student/index.php');
    //             break;
    //         default:
    //             header('Location: /lms/login.php?error=invalidcredentials');
    //     }
    //     exit();
    // }

    ?>


<body>
    <!-- Header -->
    <header class="header">
        <h1>Computer System Institute</h1>
        <h2>Learning Management System</h2>


    </header>

    <!-- Main Container -->
    <div class="container">
        <div class="login-box">
            <img src="./assets/img/csi.webp" alt="Login Logo" draggable="false" class="login-logo">
            <h2>Login</h2><br>
            <?php include("includes/alert-notify.php"); ?>
            <form action="./includes/login-inc.php" method="POST" onsubmit="showLoading()">
                <div class="input-box">
                    <span class="icon">
                        <img src="assets/img/icons8-user-24.webp" alt="User Icon">
                    </span>
                    <input type="text" placeholder="Username" name="username" required autocomplete="off" autofocus>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <img src="assets/img/icons8-lock-24.webp" alt="Lock Icon">
                    </span>
                    <input type="password" placeholder="Password" name="password" required autocomplete="off">
                </div>
                <button type="submit" name="submit">Login</button>
            </form>
            <div class="text-caption">
                <?php require_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>

    <!-- Loading Animation -->
    <script>
        function showLoading() {
            document.getElementById('loading').style.display = 'flex';
        }
    </script>
</body>

</html>
