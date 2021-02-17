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


!!!!!!!

Commandes :
1/ php composer install
2/ php artisan migrate:refresh --seed
