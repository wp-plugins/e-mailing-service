<?php
function sm_cron_blacklist(){
set_time_limit(0);
global $wpdb;
$table_blacklist= $wpdb->prefix.'sm_blacklist';
$datelimite = date("Y-m-d", mktime(0,0,0,date("m"),date("d")-2,date("Y"))); 

if(cgi_blacklist() == 'non'){

_e("Vous n'avez pas souscrit a l'option qui vous permet de surveiller l'inscription de votre IP ou nom de domaine sur les listes Anti-spam (blacklist), pour ajouter cette option","e-mailing-service");
echo '<a href=\"admin.php?page=e-mailing-service/admin/index.php\" target="_blank">'.__("cliquez ici","e-mailing-service").'</a> .<br>';
_e("L'option est au tarifs de 2 euros / mois si vous ne disposez pas de serveur SMTP chez nous","e-mailing-service");

} else {


		$sql ="DELETE FROM `".$table_blacklist."` WHERE `date` < '".$datelimite."'";
        $result = $wpdb->query($sql); 
		$domaine_client= str_replace("www.","",$_SERVER['HTTP_HOST']);
		if(get_option('sm_debug')=="oui"){
		echo '<a href="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_blacklist.php?domaine_client='.$domaine_client.'&login='.get_option('sm_login').'&license_key='.get_option('sm_license_key').'">'.__("Verifier le flux","e-mailing-service").'</a>';
		}
		$xml2=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_blacklist.php?domaine_client='.$domaine_client.'&login='.get_option('sm_login').'&license_key='.get_option('sm_license_key').'','item',array('date','ip','blacklist','lien','delist','details','type'));
        if($xml2!='') {
		$i=0;
        foreach($xml2 as $row) {
				if(get_option('sm_debug')=="oui"){
		echo "<br>####################<br>".__("Update blacklist pour","e-mailing-service")." ".$row[1]."  -> ".$row[2]."<br>";	
		         }
        $wpdb->replace($table_blacklist, array(  
            'date' => current_time('mysql'),
			'ip' => $row[1],
			'blacklist' => $row[2],
            'lien' => $row[3],
			'delist' => $row[4],
			'details' => $row[5],
			'type' => $row[6],
        )); 
		$i++;
		}
		echo '<br>'.$i.' '.__("blacklist ont ete insere dans la base de donnee","e-mailing-service").'';
		}				
}
}