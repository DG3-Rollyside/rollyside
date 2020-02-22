<?php 
include_once "imageEditor.php";
include_once "simplehtmldom/HtmlDocument.php";
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
        echo ++PostHelper::$debugIttr . "<br>";

        // check the path to the folder of the images
        $pathArr = explode("/", $path . "/".$post[0]);
        $checkPath = "";

        foreach($pathArr as $pathPiece){
            if ($pathPiece == "..") {
                $checkPath .= ".." . DIRECTORY_SEPARATOR;
                continue;    
            }
            $checkPath .= $pathPiece;
            if (!file_exists($checkPath)) {
                mkdir($checkPath);
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
            echo "is $checkPath a path: " . (is_dir($checkPath) ? "true" : "false") . "<br />";
            echo $url ."<br>";
            if(strlen($url) == 0) {
                echo "<hr/><hr/>";
                
                
                echo "url: <strong>Length is 0</strong><br>";
                print_r($post);
                echo "<hr/><hr/>";

            } else {
                file_put_contents($orig, file_get_contents($url));    
                $resize = new ResizeImage($orig);
                $resize->resizeTo(1920, 1080, 'maxWidth');
                $resize->saveImage($imgF, 60);
                $post[5] = $imgF;
                
                // create the thumbnail
                $resize->resizeTo(650,650, 'exact');
                $resize->saveImage($imgT, 60);
                $post[6] = $imgT;
                
                echo "THUMBNAIL AND FEATURED IMAGES CREATED";
                echo "<hr>";
            }
        }

        #download images from the content of the articles
        $doc = new HTmlDocument();
        $tempHtml = "<div id='wrap'> ". $post[4] . "</div>"; 
        $html = $doc->load($tempHtml);
        
        $imgTags = $html->find('img');
        foreach($imgTags as $image) {

            print_r($image);

            $path = $checkPath . uniqid($post[0] . "_") . ".jpg";
            $url = $image->src;

            file_put_contents($path, file_get_contents($url));    
            $resize = new ResizeImage($path);
            $resize->resizeTo(1280, 720, 'maxWidth');
            $resize->saveImage($path, 60);

            $image->src = $path;
        }
        $str = $html->find("div[id=wrap]", 0);
        $newArticle = $str->innertext;

        return [$newArticle, $imgF, $imgT];
        


        


    }
}

?>