<?php
include("../../../../wp-config.php");
@mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("<br /> Excusez nous mais la connection est interrompue pour quelques instants.");
extract($_GET);
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
else {
_e("Le format n'est pas corret","e-mailing-service");	
}
?>