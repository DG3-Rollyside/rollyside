<?php 
include_once "imageEditor.php";
include_once "simplehtmldom/HtmlDocument.php";
include_once "./url_to_absolute/url_to_absolute.php";

use simplehtmldom\HtmlDocument;


class PostHelper {

    static $debugIttr = 0;

    public static function GetIntroFromContent($content) {

        $start = strpos($content, '<p>');
        $end = strpos($content, '</p>', $start);

        $p = substr($content, $start, $end-$start+4);
        if (strlen($p) > 256) {
            $p = substr(html_entity_decode(strip_tags($p)),0, 250);
            $wordArr = explode(" ", $p);
            array_pop($wordArr);
    
            $final = implode(" ", $wordArr);
            return $final;
        } else {
            return html_entity_decode(strip_tags($p));
        }
    }

    public static function downloadImages($post, $path) {
        // check the path to the folder of the images
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

        // if it comes here the path is a valid folder and we will download the featered img
        $url = $post[5];
        $orig = $checkPath . "ORIGINAL.jpg";
        $imgF = $checkPath . "FEATURED.jpg";
        $imgT = $checkPath . "THUMBNAIL.jpg";
        if (file_exists($orig)) {
        // if (true){
            // die("<strong>FATAL ERROR: </strong>Image Already exists: <strong>$orig</strong>");
        } else {
            // create the featured img
            if(strlen(trim($url)) == 0 || $post[0] == 3006) {
                echo "url: <strong>Length is 0 on post: ". $post[0] ."</strong><br>";
                echo "<hr/>";
                $imgT = "https://place-hold.it/650";
                $imgF = "https://place-hold.it/1920/1080";

            } else {
                echo $orig;
                file_put_contents($orig, file_get_contents($url));    
                $resize = new ResizeImage($orig);
                $resize->resizeTo(1920, 1080, 'maxWidth');
                $resize->saveImage($imgF, 60);
                $post[5] = $imgF;
                
                // create the thumbnail
                $resize->resizeTo(650,650, 'exact');
                $resize->saveImage($imgT, 60);
                $post[6] = $imgT;
                
                echo "THUMBNAIL AND FEATURED IMAGES OF ". $post[0] ."CREATED";
            }
        }

        #download images from the content of the articles
        $doc = new HTmlDocument();
        $tempHtml = "<div id='wrap'> ". $post[3] . "</div>"; 
        $html = $doc->load($tempHtml);

        // check if the folder exists and when it exists remove all files in that folder
        $folderPathFromPHP = $checkPath . "article_images/";
        if (!is_dir($folderPathFromPHP) && !file_exists($folderPathFromPHP)) {
            mkdir($folderPathFromPHP);
        } else {
            $files = glob( $folderPathFromPHP . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
            foreach($files as $file){ // iterate files
                if(is_file($file))
                  unlink($file); // delete file
              }
        }
        // download the images in the article
        $url = "http://www.rollyside.nl";
        $imgElements = $html->find('img'); 

        foreach($imgElements as $element) {

            $result = ltrim($element->src, '.');
            var_dump($result);
            try {
                $urlToImg = url_to_absolute($url, $result);
            } catch (\Throwable $th) {
                echo "<hr>$result<br>";
                die("<hr /> Post: " . $post[0] . " fialed to make a good link<hr>".$th);
            }
        
            $imagePathFromPHP = $folderPathFromPHP . uniqid() . ".jpg"; 
            
            $imagePathFromPost  = PostHelper::createCorrectPathToImg($imagePathFromPHP);

            try {
                file_put_contents($imagePathFromPHP, file_get_contents($urlToImg));    
                $resize2 = new ResizeImage($imagePathFromPHP);
                $resize2->resizeTo(1280,720, 'maxWidth');
                $resize2->saveImage($imagePathFromPHP, 60);
            } catch (\Throwable $th) {
                echo $imagePathFromPHP;
            }

            // change the url in the article to the new url
            
            $element->src = "<strong>".$imagePathFromPost."</strong>";
            // test
            // $element->src = $imagePathFromPHP;
        }

        $html->save();
        
        $str = $html->find("div[id=wrap]", 0);
        $newArticle = $str->innertext;

        return [$newArticle, $imgF, $imgT];
        


        


    }
    private static function createCorrectPathToImg($path) {
        $checkPath = "./";
        $pathArr = explode('\\', $path);

        
        foreach($pathArr as $pathPiece){
            if ($pathPiece == "..") {
                continue;    
            }
            $checkPath .= $pathPiece . "/";
        }
        $checkPath = rtrim($checkPath, "/");
        return $checkPath;

    }
}
?>