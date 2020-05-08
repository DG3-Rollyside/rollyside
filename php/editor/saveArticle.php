<?php

$dataFromCreator = json_decode(file_get_contents("php://input"),true);
$post = $dataFromCreator["post"];

$blocks = $dataFromCreator["art"]["blocks"];

$article = "";
foreach($blocks as $block) {
    $data = $block["data"];

    $html = "";
    switch($block["type"]) {
        // if the block is a image
        case "image":
            $url = $data["file"]["url"];

            $html .= "<div class=\'image\'>";
            
            if ($data["caption"] == "false") {
                $html .= "<img src=\'$url\'>";

            } else {
                $caption = $data["caption"];
                $html .= "<img src=\'". $url ."\' alt=\'$caption\'>";
                $html .= "<span class=\'caption\'>$caption</span>";
            }

            $html .= "</div>";
        break;

        // block is a quote
        case "quote": 
            $html .= "
            <div class=\'quote\'>
                <p class=\'text\'>". $data["text"] ."</p>
                <p class=\'caption\'>". $data["caption"] ."</p>
            </div>";
        break;

        // block is a special link
        case "linkTool":
            $meta = $data["meta"];
            $html .= "
            <div class=\'link\'>
                <a href=\'". $data["link"] ."\'>
                    <p class=\'title\'>". $meta["title"] ."</p>
                    <p class=\'description\'>". $meta["description"] ."</p>
                    <img src=\'". $meta["image"]["url"] ."\' alt=\'". $meta["site_name"] ."\'>
                    <p class=\'site_name\'>". $meta["site_name"] ."</p>
                </a>
            </div>";
        break;

        // block is a list
        case "list":
            $html .= "<div class=\'list\'>";
            // check what type of list it is
            if ($data["style"] == "unordered") {
                // list is a unordered list
                $html .= "<ul>";
                foreach($data["items"] as $str) {
                    $html .= "<li>$str</li>";
                }
                $html .= "</ul>";
                
            } else {
                // list is a ordered list
                $html .= "<ol>";
                foreach($data["items"] as $str) {
                    $html .= "<li>$str</li>";
                }
                $html .= "</ol>";
            }
            $html .= "</div>";

        break;

        // block is a header
        case "header":

            $html .= "<div class=\'header\'>";
            //check the level of the header
            if($data["level"] == 1) {
                $html .= "<h2>". $data["text"] ."</h2>";
            } else {
                $html .= "<h3>". $data["text"] ."</h3>";
            }
            $html .="</div>";
        break;

        // block is a paragraph
        case "paragraph":
            $html .= "<div class=\'p\'><p>". $data["text"] ."</p></div>";
        break;

        // block is a embed
        case "embed":
            $link = $data["source"];
            $linkArr = split_url($link);
            $embedLink = "http://www.youtube.com/embed/" . $linkArr["path"];
            $html .= "<iframe src=\'$embedLink\' frameborder=\'0\' allow=\'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\' allowfullscreen></iframe>";
        break;



    }

    $article .= $html;
    // isert it into the database
    include_once "../database.php";
    $insert_id = 0;
    if (!isset($_GET["postId"])) {
        include_once "../posthelper.php";
        $intro = PostHelper::GetIntroFromContent($article);
        $insert_id = Database::createPost($post["title"], $intro, $article, $post["intro_img"], $post["post_img"], date("Y:m:j", strtotime($post["created_at"])), $dataFromCreator);
    } else {
        $insert_id  =$_GET["postId"];
        Database::updatePostContent($insert_id, $article, $dataFromCreator);
    }

    echo $insert_id;

}

?>

