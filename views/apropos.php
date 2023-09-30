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
            <a href="/main">
                <span><b>SPORTSTRACK</b></span>
            </a>
        </div>
        <div class="deconnexion">
            <a href="/disconnect"><b>Déconnexion</b></a>
        </div>
    </nav>
</header>

<div class="welcome">

    <h1 id="titre">Mes informations personnelles</h1>

    <div class="options">
        <p><strong>Nom:</strong> <?php echo htmlspecialchars($userInfo['nom'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Prénom:</strong> <?php echo htmlspecialchars($userInfo['prenom'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Age:</strong> <?php echo htmlspecialchars($userInfo['age'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Sexe:</strong> <?php echo htmlspecialchars($userInfo['sexe'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Poids:</strong> <?php echo htmlspecialchars($userInfo['poids'], ENT_QUOTES, 'UTF-8'); ?> kg</p>
        <p><strong>Taille:</strong> <?php echo htmlspecialchars($userInfo['taille'], ENT_QUOTES, 'UTF-8'); ?> cm</p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($userInfo['email'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Date de naissance:</strong> <?php echo htmlspecialchars($userInfo['naissance'], ENT_QUOTES, 'UTF-8'); ?></p>
    </div>

</div>
</body>
</html>
