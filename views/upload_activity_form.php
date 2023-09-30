<?php ?>
<!DOCTYPE html5>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="views/static/stylesheet.css">
        <title>Vos fichier - SportsTrack</title>
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

        <div class="import">
            <h1 id="titre"> Importer un fichier JSON depuis votre ordinateur</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-item">
                    <label for="file-import"><b>Importer votre fichier ici -></b></label>
                    <input type="file" name="activity_file" required accept=".json">
                </div>
                    <button class="btn" type="submit"><b>Importer</b></button>
            </form>
        </div>
    </body>
</html>