<!DOCTYPE html5>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/static/stylesheet.css">
    <title>Utilisateur - SportsTrack </title>
</head>
<body>
<header class="global-header">
    <nav class="nav-bar" role="navigation">
        <div title="Revenir à la page d'accueil SportsTrack" class="logo">
            <a href="/main">
                <span><b>SPORTSTRACK</b></span>
            </a>
        </div>
        <div class="connexion">
            <a href="/disconnect"><b>Se déconnecter</b></a>
        </div>
    </nav>
</header>

<div class="enregistrement">

    <h1 id="titre"> Modifier vos informations personnelles </h1>

    <form action="" method="POST">

        <div class="form-item">
            <label class="nom" for="lname">Nom</label>
            <input class="user-input" type="text" name="lastName" placeholder="Nom">
        </div>

        <div class="form-item">
            <label class="prenom" for="fname">Prénom</label>
            <input class="user-input" type="text" name="firstName" placeholder="Prénom">
        </div>

        <div class="form-item">
            <label class="age" for="Age"></label>
            <input class="user-input" type="text" name="age" placeholder="Age">
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
            <label class="taille" for="taille">Taille</label>
            <input class="user-input" type="number" name="height" placeholder="Taille (cm)">
        </div>

        <div class="form-item">
            <label class="poid" for="poids">Poid</label>
            <input class="user-input" type="number" name="weight" placeholder="Poids (kg)">
        </div>

        <div class="form-item">
            <label class="mail" for="email">E-mail</label>
            <input class="user-input" type="email" name="email" placeholder="E-mail" spellcheck="false">
        </div>

        <div class="form-item">
            <label class="pwd" for="password">Mot de passe</label>
            <input class="user-input" type="password" name="pswd" placeholder="Mot de passe" required>
        </div>

        <div class="form-item">
            <label class="pwd" for="password">Mot de passe</label>
            <input class="user-input" type="password" name="newPswd" placeholder="Nouveau mot de passe">
        </div>

        <p>
            Avant de modifier vos informations personnelles,
            vous devez obligatoirement renseigner votre mot de passe.
        </p>

        <button class="btn" type="submit"><b>Modifier</b></button>

    </form>
</div>
</body>
</html>