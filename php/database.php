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

        //check if there are rows deleted
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
        // return [false, "There was an error with creating the post"];
        return -1;
      }
      $insertId = $conn->insert_id;
      
      $conn->close();
      // return [true, "Post has been succesfully created"];
      return $insertId;


    }

    public static function updatePostContent($oldId, $newContent) {
      $conn = Database::connect();

      $sql = "UPDATE `nieuws` SET `content`=? WHERE `nieuws`.`id` = ?";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $newContent, $oldId);
      $stmt->execute();

      $conn->close();
      return true;
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

    static public function getGalerij($galerijId) {
      $conn = Database::connect();
      $sql = "SELECT * FROM galerij WHERE `galerij_id` = ?";


      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $galerijId);

      $stmt->execute();
      $result = $stmt->get_result();
      $results = $result->fetch_all();

      $conn->close();
      return $results[0];
    }

    public static function getUserInfo($username) {
      $conn = Database::connect();
      $sql = "SELECT * FROM users WHERE `username` = ?";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $username);

      $stmt->execute();
      $result = $stmt->get_result();
      $results = $result->fetch_all();


      $conn->close();
      
      return isset($results[0]) ? $result[0] : false ;
    }

    public static function getUserExplicit($id, $username) {
      $conn = Database::connect();
      $sql = "SELECT * FROM users WHERE `username` = ? AND `user_id` = ?";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $username, $id);

      $stmt->execute();
      $result = $stmt->get_result();
      $results = $result->fetch_all();

      $conn->close();
      return $results[0];
      
    }

    public static function updatePasswordByEmail($email, $pw) {
      $conn = Database::connect();
      
      $sql = "UPDATE users SET wachtwoord = ? WHERE email = ?";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $pw, $email);

      $stmt->execute();
      $conn->close();
    }

    /********** RESET PASSWORD **********/
    public static function insertPasswordReset($dataObj) {
      $conn = Database::connect();
      print_r($dataObj);
      // delete all previus password resets
      $sql = "DELETE FROM resettoken WHERE email=?";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $dataObj->email);
      $stmt->execute();

      $sql = "INSERT INTO `resettoken` (`email`, `selector`, `token`, `expires`) VALUES (?,?,?,?);";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $dataObj->email, $dataObj->selector, $dataObj->token, $dataObj->expires);
      $stmt->execute();

      $conn->close();
    }

    public static function getUsernameFromEmail($email) {
      $conn = Database::connect();
      $sql = "SELECT `username` FROM users WHERE `email`=?";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $email);

      $stmt->execute();
      $result = $stmt->get_result();
      $results = $result->fetch_all();

      $conn->close();
      return $results[0];
    }

    public static function getTokenInfo($selector, $date) {
      $conn = Database::connect();
      // echo $date;
      // var_dump($selector);
      $sql = "SELECT * FROM resettoken WHERE `selector`= ?";
      
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $selector);

      $stmt->execute();
      $result = $stmt->get_result();
      $results = $result->fetch_all();
      // print_r($results);

      $conn->close();
      $tr = $results[0];
      if (isset($tr[0])) {

        $t = new stdClass;
        $t->id = $tr[0];
        $t->email = $tr[1];
        $t->selector = $tr[2];
        $t->token = $tr[3];
        $t->expires = $tr[4];
        return $t;
      }
      return false;
    }

    //! end of class
  }

?>