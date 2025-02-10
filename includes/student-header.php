<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="website icon" type="webp" href="./assets/img/csi.webp">
    <link rel="stylesheet" href="./assets/css/student.css?v=<?php echo time(); ?>" />
    <style>

    </style>

</head>

<body class="lms-scroll-bar">
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark nav-shadow">
        <div class="container-fluid">
            <!-- Sidebar Toggle Button -->
            <button
                class="navbar-toggler bg-light"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#sidebar"
                aria-controls="sidebar"
                aria-label="Toggle sidebar"
                title="Toggle sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!--  Title -->
            <div class="image d-flex align-items-center">
                <a href="?page=home">
                    <span class="d-none d-lg-inline">
                        <img src="assets/img/csi.webp" alt="LMS Logo">
                    </span>
                </a>
                <!-- Small title for mobile view -->
                <div class="navbar-brand text-white d-none d-lg-inline">
                    <span class="color">L</span>earning <span class="color">M</span>anagement
                    <span class="color">S</span>ystem
                </div>

                <!-- Large title for desktop view -->
                <span class="text-white fs-6 me-3 d-inline d-lg-none">
                    <span class="color">L</span>earning <span class="color">M</span>anagement
                    <span class="color">S</span>ystem
                </span>
            </div>


            <!-- Profile Dropdown -->
            <div class="me-2">
                <div class="dropdown d-none d-lg-block ms-auto text-success">
                    <a href="#" class="d-flex align-items-center text-decoration-none" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="text-black fs-6">
                            <!-- show user role -->
                            <small class="text-white fw-semibold">Welcome, <?php echo ucwords(strtolower($_SESSION["user_role"])); ?></small>
                            <i class="bi bi-person-circle ms-1 text-white" style="font-size: 1.3rem;"></i>
                        </div>
                    </a>



                    <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="profileDropdown">
                        <li class="ms-3">
                            <i class="bi bi-patch-check-fill text-success"></i>
                            <?php echo ucwords(strtolower($_SESSION["user_role"])) ?>
                        </li>
                        <li>
                            <hr class="mx-3 my-1">
                        </li>
                        <li>
                            <a class="dropdown-item" href="?page=student_prof">My Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="?page=student_account">Account</a>
                        </li>
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
    <header>
        <div class="container-fluid">
            <div class="row mt-5">
                <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar offcanvas-md offcanvas-start" style="max-width: 250px;">
                    <div class="position-sticky">
                        <!-- <h3 class="mb-4">Dashboard</h3> -->
                        <div class="text-white ms-2 d-lg-none mt-2">
                            <?php
                            echo ucwords(strtolower($_SESSION['stu_fname'] . ' ' . $_SESSION['stu_lname']));
                            echo '<i class="bi bi-person-circle ms-3 fs-2"></i>';
                            ?>
                        </div>
                        <hr class=" d-lg-none">

                        <ul class="nav flex-column">
                            <li class="fw-bold dasboard text-center d-none d-lg-inline">
                                DASHBOARD
                            </li>
                            <li>
                                <br />
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=student_home">
                                    <i class="bi bi-house-door me-2"></i> Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=student_prof">
                                    <i class="bi bi-person-lines-fill me-2"></i>Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=student_section">
                                    <i class="bi bi-building-fill me-2"></i> Section
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=student_subject">
                                    <i class="bi bi-journal-bookmark-fill me-2"></i>Subject
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=student_module">
                                    <i class="bi bi-journal-bookmark-fill me-2"></i> Module
                                </a>
                            </li>

                            <!-- THISI IS THE ROUTE OF QUIZ -->
                            <li class="nav-item">
                                <a class="nav-link  text-white" href="#quizMenu" data-bs-toggle="collapse" aria-expanded="false" id="examDropdown">
                                    <i class="bi bi-lightbulb me-2"></i>Quiz <i class="bi bi-chevron-down" style="margin-left: 55px;" id="quizIcon"></i>
                                </a>
                                <ul class="collapse list-unstyled ps-1" id="quizMenu">
                                    <li class="nav-item mt-2">
                                        <a class="nav-link active" href="index.php?page=student_quiz">
                                            <i class="bi  bi-file-text-fill me-2"></i>Start Quiz
                                        </a>
                                    </li>
                                    <li class="nav-item mt-2">
                                        <a class="nav-link active" href="index.php?page=student_quiz_result">
                                            <i class="bi bi-clipboard-data me-2"></i>Quiz Result
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- THISI IS THE ROUTE OF EXAM -->
                            <li class="nav-item">
                                <a class="nav-link  text-white" href="#examMenu" data-bs-toggle="collapse" aria-expanded="false" id="examDropdown">
                                    <i class="bi bi-book me-2"></i>Exam <i class="bi bi-chevron-down" style="margin-left: 50px;" id="examIcon"></i>
                                </a>
                                <ul class="collapse list-unstyled ps-1" id="examMenu">
                                    <li class="nav-item mt-2">
                                        <a class="nav-link active" href="index.php?page=student_exam">
                                            <i class="bi  bi-file-text-fill me-2"></i>Start Exam
                                        </a>
                                    </li>
                                    <li class="nav-item mt-2">
                                        <a class="nav-link active" href="index.php?page=student_exam_result">
                                            <i class="bi bi-clipboard-data me-2"></i>Exam Result
                                        </a>
                                    </li>
                                </ul>
                            </li>



                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=student_grade">
                                    <i class="bi bi-bar-chart me-2"></i> Grades
                                </a>
                            </li>
                            <li class="nav-item">
                                <a type="button" class="nav-link active" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                                </a>
                            </li>
                        </ul>

                    </div>
                </nav>

                <!-- Logout Modal -->
                <div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="logoutModalLabel">
                    <div class="modal-dialog modal-dialog-centered modal-md">
                        <div class="modal-content">

                            <div class="modal-body text-center mt-5">
                                <div class="text-danger">
                                    <i class="bi bi-question-circle fs-1"></i><br><br>
                                </div>
                                <h5>Are you sure you want to logout?</h5>
                            </div>
                            <div class="d-flex justify-content-center mt-5 mb-5 ">
                                <button class="btn btn-outline-secondary me-4" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                <a href="logout.php" class="btn btn-danger" style="width: 120px;">Okay</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </header>


    <!-- Bootstrap JS and Dependencies -->
    <!-- NOTE : DON'T REMOVE THIS DEPENDENCIES  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Reusable function for handling the icon toggle based on the collapse behavior
            function toggleCollapseIcon(menuId, iconId) {
                const menu = document.getElementById(menuId);
                const icon = document.getElementById(iconId);

                menu.addEventListener('show.bs.collapse', function() {
                    icon.classList.remove('bi-chevron-down'); // Original icon
                    icon.classList.add('bi-chevron-up'); // Change to up icon
                });

                menu.addEventListener('hide.bs.collapse', function() {
                    icon.classList.remove('bi-chevron-up'); // Remove up icon
                    icon.classList.add('bi-chevron-down'); // Change back to original icon
                });
            }

            // Apply the function to different menus and icons
            toggleCollapseIcon('examMenu', 'examIcon');
            toggleCollapseIcon('quizMenu', 'quizIcon');
        });
    </script>