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