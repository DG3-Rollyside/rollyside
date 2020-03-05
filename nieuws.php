<?php
include_once "php/database.php";

$postsFeatured = Database::getPosts(3, 0);
$posts = Database::getPosts(9,3);

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>rollyside</title>
    <link rel="stylesheet" href="./css/main.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
</head>

<body>
    <header>
        <nav>
            <img class="logo" src="./img/logo.svg" alt="logo" />
            <section class="nav-links">
                <desktop>
                    <ul>
                        <li class="nav-link"><a href="./" name="link naar homepage">Home</a></li>
                        <li class="nav-link"><a href="./nieuws.php" name="link naar nieuws pagina">Nieuws</a></li>
                        <li class="nav-link"><a href="./galerij.php" name="link naar galerij pagina">Galerij</a></li>
                        <li class="nav-link"><a href="./bestuur.php" name="link naar bestuurs pagina">Bestuur</a></li>
                        <li class="nav-link"><a href="./sponsoren.php" name="link naar sponsoren pagina">Sponsoren</a>
                        </li>
                        <li class="nav-button"><a href="./aanmelden.php" name="link naar word lid pagina">Word Lid</a>
                        </li>
                    </ul>
                </desktop>
            </section>
            <div class="hamburger" onclick="openMobileMenu();" id="hamburger-menu" role="button" title="mobiel menu">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </nav>
        <mobile-nav>
            <row>
                <img class="logo" src="./img/logo.svg" alt="logo" />
                <div class="close" onclick="closeMobileMenu()"></div>
            </row>
            <ul>
                <li class="nav-link"><a href="./" name="link naar homepage">Home</a></li>
                <li class="nav-link"><a href="./nieuws.php" name="link naar nieuws pagina">Nieuws</a></li>
                <li class="nav-link"><a href="./galerij.php" name="link naar galerij pagina">Galerij</a></li>
                <li class="nav-link"><a href="./bestuur.php" name="link naar bestuurs pagina">Bestuur</a></li>
                <li class="nav-link"><a href="./sponsoren.php" name="link naar sponsoren pagina">Sponsoren</a></li>
                <li class="nav-button"><a href="./aanmelden.php" name="link naar word lid pagina">Word Lid</a></li>
            </ul>
        </mobile-nav>
    </header>
    <intro>
        <div class="intro-img">
            <div class="centered">
                <h1>Rollyside</h1>
                <p>
                    De supporters van FC Groningen die zich
                    voortbewegen op wielen.
                </p>
                <button><a href="./aanmelden#register-form">word nu lid</a></button>
            </div>
        </div>
    </intro>

    <div id="index">
        <div class="wrapper">
            <div class="news-featured">
                <h1>onze laatste berichten</h1>
                <div class="split-2">
                    <div class="left">
                        <div class="nieuws-featured"
                            style='background-image: url("<?php echo $postsFeatured[0][5] ?>");'>
                            <div class="content">

                                <div class="contents">

                                    <h3 class="title">
                                        <?php echo $postsFeatured[0][1] ?>
                                    </h3>
                                    <h5 class="date"><?php echo date("d F Y",strtotime($postsFeatured[0][2]))?></h5>
                                    <p class="intro-text">
                                        <?php echo $postsFeatured[0][4] ?>
                                    </p>
                                    <a href="./<?php echo $postsFeatured[0][0]; ?>" class="read-more">Lees meer...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="news">
                            <div class="content">
                                <h3 class="title">
                                    <?php echo $postsFeatured[1][1] ?>
                                </h3>
                                <h5 class="date"><?php echo date("d F Y",strtotime($postsFeatured[1][2]))?></h5>
                                <p class="intro-text">
                                    <?php echo $postsFeatured[1][4] ?>
                                </p>
                                <a href="./<?php echo $postsFeatured[1][0]; ?>" class="read-more">Lees meer...</a>
                            </div>
                            <div class="img" style='background-image: url("<?php echo $postsFeatured[1][5] ?>");'>
                            </div>
                        </div>
                        <div class="news">
                            <div class="img" style='background-image: url("<?php echo $postsFeatured[2][5] ?>");'>
                            </div>
                            <div class="content">
                                <h3 class="title">
                                    <?php echo $postsFeatured[2][1] ?>
                                </h3>
                                <h5 class="date"><?php echo date("d F Y",strtotime($postsFeatured[2][2]))?></h5>
                                <p class="intro-text">
                                    <?php echo $postsFeatured[2][4] ?>
                                </p>
                                <a href="./nieuwsArticle?postId=<?php echo $postsFeatured[2][0]; ?>"
                                    class="read-more">Lees meer...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="posts">
        <div class="wrapper">
            <?php foreach($posts as $post) { ?>
            <div class="news">
                <img src="<?php echo $post[5] ?>" alt="<?php echo $post[1]?>" width="600px" height="600px">
                </div>
                <div class="content">
                    <h3 class="title">
                        <?php echo $post[1] ?>
                    </h3>
                    <h5 class="date"><?php echo date("d F Y",strtotime($post[2]))?></h5>
                    <p class="intro-text">
                        <?php echo $post[4] ?>
                    </p>
                    <a href="./nieuwsArticle?postId=<?php echo $post[0]; ?>" class="read-more">Lees
                        meer...</a>
                </div>
            </div>
            <?php }?>

            <div class="navigatie">

            </div>
        </div>
    </div>

    <footer>
        <div class="wrapper">
            <section class="footer-text">
                <h2> Neem contact op </h2>
                <p>
                    Heeft u een vraag of wilt u iets kwijt?
                    Stel deze via onderstaand formulier.
                    Ook reacties op of opmerkingen over
                    rollyside.nl kunt u kwijt via
                    onderstaand formulier U kunt ons ook
                    bereiken door te bellen naar het
                    nummer
                </p>
                <h4> Mobiel: Heike ten Hoove 06-10 860 061 </h4>
                <h4> Adres Secretaris Gerda Boersema </h4>
                <p>
                    Rollyside<br />
                    Torenakkers 10<br />
                    9482 RP Tynaarlo<br />
                </p>
            </section>
            <section>
                <form>
                    <input type="text" placeholder="Naam" class="contact-form" name="naam" />
                    <input type="text" placeholder="Email" class="contact-form" name="email" />
                    <textarea placeholder="Bericht"></textarea>
                    <input type="submit" value="Verstuur" class="submit">
                </form>
            </section>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="./js/owl.carousel.min.js"></script>
    <script>
    function openMobileMenu() {
        let menu = document.getElementsByTagName("mobile-nav")[0];
        menu.classList.add("open");
        document.getElementsByTagName("body")[0].classList.add("fixedPosition")
    }

    function closeMobileMenu() {
        let menu = document.getElementsByTagName("mobile-nav")[0];
        menu.classList.remove("open");
        document.getElementsByTagName("body")[0].classList.remove("fixedPosition")
    }
    </script>
    <script src="./js/site.js"></script>
    <?php require_once("php/cookie.php") ?>
</body>

</html>