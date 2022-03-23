<?php
    class Database {
        // Database parameters THESE NEED TO BE UPDATED WHEN CONNECTING TO HEROKU
        private $host = "localhost";
        private $db_name = "quotesdb";
        private $username = "root";
        private $password = "";
        private $conn;

        // Database connect
        public function connect() {
            $this->conn = null;

            try {
                // THIS TRY SECTION NEEDS TO BE UPDATED AFTER UPDATING THE DATABASE PARAMETERS ABOVE
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Connection Error: " . $e->getMessage();
            }

            return $this->conn;
        }
    }