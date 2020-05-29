![Logo rollyside](https://www.rollyside.nl/wp-content/uploads/2017/02/Rollyside.nl-LOGO.svg)

# DG3: Rollyside

Deze website hebben we gemaakt voor de module dg3. De site is ontworpen voor de Rollyside. De Rollyside is een fanclub voor de mindervalide fans van FC Groningen die een nieuwe website nodig hadden.

## Inhoudsopgave

- Over het project
- Getting Started
- Gebruik
- Gemaakt met

## Over het project

Deze project was begonnen omdat we  een website wouden maken voor de Rollyside dus toen we de module DG3 erbij pakte hadden we al een ontwerp.
Voor deze website waren een paar extra eisen dan een normale website omdat hij ook goed te gebruiken moet zijn voor mindervaliden dus bijvoorbeeld met een screenreader of alleen met een toetsenbord ook moest je makkelijk een lidmaatschap kunnen afsluiten.

Op de website moesten de volgende paginas komen:

- `Home` pagina met daarop het laatste nieuws en hun sponsoren
- `Nieuws` pagina met alle nieuwsberichten
- `Galerij` pagina met alle foto galerijen
- `bestuur` pagina met een kopje over waar de Rollyside voor werkt en alle leden van het bestuur
- `Sponsoren` pagina met een kopje over hoe je een sponsor kan worden en alle sponsoren
- `Word Lid` pagina waar je een formulier in kunt vullen om lid te worden van de Rollyside

## Getting started

Om de site op je eigen laptop te hosten moet je de volgende stappen volgen.

### Benodigdheden

voordat je de site lokaal kunt runnen moet je `apache met php` hebben. ook moet je een `MySQL` server hebben voor de nieuwsberichten, inloggen, wachtwoord resetten, en galerijen.

### Downloaden

Om de site lokaal te kunnen hosten moet je hem eerst downloaden dat kun je doen door in een terminal het volgende commando uit te voeren

```
git clone "https://github.com/DG3-Rollyside/rollyside.git"
```

of je kunt op de github pagina het project downloaden als een zip bestand

### Database opzetten

als je het project hebt gedownload dan moet er een database gemaakt worden die kun je importeren via het bijgeleverde [rollyside.sql](./rollyside.sql) bestand of je kunt hem zelf aanmaken  zoals beschreven word in [Database Opzetten](./docs/datbase.md)

### gebruiker aanmaken

als je ook berichten en galerijen op de website wil zetten dan heb je een gebruiker nodig. die kun je aanmaken  zoals beschreven in [Gebruiker aanmaken](./docs/user.md)

als je een gebruiker aan hebt gemaakt dan is de website helemaal klaar om te gebruiken

## Gebruik

als je de website wilt gebruiken dan kun je nu gewoon navigeren naar de website maar je zult zien dat er op de homepagina, nieuwspagina, en de galerij of fouten of niks te zien is. dat komt omdat er nog geen berichten zijn  om die aan te maken kun je de volgende stappen volgen

### Inloggen

Als je nog geen gebruiker hebt gemaakt dan moet je dat eerst doen hoe je dat moet doen kun je vinden op de pagina   [Gebruiker aanmaken](./docs/user.md) . als je al wel een gebruiker hebt dan moet je naar de volgende pagina gaan `jouwsite.nl/admin/login.php` daar kun je inloggen door je gebruikersnaam en wachtwoord in te vullen. Als je dat gedaan hebt en geen fouten krijgt dan ben je ingelogd.

### Fotogalerij aanmaken

om een fotogalerij te maken moet je naar de volgende pagina gaan `jouwsite.nl/editors/galerijEditor.php` als je nog niet ingelogd bent zul je naar een foutpagina gestuurd worden en dan moet je opnieuw inloggen zoals beschreven in het kopje inloggen.
Zodra je op de pagina bent dan heb je 2 delen van het scherm:  aan de rechterkant heb je een fotobewerking vak om de hoofdfoto aan te passen, en aan de linker kant heb je 3 invulvelden en een knop.
De 3 invulvelden hebben de volgende functies;  de bovenste is een foto selectieknop om de hoofdfoto te selecteren, het middelste veld is ook een foto selectieknop maar bij deze kun je meerdere foto's selecteren, en bij de onderste kun je de titel van de fotogalerij invullen en daaronder heb je de bijwerken/opslaan knop.
Als je daarop klikt dan sla je de fotogalerij op.
Zodra je een hoofdfoto hebt geselecteerd met de bovenste knop dan komt hij ook tevoorschijn in het rechter deel van het scherm, daarin kun je de foto [bewerken](./docs/editors/featuredimg) de reden waarom je de foto moet bijsnijden is omdat je anders een foto met een verkeerd formaat laat zien waardoor hij soms uitgerekt is.
Als je de hoofdfoto goed hebt bewerkt kun je met de tweede knop alle foto's die je wilt laten zien selecteren, deze foto's zullen niet in het fotobewerking vlak komen te staan maar ze komen wel onder de opslaan knop te staan zodat je kunt zien welke foto's geselecteerd zijn. als je dat allemaal hebt gedaan dan kun je een titel invullen in het onderste invulveld en hem daarna opslaan. als dat allemaal goed krijgt moet je een melding krijgen dat hij goed opgeslagen is en kan je de pagina verlaten en hem gaan bewonderen bij de andere fotogalerijen.

### Nieuwsbericht aanmaken

om een nieuwsbericht aan te maken moet je naar de volgende pagina gaan `jouwsite.nl/berichteditor.php`. als je nog niet ingelogd bent zul je naar een foutpagina gestuurd worden en dan moet je opnieuw inloggen zoals beschreven in het kopje inloggen.
zodra je op de pagina bent aangekomen dan kun je meerdere invulvelden zien waaronder de volgende onderdelen: titelveld, hoofdfoto selectieknop, datumveld, fotobewerkingsveld, opslaan klop, en onderaan het berichtbewerkingsveld.
Deze velden hebben de volgende functies:

- titelveld: een veld om de titel in te vullen
- hoofdfoto selectieknop: een menu om een hoofdfoto te selecteren
- datumveld: een veld om de datum waarop hij online is gegaan in te vullen
- opslaan knop: een knop om het nieuwsbericht op te slaan
- fotobewerkingsveld: een veld om de hoofdfoto mee te bewerken
- berichtbewerkingsveld: een veld om je bericht aan te passen
om een nieuwsbericht te maken moet je een titel invullen als je dat gedaan hebt dan moet je een hoofdfoto selecteren en bewerken zoals beschreven in [Fotos bewerken](,./docs/editors/featuredimg.md) daarna kun je het bericht bewerken zoals beschreven staat in [bericht bewerken](.docs/editors/berichtbewerken.md) als je al dezwe stappen hebt voltooid dan kun je op opslaan klikken en als je dan een succes melding krijgt dan kan je je werk bewonderen bij tussen de andere nieuwsberichten

## Gemaakt met

- [MySQL](https://www.mysql.com/) - Database
- [PHP](https://php.net/) - Server

## Authors

- [@MichelGerding](https://github.com/michelgerdig) - ontwerp, programmeren en documentatie
- [@MercyXVII](https://github.com/MercyXVII) - programmeren en documentatie
