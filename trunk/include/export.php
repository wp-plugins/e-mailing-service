<?php
add_action('template_redirect','sm_export');
function sm_export(){
global $wpdb;
extract($_GET);

$table_options= $wpdb->prefix.'options';
$table_envoi= $wpdb->prefix.'sm_historique_envoi';
$table_posts= $wpdb->prefix.'posts';
$table_liste= $wpdb->prefix.'sm_liste';
$table_temps= $wpdb->prefix.'sm_temps';
$table_suite= $wpdb->prefix.'sm_suite';
$table_log= $wpdb->prefix.'sm_log';
$table_log_bounces= $wpdb->prefix.'sm_bounces_log';
$table_bounces_hard= $wpdb->prefix.'sm_bounces_hard';
$table_bounces_log= $wpdb->prefix.'sm_bounces_log';
$table_stats_smtp = $wpdb->prefix.'sm_stats_smtp';
$table_blacklist= $wpdb->prefix.'sm_blacklist';
$table_spamscore = $wpdb->prefix.'sm_spamscore';
$table_messageid=$wpdb->prefix.'sm_stats_messageid';

	if(isset($action) && $action == 'export'){
$user_login = $_SESSION["user_login"];
if(get_option('sm_license') == 'free' ||get_option('sm_license') == 'api-free'){
echo __('Vous ne disposez pas de la license pour pouvoir exporter les fichiers','e-mailing-service');
echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="3TNHDCQEV7TA8">
<input name="custom" type="hidden" value="'.get_option('sm_login').'|e-mailing-service.net" />
<input type="hidden" name="on1" value="Url du wordpress">
<input type="hidden" name="os1" maxlength="200" value="'.get_option('sm_domain').'">
<table>
<tr><td><input type="hidden" name="on0" value="Options">'.__("Options","e-mailing-service").'</td></tr><tr><td><select name="os0">
	<option value="API avec toutes les options">'.__("API avec toutes les options : 30.00 EUR - monthly","e-mailing-service").'</option>
	<option value="API + export csv">'.__("API + export csv : 20.00 EUR - monthly","e-mailing-service").'</option>
	<option value="API + NPAI">'.__("API + NPAI : 13.00 EUR - monthly","e-mailing-service").'</option>
	<option value="API + Blacklist">'.__("API + Blacklist : 12.00 EUR - monthly","e-mailing-service").'</option>
	<option value="API Sans Options">'.__("API Sans Options : 10.00 EUR - monthly","e-mailing-service").'</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="EUR">
<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>

';
exit();	
}

if($format=="xls_backup"){
$i=1;
$csv_output="";
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".DB_NAME."`.`$liste`");
foreach ( $fivesdrafts as $fivesdraft ) 
{
		  
	if($i==1){
	$csv_output .= "".__("email","e-mailing-service")."\t".__("nom","e-mailing-service")."\t".__("IP","e-mailing-service")."\t".__("Langue","e-mailing-service")."\t".__("Valide","e-mailing-service")."\t".__("Bounces","e-mailing-service")."\t".__("OPT-IN","e-mailing-service")."\t".__("champs1","e-mailing-service")."\t".__("champs2","e-mailing-service")."\t".__("champs3","e-mailing-service")."\t".__("champs4","e-mailing-service")."\t".__("champs5","e-mailing-service")."\t".__("champs6","e-mailing-service")."\t".__("champs7","e-mailing-service")."\t".__("champs8","e-mailing-service")."\t".__("champs9","e-mailing-service")."\n";
	}	
	$csv_output .= "".$fivesdraft->email."\t".$fivesdraft->nom."\t".$fivesdraft->ip."\t".$fivesdraft->lg."\t".$fivesdraft->valide."\t".$fivesdraft->bounces."\t".$fivesdraft->optin."\t".$fivesdraft->champs1."\t".$fivesdraft->champs2."\t".$fivesdraft->champs3."\t".$fivesdraft->champs4."\t".$fivesdraft->champs5."\t".$fivesdraft->champs6."\t".$fivesdraft->champs7."\t".$fivesdraft->champs8."\t".$fivesdraft->champs9."\n";	
	$i++;
	} 
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=".$liste.".xls");
header("Pragma: no-cache"); 
header("Expires: 0");  
print $csv_output;
exit;
}
elseif($format=="xls"){
$i=1;
$csv_output="";
$q6=mysql_query("SELECT * FROM `".DB_NAME."`.`$liste`") OR die("".mysql_error()."");
while ($r6 = mysql_fetch_array($q6))
{
		  
	if($i==1){
	$csv_output .= "".__("email","e-mailing-service")."\t".__("nom","e-mailing-service")."\t".__("IP","e-mailing-service")."\t".__("Langue","e-mailing-service")."\t".__("Valide","e-mailing-service")."\t".__("Bounces","e-mailing-service")."\t".__("OPT-IN","e-mailing-service")."\t".__("champs1","e-mailing-service")."\t".__("champs2","e-mailing-service")."\t".__("champs3","e-mailing-service")."\t".__("champs4","e-mailing-service")."\t".__("champs5","e-mailing-service")."\t".__("champs6","e-mailing-service")."\t".__("champs7","e-mailing-service")."\t".__("champs8","e-mailing-service")."\t".__("champs9","e-mailing-service")."\n";
	}	
	$csv_output .= "".$email."\t".$nom."\t".$ip."\t".$lg."\t".$valide."\t".$bounces."\t".$optin."\t".$champs1."\t".$champs2."\t".$champs3."\t".$champs4."\t".$champs5."\t".$champs6."\t".$champs7."\t".$champs8."\t".$champs9."\n";	
	$i++;
}
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=".$liste.".xls");
header("Pragma: no-cache"); 
header("Expires: 0");  
print $csv_output;
exit;
}
elseif($format=="csv_backup"){
$i=1;
$csv_output="";
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".DB_NAME."`.`$liste` LIMIT 90000");
foreach ( $fivesdrafts as $fivesdraft ) 
{
		  
	if($i==1){
	$csv_output .= "".__("email","e-mailing-service").";".__("nom","e-mailing-service").";".__("IP","e-mailing-service").";".__("Langue","e-mailing-service").";".__("Valide","e-mailing-service").";".__("Bounces","e-mailing-service").";".__("OPT-IN","e-mailing-service").";".__("champs1","e-mailing-service").";".__("champs2","e-mailing-service").";".__("champs3","e-mailing-service").";".__("champs4","e-mailing-service").";".__("champs5","e-mailing-service").";".__("champs6","e-mailing-service").";".__("champs7","e-mailing-service").";".__("champs8","e-mailing-service").";".__("champs9","e-mailing-service")."\n";
	}	
	$csv_output .= "".$fivesdraft->email.";".$fivesdraft->nom.";".$fivesdraft->ip.";".$fivesdraft->lg.";".$fivesdraft->valide.";".$fivesdraft->bounces.";".$fivesdraft->optin.";".$fivesdraft->champs1.";".$fivesdraft->champs2.";".$fivesdraft->champs3.";".$fivesdraft->champs4.";".$fivesdraft->champs5.";".$fivesdraft->champs6.";".$fivesdraft->champs7.";".$fivesdraft->champs8.";".$fivesdraft->champs9."\n";
	$i++;
	}
/*
header("Content-Type: application/csv"); 
header("Content-Disposition: attachment; filename=".$liste.".csv");
header("Pragma: no-cache"); 
header("Expires: 0");  
*/
print $csv_output;
exit;

}
elseif($format=="csv"){
$i=1;
$csv_output="";
$q6=mysql_query("SELECT * FROM `".DB_NAME."`.`$liste`") OR die("".mysql_error()."");
while ($r6 = mysql_fetch_array($q6))
{
  extract($r6);
	if($i==1){
	$csv_output .= "".__("email","e-mailing-service").";".__("nom","e-mailing-service").";".__("IP","e-mailing-service").";".__("Langue","e-mailing-service").";".__("Valide","e-mailing-service").";".__("Bounces","e-mailing-service").";".__("OPT-IN","e-mailing-service").";".__("champs1","e-mailing-service").";".__("champs2","e-mailing-service").";".__("champs3","e-mailing-service").";".__("champs4","e-mailing-service").";".__("champs5","e-mailing-service").";".__("champs6","e-mailing-service").";".__("champs7","e-mailing-service").";".__("champs8","e-mailing-service").";".__("champs9","e-mailing-service")."\n";
	}	
	$csv_output .= "".$email.";".$nom.";".$ip.";".$lg.";".$valide.";".$bounces.";".$optin.";".$champs1.";".$champs2.";".$champs3.";".$champs4.";".$champs5.";".$champs6.";".$champs7.";".$champs8.";".$champs9."\n";
	$i++;

}
header("Content-Type: application/csv");
header("Content-Disposition: attachment; filename=".$liste.".csv");
header("Pragma: no-cache"); 
header("Expires: 0");
print $csv_output;
exit;
}
elseif($format=="csv_open_total"){
$csv_output="";
$array =array (
		"site" => get_option('sm_domain'),
		"license_key" => get_option('sm_license_key'), 
		"login" => $user_login,
		"ip" => $_SERVER['REMOTE_ADDR'],
		"action" => "list_open_hie",
		"id" => $hie
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php',$array);
		$xml_open = post_xml_data($fluxl,'item',array('resultat','id','email','date','track1','track2','pays'));
		//echo '<textarea name="bug" cols="150" rows="10">'.$fluxl.'</textarea>';
		if($xml_open !=''){
		foreach($xml_open as $rang) {
			if($rang[0] == 1){
$csv_output .= "".$rang[2].";".$rang[3].";".$rang[4].";".$rang[5].";".$rang[6].";\n";
                             }
		}
		}
header("Content-Type: application/csv");
header("Content-Disposition: attachment; filename=".$hie.".csv");
header("Pragma: no-cache"); 
header("Expires: 0");
print $csv_output;
exit;

	
}
elseif($format=="csv_open_email"){
$csv_output="";
$array =array (
		"site" => get_option('sm_domain'),
		"license_key" => get_option('sm_license_key'), 
		"login" => $user_login,
		"ip" => $_SERVER['REMOTE_ADDR'],
		"action" => "list_open_hie",
		"id" => $hie
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php',$array);
		$xml_open = post_xml_data($fluxl,'item',array('resultat','id','email','date','track1','track2','pays'));
		//echo '<textarea name="bug" cols="150" rows="10">'.$fluxl.'</textarea>';
		if($xml_open !=''){
		foreach($xml_open as $rang) {
			if($rang[0] == 1){
$csv_output .= "".$rang[2].";\n";
                             }
		}
		}
header("Content-Type: application/csv");
header("Content-Disposition: attachment; filename=".$hie.".csv");
header("Pragma: no-cache"); 
header("Expires: 0");
print $csv_output;
exit;

	
}
elseif($format=="xls_open_total"){
$csv_output="";
$array =array (
		"site" => get_option('sm_domain'),
		"license_key" => get_option('sm_license_key'), 
		"login" => $user_login,
		"ip" => $_SERVER['REMOTE_ADDR'],
		"action" => "list_open_hie",
		"id" => $hie
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php',$array);
		$xml_open = post_xml_data($fluxl,'item',array('resultat','id','email','date','track1','track2','pays'));
		//echo '<textarea name="bug" cols="150" rows="10">'.$fluxl.'</textarea>';
		if($xml_open !=''){
		foreach($xml_open as $rang) {
			if($rang[0] == 1){
$csv_output .= "".$rang[2]."\t".$rang[3]."\t".$rang[4]."\t".$rang[5]."\t".$rang[6]."\t\n";
                             }
		}
		}
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=".$hie.".xls");
header("Pragma: no-cache"); 
header("Expires: 0");  
print $csv_output;
exit;

	
}
elseif($format=="xls_open_email"){
$csv_output="";
$array =array (
		"site" => get_option('sm_domain'),
		"license_key" => get_option('sm_license_key'), 
		"login" => $user_login,
		"ip" => $_SERVER['REMOTE_ADDR'],
		"action" => "list_open_hie",
		"id" => $hie
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php',$array);
		$xml_open = post_xml_data($fluxl,'item',array('resultat','id','email','date','track1','track2','pays'));
		//echo '<textarea name="bug" cols="150" rows="10">'.$fluxl.'</textarea>';
		if($xml_open !=''){
		foreach($xml_open as $rang) {
			if($rang[0] == 1){
$csv_output .= "".$rang[2]."\t\n";
                             }
		}
		}
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=".$hie.".xls");
header("Pragma: no-cache"); 
header("Expires: 0");  
print $csv_output;
exit;

	
}
elseif($format=="csv_link_total"){
$csv_output="";
$array =array (
		"site" => get_option('sm_domain'),
		"license_key" => get_option('sm_license_key'), 
		"login" => $user_login,
		"ip" => $_SERVER['REMOTE_ADDR'],
		"action" => "list_link_hie",
		"id" => $hie
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php',$array);
		$xml_open = post_xml_data($fluxl,'item',array('resultat','id','email','date','link'));
		//echo '<textarea name="bug" cols="150" rows="10">'.$fluxl.'</textarea>';
		if($xml_open !=''){
		foreach($xml_open as $rang) {
			if($rang[0] == 1){
$csv_output .= "".$rang[2].";".$rang[3].";".$rang[4].";\n";
                             }
		}
		}
header("Content-Type: application/csv");
header("Content-Disposition: attachment; filename=".$hie.".csv");
header("Pragma: no-cache"); 
header("Expires: 0");
print $csv_output;
exit;

	
}
elseif($format=="csv_link_email"){
$csv_output="";
$array =array (
		"site" => get_option('sm_domain'),
		"license_key" => get_option('sm_license_key'), 
		"login" => $user_login,
		"ip" => $_SERVER['REMOTE_ADDR'],
		"action" => "list_link_hie",
		"id" => $hie
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php',$array);
		$xml_open = post_xml_data($fluxl,'item',array('resultat','id','email','date','link'));
		//echo '<textarea name="bug" cols="150" rows="10">'.$fluxl.'</textarea>';
		if($xml_open !=''){
		foreach($xml_open as $rang) {
			if($rang[0] == 1){
$csv_output .= "".$rang[2].";\n";
                             }
		}
		}
header("Content-Type: application/csv");
header("Content-Disposition: attachment; filename=".$hie.".csv");
header("Pragma: no-cache"); 
header("Expires: 0");
print $csv_output;
exit;

	
}
elseif($format=="xls_link_total"){
$csv_output="";
$array =array (
		"site" => get_option('sm_domain'),
		"license_key" => get_option('sm_license_key'), 
		"login" => $user_login,
		"ip" => $_SERVER['REMOTE_ADDR'],
		"action" => "list_link_hie",
		"id" => $hie
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php',$array);
		$xml_open = post_xml_data($fluxl,'item',array('resultat','id','email','date','link'));
		//echo '<textarea name="bug" cols="150" rows="10">'.$fluxl.'</textarea>';
		if($xml_open !=''){
		foreach($xml_open as $rang) {
			if($rang[0] == 1){
$csv_output .= "".$rang[2]."\t".$rang[3]."\t".$rang[4]."\t\n";
                             }
		}
		}
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=".$hie.".xls");
header("Pragma: no-cache"); 
header("Expires: 0");  
print $csv_output;
exit;

	
}
elseif($format=="xls_link_email"){
$csv_output="";
$array =array (
		"site" => get_option('sm_domain'),
		"license_key" => get_option('sm_license_key'), 
		"login" => $user_login,
		"ip" => $_SERVER['REMOTE_ADDR'],
		"action" => "list_link_hie",
		"id" => $hie
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php',$array);
		$xml_open = post_xml_data($fluxl,'item',array('resultat','id','email','date','link'));
		//echo '<textarea name="bug" cols="150" rows="10">'.$fluxl.'</textarea>';
		if($xml_open !=''){
		foreach($xml_open as $rang) {
			if($rang[0] == 1){
$csv_output .= "".$rang[2]."\t\n";
                             }
		}
		}
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=".$hie.".xls");
header("Pragma: no-cache"); 
header("Expires: 0");  
print $csv_output;
exit;

	
}
elseif($format=="csv_hard_bounces"){
$i=1;
$csv_output="";
$q6=mysql_query("SELECT * FROM `".$table_bounces_log."` WHERE hie='".$hie."' AND bounce_type ='hard' ORDER BY id DESC") OR die("".mysql_error()."");
while ($r6 = mysql_fetch_array($q6))
{
  extract($r6);
	if($i==1){
	$csv_output .= "".__("email","e-mailing-service").";\n";
	}	
	$csv_output .= "".$email.";\n";
	$i++;

}
header("Content-Type: application/csv");
header("Content-Disposition: attachment; filename=".$hie.".csv");
header("Pragma: no-cache"); 
header("Expires: 0");
print $csv_output;
exit;
}
elseif($format=="csv_soft_bounces"){
$i=1;
$csv_output="";
$q6=mysql_query("SELECT * FROM `".$table_bounces_log."` WHERE hie='".$hie."' AND bounce_type ='soft' ORDER BY id DESC") OR die("".mysql_error()."");
while ($r6 = mysql_fetch_array($q6))
{
  extract($r6);
	if($i==1){
	$csv_output .= "".__("email","e-mailing-service").";\n";
	}	
	$csv_output .= "".$email.";\n";
	$i++;

}
header("Content-Type: application/csv");
header("Content-Disposition: attachment; filename=".$hie.".csv");
header("Pragma: no-cache"); 
header("Expires: 0");
print $csv_output;
exit;
}
elseif($format=="xls_hard_bounces"){
$i=1;
$csv_output="";
$q6=mysql_query("SELECT * FROM `".$table_bounces_log."` WHERE hie='".$hie."' AND bounce_type ='hard' ORDER BY id DESC") OR die("".mysql_error()."");
while ($r6 = mysql_fetch_array($q6))
{
  extract($r6);
	if($i==1){
	$csv_output .= "".__("email","e-mailing-service").";\n";
	}	
	$csv_output .= "".$email."\t\n";
	$i++;

}
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=".$hie.".xls");
header("Pragma: no-cache"); 
header("Expires: 0");
print $csv_output;
exit;
}
elseif($format=="xls_soft_bounces"){
$i=1;
$csv_output="";
$q6=mysql_query("SELECT * FROM `".$table_bounces_log."` WHERE hie='".$hie."' AND bounce_type ='soft' ORDER BY id DESC") OR die("".mysql_error()."");
while ($r6 = mysql_fetch_array($q6))
{
  extract($r6);
	if($i==1){
	$csv_output .= "".__("email","e-mailing-service").";\n";
	}	
	$csv_output .= "".$email."\t\n";
	$i++;

}
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=".$hie.".xls");
header("Pragma: no-cache"); 
header("Expires: 0");
print $csv_output;
exit;
}
elseif($format=="csv_unsuscribe"){
$i=1;
$csv_output="";
$array =array (
		"site" => get_option('sm_domain'),
		"license_key" => get_option('sm_license_key'), 
		"login" => $user_login,
		"ip" => $_SERVER['REMOTE_ADDR'],
		"action" => "list_link_hie",
		"id" => $hie
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php',$array);
		$xml_open = post_xml_data($fluxl,'item',array('resultat','id','email','date','track1','track2','pays'));
		//echo '<textarea name="bug" cols="150" rows="10">'.$fluxl.'</textarea>';
		if($xml_open !=''){
		foreach($xml_open as $rang) {
			if($rang[0] == 1){
$csv_output .= "".$rang[2].";\n";
                             }
		}
		}
header("Content-Type: application/csv");
header("Content-Disposition: attachment; filename=".$hie.".csv");
header("Pragma: no-cache"); 
header("Expires: 0");
print $csv_output;
exit;
}
elseif($format=="xls_unsuscribes"){
$i=1;
$csv_output="";
$array =array (
		"site" => get_option('sm_domain'),
		"license_key" => get_option('sm_license_key'), 
		"login" => $user_login,
		"ip" => $_SERVER['REMOTE_ADDR'],
		"action" => "list_link_hie",
		"id" => $hie
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php',$array);
		$xml_open = post_xml_data($fluxl,'item',array('resultat','id','email','date','track1','track2','pays'));
		//echo '<textarea name="bug" cols="150" rows="10">'.$fluxl.'</textarea>';
		if($xml_open !=''){
		foreach($xml_open as $rang) {
			if($rang[0] == 1){
$csv_output .= "".$rang[2]."\t\n";
                             }
		}
		}
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=".$hie.".xls");
header("Pragma: no-cache"); 
header("Expires: 0");
print $csv_output;
exit;
}
 else {
_e("Le format n'est pas corret","e-mailing-service");	
}
exit();
}
}
?>