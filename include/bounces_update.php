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
echo '<a href=\"admin.php?page=e-mailing-service/admin/index.php\" target="_blank">'.__("cliquez ici","e-mailing-service").'</a> .<br>';
echo "".__("L'option est au tarifs de 2 euros mois si vous ne disposez pas de serveur SMTP chez nous","e-mailing-service")."";
} else {
        $i=0;
		$listese = $wpdb->get_results("SELECT id,email FROM `".$table_log_bounces."` WHERE  `bounce_type` ='hard'");
        foreach ( $listese as $reslistee ) 
         {	
        $wpdb->replace($table_bounces_hard, array(  
            'email' => $reslistee->email
        )); 
		    $wpdb->update( 
	        $table_log_bounces, 
	        array('update' => 1), 
	        array( 'id' => $reslistee->id ));
				$i++;	
		 }	
	    $listese1 = $wpdb->get_results("SELECT liste_bd FROM `".$table_liste."`");
        foreach ( $listese1 as $reslistee1 ) 
         {
		 $sqlupdate ="UPDATE ".$reslistee1->liste_bd." SET bounces ='0' WHERE email IN ( SELECT email FROM ".$table_bounces_hard."  )        ";
         $resupdate = $wpdb->query($wpdb->prepare($sqlupdate,true));
		 
		 }

		_e(' '.$i.' HARD bounces ont ete insere dans la base de donnee',"e-mailing-service");
		echo "<br>";
}
?>