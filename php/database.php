<?php
include "postHelper.php";
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

      return $results;
    }
  }


  // $post = Database::getPosts(1, 2)[0];
  // PostHelper::downloadImages($post, "../img/nieuws")
?>
