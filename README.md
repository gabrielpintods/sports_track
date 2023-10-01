# Sports Track : Application Web de Visualisation de Données Sportives

## Introduction

Conçue dans le cadre de la ressource r3.01 consacrée au développement d'applications web, Sports Track est une plateforme permettant de visualiser et gérer des données sportives. Cette application web s'appuie sur PHP 8.1.2 et SQLite 3.37.2 pour offrir un outil complet aux amateurs de sport souhaitant suivre et analyser leurs performances.

## Fonctionnalités

- **Inscription & Connexion** : Les utilisateurs peuvent créer un compte et se connecter pour accéder à leurs données personnelles.

- **Gestion de Profil** : Les utilisateurs ont la possibilité de modifier et d'afficher leurs informations personnelles.

- **Importation de Données** : Capacité d'importer des fichiers d'activité sportive au format JSON.

- **Visualisation de Données** : Une fois les données importées, les utilisateurs peuvent les visualiser et obtenir des insights sur leurs activités.

## Architecture

Le choix s'est porté sur le modèle **MVC (Modèle-Vue-Contrôleur)** pour sa modularité et sa clarté. Il sépare la logique métier, la présentation et les interactions utilisateur :

- **Modèle** : Utilisation du framework PDO pour un accès optimisé aux bases de données. L'architecture DAO est également intégrée pour une meilleure gestion des interactions avec la base de données.

- **Vue** : Présentation des données à l'utilisateur de manière intuitive.

- **Contrôleur** : Gère les interactions utilisateur et met à jour la vue et le modèle en conséquence.

Le pattern **Singleton** garantit qu'une seule instance de certaines classes est créée, optimisant ainsi la consommation de ressources.

## Dépendances

- PHP 8.1.2
- SQLite 3.37.2

## Installation

1. Clonez le dépôt depuis [Sports Track GitHub](URL_DU_REPO). `git clone https://github.com/gabrielpintods/sports_track.git`
2. Création de la base de données (à partir du répertoire `db/`) : `sqlite3 sports_track.db < create_db.sql`
3. Lancement du serveur (à la racine du projet) : `php -S localhost:8080`
4. Accès à l'application : http://localhost:8080

