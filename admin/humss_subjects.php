<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['registrar_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>

<?php
include "../includes/dbh-inc.php";

?>


<!-- TABLE -->
<style>
    body {
        background-color: #f8f9fa;
        /* Light gray for a clean UI */
    }

    .navbar-brand {
        color: #ffffff;
        font-weight: bold;
        font-size: 1.5rem;
    }

    .navbar-brand:hover {
        color: #d4d4d4;
    }

    .hero-section {
        padding: 50px 15px;
        text-align: center;
    }

    .hero-section h1 {
        margin-bottom: 30px;
        font-size: 2rem;
        color: #333;
    }



    footer {
        margin-top: 50px;
        padding: 15px;
        text-align: center;
        background-color: #f8f9fa;
        color: #6c757d;
    }


    /* Global Styles */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .card i {
        font-size: 1.5rem;
        /* Smaller icons */
    }

    .btn {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn:hover {
        transform: scale(1.05);
    }

    .text-muted {
        font-size: 0.85rem;
        /* Slightly smaller text */
    }

    .fs-4 {
        font-size: 1.5rem !important;
        /* Consistent number size */
    }

    /* Responsive Padding */
    @media (max-width: 576px) {
        .card-body {
            padding: 1rem !important;
        }
    }
</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">




    <!-- Navbar -->
    <nav class="navbar-expand-lg mb-3">
        <div class="container">
            <div class="navbar-brand text-dark">Humanities and Social Sciences </div>
        </div>
    </nav>




    <div class="container ">
        <div class="row g-4">


            <!-- GRADE 11 Card -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card shadow-lg border-0 h-100 rounded-4">
                    <div class="card-body text-center d-flex flex-column p-4">
                        <span class="bi bi-journals text-danger display-5 mb-3"></span>
                        <h5 class="fw-bold text-dark">GRADE-11 | HUMSS</h5>
                        <p class="text-muted small mb-3">View subjects of grade 11 humss.</p>
                        <p class="fs-4 text-danger fw-bold mb-4">

                        </p>
                        <a href="?page=humss_subject_g11" class="btn btn-outline-danger mt-auto rounded-pill fw-semibold">
                            <i class="bi bi-person-rolodex me-1"></i>Subjects
                        </a>
                    </div>
                </div>
            </div>

            <!-- GRADE 12 Card -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card shadow-lg border-0 h-100 rounded-4">
                    <div class="card-body text-center d-flex flex-column p-4">
                        <span class="bi bi-journals text-danger display-5 mb-3"></span>
                        <h5 class="fw-bold text-dark">GRADE-12 | HUMSS</h5>
                        <p class="text-muted small mb-3">View subjects of grade 12 humss.</p>
                        <p class="fs-4 text-danger fw-bold mb-4">

                        </p>
                        <a href="?page=humss_subject_g12" class="btn btn-outline-danger mt-auto rounded-pill fw-semibold">
                            <i class="bi bi-person-rolodex me-1"></i>Subjects
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Footer -->
    <footer>
        <p class="mt-5">&copy; 2024 Computer Systems Institute | All Rights Reserved</p>
    </footer>



</main>