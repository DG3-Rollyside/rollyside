<?php
//check of de token en selector bestaat;

if(!isset($_GET["selector"]) || !isset($_GET["token"])) {
    http_response_code(403);
    exit();
}
if (!ctype_xdigit($_GET["selector"]) && !ctype_xdigit($_GET["token"]))
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        -ms-flex-align: center;
        -ms-flex-pack: center;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }

    .form-signin .checkbox {
        font-weight: 400;
    }

    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }

    .form-signin .form-control:focus {
        z-index: 2;
    }

    .form-signin input[type="text"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    </style>
</head>

<body class="text-center">
    <div class="container">
        <form class="form-signin" method="post" action="resetPassword-script.php">
            <h1 class="h1 mb-3 font-weight-normal"> Wachtwoord resetten </h1>
            <p class=""> voer je nieuwe wachtwoord in </p>
            <p class="error"><?php 
            if(isset($_GET["status"])) {
                $status = $_GET["status"];
                if($status == "match") {
                    echo "De wachtwoorden zijn niet hetzelfde";
                }
                if($status == "empty") {
                    echo "De wachtwoorden zijn niet ingevuld";
                }
                if($status == "contain") {
                    ?>
        een wachtwoord moet aan de volgende voldoen
        <ul>
            <li>1 of meer hoofdletter</li>
            <li>1 of meer normale letters</li>
            <li>1 of meer nummers</li>
            <li>minimaal 8 characters</li>
            <li>en een of meer van de volgende characters "@$!%*?&"</li>
        </ul>
                    <?php
                }
            }
            ?></p>
            <input type="hidden" name="token" value="<?php echo $_GET["token"]; ?>">
            <input type="hidden" name="selector" value="<?php echo $_GET["selector"]; ?>">
            <input type="password" id="pwd" name="pwd" class="form-control" placeholder="Wachtwoord " required=""autofocus="" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
            <input type="password" id="pwdRepeat" name="repeat" class="form-control" placeholder="Herhaal wachtwoord " required=""autofocus="" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="resetPassword">Verander wachtwoord</button>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>