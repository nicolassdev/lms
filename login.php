<?php
// Check if the user role is set
if (isset($_SESSION['user_role'])) {
  // Check user role and redirect accordingly
  $user_role = strtolower($_SESSION['user_role']);

  if ($user_role === "registrar") {

    header('Location:/lms/admin/index.php'); // Change to the actual homepage path
    exit();
  } elseif ($user_role === "principal") {

    header('Location:/lms/principal/index.php');
    exit();
  } elseif ($user_role === "teacher") {

    header('Location:/lms/faculty/index.php');
    exit();
  } elseif ($user_role === "student") {
    // If logged in, redirect to the homepage
    header('Location:/lms/index.php'); // Change to the actual homepage path
    exit(); // Exit after redirection to prevent further code execution
  }
}
?>
<?php
session_start();
include("includes/alert-notify.php"); // handles header redirects first
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

<body style="background-color: #16404D; ">
  <!-- About & Contact Us Links in Upper Right -->
  <div class="position-absolute top-0 start-0 p-3 d-flex gap-3 d-none d-lg-inline ">
    <h5 class="text-white fw-bold text-decoration-none">Learning Management System</h5>
  </div>

  <div class="btn-custom">
    <a href="about.php"><i class="fa fa-info-circle"></i> About</a>
    <a href="contact.php"><i class="fa-solid fa-envelope"></i> Contact Us</a>
  </div>
  <div class="d-flex align-items-center justify-content-center" style="margin-top: 110px;">
    <div class="container">
      <div class="row justify-content-center align-items-center">

        <!-- Left Side - CSI Information -->
        <div class="col-md-6 text-center text-white mb-3">
          <div class="d-none d-md-block illustration">
            <h3 class="fw-bold">Computer Systems Institute</h3>
            <p class="h6 fw-normal mb-4"><i>Dream big, get involved, Aim High with CSI.</i></p>
            <img src="assets/img/csi.webp" draggable="false" alt="CSI Logo" class="img-fluid" style="width:280px;">
          </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="col-md-5">
          <div class="login-container">
            <!-- desktop design -->
            <!-- <div class="d-none d-lg-inline text-center ">
               <h4 class="text-light fw-bold mb-0 mt-3">Learning Management System</h4>
             </div> -->
            <!-- mobile design  -->
            <div class="d-flex align-items-center mb-5 pb-1">
              <img src="assets/img/csi.webp"
                alt="login form"
                class="img-fluid  d-inline d-lg-none"
                style="width:50px; border-radius: 1rem 0 0 1rem;" />
              <div class="text-center d-inline d-lg-none ms-2 text-light">
                <small class="fw-bold mb-0 d-block" style="font-size: 13px;">Learning Management System</small>
                <small class="fw-bold mb-0 d-block">Computer Systems Institute</small>
              </div>
            </div>
            <!-- FORM ELEMENT  -->
            <form action="./includes/login-inc.php" method="POST" onsubmit="showLoading()">
              <h5 class="fw-semibold mb-5 text-light" style="letter-spacing: 1px;">Login into your account</h5>
              <!-- Username -->
              <div class="form-outline text-light mb-4">
                <input type="text" name="username" class="form-control form-control-lg text-light" autocomplete="off" required />
                <label class="form-label text-light">Username</label>
              </div>

              <!-- Password -->
              <div class="form-outline text-light mb-4">
                <input type="password" name="password" class="form-control form-control-lg text-light" autocomplete="off" required />
                <label class="form-label text-light">Password</label>
              </div>

              <!-- Login Button -->
              <button type="submit" name="submit" class="btn-login btn-lg btn-block mb-4">Login</button>

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
  </script>

</body>

</html>