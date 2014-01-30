<?php
if(!isset($SMINCLUDEOK)){
include(smPATH . '/include/fonctions_sm.php');
}
        if(!get_option('sm_license_key')) {
		echo "<br><br>".__("Vous n'avez pas de license, vous utilisez la version gratuite","e-mailing-service")."";	
		} else {
        global $wpdb;
        $table_options = $wpdb->prefix.'options';
		$array =array (
		"site" => str_replace("www.","",$_SERVER['HTTP_HOST']),
		"license_key" => get_option('sm_license_key'), 
		"login" => get_option('sm_login'),
		"ip" => $_SERVER['REMOTE_ADDR']
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_license.php',$array);
		$xml2l = post_xml($fluxl,'item',array('resultat','license','stats_smtp','limite_journaliere','limite_mensuel','stats_blacklist','blacklist','alias_multi','mass_mailing_nb','bounces','alerte','date_inscription','date_validite','date_renouvellement','licence_key'));		
		foreach($xml2l as $row) {
		if($row[0] == 1){ 
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$row[1]."' WHERE `option_name`='sm_license'");
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$row[9]."' WHERE `option_name`='sm_bounces'");
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$row[5]."' WHERE `option_name`='sm_blacklist'");
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$row[2]."' WHERE `option_name`='sm_stats_smtp'");	
		if(get_option('sm_alerte') ) {
        $wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$row[10]."' WHERE `option_name`='sm_alerte'");
        } else { 
		add_option('sm_alerte','oui'); 
		}	
		if($row[2] =="api_mass-mailing" || $row[2] =="mass-mailing"){
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$row[8]."' WHERE `option_name`='sm_multi_nb'");
		}
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$row[3]."' WHERE `option_name`='sm_nbl'");
		echo "<br><br>".__("Les options de votre license sont a jour","e-mailing-service")."";
		} else {
		echo "<br><br>".__("Votre license comporte une erreur , contacter le support","e-mailing-service")."";				
		}
		}
		}
 ?>