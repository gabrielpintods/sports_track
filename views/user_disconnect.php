<?php ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/static/stylesheet.css">
    <title>Erreur d'Inscription - SportsTrack</title>
</head>
<body>
<header class="global-header">
    <nav class="nav-bar" role="navigation">
        <div title="Revenir à la page d'accueil SportsTrack" class="logo">
            <a href="https://www.strava.com/?hl=fr">
                <span><b>SPORTSTRACK</b></span>
            </a>
        </div>
        <div class="connexion">
            <a href="/connect"><b>Se connecter</b></a>
        </div>
    </nav>
</header>

<div class="enregistrement">

    <h1 id="titre">Vous avez bien était déconnecté</h1>
    <div class="error-msg">
        <p>Revenir sur la page d'accueil de SportTrack</p>
        <button class="btn" onclick=window.location.href="/" type="submit"><b>SportTrack</b></button>
    </div>
</div>
</body>
</html>


