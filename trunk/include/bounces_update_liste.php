<?php
global $wpdb;
if(!isset($SMINCLUDEOK)){
include(smPATH . '/include/fonctions_sm.php');
}
$table_envoi= $wpdb->prefix.'sm_historique_envoi';
$table_posts= $wpdb->prefix.'posts';
$table_liste= $wpdb->prefix.'sm_liste';
$table_temps= $wpdb->prefix.'sm_temps';
$table_log= $wpdb->prefix.'sm_log';
$table_log_bounces= $wpdb->prefix.'sm_bounces_log';
$table_bounces_hard= $wpdb->prefix.'sm_bounces_hard';
if(cgi_bounces() == 'non'){
echo "".__("Vous n'avez pas souscrit a l'option qui vous permet de recuperer les bounces, pour ajouter cette option","e-mailing-service")."";
echo '<a href="http://www.e-mailing-service.net/options/?option=opt-npai" target="_blank">'.__("cliquez ici","e-mailing-service").'</a> .<br>';
echo "".__("L'option est au tarifs de 2 euros mois si vous ne disposez pas de serveur SMTP chez nous","e-mailing-service")."";
} else {
if(!isset($action)){
$action="null";	
} else {
if($action =="reset"){
$wpdb->query("UPDATE `".$table_bounces_hard."` SET `update` ='0'");	
}
}
	     $sqlhard = $wpdb->get_results("SELECT id,email FROM `".$table_bounces_hard."` WHERE `update`='0'");
         foreach (  $sqlhard as $reshard ) 
         {		 
         $listese1 = $wpdb->get_results("SELECT liste_bd FROM `".$table_liste."`");
         foreach ( $listese1 as $reslistee1 ) 
         {
		 echo '#######'.$reslistee1->liste_bd.'#####<br>';
		 $listese2 = $wpdb->get_results("SELECT count(id) AS total FROM `".$reslistee1->liste_bd."` WHERE email like '".trim(mysql_real_escape_string($reshard->email))."'");
         foreach ( $listese2 as $rescount ) 
         {
			           if($rescount->total > 0)
			           {
         $wpdb->update( $table_bounces_hard, array('update' => 1), array( 'id' => $reshard->id));
		 $wpdb->query("UPDATE `".$reslistee1->liste_bd."` SET bounces ='0' WHERE email like '".trim(mysql_real_escape_string($reshard->email))."'");

		 echo ''.$reshard->email.'  '.__('update list','e-mailing-service').'  '.$reslistee1->liste_bd.'';	
		 echo "<br>";	               
		                 }	
		 }
		
		 }
		          echo "<br>";
		 }
         
		 $sqlhard = $wpdb->get_results("SELECT id,email FROM `".$table_bounces_hard."` WHERE `update`='0'");
         foreach (  $sqlhard as $reshard ) 
         {	
		 if($reshard->email	!='@'){ 
         $listese1 = $wpdb->get_results("SELECT liste_bd FROM `".$table_liste."`");
         foreach ( $listese1 as $reslistee1 ) 
         {
		 echo '#######'.$reslistee1->liste_bd.'#####<br>';
		 $listese2 = $wpdb->get_results("SELECT count(id) AS total FROM `".$reslistee1->liste_bd."` WHERE email like '%".trim(mysql_real_escape_string($reshard->email))."%'");
         foreach ( $listese2 as $rescount ) 
         {
			           if($rescount->total > 0)
			           {
		$wpdb->query("UPDATE `".$reslistee1->liste_bd."` SET bounces ='0' WHERE email like '%".trim(mysql_real_escape_string($reshard->email))."%'");
        $wpdb->update( $table_bounces_hard, array('update' => 1), array( 'id' => $reshard->id));
		 echo ''.$reshard->email.'  '.__('update list','e-mailing-service').'  '.$reslistee1->liste_bd.'';	
		 echo "<br>";	               
		                 }	
		 }
		 }
		 }
		          echo "<br>";
		 }
}
?>