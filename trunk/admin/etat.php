<?php
include(smPATH . '/include/entete.php');
extract($_POST);
extract($_GET);
if(!isset($action)){
$action="null";	
}
if($action == "send"){
	$header = sm_optimisation_fai($email,$title,$num,"text/plain");	
    $_SESSION['sm_choix'] =$num;
	add_action('phpmailer_init','sm_smtp_choix');	
	echo "<br>".__("Reponse","e-mailing-service")." :<br>";
	wp_mail( $email, $title, $contenu, $header, "");
	echo "##server : ".$num."<br>";
	print_r($_SESSION);
} 
elseif($action == "tester"){
echo "<h1>".__("Tester votre serveur SMTP","e-mailing-service")."</h1>";
echo '<form action="?page=e-mailing-service/admin/etat.php" method="post" target="_parent">
<input type="hidden" name="action" value="send" />
<input type="hidden" name="num" value="'.$_GET["num"].'" />';
echo '<table class="widefat">
                         ';
echo "
<tr><td><blockquote><b>".__("Email","e-mailing-service")."</b></blockquote></td><td><input name=\"email\" type=\"text\" value=\"". get_option('admin_email')."\" /></td></tr>
<tr><td><blockquote><b>".__("Sujet","e-mailing-service")."</b></blockquote></td><td><input name=\"title\" type=\"text\" value=\"".__("test smtp","e-mailing-service")."\" size=\"40\"/></td></tr>
<tr><td><blockquote><b>".__("Message","e-mailing-service")."</b></blockquote></td><td><textarea name=\"contenu\" cols=\"50\" rows=\"10\">".__("test ok ?","e-mailing-service")."</textarea></td></tr>
<tr><td></td><td><input name=\"envoyer\" type=\"submit\" value=\"".__("envoyer")."\"/></td></tr>
</table>
";	
	
} else {
echo "<h1>".__("Status serveur SMTP","e-mailing-service")."</h1>";
    $tbaleau_insert="";
    $tbaleau_insert .= '<table class="widefat">
                         <thead>';
    $tbaleau_insert .= "<tr>";
	$tbaleau_insert .= "<th><blockquote>".__('Serveur SMTP',"e-mailing-service")."</blockquote></th>";
	$tbaleau_insert .= "<th><blockquote>".__('IP',"e-mailing-service")."</blockquote></th>";
	$tbaleau_insert .= "<th><blockquote>".__('Tester',"e-mailing-service")."</blockquote></th>";
	$tbaleau_insert .= "<th><blockquote>".__('Port 25',"e-mailing-service")."</blockquote></th>";
	$tbaleau_insert .= "<th><blockquote>".__('Port 587',"e-mailing-service")."</blockquote></th>";
	$tbaleau_insert .= "<th><blockquote>".__('Port 80',"e-mailing-service")."</blockquote></th>";
	$tbaleau_insert .= "<th><blockquote>".__('Port 53',"e-mailing-service")."</blockquote></th>";
	$tbaleau_insert .= "<th><blockquote>".__('Spamscore',"e-mailing-service")."</blockquote></th>";
	$tbaleau_insert .= "<th><blockquote>".__('Blacklist',"e-mailing-service")."</blockquote></th>"; 
	$tbaleau_insert .= "<th><blockquote>".__('Status',"e-mailing-service")."</blockquote></th>"; 
    $tbaleau_insert .= '</tr>           
        </thead>
        <tbody>';
   if(get_option('sm_license') == 'mass-mailing' || get_option('sm_license') == 'api_mass-mailing' ){
   for($num=1;$num<get_option('sm_multi_nb')+1;$num++){
    $tbaleau_insert .= "<tr>
	<td><blockquote>".get_option('sm_smtp_server_'.$num.'')."</blockquote></td>
	<td><blockquote>".gethostbyname(get_option('sm_smtp_server_'.$num.''))."</blockquote></td>
	<td><blockquote><a href=\"?page=e-mailing-service/admin/etat.php&action=tester&num=".$num."\" target=\"_blank\">".__('Tester le serveur','e-mailing-service')."</a></blockquote></td>
	<td><blockquote>".sm_getStatus(get_option('sm_smtp_server_'.$num.''),"25")."</blockquote></td>
	<td><blockquote>".sm_getStatus(get_option('sm_smtp_server_'.$num.''),"587")."</blockquote></td>
	<td><blockquote>".sm_getStatus(get_option('sm_smtp_server_'.$num.''),"80")."</blockquote></td>
	<td><blockquote>".sm_getStatus(get_option('sm_smtp_server_'.$num.''),"53")."</blockquote></td>
	<td><blockquote>".sm_spamscore(get_option('sm_smtp_server_'.$num.''))."</blockquote></td>
	<td><blockquote>".sm_blacklist(gethostbyname(get_option('sm_smtp_server_'.$num.'')))."</blockquote></td>";
	if(get_option('sm_smtp_actif_'.$num.'') =="oui"){
	$tbaleau_insert .= "<td><blockquote><span class=\"sm_table_vert\">&nbsp;&nbsp;".__("Actif")."&nbsp;&nbsp;</span></blockquote></td>";
	} else {
	$tbaleau_insert .= "<td><blockquote><span class=\"sm_table_rouge\">&nbsp;&nbsp;".__("Inactif")."&nbsp;&nbsp;</span></blockquote></td>";	
	}
    $tbaleau_insert .= '</tr>';
    }
    } else {
    $tbaleau_insert .= "<tr>
	<td><blockquote>".get_option('sm_smtp_server')."</blockquote></td>
	<td><blockquote>".gethostbyname(get_option('sm_smtp_server'))."</blockquote></td>
	<td><blockquote>".sm_getStatus(get_option('sm_smtp_server'),"25")."</blockquote></td>
	<td><blockquote>".sm_getStatus(get_option('sm_smtp_server'),"587")."</blockquote></td>
	<td><blockquote>".sm_getStatus(get_option('sm_smtp_server'),"80")."</blockquote></td>
	<td><blockquote>".sm_getStatus(get_option('sm_smtp_server'),"53")."</blockquote></td>
	<td><blockquote>".sm_spamscore(get_option('sm_smtp_server'))."</blockquote></td>
	<td><blockquote>".sm_blacklist(gethostbyname(get_option('sm_smtp_server')))."</blockquote></td>
	<td><blockquote><span class=\"sm_table_vert\">&nbsp;&nbsp;".__("Actif")."&nbsp;&nbsp;</span></blockquote></td>";
    $tbaleau_insert .= '</tr>';	   
   }

$tbaleau_insert .= '</tbody></table>';
echo $tbaleau_insert ;

}
?>