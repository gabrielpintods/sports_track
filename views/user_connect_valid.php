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
        <div class="deconnexion">
            <a href="/disconnect"><b>Déconnexion</b></a>
        </div>
    </nav>
</header>

<div class="welcome">

    <h1 id="titre">Connexion réussie, vous pouvez maintenant utiliser SportsTrack !</h1>

    <div class="options">
        <button class="btn" onclick=window.location.href="/main"><b>Accueil de mon compte</b></button>
    </div>

</div>
</body>
</html>
