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

if(cgi_bounces() == 'non'){

echo "".__("Vous n'avez pas souscrit a l'option qui vous permet de recuperer les bounces, pour ajouter cette option","e-mailing-service")."";
echo '<a href=\"admin.php?page=e-mailing-service/admin/index.php\" target="_blank">'.__("cliquez ici","e-mailing-service").'</a> .<br>';
echo "".__("L'option est au tarifs de 2 euros mois si vous ne disposez pas de serveur SMTP chez nous","e-mailing-service")."";

} else {
        
		$domaine_client= str_replace("www.","",$_SERVER['HTTP_HOST']);
        $xml_license=lit_xml('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_npai.php?domaine_client='.$domaine_client.'&login='.get_option('sm_login').'&action=license','item',array('idb','login'));
        if ($xml_license!='') {
        foreach($xml_license as $res) {	
		$idb=$res[0];
		echo "<br>####################<br>".__("Update bounces pour","e-mailing-service")." ".$domaine_client." ".__("license","e-mailing-service")." n  ".$idb."<br>";
        $xml2=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_npai.php?idb='.$idb.'&domaine_client='.$domaine_client.'&login='.get_option('sm_login').'&action=mj','item',array('idb','email','fai','rules_cat','rules_no','date','subject','bounce_type','diag_code','dsn_message','dsn_report','date_insert','hie'));
        if ($xml2!='') {			
		$i=0;
        foreach($xml2 as $row) {	
        $wpdb->replace($table_log_bounces, array(  
            'idb' => $idb,  
            'email' => $row[1],
			'hie' => $row[12],
			'fai' => $row[2],
			'rules_cat' => $row[3],
            'rules_no' => $row[4],
			'date' => $row[5],
			'subject' => $row[6],  
            'bounce_type' => $row[7],
			'diag_code' => $row[8],
			'dsn_message' => $row[9],
            'dsn_report' => $row[10],
			'date_insert' => $row[11],
        )); 
		$i++;
		}
		echo '<br>'.$i.' '.__("bounces ont ete insere dans la base de donnee pour la license","e-mailing-service").' : '.$idb.'';
		}
		}
		}
}
?>