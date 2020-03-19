<?php
$payload = file_get_contents("php://input");

$data = json_decode($payload);


echo "<img src='". $data[`featured`] ."' />";