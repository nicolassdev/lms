<?php
// Database credentials
$host = 'localhost';
$dbname = 'lms_db';
$username = 'root';
$password = '';


// Establish the database connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Function to get user information from the database
function getAdminInfo($conn)
{
    $sql = "SELECT * FROM registrar";  // SQL query to get all users
    $stmt = $conn->query($sql);  // Execute the query
    return $stmt ? $stmt->fetchAll() : [];  // Return fetched data or an empty array
}

// Fetch user information
$users = getAdminInfo($conn);

// Display the users' full names
foreach ($users as $user) {
    $fullName = ucwords(strtolower($user['firstname'] . ' ' . $user['lastname']));
    // echo "<p>$fullName</p>";
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Management System</title>
    <!-- <link href="../css/bootstrap-icons.min.css" rel="stylesheet"> -->
    <!-- Bootstrap Icons -->
    <!-- <link href="../css/bootstrap-icons.css" rel="stylesheet"> -->
    <link rel="icon" type="webp" href="../assets/img/csi.webp">

    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css?v=<?php echo time(); ?>" />

    <!-- this is material icon  -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"> -->

    <!-- SET THE ICON  -->


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

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


            <!-- Profile Dropdown (Visible on all screen sizes) -->
            <div class="dropdown d-none d-lg-block ms-auto">
                <a href="#" class="d-flex align-items-center text-decoration-none" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- Username and Icon Inline -->
                    <span class="text-white me-1 mt-2" style="font-weight: 400;">
                        <?php
                        echo ucwords(strtolower($fullName));
                        ?>
                    </span>
                    <i class="bi bi-person-fill-gear text-white" style="font-size: 1.5rem;"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li class="ms-3">
                        <i class="bi bi-patch-check-fill text-success"></i>
                        <?php echo ucwords(strtolower($_SESSION["user_role"])) ?>
                    </li>
                    <hr class="mx-3 my-1">
                    <li><a class="dropdown-item" href="?page=admin">My Profile</a></li>
                    <li><a class="dropdown-item" href="?page=settings">Settings</a></li>
                    <li>
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
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
                <nav id="sidebar" class="col-md-3 bg-dark sidebar offcanvas-md offcanvas-start" style="max-width: 230px;">
                    <div class="position-sticky text-white ">

                        <div class="text-white ms-4 d-lg-none">
                            <?php
                            echo ucwords(strtolower($fullName));
                            echo '<i class="bi bi-person-circle ms-3 fs-2"></i>';
                            ?>
                        </div>
                        <hr class=" d-lg-none">


                        <ul class="nav flex-column ">
                            <div class="nav-link fw-bold dasboard d-none d-lg-inline mb-3">
                                DASHBOARD
                            </div>
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


                            <!-- THIS IS STUDENT DROP DOWN SELECT IN SIDE BAR  -->
                            <li class="nav-item">
                                <a class="nav-link  text-white" href="#studentMenu" data-bs-toggle="collapse" aria-expanded="false" id="studentDropdown">
                                    <i class="bi  bi-people me-1"></i>Student Management <i class="bi bi-chevron-down" style="margin-left: 1px;" id="studentIcon"></i>
                                </a>
                                <ul class="collapse list-unstyled ps-1" id="studentMenu">
                                    <li class="nav-item mt-2">
                                        <a class="nav-link active" href="index.php?page=student">

                                            <i class="bi bi-plus-circle me-2"></i>New Student
                                        </a>
                                    </li>
                                    <li class="nav-item mt-2">
                                        <a class="nav-link active" href="index.php?page=student_accounts">
                                            <i class="bi bi-database-fill me-2"></i>Student Accounts
                                        </a>
                                    </li>
                                    <li class="nav-item mt-2">
                                        <a class="nav-link active" href="index.php?page=enrolled">
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

                            <!-- THIS IS FACULTY DROP DOWN SELECT IN SIDE BAR  -->
                            <li class="nav-item">
                                <a class="nav-link  text-white" href="#facultyMenu" data-bs-toggle="collapse" aria-expanded="false" id="studentDropdown">
                                    <i class="bi bi-person-video3 me-1"></i>Faculty Management <i class="bi bi-chevron-down" style="margin-left: 5px;" id="facultyIcon"></i>
                                </a>
                                <ul class="collapse list-unstyled ps-1" id="facultyMenu">
                                    <li class="nav-item mt-2">
                                        <a class="nav-link active" href="index.php?page=teacher">

                                            <i class="bi bi-plus-circle me-2"></i>New Faculty
                                        </a>
                                    </li>
                                    <li class="nav-item mt-2">
                                        <a class="nav-link active" href="index.php?page=teacher_accounts">
                                            <i class="bi bi-database-fill me-2"></i>Faculty Accounts
                                        </a>
                                    </li>
                                    <li class="nav-item mt-2">
                                        <a class="nav-link active" href="index.php?page=section">
                                            <i class="bi bi-building-fill-add me-2"></i>Section
                                        </a>
                                    </li>
                                    <li class="nav-item mt-2">
                                        <a class="nav-link active" href="index.php?page=subject">
                                            <i class="bi bi-journal-bookmark me-2"></i>Subject
                                        </a>
                                    </li>

                                </ul>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=principal">
                                    <i class="bi bi-person me-1"></i>Principal
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?page=strand">
                                    <i class="bi bi-mortarboard me-1"></i>Strand
                                </a>
                            </li>


                            <!-- Dropdown for STRAND Subject -->

                            <li class="nav-item mt-2">
                                <a class="nav-link text-white" href="#strandSubjectMenu" data-bs-toggle="collapse" aria-expanded="false" id="strandDropdown">
                                    <i class="bi bi-journals me-1"></i> Strand Subject
                                    <i class="bi bi-chevron-down" style="margin-left: 10px;" id="strandIcon"></i>
                                </a>
                                <ul class="collapse list-unstyled ps-3" id="strandSubjectMenu">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="index.php?page=stem_subjects">STEM</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="index.php?page=abm_subjects">ABM</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="index.php?page=humss_subjects">HUMSS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="index.php?page=gas_subjects">GAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="index.php?page=css_subjects">CSS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="index.php?page=cp_subjects">CP</a>
                                    </li>
                                </ul>

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





    <!-- JavaScript to toggle icons using Bootstrap collapse events -->
    <script>
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



        document.addEventListener('DOMContentLoaded', function() {
            const facultyMenu = document.getElementById('facultyMenu');
            const facultyIcon = document.getElementById('facultyIcon');

            facultyMenu.addEventListener('show.bs.collapse', function() {
                facultyIcon.classList.remove('bi-chevron-down'); // Original icon
                facultyIcon.classList.add('bi-chevron-up'); // Change to up icon
            });

            facultyMenu.addEventListener('hide.bs.collapse', function() {
                facultyIcon.classList.remove('bi-chevron-up'); // Remove up icon
                facultyIcon.classList.add('bi-chevron-down'); // Change back to original icon
            });
        });


        document.addEventListener("DOMContentLoaded", function() {

            const strandIcon = document.getElementById("strandIcon");

            // Immediate icon toggle on click

            document.getElementById("strandDropdown").addEventListener("click", function() {
                toggleIcon(strandIcon);
            });

            // Confirm final state based on collapse event


            document.getElementById("strandSubjectMenu").addEventListener("shown.bs.collapse", function() {
                strandIcon.className = "bi bi-chevron-up";
            });
            document.getElementById("strandSubjectMenu").addEventListener("hidden.bs.collapse", function() {
                strandIcon.className = "bi bi-chevron-down";
            });

            // Function to toggle icon immediately
            function toggleIcon(icon) {
                if (icon.classList.contains("bi-chevron-down")) {
                    icon.className = "bi bi-chevron-up";
                } else {
                    icon.className = "bi bi-chevron-down";
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>