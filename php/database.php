<?php
  class Database {

    public static $nieuwsTable = "TABLE 2";

    static private function connect() {
      //login data
      // $servername = "remotemysql.com:3306";
      // $username = "DuZ7qtUKuT";
      // $password = "dNBA0nKhJl";
      // $databasename = $username;

      $servername = "localhost";
      $username = "root";
      $password = "";
      $databasename = "rollyside";

      //creating connection
      $conn = new mysqli($servername, $username, $password, $databasename);

      //check connection
      if($conn->connect_error){
        die("Connection failed.");
      } else {
        return $conn;
      }
    }
    static public function getAllPosts() {
      $conn = Database::connect();
      
      $sql = "SELECT * FROM nieuws LIMIT ?";
      
      $stmt = $conn->prepare($sql);
      $limit = 100;
      $stmt->bind_param("s", $limit);

      $stmt->execute();
      $result = $stmt->get_result();
      $conn->close();

      return $result->fetch_all();

    }

    public static function getPosts($limit, $offset = 0){
      $conn = Database::connect();

      $sql = "SELECT * FROM `nieuws` ORDER BY created_at DESC LIMIT ? OFFSET ?";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $limit, $offset);

      $stmt->execute();
      $result = $stmt->get_result();
      $results = $result->fetch_all();

      $conn->close();
      return $results;
    }
    public static function deletePost($postId) {

      // check if the postid is a valid number because all ids are numberic
      if (is_numeric($postId)) {
        $conn = Database::connect();
        $sql = "DELETE FROM `nieuws` WHERE `id` = ?";
  
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $postId);

        $stmt->execute();
        // TODO: test the amount of effected rows and return message based on result
        $rowsAffected = $stmt->affected_rows;
        if ($rowsAffected <= 0) {
          $conn->close();
          return [false, "the post with the given id: <strong>$postId</strong> was not found"];
        } else if ($rowsAffected >= 2) {
          // Not Possible
          $conn->close();
          return [true, "Removed the <strong>$rowsAffected</strong> posts with the id <strong>$postId</strong>"];
        }
        $conn->close();
        return [true, "Post with the id <strong>$postId</strong> is succesfully deleted"];

      } else {
        return [false, "<strong>$postId</strong> is not a valid post id"];
      }
    }

    public static function createPost($title, $introText, $content, $featuredImg, $postImg, $date) {
      $conn = Database::connect();

      $sql = "INSERT INTO `nieuws` (`title`, `created_at`, `content`, `intro_text`, `intro_img`, `post_img`) VALUES ( ?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);

      $mysqlDate = date("Y-m-d H:i:s", strtotime($date));
      $stmt->bind_param("ssssss", $title, $mysqlDate, $content, $introText, $featuredImg, $postImg);

      $stmt->execute();
      
      $rowsAffected = $stmt->affected_rows;
      if ($rowsAffected <= 0) {
        $conn->close();
        return [false, "There was an error with creating the post"];
      }
      $conn->close();
      return [true, "Post has been succesfully created"];


    }

    public static function updatePost($oldId, $newPost) {
      list($title, $introText, $content, $featuredImg, $postImg, $date) = $newPost;

      $succesfullyDeleted = Database::deletePost($oldId)[0];
      $errorcode = 0;
      $errorMsg = "";
      if ($succesfullyDeleted) {
        $succesCreated = Database::createPost($title, $introText, $content, $featuredImg, $postImg, $date);

        if ($succesCreated) {
          return [true, $errorcode, "the post has been succesfully updated"];
        } else {
          $errorMsg = "the post could not be created";
          $errorcode = 2;
        }
      } else {
          $errorMsg = "the post could not be deleted";
          $errorcode = 1;
      }
    
      return [false, [$errorcode, $errorMsg], "There was an error creating the post"];


    }

    public static function searchPost($title, $limit, $offset) {
      $conn = Database::connect();

      $sql = 'SELECT * FROM `nieuws` WHERE title LIKE ? ORDER BY created_at DESC LIMIT ? OFFSET ?';

      $stmt = $conn->prepare($sql);
      $title = "%$title%";
      $stmt->bind_param("sss", $title, $limit, $offset);

      $stmt->execute();
      $result = $stmt->get_result();
      $results = $result->fetch_all();

      $conn->close();
      return $results;
    }

    static public function getAllFoto() {
      $conn = Database::connect();
      
      $sql = "SELECT * FROM galerij LIMIT ?";
      
      $stmt = $conn->prepare($sql);
      $limit = 100;
      $stmt->bind_param("s", $limit);

      $stmt->execute();
      $result = $stmt->get_result();
      $conn->close();

      return $result->fetch_all();

    }

    static public function getFoto($limit, $offset = 0) {
      $conn = Database::connect();

      $sql = "SELECT * FROM galerij ORDER BY `galerij_id` DESC LIMIT ? OFFSET ?";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $limit, $offset);

      $stmt->execute();
      $result = $stmt->get_result();
      $results = $result->fetch_all();

      $conn->close();
      return $results;
    }
    
    //! end of class
  }

  


   

?>