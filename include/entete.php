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




date_default_timezone_set('Europe/Paris');


 

$host=str_replace("www.","",$_SERVER['HTTP_HOST']);
$host=str_replace("www.","",$_SERVER['HTTP_HOST']);
$current_user = wp_get_current_user();
$user_login=$current_user->user_login;
$user_id=$current_user->ID;
$user_email=$current_user->email;
$user_info = get_userdata($current_user->ID);
$user_role =implode(', ', $user_info->roles);
$_SESSION["user_login"] = $user_login;
$_SESSION["user_id"] = $user_id;

 
if(!get_option('ah_company_marque')){
echo '<table><tr><td width="132" height="42"><a href="http://www.e-mailing-service.net" target="_blank"><img src="'.smURL.'/include/email_edit2x150.png" width="75" height="42" border="0"/></a></td><td align="center" valign="top"><h2>'.__('E-mailing service',"e-mailing-service").' V'.get_option('sm_version').'</h2></td>
';
if (is_super_admin()) {
if(!get_option('sm_license_key')|| get_option('sm_license') =="free") { echo '<td>&nbsp;&nbsp;&nbsp;</td><td style="background-image:url('.smURL.'/img/bouton.png); background-repeat:no-repeat; color=#000000" width="150" height="42" align="center" valign="center"><a href="?page=e-mailing-service/admin/configuration.php" target="_parent" title="'.__("Avec l'api Gratuite, vous obtenez des statistiques plus precises sans augmenter la charge de wordpress, les liens sont en reecriture, vous avez egalement des graphiques et les alertes de panne, details sur la page options et services",'e-mailing-service').'" class="sm_blanc">'.__("Activer l'api Gratuite",'e-mailing-service').'</a></td>'; }
}
echo '</tr></table>';	
} else {
if(get_option('ah_logo') != ''){ 
echo '<div class="right"><img src="'.get_option('ah_logo').'" height="35" border="0"/></div>';}
echo '<h1>'.get_option('ah_company_marque').'</h1>';
}
?>
<?php echo sm_cgi_annonce();?>
		