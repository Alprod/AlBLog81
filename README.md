# Mon Premier Blog 
![forthebadge](https://forthebadge.com/images/badges/built-with-love.svg)

Projet Openclassrooms sur la création de mon premier blog en php orienté objet

## Pour commencer

Telecharger la repository sur GitHub
-   HTTPS : ``https://github.com/Alprod/AlBLog81.git``
-   SSH : ``git@github.com:Alprod/AlBLog81.git``

### Configue PHP/APACHE2

Configurer votre apache afin de créer un virtualHost pour mon projet qui lui se trouve dans le dossier ``Docs``

-   _php.ini -> est configuré pour les utilisateurs de Mac et xdebug pour IDE phpStorm, sinon votre propre configuration est bonne.
-   _httpd.conf -> Une ligne à décommentée pour le virtualHost, vous pouvez conserver votre propre configue.
-   _httpd-vhost.conf -> Conserver votre chemin de là ou se trouve le projet mais important de conserver ``.../AlBLog81/public/`` pour les configurations ``.htaccess``

### Installation

Installer les dépendences composer ``composer install``

[PHPunit](https://phpunit.de) Executez la commande ``composer require PHPunit``

[PHPMailer](https://github.com/PHPMailer/PHPMailer) Executez la commande ``composer require phpmailer/phpmailer`` suivez les configurations [ici](https://github.com/PHPMailer/PHPMailer)

Attention pour les comptes Gmail il faut désactiver la double authentification.

## Démarrage

Lancer le projet en local via le server Apache

## Fabriqué avec

Les programmes/logiciels/ressources que vous avez utilisé pour développer votre projet

*   [bootstrap CDN](http://materializecss.com) - Framework CSS (front-end)
*   [PHPStorm](https://atom.io/) - IDE.
*   [Codacy](https://app.codacy.com/gh/Alprod/AlBLog81/dashboard?branch=master) - Analyseur de code accés direct au projet analiser.

## Auteurs

*   **Germain Alain** _alias_ [@Alprod](https://github.com/Alprod)