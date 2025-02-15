 <?php
  // Start the session
  session_start();

  // Check if the user role is set
  if (isset($_SESSION['user_role'])) {
    // Check user role and redirect accordingly
    $user_role = strtolower($_SESSION['user_role']);

    if ($user_role === "registrar") {

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
  ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <link rel="website icon" type="webp" href="assets/img/csi.webp">
   <link rel="stylesheet" href="assets/css/login.css?v=<?php echo time(); ?>" />
   <title>Login</title>

   <!-- MDB CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css">
   <!-- Font Awesome for Icons -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
 </head>

 <body>
   <?php
    include("includes/alert-notify.php");
    ?>
   <div class="vh-100 d-flex align-items-center justify-content-center" style="background-color: #212529;">
     <div class="container">
       <div class="row justify-content-center align-items-center">

         <!-- Left Side - CSI Information -->
         <div class="col-md-6 text-center text-white mb-3">
           <div class="d-none d-md-block illustration">
             <h3 class="fw-bold">Computer Systems Institute</h3>
             <p class="h6 fw-normal mb-4"><i>Dream big, get involved, Aim High with CSI.</i></p>
             <img src="assets/img/csi.webp" alt="CSI Logo" class="img-fluid" style="width:280px;">
           </div>
         </div>

         <!-- Right Side - Login Form -->
         <div class="col-md-5">
           <div class="login-container">
             <!-- desktop design -->
             <div class="d-none d-lg-inline text-center ">
               <h4 class="text-dark fw-bold mb-0">Learning Management System</h4>
             </div>
             <!-- mobile design  -->
             <div class="d-flex align-items-center mb-5 pb-1">
               <img src="assets/img/csi.webp"
                 alt="login form"
                 class="img-fluid  d-inline d-lg-none"
                 style="width:50px; border-radius: 1rem 0 0 1rem;" />
               <div class="text-center d-inline d-lg-none ms-2">
                 <small class="fw-bold mb-0 d-block">Learning Management System</small>
                 <small class="fw-bold mb-0 d-block">Computer Systems Institute</small>
               </div>
             </div>
             <!-- FORM ELEMENT  -->
             <form action="./includes/login-inc.php" method="POST" onsubmit="showLoading()">
               <h6 class="fw-normal mb-4" style="letter-spacing: 1px;">Login into your account</h6>
               <!-- Username -->
               <div class="form-outline mb-4">
                 <input type="text" name="username" class="form-control form-control-lg" autocomplete="off" required />
                 <label class="form-label">Username</label>
               </div>

               <!-- Password -->
               <div class="form-outline mb-4">
                 <input type="password" name="password" class="form-control form-control-lg" autocomplete="off" required />
                 <label class="form-label">Password</label>
               </div>

               <!-- Login Button -->
               <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block mb-4">Login</button>
             </form>

           </div>
         </div>

       </div>
     </div>
   </div>

   <!-- MDB JavaScript -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
   <script>
     function showLoading() {
       // Redirect to the loading page
       window.location.href = "loading.php";
       //  document.getElementById('loading').style.display = 'flex';
     }

     document.addEventListener("DOMContentLoaded", function() {
       mdb.Input.init(document.querySelectorAll('.form-outline'));
       mdb.Ripple.init(document.querySelectorAll('.btn'));
     });
   </script>

 </body>

 </html>