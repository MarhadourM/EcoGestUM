# EcoGestUM ♻️

Application web de **gestion et de valorisation des objets** au sein de l'**Université du Mans**, réalisée en équipe dans le cadre de la SAÉ du semestre 3 du BUT Informatique.

L'objectif est d'encourager le tri, le réemploi et le recyclage : au lieu de jeter un objet (mobilier, matériel…), un membre de l'université peut le donner, et un autre peut le réserver. La présidence et les chefs de département suivent l'impact environnemental de ces actions.

## Fonctionnalités

**Pour tous les utilisateurs**
- Inscription, connexion, mot de passe oublié
- Recherche d'objets disponibles et réservation
- Formulaire de don et signalement d'objet
- Carte des points de collecte
- Événements (avec inscription) et communications officielles
- Messagerie interne et notifications
- Profil, réservations et inscriptions

**Enseignant**
- Déclaration de besoins en objets

**Chef de département** (tableau de bord)
- Inventaire du département
- Historique des opérations de recyclage
- Indicateurs d'impact et communication

**Présidence** (tableau de bord)
- Suivi de l'impact à l'échelle de l'université
- Communication officielle
- Statistiques et génération de rapports téléchargeables

## Stack technique

- **PHP 8**, architecture **MVC** sans framework
- **MySQL / MariaDB** (PDO)
- HTML / CSS / JavaScript
- Composer (autoload PSR-4) et `vlucas/phpdotenv`

## Architecture

```
├── index.php           # Routeur principal (paramètres page / section / action)
├── src/
│   ├── Controller/     # Contrôleurs (un par fonctionnalité)
│   ├── Model/          # Accès aux données (PDO)
│   └── view/           # Vues, templates et tableaux de bord par rôle
├── composer.json
└── .env                # Configuration de la base de données (valeurs d'exemple)
```

Les rôles de l'utilisateur (Présidence, Chef de département, Enseignant) déterminent les sections du tableau de bord auxquelles il a accès.

## Installation en local

```bash
git clone https://github.com/MarhadourM/EcoGestUM.git
cd EcoGestUM
composer install
```

1. Créer une base MySQL/MariaDB (le schéma SQL n'est pas inclus dans ce dépôt)
2. Renseigner `.env` :
   ```env
   DB_HOST=localhost
   DB_NAME=ecogestum
   DB_USER=...
   DB_PASSWORD=...
   BASE_URL="http://localhost/EcoGestUM/"
   ```
3. Servir le projet avec Apache (XAMPP, WAMP, LAMP…) et ouvrir `BASE_URL`

## Équipe

Projet réalisé par **Antoine Rioul**, **Sami Hajadi** et **Matthieu Marhadour** — SAÉ S3, BUT Informatique, Université du Mans.
