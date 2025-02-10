<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Management System</title>

    <link rel="icon" type="webp" href="../assets/img/csi.webp">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/teacher.css?v=<?php echo time(); ?>" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">




    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">



</head>

<body class="lms-scroll-bar">
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark nav-shadow">
        <div class="container-fluid">
            <!-- Sidebar Toggle Button -->
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar" aria-label="Toggle sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="image d-flex align-items-center">
                <a href="?page=home">
                    <span class="d-none d-lg-inline">
                        <img src="../assets/img/csi.webp" alt="LMS Logo">
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
                <div class="dropdown d-none d-lg-block ms-auto text-success nav-shadow">
                    <a href="#" class="d-flex align-items-center text-decoration-none" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="text-black fs-6">

                            <small class="text-white fw-semibold">Welcome, <?php echo ucwords(strtolower($_SESSION["user_role"])); ?></small>

                            <i class="bi bi-person-circle ms-1 text-white" style="font-size: 1.3rem;"></i>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li class="ms-3"><i class="bi bi-patch-check-fill text-success"></i> <?php echo ucwords(strtolower($_SESSION["user_role"])); ?> </li>
                        <hr class="mx-3 my-1">
                        <li><a class="dropdown-item" href="?page=teacher_prof">Profile</a></li>
                        <li><a class="dropdown-item" href="?page=teacher_account">Account</a></li>
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
            <div class="row">
                <nav id="sidebar" class="col-md-5 col-lg-2 bg-dark sidebar offcanvas-md offcanvas-start" style="max-width: 250px;">
                    <div class="position-sticky">
                        <div class="text-white ms-4 d-lg-none mt-2">
                            <?php
                            echo ucwords(strtolower($_SESSION['teacher_fname'] . ' ' . $_SESSION['teacher_lname']));
                            echo '<i class="bi bi-person-circle ms-3 fs-2"></i>';
                            ?>
                        </div>
                        <hr class=" d-lg-none">


                        <ul class="nav flex-column">
                            <div class="nav-link fs-5 text-white fw-bold dasboard d-none d-lg-inline mb-2">
                                MENU
                            </div>

                            <li class="nav-item mt-2">
                                <a class="nav-link active" href="index.php?page=dashboard">
                                    <i class="bi bi-graph-up-arrow me-2"></i> Dashboard
                                </a>
                            </li>

                            <!-- THIS IS DROP DOWN SELECT IN SIDE BAR  -->
                            <!-- <li class="nav-item">
                                <a class="nav-link  text-white" href="#studentMenu" data-bs-toggle="collapse" aria-expanded="false" id="studentDropdown">
                                    <i class="bi bi-person me-1"></i> Student <i class="bi bi-chevron-down" style="margin-left: 68px;" id="studentIcon"></i>
                                </a>
                                <ul class="collapse list-unstyled ps-1" id="studentMenu">
                                    <li class="nav-item mt-2">
                                        <a class="nav-link active" href="index.php?page=new_student">

                                            <i class="bi bi-plus-circle me-2"></i>New Student
                                        </a>
                                    </li>
                                    <li class="nav-item mt-2">
                                        <a class="nav-link active" href="index.php?page=student_accounts">
                                            <i class="bi bi-database-fill me-2"></i>Student Accounts
                                        </a>
                                    </li>
                                    <li class="nav-item mt-2">
                                        <a class="nav-link active" href="index.php?page=register_student">
                                            <i class="bi bi-list-columns-reverse me-2"></i>Section Registration


                                        </a>
                                    </li>
                                    <li class="nav-item mt-2">
                                        <a class="nav-link active" href="index.php?page=register_student">
                                            <i class="bi bi-journal-check me-2"></i>Subject Registration

                                        </a>
                                    </li>

                                </ul>
                            </li> -->

                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=section_handled">
                                    <i class="bi bi-buildings me-2"></i>Section Handled
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=teacher_subject">
                                    <i class="bi bi-journal-bookmark-fill me-2"></i>Subjects Handled
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=teacher_module">
                                    <i class="bi bi-book me-2"></i></i>Module
                                </a>
                            </li>

                            <!-- THISI IS THE ROUTE OF QUIZ -->
                            <li class="nav-item">
                                <a class="nav-link  text-white" href="#assessmentMenu" data-bs-toggle="collapse" aria-expanded="false" id="examDropdown">
                                    <i class="bi bi-card-heading me-2"></i>Assessment <i class="bi bi-chevron-down" style="margin-left: 55px;" id="assessmentIcon"></i>
                                </a>
                                <ul class="collapse list-unstyled ps-1" id="assessmentMenu">
                                    <li class="nav-item mt-2">
                                        <a class="nav-link active" href="index.php?page=teacher_quiz">
                                            <i class="bi  bi-lightbulb me-2"></i>Quiz
                                        </a>
                                    </li>
                                    <li class="nav-item mt-2">
                                        <a class="nav-link active" href="index.php?page=teacher_exam">
                                            <i class="bi bi-book me-2"></i>Exam
                                        </a>
                                    </li>
                                </ul>
                            </li>




                            <!-- 
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=teacher_quiz">
                                    <i class="bi bi-lightbulb me-2"></i>Quiz
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=teacher_exam">
                                    <i class="bi bi-book me-2"></i></i>Exam
                                </a>
                            </li> -->


                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=teacher_report">
                                    <i class="bi bi-bar-chart me-2"></i>Reports
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
                    <h5 class="mb-5">Are you sure you want to logout?</h5>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-center mt-5 mb-3 rounded-bottom-4">
                        <button class="btn btn-outline-secondary px-4 py-2 me-3" style="width: 120px; margin-top: 20px;" data-bs-dismiss="modal">Cancel</button>
                        <a href="../logout.php" class="btn btn-danger px-4 py-2" style="width: 120px; margin-top: 20px;">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- THIS IS SIDE BAR SCRIPT TO SHOW TOOGGLE UP AND DOWN  -->
    <script>
        // Add event listener to toggle the icon when dropdown is shown/hidden
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
            toggleCollapseIcon('assessmentMenu', 'assessmentIcon');
        });
    </script>