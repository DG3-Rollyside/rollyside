<?php
include "htmlCleaner.php";
include "postHelper.php";

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
        return $conn;
      }
    }
    /*  
      @limit::posts to show
      @offset:: the shows the page
    */
    static public function genCleanCSV($limit, $offset = 0) {
      $conn = Database::connect();

      $sql = "SELECT * FROM nieuws ORDER BY created_at DESC LIMIT ? ";
      $stmt = null;

      if($offset != 0) {
        $sql = "SELECT * FROM nieuws ORDER BY created_at DESC LIMIT ?,? ";
        $stmt = $conn->prepare($sql);

        $limit += $offset;

        $stmt->bind_param("ss", $offset, $limit);
      } else {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $limit);
      }

      $stmt->execute();
      $result = $stmt->get_result();
      $results = $result->fetch_all();
      $csvNew = array();

      $ids = array();
      $title = array();
      $created_at = array();
      $content = array();
      $intro_text = array();
      $img = array();

      foreach ($results as $res) {
        $cleanedCon = HTMLcleaner::cleanHtml($res[3], array("src", "href"), "<h1><h2><h3><h4><h5><p><img><a><video><ul><ol><li><quote><figure><figcaption>");
        array_push($ids,$res[0]);
        array_push($title,$res[1]);
        array_push($created_at,$res[2]);
        array_push($content,$cleanedCon);

        $intro_txt = PostHelper::GetIntroFromContent($cleanedCon);
        echo $cleanedCon. "<hr />";
        echo $intro_txt . "<hr style='border: 10px solid black;'/>";
        // if ($intro_text == "&#8230") {

        // }

        array_push($intro_text,$intro_txt);
        array_push($img,$res[5]);
      }


      // for ($i = 0; $i < $limit; $i++) {
      // }

    }
  }

  Database::genCleanCSV(100);

  
 ?>
