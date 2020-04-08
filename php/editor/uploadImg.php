<?php
require_once "../databasehelper.php";
header('Content-Type: application/json');

if (!is_dir("../../img/nieuwsberichten")) {
    mkdir("../../img/nieuwsberichten");
}


if (isset($_GET["file"])) {
    if ($_GET["file"] == 1) {
        $id = uniqid();

        $imgstr = file_get_contents($_FILES["image"]["tmp_name"]);
        $link = "../../img/nieuwsberichten/$id.jpg";
        file_put_contents($link, $imgstr);
        $path = "./img/nieuwsberichten/$id.jpg";
        
        $resp = '{"success": 1, "file": {"url": "'.$path.'"}}';
        echo $resp;
    }
}

if (isset($_GET["link"])) {
    if ($_GET["link"] == 1) {
        $data = json_decode(file_get_contents("php://input"), true);
        $url = $data["url"];

        $id = uniqid();

        $imgstr = file_get_contents($url);
        $link = "../img/nieuwsberichten/$id.jpg";
        file_put_contents($link, $imgstr);
        $path = "./img/nieuwsberichten/$id.jpg";
        
        $resp = '{"success": 1, "file": {"url": "'.$path.'"}}';
        echo $resp;
    }
}

/*
https://localhost/dg3/img/nieuwsberichten/5e7b33df90120.jpg
https://localhost/dg3/img/nieuwsberichten/5e7b33df8fdd4.jpg
*/