<?php 
include_once "imageEditor.php";
include_once "simplehtmldom/HtmlDocument.php";
include_once "databaseHelper.php";
include_once "database.php";
require_once("./url_to_absolute/url_to_absolute.php");

use simplehtmldom\HtmlDocument;

function DownloadAll() {
    $posts = array();
    $imgs = Database::getAllFoto();

    foreach($imgs as $img) {
        
        $id = $img[0];
        $imgsPath = "../img/$id"

        if(!file_exists($imgsPath)) {

            mkdir($imgsPath);

            $featuredImg = $img[3];
            file_put_contents($imgsPath . "/FEATURES.JPG", file_get_contents($featuredImg));
            $featuredImg = $imgsPath . "/FEATURES.JPG";

            downloadImg($featuredImg, 300, 300);
        }

    }
}

function downloadImg($path, $width, $height) {
            list($width, $height) = getimagesize($featuredImg);
            $new_width = 300;
            $new_height = 300;

            // Resample
            $image_p = imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromjpeg($featuredImg);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

            // Output
            file_put_contents($path, imagejpeg($image_p, null, 100));

}

DownloadAll();