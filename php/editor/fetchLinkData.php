<?php 
header('Content-Type: application/json');

if(!isset($_GET["url"])) {
    die('{"succes": 0}');
}
$url = $_GET["url"];
require_once "./openGraph/openGraph.php";
$graph = OpenGraph::fetch($url);

// make the obj for the site
$site = array();
$site["title"] = $graph->title;
$site["site_name"] = $graph->site_name;

$site["description"] = $graph->description;
$site["image"] = array("url" => $graph->image);

$res = array("success" => 1, "meta" => $site);

echo json_encode($res);
?>