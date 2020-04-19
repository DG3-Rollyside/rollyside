<?php
include_once "../php/database.php";
include_once "../php/databasehelper.php";

$payload = file_get_contents("php://input");

$data = json_decode($payload, true);

// print_r($data);
if (!isset($_GET["id"])) {
    $id = Database::createBlankGallerij();
    echo $id;
} else if($_GET["id"] == "-1" || $_GET["id"] == ""){
    $id = Database::createBlankGallerij();  
    echo $id;
} else {
    $id = $_GET["id"];
    echo $id;
}


$imgPath = "../img/galerijen/$id";
if (file_exists($imgPath)) {
    delete_files($imgPath);
}

$pathArr = explode("/", $imgPath);
$checkPath = "";
foreach ($pathArr as $pathPiece) {
    if ($pathPiece == "..") {
        $checkPath .= "../";
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
    $checkPath .= '/';

}

$featuredImgFromPhp =  $checkPath . "FEATURED.jpg";
$featuredImg = DatabaseHelper::createCorrectPathToImg($featuredImgFromPhp);

saveImg($featuredImgFromPhp, $data["featured"]);

$html = "";

mkdir("../img/galerijen/$id/post");
foreach($data["post"] as $img) {
    $pathImg = "../img/galerijen/$id/post/" . uniqid() . ".jpg";
    $pathFromPost = DatabaseHelper::createCorrectPAthToImg($pathImg);
    $html .= "<a href='$pathFromPost'><img src='$pathFromPost'></a>";
    saveImg($pathImg, $img);
}
// deze werkt niet
Database::fillGalerij($id, $data["title"], $html, $featuredImg);



function saveImg($path, $imageData) {
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
    $imageData = str_replace('data:image/gif;base64,', '', $imageData);
    $imageData = base64_decode($imageData);
    $source = imagecreatefromstring($imageData);
    $imageSave = imagejpeg($source ,$path,100);
    imagedestroy($source);
}

function delete_files($target) {
    $dir = $target;
    $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
    foreach($files as $file) {
        if ($file->isDir()){
            rmdir($file->getRealPath());
        } else {
            unlink($file->getRealPath());
        }
    }
    rmdir($dir);
}


function delete_directory($dirname) {
    if (is_dir($dirname))
        $dir_handle = opendir($dirname);
    if (!$dir_handle)
        return false;
    while($file = readdir($dir_handle)) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dirname."/".$file))
                unlink($dirname."/".$file);
        else
                delete_directory($dirname.'/'.$file);
        }
    }
    closedir($dir_handle);
    rmdir($dirname);
    return true;
}


?>