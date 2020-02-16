<?php 


class PostHelper {
    public static function GetIntroFromContent($content) {

        $start = strpos($content, '<p>');
        $end = strpos($content, '</p>', $start);

        $p = substr($content, $start, $end-$start+4);
        if (strlen($p) > 256) {
            $p = substr(html_entity_decode(strip_tags($p)),0, 256);
            $wordArr = explode(" ", $p);
            array_pop($wordArr);
    
            $final = implode(" ", $wordArr) . "&#8230";
            return $final;
        } else {
            return html_entity_decode(strip_tags($p)) . "&#8230";
        }
    }
}
?>