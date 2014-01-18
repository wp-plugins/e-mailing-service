<?php
include(smPATH . '/include/entete.php');

echo "<h1>".__("Status serveur SMTP","e-mailing-service")."</h1>";
    $tbaleau_insert="";
    $tbaleau_insert .= '<table class="widefat">
                         <thead>';
    $tbaleau_insert .= "<tr>";
	$tbaleau_insert .= "<th><blockquote>".__('Serveur SMTP',"e-mailing-service")."</blockquote></th>";
	$tbaleau_insert .= "<th><blockquote>".__('IP',"e-mailing-service")."</blockquote></th>";
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


?>