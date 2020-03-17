<?php 
include_once "imageEditor.php";
include_once "simplehtmldom/HtmlDocument.php";
include_once "databaseHelper.php";
require_once("./url_to_absolute/url_to_absolute.php");

use simplehtmldom\HtmlDocument;

class GalerijHelper {
    public static function downloadImages($post, $path) {
        $url = "http://www.rollyside.nl";
        // download images from the content of the articles

        $pathArr = explode("/", $path . "/");
        $checkPath = "";
        foreach($pathArr as $pathPiece){
            if ($pathPiece == "..") {
                $checkPath .= ".." . DIRECTORY_SEPARATOR;
                continue;    
            }
            $checkPath .= $pathPiece;
            if (!file_exists($checkPath)) {
                try {
                    mkdir($checkPath);
                } catch (\Throwable $th) {
                }
            } else if(!is_dir($checkPath)) {
                die("<strong>FATAL ERROR: </strong>Folder in path is a file: <strong>\"" . $checkPath . "\"</strong>");
            }
            $checkPath .= DIRECTORY_SEPARATOR;
        }
        
        // check if the folder exists and when it exists remove all files in that folder
        $folderPathFromPHP = $checkPath . $post[0];
        if (!is_dir($folderPathFromPHP) && !file_exists($folderPathFromPHP)) {
            mkdir($folderPathFromPHP);
        } else {
            $files = glob( $folderPathFromPHP . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
            foreach($files as $file){ // iterate files
                if(is_file($file))
                unlink($file); // delete file
            }
        }
        
        
        $urlToImg = $post[3];

        // valid link
        $id = uniqid();
        $featuredPathFromPHP = $checkPath . $post[0] . "/". $id . ".jpg";
        $featurdPathFromGalerij = DatabaseHelper::createCorrectPathToImg($featuredPathFromPHP);

        file_put_contents($featuredPathFromPHP, file_get_contents($urlToImg));

        $imgF = $checkPath . "/" . $id . "THUMB.jpg";
        $resize = new ResizeImage($featuredPathFromPHP);
        $resize->resizeTo(300, 300, 'maxWidth');
        $resize->saveImage($imgF, 60);
        
        


        
        $folderPathFromPHP = $checkPath . $path[0];
        if (!is_dir($folderPathFromPHP) && !file_exists($folderPathFromPHP)) {
            mkdir($folderPathFromPHP);
        } else {
            $files = glob( $folderPathFromPHP . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
            foreach($files as $file){ // iterate files
                if(is_file($file))
                  unlink($file); // delete file
              }
        }
        
        $doc = new HTmlDocument();
        $tempHtml = "<div id='wrap'> ". $post[1] . "</div>"; 
        $html = $doc->load($tempHtml);
        
        // download the images in the article
        $imgElements = $html->find('img'); 

        foreach($imgElements as $element) {

            $result = $element->src;
            var_dump($result);
            try {
                $urlToImg =  $result;
            } catch (\Throwable $th) {
                echo "<hr>$result<br>";
                die("<hr /> Post: " . $post[0] . " fialed to make a good link<hr>" . $th);
            }
        
            $imagePathFromPHP = $folderPathFromPHP . uniqid() . ".jpg"; 
            
            $imagePathFromPost  = DatabaseHelper::createCorrectPathToImg($imagePathFromPHP);

            try {
                file_put_contents($imagePathFromPHP, file_get_contents($urlToImg));    
                $resize2 = new ResizeImage($imagePathFromPHP);
                $resize2->saveImage($imagePathFromPHP, 60);
            } catch (\Throwable $th) {
                echo $imagePathFromPHP;
            }

            // change the url in the article to the new url
            
            // $element->src = $imagePathFromPost;
            // test
            $element->src = $imagePathFromPHP;

        }

        $html->save();
        $str = $html->find("div[id=wrap]", 0);
        $newArticle = $str->innertext;

        print_r([$newArticle, $fearturedPathFromGalerij]);
        // return [$newArticle, $fearturedPthFromGalerij];
    }
}

$post = Database::getFoto(1, 3);
GalerijHelper::downloadImages($post[0], "../img/galerij")
?>