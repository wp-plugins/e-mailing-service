<?php
global $wpdb;
if(!isset($SMINCLUDEOK)){
include(smPATH . '/include/fonctions_sm.php');
}
$table_envoi= $wpdb->prefix.'sm_historique_envoi';
$id=0;
echo "<h2>".__("Tester la vitesse d'envoi de votre newsletter","e-mailing-service")."</h2>";	
$fivesdrafts = $wpdb->get_results("SELECT id AS hie,status,nb_attente,pause FROM `".$table_envoi."` WHERE status='En cours' ORDER BY id desc");
foreach ( $fivesdrafts as $fivesdraft ) 
{
_e("Si votre newsletter envoi moin vite que le reglage que vous avez effectue lors de l'envoi , c'est que votre Hebergement wordpress est trop lent","e-mailing-service");
echo "<br>";	
	$id=$fivesdraft->hie;
$nb_avant_sleep=nbattente($fivesdraft->hie);
echo _e("Nombre en attente","e-mailing-service");
echo " : ".$nb_avant_sleep."<br>";
$pause= $fivesdraft->pause+10;
sleep($pause);
$apres=nbattente($fivesdraft->hie);
echo _e("Nombre en attente apres ","e-mailing-service");
echo "".$pause." ".__("secondes","e-mailing-service")." : ".$apres." <br>";
if($nb_avant_sleep == $apres){
echo _e("le status va etre reactiver","e-mailing-service");
        $sql3 ="UPDATE `".$table_envoi."` SET `status`='reactiver' WHERE id = '".$fivesdraft->hie."'";
        $result3 = $wpdb->query($wpdb->prepare($sql3,true));	
}
}
if($id ==0){
_e("Vous n'avez pas de newsletter qui tourne actuellement, vous ne pouvez donc pas verifier la vitesse d'envoi","e-mailing-service");	
}
 ?>