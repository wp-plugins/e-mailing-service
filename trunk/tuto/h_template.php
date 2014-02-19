<?php
echo '<h2>'.__("Menu","e-mailing-service").' '.__("Importation de modele","e-mailing-service").'</h2><br>';
_e("Vous devez avoir le dossier /e-mailing-service/post avec l'autorisation sur le dossier (CHMOD 777) pour pouvoir importer des fichier .zip","e-mailing-service");
echo "<br>";
_e("Le plugin a ete teste avec les design pour le marketing par email : ","e-mailing-service");
echo  '<a href="http://themeforest.net/category/marketing/email-templates?ref=tous1site" target="_blank">Themeforest</a>';
echo '<br>';
_e("Pas defaut en general vous pouvez importer un fichier de 2mo, pour augmenter celui-ci , il faut rajouter dans votre fichier .htaccess","e-mailing-service");
echo ": <br><textarea name=\"\" cols=\"50\" rows=\"5\">
php_flag post_max_size 50M
php_flag upload_max_filesize 50M
php_flag upload_max_size 50M</textarea>";
echo '<br>';
echo '<br>';
?>
