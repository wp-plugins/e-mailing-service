<?php
global $wpdb;
if(!isset($SMINCLUDEOK)){
include(smPATH . '/include/fonctions_sm.php');
}
extract($_GET);
if(isset($_GET["action"] )){
if($_GET["action"] == "ticket_fermer"){
	    $host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);
		$array =array (
		"domaine_client" => $host,
		"license_key" => get_option('sm_license_key'),
		"login" => get_option('sm_login'),
		"action" => "ticket_fermer",
		"ticket_id"  => $_GET["id"]
			); 
       $flux=xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_ticket.php',$array);
	   //echo '<textarea name="" cols="100" rows="5">'.$flux.'</textarea>';	
	   _e("Votre ticket a bien ete ferme","e-mailing-service");
	}
elseif($_GET["action"] == "ticket_lire" ){
    $domaine_client= str_replace("www.","",$_SERVER['HTTP_HOST']);
	$xml2=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_ticket.php?domaine_client='.$domaine_client.'&login='.get_option('sm_login').'&license_key='.get_option('sm_license_key').'&action=ticket_lire&ticket_id='.$_GET["id"].'','item',array('id','message','pseudo','date','type'));
    $tableau_ticket="";
    $tableau_ticket .= '<table class="widefat">
                         <thead>';
    $tableau_ticket .= "<tr>";
	$tableau_ticket .= "<td><blockquote>".__('Message',"e-mailing-service")."</blockquote></td>";
	$tableau_ticket .= "<td><blockquote>".__('pseudo',"e-mailing-service")."</blockquote></td>";
	$tableau_ticket .= "<td><blockquote>".__('Date',"e-mailing-service")."</blockquote></td>";
    $tableau_ticket .= '</tr>           
        </thead>
        <tbody>';
        if($xml2!='') {
        foreach($xml2 as $row) {
    $tableau_ticket .= "<tr class=\"sm_colonne_".$row[4]."\">
	<td class=\"sm_colonne_".$row[4]."\"><blockquote><span class=\"sm_colonne_".$row[4]."\">".$row[1]."</span></blockquote></td>
	<td class=\"sm_colonne_".$row[4]."\"><blockquote><span class=\"sm_colonne_".$row[4]."\">".$row[2]."</span></blockquote></td>
	<td class=\"sm_colonne_".$row[4]."\"><blockquote><span class=\"sm_colonne_".$row[4]."\">".$row[3]."</span></blockquote></td>
	"; 
    $tableau_ticket .= '</tr>';
    }
    }
$tableau_ticket .= '</tbody></table>';			
echo $tableau_ticket ;
?>
<br />
<form action="?page=e-mailing-service/admin/support.php&section=ticket_liste&action=ticket_lire&id=<?php echo $id;?>" method="post">
<input type="hidden" name="action" value="ticket_reponse" />
<input type="hidden" name="ticket_id" value="<?php echo $id;?>" />
<table>
        <tbody>
<tr>
  <td><?php _e('Repondre',"e-mailing-service");?></td>
</tr>
<tr>
   <td><textarea name="message" cols="75" rows="10"></textarea>
    </td>
</tr>
<tr>
  <td><input name="submit" value="<?php _e('Repondre',"e-mailing-service");?>" type="submit" /></td>
</tr>
</tbody>
</table>
</form>
<?php	
} 
}else {
    $domaine_client= str_replace("www.","",$_SERVER['HTTP_HOST']);
	$xml2=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_ticket.php?domaine_client='.$domaine_client.'&login='.get_option('sm_login').'&license_key='.get_option('sm_license_key').'&action=ticket_liste','item',array('id','sujet','message','date','statut'));
    $tableau_ticket="";
    $tableau_ticket .= '<table class="widefat">
                         <thead>';
    $tableau_ticket .= "<tr>";
	$tableau_ticket .= "<td><blockquote>".__('N  du ticket',"e-mailing-service")."</blockquote></td>";
	$tableau_ticket .= "<td><blockquote>".__('Sujet',"e-mailing-service")."</blockquote></td>";
	$tableau_ticket .= "<td><blockquote>".__('Date',"e-mailing-service")."</blockquote></td>";
	$tableau_ticket .= "<td><blockquote>".__('Status',"e-mailing-service")."</blockquote></td>";
	$tableau_ticket .= "<td><blockquote>".__('Lire',"e-mailing-service")."</blockquote></td>";
	$tableau_ticket .= "<td><blockquote>".__('Fermer',"e-mailing-service")."</blockquote></td>";
    $tableau_ticket .= '</tr>           
        </thead>
        <tbody>';
        if($xml2!='') {
        foreach($xml2 as $row) {
    $tableau_ticket .= "<tr>
	<td><blockquote>".$row[0]."</blockquote></td>
	<td><blockquote>".$row[1]."</blockquote></td>
	<td><blockquote>".$row[3]."</blockquote></td>
	<td><blockquote>".$row[4]."</blockquote></td>
	<td><blockquote><a href='?page=e-mailing-service/admin/support.php&section=ticket_liste&action=ticket_lire&id=".$row[0]."&sujet=".$row[1]."'>". __("Lire", "e-mailing-service")."</a></blockquote></td>
	<td><blockquote><a href='?page=e-mailing-service/admin/support.php&section=ticket_liste&action=ticket_fermer&id=".$row[0]."'>". __("Fermer", "e-mailing-service")."</a></blockquote></td>
	"; 
    $tableau_ticket .= '</tr>';
    }
    }
$tableau_ticket .= '</tbody></table>';			
echo $tableau_ticket ;
}
?>


