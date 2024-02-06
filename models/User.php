<?php 
  class User {
    // DB stuff
    private $conn;
    private $table = 'users';

    // Post Properties
    public $id_user;
    public $fname;
    public $lname;
    public $username;
    public $email;
    public $password;
    public $active;
  

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT * FROM users';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
/*
    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT c.name as category_name, p.id, p.category_id, p.fname, p.lname, p.author, p.created_at
                                    FROM ' . $this->table . ' p
                                    LEFT JOIN
                                      categories c ON p.category_id = c.id
                                    WHERE
                                      p.id = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id_favorite);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->title = $row['title'];
          $this->body = $row['body'];
          $this->author = $row['author'];
          $this->category_id = $row['category_id'];
          $this->category_name = $row['category_name'];
    }
*/
    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET fname = :fname, lname = :lname, username = :username, email = :email, password = :password';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->fname = htmlspecialchars(strip_tags($this->fname));
          $this->lname = htmlspecialchars(strip_tags($this->lname));
          $this->username = htmlspecialchars(strip_tags($this->username));
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->password = htmlspecialchars(strip_tags($this->password));

          // Bind data
          $stmt->bindParam(':fname', $this->fname);
          $stmt->bindParam(':lname', $this->lname);
          $stmt->bindParam(':username', $this->username);
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':password', $this->password);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Post
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET fname = :fname, lname = :lname, username = :username, email = :email, password = :password
                                WHERE id_user = :id_user';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->fname = htmlspecialchars(strip_tags($this->fname));
          $this->lname = htmlspecialchars(strip_tags($this->lname));
          $this->username = htmlspecialchars(strip_tags($this->username));
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->password = htmlspecialchars(strip_tags($this->password));
          $this->id_user = htmlspecialchars(strip_tags($this->id_user));

          // Bind data
          $stmt->bindParam(':fname', $this->fname);
          $stmt->bindParam(':lname', $this->lname);
          $stmt->bindParam(':username', $this->username);
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':password', $this->password);
          $stmt->bindParam(':id_user', $this->id_user);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Post
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id_user = :id_user';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id_user = htmlspecialchars(strip_tags($this->id_user));

          // Bind data
          $stmt->bindParam(':id_user', $this->id_user);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }