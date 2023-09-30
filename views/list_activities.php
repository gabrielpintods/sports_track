<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/static/stylesheet.css">
    <title>Mes Activités - SportsTrack</title>
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

<div class="activities">
    <h1>Mes Activités</h1>

    <table class="activities-table">
        <thead>
        <tr>
            <th>Description</th>
            <th>Date</th>
            <th>Début</th>
            <th>Arrivée</th>
            <th>Durée</th>
            <th>Moyenne BPM</th>
            <th>Distance</th>
            <th>Dénivelé</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($data as $activity): ?>
            <tr>
                <td><?= htmlspecialchars($activity['description'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($activity['date'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($activity['startTime'],ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($activity['endTime'],ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($activity['duration'],ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($activity['averageHeartRate'],ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($activity['distance'],ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($activity['altitude'],ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
</body>

</html>
