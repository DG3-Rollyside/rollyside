<?php
include_once "imageEditor.php";
include_once "simplehtmldom/HtmlDocument.php";
include_once "databaseHelper.php";
require_once("./url_to_absolute/url_to_absolute.php");

use simplehtmldom\HtmlDocument;


class PostHelper
{

    static $debugIttr = 0;

    public static function GetIntroFromContent($content)
    {

        $start = strpos($content, '<p>');
        $end = strpos($content, '</p>', $start);

        $p = substr($content, $start, $end - $start + 4);
        if (strlen($p) > 256) {
            $p = substr(html_entity_decode(strip_tags($p)), 0, 250);
            $wordArr = explode(" ", $p);
            array_pop($wordArr);

            $final = implode(" ", $wordArr);
            return $final;
        } else {
            return html_entity_decode(strip_tags($p));
        }
    }

    public static function downloadImages($post, $path)
    {
        // check the path to the folder of the images
        $pathArr = explode("/", $path . "/");
        $checkPath = "";
        foreach ($pathArr as $pathPiece) {
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
            } else if (!is_dir($checkPath)) {
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
            if (strlen(trim($url)) == 0 || $post[0] == 3006) {
                echo "url: <strong>Length is 0 on post: " . $post[0] . "</strong><br>";
                echo "<hr/>";
                $imgT = "https://place-hold.it/650";
                $imgF = "https://place-hold.it/1920/1080";
            } else {
                echo $orig;
                file_put_contents($orig, file_get_contents($url));
                $resize = new ResizeImage($orig);
                $resize->resizeTo(1920, 1080, 'maxWidth');
                $resize->saveImage($imgF, 60);
                $post[5] = DatabaseHelper::createCorrectPathToImg($imgF);
                
                // create the thumbnail
                $resize->resizeTo(650, 650, 'exact');
                $resize->saveImage($imgT, 60);
                $post[6] = DatabaseHElper::createCorrectPathToImg($imgT);
                
                echo "THUMBNAIL AND FEATURED IMAGES OF ". $post[0] ."CREATED";
            }
        }

        #download images from the content of the articles
        $doc = new HTmlDocument();
        $tempHtml = "<div id='wrap'> " . $post[3] . "</div>";
        $html = $doc->load($tempHtml);

        // check if the folder exists and when it exists remove all files in that folder
        $folderPathFromPHP = $checkPath . "article_images/";
        if (!is_dir($folderPathFromPHP) && !file_exists($folderPathFromPHP)) {
            mkdir($folderPathFromPHP);
        } else {
            $files = glob($folderPathFromPHP . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned
            foreach ($files as $file) { // iterate files
                if (is_file($file))
                    unlink($file); // delete file
            }
        }
        // download the images in the article
        $url = "http://www.rollyside.nl";
        $imgElements = $html->find('img');

        foreach ($imgElements as $element) {

            $result = ltrim($element->src, '.');
            var_dump($result);
            try {
                $urlToImg = url_to_absolute($url, $result);
            } catch (\Throwable $th) {
                echo "<hr>$result<br>";
                die("<hr /> Post: " . $post[0] . " fialed to make a good link<hr>" . $th);
            }
        
            $imagePathFromPHP = $folderPathFromPHP . uniqid() . ".jpg"; 
            
            $imagePathFromPost  = DatabaseHelper::createCorrectPathToImg($imagePathFromPHP);

            try {
                file_put_contents($imagePathFromPHP, file_get_contents($urlToImg));
                $resize2 = new ResizeImage($imagePathFromPHP);
                $resize2->resizeTo(1280, 720, 'maxWidth');
                $resize2->saveImage($imagePathFromPHP, 60);
            } catch (\Throwable $th) {
                echo $imagePathFromPHP;
            }

            // change the url in the article to the new url
            
            $element->src = $imagePathFromPost;
            // test
            // $element->src = $imagePathFromPHP;
        }

        $html->save();

        $str = $html->find("div[id=wrap]", 0);
        $newArticle = $str->innertext;

        return [$newArticle, $imgF, $imgT];
    }
    private static function createCorrectPathToImg($path)
    {
        $checkPath = "./";
        $pathArr = explode('\\', $path);


        foreach ($pathArr as $pathPiece) {
            if ($pathPiece == "..") {
                continue;
            }
            $checkPath .= $pathPiece . "/";
        }
        $checkPath = rtrim($checkPath, "/");
        return $checkPath;
    }

    public static function decodeEditor($editorDataJson)
    {
        $editorDataArr = json_decode($editorDataJson, 1);
        $html = "";

        foreach ($editorDataArr["blocks"] as $block) {
            switch ($block["type"]) {
                case "image":
                    $url = $block["data"]["url"];
                    $caption = $block["data"]["caption"];

                    $html .=    "<div class='image'>" .
                                    "<img src='$url' alt='$caption'>" .
                                    "<span class='caption'>$caption</span>" .
                                "</div>";
                break;

                case "paragraph":
                    $content = $block["data"]["text"];
                    $html .= "<p>$content</p>";
                break;

                case "header":
                    $content = $block["data"]["text"];
                    $headersizeFromObj = (int) $block["data"]["level"];
                    $size = ($headersizeFromObj <= 2) ? 2 : 3;

                    $html .= "<h$size> $content </h$size>";
                break;

                case "list":
                    $type = $block["data"]["style"];

                    if ($type == "ordered") {
                        $html.= "<ol>";
                    } else {
                        $html.= "<ul>";
                    }

                    foreach($block["data"]["items"] as $item) {
                        $html .= "<li>$item</li>";
                    }

                    
                    if ($type == "ordered") {
                        $html.= "</ol>";
                    } else {
                        $html.= "</ul>";
                    }
                break;

                case "embed":
                    $link = $block["data"]["source"];
                    $linkArr = split_url($link);
                    print_r($linkArr);
                    $embedLink = "http://www.youtube.com/embed/" . $linkArr["path"];
                    $html .= "<iframe src='$embedLink' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
            }


        }
        return $html;
    }
}
$json = '{"time":1583831879555,"blocks":[{"type":"image","data":{"url":"https://i.imgur.com/lz552aT.png","caption":"à wild pokemon","withBorder":false,"withBackground":false,"stretched":false}},{"type":"paragraph","data":{"text":"this is a paragarph"}},{"type":"header","data":{"text":"this is a header","level":2}},{"type":"quote","data":{"text":"this is a qoute","caption":"this is a name","alignment":"left"}},{"type":"list","data":{"style":"ordered","items":["this is a ordered list","this is the secodn item"]}},{"type":"list","data":{"style":"unordered","items":["this is a unorded list","this is the second unordered item"]}},{"type":"embed","data":{"service":"youtube","source":"https://youtu.be/dQw4w9WgXcQ","embed":"https://www.youtube.com/embed/dQw4w9WgXcQ","width":580,"height":320,"caption":""}}],"version":"2.16.1"}';

$cleanHtml = PostHelper::decodeEditor($json);

echo $cleanHtml;