<?php
global $wpdb;
if(!isset($SMINCLUDEOK)){
include(smPATH . '/include/fonctions_sm.php');
}
date_default_timezone_set('Europe/Paris');
if(get_option('sm_license') !="free"){
$table_envoi= $wpdb->prefix.'sm_historique_envoi';  
$valide_jour=date('Y-m-d H:i:s', strtotime('-2 days'));		
	$fivesdrafts = $wpdb->get_results("SELECT id AS hie FROM `".$table_envoi."` WHERE date_envoi > '".$valide_jour."'");
    foreach ( $fivesdrafts as $fivesdraft ) 
    {
    echo "<br>".__("Statistiques de l'envoi numero :","e-mailing-service")." ".$fivesdraft->hie." ".__("mis a jour","e-mailing-service")." ";
	$array =array (
		"domaine_client" => str_replace("www.","",$_SERVER['HTTP_HOST']),
		"nb_envoi" =>  nb_envoi_in($fivesdraft->hie),
		"action" => "nb_envoi_fin",
		"hie" => $fivesdraft->hie	
	); 
    xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_mj.php',$array);
    }
}
 ?>