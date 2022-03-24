<?php
    class Author {
        private $conn;
        private $table = "authors";

        // Author Properties
        public $id;
        public $author;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Author
        public function read() {
            $query = "SELECT id, author FROM " . $this->table;

            $stmt = $this->conn->prepare($query);

            $stmt->execute();
    
            return $stmt;
        }

        // Get Single Author
        public function read_single() {
            $query = "SELECT id, author FROM " . $this->table . " WHERE id = ? LIMIT 0,1";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind ID
            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set Properties
            $this->id = $row['id'];
            $this->author = $row['author'];

        }

        // Create Post
        public function create() {
            // Query
            $query = 'INSERT INTO ' . $this->table . ' SET author = :author';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->author = htmlspecialchars(strip_tags($this->author));

            // Bind Data
            $stmt->bindParam(':author', $this->author);

            // Execute
            if($stmt->execute()) {
                return true;
                // This has to be updated so that it return JSON showing what is in the post that was created.
                // Somewhere here or in create.php, you have to add the get last id function or whatever it is
            }
            // Print error if something goes wrong

            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Update Post
        public function update() {
            // Query
            $query = 'UPDATE ' . $this->table . ' SET author = :author WHERE id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->author = htmlspecialchars(strip_tags($this->author));

            // Bind Data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':author', $this->author);

            // Execute
            if($stmt->execute()) {
                return true;
                // This has to be updated so that it return JSON showing what is in the post that was created. Goes at bottom of create.php
                // Somewhere here or in create.php, you have to add the get last id function or whatever it is
            }
            // Print error if something goes wrong

            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Delete Post
        public function delete() {
            // Create query
            //$query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
            $query = 'DELETE FROM'.$this->table.'WHERE id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':id', $this->id);

            // Execute
            if($stmt->execute()) {
                return true;
            // This has to be updated so that it return JSON showing the post id that was deleted. Goes at bottom of delete.php
            }
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            
            return false;
        }
    }