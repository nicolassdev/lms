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
                 <form action="./includes/login-inc.php" method="POST"  onsubmit="showLoading()">
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
                 <script>
    function showLoading() {
        // Redirect to the loading page
        window.location.href = "loading.php";
    }
</script>
                 <div class="text-caption">
                     <span class="text-note">Note: </span>
                     Only Students and Faculty of CSI can access this website.
                 </div>
             </div>
         </div>
     </div>
     <script>
 

     <!-- Footer included directly on the page -->



     <?php
        require('includes/footer.php');

        ?>