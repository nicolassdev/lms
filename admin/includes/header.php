<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS</title>
    <!-- <link href="../css/bootstrap-icons.min.css" rel="stylesheet"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Bootstrap Icons -->
    <!-- <link href="../css/bootstrap-icons.css" rel="stylesheet"> -->
    <link rel="icon" type="png" href="../assets/img/csi.png">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <link rel="stylesheet" href="./css/admin.css?v=<?php echo time(); ?>" />
    <!-- <link rel="stylesheet" href="../../assets/css/datatables.min.css"> -->


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">


</head>

<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Sidebar Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="image">
                <a href="?page=home"><img src="../assets/img/logo.png" alt="LMS Logo"></a>
                <span class=" d-none d-lg-inline">Learning Management System</span>
            </div>

            <!-- Profile Dropdown (Visible on all screen sizes) -->
            <div class="dropdown d-none d-lg-block ms-auto">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="ms-2 d-none d-sm-inline me-2">Principal</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="?page=settings">Settings</a></li>
                    <li><a class="dropdown-item" href="?page=admin">Profile</a></li>
                    <li>
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header>
        <div class="container-fluid">
            <div class="row mt-4">
                <!-- Sidebar -->
                <nav id="sidebar" class="col-md-3 col-lg-2 bg-dark sidebar offcanvas-md offcanvas-start" style="max-width: 250px;">
                    <div class="position-sticky">
                        <h3 class="mb-4 text-white">Dashboard</h3>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=home ">
                                    <i class="bi bi-house me-1"></i>Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=users">
                                    <i class="bi bi-person-vcard me-1"></i>Users
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=student">
                                    <i class="bi bi-person me-1"></i>Student
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
                                <a class="nav-link active" href="index.php?page=enrollment">
                                <i class="bi bi-person-lines-fill me-1"></i>Enrollment
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
                        <div class="modal-content">

                            <div class="modal-body text-center mt-5">
                                <div class="text-primary">
                                    <i class="bi bi-question-circle fs-1 "></i><br><br>
                                </div>
                                <h5>Are you sure you want to logout?</h5>
                            </div>
                            <div class="d-flex justify-content-center mt-5 mb-5 ">
                                <button class="btn btn-outline-secondary me-3" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                <a href="../logout.php" class="btn btn-primary" style="width: 120px;">Okay</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>