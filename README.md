**Team8**

Gruppenmitglieder:
* Lucas Wagner
* Nico Schönfisch
* Johannes Scheibe

Zum Betrieb allgemeine, notwendige Informationen:
* Die Webseite wird mit einer gefüllten Datenbank abgegeben, sollte diese gelöscht werden wird einen neue Datenbank erzeugt, in der keine Beispieldaten eingefügt worden sind.
* 4 Beispiel Nutzer können über das PHP-Script fill_dummy-data.php (Pfad: http://localhost/.../team8/db/fill_dummy_data.php) eingefügte werden.
    * Die Benutzernamen sind "Nico", "Lucas", "Johannes" und "Bot" und dass Passwort aller Beispielnutzer ist "Passwort".

Funktionen und Erklärung der wichtigsten Webseiten:

Startseite (index.php):

Die Startseite von Team8 hat zwei Ansichten:

* ein Nutzer ist neu oder ein Nutzer ist nicht angemeldet. In dem Fall gibt es die Auswahl zwischen Registrieren und Login, welche den Nutzer
auf die entsprechenden Seiten weiterleitet.
* ein Nutzer ist angemeldet. Er sieht das gleiche Layout mit zwei anderen Optionen, er kann sich sein Profil anzeigen lassen
oder direkt zur Spielübersicht springen. Auch hier leiten die Schaltflächen den Benutzer auf die entsprechende Seite weiter.
* Als weiteres Feature wurde auf der Startseite eine API eingebunden, welche zufällige Zitate aus dem Epos: "Der Herr der Ringe"
von J.R.R. Tolkin anzeigt. Diese Zitate sollen den Nutzer auf die Welt der Online-Rollenspiele einstimmen.


Header:
* Der Header ist auf jeder Seite eingebunden. Er stellt die Hauptnavigation dar.
* Über die Suche kann man Spieler über den Benutzernamen finden. Dabei muss nur ein Teil des Namens übereinstimmen.
* Neue Benachrichtigungen werden als roter Kreis mit Nummer über der Glocke angezeigt.
* **(Bug)** Die Benachrichtigungen sind noch nicht live. Die Seite muss also erst aktualisiert werden.

Login (login.php):
* Hier kann sich ein bereits registrierter Nutzer mit seinem Benutzernamen und Passwort einloggen.
* Alternativ steht auch ein Login über die Google APi zur Verfügung.
    * Dieser funktioniert aber nur wenn die Adresse "http://localhost/team8/login.php" ist, da nur für diese Adresse ein Key vorliegt.   
    * Bei dieser Methode wird überprüft, ob der Google nutzer bereits in der Datenbank eingetragen ist. Ist dies der Fall wird er eingeloggt. Ansonsten wird ein neuer Nutzer angelegt. Dabei wird der Nutzername aus dem Google Account übernommen.
    * Es ist einem Googlenutzer nicht möglich sich über das Loginformular einzuloggen, da kein Passwort für ihn angelegt wird. Er muss immer den Google-button nutzen.
    * **(Bug)** Es ist möglich das ein Google-Nutzer den gleichen Nutzernamen wie ein normaler Nutzer besitzt, dieses führt jedoch zu keinen Problemen, da diese noch über eine Endeutige ID unterschieden werden. Allerdings kann es für  
    * Benutzer der Website verwirrend sein, wenn zwei Nutzer den gleichen Nutzernamen besitzen.
    
Registrierung (registration.php):


* Eine klassische Registrierung ist möglich, der Nutzer muss hierfür eine gültige Mailadresse besitzen und einen einzigartigen Namen
wählen. Mit dem gewählten Namen ist der Nutzer für andere Nutzer sichtbar. Zum Schutz vor Bots und Spam muss bei der Registrierung
ein reCAPTCHA von Google gelöst werden. Ist ein nicht bereits vergebener Nutzername gewählt, eine gültige Email angegeben,
ein passendes passwort gewählt und bestätigt und das reCAPTCHA gelöst, ist die Registrierung erfolgreich. Die Weiterleitung
führt auf die neue Profilseite.


Spielerprofil (playerprofile.php):
* Hier wird das Profil eines Nutzer angezeigt.
* Ist es nicht das eigene Profil kann dem Nutzer eine Nachricht geschrieben werden (Nachrichtensymbol im Profilheader) oder er kann als Freund hinzugefügt/gelöscht werden (Personensymbol im Profilheader).
    * **(Bug)** Fügt man einen Nutzer als Freund hinzu muss der andere dieses bis jetzt noch nicht bestätigen, sondern die Freundschaft wird einfach "erstellt". Der andere Nutzer kann die Freundschaft aber natürlich auch wieder annulieren/löschen.
* Ist es das eigene Profil kann der Nutzer über das Zahnradsymbol seine Daten(Beschreibung, Alter, Sprachen, Icon) bearbeiten oder sein Profil ganz löschen.
    * Zum Löschen muss der Nutzer noch einmal Benutzername und Passwort zum Bestätigen eingeben (Nur der Nutzername bei Googlenutzern). Im Anschluss werden jegliche Chats, Einträge und sonstiges von diesem Nutzer gelöscht.
* Über das Stiftsymbol über den Spielen im eigenen Profil kann der Nutzer seine Spiele bearbeiten, neue hinzufügen oder eigene Entfernen.
    * über die Checkbox "Ich möchte das Spieler mich über dieses Spiel finden" kann der Nutzer einstellen ob er in der Spielerübersicht dieses Spiels angezeigt wird. Ist der Haken nicht gesetzt wird das Spiel nur im Profil angezeigt, andere Nutzer finden ihn aber nicht über das Spiel.

Spielübersicht (gameoverview.php):
* Hier ist eine Übersicht von allen Spielen, wenn man auf eine Karte klickt erhällt man eine Übersicht über alle Spieler die das Spiel spielen.
* Mit den Filtern kann man die Spiele filtern, sind mehrere Filter einer Filteroption aktiv werden diese als Oder-Verknüpft (Option A oder B muss erfüllt sein).

Spielerübersicht (playeroverview.php):
* Hier ist eine Übersicht von allen Spielern eines Spiels, wenn man auf eine Karte klickt gelangt man zum Profil des Spielers.
* Mit den Filtern kann man die Spieler filtern, sind mehrere Filter einer Filteroption aktiv werden diese als Oder-Verknüpft (Option A oder B muss erfüllt sein).

Chatübersicht (chatoverview.php):
* Hier wird dem angemeldeten User eine Übersicht seiner Chats präsentiert, bestehend aus zwei Teilen.
    * Freundesliste: hier werden alle User angezeigt, mit dem der angemeldete User befreundet ist.
    * Alle Chats: hier kann der User alle seine aktiven Chats verfolgen.
* Die User werden sowohl in der Freundesliste als auch in den aktiven Chats jeweils mit ihrem Icon und ihrem Usernamen angezeigt.
    * klickt man auf das Icon des Users, gelangt man zu seinem Profil.
    * klickt man auf den Namen des Users, wird man zum Chat (chat.php) mit diesem User weitergeleitet.
* Auch hier werden für jeden Chat die ungelesenen Nachrichten angezeigt. **(BUG)** Jedoch ist auch hier das Ganze nicht Life und muss erst implementiert werden.

Chat mit einer Person (chat.php):
* Hier wird eine Chatbox mit dem ausgewählten User angezeigt.
    * Es werden alle bisher ausgetauschten Nachrichten angezeigt.
        * Die eigenen Nachrichten und die des anderen Users haben unterschiedliche Farben und werden zusammen mit dem Icon angezeigt.
    * Der Chat ist Live