<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - Profil</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/profil.css">
    <link rel="stylesheet" type="text/css" href="css/games.css">
</head>
<body>
    <header>
        <div class="mainnav">
            <?php include "php/header.php";?>
        </div>
    </header>
    <main>
      <div class="grid">
        <div class="profil-header">
          <div class="picture-wrapper">
              <img src="Resourcen/Icons/Bard.jpg" alt="Profil Picture">
          </div>
          <div class="name-wrapper">
            <h1>Max Mustermann</h1>  
            <label>Wilkommen auf meinem Profil</label>
          </div>
          <div class="message-wrapper">
            <button>Nachricht schreiben</button>  
          </div>
        </div>
         
        <div class="profil-body">
          <h2>Beschreibung:</h2>
          <div class="description">
            <div>
              <label class="attribute">Alter: </label><label class="value">20</label>
            </div>
            <div>
                <label class="attribute">Sprachen: </label><label class="value">Deutsch, Englisch</label>
            </div>
          </div>
          <h2>Meine Spiele:</h2>
          <div class="game-wrapper"> 
            <ul class="cardview" >
                  <div class="wrapper">
                      <li class="card">
                          <div class="container" id="lol">
                              <label class="gamelabel">League of Legends</label>
                          </div>
                      </li>
                  </div>
                  <div class="wrapper">
                      <li class="card">
                          <div class="container" id="valorant">
                              <label class="gamelabel">Valorant</label>
                          </div>
                      </li>
                  </div>
                  <div class="wrapper">
                      <li class="card">
                          <div class="container" id="rocketleague">
                              <label class="gamelabel">Rocket League</label>
                          </div>
                      </li>
                  </div>
                  <div class="wrapper">
                      <li class="card">
                          <div class="container" id="csgo">
                              <label class="gamelabel">CS:GO</label>
                          </div>
                      </li>
                  </div>
              </ul>
          <div class="game-stats">
            <div>
                <label class="attribute">ELO: </label><label class="value">Gold</label>
            </div>
            <div>
                <label class="attribute">Position: </label><label class="value">Jungle</label>
            </div>
          </div>
        </div> 
      </div>          
    </div>    
  </main>
  
  <footer>
            <div class="footer">
                <?php include "php/footer.php";?>
            </div>
    </footer>
</body>
</html>