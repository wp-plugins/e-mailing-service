<?php
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
		$xmll = strstr($fluxl,'</xml>', true);
		$xml2l = simplexml_load_string($xmll);
		if($xml2l->resultat == 1){ 
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$xml2l->license."' WHERE `option_name`='sm_license'");
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$xml2l->bounces."' WHERE `option_name`='sm_bounces'");
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$xml2l->stats_blacklist."' WHERE `option_name`='sm_blacklist'");
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$xml2l->stats_smtp."' WHERE `option_name`='sm_stats_smtp'");	
		if(get_option('sm_alerte') ) {
        $wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$xml2l->alerte."' WHERE `option_name`='sm_alerte'");
        } else { 
		add_option('sm_alerte','oui'); 
		}	
		if($xml2l->license =="api_mass-mailing" || $xml2l->license =="mass-mailing"){
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$xml2l->mass_mailing_nb."' WHERE `option_name`='sm_multi_nb'");
		}
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$xml2l->limite_journaliere."' WHERE `option_name`='sm_nbl'");
		echo "<br><br>".__("Les options de votre license sont a jour","e-mailing-service")."";
		} else {
		echo "<br><br>".__("Votre license comporte une erreur , contacter le support","e-mailing-service")."";				
		}
		}
 ?>