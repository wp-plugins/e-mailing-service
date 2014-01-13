<?php
echo '<h2>'.__("Menu","e-mailing-service").' '.__("Statistiques","e-mailing-service").'</h2><br>';
if(get_option('sm_license')=="free" || !get_option('sm_license_key')){
_e("Nous ne pouvons pas fournir de statistiques detailles si vous nous fournissez pas l'autorisation d'interagir avec votre site, c'est entierement gratuit,  pour cela rendez vous dans le menu ","e-mailing-service");
echo "<a href=\"?page=e-mailing-service/admin/configuration.php\">".__("License et options","e-mailing-service")."</a>";
} else {
_e("Les statistiques d'ouverture sont effectuer avec une image, malheureusement si le destinataire n'active pas l'affichage d'image sur ces emails, l'ouverture de l'email ne sera pas pris en compte","e-mailing-service");
echo '<br>';
_e("Les statistiques d'ouverture sont donc largement inferieur a la normal","e-mailing-service");
echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
}
?>
