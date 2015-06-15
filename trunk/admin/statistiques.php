<?php 
include(smPATH . '/include/entete.php');
$domaine_client= str_replace("www.","",$_SERVER['HTTP_HOST']);
$xml2=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php?action=statm&key='.get_option('sm-key').'&login=$user_login&domaine_client='.$domaine_client.'','item',array('id','message','date','pseudo'));
    $tableau_ticket="";
    $tableau_ticket .= '<table class="widefat">';
        if($xml2!='') {
        foreach($xml2 as $row) {
    $tableau_ticket .= "<tr>
	<td><blockquote><a href='?page=admin-hosting/admin_support/index.php&section=faq&action=faq_lire&id=".$row[0]."'>".$row[1]."</a></blockquote></td>
	"; 
    $tableau_ticket .= '</tr>';
    }
}
$tableau_ticket .= '</table>';			
echo $tableau_ticket ;
