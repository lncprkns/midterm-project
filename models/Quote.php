<?php
    class Quote {
        private $conn;
        private $table = "quotes";

        // Author Properties
        public $id;
        public $quote;
        public $authorId;
        public $categoryId;
        public $author_name;
        public $category_name;     

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // ***********Get all quotes*************
        public function read() {
            $query = "SELECT 
                a.author as author_name,
                c.category as category_name,
                q.id,
                q.quote,
                q.authorId,
                q.categoryId
            FROM
                " . $this->table. " q
            LEFT JOIN
                authors a on q.authorId = a.id
            LEFT JOIN
                categories c on q.categoryId = c.id";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();
    
            return $stmt;
        }

        // ***********Get Single Quote***************
        public function read_single() {
            $query = "SELECT 
                a.author as author_name,
                c.category as category_name,
                q.id,
                q.quote,
                q.authorId,
                q.categoryId
            FROM
                " . $this->table. " q
            LEFT JOIN
                authors a on q.authorId = a.id
            LEFT JOIN
                categories c on q.categoryId = c.id
                WHERE q.id = ? LIMIT 0,1";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind ID
            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set Properties
            $this->id = $row['id'];
            $this->quote = $row['quote'];
            $this->author_name = $row['author_name'];
            $this->category_name = $row['category_name'];

        }

        // *******************Create Quote******************
        public function create() {
            // Query
            $query = 'INSERT INTO ' . $this->table . ' SET quote = :quote, authorId = :authorId, categoryId = :categoryId';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->authorId = htmlspecialchars(strip_tags($this->authorId));
            $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

            // Bind Data
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':authorId', $this->authorId);
            $stmt->bindParam(':categoryId', $this->categoryId);

            // Execute
            if($stmt->execute()) {
                return true;
                // This has to be updated so that it return JSON showing what is in the quote that was created.
                // Somewhere here or in create.php, you have to add the get last id function or whatever it is
            }
            // Print error if something goes wrong

            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // ******************Update quote***********************
        public function update() {
            // Query
            $query = 'UPDATE ' . $this->table . ' SET id = :id, quote = :quote, authorId = :authorId, categoryId = :categoryId WHERE id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->authorId = htmlspecialchars(strip_tags($this->authorId));
            $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

            // Bind Data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':authorId', $this->authorId);
            $stmt->bindParam(':categoryId', $this->categoryId);

            // Execute
            if($stmt->execute()) {
                return true;
                // This has to be updated so that it return JSON showing what is in the quote that was created. Goes at bottom of create.php
                // Somewhere here or in create.php, you have to add the get last id function or whatever it is
            }
            // Print error if something goes wrong

            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Delete quote
        public function delete() {
            // Create query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':id', $this->id);

            // Execute
            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            
            return false;
        }
    }