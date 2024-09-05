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
        // Get the current year
        $year = date('Y');

        // Query to fetch the last Teacher ID in descending order to get the latest increment value
        $query = "SELECT teacher_id FROM teacher ORDER BY teacher_id DESC LIMIT 1";
        $result = $this->con->query($query); // Assuming you're using $this->db for DB operations
        if ($result->num_rows > 0) {
            // Fetch the last teacher ID
            $row = $result->fetch_assoc();
            $lastID = $row['teacher_id'];

            // Extract the numeric part after the year and increment it
            $lastNumber = (int) substr($lastID, -1); // Extract the last digit after the dash (TEACHER-year-1)
            $newNumber = $lastNumber + 1; // Increment the number
        } else {
            // If no records are found, start with 1
            $newNumber = 1;
        }
        // Construct the new Teacher ID with the format: TEACHER-year-1
        $newTeacherID = "TEACHER-" . $year . "-" . $newNumber;
        return $newTeacherID;
    }


    //RANDOM USER ID
    // RANDOM TEACHER ID
    public function generateUserID()
    {
        $num = "2468369";
        $rand = "";

        for ($i = 0; $i < 4; $i++) {
            if ($i == 0) {
                $rand = "USER-";
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



    public function getSchool()
    {
        $sql = "SELECT * FROM `SCHOOL`";
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



    // INSERT INTO TABLE 
    public function insert($table, $values)
    {
        for ($i = 0; $i < count($values); $i++) {
            $values[$i] = mysqli_real_escape_string($this->con, $values[$i]);

            if (is_string($values[$i])) {
                $values[$i] = "'" . $values[$i] . "'";
            }
        }
        $values = implode(",", $values);

        $sql = "INSERT INTO `$table` VALUES ($values)";
        $result = $this->con->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //GET USERS LIST
    public function getUsers($row = null, $value = null, $limit = 8)
    {
        if ($row != null &&  $value != null) {

            $sql = "SELECT * FROM `users` WHERE `$row` = '$value'";
            $stored = ($this->con->query($sql))->fetch_assoc();
            return $stored;
        } else {

            $sql = "SELECT * FROM `users` ORDER BY `id` LIMIT $limit";
            $stored = ($this->con->query($sql))->fetch_all(MYSQLI_ASSOC);

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






    //  GET TEACHER LIST 
    public function getTeacher($row = null, $value = null, $limit = 10)
    {
        if ($row != null &&  $value != null) {

            $sql = "SELECT * FROM `teacher` WHERE `$row` = '$value'";
            $stored = ($this->con->query($sql))->fetch_assoc();
            return $stored;
        } else {

            $sql = "SELECT * FROM `teacher` ORDER BY `teacher_fname` LIMIT $limit";
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
}
