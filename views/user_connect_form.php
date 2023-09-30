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

            <h1 id="titre"> Connectez-vous sur SportTrack, et suivez vos activité sportives.</h1>
            <form action="" method="POST">
                <div class="form-item">
                    <label class="mail">E-mail</label>
                    <input class="user-input" type="email" name="email" placeholder="E-mail" spellcheck="false" required>
                </div>

                <div class="form-item">
                    <label class="pwd">Mot de passe</label>
                    <input class="user-input" type="password" name="pswd" placeholder="Mot de passe" required>
                </div>

                <button class="btn" type="submit"><b>Se connecter</b></button>

            </form>
        </div>
    </body>
</html>
