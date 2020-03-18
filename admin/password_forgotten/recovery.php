<?php
require_once("../../php/globals.php");

require_once "../../php/database.php";
// if (!isset($_POST["reset"])) {
//     Header("Location: $PATH_TO_SITEa/dmin/password_forgotten/passwordRecoveyform.php");
//     die();
// }

$_POST["email"] = "michelgerding@gmail.com";

$selector = bin2hex(random_bytes(8));
$token = random_bytes(32);

$url = "$PATH_TO_SITE/admin/password_forgotten/resetPassword.php?selector=$selector&token=" . bin2hex($token);
$expires = date("U") + 900;
$encToken = password_hash($token, PASSWORD_BCRYPT);

// make the object to insert into the database
$dataObj = new stdClass;
$dataObj->email = $_POST["email"];
$dataObj->token = $encToken;
$dataObj->selector = $selector;
$dataObj->expires = $expires;


Database::insertPasswordReset($dataObj);
$username = Database::getUsernameFromEmail($_POST["email"])[0];
include_once "mailtemplate.php";

$to = $_POST["email"];
$subject = "je wachtwoord reset link";
$mail = mailTemplate($url, $username);
$headers =  "From: Rollyside <noreply@rollyside.nl>" . "\r\n" . 
            "Reply-To: noreply@rollyside.nl" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
            
mail($to, $subject, $mail, $headers);

Header("Location: $PATH_TO_SITE/admin/password_forgotten/passwordRecoveyform.php?status=success");
?>