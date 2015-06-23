<?php
function sm_cron_bounces_delete(){
set_time_limit(0);
global $wpdb;
$table_envoi= $wpdb->prefix.'sm_historique_envoi';
$table_posts= $wpdb->prefix.'posts';
$table_liste= $wpdb->prefix.'sm_liste';
$table_temps= $wpdb->prefix.'sm_temps';
$table_log= $wpdb->prefix.'sm_log';
$table_log_bounces= $wpdb->prefix.'sm_bounces_log';
$table_bounces_hard= $wpdb->prefix.'sm_bounces_hard';
if(cgi_bounces() == 'non'){
echo "".__("Vous n'avez pas souscrit a l'option qui vous permet de recuperer les bounces, pour ajouter cette option")."";
echo '<a href=\"http://www.e-mailing-service.net/options/?option=opt-npai\" target="_blank">cliquez ici</a>.<br>';
echo "".__("L'option est au tarif de 2 euros mois si vous ne disposez pas de serveur SMTP chez nous")."";
} else {

             $datelimite = date("Y-m-d", mktime(0,0,0,date("m"),date("d")-2,date("Y"))); 
             _e('Les bounces dont la date est inferieur a '.$datelimite.' ont ete supprime');
	         $sql ="DELETE FROM `".$table_log_bounces."` WHERE `date_insert` < '".$datelimite."'";
             $result = $wpdb->query($sql); 
}
}

?>