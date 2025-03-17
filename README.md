# Gestion de Parking

Application web de gestion de places de parking développée avec Laravel.

## Fonctionnalités

- Gestion des places de parking (ajout, modification, suppression)
- Système de réservation de places
- Liste d'attente pour les demandes de réservation
- Gestion des utilisateurs (administrateurs et utilisateurs standard)
- Interface moderne et responsive

## Technologies utilisées

- Laravel 11
- Tailwind CSS
- Alpine.js
- SQLite (base de données)

## Installation

1. Cloner le dépôt
```bash
git clone https://github.com/WassimElArche/parking.git
cd parking
```

2. Installer les dépendances
```bash
composer install
npm install
```

3. Configurer l'environnement
```bash
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
```

4. Exécuter les migrations et les seeders
```bash
php artisan migrate
php artisan db:seed
```

5. Compiler les assets
```bash
npm run build
```

6. Lancer le serveur
```bash
php artisan serve
```

## Accès à l'application

L'application sera accessible à l'adresse http://localhost:8000

### Identifiants de connexion

- **Administrateur** : admin@parking.com / password
- **Utilisateurs** : user1@parking.com, user2@parking.com, etc. / password

## Développé par

Mehdi (mehdisse20@gmail.com)
