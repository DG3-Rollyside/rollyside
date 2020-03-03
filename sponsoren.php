<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>rollyside</title>
    <link rel="stylesheet" href="./css/main.css" />
    <link rel="stylesheet" href="./css/sponsoren.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="icon" href="./img/Rollyside-favicon-appicon.png" type="image/favicon.ico">
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
    <div id="sponsoren">
        <div class="wrapper">
            <div class="split-2">
                <div>
                    <p>
                        De Rollyside is niet zo maar een supportersvereniging, het is ook een vrienden vereniging waar veel
                        wordt gedaan aan ontmoetingen buiten het stadion om. Om dit te bekostigen hebben wij sponsoren
                        nodig. Draagt u de Rollyside ook een warm hard toe? dan komt uw link bij deze onderstaande links.
                        Het hoeft niet altijd in geld, het kan ook zijn in middelen.
                    </p>
                    <h2> <a href="#contact" data-scroll> Wil je ook een sponsor worden, <br> neem dan contact op! </a></h2>
                </div>
                <h1>
                    Onze sponsoren
                </h1> 
                
            </div>
            <div class="carousel_wrapper">
                <div class="owl-carousel">
                    <a class="sponsoren-logo" href="https://www.allure-energie.nl/" target="_blank">
                        <img src="./img/sponsoren/allure.png" class="logo" alt="Logo Allure Energie">
                        <div class="name"> Allure Energie </div>
                    </a>
                     <a class="sponsoren-logo" href="https://www.cafefootball.eu/" target="_blank">
                        <img src="./img/sponsoren/cafe.jpg" class="logo" alt="Logo CAFE">
                        <div class="name"> CAFE - Centre for access to football in Europe. </div>
                    </a>
                     <a class="sponsoren-logo" href="https://www.svfcgroningen.nl/" target="_blank">
                        <img src="./img/sponsoren/svfcg.png" class="logo" alt="Logo Supportersvereniging FCG">
                        <div class="name"> Supportersvereniging FCG </div>
                    </a>
                     <a class="sponsoren-logo" href="https://www.fcgroningen.nl/" target="_blank">
                        <img src="./img/sponsoren/fcgroningen.png" class="logo" alt="Logo FC Groningen">
                        <div class="name"> FC Groningen </div>
                    </a>
                     <a class="sponsoren-logo" href="http://www.hibernianfc.co.uk/" target="_blank">
                        <img src="./img/sponsoren/hibernian.png" class="logo" alt="Logo Hibernian FC">
                        <div class="name"> Hibernian FC </div>
                    </a>
                     <a class="sponsoren-logo" href="https://www.humanitas.nl/" target="_blank">
                        <img src="./img/sponsoren/humanitas.png" class="logo" alt="Logo Humanitas">
                        <div class="name"> Humanitas </div>
                    </a>
                    <a class="sponsoren-logo" href="https://www.knvb.nl/" target="_blank">
                        <img src="./img/sponsoren/knvb.png" class="logo" alt="Logo KNVB">
                        <div class="name"> KNVB </div>
                    </a>
                    <a class="sponsoren-logo" href="https://www.zorgbelang-groningen.nl/" target="_blank">
                        <img src="./img/sponsoren/zorgbelang.png" class="logo" alt="Logo Zorgbelang">
                        <div class="name"> Zorgbelang Groningen </div>
                    </a>
                </div>
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
                <h4> Mobiel: 06-10 860 061 </h4>
                <h4> Adres Secretaris </h4>
                <p>
                    Rollyside<br />
                    Torenakkers 10<br />
                    9482 RP Tynaarlo<br />
                </p>
            </section>
            <section>
                <form id="contact">
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="./js/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15.0.0/dist/smooth-scroll.polyfills.min.js"></script>
    <script>
    var scroll = new SmoothScroll('a[href*="#"]', {
        header: 'header'
    });

    $(".owl-carousel").owlCarousel({
        items: 4,
        dots: true,
        margin: 50,
        lazyload: true,
        autoWidth: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1200: {
                items: 4
            }
        }
    });

    $(".owl-dot").map((i, elem) => {
        $(elem).attr("aria-label", `Carousel navigatie ${i}`);
    });

    function openMobileMenu() {
        let menu = document.getElementsByTagName("mobile-nav")[0];
        menu.classList.add("open");
    }

    function closeMobileMenu() {
        let menu = document.getElementsByTagName("mobile-nav")[0];
        menu.classList.remove("open");
    }
    </script>
</body>

</html>