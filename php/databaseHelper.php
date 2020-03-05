<?php
include_once "database.php";
include_once "postHelper.php";
include_once "htmlCleaner.php";

  class DatabaseHelper {

    static public function genCleanCSV($limit, $offset = 0, $imagePath = "../img/nieuws") {
      set_time_limit(300);
      $results = Database::getAllPosts();
      $csvNew = array();

      $imagePath = rtrim($imagePath, '/\\');

      $results = DatabaseHelper::utf8_string_array_encode($results);

      foreach ($results as $res) {
        $cleanedCon = HTMLcleaner::cleanHtml($res[3], array("src", "href"), "<h1><h2><h3><h4><h5><p><img><a><video><ul><ol><li><quote><figure><figcaption>");
        $imgThumb = $res[6];
        // list($res[3], $res[5], $imgThumb) = PostHelper::downloadImages($res, $imagePath);
        
        
        $temp = array();
        
        
        $folderPath = $imagePath . "/" . $res[0];
        
        list($newContent, $res[5], $imgThumb) = PostHelper::downloadImages($res, $folderPath);
        

        array_push($temp,$res[0]);
        array_push($temp,$res[1]);

        $correctDate = date("Y-m-d G:i:s", strtotime($res[2]));
        // $correctDate = ]{1,4}).*/", "$1 00:00:00", $res[2]);
        array_push($temp,$correctDate);
        $intro_txt = PostHelper::GetIntroFromContent($cleanedCon);
        array_push($temp,$intro_txt);
        
        array_push($temp,$newContent);
        
        

        array_push($temp, $newContent);
        array_push($temp, $imgThumb);
        array_push($csvNew, $temp);


      }

      $file = fopen('nieuws_gen.csv', 'w');
        // fputcsv($file, ["id", "title", "created_at", "intro_text", "content", "img", "thumbnail"]);
        foreach($csvNew as $row) {
          fputcsv($file, $row);
        }

        
      fclose($file);

      // header('location: ./nieuws_gen.csv');

    }

    public static function utf8_string_array_encode(&$array){
      $func = function(&$value,&$key){
          if(is_string($value)){
              $value = utf8_encode($value);
          }
          if(is_string($key)){
              $key = utf8_encode($key);
          }
          if(is_array($value)){
              DatabaseHelper::utf8_string_array_encode($value);
          }
      };
      array_walk($array,$func);
      return $array;
  }
  }  

  DatabaseHelper::genCleanCSV(100);
 ?>
