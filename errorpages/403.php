<?php
http_response_code(403);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pagenotfound.css">
    <title> 403 </title>
</head>

<body>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="main">
        <h1>403</h1>
        <p> Jij hebt geen toegang tot de<br />
        opgevraagde pagina </p>
        <button type="button" onclick="location.href = '/'">Ga terug</button>
    </div>
</body>

</html>