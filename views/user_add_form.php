<?php ?>
<!DOCTYPE html5>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="views/static/stylesheet.css">
        <title>Inscription - SportsTrack</title>
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
                    <a href="/connect"><b>Se connecter</b></a>
                </div>
            </nav>
        </header>

        <div class="enregistrement">

            <h1 id="titre"> Inscrivez-vous sur SportTrack, et suivez vos activité sportives.</h1>

            <form action="" method="POST">
                <div class="form-item">
                    <label class="nom" for="lname">Nom</label>
                    <input class="user-input" type="text" name="lastName" placeholder="Nom" required>
                </div>

                <div class="form-item">
                    <label class="prenom" for="fname">Prénom</label>
                    <input class="user-input" type="text" name="firstName" placeholder="Prénom" required>
                </div>

                <div class="form-item">
                    <label class="sexe" for="Sexe">Sexe</label>
                    <select class="user-input" name="sexe" id="sexe">
                        <option value="" selected disabled hidden>Quel est votre sexe ?</option>
                        <option value="femme">femme</option>
                        <option value="homme">homme</option>
                        <option value="autre">autre</option>
                    </select>
                </div>

                <div class="form-item">
                    <label class="naissance" for="">Date de naissance</label>
                    <input class="user-input" type="date" name="birthdate" placeholder="Date de naissance" required>
                </div>

                <div class="form-item">
                    <label class="age" for="Age"></label>
                    <input class="user-input" type="text" name="age" placeholder="Age" required>
                </div>

                <div class="form-item">
                    <label class="taille" for="taille">Taille</label>
                    <input class="user-input" type="number" name="height" placeholder="Taille (cm)" required>
                </div>

                <div class="form-item">
                    <label class="poid" for="poids">Poid</label>
                    <input class="user-input" type="number" name="weight" placeholder="Poids (kg)" required>
                </div>

                <div class="form-item">
                    <label class="mail" for="email">E-mail</label>
                    <input class="user-input" type="email" name="email" placeholder="E-mail" spellcheck="false" required>
                </div>

                <div class="form-item">
                    <label class="pwd" for="password">Mot de passe</label>
                    <input class="user-input" type="password" name="pswd" placeholder="Mot de passe" required>
                </div>

                <button class="btn" type="submit"><b>S'inscrire</b></button>

                <div class="disclaimer">
                    <p>
                        En vous inscrivant sur Strava, vous acceptez les
                        <a href="https://fr.wikipedia.org/wiki/Conditions_g%C3%A9n%C3%A9rales_d%27utilisation">condition d'utilisation.</a>
                        Consultez notre
                        <a href="https://fr.wikipedia.org/wiki/Politique_de_confidentialit%C3%A9#:~:text=Une%20politique%20de%20confidentialit%C3%A9%20est,donn%C3%A9es%20transmises%20par%20ses%20clients.">politique de confidentitalité.</a>
                    </p>
                    <p>
                        Vous êtes déjà membre ?
                        <a href="/connect">Connexion</a>
                    </p>
                </div>
            </form>
        </div>
    </body>
</html>
