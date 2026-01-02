<?php
    class dbUtil {
        // MySQL Server information properties
        private $servername; //= "localhost";
        private $username; //= "root";
        private $password; //= "root";
        private $dbname; //= "les_coding_gen4";

        // constructor fill the server information
        function __construct($servername, $username, $password, $dbname) {
            $this->$servername = $servername;
            $this->$username = $username;
            $this->$password = $password;
            $this->$dbane = $dbname;
        }
        
        // non-reading type
        public function nonReadingQuery($query) {
            // Create connection
            $conn = new mysqli($this->$servername, $this->$username, $this->$password, $this->$dbname);

            // Check connection
            if ($conn->connect_error) {
                throw new Exception($conn->connect_error);
            }

            // execute non-reading query
            if ($conn->query($query) === TRUE) {
                return "success";
            }
            else {
                return "Error: " . $query . "<br>" . $conn->error;
            }

            $conn->close();
        }
        
        // reading type
        public function readingQuery($query) {
            // Create connection
            $conn = new mysqli($this->$servername, $this->$username, $this->$password, $this->$dbname);
            
            // Check connection
            if ($conn->connect_error) {
                throw new Exception($conn->connect_error);
            }

            // execute reading query
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                // return data of each row
                $result->fetch_all(MYSQLI_ASSOC);
            }
            else {
                return [];
            }
            $conn->close();
        }

        
    }
?>