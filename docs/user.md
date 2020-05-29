# Gebruiker aanmaken

als je de tabellen in de database hebt  dan kun je in de tabel users een gebruiker aanmaken met een wachtwoord gebruikersnaam en email.

Omdat het wachtwoord moet geencrypt moet zijn kun je met de volgende PHP code maken

```php
$password = "Your_Password151";
echo password_hash($password, PASSWORD_BCRYPT);
```

de eisen waar het wachtwoord aan moeten voldoen zij minimaal 1 hoofdletter, 1 getal, 1 speciaal karakter 1 kleine letter en minimaal 8 karakters hebben.
  
zodra je alle gegevens hebt moet je het in de database zetten zodra je dat hebt gedaan kun je weer verder met het klaarmaken van de website
