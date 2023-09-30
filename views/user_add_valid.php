<?php ?>
<!DOCTYPE html5>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="views/static/stylesheet.css">
        <title>Connexion - SportsTrack</title>
    </head>
    <body>
        <header class="global-header">
            <nav class="nav-bar" role="navigation">
                <div title="Revenir à la page d'accueil SportsTrack" class="logo">
                    <a href="/">
                        <span><b>SPORTSTRACK</b></span>
                    </a>
                </div>
                <div class="connexion">
                    <a href="/user_add"><b>S'inscrire</b></a>
                </div>
            </nav>
        </header>

        <div class="enregistrement">

            <h1 id="titre">Votre inscription a bien été prise en compte, vous pouvez maintenant vous connectez.</h1>

            <div class="user-add-valid">

                <button class="btn" onclick=window.location.href="/connect" type="submit"><b>Se connecter</b></button>

            </div>
        </div>
    </body>
</html>