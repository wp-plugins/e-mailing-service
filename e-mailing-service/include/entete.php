<?php
if(!function_exists('wp_get_current_user')) {
    include(ABSPATH . "wp-includes/pluggable.php"); 
}

if ( !function_exists( 'is_plugin_active_for_network' ) ) {
	require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

if ( is_plugin_active_for_network(plugin_basename(__FILE__)) ) {
	deactivate_plugins( plugin_basename(__FILE__) );
	$exit_msg = __('E-mailing service est deja installe', 'e-mailing-service');
	exit($exit_msg);
}
function replace_footer_admin ()
{
return '';
}

add_filter('admin_footer_text', 'replace_footer_admin');
function change_footer_version() {
return '';
}
add_filter( 'update_footer', 'change_footer_version', 9999 );
function fb_move_admin_bar() {
echo '';
}
add_action( 'admin_head', 'fb_move_admin_bar' );
add_action( 'wp_head', 'fb_move_admin_bar' );

$host=str_replace("www.","",$_SERVER['HTTP_HOST']);

if(!isset($SMINCLUDEOK)){
include(smPATH . '/include/fonctions_sm.php');
}
global $wpdb;
$table_options= $wpdb->prefix.'options';
$table_envoi= $wpdb->prefix.'sm_historique_envoi';
$table_posts= $wpdb->prefix.'posts';
$table_liste= $wpdb->prefix.'sm_liste';
$table_temps= $wpdb->prefix.'sm_temps';
$table_suite= $wpdb->prefix.'sm_suite';
$table_log= $wpdb->prefix.'sm_log';
$table_log_bounces= $wpdb->prefix.'sm_bounces_log';
$table_bounces_hard= $wpdb->prefix.'sm_bounces_hard';
$table_stats_smtp = $wpdb->prefix.'sm_stats_smtp';
$table_blacklist= $wpdb->prefix.'sm_blacklist';
$table_spamscore = $wpdb->prefix.'sm_spamscore';

date_default_timezone_set('Europe/Paris');
?>
<table><tr><td width="132" height="42"><a href="http://www.e-mailing-service.net" target="_blank"><img src="<?php echo smURL;?>/include/email_edit2x150.png" width="75" height="42" border="0"/></a></td><td align="center" valign="top"><h2><?php _e('E-mailing service',"e-mailing-service");?> V<?php echo get_option('sm_version');?></h2></td> <?php if(!get_option('sm_license_key')|| get_option('sm_license') =="free") { echo '<td>&nbsp;&nbsp;&nbsp;</td><td style="background-image:url('.smURL.'/img/bouton.png); background-repeat:no-repeat; color=#000000" width="150" height="42" align="center" valign="center"><a href="?page=e-mailing-service/admin/configuration.php" target="_parent" title="'.__("Avec l'api Gratuite, vous obtenez des statistiques plus precises sans augmenter la charge de wordpress, les liens sont en reecriture, vous avez egalement des graphiques et les alertes de panne, details sur la page options et services",'e-mailing-service').'" class="sm_blanc">'.__("Activer l'api Gratuite",'e-mailing-service').'</a></td>'; } ?>
</tr></table>
<?php echo sm_cgi_annonce();?>
		