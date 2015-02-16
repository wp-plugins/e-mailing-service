<?php

       if(!get_option('sm_license_key')) {
		echo "<br><br>".__("Vous n'avez pas de license, vous utilisez la version gratuite","e-mailing-service")."";	
		$licen="free";
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
	    echo "<p>".__("Date d'inscription","e-mailing-service")."  : ".$row[11]."</p>";
		echo "<p>".__('Dernier Paiement',"e-mailing-service")."  : ".$row[12]."</p>";
		echo "<p>".__('Prochain prelevement',"e-mailing-service")." : ".$row[13]."</p>";
		$licen=$row[2]; 
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
				$licen=get_option('sm_license');
		echo "<p>".__("Login","e-mailing-service").": ".get_option('sm_login')."</p>";
		echo "<p>".__("License","e-mailing-service").": ".get_option('sm_license')."</p>";
		if($licen =="api_mass-mailing" || $licen =="mass-mailing"){
		echo "<p>".__("Nombres de SMTP","e-mailing-service")."  : ".get_option('sm_multi_nb')."</p>";	
		}

				if(get_option('sm_nbl') =="0"){
				echo "<p>".__("Limite Journaliere  : Illimites","e-mailing-service")."</p>";
			    echo "<p>".__("Limite Mensuel  :  Illimites","e-mailing-service")."</p>";
				} else {
                echo "<p>".__("Limite Journaliere","e-mailing-service")."  : ".get_option('sm_nbl')." mails/jours</p>";
			    echo "<p>".__("Limite Mensuel","e-mailing-service")."  : ".get_option('sm_nbm')." mails/mois</p>";
				}
				echo "<p>".__('Option Alerte',"e-mailing-service")." : ".get_option('sm_alerte')."</p>";
				echo "<p>".__('Option NPAI',"e-mailing-service")." : ".get_option('sm_bounces')."</p>";
				echo "<p>".__('Option stats SMTP',"e-mailing-service")." : ".get_option('sm_stats_smtp')."</p>";
				echo "<p>".__('Option Stats Blacklist',"e-mailing-service")."  : ".get_option('sm_blacklist')."</p>";
				echo "<p>".__('Service deblacklistage',"e-mailing-service")."  : ".get_option('sm_service_blacklist')."</p>";
				echo "<p>".__('Option Multi Alias',"e-mailing-service")."  : ".get_option('sm_alias')."</p>";

		
	
				?>