<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="De Rollyside is de supportersvereniging voor minder validen van FC Groningen. Meld je aan!" />

    <title>rollyside</title>
    <link rel="stylesheet" href="./css/scss_comp/main.css" />
    <link rel="stylesheet" href="./css/scss_comp/index.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/owl.carousel.min.css">

    <link rel="preload" href="./img/logo.svg" as="image">
    <link rel="preload" href="./img/header-img.jpg" as="image">
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
                            style='background-image: url("http://www.rollyside.nl/wp-content/uploads/2020/01/IMG_0671-1-rotated.jpg");'>
                            <div class="content">
                                <div class="contents">

                                    <h3 class="title">
                                        Angst op mindervaliden-tribune FC na afstekenfakkel: ‘Je ziet hem bijna
                                        dood gaan’
                                    </h3>
                                    <h5 class="date">18-01-2020</h5>
                                    <p class="intro-text">
                                        De rookbom die tijdens FC Groningen – Ajax werd afgestoken, zorgde voor angstige
                                        momenten op de Rollyside, de tribune voor FC-supporters die in een rolstoel
                                        zitten of visueel gehandicapt zijn.
                                    </p>
                                    <a href="autgen" class="read-more">Lees meer...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="news">
                            <div class="content">
                                <h3 class="title">
                                    Angst op mindervaliden-tribune FC na afsteken
                                    fakkel: ‘Je ziet hem bijna
                                    dood gaan’
                                </h3>
                                <h5 class="date">18-01-2020</h5>
                                <p class="intro-text">
                                    De rookbom die tijdens FC Groningen – Ajax werd afgestoken, zorgde voor angstige
                                    momenten op de Rollyside, de tribune voor FC-supporters die in een rolstoel
                                    zitten of visueel gehandicapt zijn.
                                </p>
                                <a href="autgen" class="read-more">Lees meer...</a>
                            </div>
                            <div class="img"
                                style='background-image: url("http://www.rollyside.nl/wp-content/uploads/2020/01/IMG_0671-1-rotated.jpg");'>
                            </div>
                        </div>
                        <div class="news">
                            <div class="img"
                                style='background-image: url("http://www.rollyside.nl/wp-content/uploads/2020/01/IMG_0671-1-rotated.jpg");'>
                            </div>
                            <div class="content">
                                <h3 class="title">
                                    Angst op mindervaliden-tribune FC na afsteken
                                    fakkel: ‘Je ziet hem bijna
                                    dood gaan’
                                </h3>
                                <h5 class="date">18-01-2020</h5>
                                <p class="intro-text">
                                    De rookbom die tijdens FC Groningen – Ajax werd afgestoken, zorgde voor angstige
                                    momenten op de Rollyside, de tribune voor FC-supporters die in een rolstoel
                                    zitten of visueel gehandicapt zijn.
                                </p>
                                <a href="autgen" class="read-more">Lees meer...</a>
                            </div>
                        </div>
                        </divi>
                    </div>
                </div>
                <button onclick="window.location = './nieuws.php';" class="button">Bekijk meer berichten</button>
            </div>
        </div>
    </div>
    <div id="sponsoren">
        <div class="wrapper">
            <h1>Onze sponsoren</h1>
            <div class="owl-carousel">
                <a class="sponsoren-logo" href="https://www.allure-energie.nl/" target="_blank">
                    <img src="./img/sponsoren/allure.png" class="logo" alt="Logo Allure Energie">
                </a>
                <a class="sponsoren-logo" href="https://www.cafefootball.eu/" target="_blank">
                    <img src="./img/sponsoren/cafe.png" class="logo" alt="Logo CAFE">
                </a>
                <a class="sponsoren-logo" href="https://www.svfcgroningen.nl/" target="_blank">
                    <img src="./img/sponsoren/svfcg.png" class="logo" alt="Logo Supportersvereniging FCG">
                </a>
                <a class="sponsoren-logo" href="https://www.fcgroningen.nl/" target="_blank">
                    <img src="./img/sponsoren/fcgroningen.png" class="logo" alt="Logo FC Groningen">
                </a>
                <a class="sponsoren-logo" href="http://www.hibernianfc.co.uk/" target="_blank">
                    <img src="./img/sponsoren/hibernian.png" class="logo" alt="Logo Hibernian FC">
                </a>
                <a class="sponsoren-logo" href="https://www.humanitas.nl/" target="_blank">
                    <img src="./img/sponsoren/humanitas.png" class="logo" alt="Logo Humanitas">
                </a>
                <a class="sponsoren-logo" href="https://www.knvb.nl/" target="_blank">
                    <img src="./img/sponsoren/knvb.png" class="logo" alt="Logo KNVB">
                </a>
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
                <form id="messageForm">
                    <input type="text" placeholder="Naam" class="contact-form" name="naam" />
                    <input type="text" placeholder="Email" class="contact-form" name="email" />
                    <textarea placeholder="Bericht" name="bericht"></textarea>
                    <input type="submit" value="Verstuur" class="submit">
                </form>
            </section>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="./js/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15.0.0/dist/smooth-scroll.polyfills.min.js"></script>
    <script>
    let scroll = new SmoothScroll('a[href*="#"]', {
        header: 'header'
    });

    $(".owl-carousel").owlCarousel({
        items: 4,
        dots: true,
        margin: 50,
        lazyLoad: true,
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

    $('#messageForm').submit(function() {
        try {
            let form = document.getElementById("messageForm");

            $(this).serializeArray();
        } catch (error) {
            console.error(error);
            return false;
        }
        return false;
    })

    // Example POST method implementation:
    async function postData(url = '', data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            mode: 'same-origin', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
                'Content-Type': 'application/json'
                // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *client
            body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return await response.json(); // parses JSON response into native JavaScript objects
    }
    </script>
    <script src="./js/site.js"></script>
    <?php require_once("php/cookie.php") ?>
</body>

</html>