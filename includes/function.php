<?php
class myDataBase
{
    private $hostname;         // localhost
    private $username;         // root
    private $password;         // null
    private $database;         // lms_db
    public $con;




    // CONSTRUCTOR FOR MY DATABASE OBJECT
    public function __construct($hostname, $username, $password, $database)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    // DATABASE CONNECTION FUNCTION
    public function connection()
    {
        try {
            if (!$this->con) {
                $this->con = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
                if ($this->con) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } catch (mysqli_sql_exception $e) {
            echo $e;
        }
    }

    //  DATABASE DISCONNECTION FUNCTION
    public function disconnect()
    {
        if ($this->con) {
            if (mysqli_close($this->con)) {
                $this->con = false;
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }


    // ENCRPYT PASSWORD
    public function encrypt($password)
    {
        $hash = sha1($password);
        return $hash;
    }



    //CHECK USER LOGIN 
    function checkLogin($username, $password)
    {
        // Escape the inputs to prevent SQL injection
        $username = mysqli_real_escape_string($this->con, $username);
        $password = mysqli_real_escape_string($this->con, $password);

        // Run a case-sensitive query by using the BINARY keyword
        $query = "SELECT * FROM `users` WHERE BINARY `username` = '$username' AND BINARY `password` = '$password'";
        $result = $this->con->query($query);

        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }


    // Function to set session data
    function setSessionData($data)
    {
        session_start();
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }



    //GENERIC RANDOM PRIMARY ID FOR TABLES
    public function generateID($prefix)
    {
        $num = "1325476980";
        $rand = $prefix;

        for ($i = 0; $i < 4; $i++) {
            $rand .= $num[rand(0, strlen($num) - 1)];
        }

        return $rand;
    }


    // GENERATE TEACHER ID 
    // FORMAT : LAST 2 DIGIT OF THE YEAR / DOB/ RANDOM 4 DIGIT
    public function generateTeacherID($dob)
    {
        $year = date('y'); // Get the last 2 digits of the current year
        // Ensure the input is a valid date
        if (!$dob) {
            throw new Exception("Invalid date of birth provided.");
        }

        // Extract the year, month, and day from the teacher's date of birth
        $dob = new DateTime($dob);
        $dobyear = $dob->format('y'); // Last 2 digits of the birth year
        $month = $dob->format('m'); // Month in MM format
        $day = $dob->format('d'); // Day in DD format

        // Generate a 4-digit random number
        $randomFourNumbers = rand(1000, 9999); // Ensures a 4-digit number

        // Construct the ID: <last-digit-of-year>-<MMDD>-<4-random-digits>
        $teacherID = "{$year}-{$day}{$dobyear}{$month}-{$randomFourNumbers}";

        return $teacherID;
    }

    /*GEENERATE FACULTY USERNAME  */
    public function generateFacultyUsername($dob)
    {
        // Ensure the input is a valid date
        if (!$dob) {
            throw new Exception("Invalid date of birth provided.");
        }

        // Extract the year, month, and day from the teacher's date of birth
        $dob = new DateTime($dob);
        $dobyear = $dob->format('y'); // Last 2 digits of the birth year
        $month = $dob->format('m'); // Month in MM format
        $day = $dob->format('d'); // Day in DD format

        // Generate a 4-digit random number
        $randomFourNum = rand(1000, 9999); // Ensures a 4-digit number
        // Construct the ID: csi <last-digit-of-year>-<MMDD>-
        $facultyUsername = "LMS-{$day}{$dobyear}{$month}-{$randomFourNum}";    //LMS-051002-2152

        return $facultyUsername;
    }

    /*GEENERATE PASSWORD  */
    public function generatePassword($dob)
    {
        $year = date('Y'); // Get the last 2 digits of the current year
        // Ensure the input is a valid date
        if (!$dob) {
            throw new Exception("Invalid date of birth provided.");
        }

        // Extract the year, month, and day from the teacher's date of birth
        $dob = new DateTime($dob);
        $dobyear = $dob->format('y'); // Last 2 digits of the birth year
        $month = $dob->format('m'); // Month in MM format
        $day = $dob->format('d'); // Day in DD format

        // Construct the ID: csi <last-digit-of-year>-<MMDD>-
        $studPassword = "CSI-{$year}-{$day}{$dobyear}{$month}";    //csi-2024-051002

        return $studPassword;
    }

    //GET SCHOOL INFORMATIONM
    public function getSchool()
    {
        $sql = "SELECT * FROM `school`";
        $stored = ($this->con->query($sql))->fetch_assoc();
        return $stored;
    }

    // // GET ADMIN INFORMATIONM
    // public function getAdminInfo()
    // {
    //     $sql = "SELECT * FROM `REGISTRAR`";
    //     $stored = ($this->con->query($sql))->fetch_assoc();
    //     return $stored;
    // }


    // Get information from a specified table PRINCIPAL | REGISTRAR
    public function getInfo($tableName)
    {
        // Sanitize table name to prevent SQL injection
        $allowedTables = ['registrar', 'principal'];
        if (!in_array($tableName, $allowedTables)) {
            throw new Exception("Invalid table name");
        }

        // Modified SQL to include an inner join with the 'users' table to get role information
        $sql = "
        SELECT 
            t.*, 
            u.role
        FROM `$tableName` t
        INNER JOIN `users` u ON u.id = t.id";

        // Execute the query and fetch the result
        $stored = ($this->con->query($sql))->fetch_assoc();

        return $stored;
    }


    //GET STUDENT INFORMATION BY INDIVIDUAL

    public function getStudentInfo($studentID)
    {
        $sql = "SELECT * FROM `student` WHERE stu_lrn = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $studentID);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    // Account getters
    public function getAccountUser($id)
    {
        $sql = "SELECT * FROM `users` WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }




    // public function getAdminInfo($teacher_id)
    // {
    //     $sql = "SELECT * FROM `teacher` WHERE teacher_id = ?";
    //     $stmt = $this->con->prepare($sql);
    //     $stmt->bind_param("s", $teacher_id);
    //     $stmt->execute();
    //     $result = $stmt->get_result()->fetch_assoc();
    //     return $result;
    // }


    public function getTeacherInfo($teacher_id)
    {
        $sql = "SELECT * FROM `teacher` WHERE teacher_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $teacher_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    // GET TEACHER'S SUBJECT SCHEDULE HANDLED BY ID
    public function getTeacherSubSchedule($teacher_id)
    {
        // Get the active semester
        $activeSemesters = $this->checkSemStatus('semester');

        // Check if there are any active semesters
        if (empty($activeSemesters)) {
            return []; // Return an empty array if no active semester
        }

        // Prepare the active semester condition
        $activeSemesterCondition = "sub.sub_semester IN ('" . implode("','", $activeSemesters) . "')";

        // Query to fetch subject schedule, section, and strand details based on teacher_id
        $sql = "
        SELECT 
            sch.sched_id,
            sch.sched_day,
            sch.sched_from,
            sch.sched_to,
            sec.section_code,
            sec.grade_lvl,
            sec.section_name,
            sub.sub_code,
            sub.sub_semester,
            sub.sub_title,
            st.strand_name,
            st.strand_desc
        FROM 
            `schedule` sch
        INNER JOIN 
            `section` sec 
        ON 
            sch.section_code = sec.section_code
        INNER JOIN 
            `subject` sub 
        ON 
            sch.sub_code = sub.sub_code
        LEFT JOIN 
            `strand` st 
        ON 
            sec.strand_code = st.strand_code
        WHERE 
            sch.teacher_id = ?
            AND $activeSemesterCondition
        ORDER BY
            sub.sub_title ASC
        ";

        // Prepare the SQL statement
        $stmt = $this->con->prepare($sql);

        // Bind the teacher ID parameter
        $stmt->bind_param("s", $teacher_id);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if any rows are returned
        if ($result->num_rows > 0) {
            // Fetch all matching rows
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data; // Return all rows as an array
        } else {
            return null; // No rows found
        }
    }


    // GET STUDENT'S SUBJECTS BY SECTION, GRADE LEVEL, STRAND, AND SCHEDULE
    public function getStudentSubjects($stu_lrn)
    {
        // Get the active semester
        $activeSemesters = $this->checkSemStatus('semester');

        // Check if there are any active semesters
        if (empty($activeSemesters)) {
            return []; // Return an empty array if no active semester
        }

        // Prepare the active semester condition
        $activeSemesterCondition = "sub.sub_semester IN ('" . implode("','", $activeSemesters) . "')";

        // First, get the grade level, strand, strand name, and section of the student
        $studentQuery = "
        SELECT 
            sec.grade_lvl,
            sec.strand_code,
            sec.section_code,  -- Added section_code
            st.strand_name
        FROM 
            enroll e
        INNER JOIN 
            section sec ON e.section_code = sec.section_code
        LEFT JOIN 
            strand st ON sec.strand_code = st.strand_code
        WHERE 
            e.stu_lrn = ?
            AND e.enroll_status = 'Enrolled'
        LIMIT 1";

        // Prepare and execute the student grade level/strand query
        $stmtStudent = $this->con->prepare($studentQuery);
        $stmtStudent->bind_param("s", $stu_lrn);
        $stmtStudent->execute();
        $resultStudent = $stmtStudent->get_result();

        // Check if we found grade level, strand, and section for the student
        if ($resultStudent->num_rows === 0) {
            return []; // Return an empty array if no data found for the student
        }

        // Fetch the student's grade level, strand code, section, and strand name
        $studentData = $resultStudent->fetch_assoc();
        $gradeLevel = $studentData['grade_lvl'];
        $strandCode = $studentData['strand_code'];
        $sectionCode = $studentData['section_code']; // Store section_code
        $strandName = $studentData['strand_name'];

        // Now fetch the subjects based on section, grade level, and strand
        $sql = "
        SELECT 
            sub.sub_code,
            sub.sub_title,
            sub.sub_type,
            sub.sub_semester,
            sched.sched_day,
            sched.sched_from,
            sched.sched_to,
            t.teacher_fname,
            t.teacher_lname,
            t.teacher_gender,
            t.teacher_id,
            t.image
        FROM 
            schedule sched
        INNER JOIN 
            section sec ON sched.section_code = sec.section_code
        INNER JOIN 
            subject sub ON sched.sub_code = sub.sub_code
        INNER JOIN 
            teacher t ON sched.teacher_id = t.teacher_id
        WHERE 
            sec.grade_lvl = ?
            AND sec.strand_code = ?
            AND sec.section_code = ?  -- Added section condition
            AND $activeSemesterCondition
        ORDER BY 
            sched.sched_day, sched.sched_from";

        // Prepare the main SQL statement
        $stmt = $this->con->prepare($sql);

        // Bind the grade level, strand, and section parameters
        $stmt->bind_param("sss", $gradeLevel, $strandCode, $sectionCode);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if any rows are returned
        if ($result->num_rows > 0) {
            // Fetch all matching rows
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            // Add additional data before returning
            foreach ($data as &$subject) {
                $subject['strand_code'] = $strandCode;
                $subject['strand_name'] = $strandName;
                $subject['strand_desc'] = $strandName;
                $subject['grade_lvl'] = $gradeLevel;
                $subject['section_code'] = $sectionCode; // Added section_code in the result
            }

            return $data; // Return all rows as an array
        } else {
            return []; // No rows found
        }
    }








    // THIS IS TO GET HE ALL EXAM OF STUDENT IN EVERY SUBJECT
    public function getAllStudentSubjectsExam($stu_lrn)
    {
        // Get active semester
        $activeSemesters = $this->checkSemStatus('semester');

        if (empty($activeSemesters)) {
            return []; // No active semester
        }

        $activeSemesterCondition = "sub.sub_semester IN ('" . implode("','", $activeSemesters) . "')";

        // Get student's section, grade level, and strand
        $studentQuery = "
            SELECT sec.grade_lvl, sec.strand_code, sec.section_code, st.strand_name, st.strand_desc
            FROM enroll e
            INNER JOIN section sec ON e.section_code = sec.section_code
            LEFT JOIN strand st ON sec.strand_code = st.strand_code
            WHERE e.stu_lrn = ? AND e.enroll_status = 'Enrolled'
            LIMIT 1";

        $stmtStudent = $this->con->prepare($studentQuery);
        $stmtStudent->bind_param("s", $stu_lrn);
        $stmtStudent->execute();
        $resultStudent = $stmtStudent->get_result();

        if ($resultStudent->num_rows === 0) {
            return []; // No data found for the student
        }

        $studentData = $resultStudent->fetch_assoc();
        $gradeLevel = $studentData['grade_lvl'];
        $strandCode = $studentData['strand_code'];
        $sectionCode = $studentData['section_code']; // Added section code
        $strandName = $studentData['strand_name'];
        $strandDesc = $studentData['strand_desc'];

        // Get subjects and their schedules
        $sql = "
            SELECT 
                sched.sched_id,
                sub.sub_code,
                sub.sub_title,
                sub.sub_type,
                sub.sub_semester,
                sec.section_code,
                sec.section_name,
                sched.sched_day,
                sched.sched_from,
                sched.sched_to,
                t.teacher_fname,
                t.teacher_lname,
                t.teacher_gender,
                t.teacher_id,
                t.image
            FROM schedule sched
            INNER JOIN 
                section sec ON sched.section_code = sec.section_code
            INNER JOIN 
                subject sub ON sched.sub_code = sub.sub_code
            INNER JOIN 
                teacher t ON sched.teacher_id = t.teacher_id
            WHERE 
                sec.grade_lvl = ? 
                AND sec.strand_code = ? 
                AND sec.section_code = ?   
                AND $activeSemesterCondition
            ORDER BY sched.sched_day, sched.sched_from";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("sss", $gradeLevel, $strandCode, $sectionCode);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return [];
        }

        $subjects = [];

        // Process subjects and group exams
        while ($row = $result->fetch_assoc()) {
            $schedId = $row['sched_id'];

            // Fetch exams related to the schedule
            $examQuery = "SELECT exam_id, exam_type, exam_quarter, exam_duration, 
                                 exam_title, exam_desc, exam_items, exam_date
                          FROM exam WHERE sched_id = ?";
            $stmtExam = $this->con->prepare($examQuery);
            $stmtExam->bind_param("s", $schedId);
            $stmtExam->execute();
            $examResult = $stmtExam->get_result();

            $exams = [];
            while ($examRow = $examResult->fetch_assoc()) {
                $exams[] = $examRow;
            }

            // Add subject details and its exams
            $row['exams'] = $exams;
            $row['strand_code'] = $strandCode;
            $row['strand_name'] = $strandName;
            $row['strand_desc'] = $strandDesc;
            $row['grade_lvl'] = $gradeLevel;
            $row['section_code'] = $sectionCode; // Added section_code in the result


            $subjects[] = $row;
        }

        return $subjects;
    }



    public function getAllExamTypeBySubjectsOfStudents($stu_lrn, $exam_id, $sub_code, $section_code, $grade_lvl)
    {
        // Get student's section, grade level, and strand
        $studentQuery = "
            SELECT sec.grade_lvl, sec.strand_code, sec.section_code, st.strand_name, st.strand_desc
            FROM enroll e
            INNER JOIN section sec ON e.section_code = sec.section_code
            LEFT JOIN strand st ON sec.strand_code = st.strand_code
            WHERE e.stu_lrn = ? AND e.enroll_status = 'Enrolled'
            LIMIT 1";

        $stmtStudent = $this->con->prepare($studentQuery);
        $stmtStudent->bind_param("s", $stu_lrn);
        $stmtStudent->execute();
        $resultStudent = $stmtStudent->get_result();

        if ($resultStudent->num_rows === 0) {
            return []; // No data found for the student
        }

        $studentData = $resultStudent->fetch_assoc();
        $strandCode = $studentData['strand_code'];

        // Get subjects and their schedules
        $sql = "
            SELECT 
                sched.sched_id,
                sub.sub_code,
                sub.sub_title,
                sub.sub_type,
                sub.sub_semester,
                sec.section_code,
                sec.section_name,
                sched.sched_day,
                sched.sched_from,
                sched.sched_to,
                t.teacher_fname,
                t.teacher_lname,
                t.teacher_gender,
                t.teacher_id,
                t.image,
                e.exam_id,
                e.exam_type,
                e.exam_quarter,
                e.exam_duration,
                e.exam_title,
                e.exam_desc,
                e.exam_items,
                e.exam_date
            FROM schedule sched
            INNER JOIN section sec ON sched.section_code = sec.section_code
            INNER JOIN subject sub ON sched.sub_code = sub.sub_code
            INNER JOIN teacher t ON sched.teacher_id = t.teacher_id
            LEFT JOIN exam e ON sched.sched_id = e.sched_id
            WHERE sec.grade_lvl = ? 
            AND sec.strand_code = ? 
            AND sec.section_code = ?
            AND sub.sub_code = ?
            ORDER BY sched.sched_day, sched.sched_from";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssss", $grade_lvl, $strandCode, $section_code, $sub_code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return [];
        }

        $subjects = [];

        while ($row = $result->fetch_assoc()) {
            $schedId = $row['sched_id'];

            // Fetch exams related to the schedule with filters
            $examQuery = "SELECT * FROM exam WHERE sched_id = ? AND exam_id = ?";
            $stmtExam = $this->con->prepare($examQuery);
            $stmtExam->bind_param("ss", $schedId, $exam_id);
            $stmtExam->execute();
            $examResult = $stmtExam->get_result();

            $exams = [];
            while ($examRow = $examResult->fetch_assoc()) {
                $examId = $examRow['exam_id'];

                // Fetch exam types
                $examRow['enumeration'] = $this->fetchExamType("exam_enumeration", "enum_id", "enum_question, enum_answer", $examId);
                $examRow['true_false'] = $this->fetchExamType("exam_tf", "tf_id", "tf_question, tf_answer", $examId);
                $examRow['multiple_choice'] = $this->fetchExamType("exam_multiple", "mul_id", "mul_question, choice_a, choice_b, choice_c, choice_d, is_correct", $examId);
                $examRow['essay'] = $this->fetchExamType("exam_essay", "essay_id", "essay_question", $examId);

                $exams[] = $examRow;
            }

            $row['exams'] = $exams;
            $row['strand_code'] = $strandCode;
            $row['strand_name'] = $studentData['strand_name'];
            $row['strand_desc'] = $studentData['strand_desc'];
            $row['grade_lvl'] = $grade_lvl;
            $row['section_code'] = $section_code;

            $subjects[] = $row;
        }

        return $subjects;
    }

    // Helper function to fetch exam questions of a specific type
    private function fetchExamType($table, $idColumn, $columns, $examId)
    {
        $query = "SELECT $columns FROM $table WHERE exam_id = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("s", $examId);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }





















    //GET TEACHER SECTION HANDLED by id
    public function getTeacherSectionHandled($teacher_id)
    {
        // Get the active semester
        $activeSchoolYear = $this->checkSyStatus('sy');

        // Check if there are any active semesters
        if (empty($activeSchoolYear)) {
            return []; // Return an empty array if no active semester
        }
        // Prepare the active semester condition
        $activeSchoolYearCondition = "s.school_year IN ('" . implode("','", $activeSchoolYear) . "')";

        $sql = "
            SELECT 
                s.grade_lvl, 
                s.school_year,
                s.section_name, 
                st.strand_name, 
                st.strand_desc
            FROM 
                `section` s
            LEFT JOIN 
                `strand` st 
            ON 
                s.strand_code = st.strand_code
            WHERE 
                s.teacher_id = ?
                AND $activeSchoolYearCondition
                ";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $teacher_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any rows are returned
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Return the first row
        } else {
            return null; // No rows found
        }
    }

    //Check how man enrolled in section 
    public function checkEnrolledCountByTeacher($teacher_id)
    {
        $sql = "
            SELECT 
                b.*, 
                s.section_name, 
                s.grade_lvl, 
                COUNT(e.stu_lrn) OVER (PARTITION BY s.section_code) AS enrolled_count
            FROM 
                enroll e
            INNER JOIN 
                section s ON e.section_code = s.section_code
            INNER JOIN 
                student b ON e.stu_lrn = b.stu_lrn
            WHERE 
                s.teacher_id = ?
        ";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $teacher_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        return $result;
    }

    public function getAllStudentDetailsBySectionOfTeacher($teacher_id)
    {
        $sql = "
        SELECT 
            b.*, 
            s.section_name, 
            s.grade_lvl, 
            s.strand_code, 
            sub.sub_code, 
            sub.sub_title, 
            sched.sched_day, 
            sched.sched_from, 
            sched.sched_to
        FROM 
            enroll e
        INNER JOIN 
            student b ON e.stu_lrn = b.stu_lrn
        INNER JOIN 
            section s ON e.section_code = s.section_code
        INNER JOIN 
            schedule sched ON sched.section_code = s.section_code 
        INNER JOIN 
            subject sub ON sched.sub_code = sub.sub_code
        WHERE 
            s.teacher_id = ? 
            AND sub.teacher_id = s.teacher_id
        ";

        // Prepare and execute the query
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $teacher_id);  // Teacher ID is passed as a parameter
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        return $result;
    }

    // GET ALL STUDENT BY TEACHER HANDLED SUBJECT IN EVERY SECTION
    // function getAllStudentBySectionAndSubject($teacherId, $subjectId, $sectionCode)
    // {
    //     try {
    //         $sql = "
    //             SELECT 
    //                 s.*,   
    //                 sched.sched_id,
    //                 sec.section_code, 
    //                 sec.section_name,
    //                 sec.grade_lvl, 
    //                 COUNT(e.stu_lrn) OVER (PARTITION BY sec.section_code) AS enrolled_count
    //             FROM 
    //                 STUDENT s
    //             INNER JOIN  
    //                 ENROLL e ON s.stu_lrn = e.stu_lrn
    //             INNER JOIN  
    //                 SECTION sec ON e.section_code = sec.section_code
    //             INNER JOIN  
    //                 SCHEDULE sched ON sec.section_code = sched.section_code
    //             INNER JOIN  
    //                 SUBJECT sub ON sched.sub_code = sub.sub_code
    //             WHERE 
    //                 sched.sub_code = ? 
    //                 AND sched.section_code = ?
    //                 AND sched.teacher_id = ?
    //         ";

    //         // Prepare the query
    //         $stmt = $this->con->prepare($sql);
    //         if (!$stmt) {
    //             throw new Exception("Failed to prepare the SQL statement: " . $this->con->error);
    //         }

    //         // Bind parameters (use 's' for string, 'i' for integer)
    //         $stmt->bind_param("sss", $subjectId, $sectionCode, $teacherId); // 'ssi' for string, string, integer

    //         // Execute the statement
    //         $stmt->execute();
    //         $result = $stmt->get_result();

    //         // Fetch all matching rows
    //         $students = $result->fetch_all(MYSQLI_ASSOC);

    //         // Free resources
    //         $stmt->close();

    //         return $students;
    //     } catch (Exception $e) {
    //         // Log the error message
    //         error_log("Error fetching students: " . $e->getMessage());
    //         return [];
    //     }
    // }

    // GET ALL STUDENT BY TEACHER HANDLED SUBJECT IN EVERY same strand and grade lvl
    function getAllStudentBySectionAndSubjectWithModuleUploads($teacherId, $subjectId, $sectionCode)
    {
        try {
            $sql = "
                SELECT 
                    s.stu_lrn,
                    s.stu_lname,
                    s.stu_fname,
                    s.stu_gender,
                    s.stu_contact,
                    s.stu_address,
                    s.stu_email,
                    e.semester,
                    sec.section_code, 
                    sec.section_name,
                    sec.grade_lvl,
                    sched.sched_id,
                    sub.sub_title,
                    sub.sub_semester,
                    GROUP_CONCAT(ma.file_name ORDER BY ma.date_uploaded DESC) AS file_names,  -- Concatenate files
                    GROUP_CONCAT(ma.date_uploaded ORDER BY ma.date_uploaded DESC) AS upload_dates,  -- Concatenate dates
                    COUNT(e.stu_lrn) OVER (PARTITION BY sec.section_code) AS enrolled_count
                FROM 
                    student s
                INNER JOIN 
                    enroll e ON s.stu_lrn = e.stu_lrn
                INNER JOIN 
                    section sec ON e.section_code = sec.section_code
                INNER JOIN 
                    schedule sched ON sec.section_code = sched.section_code
                INNER JOIN 
                    subject sub ON sched.sub_code = sub.sub_code
                LEFT JOIN 
                    module m ON sched.sched_id = m.sched_id
                LEFT JOIN 
                    module_answer ma ON ma.module_id = m.module_id AND ma.stu_lrn = s.stu_lrn
                WHERE 
                    sched.teacher_id = ?
                    AND sched.sub_code = ?
                    AND sched.section_code = ?
                GROUP BY 
                    s.stu_lrn, sec.section_code, sched.sched_id
                ORDER BY 
                    s.stu_lname, s.stu_fname;


            ";

            // Prepare the query
            $stmt = $this->con->prepare($sql);
            if (!$stmt) {
                throw new Exception("Failed to prepare the SQL statement: " . $this->con->error);
            }

            // Bind parameters
            $stmt->bind_param("sss", $teacherId, $subjectId, $sectionCode);

            // Execute the statement
            $stmt->execute();
            $result = $stmt->get_result();

            // Fetch all matching rows
            $studentsWithUploads = $result->fetch_all(MYSQLI_ASSOC);

            // Free resources
            $stmt->close();

            return $studentsWithUploads;
        } catch (Exception $e) {
            // Log the error message
            error_log("Error fetching students with module uploads: " . $e->getMessage());
            return [];
        }
    }




    public function getAllStudentBySectionAndSubjectOfTeacher($teacher_id)
    {
        $sql = "
        SELECT 
            b. * ,
            s.section_name, 
            s.grade_lvl, 
            s.strand_code, 
            sub.sub_code, 
            sub.sub_title, 
            sched.sched_day, 
            sched.sched_from, 
            sched.sched_to
        FROM 
            enroll e
        INNER JOIN 
            student b ON e.stu_lrn = b.stu_lrn
        INNER JOIN 
            section s ON e.section_code = s.section_code
        INNER JOIN 
            schedule sched ON sched.section_code = s.section_code
        INNER JOIN 
            subject sub ON sched.sub_code = sub.sub_code
        WHERE 
            sub.teacher_id = ?
            AND 
            section_name = 'ST.PHILIP'
        ";

        // Prepare and execute the query
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $teacher_id);  // Bind the teacher_id parameter
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        return $result;
    }



    // GET TEACHER SUBJECT HANDLED by id with COUNT
    public function getTeacherSubjectHandled($teacher_id)
    {
        // Query to get the list of subjects handled by the teacher
        $sql = "SELECT 
                subject.sub_title
            FROM schedule
            JOIN subject ON schedule.sub_code = subject.sub_code
            WHERE schedule.teacher_id = ?";

        // Prepare and execute the query for subject list
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $teacher_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array

        // Query to count how many subjects the teacher is handling
        $count_sql = "SELECT COUNT(DISTINCT schedule.sub_code) as subject_count 
                  FROM schedule
                  WHERE schedule.teacher_id = ?";

        // Prepare and execute the query for the subject count
        $count_stmt = $this->con->prepare($count_sql);
        $count_stmt->bind_param("s", $teacher_id);
        $count_stmt->execute();
        $count_result = $count_stmt->get_result()->fetch_assoc(); // Fetch the count result

        // Combine both results
        $data = [
            'subject_count' => $count_result['subject_count'],
            'subjects' => $result
        ];

        return $data;
    }


    // GET ALL Adviser and classmate of student
    public function getAdviserandClassmates($student_id)
    {
        $sql = "
            SELECT 
                e.semester,
                e.school_year, 
                e.section_code, 
                s.section_name, 
                s.grade_lvl,
                st.strand_code,
                st.strand_name,
                t.teacher_id,
                t.teacher_fname,
                t.teacher_lname,
                c.stu_lrn AS classmate_lrn,
                c.stu_fname AS classmate_fname,
                c.stu_lname AS classmate_lname
            FROM enroll e
            INNER JOIN section s ON e.section_code = s.section_code
            INNER JOIN strand st ON s.strand_code = st.strand_code
            INNER JOIN teacher t ON s.teacher_id = t.teacher_id
            INNER JOIN enroll c ON e.section_code = c.section_code
            WHERE e.stu_lrn = ? 
            AND c.stu_lrn != ?  -- Exclude the current student from the classmates list
        ";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ss", $student_id, $student_id);  // Binding student_id twice
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }



    //GET STUDENT SECTION HANDLED by id  
    public function getStudentStrandAndSection($student_id)
    {
        $sql = "SELECT 
                e.semester,
                e.school_year, 
                e.section_code, 
                s.section_name, 
                s.grade_lvl,
                st.strand_code,
                st.strand_name,
                t.teacher_id,
                t.teacher_fname,
                t.teacher_lname
            FROM enroll e
            INNER JOIN 
                section s ON e.section_code = s.section_code
            INNER JOIN
                strand st ON s.strand_code = st.strand_code
            INNER JOIN
                teacher t ON s.teacher_id = t.teacher_id
            WHERE e.stu_lrn = ?";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array
        return $result;
    }



    // Fetch student section, adviser, and classmates
    public function getStudentStrandAndSectionaAlsoAdviser($student_id)
    {
        $sql = "
        SELECT 
            mainStudent.stu_lrn AS target_student_lrn,
            mainStudent.stu_fname AS target_student_fname,
            mainStudent.stu_lname AS target_student_lname,
            mainStudent.stu_gender,
            mainEnroll.section_code AS target_section_code,
            s.section_name,
            s.grade_lvl,
            st.strand_code,
            st.strand_name,
            st.strand_desc,
            t.teacher_id,
            t.teacher_fname,
            t.teacher_lname,
            t.teacher_gender,
            t.image,
            classmate.stu_lrn AS classmate_lrn,
            classmate.stu_fname AS classmate_fname,
            classmate.stu_lname AS classmate_lname,
            classmate.image AS student_image,
            COUNT(mainEnroll.stu_lrn) OVER (PARTITION BY s.section_code) AS enrolled_count
        FROM 
            enroll mainEnroll
        INNER JOIN 
            section s ON mainEnroll.section_code = s.section_code
        INNER JOIN 
            strand st ON s.strand_code = st.strand_code
        INNER JOIN 
            teacher t ON s.teacher_id = t.teacher_id
        INNER JOIN 
            student mainStudent ON mainEnroll.stu_lrn = mainStudent.stu_lrn
        LEFT JOIN 
            enroll classmateEnroll ON classmateEnroll.section_code = mainEnroll.section_code
        LEFT JOIN 
            student classmate ON classmateEnroll.stu_lrn = classmate.stu_lrn
        WHERE 
            mainEnroll.stu_lrn = ?
        ORDER BY classmate.stu_lrn";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }




    //GET SEMESTER AND SY
    public function getActiveSy()
    {
        $sql = "SELECT * FROM `SY`";
        $stored = ($this->con->query($sql))->fetch_assoc();
        return $stored;
    }


    public function updateSchool($column, $value)
    {
        $value = mysqli_real_escape_string($this->con, $value);
        $sql = "UPDATE `school` SET `$column` = '$value'";
        $result = $this->con->query($sql);
        return $result;
    }

    //UPDATE REGISTRAR AND PRINCIPAL INFORMATION
    public function updateUserInfo($table, $data)
    {
        // Ensure the table name is safe (e.g., against SQL injection)
        $table = mysqli_real_escape_string($this->con, $table);

        // Prepare the SET clause
        $setClause = [];
        foreach ($data as $column => $value) {
            $escapedValue = mysqli_real_escape_string($this->con, $value);
            $setClause[] = "`$column` = '$escapedValue'";
        }

        // Join the SET clauses
        $setString = implode(", ", $setClause);

        // Construct the SQL query
        $sql = "UPDATE `$table` SET $setString"; // You might want to add a WHERE clause for specific records

        // Execute the query
        $result = $this->con->query($sql);

        // Return the result of the query
        return $result;
    }


    function getStudentEnrolled($row, $value)
    {
        $sql = "SELECT * FROM `enroll` WHERE `$row` = '$value'";
        $stored = ($this->con->query($sql))->fetch_assoc();
        return $stored;
    }

    // GET STUDENT ACCOUNTS
    public function getStudentAccounts($role = 'STUDENT')
    {
        // Prepare the query to get only users with the specified role and their corresponding student info
        $stmt = $this->con->prepare("
         SELECT u.id, u.username, u.password, u.role, u.date_added, s.stu_dob, s.stu_fname, s.stu_mname, s.stu_lname
        FROM `users` u
        JOIN `student` s ON u.username = s.stu_lrn
        WHERE u.role = ? 
        ORDER BY s.stu_lrn DESC
    ");
        $stmt->bind_param('s', $role); // 's' denotes the type (string)
        $stmt->execute();
        $stored = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $stored;
    }


    // GET TEACHER ACCOUNTS
    public function getTeacherAccounts($role = 'TEACHER')
    {
        // Prepare the query to get only users with the specified role and their corresponding student info
        $stmt = $this->con->prepare("
        SELECT u.id, u.username, u.password, u.role, u.date_added, 
        t.teacher_dob, t.teacher_fname, t.teacher_mname, t.teacher_lname
        FROM `users` u
        JOIN `teacher` t ON u.id = t.id
        WHERE u.role = ?
        ORDER BY t.teacher_id DESC
        ");
        $stmt->bind_param('s', $role); // 's' denotes the type (string)
        $stmt->execute();
        $stored = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $stored;
    }



    // General function for getting credentials
    function getCredential($table, $row, $value)
    {
        $sql = "SELECT * FROM `$table` WHERE `$row` = '$value'";
        $stored = ($this->con->query($sql))->fetch_assoc();
        return $stored;
    }


    // COUNT THE NUMBER OF ROWS IN TABLE
    public function checkRowCount($table, $row = null, $value = null)
    {
        if ($row != null &&  $value != null) {
            $sql = "SELECT * FROM `$table` WHERE `$row` = '$value'";
        } else {
            $sql = "SELECT * FROM `$table`";
        }

        $result = mysqli_num_rows($this->con->query($sql));

        return $result;
    }


    // COUNT THE NUMBER OF ROWS IN TABLE TO VALIDATION SELECTED IN UPDATE
    public function checkRowCountSubject($table, $row = null, $value = null, $id = null)
    {
        if ($row != null && $value != null) {
            // Adjust the query to exclude the current subject ID
            $sql = "SELECT * FROM `$table` WHERE `$row` = '$value'";
            if ($id != null) {
                $sql .= " AND `sub_code` != '$id'"; // Assuming `sub_id` is the primary key
            }
        } else {
            $sql = "SELECT * FROM `$table`";
        }

        $result = mysqli_num_rows($this->con->query($sql));

        return $result;
    }

    // Check if section name already exist 
    public function checkSectionName($table, $row = null, $value = null, $id = null)
    {
        if ($row != null && $value != null) {
            // Adjust the query to exclude the current subject ID
            $sql = "SELECT * FROM `$table` WHERE `$row` = '$value'";
            if ($id != null) {
                $sql .= " AND `section_code` != '$id'"; // Assuming `sub_id` is the primary key
            }
        } else {
            $sql = "SELECT * FROM `$table`";
        }

        $result = mysqli_num_rows($this->con->query($sql));

        return $result;
    }

    // Check if the strand , grade level and strand are already exist 
    public function checkRowCountSection($table, $section_name, $grade_lvl, $section_id = null)
    {
        // Prepare the SQL query to check for the section name and grade level
        $sql = "SELECT * FROM `$table` WHERE `section_name` = ? AND `grade_lvl` = ?";

        // If we are updating an existing record, exclude that record from the check
        if ($section_id != null) {
            $sql .= " AND `section_code` != ?";
        }

        // Prepare the SQL statement
        $stmt = $this->con->prepare($sql);

        // Bind the parameters dynamically based on whether section_id is provided
        if ($section_id != null) {
            $stmt->bind_param("sss", $section_name, $grade_lvl, $section_id);
        } else {
            $stmt->bind_param("ss", $section_name, $grade_lvl);
        }

        $stmt->execute();
        $stmt->store_result();
        // Return the number of rows found (if > 0, it means the combination exists)
        return $stmt->num_rows;
    }


    function checkEnrollmentInSemester($stu_lrn, $semester)
    {
        // Connect to the database
        $this->connection();

        // Query to check if the student is already enrolled in the specified semester and section
        $sql = "SELECT COUNT(*) as enrolled_count FROM enroll WHERE stu_lrn = ? AND semester = ?";

        // Prepare the SQL statement
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ss", $stu_lrn, $semester);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();
        $row = $result->fetch_assoc() ?? ['enrolled_count' => 0];

        // Close the statement and connection
        $stmt->close();
        $this->disconnect();

        // Return the count; if it's 0, the student is not enrolled
        return $row['enrolled_count'];
    }


    //Check active STATUS in school year
    public function checkSyStatus($table)
    {
        $activeSchoolYear = [];
        // Prepare the SQL query to get the active status and the school_year from the sy table
        $sql = "SELECT `school_year` 
                FROM `$table`
                WHERE `status` = 'Active'";

        // Execute the query
        $result = $this->con->query($sql);

        // Check if the query was successful
        if ($result->num_rows > 0) {
            // Fetch the school year of the active row
            $activeSchoolYear = [];
            while ($row = $result->fetch_assoc()) {
                $activeSchoolYear[] = $row['school_year'];
            }

            // Return the active school year(s)
            return $activeSchoolYear;
        } else {
            return []; // Return an empty array if no active school year is found
        }
    }

    //Check active STATUS in semester
    public function checkSemStatus($table)
    {
        $semesters = [];

        // Prepare the SQL query to get the active semester name
        $sql = "SELECT `semester_name` 
                FROM `$table`
                WHERE `status` = 'Active'";

        // Execute the query
        $result = $this->con->query($sql);

        // Check if the query was successful
        if ($result && $result->num_rows > 0) {
            // Fetch the active semester(s)
            while ($row = $result->fetch_assoc()) {
                $semesters[] = $row['semester_name'];
            }

            // Return the active semester(s)
            return $semesters;
        } else {
            return []; // Return an empty array if no active semester is found
        }
    }

    public function getActiveSemester()
    {
        // Query to get the active semester
        $sql = "SELECT semester_name FROM semester WHERE status = 'Active' LIMIT 1";
        $result = $this->con->query($sql);

        if ($result && $row = $result->fetch_assoc()) {
            return $row['semester_name'];  // Return the semester name if found
        }

        // Return null if no active semester is found
        return null;
    }


    public function checkUserExist($username)
    {
        $sql = "SELECT * FROM users WHERE  username = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s",  $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Return the first row if exists
    }

    // CHECK IF THE STUDENT AND FACULTY FIRST NAME AND LAST NAME IF ALREADY EXIST 
    public function checkEntityExist($table, $firstnameColumn, $lastnameColumn, $idColumn, $firstname, $lastname, $excludeID)
    {
        $sql = "SELECT * FROM $table WHERE $firstnameColumn = ? AND $lastnameColumn = ? AND $idColumn != ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("sss", $firstname, $lastname, $excludeID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Return the first row if exists
    }

    // Check if the id's in row in table schedule was duplicate 
    public function checkDuplicateID($table, $firstColumn, $secondColumn, $idColumn, $section_code, $sub_code, $excludeID)
    {
        // Prepare the SQL query
        $sql = "SELECT * FROM $table WHERE $firstColumn = ? AND $secondColumn = ? AND $idColumn != ?";
        $stmt = $this->con->prepare($sql);

        // Bind the parameters
        $stmt->bind_param("sss", $section_code, $sub_code, $excludeID);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch the result
        return $result->num_rows > 0; // Return true if a duplicate exists
    }




    public function checkSectionExist($strand, $section, $adviser)
    {
        $sql = "SELECT * FROM section WHERE strand_code =? AND section_name =? AND  teacher_id =?";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssi", $strand, $section, $adviser);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc(); // Return the first row if exists
    }

    public function checkSubjectExist($subject, $type, $excludeID)
    {
        $sql = "SELECT * FROM subject WHERE sub_title =? AND sub_type =? AND sub_code =?";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssi", $subject, $type, $excludeID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc(); // Return the first row if exists
    }



    public function insertSy($table, $sy)
    {
        // First, check if the school year already exists in the table
        $checkSql = "SELECT * FROM `$table` WHERE `school_year` = ?";
        $stmt = $this->con->prepare($checkSql);
        $stmt->bind_param("s", $sy);
        $stmt->execute();
        $result = $stmt->get_result();

        // If a record exists, return false (school year already exists)
        if ($result->num_rows > 0) {
            return false; // School year already exists
        }

        // If no record exists, proceed with updating and inserting
        $sql = "UPDATE `sy` SET `status` = 'Inactive'";
        $result = $this->con->query($sql);

        if ($result) {
            // Prepare to insert the new school year with the status 'Active'
            $insertSql = "INSERT INTO `$table` (`school_year`, `status`) VALUES (?, 'Active')";
            $stmt = $this->con->prepare($insertSql);
            $stmt->bind_param("s", $sy);

            // Execute the insert and check if successful
            if ($stmt->execute()) {
                return true; // Successfully inserted
            } else {
                return false; // Error during insertion
            }
        } else {
            return false; // Error during update
        }
    }



    // INSERT INTO TABLE SEMESTER
    public function insertSem($table, $sem)
    {

        $sql = "UPDATE `semester` SET `status` = 'Inactive'";
        $result = $this->con->query($sql);

        if ($result) {
            $sql = "INSERT INTO `$table` VALUES ('$sem', 'Active');";
            $result = $this->con->query($sql);
        } else {
            return false;
        }
    }


    public function checkExistingSem($table, $semester)
    {
        $sql = "SELECT * FROM $table WHERE semester_name = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $semester);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0; // Returns true if a record exists, false otherwise
    }


    public function checkExistingSY($table, $sy)
    {
        $sql = "SELECT * FROM $table WHERE school_year = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $sy);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0; // Returns true if a record exists, false otherwise
    }



    //UPDATE INTO TABLE ACTIVE SY
    public function setSchoolYear($table, $sy, $id)
    {
        try {
            // Step 1: Set all rows to 'Inactive'
            $sql = "UPDATE `$table` SET `status` = 'Inactive'";
            $this->con->query($sql);

            // Step 2: Set the selected row to 'Active' based on the passed school year ID
            $sql = "UPDATE `$table` SET `status` = 'Active' WHERE `school_year` = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param('s', $id);
            $stmt->execute();

            // Step 3: Return the success or failure of the operation
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            // Log the error for debugging purposes
            error_log("Error updating school year status: " . $e->getMessage());
            return false;
        }
    }

    //UPDATE INTO TABLE ACTIVE SEMESTER
    public function setSemester($table, $sy, $id)
    {
        try {
            // Step 1: Set all rows to 'Inactive'
            $sql = "UPDATE `$table` SET `status` = 'Inactive'";
            $this->con->query($sql);

            //Set the selected row to 'Active' based on the passed school year ID
            $sql = "UPDATE `$table` SET `status` = 'Active' WHERE `semester_name` = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param('s', $id);
            $stmt->execute();



            // Return the success or failure of the operation
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            // Log the error for debugging purposes
            error_log("Error updating school year status: " . $e->getMessage());
            return false;
        }
    }




    //  GET ALL USERS PRINCIPAL | FACULTIES | STUDENTS
    public function getUsers($row = null, $value = null, $limit = 16, $offset = 0)
    {
        if ($row != null && $value != null) {
            // Single record fetch with filtering
            $stmt = $this->con->prepare("
                SELECT 
                    u.id AS user_id,
                    u.username,
                    u.role,
                    u.date_added,
                    CASE 
                        WHEN u.role = 'teacher' THEN CONCAT(t.teacher_fname, ' ', t.teacher_mname, ' ', t.teacher_lname)
                        WHEN u.role = 'student' THEN CONCAT(s.stu_fname, ' ', s.stu_mname, ' ', s.stu_lname)
                        WHEN u.role = 'principal' THEN CONCAT(p.firstname, ' ', p.middlename, ' ', p.lastname)
                        ELSE 'Unknown Role'
                    END AS full_name
                FROM users u
                LEFT JOIN teacher t ON u.id = t.id
                LEFT JOIN student s ON u.id = s.id
                LEFT JOIN principal p ON u.id = p.id
                WHERE `$row` = ?
            ");
            $stmt->bind_param('s', $value); // 's' denotes the type (string)
            $stmt->execute();
            $stored = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $stored;
        } else {
            // Fetch multiple records with pagination
            $stmt = $this->con->prepare("
                SELECT 
                    u.id AS user_id,
                    u.username,
                    u.role,
                    u.date_added,
                    CASE 
                        WHEN u.role = 'teacher' THEN CONCAT(t.teacher_fname, ' ', t.teacher_mname, ' ', t.teacher_lname)
                        WHEN u.role = 'student' THEN CONCAT(s.stu_fname, ' ', s.stu_mname, ' ', s.stu_lname)
                        WHEN u.role = 'principal' THEN CONCAT(p.firstname, ' ', p.middlename, ' ', p.lastname)
                        ELSE 'Unknown Role'
                    END AS full_name
                FROM users u
                LEFT JOIN teacher t ON u.id = t.id
                LEFT JOIN student s ON u.id = s.id
                LEFT JOIN principal p ON u.id = p.id
                ORDER BY u.id
                LIMIT ? OFFSET ?
            ");
            $stmt->bind_param('ii', $limit, $offset); // 'ii' denotes the types (integer, integer)
            $stmt->execute();
            $stored = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $stored;
        }
    }






    // SEARCH USERS IN TABLE
    public function searchUser($value)
    {
        // Sanitize the input value
        $value = mysqli_real_escape_string($this->con, $value);

        // Query with INNER JOIN to get data from users, teacher, student, and principal
        $sql = "
        SELECT 
            u.id AS user_id,
            u.username,
            u.role,
            u.date_added,
            CASE 
                WHEN u.role = 'teacher' THEN CONCAT(t.teacher_fname, ' ', t.teacher_mname, ' ', t.teacher_lname)
                WHEN u.role = 'student' THEN CONCAT(s.stu_fname, ' ', s.stu_mname, ' ', s.stu_lname)
                WHEN u.role = 'principal' THEN CONCAT(p.firstname, ' ', p.middlename, ' ', p.lastname)
                ELSE 'Unknown Role'
            END AS full_name
        FROM users u
        LEFT JOIN teacher t ON u.id = t.id
        LEFT JOIN student s ON u.id = s.id
        LEFT JOIN principal p ON u.id = p.id
        WHERE u.username LIKE '$value%' 
           OR u.role LIKE '$value%'
           OR u.date_added LIKE '$value%'
           OR t.teacher_fname LIKE '$value%' 
           OR t.teacher_lname LIKE '$value%'
           OR s.stu_fname LIKE '$value%'
           OR s.stu_lname LIKE '$value%'
           OR p.firstname LIKE '$value%'
           OR p.lastname LIKE '$value%'
        ORDER BY u.username, u.role, u.date_added";

        // Execute the query
        $result = $this->con->query($sql);

        // Check if any rows were returned
        if ($result && mysqli_num_rows($result) > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }



    //GET SCHOOL YEAR
    public function getSchoolyear($row = null, $value = null)
    {
        if ($row != null &&  $value != null) {

            $sql = "SELECT * FROM `sy` WHERE `$row` = '$value'";
            $stored = ($this->con->query($sql))->fetch_assoc();
            return $stored;
        } else {

            $sql = "SELECT * FROM `sy` ORDER BY `school_year`";
            $stored = ($this->con->query($sql))->fetch_all(MYSQLI_ASSOC);
            return $stored;
        }
    }

    //GET SEMESTER
    public function getSemester($row = null, $value = null)
    {
        if ($row != null &&  $value != null) {

            $sql = "SELECT * FROM `semester` WHERE `$row` = '$value'";
            $stored = ($this->con->query($sql))->fetch_assoc();
            return $stored;
        } else {

            $sql = "SELECT * FROM `semester` ORDER BY `semester_name`";
            $stored = ($this->con->query($sql))->fetch_all(MYSQLI_ASSOC);
            return $stored;
        }
    }

    function hasSubjectTimeConflict($section_code, $sub_code, $day, $from, $to)
    {
        // Prepare query to check for conflicts considering the sub_code, section_code, and specific time ranges
        $query = "SELECT * FROM schedule 
                  WHERE section_code = ? 
                  AND sub_code = ? 
                  AND sched_day = ? 
                  AND (
                        (? BETWEEN sched_from AND sched_to) OR
                        (? BETWEEN sched_from AND sched_to) OR
                        (sched_from BETWEEN ? AND ?)
                      )";

        // Use prepared statement for security
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("sssssss", $section_code, $sub_code, $day, $from, $to, $from, $to);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // If there are conflicts, return the first conflict details (e.g., subject code, time, and section)
        if ($result && $result->num_rows > 0) {
            // Fetch the conflicting schedule
            return $result->fetch_assoc();
        }

        // No conflicts found
        return false;
    }




    //GET STRAND NAME
    // public function getStrand($row = null, $value = null, $limit = 8, $offset = 0)
    // {
    //     // Parameterized query to prevent SQL injection
    //     if ($row != null && $value != null) {

    //         $stmt = $this->con->prepare("SELECT * FROM `strand` WHERE `$row` = ?");
    //         $stmt->bind_param('s', $value); // 's' denotes the type (string)
    //         $stmt->execute();
    //         $stored = $stmt->get_result()->fetch_assoc();
    //         $stmt->close();
    //         return $stored;
    //     } else {
    //         // Adjust the limit and offset to ensure at least 8 records are fetched
    //         $stmt = $this->con->prepare("SELECT * FROM `strand` ORDER BY `strand_code` LIMIT ? OFFSET ?");
    //         $stmt->bind_param('ii', $limit, $offset); // 'ii' denotes the types (integer, integer)
    //         $stmt->execute();
    //         $stored = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    //         $stmt->close();
    //         return $stored;
    //     }
    // }

    // GET LIST OF STRAND
    public function getStrand($row = null, $value = null)
    {
        if ($row != null &&  $value != null) {

            $sql = "SELECT * FROM `strand` WHERE `$row` = '$value'";
            $stored = ($this->con->query($sql))->fetch_assoc();
            return $stored;
        } else {

            $sql = "SELECT * FROM `strand` ORDER BY `strand_name`";
            $stored = ($this->con->query($sql))->fetch_all(MYSQLI_ASSOC);

            return $stored;
        }
    }



    // GET LIST OF SECTION
    public function getSection($row = null, $value = null)
    {
        if ($row != null && $value != null) {
            $sql = "SELECT `section_code`, `strand_name`,
            `strand_desc`, `section.strand_code`, `grade_lvl`,
            `section_name`, `teacher_fname`, `teacher_lname`, `school_year`,
            `section.teacher_id`, CONCAT(`teacher_fname`,' ', `teacher_mname`, ' ', `teacher_lname`) AS adviser
            FROM `section`
            INNER JOIN `strand`
            ON section.strand_code = strand.strand_code
            INNER JOIN `teacher`
            ON section.teacher_id = teacher.teacher_id
            WHERE section.$row = '$value'";

            $stored = ($this->con->query($sql))->fetch_assoc();

            return $stored;
        } else {
            $sql = "SELECT `section_code`, `strand_name`,
            `strand_desc`, `grade_lvl`, `section_name`,
            `teacher_fname` , `teacher_lname`, `school_year`,
            CONCAT(`teacher_fname`,' ', `teacher_mname`, ' ', `teacher_lname`)AS adviser
            FROM  `section`
            INNER JOIN `strand`
            ON section.strand_code = strand.strand_code
            LEFT JOIN `teacher`
            ON section.teacher_id = teacher.teacher_id
            ORDER BY section.section_name";

            $stored = ($this->con->query($sql))->fetch_all(MYSQLI_ASSOC);

            return $stored;
        }
    }



    //GET LIST OF SUBJECT
    public function getSubject($row = null, $value = null)
    {
        if ($row != null && $value != null) {
            // Use prepared statements to avoid SQL injection
            $stmt = $this->con->prepare("SELECT 
                `sub_code`,
                `sub_title`, 
                `sub_type`, 
                `sub_time`,
                `sub_semester`
                FROM `subject`
                WHERE subject.$row = ?");

            // Bind the value to the prepared statement
            $stmt->bind_param("s", $value);

            // Execute the query
            if ($stmt->execute()) {
                // Fetch and return the result
                $result = $stmt->get_result();
                $stored = $result->fetch_assoc();
                $stmt->close();

                return $stored;
            } else {
                // Handle query error
                echo "Error executing query: " . $this->con->error;
                return null;
            }
        } else {
            // Fetch all subjects when no specific row or value is provided
            $sql = "SELECT 
                `sub_code`, 
                `sub_title`, 
                `sub_type`, 
                `sub_time`,
                `sub_semester`
                FROM `subject`
                ORDER BY subject.sub_title";

            $result = $this->con->query($sql);

            if ($result) {
                // Fetch all results as an associative array
                $stored = $result->fetch_all(MYSQLI_ASSOC);
                return $stored;
            } else {
                // Handle query error
                echo "Error executing query: " . $this->con->error;
                return [];
            }
        }
    }





    //GET LIST OF SUBJECT BY SEMESTER AND STRAND
    public function getSubjectByStrands($row = null, $value = null)
    {
        // Get the active semester
        $activeSemesters = $this->checkSemStatus('semester');

        // Check if there are any active semesters
        if (empty($activeSemesters)) {
            return []; // Return an empty array if no active semester
        }

        // Prepare the active semester condition
        $activeSemesterSubject = "subject.sub_semester IN ('" . implode("','", $activeSemesters) . "')";

        if ($row != null && $value != null) {
            // Use prepared statements to avoid SQL injection
            $stmt = $this->con->prepare("
            SELECT 
                schedule.sub_code,
                subject.sub_title,
                subject.sub_type,
                subject.sub_semester,
                schedule.sched_day,
                schedule.sched_from,
                schedule.sched_to,
                strand.strand_name,
                strand.strand_desc,
                subject.strand_code,
                section.grade_lvl,
                CONCAT(teacher.teacher_fname, ' ', teacher.teacher_mname, ' ', teacher.teacher_lname) AS teacher
            FROM schedule
            INNER JOIN subject ON schedule.sub_code = subject.sub_code
            INNER JOIN teacher ON schedule.teacher_id = teacher.teacher_id
            INNER JOIN section on schedule.section_code = section.section_code
            LEFT JOIN strand ON section.strand_code = strand.strand_code
            WHERE schedule.$row = ? AND $activeSemesterSubject
        ");

            // Bind the value to the prepared statement
            $stmt->bind_param("s", $value);

            // Execute the query
            if ($stmt->execute()) {
                // Fetch and return the result
                $result = $stmt->get_result();
                $stored = $result->fetch_all(MYSQLI_ASSOC);
                $stmt->close();

                return $stored;
            } else {
                // Handle query error
                echo "Error executing query: " . $this->con->error;
                return [];
            }
        } else {
            // Fetch all subjects when no specific row or value is provided
            $sql = "
            SELECT 
                schedule.sub_code,
                subject.sub_title,
                subject.sub_type,
                subject.sub_semester,
                schedule.sched_day,
                schedule.sched_from,
                schedule.sched_to,
                strand.strand_name,
                strand.strand_desc,
                section.strand_code,
                section.grade_lvl,
                CONCAT(teacher.teacher_fname, ' ', teacher.teacher_mname, ' ', teacher.teacher_lname) AS teacher
            FROM schedule
            INNER JOIN subject ON schedule.sub_code = subject.sub_code
            INNER JOIN teacher ON schedule.teacher_id = teacher.teacher_id
            INNER JOIN section on schedule.section_code = section.section_code
            LEFT JOIN strand ON section.strand_code = strand.strand_code
            WHERE $activeSemesterSubject
            ORDER BY subject.sub_title
        ";

            $result = $this->con->query($sql);

            if ($result) {
                // Fetch all results as an associative array
                $stored = $result->fetch_all(MYSQLI_ASSOC);
                return $stored;
            } else {
                // Handle query error
                echo "Error executing query: " . $this->con->error;
                return [];
            }
        }
    }

    //GET LIST OF ENROLLED
    public function getEnroll($row = null, $value = null)
    {
        // Get the active semester
        $activeSemesters = $this->checkSemStatus('semester');

        // Check if there are any active semesters
        if (empty($activeSemesters)) {
            return []; // Return an empty array if no active semester
        }

        // Prepare the active semester condition
        $activeSemesterCondition = "enroll.semester IN ('" . implode("','", $activeSemesters) . "')";

        if ($row != null && $value != null) {
            $sql = "SELECT
             `enroll`.`stu_lrn`,
             `student`.`stu_address`,
             `student`.`stu_contact`,
             `student`.`stu_gender`,
             `student`.`stu_email`,
             `student`.`stu_pob`, 
             `student`.`stu_dob`,    
             `student`.`father_name`,  
             `student`.`mother_name`,   
             `student`.`parent_contact`,   
             CONCAT(`student`.`stu_fname`, ' ', `student`.`stu_lname`) AS student,
             `enroll`.`section_code`,
             `section`.`section_code`,
             `section`.`strand_code`,
             `strand`.`strand_name`,
             `strand`.`strand_desc`,   -- Fetching the strand_name from the strand table
             `section`.`section_name`,
             `section`.`grade_lvl`,
             `section`.`teacher_id`,
             CONCAT(`teacher`.`teacher_fname`, ' ', `teacher`.`teacher_lname`) AS adviser,
             `enroll`.`semester` AS enroll_semester,
             `enroll`.`school_year` AS sy,
             `enroll`.`date_enroll`,
             `enroll`.`enroll_status`,
             `enroll`.`current_school`,
             `enroll`.`school_id`,
             `enroll`.`school_address`,
             `enroll`.`school_type`,
             `enroll`.`requirements_submit`
         FROM `enroll`
         INNER JOIN `student` ON `enroll`.`stu_lrn` = `student`.`stu_lrn`
         INNER JOIN `section` ON `enroll`.`section_code` = `section`.`section_code`
         INNER JOIN `strand` ON `section`.`strand_code` = `strand`.`strand_code`  -- Joining the strand table
         INNER JOIN `teacher` ON `section`.`teacher_id` = `teacher`.`teacher_id` -- Joining the teacher table
         WHERE `enroll`.`$row` = '$value' AND $activeSemesterCondition"; // Add semester condition

            $stored = ($this->con->query($sql))->fetch_assoc();
            return $stored;
        } else {
            $sql = "SELECT
             `enroll`.`stu_lrn`,
             `student`.`stu_address`,
             `student`.`stu_contact`,
             `student`.`stu_gender`,
             `student`.`stu_email`,
             `student`.`stu_pob`, 
             `student`.`stu_dob`,    
             `student`.`father_name`,  
             `student`.`mother_name`,   
             `student`.`parent_contact`, 
             CONCAT(`student`.`stu_fname`, ' ', `student`.`stu_lname`) AS student,
             `section`.`strand_code`,
             `strand`.`strand_name`,
             `strand`.`strand_desc`,  -- Fetching the strand_name from the strand table
             `section`.`section_name`,
             `section`.`grade_lvl`,
             `section`.`teacher_id`,
             CONCAT(`teacher`.`teacher_fname`, ' ', `teacher`.`teacher_lname`) AS adviser,
             `enroll`.`semester` AS enroll_semester,
             `enroll`.`school_year` AS sy,
             `enroll`.`date_enroll`,
             `enroll`.`enroll_status`,
             `enroll`.`current_school`,
             `enroll`.`school_id`,
             `enroll`.`school_address`,
             `enroll`.`school_type`,
             `enroll`.`requirements_submit`
         FROM `enroll`
         INNER JOIN `student` ON `enroll`.`stu_lrn` = `student`.`stu_lrn`
         INNER JOIN `section` ON `enroll`.`section_code` = `section`.`section_code`
         INNER JOIN `strand` ON `section`.`strand_code` = `strand`.`strand_code`  -- Joining the strand table
         INNER JOIN `teacher` ON `section`.`teacher_id` = `teacher`.`teacher_id` -- Joining the teacher table
         WHERE $activeSemesterCondition -- Add semester condition
         ORDER BY `student`.`stu_fname`";

            $stored = ($this->con->query($sql))->fetch_all(MYSQLI_ASSOC);
            return $stored;
        }
    }




    //GET LIST OF SCHEDULE
    public function getSchedule($row = null, $value = null)
    {
        // Get the active semester
        $activeSemesters = $this->checkSemStatus('semester');

        // Check if there are any active semesters
        if (empty($activeSemesters)) {
            return []; // Return an empty array if no active semester
        }

        // Prepare the active semester condition
        $activeSemesterCondition = "subject.sub_semester IN ('" . implode("','", $activeSemesters) . "')";

        if ($row != null && $value != null) {
            $sql = "SELECT
                `schedule`.`sched_id`,
                `schedule`.section_code,
                `section`.grade_lvl,
                `section`.section_name,
                `section`.`strand_code`,
                `strand`.`strand_name`,
                `strand`.`strand_desc`,
                `schedule`.sub_code,
                `subject`.sub_title,
                `subject`.sub_type,
                `subject`.sub_time,   
                `subject`.sub_semester AS semester,  
                `teacher`.teacher_id,                                                                  
                 CONCAT(`teacher`.`teacher_fname`, ' ', `teacher`.`teacher_lname`) AS teacher,
                `schedule`.`sched_day`,
                `schedule`.`sched_from`,
                `schedule`.`sched_to`                                                           
            FROM `schedule`
            INNER JOIN `section` ON `schedule`.`section_code` = `section`.`section_code`
            INNER JOIN `strand` ON `section`.`strand_code` = `strand`.`strand_code`  -- Joining the strand table
            INNER JOIN `subject` ON `schedule`.`sub_code` = `subject`.`sub_code`
            INNER JOIN `teacher` ON `schedule`.`teacher_id` = `teacher`.`teacher_id`
            WHERE `schedule`.`$row` = '$value' AND $activeSemesterCondition"; // Add semester condition

            $stored = ($this->con->query($sql))->fetch_assoc();
            return $stored;
        } else {
            $sql = "SELECT
                `schedule`.`sched_id`,
                `schedule`.section_code,
                `section`.grade_lvl,
                `section`.section_name,
                `section`.`strand_code`,
                `strand`.`strand_name`,
                `strand`.`strand_desc`,
                `schedule`.sub_code,
                `subject`.sub_title,
                `subject`.sub_type,
                `subject`.sub_time,   
                `subject`.sub_semester AS semester,  
                `teacher`.teacher_id,                                                                  
                 CONCAT(`teacher`.`teacher_fname`, ' ', `teacher`.`teacher_lname`) AS teacher,
                `schedule`.`sched_day`,
                `schedule`.`sched_from`,
                `schedule`.`sched_to`                                                           
            FROM `schedule`
            INNER JOIN `section` ON `schedule`.`section_code` = `section`.`section_code`
            INNER JOIN `strand` ON `section`.`strand_code` = `strand`.`strand_code`  -- Joining the strand table
            INNER JOIN `subject` ON `schedule`.`sub_code` = `subject`.`sub_code`
            INNER JOIN `teacher` ON `schedule`.`teacher_id` = `teacher`.`teacher_id` -- Joining the strand table
            WHERE $activeSemesterCondition -- Add semester condition
            ORDER BY `subject`.sub_title";

            $stored = ($this->con->query($sql))->fetch_all(MYSQLI_ASSOC);
            return $stored;
        }
    }


    function getSectionTitle($section_id)
    {
        // Prepare the SQL query to fetch the section title based on the section_id
        $query = "SELECT section_name FROM section WHERE section_code = ?";

        // Use a prepared statement to prevent SQL injection
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("s", $section_id);  // Bind the section_id parameter to the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Fetch the section title from the result
            $row = $result->fetch_assoc();

            // Return the section title
            return $row['section_name'];
        } else {
            // If no section is found, return null or an appropriate message
            return null;
        }
    }

    function getSubjectTitle($subject_id)
    {
        // Prepare the SQL query to fetch the section title based on the section_id
        $query = "SELECT sub_title FROM subject WHERE sub_code = ?";

        // Use a prepared statement to prevent SQL injection
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("s", $subject_id);  // Bind the section_id parameter to the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Fetch the section title from the result
            $row = $result->fetch_assoc();

            // Return the section title
            return $row['sub_title'];
        } else {
            // If no section is found, return null or an appropriate message
            return null;
        }
    }






    // GET TEACHER LIST    
    public function getTeacher($row = null, $value = null)
    {
        if ($row != null &&  $value != null) {

            $sql = "SELECT * FROM `teacher` WHERE `$row` = '$value'";
            $stored = ($this->con->query($sql))->fetch_assoc();
            return $stored;
        } else {

            $sql = "SELECT * FROM `teacher` ORDER BY `teacher_fname`";
            $stored = ($this->con->query($sql))->fetch_all(MYSQLI_ASSOC);

            return $stored;
        }
    }

    //GET STUDENT LIST

    public function getStudent($row = null, $value = null)
    {
        if ($row != null &&  $value != null) {

            $sql = "SELECT * FROM `student` WHERE `$row` = '$value'";
            $stored = ($this->con->query($sql))->fetch_assoc();
            return $stored;
        } else {

            $sql = "SELECT * FROM `student` ORDER BY `stu_lname` ASC";

            $stored = ($this->con->query($sql))->fetch_all(MYSQLI_ASSOC);

            return $stored;
        }
    }


    public function getSectionList($row = null, $value = null)
    {
        if ($row != null &&  $value != null) {

            $sql = "SELECT * FROM `section` WHERE `$row` = '$value'";
            $stored = ($this->con->query($sql))->fetch_assoc();
            return $stored;
        } else {

            $sql = "SELECT * FROM `section` ORDER BY `section_name`";

            $stored = ($this->con->query($sql))->fetch_all(MYSQLI_ASSOC);

            return $stored;
        }
    }




    // SEARCH TEACHER TABLE
    public function searchTeacher($value)
    {
        // Sanitize the input value
        $value = mysqli_real_escape_string($this->con, $value);

        // Corrected SQL query
        $sql = "SELECT * FROM `teacher` 
                WHERE `teacher_id` LIKE '$value%'
                OR `teacher_fname` LIKE '$value%' 
                OR `teacher_mname` LIKE '$value%' 
                OR `teacher_lname` LIKE '$value%'
                OR `status` LIKE '$value%'
                ORDER BY `teacher_id`, `teacher_fname`, `teacher_mname`, `teacher_lname`,`status`";

        // Execute the query
        $result = $this->con->query($sql);

        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    // Generic Insert Function
    //insert user and teacher/student with validation
    public function insert($table, $columns, $values)
    {
        // Ensure the number of columns matches the number of values
        if (count($columns) != count($values)) {
            throw new Exception("Column count does not match value count");
        }

        // Escape and format values
        for ($i = 0; $i < count($values); $i++) {
            $values[$i] = mysqli_real_escape_string($this->con, $values[$i]);

            if (is_string($values[$i])) {
                $values[$i] = "'" . $values[$i] . "'";
            }
        }

        // Build the SQL query for insertion
        $columns = implode(",", $columns);
        $values = implode(",", $values);
        $sql = "INSERT INTO `$table` ($columns) VALUES ($values)";

        // Debugging: Output the SQL query
        echo "SQL Query: $sql<br>";

        // Execute the query
        $result = $this->con->query($sql);

        if ($result) {
            return true;
        } else {
            throw new mysqli_sql_exception($this->con->error);
        }
    }



    //insert strand with validation
    public function insertStrand($table, $columns, $values)
    {
        // Ensure the number of columns matches the number of values
        if (count($columns) != count($values)) {
            throw new Exception("Column count does not match value count");
        }

        // Escape and format values
        for ($i = 0; $i < count($values); $i++) {
            $values[$i] = mysqli_real_escape_string($this->con, $values[$i]);

            if (is_string($values[$i])) {
                $values[$i] = "'" . $values[$i] . "'";
            }
        }

        // Build the SQL query for insertion
        $columns = implode(",", $columns);
        $values = implode(",", $values);
        $sql = "INSERT INTO `$table` ($columns) VALUES ($values)";

        // Debugging: Output the SQL query
        echo "SQL Query: $sql<br>";

        // Execute the query
        $result = $this->con->query($sql);

        if ($result) {
            return true;
        } else {
            throw new mysqli_sql_exception($this->con->error);
        }
    }

    //insert section with validation
    public function insertSection($table, $columns, $values)
    {
        // Ensure the number of columns matches the number of values
        if (count($columns) != count($values)) {
            throw new Exception("Column count does not match value count");
        }

        // Escape and format values
        for ($i = 0; $i < count($values); $i++) {
            $values[$i] = mysqli_real_escape_string($this->con, $values[$i]);

            if (is_string($values[$i])) {
                $values[$i] = "'" . $values[$i] . "'";
            }
        }

        // Build the SQL query for insertion
        $columns = implode(",", $columns);
        $values = implode(",", $values);
        $sql = "INSERT INTO `$table` ($columns) VALUES ($values)";

        // Debugging: Output the SQL query
        echo "SQL Query: $sql<br>";

        // Execute the query
        $result = $this->con->query($sql);

        if ($result) {
            return true;
        } else {
            throw new mysqli_sql_exception($this->con->error);
        }
    }


    // DELETEE FUNCTION
    public function delete($table, $row, $value) // REFER TO THE PRIMARY KEY TO DELETE
    {
        $sql = "DELETE FROM `$table` WHERE `$row` = '$value'";
        $result = $this->con->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }



    // Generic Update Function 
    // USERS | ENROLLMENT | STUDENT | TEACHER | SUBJECT | REGISTRAR| PRINCIPAL
    public function updateRecord($table, $row, $value, $whereColumn, $whereValue = null)
    {
        // Handle array values
        if (is_array($value)) {
            // Convert array to a comma-separated string for storage
            $value = implode(',', $value);
        }

        // Sanitize the value
        $value = mysqli_real_escape_string($this->con, $value);

        // Add quotes for string values
        if (is_string($value)) {
            $value = "'" . $value . "'";
        }

        // If multiple conditions are passed as an array
        if (is_array($whereColumn)) {
            $whereClause = [];
            foreach ($whereColumn as $column => $columnValue) {
                // Handle array values in the WHERE clause
                if (is_array($columnValue)) {
                    $columnValue = implode(',', $columnValue);
                }
                $columnValue = mysqli_real_escape_string($this->con, $columnValue);
                $whereClause[] = "`$column` = '$columnValue'";
            }
            $whereClauseString = implode(' AND ', $whereClause);
        } else {
            // Single condition case
            $whereColumn = mysqli_real_escape_string($this->con, $whereColumn);
            $whereValue = mysqli_real_escape_string($this->con, $whereValue);
            $whereClauseString = "`$whereColumn` = '$whereValue'";
        }

        // Construct the query dynamically
        $sql = "UPDATE `$table` SET `$row` = $value WHERE $whereClauseString";
        $result = $this->con->query($sql);

        // Return true on success, false on failure
        return $result ? true : false;
    }




    // UPDATE SECTION
    public function updateSection($row, $value, $where)
    {
        // Use prepared statements
        if ($row === 'strand_code') {
            // Check if strand_code exists in the strand table
            $checkQuery = $this->con->prepare("SELECT COUNT(*) FROM strand WHERE strand_code = ?");
            $checkQuery->bind_param("s", $value);
            $checkQuery->execute();
            $checkResult = $checkQuery->get_result();
            $count = $checkResult->fetch_row()[0];
            $checkQuery->close();

            if ($count == 0) {
                return false; // Strand code doesn't exist
            }
        }

        // Proceed with the update query
        $updateQuery = $this->con->prepare("UPDATE section SET $row = ? WHERE section_code = ?");
        $updateQuery->bind_param("ss", $value, $where);

        $result = $updateQuery->execute();
        $updateQuery->close();

        return $result;
    }




    // Function to execute a query and fetch a single row
    public function querySingle($sql, $params = [])
    {
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->con->error);
        }

        // Bind parameters if any
        if (!empty($params)) {
            $types = str_repeat("s", count($params)); // Assuming all params are strings; adjust type as needed
            $stmt->bind_param($types, ...$params);
        }

        // Execute the query
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute query: " . $stmt->error);
        }

        // Fetch a single row
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        return $row; // Return the row (or null if no rows found)
    }

    // =========================================== UPLOAD MODULE  ====================================================

    // // Fetch modules by subject handled by teacher
    // function getModuleOfStudentBySectionStrandAndGradelevel($stu_lrn, $sub_code, $strand_code, $grade_lvl)
    // {
    //     $activeSemesters = $this->checkSemStatus('semester');

    //     // Check if there are any active semesters
    //     if (empty($activeSemesters)) {
    //         return []; // Return an empty array if no active semester
    //     }

    //     // Prepare the active semester condition
    //     $activeSemesterCondition = "sub.sub_semester IN ('" . implode("','", $activeSemesters) . "')";

    //     try {
    //         // Prepare query to get the schedule, related section information, teacher, and module
    //         $sql = "
    //         SELECT 
    //             m.module_id, 
    //             m.file_name, 
    //             m.file_size, 
    //             m.formatted_size, 
    //             m.file_type, 
    //             m.date_uploaded AS uploaded_date,
    //             m.sched_id,
    //             sec.section_code, 
    //             sec.grade_lvl, 
    //             st.strand_code, 
    //             st.strand_name, 
    //             sub.sub_code,
    //             sub.sub_title,
    //             sub.sub_semester,
    //             sched.teacher_id,
    //             t.teacher_fname, 
    //             t.teacher_lname
    //         FROM 
    //             MODULE m
    //         INNER JOIN  
    //             SCHEDULE sched ON sched.sched_id = m.sched_id
    //         INNER JOIN  
    //             ENROLL en ON en.section_code = sched.section_code
    //         INNER JOIN  
    //             SECTION sec ON sec.section_code = sched.section_code
    //         INNER JOIN  
    //             STRAND st ON sec.strand_code = st.strand_code
    //         INNER JOIN  
    //             SUBJECT sub ON sub.sub_code = sched.sub_code
    //         INNER JOIN  
    //             TEACHER t ON t.teacher_id = sched.teacher_id
    //         WHERE 
    //             en.stu_lrn = ?
    //             AND sec.grade_lvl = ? 
    //             AND sec.strand_code = ? 
    //             AND sub.sub_code = ?
    //             AND $activeSemesterCondition
    //     ";

    //         // Prepare the query
    //         $stmt = $this->con->prepare($sql);
    //         if (!$stmt) {
    //             throw new Exception("Failed to prepare the SQL statement: " . $this->con->error);
    //         }

    //         // Bind parameters
    //         $stmt->bind_param("ssss", $stu_lrn, $grade_lvl, $strand_code, $sub_code);

    //         // Execute the statement
    //         $stmt->execute();
    //         $result = $stmt->get_result();

    //         // Fetch all the module data
    //         $modules = [];
    //         while ($row = $result->fetch_assoc()) {
    //             $modules[] = $row;
    //         }

    //         // Free resources
    //         $stmt->close();

    //         return $modules ?: []; // Return an empty array if no data
    //     } catch (Exception $e) {
    //         // Log the error message
    //         error_log("Error fetching student modules: " . $e->getMessage());
    //         return []; // Return an empty array on error
    //     }
    // }


    // Fetch modules by subject handled by teacher
    function getModuleOfStudentByStrandAndGradelevel($sub_code, $strand_code, $grade_lvl)
    {
        $activeSemesters = $this->checkSemStatus('semester');

        // Check if there are any active semesters
        if (empty($activeSemesters)) {
            return []; // Return an empty array if no active semester
        }

        // Prepare the active semester condition
        $activeSemesterCondition = "sub.sub_semester IN ('" . implode("','", $activeSemesters) . "')";

        try {
            // Updated query to relax section condition
            $sql = "
            SELECT 
                m.module_id, 
                m.file_name, 
                m.file_size, 
                m.formatted_size, 
                m.file_type, 
                m.date_uploaded AS uploaded_date,
                sec.section_code, 
                sec.grade_lvl, 
                st.strand_code, 
                st.strand_name, 
                sub.sub_code,
                sub.sub_title,
                sub.sub_semester,
                sched.teacher_id,
                t.teacher_fname, 
                t.teacher_lname
            FROM 
                MODULE m
            INNER JOIN  
                SCHEDULE sched ON sched.sched_id = m.sched_id
            INNER JOIN  
                SECTION sec ON sec.section_code = sched.section_code
            INNER JOIN  
                STRAND st ON sec.strand_code = st.strand_code
            INNER JOIN  
                SUBJECT sub ON sub.sub_code = sched.sub_code
            INNER JOIN  
                TEACHER t ON t.teacher_id = sched.teacher_id
            WHERE 
                st.strand_code = ?
                AND sec.grade_lvl = ?
                AND sub.sub_code = ?
                AND $activeSemesterCondition
            ";

            // Prepare the query
            $stmt = $this->con->prepare($sql);
            if (!$stmt) {
                throw new Exception("Failed to prepare the SQL statement: " . $this->con->error);
            }

            // Bind parameters
            $stmt->bind_param("sss", $strand_code, $grade_lvl, $sub_code);

            // Execute the statement
            $stmt->execute();
            $result = $stmt->get_result();

            // Fetch all the module data
            $modules = [];
            while ($row = $result->fetch_assoc()) {
                $modules[] = $row;
            }

            // Free resources
            $stmt->close();

            return $modules ?: []; // Return an empty array if no data
        } catch (Exception $e) {
            // Log the error message
            error_log("Error fetching student modules: " . $e->getMessage());
            return []; // Return an empty array on error
        }
    }



    // Helper function to format file size
    public function formatFileSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, 2) . ' ' . $units[$pow];
    }

    // Function to validate file extension
    public function getFileExtension($filename)
    {
        return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    }

    //   GET ALL MODULE UPLOADED BY STUDENTS 
    public function getModulesUploadedByStudents($teacherId)
    {
        $sql = "
        SELECT 
            ma.answer_id, 
            ma.module_id, 
            ma.stu_lrn, 
            ma.file_name AS student_file_name, 
            ma.file_size AS student_file_size, 
            ma.formatted_size AS student_formatted_size, 
            ma.file_type AS student_file_type, 
            ma.date_uploaded AS student_date_uploaded,
            s.stu_fname, 
            s.stu_lname,
            m.file_name AS module_file_name, 
            sch.sub_code,
            sub.sub_title
        FROM module_answer ma
        INNER JOIN student s ON ma.stu_lrn = s.stu_lrn
        INNER JOIN module m ON ma.module_id = m.module_id
        INNER JOIN schedule sch ON m.sched_id = sch.sched_id
        INNER JOIN subject sub ON sch.sub_code = sub.sub_code
        WHERE sch.teacher_id = ?
        ORDER BY ma.date_uploaded DESC";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $teacherId);  // Assuming `teacherId` is a string
        $stmt->execute();
        $result = $stmt->get_result();

        $modules = [];
        while ($row = $result->fetch_assoc()) {
            $modules[] = [
                'answer_id' => $row['answer_id'],
                'module_id' => $row['module_id'],
                'stu_lrn' => $row['stu_lrn'],
                'student_file_name' => $row['student_file_name'],
                'student_file_size' => $row['student_file_size'],
                'student_formatted_size' => $row['student_formatted_size'],
                'student_file_type' => $row['student_file_type'],
                'student_date_uploaded' => $row['student_date_uploaded'],
                'stu_fname' => $row['stu_fname'],
                'stu_lname' => $row['stu_lname'],
                'module_file_name' => $row['module_file_name'],
                'sub_code' => $row['sub_code'],
                'sub_title' => $row['sub_title'],
            ];
        }

        return $modules;
    }



    // =========================================== EXAM FUNCTION ====================================================

    // GET ALL EXAM CREATED BY TEACHER HANDLED SUBJECT IN EVERY same strand and grade lvl
    // function getAllExamCreatedByTeacher($teacherId, $subjectId, $sectionCode)
    // {
    //     try {
    //         $sql = "
    //             SELECT 
    //                 e.exam_id,
    //                 e.exam_title,
    //                 e.exam_desc,
    //                 e.exam_type,
    //                 e.exam_quarter,
    //                 e.exam_duration,
    //                 e.exam_items,
    //                 e.exam_date,
    //                 sec.section_code,
    //                 sec.section_name,
    //                 sec.grade_lvl,
    //                 str.strand_code,
    //                 sub.sub_code,
    //                 sub.sub_semester,
    //                 sub.sub_title,
    //                 sched.sched_id,
    //                 -- Fetch multiple-choice questions
    //                  (SELECT JSON_ARRAYAGG(
    //                     JSON_OBJECT(
    //                         'mul_id', mul_id,
    //                         'question', mul_question,
    //                         'A', choice_a,
    //                         'B', choice_b,
    //                         'C', choice_c,
    //                         'D', choice_d,
    //                         'correct', is_correct
    //                     )
    //                 ) FROM exam_multiple WHERE exam_id = e.exam_id) AS multiple_questions,

    //                  -- Fetch enumeration questions
    //                 (SELECT JSON_ARRAYAGG(
    //                     JSON_OBJECT(
    //                         'enum_id', enum_id,
    //                         'question', enum_question,
    //                         'answers', enum_answer
    //                     )
    //                 ) FROM exam_enumeration WHERE exam_id = e.exam_id) AS enumeration_questions,

    //                 -- Fetch essay questions
    //                 (SELECT JSON_ARRAYAGG( 
    //                     JSON_OBJECT(
    //                         'essay_id', essay_id,
    //                         'question', essay_question
    //                     )
    //                 ) FROM exam_essay WHERE exam_id = e.exam_id) AS essay_questions,

    //                 -- Fetch true/false questions
    //                 (SELECT JSON_ARRAYAGG(
    //                             JSON_OBJECT(
    //                                 'tf_id', tf_id,
    //                                 'question', tf_question,
    //                                 'correct', tf_answer
    //                             )
    //                         ) 
    //                 FROM exam_tf 
    //                 WHERE exam_id = e.exam_id) AS tf_questions
    //             FROM 
    //                 exam e
    //             INNER JOIN 
    //                 schedule sched ON e.sched_id = sched.sched_id
    //             INNER JOIN 
    //                 section sec ON sched.section_code = sec.section_code
    //             INNER JOIN 
    //                 strand str ON sec.strand_code = str.strand_code
    //             INNER JOIN 
    //                 subject sub ON sched.sub_code = sub.sub_code
    //             WHERE 
    //                 sched.teacher_id = ?
    //                 AND sched.sub_code = ?
    //                 AND sched.section_code = ?
    //             ORDER BY 
    //                 e.exam_date desc, e.exam_title
    //         ";

    //         // Prepare the query
    //         $stmt = $this->con->prepare($sql);
    //         if (!$stmt) {
    //             throw new Exception("Failed to prepare the SQL statement: " . $this->con->error);
    //         }
    //         // Bind parameters
    //         $stmt->bind_param("sss", $teacherId, $subjectId, $sectionCode);
    //         // Execute the statement
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //         // Fetch all matching rows
    //         $exams = $result->fetch_all(MYSQLI_ASSOC);
    //         // Free resources
    //         $stmt->close();
    //         return $exams;
    //     } catch (Exception $e) {
    //         // Log the error message
    //         error_log("Error fetching exams created by teacher: " . $e->getMessage());
    //         return [];
    //     }
    // }

    function getAllExamCreatedByTeacher($teacherId, $subjectId, $sectionCode)
    {
        try {
            // Get the active semester
            $activeSemesters = $this->checkSemStatus('semester');

            // Check if there are any active semesters
            if (empty($activeSemesters)) {
                return []; // Return an empty array if no active semester
            }

            // Prepare the active semester condition
            $activeSemesterCondition = "sub.sub_semester IN ('" . implode("','", $activeSemesters) . "')";

            // Query to fetch exam data and join it with related question tables
            $sql = "
                SELECT 
                    e.exam_id,
                    e.exam_title,
                    e.exam_desc,
                    e.exam_type,
                    e.exam_quarter,
                    e.exam_duration,
                    e.exam_items,
                    e.exam_date,
                    sec.section_code,
                    sec.section_name,
                    sec.grade_lvl,
                    str.strand_code,
                    sub.sub_code,
                    sub.sub_semester,
                    sub.sub_title,
                    sched.sched_id,

                    -- Multiple-choice question fields
                    em.mul_id AS mul_id,
                    em.mul_question AS mul_question,
                    em.choice_a AS choice_a,
                    em.choice_b AS choice_b,
                    em.choice_c AS choice_c,
                    em.choice_d AS choice_d,
                    em.is_correct AS mul_correct,

                    -- Enumeration question fields
                    en.enum_id AS enum_id,
                    en.enum_question AS enum_question,
                    en.enum_answer AS enum_answer,

                    -- Essay question fields
                    ee.essay_id AS essay_id,
                    ee.essay_question AS essay_question,

                    -- True/False question fields
                    tf.tf_id AS tf_id,
                    tf.tf_question AS tf_question,
                    tf.tf_answer AS tf_correct

                FROM 
                    exam e
                INNER JOIN 
                    schedule sched ON e.sched_id = sched.sched_id
                INNER JOIN 
                    section sec ON sched.section_code = sec.section_code
                INNER JOIN 
                    strand str ON sec.strand_code = str.strand_code
                INNER JOIN 
                    subject sub ON sched.sub_code = sub.sub_code

                -- Left join question tables
                LEFT JOIN 
                    exam_multiple em ON e.exam_id = em.exam_id
                LEFT JOIN 
                    exam_enumeration en ON e.exam_id = en.exam_id
                LEFT JOIN 
                    exam_essay ee ON e.exam_id = ee.exam_id
                LEFT JOIN 
                    exam_tf tf ON e.exam_id = tf.exam_id

                WHERE 
                    sched.teacher_id = ?
                    AND sched.sub_code = ?
                    AND sched.section_code = ?
                    AND $activeSemesterCondition 
                ORDER BY 
                    e.exam_date DESC, e.exam_title
            ";

            // Prepare the query
            $stmt = $this->con->prepare($sql);
            if (!$stmt) {
                throw new Exception("Failed to prepare the SQL statement: " . $this->con->error);
            }

            // Bind parameters
            $stmt->bind_param("sss", $teacherId, $subjectId, $sectionCode);

            // Execute the statement
            $stmt->execute();

            // Fetch raw result set
            $result = $stmt->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            // Organize the result set into a structured format
            $exams = [];
            foreach ($rows as $row) {
                $examId = $row['exam_id'];
                if (!isset($exams[$examId])) {
                    $exams[$examId] = [
                        'exam_id' => $row['exam_id'],
                        'exam_title' => $row['exam_title'],
                        'exam_desc' => $row['exam_desc'],
                        'exam_type' => $row['exam_type'],
                        'exam_quarter' => $row['exam_quarter'],
                        'exam_duration' => $row['exam_duration'],
                        'exam_items' => $row['exam_items'],
                        'exam_date' => $row['exam_date'],
                        'section_code' => $row['section_code'],
                        'section_name' => $row['section_name'],
                        'grade_lvl' => $row['grade_lvl'],
                        'strand_code' => $row['strand_code'],
                        'sub_code' => $row['sub_code'],
                        'sub_semester' => $row['sub_semester'],
                        'sub_title' => $row['sub_title'],
                        'sched_id' => $row['sched_id'],
                        'multiple_questions' => [],
                        'enumeration_questions' => [],
                        'essay_questions' => [],
                        'tf_questions' => [],
                    ];
                }

                // Add multiple-choice question
                if (!empty($row['mul_id'])) {
                    $exams[$examId]['multiple_questions'][] = [
                        'mul_id' => $row['mul_id'],
                        'question' => $row['mul_question'],
                        'A' => $row['choice_a'],
                        'B' => $row['choice_b'],
                        'C' => $row['choice_c'],
                        'D' => $row['choice_d'],
                        'correct' => $row['mul_correct'],
                    ];
                }

                // Add enumeration question
                if (!empty($row['enum_id'])) {
                    $exams[$examId]['enumeration_questions'][] = [
                        'enum_id' => $row['enum_id'],
                        'question' => $row['enum_question'],
                        'answers' => $row['enum_answer'],
                    ];
                }

                // Add essay question
                if (!empty($row['essay_id'])) {
                    $exams[$examId]['essay_questions'][] = [
                        'essay_id' => $row['essay_id'],
                        'question' => $row['essay_question'],
                    ];
                }

                // Add true/false question
                if (!empty($row['tf_id'])) {
                    $exams[$examId]['tf_questions'][] = [
                        'tf_id' => $row['tf_id'],
                        'question' => $row['tf_question'],
                        'correct' => $row['tf_correct'],
                    ];
                }
            }

            // Reset indexes
            $stmt->close();
            return array_values($exams);
        } catch (Exception $e) {
            // Log the error message
            error_log("Error fetching exams created by teacher: " . $e->getMessage());
            return [];
        }
    }

    public function updateMultipleRecord($table, $row, $value, $whereColumn, $whereValue)
    {
        $stmt = $this->con->prepare("UPDATE `$table` SET `$row` = ? WHERE `$whereColumn` = ?");
        $stmt->bind_param("ss", $value, $whereValue);
        $stmt->execute();
        $stmt->close();
        return $stmt;
    }

    public function updateEnumerationRecord($enum_id, $question, $answer)
    {
        $stmt = $this->con->prepare("UPDATE `exam_enumeration` SET `enum_question` = ?, `enum_answer` = ? WHERE `enum_id` = ?");
        $stmt->bind_param("ssi", $question, $answer, $enum_id);
        $stmt->execute();
        $stmt->close();
        return $stmt;
    }

    public function updateEssayRecord($essay_id, $question)
    {
        $stmt = $this->con->prepare("UPDATE `exam_essay` SET `essay_question` = ? WHERE `essay_id` = ?");
        $stmt->bind_param("si", $question, $essay_id);
        $stmt->execute();
        $stmt->close();
        return $stmt;
    }

    public function updateTrueFalseRecord($tf_id, $question, $answer)
    {
        $stmt = $this->con->prepare("UPDATE `exam_tf` SET `tf_question` = ?, `tf_answer` = ? WHERE `tf_id` = ?");
        $stmt->bind_param("ssi", $question, $answer, $tf_id);
        $stmt->execute();
        $stmt->close();
        return $stmt;
    }


    // =========================================== QUIZ FUNCTION ====================================================

    // GET ALL QUIZ CREATED BY TEACHER HANDLED SUBJECT IN EVERY same strand and grade lvl
    function getAllQuizCreatedByTeacher($teacherId, $subjectId, $sectionCode)
    {
        try {
            // Get the active semester
            $activeSemesters = $this->checkSemStatus('semester');

            // Check if there are any active semesters
            if (empty($activeSemesters)) {
                return []; // Return an empty array if no active semester
            }

            // Prepare the active semester condition
            $activeSemesterCondition = "sub.sub_semester IN ('" . implode("','", $activeSemesters) . "')";


            $sql = "
                SELECT 
                    q.quiz_id,
                    q.quiz_title,
                    q.quiz_desc,
                    q.quiz_type,
                    q.quiz_quarter,
                    q.quiz_duration,
                    q.quiz_items,
                    q.quiz_date,
                    sec.section_code,
                    sec.section_name,
                    sec.grade_lvl,
                    str.strand_code,
                    sub.sub_code,
                    sub.sub_semester,
                    sub.sub_title,
                    sched.sched_id,


                    -- Multiple-choice question fields
                    em.q_mul_id AS q_mul_id,
                    em.q_mul_question AS q_mul_question,
                    em.q_choice_a AS q_choice_a,
                    em.q_choice_b AS q_choice_b,
                    em.q_choice_c AS q_choice_c,
                    em.q_choice_d AS q_choice_d,
                    em.is_correct AS mul_correct,

                    -- Enumeration question fields
                    en.q_enum_id AS q_enum_id,
                    en.q_enum_question AS q_enum_question,
                    en.q_enum_answer AS q_enum_answer,

                  -- Essay question fields
                    ee.q_essay_id AS q_essay_id,
                    ee.q_essay_question AS q_essay_question,

                    -- True/False question fields
                    tf.q_tf_id AS q_tf_id,
                    tf.q_tf_question AS q_tf_question,
                    tf.q_tf_answer AS q_tf_correct
                FROM 
                    quiz q
                INNER JOIN 
                    schedule sched ON q.sched_id = sched.sched_id
                INNER JOIN 
                    section sec ON sched.section_code = sec.section_code
                INNER JOIN 
                    strand str ON sec.strand_code = str.strand_code
                INNER JOIN 
                    subject sub ON sched.sub_code = sub.sub_code

                -- Left join question tables
                LEFT JOIN 
                    quiz_multiple em ON q.quiz_id = em.quiz_id
                LEFT JOIN 
                    quiz_enumeration en ON q.quiz_id = en.quiz_id
                LEFT JOIN 
                    quiz_essay ee ON q.quiz_id = ee.quiz_id
                LEFT JOIN 
                    quiz_tf tf ON q.quiz_id = tf.quiz_id

                WHERE 
                    sched.teacher_id = ?
                    AND sched.sub_code = ?
                    AND sched.section_code = ?
                    AND $activeSemesterCondition
                ORDER BY 
                    q.quiz_id ASC
            ";

            // Prepare the query
            $stmt = $this->con->prepare($sql);
            if (!$stmt) {
                throw new Exception("Failed to prepare the SQL statement: " . $this->con->error);
            }
            // Bind parameters
            $stmt->bind_param("sss", $teacherId, $subjectId, $sectionCode);
            // Execute the statement
            $stmt->execute();
            $result = $stmt->get_result();
            // Fetch all matching rows
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            // Organize the result set into a structured format
            $quizzes = [];
            foreach ($rows as $row) {
                $quizId = $row['quiz_id'];
                if (!isset($quizzes[$quizId])) {
                    $quizzes[$quizId] = [
                        'quiz_id' => $row['quiz_id'],
                        'quiz_title' => $row['quiz_title'],
                        'quiz_desc' => $row['quiz_desc'],
                        'quiz_type' => $row['quiz_type'],
                        'quiz_quarter' => $row['quiz_quarter'],
                        'quiz_duration' => $row['quiz_duration'],
                        'quiz_items' => $row['quiz_items'],
                        'quiz_date' => $row['quiz_date'],
                        'section_code' => $row['section_code'],
                        'section_name' => $row['section_name'],
                        'grade_lvl' => $row['grade_lvl'],
                        'strand_code' => $row['strand_code'],
                        'sub_code' => $row['sub_code'],
                        'sub_semester' => $row['sub_semester'],
                        'sub_title' => $row['sub_title'],
                        'sched_id' => $row['sched_id'],
                        'quiz_multiple_questions' => [],
                        'quiz_enumeration_questions' => [],
                        'quiz_essay_questions' => [],
                        'quiz_tf_questions' => [],
                    ];
                }

                // Add multiple-choice question
                if (!empty($row['q_mul_id'])) {
                    $quizzes[$quizId]['quiz_multiple_questions'][] = [
                        'q_mul_id' => $row['q_mul_id'],
                        'question' => $row['q_mul_question'],
                        'A' => $row['q_choice_a'],
                        'B' => $row['q_choice_b'],
                        'C' => $row['q_choice_c'],
                        'D' => $row['q_choice_d'],
                        'correct' => $row['mul_correct'],
                    ];
                }

                // Add enumeration question
                if (!empty($row['q_enum_id'])) {
                    $quizzes[$quizId]['quiz_enumeration_questions'][] = [
                        'q_enum_id' => $row['q_enum_id'],
                        'question' => $row['q_enum_question'],
                        'answers' => $row['q_enum_answer'],
                    ];
                }

                // Add essay question
                if (!empty($row['q_essay_id'])) {
                    $quizzes[$quizId]['quiz_essay_questions'][] = [
                        'q_essay_id' => $row['q_essay_id'],
                        'question' => $row['q_essay_question'],
                    ];
                }

                // Add true/false question
                if (!empty($row['q_tf_id'])) {
                    $quizzes[$quizId]['quiz_tf_questions'][] = [
                        'q_tf_id' => $row['q_tf_id'],
                        'question' => $row['q_tf_question'],
                        'correct' => $row['q_tf_correct'],
                    ];
                }
            }

            // Reset indexes
            $stmt->close();
            return array_values($quizzes);
        } catch (Exception $e) {
            // Log the error message
            error_log("Error fetching quizzes created by teacher: " . $e->getMessage());
            return [];
        }
    }


    public function updateQuizMultipleRecord($table, $row, $value, $whereColumn, $whereValue)
    {
        $stmt = $this->con->prepare("UPDATE `$table` SET `$row` = ? WHERE `$whereColumn` = ?");
        $stmt->bind_param("ss", $value, $whereValue);
        $stmt->execute();
        $stmt->close();
        return $stmt;
    }

    public function updateQuizEnumerationRecord($enum_id, $question, $answer)
    {
        $stmt = $this->con->prepare("UPDATE `quiz_enumeration` SET `q_enum_question` = ?, `q_enum_answer` = ? WHERE `q_enum_id` = ?");
        $stmt->bind_param("ssi", $question, $answer, $enum_id);
        $stmt->execute();
        $stmt->close();
        return $stmt;
    }

    public function updateQuizEssayRecord($essay_id, $question)
    {
        $stmt = $this->con->prepare("UPDATE `quiz_essay` SET `q_essay_question` = ? WHERE `q_essay_id` = ?");
        $stmt->bind_param("si", $question, $essay_id);
        $stmt->execute();
        $stmt->close();
        return $stmt;
    }

    public function updateQuizTrueFalseRecord($tf_id, $question, $answer)
    {
        $stmt = $this->con->prepare("UPDATE `quiz_tf` SET `q_tf_question` = ?, `q_tf_answer` = ? WHERE `q_tf_id` = ?");
        $stmt->bind_param("ssi", $question, $answer, $tf_id);
        $stmt->execute();
        $stmt->close();
        return $stmt;
    }
}
