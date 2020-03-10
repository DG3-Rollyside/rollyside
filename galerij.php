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

     <div clas="galerij">
         <p>Moi eum.</p>

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


 </body>

 </html>