<?php

        if(get_option('sm_license_key')) {
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
		$licen =$xml2l->license; 
		$alerte=$xml2l->alerte;
		if(!isset($_SESSION["sm_mj_license"])){
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$licen' WHERE `option_name`='sm_license'");
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$xml2l->bounces."' WHERE `option_name`='sm_bounces'");
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$xml2l->stats_blacklist."' WHERE `option_name`='sm_blacklist'");
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$xml2l->stats_smtp."' WHERE `option_name`='sm_blacklist'");
		if(get_option('sm_alerte') ) {
        $wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$xml2l->alerte."' WHERE `option_name`='sm_alerte'");
        } else { 
		add_option('sm_alerte','non');   
		}	
		if($licen =="api_mass-mailing" || $licen =="mass-mailing"){
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$xml2l->mass_mailing_nb."' WHERE `option_name`='sm_multi_nb'");
		}
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$xml2l->limite_journaliere."' WHERE `option_name`='sm_nbl'");
		$_SESSION["sm_mj_license"] = date('Y-m-d H:i:s');
		}
		echo "<p>".__("Date d'inscription","e-mailing-service")."  : ".$xml2l->date_inscription."</p>";
		echo "<p>".__('Dernier Paiement',"e-mailing-service")."  : ".$xml2l->date_renouvellement."</p>";
		echo "<p>".__('Prochain prelevement',"e-mailing-service")." : ".$xml2l->date_validite."</p>";
		echo "<p>".__("Login","e-mailing-service").": ".get_option('sm_login')."</p>";
		echo "<p>".__("License","e-mailing-service").": ".$xml2l->license."</p>";
		if($licen =="api_mass-mailing" || $licen =="mass-mailing"){
		echo "<p>".__("Nombres de SMTP","e-mailing-service")."  : ".$xml2l->mass_mailing_nb."</p>";	
		}
		// license fonctionne pas
		} else {
		echo "<br><br>".__("Votre license comporte une erreur , contacter le support","e-mailing-service")."";
						
		}
		
		} else {
				
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