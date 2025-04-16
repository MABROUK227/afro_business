# Afro Business

Afro Business est une plateforme business développée par des entrepreneurs canadiens d’origine africaine.

## 🚀 Installation du projet

Suivez ces étapes pour installer et lancer le projet en local :

### 1️⃣ Cloner le dépôt
```bash
git clone https://github.com/MABROUK227/afro_business.git
cd afro_business
2️⃣ Importer la base de données
Importez le fichier afrobizz.sql dans votre gestionnaire de base de données préféré (par exemple : phpMyAdmin, TablePlus, MySQL Workbench, etc.).

3️⃣ Configurer le fichier .env
Copiez le fichier .env.example en .env :

cp .env.example .env
Puis configurez les paramètres de connexion à votre base de données :

DB_DATABASE=nom_de_votre_base
DB_USERNAME=votre_utilisateur
DB_PASSWORD=mot_de_passe
4️⃣ Installer les dépendances PHP
composer install
5️⃣ Générer la clé d’application
php artisan key:generate
6️⃣ Lancer les migrations
php artisan migrate
7️⃣ Installer les dépendances front-end
npm install
8️⃣ Lancer le serveur de développement Vite
npm run dev
9️⃣ Démarrer le serveur Laravel
php artisan serve
Vous pourrez ensuite accéder à votre site via :
http://localhost:8000

👥 Membres du groupe

Mabrouk Adjaho
Clément De Abreu
📌 Technologies utilisées

Laravel
MySQL
Vite
Tailwind CSS
npm
📎 Remarques

Veillez à avoir PHP, Composer, Node.js et npm installés sur votre machine.
Pour éviter des erreurs, assurez-vous que les variables du fichier .env sont bien configurées avant de lancer les commandes artisan et npm.
