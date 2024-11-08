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
    

    function begin_transaction($pdo) {
        try {
            $pdo->beginTransaction();
            echo '<div class="alert alert-success" style="font-size: small;">Transaction started successfully.</div>';
        } catch (PDOException $e) {
            echo '<div class="alert alert-warning" style="font-size: small;">Failed to start transaction: ' . $e->getMessage() . '</div>';
        }
    }



    // RANDOM ADMIN ID

    public function generateAdminID()
    {
        $num = "1325476980";
        $rand = "";

        for ($i = 0; $i < 4; $i++) {
            if ($i == 0) {
                $rand = "PRIN-";
            }
            $rand = $rand . $num[rand(0, strlen($num) - 1)];
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



    /*GEENERATE PASSWORD  */

    public function generateStudentPassword($dob)
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

    public function generateFacultyUsername($teacher_id)
    {
        try {
            // Fetch teacher info using the method in the class
            $teacher = $this->getTeacherInfo($teacher_id);

            if ($teacher) {
                // Remove spaces in teacher's name and concatenate to form the username
                $teacher_name = str_replace(' ', '', $teacher['teacher_name']); // Ensure no spaces
                $username = 'LMS-' . $teacher_name;

                // Return the generated username
                return $username;
            } else {
                throw new Exception("Teacher not found.");
            }
        } catch (Exception $e) {
            // Handle exceptions and return the error message
            return 'Error: ' . $e->getMessage();
        }
    }

    //RANDOM USER ID
    public function generateUserID()
    {
        $num = "24683691";
        $rand = "";

        for ($i = 0; $i < 4; $i++) {
            if ($i == 0) {
                $rand = "USER-";
            }
            $rand = $rand . $num[rand(0, strlen($num) - 1)];
        }
        return $rand;
    }


    //RANDOM STRAND CODE
    public function generateStrandCode()
    {
        $num = "123456789";
        $rand = "";

        for ($i = 0; $i < 4; $i++) {
            if ($i == 0) {
                $rand = "STRAND-";
            }
            $rand = $rand . $num[rand(0, strlen($num) - 1)];
        }
        return $rand;
    }

    //RANDOM SECTION CODE
    public function generateSectionCode()
    {
        $num = "987654321";
        $rand = "";

        for ($i = 0; $i < 4; $i++) {
            if ($i == 0) {
                $rand = "SECTION-";
            }
            $rand = $rand . $num[rand(0, strlen($num) - 1)];
        }
        return $rand;
    }

    public function generateSubjectCode()
    {
        $num = "987654321";
        $rand = "";

        for ($i = 0; $i < 4; $i++) {
            if ($i == 0) {
                $rand = "SUB-";
            }
            $rand = $rand . $num[rand(0, strlen($num) - 1)];
        }
        return $rand;
    }



    //GET SCHOOL INFORMATIONM
    public function getSchool()
    {
        $sql = "SELECT * FROM `SCHOOL`";
        $stored = ($this->con->query($sql))->fetch_assoc();
        return $stored;
    }

    //GET ADMIN INFORMATIONM
    public function getAdminInfo()
    {
        $sql = "SELECT * FROM `PRINCIPAL`";
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

    public function getAccountStudent($id)
    {
        $sql = "SELECT * FROM `users` WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    public function getAccountTeacher($id)
    {
        $sql = "SELECT * FROM `users` WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    public function getTeacherInfo($teacher_id)
    {
        $sql = "SELECT * FROM `teacher` WHERE teacher_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $teacher_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }
    //GET TEACHER SECTION HANDLED by id
    public function getTeacherSectionHandled($teacher_id)
    {
        $sql = "SELECT * FROM `section` WHERE teacher_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $teacher_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }
    //GET TEACHER  SUBJECT HANDLED by id
    public function getTeacherSubjectHandled($teacher_id)
    {
        $sql = "SELECT subject.sub_title, subject.strand_code, strand.strand_name , subject.sub_gradelvl
                FROM subject 
                JOIN strand ON subject.strand_code = strand.strand_code 
                WHERE subject.teacher_id = ?";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $teacher_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array
        return $result;
    }

    //GET STUDENT SECTION HANDLED by id
    public function getStudentSection($student_id)
    {
        $sql = "SELECT enroll.semester, enroll.school_year, enroll.section_code, section.section_name, section.grade_lvl
                FROM enroll 
                JOIN section ON enroll.section_code = section.section_code
                WHERE enroll.stu_lrn = ?";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array
        return $result;
    }
    //GET STUDENT STRAND NAME by id
    public function getStudentStrandName($student_id)
    {
        $sql = "SELECT section.strand_code, strand.strand_name
            FROM enroll
            JOIN section ON enroll.section_code = section.section_code
            JOIN strand ON section.strand_code = strand.strand_code
            WHERE enroll.stu_lrn = ?";

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
        $sql = "UPDATE `SCHOOL` SET `$column` = '$value'";
        $result = $this->con->query($sql);
        return $result;
    }


    public function updateAdminInfo($data)
    {
        $setClause = [];
        foreach ($data as $column => $value) {
            $escapedValue = mysqli_real_escape_string($this->con, $value);
            $setClause[] = "`$column` = '$escapedValue'";
        }

        $setString = implode(", ", $setClause);
        $sql = "UPDATE `PRINCIPAL` SET $setString"; // You might want to add a WHERE clause to specify which record to update
        $result = $this->con->query($sql);
        return $result;
    }

    // UPDATE ACCOUNT STUDENT PROFILE 

    public function updateStudentInfo($data, $studentID)
    {
        $setClause = [];
        foreach ($data as $column => $value) {
            $escapedValue = mysqli_real_escape_string($this->con, $value);
            $setClause[] = "`$column` = '$escapedValue'";
        }

        $setString = implode(", ", $setClause);

        // Ensure the WHERE clause uses the correct student identifier
        $sql = "UPDATE `student` SET $setString WHERE `stu_lrn` = ?";

        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $this->con->error);
        }

        $stmt->bind_param("s", $studentID);  // Assuming stu_lrn is an integer
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            throw new Exception("No records updated. Check if the student ID is valid.");
        }

        $stmt->close();
        return true;
    }

    // UPDATE ACCOUNT TEACHER PROFILE 
    public function updateTeacherInfo($data, $teacherID)
    {
        $setClause = [];
        foreach ($data as $column => $value) {
            $escapedValue = mysqli_real_escape_string($this->con, $value);
            $setClause[] = "`$column` = '$escapedValue'";
        }

        $setString = implode(", ", $setClause);

        // Ensure the WHERE clause uses the correct teacher identifier
        $sql = "UPDATE `teacher` SET $setString WHERE `teacher_id` = ?";

        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $this->con->error);
        }

        $stmt->bind_param("s", $teacherID);  // Assuming stu_lrn is an integer
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            throw new Exception("No records updated. Check if the teacher ID is valid.");
        }

        $stmt->close();
        return true;
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






    // GET USER INDIVIDUAL CREDENTIAL 
    function getCredential($row, $value)
    {
        $sql = "SELECT * FROM `users` WHERE `$row` = '$value'";
        $stored = ($this->con->query($sql))->fetch_assoc();
        return $stored;
    }

    // GET STUDENT CREDENTIAL 
    function getStudentCredential($row, $value)
    {
        $sql = "SELECT * FROM `student` WHERE `$row` = '$value'";
        $stored = ($this->con->query($sql))->fetch_assoc();
        return $stored;
    }


    function getStudentEnrolled($row, $value)
    {
        $sql = "SELECT * FROM `enroll` WHERE `$row` = '$value'";
        $stored = ($this->con->query($sql))->fetch_assoc();
        return $stored;
    }

    // GET STUDENT ACCOUNTS
    // GET STUDENT ACCOUNTS
    public function getStudentAccounts($role = 'STUDENT')
    {
        // Prepare the query to get only users with the specified role and their corresponding student info
        $stmt = $this->con->prepare("
        SELECT u.id, u.username, u.password, u.role, u.date_added, s.stu_dob 
        FROM `users` u 
        JOIN `student` s ON u.username = s.stu_lrn 
        WHERE u.role = ? 
        ORDER BY u.id
    ");
        $stmt->bind_param('s', $role); // 's' denotes the type (string)
        $stmt->execute();
        $stored = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $stored;
    }



    //GET ADMIN CREDENTIAL
    function getAdminCredential($row, $value)
    {
        $sql = "SELECT * FROM `principal` WHERE `$row` = '$value'";
        $stored = ($this->con->query($sql))->fetch_assoc();
        return $stored;
    }



    // GET TEACHER CREDENTIAL 
    function getTeacherCredential($row, $value)
    {
        $sql = "SELECT * FROM `teacher` WHERE `$row` = '$value'";
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



    public function checkFacultyExist($firstname, $lastname, $excludeID)
    {
        $sql = "SELECT * FROM teacher WHERE teacher_fname = ? AND teacher_lname = ? AND teacher_id != ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssi", $firstname, $lastname, $excludeID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Return the first row if exists
    }

    public function checkStudentExist($firstname, $lastname, $excludeID)
    {
        $sql = "SELECT * FROM student WHERE stu_fname = ? AND stu_lname = ? AND stu_lrn != ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssi", $firstname, $lastname, $excludeID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Return the first row if exists
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



    // // INSERT INTO TABLE SEMESTER
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




    //  GET TEACHER LIST 
    public function getUsers($row = null, $value = null, $limit =15, $offset = 0)
    {
        // Parameterized query to prevent SQL injection
        if ($row != null && $value != null) {
            $stmt = $this->con->prepare("SELECT * FROM `users` WHERE `$row` = ?");
            $stmt->bind_param('s', $value); // 's' denotes the type (string)
            $stmt->execute();
            $stored = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $stored;
        } else {
            // Adjust the limit and offset to ensure at least 8 records are fetched
            $stmt = $this->con->prepare("SELECT * FROM `users` ORDER BY `id` LIMIT ? OFFSET ?");
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

        // Corrected SQL query
        $sql = "SELECT * FROM `users` 
                    WHERE `username` LIKE '$value%' 
                    OR `role` LIKE '$value%' 
                    OR `date_added` LIKE '$value%'
                    ORDER BY `username`, `role`, `date_added`";

        // Execute the query
        $result = $this->con->query($sql);

        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
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



    public function getDescStrand($row = null, $value = null)
    {
        if ($row != null &&  $value != null) {

            $sql = "SELECT * FROM `strand` WHERE `$row` = '$value'";
            $stored = ($this->con->query($sql))->fetch_assoc();
            return $stored;
        } else {

            $sql = "SELECT * FROM `strand` ORDER BY `strand_desc`";
            $stored = ($this->con->query($sql))->fetch_all(MYSQLI_ASSOC);

            return $stored;
        }
    }


    //  GET GRADELEVEL LIST 
    public function getStrandList($row = null, $value = null)
    {
        if ($row != null &&  $value != null) {

            $sql = "SELECT `section_code`, section.strand_code, `GRADE_NAME`, CONCAT(`TEACHER_FNAME`, ' ',`TEACHER_INIT`, ' ', `TEACHER_LNAME`) AS ADVISOR 
            FROM `GRADELEVEL` LEFT JOIN `TEACHER`
            ON GRADELEVEL.TEACHER_ID = TEACHER.TEACHER_ID
            WHERE `$row` = '$value'";
            $stored = ($this->con->query($sql))->fetch_assoc();
            $stored->close();
            return $stored;
        } else {


            $sql = "SELECT `GRADE_ID`, `GRADE_NAME`, CONCAT(`TEACHER_FNAME`, ' ',`TEACHER_INIT`, ' ', `TEACHER_LNAME`) AS ADVISOR 
            FROM `GRADELEVEL` LEFT JOIN `TEACHER`
            ON GRADELEVEL.TEACHER_ID = TEACHER.TEACHER_ID
            ORDER BY GRADELEVEL.GRADE_NAME";
            $stored = ($this->con->query($sql))->fetch_all(MYSQLI_ASSOC);

            return $stored;
        }
    }


    // GET LIST OF SECTION
    public function getSection($row = null, $value = null)
    {
        if ($row != null && $value != null) {
            $sql = "SELECT `section_code`, `strand_name` ,`section.strand_code` , `grade_lvl` ,
            `section_name`, `teacher_fname` , `teacher_lname` , `section.teacher_id` , 
            CONCAT(`teacher_fname`,' ', `teacher_mname`, ' ', `teacher_lname`)AS adviser FROM `section`
            INNER JOIN `strand`
            ON section.strand_code = strand.strand_code
            INNER JOIN `teacher`
            ON section.teacher_id = teacher.teacher_id
            WHERE section.$row = '$value'";

            $stored = ($this->con->query($sql))->fetch_assoc();

            return $stored;
        } else {
            $sql = "SELECT `section_code`, `strand_name` , `grade_lvl` , `section_name`, `teacher_fname` , `teacher_lname` ,
            CONCAT(`teacher_fname`,' ', `teacher_mname`, ' ', `teacher_lname`)AS adviser FROM  `section`
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
    // public function getSubject($row = null, $value = null)
    // {
    //     if ($row != null && $value != null) {
    //         $sql = "SELECT `sub_code`,
    //         `sub_title`, `sub_type`, `sub_time`,
    //         `sub_semester`, `strand_name`, `subject.strand_code`,
    //         `subject.teacher_id`, 
    //         CONCAT(`teacher_fname`,' ', `teacher_mname`, ' ', `teacher_lname`)AS teacher 
    //         FROM `subject`
    //         LEFT JOIN `strand`
    //         ON subject.strand_code = strand.strand_code
    //         LEFT JOIN `teacher`
    //         ON subject.teacher_id = teacher.teacher_id
    //         WHERE subject.$row = '$value'";

    //         $stored = ($this->con->query($sql))->fetch_assoc();

    //         return $stored;
    //     } else {
    //         $sql = "SELECT `sub_code`, 
    //         `sub_title` , `sub_type` , `sub_time`,
    //         `sub_semester` , `strand_name` as strand,
    //         CONCAT(`teacher_fname`,' ', `teacher_mname`, ' ', `teacher_lname`)AS teacher
    //         FROM  `subject`
    //         LEFT JOIN `strand`
    //         ON subject.strand_code = strand.strand_code
    //         LEFT JOIN `teacher`
    //         ON subject.teacher_id = teacher.teacher_id
    //         ORDER BY subject.sub_title";
    //         $stored = ($this->con->query($sql))->fetch_all(MYSQLI_ASSOC);

    //         return $stored;
    //     }
    // }
    public function getSubject($row = null, $value = null)
    {
        if ($row != null && $value != null) {
            // Use prepared statements to avoid SQL injection
            $stmt = $this->con->prepare("SELECT `sub_code`,
                `sub_title`, `sub_type`, `sub_time`,
                `sub_semester`, `strand_name`, `subject.strand_code`, `sub_gradelvl`,
                `subject.teacher_id`, 
                CONCAT(`teacher_fname`, ' ', `teacher_mname`, ' ', `teacher_lname`) AS teacher 
                FROM `subject`
                LEFT JOIN `strand` ON subject.strand_code = strand.strand_code
                LEFT JOIN `teacher` ON subject.teacher_id = teacher.teacher_id
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
            $sql = "SELECT `sub_code`, 
                `sub_title`, `sub_type`, `sub_time`,
                `sub_semester`, `strand_name` AS strand, `sub_gradelvl`,
                CONCAT(`teacher_fname`, ' ', `teacher_mname`, ' ', `teacher_lname`) AS teacher
                FROM `subject`
                LEFT JOIN `strand` ON subject.strand_code = strand.strand_code
                LEFT JOIN `teacher` ON subject.teacher_id = teacher.teacher_id
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
                CONCAT(`student`.`stu_fname`, ' ', `student`.`stu_lname`) AS student,
                `enroll`.`section_code`,
                `section`.`section_code`,
                `section`.`strand_code`,
                `strand`.`strand_name`,  -- Fetching the strand_name from the strand table
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
                `enroll`.`school_type`
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
                CONCAT(`student`.`stu_fname`, ' ', `student`.`stu_lname`) AS student,
                `section`.`strand_code`,
                `strand`.`strand_name`,  -- Fetching the strand_name from the strand table
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
                `enroll`.`school_type`
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

            $sql = "SELECT * FROM `student` ORDER BY `stu_fname`";

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


    // UPDATE TEACHER
    public function updateFaculty($row, $value, $where)
    {
        $value = mysqli_real_escape_string($this->con, $value);
        if (is_string($value)) {
            $value = "'" . $value . "'";
        }
        $sql = "UPDATE `teacher` SET `$row` =  $value WHERE `teacher_id` = '$where'";
        $result = $this->con->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // UPDATE STUDENT
    public function updateStudent($row, $value, $where)
    {
        $value = mysqli_real_escape_string($this->con, $value);
        if (is_string($value)) {
            $value = "'" . $value . "'";
        }
        $sql = "UPDATE `student` SET `$row` =  $value WHERE `stu_lrn` = '$where'";
        $result = $this->con->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    //UPDATE SECTION
    public function updateSection($row, $value, $where)
    {
        // Sanitize input
        $value = mysqli_real_escape_string($this->con, $value);
        if (is_string($value)) {
            $value = "'" . $value . "'";
        }

        // Check if strand_code exists in strand table
        if ($row === 'strand_code') {
            $checkQuery = "SELECT COUNT(*) FROM strand WHERE strand_code = $value";
            $checkResult = $this->con->query($checkQuery);
            $count = $checkResult->fetch_row()[0];

            if ($count == 0) {
                return false; // or handle the error as needed
            }
        }

        // Proceed with the update
        $sql = "UPDATE `section` SET `$row` =  $value WHERE `section_code` = '$where'";
        $result = $this->con->query($sql);

        return $result ? true : false;
    }






    //UPDATE SUBJECT
    public function updateSubject($row, $value, $where)
    {
        $value = mysqli_real_escape_string($this->con, $value);
        if (is_string($value)) {
            $value = "'" . $value . "'";
        }
        $sql = "UPDATE `subject` SET `$row` =  $value WHERE `sub_code` = '$where'";
        $result = $this->con->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    //UPDATE ENROLLMENT
    public function updateEnrolled($row, $value, $where)
    {
        $value = mysqli_real_escape_string($this->con, $value);
        if (is_string($value)) {
            $value = "'" . $value . "'";
        }
        $sql = "UPDATE `enroll` SET `$row` =  $value WHERE `stu_lrn` = '$where'";
        $result = $this->con->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }




    // UPDATE USERS
    public function updateUser($row, $value, $where, $role = null)
    {
        $value = mysqli_real_escape_string($this->con, $value);
        if (is_string($value)) {
            $value = "'" . $value . "'";
        }
        $sql = "UPDATE `users` SET `$row` = $value WHERE `id` = '$where'";
        $result = $this->con->query($sql);

        if ($result) {

            return true;
        } else {
            return false;
        }
    }
}
