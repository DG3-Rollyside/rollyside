 <!DOCTYPE html>
 <html lang="nl">

 <head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>rollyside</title>
     <link rel="stylesheet" href="./css/main.css" />
     <link rel="stylesheet" href="./css/bestuur.css">
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
     <div id="bestuur">
         <div class="wrapper">
             <div class="split-2">
                 <h1>
                     Ons bestuur
                 </h1>
                 <p>
                     De Rollyside is een supportersvereniging van supporters van FC Groningen die zich voortbewegen op
                     wielen of visuele gehandicapt zijn. Wij als bestuur van de Rollyside
                     behartigt de belangen van de leden zo goed mogelijk bij FC Groningen. Zo hebben wij ervoor gezorgd
                     dat
                     de rollende
                     supporters van FC Groningen een eigen plek in het stadion hebben. De Rollyside zit op de omloop van
                     de
                     eerste ring tegenover de hoofdtribune (op de Piet Fransen tribune).
                 </p>
             </div>
             <div class="carousel_wrapper">
                 <div class="owl-carousel">
                     <div class="bestuurs_lid">
                         <img src="./img/bestuurs_leden/johan.jpg" alt="Johan ten Hoove">
                         <h3 class="name">Johan ten Hoove</h3>
                         <p>Voorzitter</p>
                         <a href="mailto:johantenhoove@rollyside.nl">Stuur een mail</a>
                     </div>

                     <div class="bestuurs_lid">
                         <img src="./img/bestuurs_leden/gerda.jpg" alt="Gerda Boersema">
                         <h3 class="name">Gerda Boersema</h3>
                         <p>Secretaris</p>
                         <a href="mailto:gerdaboersema@rollyside.nl">Stuur een mail</a>
                     </div>

                     <div class="bestuurs_lid">
                         <img src="./img/bestuurs_leden/heike.jpg" alt="Heike ten Hoove">
                         <h3 class="name">Heike ten Hoove</h3>
                         <p>Penningmeester</p>

                     </div>

                     <div class="bestuurs_lid">
                         <img src="./img/bestuurs_leden/harry.jpg" alt="Harry de Jong">
                         <h3 class="name">Harry de Jong</h3>
                         <p>Bestuurds lid</p>
                     </div>

                     <div class="bestuurs_lid">
                         <img src="./img/bestuurs_leden/lars.jpg" alt="Lars Mulderije">
                         <h3 class="name">Lars Mulderije</h3>
                         <p>Bestuurs lid</p>
                     </div>
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
     <script>
     $(".owl-carousel").owlCarousel({
         items: 4,
         dots: !0,
         margin: 50,
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

     $(".owl-dot").map((i, elem)=> {
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