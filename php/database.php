<?php
  class Database {
    static private function connect() {
      //login data
      $servername = "remotemysql.com:3306";
      $username = "DuZ7qtUKuT";
      $password = "dNBA0nKhJl";
      $databasename = $username;

      //creating connection
      $conn = new mysqli($servername, $username, $password, $databasename);

      //check connection
      if($conn->connect_error){
        die("Connection failed.");
      } else {
        
      }
    }
  }
 ?>
