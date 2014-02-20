<?php
global $wpdb;
if(!isset($SMINCLUDEOK)){
include(smPATH . '/include/fonctions_sm.php');
}
$table_spamscore = $wpdb->prefix.'sm_spamscore';
if(cgi_blacklist() == 'non'){

_e("Vous n\'avez pas souscrit a l'option qui vous permet de recuperer les bounces, pour ajouter cette option");
echo "<a href=\"#\" target=\"_blank\">".__("cliquez ici")."</a>.<br>";
_e("L'option est au tarifs de 2 euros / mois si vous ne disposez pas de serveur SMTP chez nous");
} else {
        
		$domaine_client= str_replace("www.","",$_SERVER['HTTP_HOST']);
        $xml_license=lit_xml('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_npai.php?domaine_client='.$domaine_client.'&login='.get_option('sm_login').'&action=spamscore','item',array('ip','smtp','spamscore'));
        if ($xml_license!='') {
        foreach($xml_license as $row) {	
		
        $wpdb->replace($table_spamscore, array(  
            'ip' => $row[0],  
            'smtp' => $row[1],
			'spamscore' => $row[2],
        )); 
		}
	echo '<br>'.__("Le spamscore de vos serveurs a bien ete mis a jour").'';
		}

}
?>