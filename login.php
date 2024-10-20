 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="website icon" type="png" href="assets/img/lms.png">
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
        } elseif ($user_role === "student") {
            // If logged in, redirect to the homepage
            header('Location: /lms/index.php'); // Change to the actual homepage path
            exit(); // Exit after redirection to prevent further code execution
        }elseif($user_role === "teacher"){
            
            header('Location: /lms/index.php');
            exit();
        }
    }
    ?>


 <body>
     <div class="container">
         <?php
            include("includes/alert-notify.php");
            ?>
         <div class="row text-center">
             <div class="col-md ml-xl">
                 <img src="./assets/img/student-login-logo.svg" alt="Login Logo" draggable="false">
             </div>
             <div class="col-md mr-xl">
                 <!-- login form -->
                 <form action="./includes/login-inc.php" method="POST" onsubmit="showLoading()">
                     <h2>Login</h2>
                     <div class="input-box">
                         <span class="icon">
                             <img src="assets/img/icons8-user-24.png" alt="user icon" /></span>
                         <input type="text" placeholder="Username" name="username" required autocomplete="off" autofocus />
                     </div>
                     <div class="input-box">
                         <span class="icon">
                             <img src="assets/img/icons8-lock-24.png" alt="lock icon" /></span>
                         <input type="password" placeholder="Password" name="password" required autocomplete="off" autofocus />
                     </div>
                     <button type="submit" name="submit">Login</button>
                 </form>

                 <div class="text-caption">
                     <span class="text-note">Note: </span>
                     Only Students and Faculty of CSI can access this website.
                 </div>
             </div>
         </div>
     </div>
 </body>

 </html>

 <script>
     function showLoading() {
         // Redirect to the loading page
         window.location.href = "loading.php";
     }
 </script>
 <?php
    require_once('includes/footer.php');
    ?>


 <!-- Footer included directly on the page -->