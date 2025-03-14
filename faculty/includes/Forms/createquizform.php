<!-- STUDENT INFORMATION ENTRY MODAL -->
<div class="modal fade" id="create_quiz" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content b-grey">
            <div class="modal-body">
                <h4 class="fw-bold">Quiz Details</h4>

                <form id="createQuizForm" action="./includes/quiz-inc.php" method="POST" autocomplete="off" class="row g-2 needs-validation" novalidate>

                    <!-- Hidden Inputs -->
                    <input type="hidden" name="schedID" value="<?php echo htmlspecialchars($_GET['sched_id']); ?>">
                    <input type="hidden" name="subID" value="<?php echo htmlspecialchars($_GET['sub_code']); ?>">
                    <input type="hidden" name="secID" value="<?php echo htmlspecialchars($_GET['section_code']); ?>">

                    <!-- Exam Quiz -->
                    <div class="mb-2">
                        <label for="quizTitle" class="form-label fw-bold">Quiz Title</label>
                        <input type="text" id="quizTitle" name="quiz_title" class="form-control" placeholder="Enter the quiz title" required>
                    </div>

                    <!-- Quarterly Quiz Type -->
                    <div class="col-6 mb-3">
                        <label for="quarterQuiz" class="form-label fw-bold">Quarterly Quiz</label>
                        <select id="quarterQuiz" name="quiz_quarter" class="form-select" required>
                            <option value="" selected disabled>Select a quarter...</option>
                            <option value="1st Quarter">1st Quarter</option>
                            <option value="2nd Quarter">2nd Quarter</option>
                            <option value="3rd Quarter">3rd Quarter</option>
                            <option value="4th Quarter">4th Quarter</option>
                        </select>
                    </div>

                    <!-- Quiz Type -->
                    <div class="col-6 mb-3">
                        <label for="typeQuiz" class="form-label fw-bold">Type of Quiz</label>
                        <select id="typeQuiz" name="types" class="form-select" required>
                            <option value="" selected disabled>Select a type...</option>
                            <option value="0">Short Quiz</option>
                            <option value="1">Long Quiz</option>
                        </select>
                    </div>

                    <!-- Exam Date & Duration -->

                    <div class="col-6">
                        <label for="quizDate" class="form-label fw-bold">Date</label>
                        <input type="date" id="quizDate" name="quiz_date" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label for="quizDuration" class="form-label fw-bold">Duration (minutes)</label>
                        <input type="number" id="quizDuration" name="quiz_duration" class="form-control" placeholder="Enter duration" min="1" oninput="checkNegativeValue(this)" required>
                    </div>

                    <hr>

                    <!-- Exam Questions -->
                    <div id="questionsQuizArea"></div>
                    <div class="d-flex justify-content-end">
                        <button type="button" id="addQuestionButton" class="btn btn-success mb-3 rounded-pill">
                            <i class="bi bi-plus-circle"></i> Add Question
                        </button>
                    </div>
                    <hr>

                    <!-- Create Exam Button -->
                    <div class="text-end">
                        <button name="submit" type="submit" class="btn btn-primary">
                            Create Quiz
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="resetFormQuiz()">Cancel</button>
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
        updateButtonLabel();
    });

    function addQuestion() {
        // Reuse an available index if one is available, else increment the questionCounter
        let questionIndex = availableIndexes.length > 0 ? availableIndexes.shift() : ++questionCounter;
        let questionHtml = `
        <div class="question-item mb-4 p-3 border rounded" id="question${questionIndex}">
            <div class="row align-items-center">
                <div class="col-md-4">
                                <label class="form-label fw-bold">${questionIndex}. Question</label>

                    <select class="form-select question-type" name="quiz_type[${questionIndex}]" required onchange="updateQuestionType(${questionIndex})">
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

                <input type="text" name="quiz_question[${questionIndex}]" class="form-control mb-2" placeholder="Enter the question text" required>

                <div id="choicesContainer${questionIndex}">
                    <label class="form-label fw-bold">Choices <small class="text-danger"> ( Please select correct answer)</small></label>
                        <div class="d-flex align-items-center mb-2">
                            <input type="radio" name="quiz_correct_answer[${questionIndex}]" value="A" class="form-check-input" required>
                            <input type="text" name="choice_a[${questionIndex}]" class="form-control ms-2" placeholder="Enter choice A">
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="radio" name="quiz_correct_answer[${questionIndex}]" value="B" class="form-check-input" required>
                            <input type="text" name="choice_b[${questionIndex}]" class="form-control ms-2" placeholder="Enter choice B">
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="radio" name="quiz_correct_answer[${questionIndex}]" value="C" class="form-check-input" required>
                            <input type="text" name="choice_c[${questionIndex}]" class="form-control ms-2" placeholder="Enter choice C">
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="radio" name="quiz_correct_answer[${questionIndex}]" value="D" class="form-check-input" required>
                            <input type="text" name="choice_d[${questionIndex}]" class="form-control ms-2" placeholder="Enter choice D">
                        </div>
                                                                                
                </div>
            </div>
        </div>`;

        document.getElementById('questionsQuizArea').insertAdjacentHTML('beforeend', questionHtml);
        updateQuestionNumbers(); // Recalculate question numbers
    }

    function updateQuestionType(questionIndex) {
        let type = document.querySelector(`[name="quiz_type[${questionIndex}]"]`).value;
        let container = document.getElementById(`questionContent${questionIndex}`);

        if (type === "1") {
            // Multiple Choice
            container.innerHTML = `
                <input type="text" name="quiz_question[${questionIndex}]" class="form-control mb-2" placeholder="Enter the question text" required>
                <label class="form-label fw-bold">Choices <small class="text-danger"> ( Please select correct answer)</small></label>
                    <div class="d-flex align-items-center mb-2">
                        <input type="radio" name="quiz_correct_answer[${questionIndex}]" value="A" class="form-check-input" required>
                        <input type="text" name="choice_a[${questionIndex}]" class="form-control ms-2" placeholder="Enter choice A">
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <input type="radio" name="quiz_correct_answer[${questionIndex}]" value="B" class="form-check-input" required>
                        <input type="text" name="choice_b[${questionIndex}]" class="form-control ms-2" placeholder="Enter choice B">
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <input type="radio" name="quiz_correct_answer[${questionIndex}]" value="C" class="form-check-input" required>
                        <input type="text" name="choice_c[${questionIndex}]" class="form-control ms-2" placeholder="Enter choice C">
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <input type="radio" name="quiz_correct_answer[${questionIndex}]" value="D" class="form-check-input" required>
                        <input type="text" name="choice_d[${questionIndex}]" class="form-control ms-2" placeholder="Enter choice D">
                    </div>
  
            `;
        } else if (type === "2") {
            // Enumeration
            container.innerHTML = `
                <input type="text" name="quiz_enumeration_question[${questionIndex}]" class="form-control mb-2" placeholder="Enter the question text" required>
                <textarea name="quiz_enumeration_answers[${questionIndex}]" class="form-control" rows="3" placeholder="Enter expected answers separated by commas"></textarea>
 

            `;
        } else if (type === "3") {
            // Essay
            container.innerHTML = `
                <textarea name="quiz_essay_question[${questionIndex}]" class="form-control" rows="4" placeholder="Enter the essay question" required></textarea>
            `;
        } else if (type === "4") {
            // True/False
            container.innerHTML = `
                 <input type="text" name="quiz_tf_question[${questionIndex}]" class="form-control mb-2" placeholder="Enter the question text" required>
                 <label class="text-success">Please select the correct answer</label>
                 <select name="quiz_correct_answer[${questionIndex}]" class="form-select">
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
            updateButtonLabel();
        }
    }

    function updateQuestionNumbers() {
        let questions = document.querySelectorAll('.question-item');
        questions.forEach((question, index) => {
            let questionNumber = index + 1;
            question.querySelector('.form-label.fw-bold').innerText = `${questionNumber}. Question`;
        });
    }

    function updateButtonLabel() {
        let button = document.getElementById("addQuestionButton");
        let questionCount = document.querySelectorAll('.question-item').length;
        button.innerHTML = `<i class="bi bi-plus-circle"></i> ${questionCount >= 1 ? 'Add Another Question' : 'Add Question'}`;
    }

    // Function to clear the form
    function resetFormQuiz() {
        // Get the form element by ID
        const form = document.getElementById('createQuizForm');

        if (form) {
            // Reset the form values and validation state
            form.reset();
            form.classList.remove('was-validated');

            // Clear dynamically added questions
            const questionsQuizArea = document.getElementById('questionsQuizArea');
            if (questionsQuizArea) {
                questionsQuizArea.innerHTML = ''; // Remove all added question elements
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