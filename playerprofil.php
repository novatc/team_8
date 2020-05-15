<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Team8 - Profil</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <header>
        <div class="mainnav">
            <?php include "php/header.php";?>
        </div>
    </header>
  <h1>Max Mustermann</h1>
  <fieldset><legend>Persönliche Angaben</legend>
      <div>
          <label >Alter: </label><label>20</label>
      </div>
      <div>
          <label>Sprachen: </label><label>Deutsch, Englisch</label>
      </div>
      <div>
          <label>Beschreibung: </label><label>Wilkommen auf meinem Profil</label>
      </div>
  </fieldset>
  <fieldset><legend>Spiele</legend>
    <div class="column">
      <div class="card">
        <label>Valorant</label>
      </div>
    </div>
    <div class="column">
      <div class="card">
        <label>League of Legends</label>
      </div>
    </div>
  </fieldset>
  <fieldset><legend>Offene Anzeigen</legend>
      <div class="row">
          <div class="column">
            <div class="card">
              <label>Anzeige A</label>
            </div>
          </div>
          <div class="column">
            <div class="card">
              <label>Anzeige B</label>
            </div>
          </div>
          <div class="column">
            <div class="card">
              <label>Anzeige C</label>
            </div>
          </div>
        </div> 
  </fieldset>
  <footer>
            <div class="footer">
                <?php include "php/footer.php";?>
            </div>
    </footer>
</body>
</html>