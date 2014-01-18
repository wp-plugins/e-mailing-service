<?php
global $wpdb;
if(!isset($SMINCLUDEOK)){
include(smPATH . '/include/fonctions_sm.php');
}
$table_envoi= $wpdb->prefix.'sm_historique_envoi';
$fivesdrafts = $wpdb->get_results("SELECT id AS hie,status,nb_attente,pause FROM `".$table_envoi."` WHERE status='En cours' ORDER BY id desc");
foreach ( $fivesdrafts as $fivesdraft ) 
{
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

 ?>