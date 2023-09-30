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

        <h1 id="titre"> Oups ! Quelque chose s'est mal passé.</h1>
        <div class="error-msg">
            <p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?> </p>
            <p>Veuillez réessayer </p>

            <button class="btn" onclick=window.location.href="/user_add" type="submit"><b>S'inscrire</b></button>

            <div class="disclaimer">
                <p>
                    En vous inscrivant sur SportsTrack, vous acceptez les
                    <a href="https://fr.wikipedia.org/wiki/Conditions_g%C3%A9n%C3%A9rales_d%27utilisation">conditions d'utilisation.</a>
                    Consultez notre
                    <a href="https://fr.wikipedia.org/wiki/Politique_de_confidentialit%C3%A9#:~:text=Une%20politique%20de%20confidentialit%C3%A9%20est,donn%C3%A9es%20transmises%20par%20ses%20clients.">politique de confidentialité.</a>
                </p>
                <p>
                    Vous êtes déjà membre ?
                    <a href="/connect">Connexion</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>


