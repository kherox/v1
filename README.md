![Logo](https://sc-cdn.scaleengine.net/i/16fdf0408cb5ac329f672d0671bc1e0a.png)

[![Github Issues](http://githubbadges.herokuapp.com/OranTicket/Site-Web/issues.svg?style=flat-square)](https://github.com/OranTicket/Site-Web/issues)
[!['License'](https://img.shields.io/badge/License-MIT-blue.svg?style=flat-square)](http://gynidark.github.io/)
[![CakePHP 3](https://img.shields.io/badge/CakePHP 3-%E2%99%A5-44CB12.svg?style=flat-square)](http://cakephp.org)
[!['By'](https://img.shields.io/badge/By-Gynidark-blue.svg?style=flat-square)](http://gynidark.github.io/)
[![Total Downloads](https://img.shields.io/packagist/dt/gynidark/oranticket.svg?style=flat-square)](https://packagist.org/packages/gynidark/oranticket)
[![Gitter Chat](https://img.shields.io/badge/Gitter-Join%20Chat-red.svg?style=flat-square)](https://gitter.im/OranTicket)

**OranTicket** est fait pour vous, il vous permetera de créer des tickets.

![screen](https://sc-cdn.scaleengine.net/i/be60441224e66362b5b117e3262a249f.png)

Dès que vous rencontré un souci, poster un ticket et des personnes y répondrons. Sur **OranTicket** il y aura un système de permission, des administrateurs, modérateurs et membre. Les Administrateurs pourront **supprimer**/**éditer** et **fermer** des tickets et les modérateur pourrons **supprimer**(confirmation par un administrateur) / **fermer** et **éditer** les tickets.

Pour l'utiliser, rien de plus simple, vous l'ajouté sur votre hébergeur dans un dossier ***Ticket/*** ou autre et **OranTicket** fonctionnera à condition que vous ayez ajouté la base de données.

# Installation

### Prérequis
- extension php **intl**
- composer

### Via Github
- Télécharger le fichier zip : [OranTicket](https://github.com/OranTicket/Site-Web/archive/master.zip)
- Extraire le contenu et lancer ``` composer install```

### Via Packagist
- ```composer require gynidark/oranticket```

### Configuration
- Les variables de configurations se trouve dans le fichier ```config/oranticket.php```
- Pour configuer l'accès à la base de données : ```config/app.php```
- Afin de configurer la base de données vous pouvez :
    - Importer le schéma se trouvant dans ```config/schema/oranticket.sql```
    - **OU**
    - Créer une base de données **oranticket**, et dans une invite de commande lancer ```bin/cake migrations migrate```

### Connexion
Le compte utilisateur par défault est ```admin``` et le mot de passe ```admin```

# Participation

### Prérequis
- npm
- gulp

```
git clone https://github.com/OranTicket/Site-Web.git oranticket
cd oranticket
npm install -g gulp
npm install
```

### Tâches gulp :
- ```gulp compass_scss```: Compile les fichiers scss en css.
- ```gulp minify-css```: Minifie les fichiers css en un seul fichier min.css.
- ```gulp default```: Crée une archive du code source.
- ```gulp watch```: Permet de compiler les fichiers scss à chaque modification.
