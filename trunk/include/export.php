<?php
include("../../../../wp-config.php");
@mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("<br /> Excusez nous mais la connection est interrompue pour quelques instants.");
extract($_GET);
if($format=="xls"){
$i=1;
$csv_output="";
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".DB_NAME."`.`$liste`");
foreach ( $fivesdrafts as $fivesdraft ) 
{
		  
	if($i==1){
	$csv_output .= "".__("email","e-mailing-service")."\t".__("nom","e-mailing-service")."\t".__("IP","e-mailing-service")."\t".__("Langue","e-mailing-service")."\t".__("Valide","e-mailing-service")."\t".__("Bounces","e-mailing-service")."\t".__("champs1","e-mailing-service")."\t".__("champs2","e-mailing-service")."\t".__("champs3","e-mailing-service")."\t".__("champs4","e-mailing-service")."\t".__("champs5","e-mailing-service")."\t".__("champs6","e-mailing-service")."\t".__("champs7","e-mailing-service")."\t".__("champs8","e-mailing-service")."\t".__("champs9","e-mailing-service")."\n";
	}	
	$csv_output .= "".$fivesdraft->email."\t".$fivesdraft->nom."\t".$fivesdraft->ip."\t".$fivesdraft->lg."\t".$fivesdraft->champs1."\t".$fivesdraft->champs2."\t".$fivesdraft->champs3."\t".$fivesdraft->champs4."\t".$fivesdraft->champs5."\t".$fivesdraft->champs6."\t".$fivesdraft->champs7."\t".$fivesdraft->champs8."\t".$fivesdraft->champs9."\n";	
	$i++;
	} 
header("Content-Type: application/xls"); 
header("Content-Disposition: attachment; filename=".$liste.".xls");
header("Pragma: no-cache"); 
header("Expires: 0");  
print $csv_output;
exit;
} 
elseif($format=="csv"){
$i=1;
$csv_output="";
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".DB_NAME."`.`$liste`");
foreach ( $fivesdrafts as $fivesdraft ) 
{
		  
	if($i==1){
	$csv_output .= "".__("email","e-mailing-service").";".__("nom","e-mailing-service").";".__("IP","e-mailing-service").";".__("Langue","e-mailing-service").";".__("Valide","e-mailing-service").";".__("Bounces","e-mailing-service").";".__("champs1","e-mailing-service").";".__("champs2","e-mailing-service").";".__("champs3","e-mailing-service").";".__("champs4","e-mailing-service").";".__("champs5","e-mailing-service").";".__("champs6","e-mailing-service").";".__("champs7","e-mailing-service").";".__("champs8","e-mailing-service").";".__("champs9","e-mailing-service")."\n";
	}	
	$csv_output .= "".$fivesdraft->email.";".$fivesdraft->nom.";".$fivesdraft->ip.";".$fivesdraft->lg.";".$fivesdraft->champs1.";".$fivesdraft->champs2.";".$fivesdraft->champs3.";".$fivesdraft->champs4.";".$fivesdraft->champs5.";".$fivesdraft->champs6.";".$fivesdraft->champs7.";".$fivesdraft->champs8.";".$fivesdraft->champs9."\n";	
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