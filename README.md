![Logo](https://sc-cdn.scaleengine.net/i/16fdf0408cb5ac329f672d0671bc1e0a.png)

[![Github Issues](http://githubbadges.herokuapp.com/OranTicket/Site-Web/issues.svg?style=flat-square)](https://github.com/OranTicket/Site-Web/issues)
[!['License'](https://img.shields.io/badge/License-MIT-blue.svg?style=flat-square)](http://gynidark.github.io/)
[![CakePHP 3](https://img.shields.io/badge/CakePHP 3-%E2%99%A5-44CB12.svg?style=flat-square)](http://cakephp.org)
[!['By'](https://img.shields.io/badge/By-Gynidark-blue.svg?style=flat-square)](http://gynidark.github.io/)
[![Total Downloads](https://img.shields.io/packagist/dt/gynidark/oranticket.svg?style=flat-square)](https://packagist.org/packages/gynidark/oranticket)
[![Gitter Chat](https://img.shields.io/badge/Gitter-Join%20Chat-red.svg?style=flat-square)](https://gitter.im/OranTicket)

**OranTicket** est fait pour vous, il vous permetera de créer des tickets.

Dès que vous rencontré un souci, poster un ticket et des personnes y répondrons. Sur **OranTicket** il y aura un système de permission, des administrateurs, modérateurs et membre. Les Administrateurs pourront **supprimer**/**éditer** et **fermer** des tickets et les modérateur pourrons **supprimer**(confirmation par un administrateur) / **fermer** et **éditer** les tickets.

Pour l'utiliser, rien de plus simple, vous l'ajouté sur votre hébergeur dans un dossier ***Ticket/*** ou autre et **OranTicket** fonctionnera à condition que vous ayez ajouté la base de données.

# Utilisation

- Compte existant

```
Utilisateur  : admin

Mot de passe : admin
```
# Instalation
(Vous devez avoir **intl** pour que **OranTicket** fonctionne.)

- Manuellement:

```
composer install
```

- Composer:

```
composer require gynidark/oranticket dev-master
```

- NPM(Si vous le souhaitez utiliser **Gulp**):

```
npm install
```

- Configuration de votre fichier **config/oranticket.php**
- Importer le fichier OranTicket.sql *config/schema/OranTicket.sql* dans votre base de donnée. **ou** par terminal ```bin/cake migrations migrate```


Sinon vous pouvez télécharger manulement [OranTicket](https://github.com/OranTicket/Site-Web/archive/master.zip).


