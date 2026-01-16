<?php
    class DBUtil {
        // MySQL Server information properties
        private $servername; //= "localhost";
        private $username; //= "root";
        private $password; //= "root";
        private $dbname; //= "les_coding_gen4";

        // constructor fill the server information
        function __construct($servername, $username, $password, $dbname) {
            $this->servername = $servername;
            $this->username = $username;
            $this->password = $password;
            $this->dbname = $dbname;
        }
        
        // non-reading type
        public function nonReadingQuery($query) {
            // Create connection
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

            // Check connection
            if ($conn->connect_error) {
                throw new Exception($conn->connect_error);
            }

            // Set Indonesian day/month names for this session
            $conn->query("SET lc_time_names = 'id_ID'");

            // execute non-reading query
            if ($conn->query($query) === TRUE) {
                $conn->close();
                return "success";
            }
            else {
                $error = "Error: " . $query . "<br>" . $conn->error;
                $conn->close();
                return $error;
            }
        }
        
        // reading type
        public function readingQuery($query) {
            // Create connection
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            
            // Check connection
            if ($conn->connect_error) {
                throw new Exception($conn->connect_error);
            }

            // Set Indonesian day/month names for this session
            $conn->query("SET lc_time_names = 'id_ID'");

            // execute reading query
            $result = $conn->query($query);

            if ($result === FALSE) {
                $error = $conn->error;
                $conn->close();
                throw new Exception($error);
            }

            if ($result->num_rows > 0) {
                // return data of each row
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                $conn->close();
                return $rows;
            }
            else {
                $conn->close();
                return [];
            }
        }

        // reading single value
        public function readSingleValue($query) {
            // Create connection
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            
            // Check connection
            if ($conn->connect_error) {
                throw new Exception($conn->connect_error);
            }

            // execute reading query
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                // return data of single value
                $row = $result->fetch_array(MYSQLI_NUM);
                return $row[0];
            }
            else {
                return null;
            }
            $conn->close();
        }
        
    }
?>