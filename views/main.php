<?php ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/static/stylesheet.css">
    <title>Accueil - SportsTrack</title>
</head>
<body>
    <header class="global-header">
        <nav class="nav-bar" role="navigation">
            <div title="Revenir à la page d'accueil SportsTrack" class="logo">
                <a href="/">
                    <span><b>SPORTSTRACK</b></span>
                </a>
            </div>
        </nav>
    </header>

    <div class="welcome">
        <h1 id="titre">Bienvenue sur SportsTrack!</h1>
        <div class="welcome-text">
            <p>Rejoignez-nous et suivez vos activités sportives en toute simplicité.</p>
            <button class="btn" onclick=window.location.href="/user_add"><b>S'inscrire</b></button>
            <button class="btn" onclick=window.location.href="/connect"><b>Se connecter</b></button>
        </div>
    </div>
</body>
</html>
