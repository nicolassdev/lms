<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="website icon" type="png" href="img/csi.png">
    <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>" />
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row text-center">
            <div class="col-md ml-xl">
                <img src="./img/student-login-logo.svg" alt="Login Logo" draggable="false">
            </div>
            <!-- login form -->
            <div class="col-md mr-xl">
                <form action="includes/login-inc.php" method="POST">
                    <h2>Login</h2>
                    <div class="input-box">
                        <span class="icon">
                            <img src="icon/icons8-user-24.png" alt="" /></span>
                        <input type="text" placeholder="Username" name="username" required autocomplete="off" autofocus />
                    </div>
                    <div class="input-box">
                        <span class="icon">
                            <img src="icon/icons8-lock-24.png" alt="" /></span>
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

    <!-- Footer included directly on the page -->



    <?php
    require('includes/footer.php');
    ?>