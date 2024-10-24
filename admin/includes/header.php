 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>LMS</title>
     <!-- <link href="../css/bootstrap-icons.min.css" rel="stylesheet"> -->
     <!-- Bootstrap Icons -->
     <!-- <link href="../css/bootstrap-icons.css" rel="stylesheet"> -->
     <link rel="icon" type="webp" href="../assets/img/lms.webp">
     <link href="./css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

     <link rel="stylesheet" href="./css/admin.css?v=<?php echo time(); ?>" />
     <!-- <link rel="stylesheet" href="../../assets/css/datatables.min.css"> -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />


     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- DataTables CSS -->
     <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
     <!-- DataTables Buttons CSS -->
     <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">


     <!-- Include Morris.js and jQuery -->
     <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
     <!-- Include Animate.css -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">


 </head>

 <body>
     <!-- Top Navigation Bar -->
     <nav class="navbar navbar-expand-lg navbar-light bg-dark nav-shadow">
         <div class="container-fluid">
             <!-- Sidebar Toggle Button -->
             <button class="navbar-toggler bg-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="image">
                 <a href="?page=home"><img src="../assets/img/lms.webp" alt="LMS Logo"></a>
                 <span class=" d-none d-lg-inline text-white"><span class="color">L</span>earning <span class="color">M</span>anagement <span class="color">S</span>ystem</span>
             </div>

             <!-- Profile Dropdown (Visible on all screen sizes) -->
             <div class="dropdown d-none d-lg-block ms-auto text-success">
                 <a href="#" class="d-flex align-items-center text-decoration-none" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                     <div class="text-white me-2" style="font-weight: 400;">
                         <?php
                            echo ucwords(strtolower($_SESSION["firstname"] . ' ' . $_SESSION["lastname"]));
                            ?>
                         <i class="bi bi-person-fill-gear" style="font-size: 1.5rem;"></i>
                     </div>
                 </a>



                 <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                     <li class="ms-3"><i class="bi bi-patch-check-fill text-success"></i> <?php echo ucwords(strtolower($_SESSION["user_role"])) ?></li>
                     <hr class="mx-3 my-1">
                     <li><a class="dropdown-item" href="?page=admin">Profile</a></li>
                     <li><a class="dropdown-item" href="?page=settings">Settings</a></li>
                     <li>
                         <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
                             Logout
                         </a>
                     </li>
                 </ul>
             </div>
         </div>
     </nav>



     <!-- Sidebar -->
     <header>
         <div class="container-fluid">
             <div class="row mt-4">
                 <!-- Sidebar -->
                 <nav id="sidebar" class="col-md-3 col-lg-2 bg-dark sidebar offcanvas-md offcanvas-start" style="max-width: 250px;">
                     <div class="position-sticky">
                         <h3 class="mb-4 color ms-3">Dashboard</h3>
                         <ul class="nav flex-column">
                             <li class="nav-item">
                                 <a class="nav-link active" href="index.php?page=home ">
                                     <i class="bi bi-house me-1"></i>Home
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link active sm-5" href="index.php?page=users">
                                     <i class="bi bi-person-vcard me-1"></i>Users
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link active" href="index.php?page=student">
                                     <i class="bi bi-person me-1"></i>Student
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link active" href="index.php?page=enrollment">
                                     <i class="bi bi-person-lines-fill me-1"></i>Enrollment
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link active" href="index.php?page=teacher">
                                     <i class="bi bi-people me-1"></i>Faculty
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link active" href="index.php?page=strand">
                                     <i class="bi bi-mortarboard me-1"></i>Strand
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link active" href="index.php?page=section">
                                     <i class="bi bi-building-fill-add me-1"></i>Section
                                 </a>
                             </li>


                             <li class="nav-item">
                                 <a class="nav-link active" href="index.php?page=subject">
                                     <i class="bi bi-journal-bookmark me-1"></i>Subject
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link active" href="index.php?page=settings">
                                     <i class="bi bi-gear me-1"></i>Settings
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a type="button" class="nav-link active" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                     <i class="bi bi-box-arrow-right me-1"></i>Logout
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </nav>

                 <!-- Logout Modal -->
                 <div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered modal-md">
                         <div class="modal-content shadow-lg border-0 rounded-3">

                             <!-- Modal Body -->
                             <div class="modal-body text-center py-5">
                                 <!-- Icon and Message -->
                                 <div class="text-danger mb-4">
                                     <i class="bi bi-box-arrow-right fs-1"></i>
                                 </div>
                                 <h5 class="fw-bold mb-5">Are you sure you want to logout?</h5>

                                 <!-- Buttons -->
                                 <div class="d-flex justify-content-center mt-5 mb-3">
                                     <button class="btn btn-outline-secondary px-4 py-2 me-3" style="width: 120px; margin-top: 20px;" data-bs-dismiss="modal">Cancel</button>
                                     <a href="../logout.php" class="btn btn-danger px-4 py-2" style="width: 120px; margin-top: 20px;">Logout</a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>




             </div>
         </div>
     </header>



     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>