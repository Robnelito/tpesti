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

## Lancer l'Application via CLI

Pour lancer l'application via l'interface de ligne de commande (CLI), suivez les étapes ci-dessous :

1. Ouvrez votre terminal ou invite de commandes.
2. Naviguez jusqu'au répertoire principal de votre projet :

```sh
cd /c:/xampp/htdocs/tpesti
```

3. Démarrez le serveur PHP intégré en utilisant la commande suivante :

```sh
php -S localhost:8000
```

4. Ouvrez votre navigateur web et accédez à l'application via l'URL suivante :

```
http://localhost:8000
```

Votre application devrait maintenant être en cours d'exécution et accessible via votre navigateur.
## Documentation de l'API

L'API de cette application permet d'interagir avec les différentes fonctionnalités de gestion. Voici les principales routes disponibles :

### Membres

- **GET /api/membres** : Récupérer la liste de tous les membres.
- **POST /api/membres** : Ajouter un nouveau membre.
- **GET /api/membres/{id}** : Récupérer les détails d'un membre spécifique.
- **PUT /api/membres/{id}** : Mettre à jour les informations d'un membre.
- **DELETE /api/membres/{id}** : Supprimer un membre.

### Projets

- **GET /api/projets** : Récupérer la liste de tous les projets.
- **POST /api/projets** : Ajouter un nouveau projet.
- **GET /api/projets/{id}** : Récupérer les détails d'un projet spécifique.
- **PUT /api/projets/{id}** : Mettre à jour les informations d'un projet.
- **DELETE /api/projets/{id}** : Supprimer un projet.

### Tâches

- **GET /api/taches** : Récupérer la liste de toutes les tâches.
- **POST /api/taches** : Ajouter une nouvelle tâche.
- **GET /api/taches/{id}** : Récupérer les détails d'une tâche spécifique.
- **PUT /api/taches/{id}** : Mettre à jour les informations d'une tâche.
- **DELETE /api/taches/{id}** : Supprimer une tâche.

### Partenaires

- **GET /api/partenaires** : Récupérer la liste de tous les partenaires.
- **POST /api/partenaires** : Ajouter un nouveau partenaire.
- **GET /api/partenaires/{id}** : Récupérer les détails d'un partenaire spécifique.
- **PUT /api/partenaires/{id}** : Mettre à jour les informations d'un partenaire.
- **DELETE /api/partenaires/{id}** : Supprimer un partenaire.

### Spécialités

- **GET /api/specialites** : Récupérer la liste de toutes les spécialités.
- **POST /api/specialites** : Ajouter une nouvelle spécialité.
- **GET /api/specialites/{id}** : Récupérer les détails d'une spécialité spécifique.
- **PUT /api/specialites/{id}** : Mettre à jour les informations d'une spécialité.
- **DELETE /api/specialites/{id}** : Supprimer une spécialité.

Chaque route de l'API doit être appelée avec les méthodes HTTP appropriées (GET, POST, PUT, DELETE) et les données nécessaires doivent être envoyées au format JSON.
