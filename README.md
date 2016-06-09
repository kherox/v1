Bientôt une **V2** de Ticki.

[![Github Issues](http://githubbadges.herokuapp.com/Ticki/Site-Web/issues.svg?style=flat-square)](https://github.com/Gynidark/Ticki/issues)
[!['License'](https://img.shields.io/badge/License-MIT-blue.svg?style=flat-square)](http://gynidark.github.io/)
[![CakePHP 3](https://img.shields.io/badge/CakePHP 3-%E2%99%A5-44CB12.svg?style=flat-square)](http://cakephp.org)
[!['By'](https://img.shields.io/badge/By-Gynidark-blue.svg?style=flat-square)](http://gynidark.github.io/)

> **Ticki** est un projet avec **CakePHP 3** afin d'aider les débutants avec ce framework **PHP**.

## Ticki?
Poster un ticket et des personnes y répondrons.

## Fonctionnalités
- Tickets (CRUD)
- Système de permission
- Administration
- Espace membre complet


Pour l'utiliser, rien de plus simple, vous l'ajouté sur votre hébergeur dans un dossier ***Ticket/***.

# Installation
*Ticki fonctionnera à condition que vous ayez ajouté la base de données.*

### Prérequis
- extension php **intl**
- composer

### Via Github
- Télécharger le fichier zip : [Ticki](https://github.com/Gynidark/Ticki/archive/master.zip)
- Extraire le contenu et lancer ``` composer install```

### Via Packagist
- ```composer create-project --prefer-dist gynidark/ticki```

### Configuration
- Les variables de configurations se trouve dans le fichier ```config/ticki.php```
- Pour configuer l'accès à la base de données : ```config/app.php```
- Afin de configurer la base de données vous pouvez :
    - Importer le schéma se trouvant dans ```config/schema/ticki.sql```
    - **OU**
    - Créer une base de données **ticki**, et dans une invite de commande lancer ```bin/cake migrations migrate```

## Connexion
- Compte **administrateur** : ```admin``` et le mot de passe ```admin```
- Compte **membre** : ```member``` et le mot de passe ```member```
