<?php

// Database credentials
$host = 'localhost';
$dbname = 'lms_db';
$username = 'root';
$password = 'Nicolas051002';

// Establish the database connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Function to get the logged-in teacher's info
function getLoggedInTeacher($conn, $teacherId)
{
    $sql = "SELECT teacher_fname, teacher_lname FROM teacher WHERE teacher_id = :teacher_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['teacher_id' => $teacherId]);

    return $stmt->fetch();
}

// Check if the teacher is logged in
if (isset($_SESSION['teacher_id'])) {
    // Get the latest teacher info from the database
    $teacherInfo = getLoggedInTeacher($conn, $_SESSION['teacher_id']);

    // Update session variables with the latest data
    $_SESSION['teacher_fname'] = $teacherInfo['teacher_fname'];
    $_SESSION['teacher_lname'] = $teacherInfo['teacher_lname'];
} else {
    echo "Teacher not logged in.";
    exit();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>

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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Sidebar Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>



            <!-- Desktop LMS Title (Left-aligned on large screens) -->
            <div class="navbar-brand text-black d-none d-lg-block">
                Learning Management System
            </div>

            <!-- Mobile LMS Title (Centered on mobile screens, hidden on larger screens) -->
            <div class="navbar-brand text-black mx-auto text-center d-block d-lg-none fs-6">
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
                            <small>(<?php echo ucwords(strtolower($_SESSION["user_role"])); ?>)</small>
                            <i class="bi bi-person-circle ms-1 small-icon" style="font-size: 1.3rem;"></i>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li class="ms-3"><i class="bi bi-patch-check-fill text-success"></i> <?php echo ucwords(strtolower($_SESSION["user_role"])) ?> </li>
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
            <div class="row mt-3">
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
                            <li class="nav-item d-none d-md-block mt-4">
                                <a class="nav-link active">
                                    <!-- <i class="bi bi-graph-up-arrow me-2"></i> Blanktext -->
                                </a>
                            </li>

                            <li class="nav-item mt-2">
                                <a class="nav-link active" href="index.php?page=dashboard">
                                    <i class="bi bi-graph-up-arrow me-2"></i> Dashboard
                                </a>
                            </li>

                            <!-- THIS IS DROP DOWN SELECT IN SIDE BAR  -->
                            <li class="nav-item">
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
                            </li>


                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=section_handled">
                                    <i class="bi bi-buildings me-1"></i>Section Handled
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=teacher_quiz">
                                    <i class="bi bi-lightbulb me-2"></i>Quiz
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=teacher_exam">
                                    <i class="bi bi-book me-2"></i></i>Exam
                                </a>
                            </li>

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
    <!-- THIS IS SIDE BAR SCRIPT TO SHOW TOOGGLE UP AND DOWN  -->
    <script>
        // Add event listener to toggle the icon when dropdown is shown/hidden
        document.addEventListener('DOMContentLoaded', function() {
            const studentMenu = document.getElementById('studentMenu');
            const studentIcon = document.getElementById('studentIcon');

            studentMenu.addEventListener('show.bs.collapse', function() {
                studentIcon.classList.remove('bi-chevron-down'); // Original icon
                studentIcon.classList.add('bi-chevron-up'); // Change to up icon
            });

            studentMenu.addEventListener('hide.bs.collapse', function() {
                studentIcon.classList.remove('bi-chevron-up'); // Remove up icon
                studentIcon.classList.add('bi-chevron-down'); // Change back to original icon
            });
        });
    </script>