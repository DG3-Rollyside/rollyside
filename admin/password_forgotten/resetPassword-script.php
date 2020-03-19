<?php 
require_once("../../php/globals.php");

//check if the button is pressed to access the page

if(!isset($_POST["resetPassword"])) {
    header("Location: $PATH_TO_SITE/");
    exit();
}
if (!isset($_POST["token"]) || !isset($_POST["selector"])) {
    header("Location: $PATH_TO_SITE/admin/login.php");
    exit();
}

$pw = $_POST["pwd"];
$pwr = $_POST["repeat"];

//check if the passwords match the requirements
if(empty($pw) || empty($pwr)){
    header("Location: $PATH_TO_SITE/admin/password_forgotten/resetPassword.php?token=". $_POST['token'] ."&selector=". $_POST['selector'] ."&status=empty");
    exit();
}
if($pw != $pwr) {
    header("Location: $PATH_TO_SITE/admin/password_forgotten/resetPassword.php?token=". $_POST['token'] ."&selector=". $_POST['selector'] ."&status=match");
    exit();
}
// wachtwoord voldoet aan alle regels

// get the token from the database
include_once "../../php/database.php";

$validator = $_POST["token"];
$selector = $_POST["selector"];


$token = Database::getTokenInfo($selector, date("U"));
//if there was no token found send to password lost page
if (!$token) {
    header("Location: $PATH_TO_SITE/admin/password_forgotten/passwordRecoveyform.php");
    echo "no token found";
    exit();
}

//if you reach this point the passwords are correct and a token has been found
// now we need to check the token
$tokenBin = hex2bin($validator);
if (!password_verify($tokenBin, $token->token)) {
    // if the tokens do not match then we send them back to the start
    header("Location: $PATH_TO_SITE/admin/password_forgotten/passwordRecoveyform.php");
    exit();
}

include_once "../../php/user.php";
User::logout();

$userEmail = $token->email;
Database::updatePasswordByEmail($userEmail, password_hash($pw, PASSWORD_BCRYPT));

header("location: ../login.php");