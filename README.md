# Système de Gestion de Parking

Ce projet est une application web de gestion de parking développée avec Laravel 11 et Vue.js.

##  Technologies Utilisées

- **Backend:**
  - PHP 8.2
  - Laravel 11
  - MySQL/PostgreSQL (base de données)

- **Frontend:**
  - Vue.js
  - TailwindCSS
  - Alpine.js
  - Bootstrap 5.3

##  Prérequis

- PHP 8.2 ou supérieur
- Composer
- Node.js et npm
- Base de données MySQL ou PostgreSQL

##  Installation

1. **Cloner le projet**
```bash
git clone [URL_DU_REPO]
cd parking
```

2. **Installer les dépendances PHP**
```bash
composer install
```

3. **Installer les dépendances JavaScript**
```bash
npm install
```

4. **Configurer l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurer la base de données**
- Modifier le fichier `.env` avec vos informations de connexion à la base de données
- Exécuter les migrations
```bash
php artisan migrate
```

6. **Lancer l'application**
```bash
# Dans un terminal
php artisan serve

# Dans un autre terminal
npm run dev
```

## Structure du Projet

```
parking/
├── app/            # Contient la logique de l'application
├── config/         # Fichiers de configuration
├── database/       # Migrations et seeders
├── public/         # Fichiers publics
├── resources/      # Vues et assets
├── routes/         # Définition des routes
├── storage/        # Fichiers de stockage
└── tests/          # Tests unitaires et fonctionnels
```

##  Configuration

Le fichier `.env` contient les configurations importantes :
- Paramètres de la base de données
- Clés API
- Configuration de l'application

##  Tests

Pour exécuter les tests :
```bash
php artisan test
```

##  Contribution

1. Fork le projet
2. Créer une branche pour votre fonctionnalité (`git checkout -b feature/AmazingFeature`)
3. Commit vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

##  Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

##  Auteurs

- Votre Nom - *Travail initial*

##  Remerciements

- Laravel Team
- Vue.js Team
- Tous les contributeurs
