<!-- STUDENT INFORMATION ENTRY MODAL -->
<div class="modal fade" id="create_exam" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content b-grey">
            <div class="modal-body">
                <h4 class="fw-bold">Exam Details</h4>

                <form id="createExamForm" action="./includes/exam-inc.php" method="POST" autocomplete="off" class="row g-2 needs-validation" novalidate>

                    <!-- Hidden Inputs -->
                    <input type="hidden" name="schedID" value="<?php echo htmlspecialchars($_GET['sched_id']); ?>">
                    <input type="hidden" name="subID" value="<?php echo htmlspecialchars($_GET['sub_code']); ?>">
                    <input type="hidden" name="secID" value="<?php echo htmlspecialchars($_GET['section_code']); ?>">

                    <!-- Exam Title  -->
                    <div class="mb-2">
                        <label for="examTitle" class="form-label fw-bold">Exam Title</label>
                        <input type="text" id="examTitle" name="exam_title" class="form-control" placeholder="Enter the exam title" required>
                    </div>

                    <!-- Quarterly Exam Type -->
                    <div class=" mb-4">
                        <label for="quarterExam" class="form-label fw-bold">Quarterly Exam</label>
                        <select id="quarterExam" name="exam_quarter" class="form-select" required>
                            <option value="" selected disabled>Select a quarter...</option>
                            <option value="1st Quarter">1st Quarter</option>
                            <option value="2nd Quarter">2nd Quarter</option>
                            <option value="3rd Quarter">3rd Quarter</option>
                            <option value="4th Quarter">4th Quarter</option>
                        </select>
                    </div>

                    <!-- Exam Date & Duration -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="examDate" class="form-label fw-bold">Exam Date</label>
                            <input type="date" id="examDate" name="exam_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="examDuration" class="form-label fw-bold">Duration (minutes)</label>
                            <input type="number" id="examDuration" name="exam_duration" class="form-control" placeholder="Enter duration" min="1" oninput="checkNegativeValue(this)" required>
                        </div>
                    </div>

                    <hr>

                    <!-- Exam Questions -->
                    <div id="questionsArea"></div>

                    <button type="button" id="addQuestionButton" class="btn btn-success mb-4">
                        <i class="bi bi-plus-circle"></i> Add Another Question
                    </button>

                    <hr>

                    <!-- Create Exam Button -->
                    <div class="text-end">
                        <button name="submit" type="submit" class="btn btn-primary">
                            Create Exam
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="resetFormUpload()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let questionCounter = 0;
    let availableIndexes = []; // Stores removed question indexes for reuse

    document.getElementById("addQuestionButton").addEventListener("click", function() {
        addQuestion();
    });

    function addQuestion() {
        // Reuse an available index if one is available, else increment the questionCounter
        let questionIndex = availableIndexes.length > 0 ? availableIndexes.shift() : ++questionCounter;
        let questionHtml = `
        <div class="question-item mb-4 p-3 border rounded" id="question${questionIndex}">
            <div class="row align-items-center">
                <div class="col-md-4">
                                <label class="form-label fw-bold">${questionIndex}. Question</label>

                    <select class="form-select question-type" name="exam_type[${questionIndex}]" required onchange="updateQuestionType(${questionIndex})">
                        <option value="1" >Multiple Choice</option>
                        <option value="2" >Enumeration</option>
                        <option value="3" >Essay</option>
                        <option value="4" >True/False</option>
                    </select>
                </div>
                <div class="col-md-1 text-end">
                    <button type="button" class="btn btn-danger mt-4 remove-question" onclick="removeQuestion(${questionIndex})">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>

            <div class="question-content mt-3" id="questionContent${questionIndex}">
                <!-- Default: Multiple Choice -->

                <input type="text" name="exam_question[${questionIndex}]" class="form-control mb-2" placeholder="Enter the question text" required>

                <div id="choicesContainer${questionIndex}">
                    <label class="form-label fw-bold">Choices</label>
                        <div class="d-flex align-items-center mb-2">
                            <input type="radio" name="correct_answer[${questionIndex}]" value="A" class="form-check-input" required>
                            <input type="text" name="choice_a[${questionIndex}]" class="form-control ms-2" placeholder="Enter choice A" required>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="radio" name="correct_answer[${questionIndex}]" value="B" class="form-check-input" required>
                            <input type="text" name="choice_b[${questionIndex}]" class="form-control ms-2" placeholder="Enter choice B" required>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="radio" name="correct_answer[${questionIndex}]" value="C" class="form-check-input" required>
                            <input type="text" name="choice_c[${questionIndex}]" class="form-control ms-2" placeholder="Enter choice C" required>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="radio" name="correct_answer[${questionIndex}]" value="D" class="form-check-input" required>
                            <input type="text" name="choice_d[${questionIndex}]" class="form-control ms-2" placeholder="Enter choice D" required>
                        </div>
                        
                    
                    
                    
                </div>
            </div>
        </div>`;

        document.getElementById('questionsArea').insertAdjacentHTML('beforeend', questionHtml);
        updateQuestionNumbers(); // Recalculate question numbers
    }

    function updateQuestionType(questionIndex) {
        let type = document.querySelector(`[name="exam_type[${questionIndex}]"]`).value;
        let container = document.getElementById(`questionContent${questionIndex}`);

        if (type === "1") {
            // Multiple Choice
            container.innerHTML = `
                <input type="text" name="exam_question[${questionIndex}]" class="form-control mb-2" placeholder="Enter the question text" required>
                <label class="form-label fw-bold">Choices</label>
                    <div class="d-flex align-items-center mb-2">
                        <input type="radio" name="correct_answer[${questionIndex}]" value="A" class="form-check-input" required>
                        <input type="text" name="choice_a[${questionIndex}]" class="form-control ms-2" placeholder="Enter choice A" required>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <input type="radio" name="correct_answer[${questionIndex}]" value="B" class="form-check-input" required>
                        <input type="text" name="choice_b[${questionIndex}]" class="form-control ms-2" placeholder="Enter choice B" required>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <input type="radio" name="correct_answer[${questionIndex}]" value="C" class="form-check-input" required>
                        <input type="text" name="choice_c[${questionIndex}]" class="form-control ms-2" placeholder="Enter choice C" required>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <input type="radio" name="correct_answer[${questionIndex}]" value="D" class="form-check-input" required>
                        <input type="text" name="choice_d[${questionIndex}]" class="form-control ms-2" placeholder="Enter choice D" required>
                    </div>
  
            `;
        } else if (type === "2") {
            // Enumeration
            container.innerHTML = `
                <input type="text" name="enumeration_question[${questionIndex}]" class="form-control mb-2" placeholder="Enter the question text" required>
                <textarea name="enumeration_answers[${questionIndex}]" class="form-control" rows="3" placeholder="Enter expected answers separated by commas"  required></textarea>
            `;
        } else if (type === "3") {
            // Essay
            container.innerHTML = `
                <textarea name="essay_question[${questionIndex}]" class="form-control" rows="4" placeholder="Enter the essay question" required></textarea>
            `;
        } else if (type === "4") {
            // True/False
            container.innerHTML = `
                 <input type="text" name="tf_question[${questionIndex}]" class="form-control mb-2" placeholder="Enter the question text" required>
                <select name="correct_answer[${questionIndex}]" class="form-select">
                    <option value="True">True</option>
                    <option value="False">False</option>
                </select>
            `;
        }
    }

    function removeQuestion(questionIndex) {
        let questionElement = document.getElementById(`question${questionIndex}`);
        if (questionElement) {
            questionElement.remove();
            availableIndexes.push(questionIndex); // Store removed index for reuse
            updateQuestionNumbers(); // Recalculate question numbers
        }
    }

    function updateQuestionNumbers() {
        let questions = document.querySelectorAll('.question-item');
        questions.forEach((question, index) => {
            let questionNumber = index + 1;
            question.querySelector('.form-label.fw-bold').innerText = `${questionNumber}. Question`;
        });
    }

    // Function to clear the form
    function resetFormUpload() {
        // Get the form element by ID
        const form = document.getElementById('createExamForm');

        if (form) {
            // Reset the form values and validation state
            form.reset();
            form.classList.remove('was-validated');

            // Clear dynamically added questions
            const questionsArea = document.getElementById('questionsArea');
            if (questionsArea) {
                questionsArea.innerHTML = ''; // Remove all added question elements
            }

            // Reset indexes and counters used for dynamically added questions
            availableIndexes = [];
            questionCounter = 0;

            // Clear custom validity messages for all inputs, textareas, and selects
            const inputs = form.querySelectorAll('input, textarea, select');
            inputs.forEach((input) => {
                input.setCustomValidity('');
                input.classList.remove('is-valid', 'is-invalid'); // Reset validation styles
            });

            // Optionally, provide feedback in the console or UI
            console.log('Form has been successfully reset.');
        } else {
            console.error('Form not found. Please check the form ID.');
        }
    }


    function checkNegativeValue(input) {
        if (input.value < 1) {
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
        } else {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        }
    }
</script>