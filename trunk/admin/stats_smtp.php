<?php 
include(smPATH . '/include/entete.php');
	    $host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);

if(get_option('sm_license')  == 'mass-mailing' || get_option('sm_license') == 'api_mass-mailing' ){
if( get_option('sm_multi_nb') ) {
for($i=1;$i<get_option('sm_multi_nb')+1;$i++){
echo "<h1>".__("Statistiques SMTP du serveur")." ".get_option('sm_smtp_server_'.$i.'')."</h1>";
?>
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_smtp.php?smtp=<?php echo get_option('sm_smtp_server_'.$i.'');?>&domaine_client=<?php echo $host;?>&login=<?php echo get_option('sm_login');?>&key=<?php echo get_option('sm_license_key');?>" width="450" height="450" alt="" />
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_smtp.php?smtp=<?php echo get_option('sm_smtp_server_'.$i.'');?>&domaine_client=<?php echo $host;?>&date=<?php echo date('Y-m-d', strtotime("-1 day"));?>&login=<?php echo get_option('sm_login');?>&key=<?php echo get_option('sm_license_key');?>" width="450" height="450" alt="" />
<br />
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_smtp.php?smtp=<?php echo get_option('sm_smtp_server_'.$i.'');?>&domaine_client=<?php echo $host;?>&action=mois&login=<?php echo get_option('sm_login');?>&key=<?php echo get_option('sm_license_key');?>" width="450" height="450" alt="" />
<?php		
}
} 
}  elseif(get_option('sm_license')  == "srv-smtp"){
?>
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_smtp.php?smtp=<?php echo get_option('sm_smtp_server');?>&domaine_client=<?php echo $host;?>&login=<?php echo get_option('sm_login');?>&key=<?php echo get_option('sm_license_key');?>" width="450" height="450" alt="" />
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_smtp.php?smtp=<?php echo get_option('sm_smtp_server');?>&domaine_client=<?php echo $host;?>&date=<?php echo date('Y-m-d', strtotime("-1 day"));?>&login=<?php echo get_option('sm_login');?>&key=<?php echo get_option('sm_license_key');?>" width="450" height="450" alt="" />
<br />
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_smtp.php?smtp=<?php echo get_option('sm_smtp_server');?>&domaine_client=<?php echo $host;?>&action=mois&login=<?php echo get_option('sm_login');?>&key=<?php echo get_option('sm_license_key');?>" width="450" height="450" alt="" />
<?php } else {

echo "<br><br>".__("Les statistiques SMTP du serveur sont disponibles seulement avec nos pack serveur SMTP","e-mailing-service")."";

}
?>