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
        return  sha1($password);
    }


    // RANDOM STUDENT ID
    public function generateStudentID()
    {
        $num = "1234567890";
        $rand = "";

        for ($i = 0; $i < 4; $i++) {
            if ($i == 0) {
                $rand = "SUB-";
            }
            $rand = $rand . $num[rand(0, strlen($num) - 1)];
        }
        return $rand;
    }


    // RANDOM TEACHER ID

    public function generateTeacherID()
    {
        $num = "1325476980";
        $rand = "";

        for ($i = 0; $i < 4; $i++) {
            if ($i == 0) {
                $rand = "TEACHER-";
            }
            $rand = $rand . $num[rand(0, strlen($num) - 1)];
        }
        return $rand;
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




    public function getUpdateTeacher()
    {
        $sql = "SELECT * FROM `TEACHER`";
        $stored = ($this->con->query($sql))->fetch_assoc();
        return $stored;
    }


    //GET SCHOOL INFORMATIONM
    public function getSchool()
    {
        $sql = "SELECT * FROM `SCHOOL`";
        $stored = ($this->con->query($sql))->fetch_assoc();
        return $stored;
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
    // Check active STATUS in semester
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


    public function checkSectionExist($strand, $section, $adviser, $excludeID)
    {
        $sql = "SELECT * FROM section WHERE strand_code =? AND section_name =? AND  teacher_id =? AND section_code  != ?";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("sssi", $strand, $section, $adviser, $excludeID);
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
    public function getUsers($row = null, $value = null, $limit = 6, $offset = 0)
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
                    OR `added_date` LIKE '$value%'
                    ORDER BY `username`, `role`, `added_date`";

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



    public function getSection($row = null, $value = null)
    {
        if ($row != null && $value != null) {
            $sql = "SELECT `section_code`, `strand_name` ,`section.strand_code` , `grade_lvl` ,
            `section_name`,`semester`,`section.teacher_id` , 
            CONCAT(`teacher_fname`,' ', `teacher_mname`, ' ', `teacher_lname`)AS adviser FROM `section`
            INNER JOIN `strand`
            ON section.strand_code = strand.strand_code
            INNER JOIN `teacher`
            ON section.teacher_id = teacher.teacher_id
            WHERE section.$row = '$value'";

            $stored = ($this->con->query($sql))->fetch_assoc();

            return $stored;
        } else {
            $sql = "SELECT `section_code`, `strand_name` , `grade_lvl` , `section_name`, `semester`,
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


    //insert user and teacher with validation
    public function insertTeacher($table, $columns, $values)
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

    //UPDATE SECTION
    public function updateSection($row, $value, $where)
    {
        $value = mysqli_real_escape_string($this->con, $value);
        if (is_string($value)) {
            $value = "'" . $value . "'";
        }
        $sql = "UPDATE `section` SET `$row` =  $value WHERE `section_code` = '$where'";
        $result = $this->con->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }





    // UPDATE USERS
    public function updateUser($row, $value, $where)
    {
        $value = mysqli_real_escape_string($this->con, $value);
        if (is_string($value)) {
            $value = "'" . $value . "'";
        }
        $sql = "UPDATE `users` SET `$row` =  $value WHERE `id` = '$where'";
        $result = $this->con->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
