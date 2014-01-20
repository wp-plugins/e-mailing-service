<?php 
if(!isset($SMINCLUDEOK)){
include(smPATH . '/include/fonctions_sm.php');
}

if(!function_exists('sm_dashboard_widgets')){
function sm_dashboard_widgets() {
	if ( current_user_can('update_core') ){
	if(get_option('sm_license')=="free" || !get_option('sm_license_key')){
wp_add_dashboard_widget('sm_dashboard_widget1', ''.__('Emailing service','e-mailing-service').' '.__('Status SMTP','e-mailing-service').'', 'sm_widget_dashboardt');
wp_add_dashboard_widget('sm_dashboard_widget3', ''.__('Emailing service','e-mailing-service').' '.__('E-mailing en cours','e-mailing-service').'', 'dashboard_widget_sm_stats_live');
wp_add_dashboard_widget('sm_dashboard_widget5', ''.__('Emailing service','e-mailing-service').' '.__('FAQ','e-mailing-service').'', 'dashboard_widget_sm_faq');
	} else {
wp_add_dashboard_widget('sm_dashboard_widget1', ''.__('Emailing service','e-mailing-service').' '.__('Status SMTP','e-mailing-service').'', 'sm_widget_dashboardt');
wp_add_dashboard_widget('sm_dashboard_widget2', ''.__('Emailing service','e-mailing-service').' '.__('Statistiques SMTP','e-mailing-service').'', 'dashboard_widget_sm_stats_smtp');
wp_add_dashboard_widget('sm_dashboard_widget3', ''.__('Emailing service','e-mailing-service').' '.__('E-mailing en cours','e-mailing-service').'', 'dashboard_widget_sm_stats_live');
wp_add_dashboard_widget('sm_dashboard_widget4', ''.__('Emailing service','e-mailing-service').' '.__('Statistiques des clics','e-mailing-service').'', 'dashboard_widget_sm_stats_clic');
wp_add_dashboard_widget('sm_dashboard_widget5', ''.__('Emailing service','e-mailing-service').' '.__('FAQ','e-mailing-service').'', 'dashboard_widget_sm_faq');		
	}
    }
}
}
add_action('wp_dashboard_setup', 'sm_dashboard_widgets');



//dashboard fonction 1
if(!function_exists('sm_widget_dashboardt')){
function sm_widget_dashboardt() {
    $tbaleau_insert = '<table class="widefat">
                         <thead>';
    $tbaleau_insert .= "<tr>";
	$tbaleau_insert .= "<td><blockquote>".__('SMTP','e-mailing-service')."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('IP','e-mailing-service')."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Spamscore','e-mailing-service')."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Blacklist','e-mailing-service')."</blockquote></td>";
   $tbaleau_insert .= '</tr>           
        </thead>
        <tbody>';
	if(get_option('sm_license') =="api_mass-mailing" || get_option('sm_license')  =="mass-mailing"){
	for($num=1;$num<get_option('sm_multi_nb');$num++)
	{
    $tbaleau_insert .= "<tr>
	<td><blockquote>".get_option('sm_serveur_'.$num.'')."</blockquote></td>
	<td><blockquote>".gethostbyname(get_option('sm_smtp_server_'.$num.''))."</blockquote></td>
	<td><blockquote>".sm_spamscore(get_option('sm_smtp_server_'.$num.''))."</blockquote></td>
	<td><blockquote>".sm_blacklist(gethostbyname(get_option('sm_smtp_server_'.$num.'')))."</blockquote></td>";
    $tbaleau_insert .= '</tr>';
	}
	}
	else 
	{
    $tbaleau_insert .= "<tr>
	<td><blockquote>".get_option('sm_serveur')."</blockquote></td>
	<td><blockquote>".gethostbyname(get_option('sm_smtp_server'))."</blockquote></td>
	<td><blockquote>".sm_spamscore(get_option('sm_smtp_server'))."</blockquote></td>
	<td><blockquote>".sm_blacklist(gethostbyname(get_option('sm_smtp_server')))."</blockquote></td>";
    $tbaleau_insert .= '</tr>';	
	}
$tbaleau_insert .= '</tbody></table>';
echo $tbaleau_insert ;
}
}
//fonction 2
if(!function_exists('dashboard_widget_sm_stats_smtp')){
function dashboard_widget_sm_stats_smtp() {
$host=str_replace("http://","",$_SERVER['HTTP_HOST']);
$host=str_replace("www.","",$host);
echo '<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_smtp.php?domaine_client='.$host.'&login='.get_option('sm_login').'&key='.get_option('sm_license_key').'&action=tous" width="450" height="450" alt="" />';
}
}
if(!function_exists('dashboard_widget_sm_stats_live')){
function dashboard_widget_sm_stats_live() {
//include(smPATH . '/include/fonctions_sm.php');
global $wpdb;
$table_envoi= $wpdb->prefix.'sm_historique_envoi';
$tbaleau_insert ='<table class="widefat">
                         <thead><tr>';
$tbaleau_insert .="<td><blockquote>".__("N ",'e-mailing-service')."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".__('Status','e-mailing-service')."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".__('Nb envoyes','e-mailing-service')."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".__('Nb en attente','e-mailing-service')."</blockquote></td>";
$tbaleau_insert .="</tr></thead><tdboy>";
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_envoi."` ORDER BY id DESC LIMIT 0,5");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$tbaleau_insert .="<tr><td><blockquote>".$fivesdraft->id."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->status."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".nb_envoi_in($fivesdraft->id)."</blockquote></td>";	
$tbaleau_insert .="<td><blockquote>".nbattente($fivesdraft->id)."</blockquote></td>";
$tbaleau_insert .="</tr>";	
}
$tbaleau_insert .="</tdboy></table>";
echo $tbaleau_insert;
}
}
if(!function_exists('dashboard_widget_sm_stats_clic')){
function dashboard_widget_sm_stats_clic() {
$host=str_replace("http://","",$_SERVER['HTTP_HOST']);
$host=str_replace("www.","",$host);
global $wpdb;
echo '<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_clic.php?domaine_client='.$host.'&login='.get_option('sm_login').'&key='.get_option('sm_license_key').'&action=tous" width="450" height="450" alt="" />';
}
}
if(!function_exists('dashboard_widget_sm_faq')){
function dashboard_widget_sm_faq() {
global $wp;
    $domaine_client= str_replace("www.","",$_SERVER['HTTP_HOST']);
	$xml2=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_ticket.php?action=faq_liste&wplang='.WPLANG.'','item',array('id','message','date','pseudo'));
    $tableau_ticket="";
    $tableau_ticket .= '<table class="widefat">';
        if($xml2!='') {
        foreach($xml2 as $row) {
    $tableau_ticket .= "<tr>
	<td><blockquote><a href='admin.php?page=e-mailing-service/admin/support.php&section=faq&action=faq_lire&id=".$row[0]."'>".$row[1]."</a></blockquote></td>
	"; 
    $tableau_ticket .= '</tr>';
    }
    }
$tableau_ticket .= '</table>';			
echo $tableau_ticket ;
}	
}
?>
