<?php
set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {
    // error was suppressed with the @-operator
    if (0 === error_reporting()) {
        return false;
    }

    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});
class HTMLcleaner{

    public static function cleanHtml($htmlStr, $allowedattr = array(), $allowedtags = "") {
        $strippedTags = strip_tags($htmlStr, $allowedtags);
        $spansReplaced = preg_replace('/<span\s>(.*?)<\/span\s>/', '<p>$1</p>', $strippedTags);
        $hTagsReplaced= preg_replace('/<h[3-5]>(.*?)<\/h[3-5]>/', '<p>$1</p>', $spansReplaced);
        $strippedAttr = HTMLcleaner::stripAttributes($hTagsReplaced, $allowedattr);
        
        return trim(preg_replace('/\s+/', ' ', $strippedAttr));
    }

    private static function stripAttributes($s, $allowedattr = array()) {
        if (preg_match_all("/<[^>]*\\s([^>]*)\\/*>/msiU", $s, $res, PREG_SET_ORDER)) {
         foreach ($res as $r) {
           $tag = $r[0];
           $attrs = array();
           preg_match_all("/\\s.*=(['\"]).*\\1/msiU", " " . $r[1], $split, PREG_SET_ORDER);
           foreach ($split as $spl) {
            $attrs[] = $spl[0];
           }
           $newattrs = array();
           foreach ($attrs as $a) {
            $tmp = explode("=", $a);
            if (trim($a) != "" && (!isset($tmp[1]) || (trim($tmp[0]) != "" && !in_array(strtolower(trim($tmp[0])), $allowedattr)))) {
      
            } else {
                $newattrs[] = $a;
            }
           }
           $attrs = implode(" ", $newattrs);
           $rpl = str_replace($r[1], $attrs, $tag);
           $s = str_replace($tag, $rpl, $s);
         }
        }
        return $s;
      }
}
?>