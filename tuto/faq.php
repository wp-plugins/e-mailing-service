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
<br />
<form action="?page=e-mailing-service/admin/support.php&section=faq&action=faq_lire&id=<?php echo $_GET["id"];?>" method="post">
<input type="hidden" name="action" value="faq_reponse" />
<input type="hidden" name="ticket_id" value="<?php echo $_GET["id"];?>" />
<table>
        <tbody>
<tr>
  <td><?php _e('Repondre',"e-mailing-service");?></td>
</tr>
<tr>
   <td><textarea name="reponse" cols="75" rows="10"></textarea>
    </td>
</tr>
<tr>
  <td><input name="submit" value="<?php _e('Repondre',"e-mailing-service");?>" type="submit" /></td>
</tr>
</tbody>
</table>
</form>
<?php	
} } else {
    $domaine_client= str_replace("www.","",$_SERVER['HTTP_HOST']);
	$xml2=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_ticket.php?domaine_client='.$domaine_client.'&login='.get_option('sm_login').'&license_key='.get_option('sm_license_key').'&action=faq_liste&wplang='.WPLANG.'','item',array('id','message','date','pseudo'));
    $tableau_ticket="";
    $tableau_ticket .= '<table class="paginate10 sortable full">
                         <thead>';
    $tableau_ticket .= "<tr>";
	$tableau_ticket .= "<th>".__('Question',"e-mailing-service")."</th>";
	$tableau_ticket .= "<th>".__('Date',"e-mailing-service")."</th>";
	$tableau_ticket .= "<th>".__('Auteur',"e-mailing-service")."</th>";
	$tableau_ticket .= "<th>".__('Lire',"e-mailing-service")."</th>";
    $tableau_ticket .= '</tr>           
        </thead>
        <tbody>';
        if($xml2!='') {
        foreach($xml2 as $row) {
    $tableau_ticket .= "<tr>
	<td><blockquote>".stripslashes($row[1])."</blockquote></td>
	<td><blockquote>".$row[2]."</blockquote></td>
	<td><blockquote>".$row[3]."</blockquote></td>
	<td><blockquote><a href='?page=e-mailing-service/admin/support.php&section=faq&action=faq_lire&id=".$row[0]."'>". __("Lire les reponses", "e-mailing-service")."</a></blockquote></td>
	"; 
    $tableau_ticket .= '</tr>';
    }
    }
$tableau_ticket .= '</tbody></table>';			
echo $tableau_ticket ;
}

?>


