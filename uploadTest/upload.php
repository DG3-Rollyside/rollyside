<?php
require_once("../php/url_to_absolute/url_to_absolute.php");

$path = "./uploads/";

$bulkImages = $_FILES["bulkImg"];

$featuredImg = $_FILES["featured"];
$featuredName = uniqid() . "." . explode(".", $featuredImg["name"])[0];
$featured = array("name" => $featuredName, "temp_name" => $featuredImg["tmp_name"], "type" => $featuredImg["type"]);


$imgs = array();
for ($i=0; $i < sizeof($bulkImages["name"]); $i++) {
    echo $i;
    
    var_dump($bulkImages["name"][$i]);

    $name = uniqid() .".". explode(".", $bulkImages["name"][$i])[1];
    array_push($imgs,
        array(
            "temp_name" => $bulkImages["tmp_name"][$i],
            "type" => $bulkImages["type"][$i],
            "name" =>  $name) );
}



uploadImg($featured, $path);
foreach($imgs as $img) {
    uploadImg($img, $path);
}


function uploadImg($img, $path) {
    $filename = $path . $img["name"];
    file_put_contents($filename, file_get_contents($img["temp_name"]));
}
?>

