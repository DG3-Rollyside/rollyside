# database opzetten

als je zelf de database wilt opzetten dan moet hje een databse aanmaken met de naam `rollyside`. zodra je een database hebt met de naam `rollyside` hebt moet je de tabellen aanmaken de tabellen met de bijbehorende kolommen moeten in dezelfde volgorde gemaakt worden

- `gallerij`
  1 `galerij_id` int `auto increment`
  2 `inhoud` text
  3 `titel` varChar
  4 `featured` varChar

- `nieuws`
 1 `id` int `auto increment`
 2 `titel` varChar
 3 `datum` timestamp
 4 `text` text
 5 `intro_text` varChar(1048)
 6 `img` varChar
 7 `editorData` varChar

- `resettoken`
 1 `pwdResetId` int `auto increment`
 2 `email` varChar
 3 `selector` varChar
 4 `token` varChar
 5 `expires` timestamp

- `users`
 1 `user_id` int `auto increment`
 2 `email` varChar
 3 `username` varChar
 4 `wachtwoord` varChar

zodra je dat hebt kun je verder gaan met het klaarmaken van de database zoals beschreven in [de README](../readme.md)
