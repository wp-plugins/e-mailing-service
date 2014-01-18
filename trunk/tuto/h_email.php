<?php
echo '<h2>'.__("Menu","e-mailing-service").' '.__("destinataires","e-mailing-service").'</h2><br>';
_e("La liste permet de classer vos clients par categories, nous vous conseillons de garder la categorie creer par defaut (test) pour effectuer vos tests de mailing","e-mailing-service");
echo '<br>';
echo '<br>';
_e("Vous avez la possibilites de creer des champs specifiques , se qui vous permettra de gerer les informations sur vos clients comme vous le souhaitez et rajouter ces informations automatiquement dans vos mailings","e-mailing-service");
echo '<br>';
_e("Dans le menu widget de votre wordpress , vous devez activer notre widget , pour ajouter le formulaire d'inscription sur votre site. ","e-mailing-service");
echo '<br><br>';
_e("Si vous avez l'option NPAI (bounces) est active sur votre license, les email invalide (hard bounces) serons desactive de vos listes","e-mailing-service");
echo '<br>';
echo '<br>';
echo '<h2>'.__("Menu","e-mailing-service").' '.__("Importation d'email","e-mailing-service").'</h2><br>';
_e("Vous devez avoir le dossier /e-mailing-service/post avec l'autorisation sur le dossier (CHMOD 777) pour pouvoir importer des fichiers emails, une fois importer vos fichiers sont supprimes","e-mailing-service");
echo '<br>';
_e("Pas defaut en general vous pouvez importer un fichier de 2mo, pour augmenter celui-ci , il faut rajouter dans votre fichier .htaccess","e-mailing-service");
echo ": <br><textarea name=\"\" cols=\"50\" rows=\"3\">
php_flag post_max_size 50M
php_flag upload_max_filesize 50M
php_flag upload_max_size 50M</textarea>";
echo '<br>';
echo '<br>';
?>
