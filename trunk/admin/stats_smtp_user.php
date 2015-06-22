<?php 
include(smPATH . '/include/entete.php');
	    $host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);

if(is_plugin_active('admin-hosting/admin-hosting.php')) {
$req_serveurs = $wpdb->get_results("SELECT serveur FROM `".AH_table_server_list."` WHERE login like '".$user_login."'");
foreach ( $req_serveurs as $req_serveur ) 
{
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".AH_table_server_ip."` WHERE serveur like '".$req_serveur->serveur."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
echo "<h1>".__("Statistiques SMTP du serveur")." ".$fivesdraft->smtp_server."</h1>";
?>
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_smtp_v2.php?smtp=<?php echo $fivesdraft->smtp_server;?>&domaine_client=<?php echo $host;?>&login=<?php echo $user_login;?>&key=<?php echo get_option('sm_license_key');?>" width="600" height="600" alt="" />
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_smtp_v2.php?smtp=<?php echo $fivesdraft->smtp_server;?>&domaine_client=<?php echo $host;?>&date=<?php echo date('Y-m-d', strtotime("-1 day"));?>&login=<?php echo $user_login;?>&key=<?php echo get_option('sm_license_key');?>" width="600" height="600" alt="" />
<br />
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_smtp_v2.php?smtp=<?php echo $fivesdraft->smtp_server;?>&domaine_client=<?php echo $host;?>&action=mois&login=<?php echo $user_login;?>&key=<?php echo get_option('sm_license_key');?>" width="600" height="600" alt="" />
<?php		
}
} 
} 
?>