<?php
global $wpdb;
if(!isset($SMINCLUDEOK)){
include(smPATH . '/include/fonctions_sm.php');
}
if(isset($_GET["action"])){
if($_GET["action"] == "faq_lire" ){
    $domaine_client= str_replace("www.","",$_SERVER['HTTP_HOST']);
	$xml2=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_ticket.php?domaine_client='.$domaine_client.'&login='.get_option('sm_login').'&license_key='.get_option('sm_license_key').'&action=faq_lire&ticket_id='.$_GET["id"].'','item',array('id','question','reponse','pseudo','date'));
    $tableau_ticket="";
    $tableau_ticket .= '<table class="widefat">
                         <thead>';
    $tableau_ticket .= "<tr>";
	$tableau_ticket .= "<td><blockquote>".__('Question',"e-mailing-service")."</blockquote></td>";
	$tableau_ticket .= "<td><blockquote>".__('pseudo',"e-mailing-service")."</blockquote></td>";
	$tableau_ticket .= "<td><blockquote>".__('Date',"e-mailing-service")."</blockquote></td>";
    $tableau_ticket .= '</tr>           
        </thead>
        <tbody>';
        if($xml2!='') {
			$i=0;
        foreach($xml2 as $row) {
	if($i==0){
    $tableau_ticket .= "<tr class=\"sm_colonne_support\">
	<td><blockquote><span class=\"sm_colonne_support\">Question :<br> ".stripslashes($row[1])."<br></span></blockquote></td>
	<td><blockquote><span class=\"sm_colonne_support\">".$row[3]."</span></blockquote></td>
	<td><blockquote><span class=\"sm_colonne_support\">".$row[4]."</span></blockquote></td>
	"; 
    $tableau_ticket .= '</tr>';		
	} else {
    $tableau_ticket .= "<tr>
	<td><blockquote>".stripslashes($row[2])."</blockquote></td>
	<td><blockquote>".$row[3]."</blockquote></td>
	<td><blockquote>".$row[4]."</blockquote></td>
	"; 
    $tableau_ticket .= '</tr>';
	}
	$i++;
    }
    }
$tableau_ticket .= '</tbody></table>';			
echo $tableau_ticket ;
?>

<?php	
} } else {
	
?>
<h2><?php echo _e("Vous souhaitez que nous rajoutions des options ou des ameliorations au plugin ?
<br>Faites en la demande.
<br>Les idees qui obtiennent le plus de vote, sont develloppes en priorite","e-mailing-service");?></h2>
<?php 
	if(get_option('sm_license')=="free" || !get_option('sm_license_key')){
_e("Pour pouvoir envoyer une suggestion a notre equipe de devellopeur, vous devez activer gratuitement la permission d'interagir avec notre site dans la rubrique ","e-mailing-service");
echo "<a href=\"?page=e-mailing-service/admin/configuration.php\">".__("License et options","e-mailing-service")."</a>";		
	} else { 
	?>
<form action="?page=e-mailing-service/admin/support.php&section=suggestion" method="post">
<input type="hidden" name="action" value="suggestion" />
<input type="hidden" name="email" value="<?php echo get_option('email_admin');?>" />
<table>
        <tbody>
<tr>
  <td><?php _e('Suggestion',"e-mailing-service");?></td>
</tr>
<tr>
   <td><textarea name="suggestion" cols="75" rows="10"></textarea>
    </td>
</tr>
<tr>
  <td><input name="submit" value="<?php _e('Envoyer votre demande',"e-mailing-service");?>" type="submit" /></td>
</tr>
</tbody>
</table>
</form>
<?php
    $domaine_client= str_replace("www.","",$_SERVER['HTTP_HOST']);
	$xml2=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_ticket.php?domaine_client='.$domaine_client.'&login='.get_option('sm_login').'&license_key='.get_option('sm_license_key').'&action=suggestion_liste&wplang='.WPLANG.'','item',array('id','suggestion','vote','date','pseudo','statut'));
    $tableau_ticket="";
        if($xml2!='') {
        foreach($xml2 as $row) {
    $tableau_ticket .= '
<table class="widefat">
<tr>
<td>'.__("Suggerer par","e-mailing-service").' '.$row[4].' '.__("le","e-mailing-service").' '.$row[3].'</td>
<td></td>
<td>
'.$row[2].' '.__('votes','e-mailing-service').'</td>
</tr>
<tr>
  <td colspan="3">'.$row[1].'<br><br></td>
</tr>
<tr>
<td>'.__("Statut","e-mailing-service").' : '.$row[5].'</td>
<td></td>
<td>
<form action="?page=e-mailing-service/admin/support.php&section=suggestion" method="post">
<input type="hidden" name="action" value="suggestion_vote" />
<input type="hidden" name="suggestion_id" value="'.$row[0].'" />
<input type="hidden" name="email" value="'.get_option('email_admin').'" />
<input name="submit" value="'.__('Voter +1','e-mailing-service').'" type="submit" /></td>
</tr>
</table><br>';
    }
    }
$tableau_ticket .= '</tbody></table>';			
echo $tableau_ticket ;
}
?>
<?php } ?>

