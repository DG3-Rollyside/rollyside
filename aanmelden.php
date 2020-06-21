
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>rollyside</title>
    <link rel="stylesheet" href="./css/minified/main.min.css" />
    <link rel="stylesheet" href="./css/wordlid.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.1.2/simple-lightbox.min.css">
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

    <div id="aanmelden">
        <div class="wrapper">
            <p>
                Wilt u ook lid worden van onze vereniging? Voor een bedrag van € 10,00 per voetbalseizoen heeft u al een lidmaatschap. Stuur een mail via contact en vermeld in de mail duidelijk uw Naam, Adres, Postcode, Woonplaats, Geboortedatum en Telefoonnummer. Indien aanwezig uw MIVA plek op de Rollyside in het stadion. De contributie van € 10,00 kunt u rechtstreeks overmaken naar NL04ABNA0423127292 t.n.v. de Rolly-Side Groningen.
            </p>
            <p>Vul het onderstaande formulier in of klik hier en word vandaag ook nog lid van onze vereniging!</p>
            <form action="./php/sendMail.php" class="form">
                <input type="text" name="naam"  placeholder="Naam" required>
                <input type="text" name="adres"  placeholder="Adres" required>
                <input type="text" name="postocde"  placeholder="postcode" required>
                <input type="date" name="datum" placeholder="Geboortedatum" required>
                <input type="text" name="telefoon" placeholder="Telefoonnummer" required>
                <input type="text" name="woonplaats" placeholder="Woonplaats" required>
                <input type="email" name="mail" placeholder="Email" required>
                <textarea name="bericht" cols="30" rows="10" placeholder="bericht"></textarea>
            </form>
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
                <h4> Mobiel: 06-10 860 061 </h4>
                <h4> Adres Secretaris </h4>
                <p>
                    Rollyside<br />
                    Torenakkers 10<br />
                    9482 RP Tynaarlo<br />
                </p>
            </section>
            <section>
                <form>
                    <input type="text" placeholder="Naam" class="contact-form" name="naam"
                        aria-label="Naam Contact formulier" />
                    <input type="text" placeholder="Email" class="contact-form" name="email"
                        aria-label="Email contact formulier" />
                    <textarea placeholder="Bericht" aria-label="bericht contact formulier"></textarea>
                    <input type="submit" value="Verstuur" class="submit" aria-label="verstuur bericht">
                </form>
            </section>
        </div>
    </footer>

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

<?php require_once("php/cookie.php") ?>
</body>

</html>