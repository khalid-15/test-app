
Ce projet est développé dans le cadre d'un test de skills le cahier de charge en directory.
Technologie utilisés Laravel 10 et InertiaJS + Vuejs .
Vite comme Builder .
Environnement de développement SAIL.
Frontend UI Framework Vuetify.

PS : Il faut noter que le projet est développé dans un context Monolithic.

Prérequis :

-   NodeJS / NPM

-   Composer

-   Docker

#Windows (WSL) / Linux

Installation :

1- Clonez le projet de la repos dans Linux Subsystem pour éviter les problèmes de compatibilité fichier.

2- Naviguez dans le root du projet

3- renommer le fichier .env.example -> .env

4- ouvrez le terminal et tapez les commandes suivantes

-   npm install

-   composer install

-   ./vendor/bin/sail up (Attendez pendant que SAIL install les images et lance le centenaire)

-   ./vendor/bon/sail artisan migrate:fresh

-   ./vendor/bon/sail artisan db:seed

-   npm run dev

5- Naviguer localhost

Pour les emails, veuillez consulter https://www.wpoven.com/tools/free-smtp-server-for-testing après tapez l'email demo@demo.com pour voir les reçus.

Au cas de problème veuillez me contacter.

Et voilà le projet fonctionne.
