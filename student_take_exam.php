<main class="col-md-12 ms-sm-auto col-lg-10">
    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <!-- Exam Header Section -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body text-center">
                        <h1 class="card-title fw-bold">Take Your Exam</h1>
                        <p class="card-text text-muted">Ensure you're ready and have the necessary materials before starting the exam.</p>
                        <button class="btn btn-primary btn-lg px-5" id="startExamButton">
                            <i class="bi bi-play-circle me-2"></i> Start Exam
                        </button>
                    </div>
                </div>

                <!-- Exam Instructions Section -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h4 class="fw-bold">Exam Instructions</h4>
                        <ul class="list-group">
                            <li class="list-group-item"><i class="bi bi-check-circle text-success me-2"></i> This exam consists of 50 multiple-choice questions.</li>
                            <li class="list-group-item"><i class="bi bi-check-circle text-success me-2"></i> You will have 60 minutes to complete the exam.</li>
                            <li class="list-group-item"><i class="bi bi-check-circle text-success me-2"></i> Once the exam starts, do not refresh or close the browser.</li>
                            <li class="list-group-item"><i class="bi bi-check-circle text-success me-2"></i> Submit your answers before the timer ends.</li>
                        </ul>
                    </div>
                </div>

                <!-- Timer and Start Section -->
                <div id="examArea" class="d-none">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <h5 class="fw-bold">Question Area</h5>
                                    <p>Your questions will appear here once the exam starts.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body text-center">
                                    <h4 class="fw-bold">Timer</h4>
                                    <div id="examTimer" class="display-5 text-danger">60:00</div>
                                    <p class="text-muted">Time remaining</p>
                                    <button class="btn btn-danger mt-2">End Exam</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Exam End Notification -->
                <div id="examEndNotification" class="d-none text-center my-5">
                    <h2 class="fw-bold text-success">Congratulations!</h2>
                    <p class="text-muted">You have successfully completed the exam.</p>
                    <a href="?page=examResults" class="btn btn-outline-success">
                        <i class="bi bi-clipboard-data me-2"></i> View Results
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.getElementById('startExamButton').addEventListener('click', function() {
        // Hide the header and instructions sections
        this.closest('.card').style.display = 'none';
        document.querySelector('.card.mb-4.shadow-sm:nth-child(2)').style.display = 'none';

        // Show the exam area
        document.getElementById('examArea').classList.remove('d-none');
    });
</script>