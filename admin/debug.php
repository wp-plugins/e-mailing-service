<div id="wrapper">
        <header id="page-header">
             <div class="wrapper">
               <?php 
if ( is_plugin_active( 'admin-hosting/admin-hosting.php' ) ) {
	include(AH_PATH . '/include/entete.php');
} else {
	include(smPATH . '/include/entete.php');
}?>
                          <div id="main-nav">
                    <ul class="clearfix">    
                    <?php
if(!isset($_GET['section'])){
$active_page='smtp';
}	else {
$active_page=$_GET['section'];	
}
					?>        
<li <?php if($active_page=="smtp"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/debug.php"><?php _e('Tester le serveur SMTP','admin-hosting');?></a></li>
<li <?php if($active_page=="upload"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/debug.php&section=upload"><?php _e("Verifier le dossier Upload",'admin-hosting');?></a></li>
<li <?php if($active_page=="vitesse"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/debug.php&section=vitesse"><?php _e("Verifier la vitesse d'envoi",'admin-hosting');?></a></li>
<li <?php if($active_page=="envoi_article"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/debug.php&section=envoi_article"><?php _e("Envoyer les articles",'admin-hosting');?></a></li>
<li <?php if($active_page=="envoi_newsletter"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/debug.php&section=envoi_newsletter"><?php _e("Envoyer la newsletter",'admin-hosting');?></a></li>
<li <?php if($active_page=="crontab_stats"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/debug.php&section=crontab_stats"><?php _e("Statistics",'admin-hosting');?></a></li>
<li <?php if($active_page=="crontab_user_wordpress"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/debug.php&section=crontab_user_wordpress"><?php _e("User",'admin-hosting');?></a></li>

<li <?php if($active_page=="crontab_blacklist"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/debug.php&section=crontab_blacklist"><?php _e("Blacklist",'admin-hosting');?></a></li>
<li <?php if($active_page=="crontab_bounces"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/debug.php&section=crontab_bounces"><?php _e("Bounces",'admin-hosting');?></a></li>
<li <?php if($active_page=="crontab_bounces_update"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/debug.php&section=crontab_bounces_update"><?php _e("Bounces update",'admin-hosting');?></a></li>
<li <?php if($active_page=="crontab_bounces_list"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/debug.php&section=crontab_bounces_list"><?php _e("Update list",'admin-hosting');?></a></li>
<li <?php if($active_page=="crontab_bounces_delete"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/debug.php&section=crontab_bounces_delete"><?php _e("Bounces delete",'admin-hosting');?></a></li>
                    </ul>
 </div>
             </div>
             

             <div id="page-subheader">
                <div class="wrapper">
 <h2>
<?php _e("Debug","e-mailing-service");?>

 </h2>
              <!--  <input placeholder="Search..." type="text" name="q" value="" />-->
                </div>
         </div>
        </header>
</div>
           
                 <section id="content">
            <div class="wrapper">                                     
                                

        <?php 
		if($active_page == 'upload'){
		echo "<p>".__("Verifier le dossier upload pour les images","e-mailing-service")."</p>";
		}
		elseif($active_page == 'vitesse'){
		echo "<p>".__("Verifiez la vitesse de votre wordpress","e-mailing-service")."</p>";
		}
				elseif($active_page == 'envoi_article'){
		echo "<p>".__("Lancer le cron d'envoi de la newsletter manuellement, permet de suivre les envois en direct","e-mailing-service")."</p>";
		}
				elseif($active_page == 'envoi_newsletter'){
		echo "<p>".__("Lancer le cron d'envoi de la newsletter manuellement, permet de suivre les envois en direct","e-mailing-service")."</p>";
		}
		elseif($active_page == 'crontab_blacklist'){
		echo "<p>".__("Start cron that updates blacklists","e-mailing-service")."</p>";
		}
				elseif($active_page == 'crontab_bounces'){
		echo "<p>".__("Start cron import bounces","e-mailing-service")."</p>";
		}
				elseif($active_page == 'crontab_bounces_update'){
		echo "<p>".__("Start cron update Hard Bounces","e-mailing-service")."</p>";
		}
				elseif($active_page == 'crontab_bounces_list'){
		echo "<p>".__("Start cron update contact list","e-mailing-service")."</p>";
		}
						elseif($active_page == 'crontab_bounces_delete'){
		echo "<p>".__("Start cron delete bounces","e-mailing-service")."</p>";
		}
								elseif($active_page == 'crontab_stats'){
		echo "<p>".__("Start cron update statistics","e-mailing-service")."</p>";
		}
			elseif($active_page == 'crontab_user_wordpress'){
		echo "<p>".__("Start cron update user wordpress in the contact list wordpress_user","e-mailing-service")."</p>";
		}
		else {
		echo "<p>".__("Verifiez votre serveur SMTP","e-mailing-service")."</p>";				
		}
		?>
        
                    
                    <hr />

   <?php

	
		if ($active_page == 'upload') include(smPATH.'include/upload.php');
		elseif ($active_page == 'envoi_article') { sm_send_article(); }
		elseif ($active_page == 'envoi_newsletter') {  sm_send_newsletter();}
		elseif ($active_page == 'vitesse') {  sm_cron_blocage();}
		elseif ($active_page == 'crontab_blacklist') {  sm_cron_blacklist();}
		elseif ($active_page == 'crontab_bounces_update') {  sm_cron_bounce_update();}
		elseif ($active_page == 'crontab_bounces_list') {  sm_cron_bounce_update_liste();}
		elseif ($active_page == 'crontab_bounces') {  sm_cron_bounce();}
		elseif ($active_page == 'crontab_bounces_delete') {  sm_cron_bounces_delete(); }
		elseif ($active_page == 'crontab_stats') {  sm_cron_stats();}
		elseif ($active_page == 'crontab_license') {  sm_cron_license();}
		elseif ($active_page == 'crontab_user_wordpress') {  sm_userwordpress_update();}
        else {
	
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
	}
	else {
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
  
	$num=1;
    $tbaleau_insert .= "<tr>
    <td><blockquote>".get_option('sm_smtp_server_'.$num.'')."</blockquote></td>
	<td><blockquote>".gethostbyname(get_option('sm_smtp_server_'.$num.''))."</blockquote></td>
	<td><blockquote><a href=\"?page=e-mailing-service/admin/etat.php&action=tester&num=".$num."\" target=\"_blank\">".__('Tester le serveur','e-mailing-service')."</a></blockquote></td>
	<td><blockquote>".sm_getStatus(get_option('sm_smtp_server_'.$num.''),"25")."</blockquote></td>
	<td><blockquote>".sm_getStatus(get_option('sm_smtp_server_'.$num.''),"587")."</blockquote></td>
	<td><blockquote>".sm_getStatus(get_option('sm_smtp_server_'.$num.''),"80")."</blockquote></td>
	<td><blockquote>".sm_getStatus(get_option('sm_smtp_server_'.$num.''),"53")."</blockquote></td>
	<td><blockquote>".sm_spamscore(get_option('sm_smtp_server_'.$num.''))."</blockquote></td>
	<td><blockquote>".sm_blacklist(gethostbyname(get_option('sm_smtp_server_'.$num.'')))."</blockquote></td>
	<td><blockquote><span class=\"sm_table_vert\">&nbsp;&nbsp;".__("Actif","e-mailing-service")."&nbsp;&nbsp;</span></blockquote></td></tr>";
$tbaleau_insert .= '</tbody></table>';
	echo $tbaleau_insert ;
	}
		}
   
   ?>
</div>
