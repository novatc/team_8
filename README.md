**Team8**

Gruppenmitglieder:
* Lucas Wagner
* Nico Schönfisch
* Johannes Scheibe

Zum Betrieb allgemeine, notwendige Informationen:
* Die Webseite wird mit einer gefüllten Datenbank abgegeben, sollte diese gelöscht werden wird einen neue Datenbank erzeugt, in der keine Beispieldaten eingefügt worden sind.
* 4 Beispiel Nutzer können über das PHP-Script fill_dummy-data.php (Pfad: http://localhost/.../team8/db/fill_dummy_data.php) eingefügte werden.
    * Die Benutzernamen sind "Nico", "Lucas", "Johannes" und "Bot" und dass Passwort aller Beispielnutzer ist "Passwort".

Funktionen und Erklärung der Webseite:

Startseite (index.php):

Login (login.php):
* Hier kann sich ein bereits registrierter Nutzer mit seinem Benutzernamen und Passwort einloggen.
* Alternativ steht auch ein Login über die Google APi zur Verfügung.
    * Bei dieser Methode wird überprüft, ob der Google nutzer bereits in der Datenbank eingetragen ist. Ist dies der Fall wird er eingeloggt. Ansonsten wird ein neuer Nutzer angelegt. Dabei wird der Nutzername aus dem Google Account übernommen.
    * Es ist einem Googlenutzer nicht möglich sich über das Loginformular einzuloggen, da kein Passwort für ihn angelegt wird. Er muss immer den Google-button nutzen.
    * **(Bug)** Es ist möglich das ein Google-Nutzer den gleichen Nutzernamen wie ein normaler Nutzer besitzt, dieses führt jedoch zu keinen Problemen, da diese noch über eine Endeutige ID unterschieden werden. Allerdings kann es für  
    * Benutzer der Website verwirrend sein, wenn zwei Nutzer den gleichen Nutzernamen besitzen.

Registrierung (registration.php):

Spielerprofil (playerprofile.php):
* Hier wird das Profil eines Nutzer angezeigt.
* Ist es nicht das eigene Profil kann dem Nutzer eine Nachricht geschrieben werden (Nachrichtensymbol im Profilheader) oder er kann als Freund hinzugefügt/gelöscht werden (Personensymbol im Profilheader).
    * **(Bug)** Fügt man einen Nutzer als Freund hinzu muss der andere dieses bis jetzt noch nicht bestätigen, sondern die Freundschaft wird einfach "erstellt". Der andere Nutzer kann die Freundschaft aber natürlich auch wieder annulieren/löschen.
* Ist es das eigene Profil kann der Nutzer über das Zahnradsymbol seine Daten(Beschreibung, Alter, Sprachen, Icon) bearbeiten oder sein Profil ganz löschen.
    * Zum Löschen muss der Nutzer noch einmal Benutzername und Passwort zum Bestätigen eingeben (Nur der Nutzername bei Googlenutzern). Im Anschluss werden jegliche Chats, Einträge und sonstiges von diesem Nutzer gelöscht.
* Über das Stiftsymbol über den Spielen im eigenen Profil kann der Nutzer seine Spiele bearbeiten, neue hinzufügen oder eigene Entfernen.
    * über die Checkbox "Ich möchte das Spieler mich über dieses Spiel finden" kann der Nutzer einstellen ob er in der Spielerübersicht dieses Spiels angezeigt wird. Ist der Haken nicht gesetzt wird das Spiel nur im Profil angezeigt, andere Nutzer finden ihn aber nicht über das Spiel.
    * 