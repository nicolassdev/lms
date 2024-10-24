<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="icon" type="webp" href="../assets/img/lms.webp">
    <link rel="stylesheet" href="../assets/css/student.css?v=<?php echo time(); ?>" />
</head>

<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Sidebar Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--  Title -->
            <div class="navbar-brand">
                Learning Management System
            </div>

            <!-- Profile Dropdown -->
            <div class="me-2">
                <div class="dropdown d-none d-lg-block ms-auto text-success nav-shadow">
                    <a href="#" class="d-flex align-items-center text-decoration-none" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="text-black me-2" style="font-weight: 400;">
                            <?php
                            echo ucwords(strtolower($_SESSION["teacher_fname"] . ' ' . $_SESSION["teacher_lname"]));
                            ?>
                            <i class="bi bi-person-circle ms-1" style="font-size: 1.3rem;"></i>
                        </div>
                    </a>
                    <ul class=" dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li class="ms-3"><i class="bi bi-patch-check-fill text-success"></i> <?php echo ucwords(strtolower($_SESSION["user_role"])) ?> </li>
                        <hr class="mx-3 my-1">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="side">
        <div class="container-fluid">
            <div class="row mt-5">
                <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar offcanvas-md offcanvas-start">
                    <div class="position-sticky mt-4">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=student_home">
                                    <i class="bi bi-house-door me-2"></i> Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=student_prof">
                                    <i class="bi bi-person-lines-fill me-2"></i> Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=student_quiz">
                                    <i class="bi bi-lightbulb me-2"></i> Quiz
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=student_exam">
                                    <i class="bi bi-book me-2"></i></i>Exam
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=student_assignment">
                                    <i class="bi bi-pencil  me-2"></i> Assignments
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=student_grade">
                                    <i class="bi bi-bar-chart me-2"></i> Grades
                                </a>
                            </li>
                            <li class="nav-item">
                                <a type="button" class="nav-link active" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    <i class="bi bi-box-arrow-right  me-1"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>

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

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>