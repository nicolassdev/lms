<?php
include "../includes/dbh-inc.php";
?>

<!-- FORM MODAL ADD TEACHER  -->
<?php
include "../admin/includes/forms/studentform.php";
?>





<!-- TABLE -->

<div class="mt-5">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-5 ms-3 me-3">
            <h3 class="text-black">List of Student</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#student" data-bs-whatever="@fat">
                <i class="bi bi-person-plus-fill me-1"></i>Student
            </button>
        </div>


        <div class="table-responsive small ms-3 me-3">
            <table class="table table-bordered table-striped table-sm align-middle">
                <thead class="table-dark text-light">
                    <tr>
                        <th scope="col">LRN</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Initial</th>
                        <th scope="col">Surname</th>
                        <th scope="col">Address</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Email</th>
                        <th scope="col">Birdthday</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>23920178192010</td>
                        <td>Anthony</td>
                        <td>Dado</td>
                        <td>Daen</td>
                        <td>Buraguis</td>
                        <td>0923923920</td>
                        <td>Male</td>
                        <td>anthondaen25@gmail.com</td>
                        <td>2002-10-02</td>
                        <td>Enrolled</td>

                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square"></i></button>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>