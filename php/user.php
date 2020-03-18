<?php
include_once "database.php";


class User {
    public static function login($username, $password) {
        if (session_status() == PHP_SESSION_NONE) {
            echo "no session";
            session_start();
        }

        $userinfo = Database::getUserInfo($username);
        if(!isset($userinfo[0])) {
            return 0;
        }

        if (password_verify($password, $userinfo[3])) {
            session_regenerate_id();

            $_SESSION['loggedin'] = TRUE;
            $_SESSION["name"] = $username;
            $_SESSION['id'] = $userinfo[0];

            return 2;
        } else {
            session_destroy();

            return 1;
        }

    }

    public static function createPassword($password) {
        $hashed = password_hash($password, PASSWORD_BCRYPT);

        var_dump($hashed);
    }

    public static function checkedLoggedIn() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION["loggedin"], $_SESSION["name"], $_SESSION["id"])) {
            $user = Database::getUserExplicit($_SESSION["id"], $_SESSION["name"]);
            if (isset($user[0])) {
                return true;
            }
        } 

        return false;
    }

    public static function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();
    }
}
?>