<?php
include_once "../php/database.php";
include_once "../php/databasehelper.php";

$payload = file_get_contents("php://input");

$data = json_decode($payload, true);

// print_r($data);

$id = Database::createBlankGallerij();

$imgPath = "../img/galerijen/$id";
$pathArr = explode("/", $imgPath);
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

$featuredImgFromPhp =  $checkPath . "FEATURED.jpg";
$feturedImg = DatabaseHelper::createCorrectPathToImg($featuredImgFromPhp);

saveImg($featuredImgFromPhp, $data["featured"]);


function saveImg($path, $imageData) {

    /*
    $img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$fileData = base64_decode($img);*/


    $imageData = str_replace('data:image/png;base64', '');
    $imageData = base64_decode($imageData);
    $source = imagecreatefromstring($imageData);
    $imageSave = imagejpeg($rotate,$imageName,100);
    imagedestroy($source);
}
