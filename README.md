# Description du Projet

Ce projet est une application web pour la gestion des formations à l'ESTI. Il permet de gérer les membres, les projets, les tâches, les partenaires et les spécialités.

## Configuration de la Connexion à la Base de Données

Pour configurer la connexion à la base de données, suivez les étapes ci-dessous :

1. Ouvrez le fichier `database.php` situé dans le répertoire principal de votre projet.
2. Modifiez les valeurs des variables suivantes avec vos informations de connexion MySQL :

```php
$host = 'localhost';
$dbname = 'nom_de_votre_base_de_donnees';
$username = 'votre_nom_d_utilisateur';
$password = 'votre_mot_de_passe';
```

3. Enregistrez les modifications et fermez le fichier.

Assurez-vous que votre serveur MySQL est en cours d'exécution et que les informations de connexion sont correctes pour éviter toute erreur de connexion.

## Fonctionnalités

- **Gestion des membres** : Ajouter, modifier, supprimer et afficher les membres.
- **Gestion des projets** : Ajouter, modifier, supprimer et afficher les projets.
- **Gestion des tâches** : Ajouter, modifier, supprimer et afficher les tâches.
- **Gestion des partenaires** : Ajouter, modifier, supprimer et afficher les partenaires.
- **Gestion des spécialités** : Ajouter, modifier, supprimer et afficher les spécialités.

## Technologies Utilisées

- **Backend** : PHP
- **Base de données** : MySQL

## Installation

1. Cloner le dépôt.
2. Importer le fichier `database.sql` dans votre base de données MySQL.
3. Configurer les paramètres de connexion à la base de données dans le fichier `database.php`.
4. Lancer le serveur web et accéder à l'application via `http://localhost/tpesti`.