# Carte d'Identité du Territoire - Application serveur

## Un projet Région Sud / Wild Code School

Le projet *Carte d'Identité du Territoire* a été réalisé entre les mois de décembre 2020 et février 2021 par des étudiants en développement web du campus "remote" de la Wild Code School, en partenariat avec les porteurs de projet de Région Sud.

Pour le cursus *développement web* de la  la Wild Code School, dans sa déclinaison *JavaScript / React / Node.js*, les projets de fin de formation comportent typiquement deux applications : une application serveur basée sur Node.js, une application cliente développée en React.

**Le projet *Carte d'Identité du Territoire* déroge à cette habitude** : si l'application cliente est toujours développée en JavaScript avec React, l'application serveur repose sur le langage PHP et le framework Laravel. Ce dépôt contient le code source de cette dernière.

L'application fournit une API facile à requêter pour l'application cliente, pour récupérer, par exemple, des données sur les communes de France.

## Lancement et/ou développement en local

### Pré-requis

* Une stack de développement Apache-MySQL-PHP (ou Nginx-MySQL-PHP)
* [Composer](https://getcomposer.org/)
* Git

### Mise en place d'une stack Apache (ou Nginx), MySQL, PHP

La mise en place d'une stack *AMP (Apache-MySQL-PHP) ou *EMP (Nginx-MySQL-PHP), sur n'importe quel système, dépasse le cadre de cette documentation. C'est un sujet assez largement documenté, aussi on se contentera de donner quelques pointeurs.

#### Windows

Une pléthore d'outils permettent de mettre en place une stack WAMP facilement :

* [WampServer](https://www.wampserver.com/en/),
* [XAMPP](https://www.apachefriends.org/index.html),
* [UwAmp](https://www.uwamp.com/fr/),
* [Laragon](https://laragon.org/)

Ce dernier semble assez populaire, et est recommandé par le contributeur principal de ce dépôt.

#### Mac OS

* [MAMP](https://www.mamp.info/en/downloads/) est une stack complète, packagée dans un installeur unique
* [Cet article](https://buzut.net/se-passer-de-mamp-mac-stack-mamp-native/) décrit une façon probablement plus "propre" d'arriver au même résultat. PHP et Apache étant pré-installés sur Mac OS, il ne reste qu'à ajouter MySQL / MariaDB pour obtenir la stack complète.

#### Linux

La procédure peut varier largement d'une distribution à l'autre, mais est très largement documentée :

* [Serveur web - LAMP](http://doc.ubuntu-fr.org/lamp) sur le Wiki francophone d'Ubuntu.
* [Debian : Installer un serveur LAMP](https://www.linuxtricks.fr/wiki/debian-installer-un-serveur-lamp-apache-mysql-php)

### Récupération du dépôt, dépendances, configuration

**Note** : toutes ces étapes sont plus détaillées dans la partie [Déploiement sur un serveur en production](#déploiement-sur-un-serveur-en-production) de ce document.

Après avoir cloné ce dépôt en local, ou avoir récupéré et décompressé une archive de son contenu, il est nécessaire de configurer l'application.

#### Composer

Les dépendances d'une application Laravel sont gérées via l'outil standard [Composer](https://getcomposer.org/).

Une fois Composer installé, on doit se placer dans le dossier de l'application, et lancer : `php composer install`.

#### Création d'une BDD

Il faut ensuite créer une base de données dans MariaDB, ainsi qu'un utilisateur possédant les privilèges sur cette base.

#### Configuration via `.env`

Ensuite, il faut configurer les variables d'environnement. Pour cela, on crée une copie de `.env.example` en tant que `.env`.

Les variables indispensables sont les suivantes (les autres peuvent garder leur valeur par défaut) :

* `APP_KEY`
* `OPENWEATHERMAP_API_KEY` :
* `CULTURO_LOGIN` :
* `CULTURO_PASSWORD` :
* `DB_DATABASE` : base de données créée précédemment
* `DB_USERNAME` : nom de l'utilisateur associé à cete BDD
* `DB_PASSWORD` : mot de passe de cet utilisateur

#### Initialisation de la app key de Laravel et run des migrations

> TO BE COMPLETED

## Déploiement sur un serveur en production

Cette procédure détaille toute la configuration d'un serveur "privé", destiné à héberger à la fois les composantes **serveur** et **client** du projet.

**On prend ici la suite** de la [procédure suivie précédemment](https://github.com/WildCodeSchool/remotefr-js-0920-p3-regionsud-pollutionlumineuse-strapi#déploiement-sur-un-serveur-en-production) pour déployer le projet *Kit de Pollution Lumineuse*.

On part donc du principe que ces opérations ont déjà été réalisées sur le serveur cible :

* Installation de Git, Apache, PHP, Node.js (en LTS, soit la v14.x en février 2021)
* Installation d'etckeeper
* Création d'un compte utilisateur `nodejs` non privilégié

Si PHP n'est pas installé, on peut le faire en ajoutant [le PPA deb.sury.org](https://github.com/oerdnj/deb.sury.org/wiki/Frequently-Asked-Questions#debian), puis en lançant `sudo apt-get install -y php8.0`.

### Déploiement de l'application cliente

Cette partie suit la même logique que pour l'application cliente du projet *Kit Pollution Lumineuse* (KPL). Les explications seront donc plus concises, pour éviter trop de répétitions.

Avant toute chose, on utilise le compte `nodejs` créé à l'étape précédente :

    su - nodejs

#### Récupération du code source via Git

Puis on clone le dépôt de l'application cliente du projet *Carte d'Identité du Territoire* :

    git clone https://github.com/WildCodeSchool/remotefr-js-0920-p3-regionsud-identiteterritoire-front citer-frontend

#### Installation des dépendances

On se place dans le dossier `citer-frontend` pour y installer ses dépendances :

    cd citer-frontend
    npm install

#### Paramétrage via le fichier d'environnement

En restant sous `citer-frontend`, on crée le fichier de variables d'environnement, à partir du modèle fourni par le fichier `.env.example`.

    cp .env.example .env.production.local

Les mêmes règles s'appliquent que pour le projet KPL : l'application sera accessible via un sous-répertoire de la "document root" du serveur Apache. **En attendant d'avoir une URL définitive en HTTPS** (par exemple <https://sub.domain.org>), l'application sera accessible via l'adresse IP publique du serveur, suivie d'un chemin relatif.

Voici les deux variables à renseigner :

* `REACT_APP_REGIONSUD_API_URL`, prenant comme valeur L'URL publique de l'application serveur. Ici, ce sera `http://w.x.y.z/citer-back/api`. (`/citer-back` sera le lien symbolique dans la "document root" qui pointera vers le point d'entrée de l'application Laravel, et `/api` la racine des endpoints de l'API Laravel).
* `REACT_APP_ROUTER_BASENAME`, le _basename_ du composant [BrowserRouter](https://reactrouter.com/web/api/BrowserRouter) de la bibliothèque React Router, en charge du routage des URL. Si on souhaite accéder à l'application depuis l'URL publique `http://w.x.y.z/carte-identite-territoire`, on lui affecte la valeur `/carte-identite-territoire`.

Voici donc le contenu du fichier `.env.production.local` (commentaires omis ici, par souci de concision, et adresse IP réelle remplacée par `w.x.y.z`) :

```
REACT_APP_REGIONSUD_API_URL=http://w.x.y.z/citer-back/api
REACT_APP_ROUTER_BASENAME=/carte-identite-territoire
```

#### Lancement du _build_

On lance le build en positionnant la variable `PUBLIC_URL` sur l'URL à laquelle l'app sera accessible :

    PUBLIC_URL=http://w.x.y.z/carte-identite-territoire npm run build

#### Lien symbolique vers le répertoire `/var/www/html`

En étant revenu à un compte utilisateur ayant les droits sudo :

    sudo ln -s /home/nodejs/citer-frontend/build /var/www/html/carte-identite-territoire

On peut alors accéder à l'application depuis un navigateur, à l'adresse <http://w.x.y.z/carte-identite-territoire>.

#### Modification du virtual host d'Apache

On souhaite rediriger toutes les requêtes arrivant vers `/carte-identite-territoire` ou un chemin dérivé, vers le fichier `index.html` servant de point d'entrée pour charger l'application React.

On va modifier le virtual host par défaut d'Apache (`/etc/apache2/sites-available/000-default.conf`), celui-là même qu'on avait déjà édité pour déployer le projet KPL. Sous les lignes qu'on avait déjà ajoutées, on ajoute :

        # All URLs not matching a filename should fall back to the React app's index
        <Directory "/var/www/html/carte-identite-territoire">
                FallbackResource "/carte-identite-territoire/index.html"
        </Directory>

Puis on redémarre Apache : `sudo systemctl restart apache2`

### Déploiement de l'application serveur

Des instructions sont fournies dans la documentation de Laravel, notamment dans les pages [Installation](https://laravel.com/docs/8.x/installation) et [Deployment](https://laravel.com/docs/8.x/deployment), sous la section "Getting Started".

#### Création d'un utilisateur non-privilégié

Par souci de séparation, on crée un autre compte utilisateur non-privilégié, qui sera le propriétaire du répertoire de l'application serveur :

    sudo adduser laravel

#### Récupération du code source via Git

On se connecte en tant que `laravel` : `su - laravel`

Puis on clone le dépôt de l'application serveur du projet CITer :

    git clone https://github.com/WildCodeSchool/remotefr-js-0920-p3-regionsud-identiteterritoire-back citer-backend

#### Installation de Composer

Toujours en tant qu'utilisateur `laravel`, et depuis son home dir, on télécharge Composer, en [suivant les instructions](https://getcomposer.org/download/).

    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"

Composer est alors disponible dans le répertoire courant, sous le nom `composer.phar`.

On le déplace sous `citer-backend`, le renommant en tant que `composer` : `mv composer.phar citer-backend/composer`.

#### Installation des dépendances

Composer étant installé dans le dossier `citer-backend`, on s'y place, et on installe les dépendances :

    cd citer-backend
    php composer install

Lors de cette première tentative, on reçoit un message d'erreur, indiquant des problèmes dans la chaîne de dépendances :

```
Installing dependencies from lock file (including require-dev)
Verifying lock file contents can be installed on current platform.
Your lock file does not contain a compatible set of packages. Please run composer update.

  Problem 1
    - laravel/framework is locked to version v8.21.0 and an update of this package was not requested.
    - laravel/framework v8.21.0 requires ext-mbstring * -> it is missing from your system. Install or enable PHP's mbstring extension.
  Problem 2
    - league/commonmark is locked to version 1.5.7 and an update of this package was not requested.
    - league/commonmark 1.5.7 requires ext-mbstring * -> it is missing from your system. Install or enable PHP's mbstring extension.
  Problem 3
    - tijsverkoyen/css-to-inline-styles is locked to version 2.2.3 and an update of this package was not requested.
    - tijsverkoyen/css-to-inline-styles 2.2.3 requires ext-dom * -> it is missing from your system. Install or enable PHP's dom extension.
  Problem 4
    - facade/ignition is locked to version 2.5.8 and an update of this package was not requested.
    - facade/ignition 2.5.8 requires ext-mbstring * -> it is missing from your system. Install or enable PHP's mbstring extension.
  Problem 5
    - phar-io/manifest is locked to version 2.0.1 and an update of this package was not requested.
    - phar-io/manifest 2.0.1 requires ext-dom * -> it is missing from your system. Install or enable PHP's dom extension.
  Problem 6
    - phpunit/php-code-coverage is locked to version 9.2.5 and an update of this package was not requested.
    - phpunit/php-code-coverage 9.2.5 requires ext-dom * -> it is missing from your system. Install or enable PHP's dom extension.
  Problem 7
    - phpunit/phpunit is locked to version 9.5.0 and an update of this package was not requested.
    - phpunit/phpunit 9.5.0 requires ext-dom * -> it is missing from your system. Install or enable PHP's dom extension.
  Problem 8
    - theseer/tokenizer is locked to version 1.2.0 and an update of this package was not requested.
    - theseer/tokenizer 1.2.0 requires ext-dom * -> it is missing from your system. Install or enable PHP's dom extension.
  Problem 9
    - laravel/framework v8.21.0 requires ext-mbstring * -> it is missing from your system. Install or enable PHP's mbstring extension.
    - laravel/sail v1.1.0 requires illuminate/contracts ^8.0|^9.0 -> satisfiable by laravel/framework[v8.21.0].
    - laravel/sail is locked to version v1.1.0 and an update of this package was not requested.

To enable extensions, verify that they are enabled in your .ini files:
    - /etc/php/8.0/cli/php.ini
    - /etc/php/8.0/cli/conf.d/10-opcache.ini
    - /etc/php/8.0/cli/conf.d/10-pdo.ini
    - /etc/php/8.0/cli/conf.d/20-calendar.ini
    - /etc/php/8.0/cli/conf.d/20-ctype.ini
    - /etc/php/8.0/cli/conf.d/20-exif.ini
    - /etc/php/8.0/cli/conf.d/20-ffi.ini
    - /etc/php/8.0/cli/conf.d/20-fileinfo.ini
    - /etc/php/8.0/cli/conf.d/20-ftp.ini
    - /etc/php/8.0/cli/conf.d/20-gettext.ini
    - /etc/php/8.0/cli/conf.d/20-iconv.ini
    - /etc/php/8.0/cli/conf.d/20-phar.ini
    - /etc/php/8.0/cli/conf.d/20-posix.ini
    - /etc/php/8.0/cli/conf.d/20-readline.ini
    - /etc/php/8.0/cli/conf.d/20-shmop.ini
    - /etc/php/8.0/cli/conf.d/20-sockets.ini
    - /etc/php/8.0/cli/conf.d/20-sysvmsg.ini
    - /etc/php/8.0/cli/conf.d/20-sysvsem.ini
    - /etc/php/8.0/cli/conf.d/20-sysvshm.ini
    - /etc/php/8.0/cli/conf.d/20-tokenizer.ini
You can also run `php --ini` inside terminal to see which files are used by PHP in CLI mode.
```

Ceci est essentiellement dû au fait que certaines extensions de PHP, nécessitées par Laravel, ne sont pas installées. Pour les installer, on ressort du compte `laravel` et retourne à un compte possédant les droits sudo, pour lancer :

    sudo apt-get install -y php8.0-mbstring php8.0-xml php8.0-curl php8.0-mysql

Note : l'extension MySQL n'est pas stictement requise à ce stade pour l'installation des dépendances, mais sera nécessaire plus tard.

De retour sur le compte `laravel`, la seconde tentative d'installation via `php composer install` fonctionne.

#### Création d'un lien symbolique vers la doc root d'Apache

À nouveau en ayant les droits sudo :

    sudo ln -s /home/laravel/citer-backend/public /var/www/html/citer-back

#### Réglage des permissions

On peut tenter de voir comment se comporte l'application à ce stade, en visitant l'URL <http://w.x.y.z/citer-back> (`w.x.y.z` étant toujours l'adresse IP publique du serveur). Une erreur 500 nous indique un problème, ce qui est normal, car tout n'est pas encore configuré.

On peut regarder les logs d'erreur Apache :

    sudo tail /var/log/apache2/error.log

On y trouve entre autres cette erreur :

    PHP Fatal error:  Uncaught ErrorException: file_put_contents(/home/laravel/citer-backend/storage/framework/views/7e9219dc5577d7c50085fdd56e7a82c1074f07e4.php): Failed to open stream: Permission denied

Certains sous-répertoires du répertoire `storage` de l'application ne peuvent pas être écrits par l'utilisateur `www-data`, qui est l'utilisateur configuré pour lancer Apache.

Le tutoriel [How to set up file permissions for Laravel](https://linuxhint.com/how-to-set-up-file-permissions-for-laravel/) propose plusieurs façons d'y remédier.

On va s'inspirer de la dernière (section "Your user as owner"), pour donner les droits d'écriture sur certains sous-répertoires de l'application aux utilisateurs du groupe `www-data`. On lance les commandes suivantes :

    sudo chown -R laravel:www-data /home/laravel/citer-backend/storage
    sudo find /home/laravel/citer-backend/storage/logs/ -type f -exec chmod 664 {} \;
    sudo find /home/laravel/citer-backend/storage/logs/ -type d -exec chmod 775 {} \;
    sudo find /home/laravel/citer-backend/storage/framework/ -type f -exec chmod 664 {} \;
    sudo find /home/laravel/citer-backend/storage/framework/ -type d -exec chmod 775 {} \;

Site à cela, un rechargement de la page <http://w.x.y.z/citer-back> se conclut toujours par une erreur 500, qui ne provient plus d'Apache, mais de Laravel lui-même. Il va maintenant s'agir de configurer l'application.

#### Configuration - clé de chiffrement

On va donc trouver la source de l'erreur 500 sous `storage/logs/laravel.log`. Depuis `citer-backend` : `tail -n 30 storage/logs/laravel.log`.

L'erreur est la suivante : `No application encryption key has been specified`.

On doit d'abord copier le fichier `.env.example` en tant que `.env` :

    cp .env.example .env

Puis on lance cette commande, permettant de générer une clé de chiffrement (variable `APP_KEY` dans `.env`) :

    php artisan key:generate

On peut désormais accéder à la page d'accueil de l'application serveur sans erreur, mais il reste des choses à configurer.

#### Modification du Virtual Host d'Apache

On édite à nouveau `/etc/apache2/sites-available/000-default.conf`.

On va utiliser la directive `FallbackResource`, pour rediriger toutes les requêtes entrantes sur le chemin `/citer-back` vers le fichier `index.php` de Laravel, qui va se charger de router la requête vers le bon contrôleur.

Sous les lignes ajoutées précédemment, on ajoute ce bloc :

        # All URLs not matching a filename should fall back to Laravel's front controller
        <Directory "/var/www/html/citer-back">
                FallbackResource "/citer-back/index.php"
        </Directory>

Puis on redémarre Apache : `sudo systemctl restart apache2`

#### Installation de MariaDB / MySQL

On se rend sur l'un des _endpoints_ de l'API fournie par l'application Laravel : <http://w.x.y.z/citer-back/api/communes>. On obtient cette erreur car la BDD n'est pas encore configurée :

```
SQLSTATE[HY000] [2002] Connection refused (SQL: select * from `communes` limit 20 offset 0)
```

Il faut installer un serveur MySQL ou MariaDB. On opte pour ce dernier. Avec les droits sudo :

    sudo apt-get install -y mariadb-server

Puis on lance la console MySQL : `sudo mysql -uroot`.

On crée une base de données :

    create database carte_identite_territoire character set utf8mb4 collate utf8mb4_unicode_ci;

De là, on va créer un utilisateur local, et lui donner des droits sur la base de données.

On génère d'abord un mot de passe (mot de passe factice ici) :

    SELECT PASSWORD('Fake.Pwd!') AS password;

On crée l'utilisateur, en utilisant le mot de passe qui vient de nous être donné, et on lui octroie les privilèges pour accéder à la base `carte_identite_territoire` :

    CREATE USER citer@localhost IDENTIFIED BY PASSWORD '*99C7C2A4CABD73D95FD473167CED67EDE0F4DFB4';
    GRANT ALL PRIVILEGES on carte_identite_territoire.* to citer@localhost;

#### Configuration - Base de données

On **resssort** de la console MySQL puis, en tant que `laravel`, on édite 3 variables dans `/home/laravel/citer-backend/.env` :

```
DB_DATABASE=carte_identite_territoire
DB_USERNAME=citer
DB_PASSWORD=Fake.Pwd!
```

#### Run des migrations

Si on recharge la page <http://w.x.y.z/citer-back/api/communes>, on obtient une erreur différente, complétée par une invitation à lancer les migrations.

On va le faire en ligne de commande, ce qui va nous permettre au passage de _seeder_ la base de données. Toujours en tant que `laravel`, sous le dossier `~/citer-backend` :

    php artisan migrate:refresh --seed

Cette étape prend un peu de temps, car des fichiers JSON et CSV volumineux sont importés dans les différentes tables.

#### Configuration - autres variables

> TO BE COMPLETED

Commandes :
1/ php composer install
2/ php artisan migrate:refresh --seed
