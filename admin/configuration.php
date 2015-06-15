 <div id="wrapper">
        <header id="page-header">
             <div class="wrapper">
<?php 
if ( is_plugin_active( 'admin-hosting/admin-hosting.php' ) ) {
	include(AH_PATH . '/include/entete.php');
} else {
	include(smPATH . '/include/entete.php');
}
extract($_POST);
extract($_GET);
?>
                </div>
        </header>
</div>
             <div id="page-subheader">
                <div class="wrapper">
 <h2>
<?php _e("License et options","e-mailing-service");?>
 </h2>
                </div>
         </div>
                 <section id="content">
            <div class="wrapper">                <section class="columns">                    

        <?php echo "<p>".__("Activer votre license pour profiter de toutes les options","e-mailing-service")."</p>";?>
                    
                    <hr />
                    
                    <div class="grid_8">
<?php
echo "<h1>".__("License et options","e-mailing-service")."</h1>";
if(isset($action)){
	if($action =="update"){	
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".nettoie($sm_login)."' WHERE `option_name`='sm_login'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_license_key' WHERE `option_name`='sm_license_key'");
_e("Vos modifications ont bien ete prises en compte","e-mailing-service");
}
elseif($action =="update_license"){	
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='free' WHERE `option_name`='sm_license'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='non' WHERE `option_name`='sm_blacklist'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='non' WHERE `option_name`='sm_bounces'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='non' WHERE `option_name`='sm_stats_smtp'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='non' WHERE `option_name`='sm_service_blacklist'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='720' WHERE `option_name`='sm_nbl'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='10000' WHERE `option_name`='sm_nbm'");
$wpdb -> query("DELETE FROM `$table_options` WHERE `option_name`='sm_license_key'");
_e("Votre license a ete supprime, il n' y a donc plus d'interaction avec nos serveurs","e-mailing-service");
}
elseif($action =="update_info"){
		$affiliate_default=file_get_contents(''.smURL.'/include/affiliate_default.txt');	
       $array =array (
	    "action" => "create_membre",
		"login" => nettoie($sm_login),
		"email" => $email,
		"url" => str_replace("www.","",$_SERVER['HTTP_HOST']),
		"url_base" => get_option('siteurl'),
		"ip" => $_SERVER['REMOTE_ADDR'],
		"affiliate" => $affiliate_default,
		"lang" => WPLANG
		); 
		
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_user.php',$array);
		$xml2l = post_xml($fluxl,'item',array('resultat','license','stats_smtp','limite_journaliere','limite_mensuel','stats_blacklist','blacklist','alias_multi','mass_mailing_nb','bounces','alerte','date_inscription','date_validite','date_renouvellement','licence_key'));	
		if($xml2l ==''){ 
		_e("contact support","e-mailing-service");
		echo '<br><a href="?page=e-mailing-service/admin/configuration.php">'.__("retour","e-mailing-service").'</a>';	
		} 
		foreach($xml2l as $row) {
		if($row[0] == 1){ 	
		$nlic=$row[14];
		add_option('sm_license_key',''.$nlic.''); 
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='api-free' WHERE `option_name`='sm_license'");
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_login' WHERE `option_name`='sm_login'");
		_e("Vos autorisation ont bien ete prises en compte","e-mailing-service");
		} else {
		_e("pseudo deja pris, merci de choisir un autre pseudo","e-mailing-service");
		echo '<br><a href="?page=e-mailing-service/admin/configuration.php">'.__("retour","e-mailing-service").'</a>';
		}
		}
}
elseif($action =="update_membre"){
		$affiliate_default=file_get_contents(''.smURL.'/include/affiliate_default.txt');	
        $array =array (
		"action" => "update_membre",
		"login" => $sm_login,
		"email" => $email,
		"pass" => $pass,
		"url" => str_replace("www.","",$_SERVER['HTTP_HOST']),
		"url_base" => get_option('siteurl'),
		"ip" => $_SERVER['REMOTE_ADDR'],
		"affiliate" => $affiliate_default,
		"lang" => WPLANG
		); 
		
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_user.php',$array);
		$xml2l = post_xml($fluxl,'item',array('resultat','license','stats_smtp','limite_journaliere','limite_mensuel','stats_blacklist','blacklist','alias_multi','mass_mailing_nb','bounces','alerte','date_inscription','date_validite','date_renouvellement','licence_key'));	
		if($xml2l ==''){ 
		_e("contact support","e-mailing-service");
		echo '<br><a href="?page=e-mailing-service/admin/configuration.php">'.__("retour","e-mailing-service").'</a>';	
		} 
		foreach($xml2l as $row) {
		if($row[0] == 1){ 	
		$nlic=$row[14];
		add_option('sm_license_key',''.$nlic.''); 
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='api-free' WHERE `option_name`='sm_license'");
		$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_login' WHERE `option_name`='sm_login'");
		_e("Vos autorisation ont bien ete prises en compte","e-mailing-service");
		} else {
		_e("pseudo ou mot de passe invalide","e-mailing-service");
		echo '<br><a href="?page=e-mailing-service/admin/configuration.php">'.__("retour","e-mailing-service").'</a>';
		} 
		}
}
} else {
	if(get_option('sm_license')=="free" || !get_option('sm_license_key')){
echo '<div class="message success">';		
echo "<br><h3>".__("Pour activer gratuitements des options supplementaires tel que les statistiques detailles et la reecriture des liens , vous devez nous autoriser a intergir avec votre site internet","e-mailing-service")."</h3>";		
echo "<p>".__("Cela ne nous permet pas d'acceder a vos donnees personnels, ni a vos listes d'emails","e-mailing-service")."</p>";		
echo "<p>".__("Cela permettra seulement de connaire l'url de votre site internet, ip et les informations de campagne tel que le titre et les liens, pour pouvoir vous retourner les statistiques","e-mailing-service")."</p>";?><br />
<form action="?page=e-mailing-service/admin/configuration.php" method="post">
<input type="hidden" name="action" value="update_info" />
<table>
<tr><td><?php _e("Choisissez un pseudo ( pas d'espace , ni de caractere speciales )","e-mailing-service");?></td></tr>
<tr><td><input name="sm_login" type="text" value="<?php echo get_option('sm_login');?>" size="75" maxlength="25" /></td></tr>
<tr>
  <td><?php _e("Votre email (seulement pour vous tenir informes des options ou modifications sur votre compte et pugin e-mailing-service)","e-mailing-service");?></td>
 </tr><tr> <td><input type="text" name="email" value="<?php echo get_option('admin_email');?>" size="75" /></td>
</tr>
<tr>
  <td><button name="submit" type="submit" size="75" class="button button-green"><?php _e("Oui j'utorise E-mailing Service a interagir avec mon site","e-mailing-service");?></button></td>
</tr>
</table>
</form>

<?php 
echo '</div><div class="message info">';
echo "<br><p>".__("Si vous avez deja un compte (e-mailing-service ou serveurs-mail.net et que vous voulez regrouper vos statistiques, choisissez ce formulaire","e-mailing-service")."</p>";?>		

<form action="?page=e-mailing-service/admin/configuration.php" method="post">
<input type="hidden" name="action" value="update_membre" />
<table>
<tr><td><?php _e("Pseudo","e-mailing-service");?></td></tr>
<tr><td><input type="text" name="sm_login" value="" size="75" /></td></tr>
<tr><td><?php _e("Mot de passe","e-mailing-service");?></td></tr>
<tr><td><input type="password" name="pass" value="" size="75" /></td></tr>
<tr><td><?php _e("Email","e-mailing-service");?></td></tr>
<tr><td><input type="text" name="email" value="<?php echo get_option('admin_email');?>" size="75" /></td></tr>
<tr><td><button name="submit" type="submit" size="75" class="button button-blue"><?php _e("Oui j'utorise E-mailing Service a interagir avec mon site","e-mailing-service");?></button></td></tr>
</table>
</form>
<?php
echo '</div>';
	} 
	
	
	else {
echo '<div class="message success">';
?>
<form action="?page=e-mailing-service/admin/configuration.php" method="post">
<input type="hidden" name="action" value="update" />
<table>
<tr>
  <td>
 <?php include(smPATH . '/include/license.php');?> 
 <br /><br />
  </td>
 </tr>
<tr>
  <td><?php _e("Si vous avez deja un compte sur serveurs-mail.net ou e-mailing-service.com , rentrez votre pseudo ( Attention seulement dans ce cas !!!) ","e-mailing-service");?></td></tr>
<tr>  <td><input type="text" name="sm_login" value="<?php echo get_option('sm_login');?>" size="75" /></td>
</tr>
<tr>
  <td><?php _e("Si vous avez des problemes avec la license et que le support vous a renvoyez un numero de license (Attention seulement dans ce cas !!!!)","e-mailing-service");?></td>
 </tr>
 <tr> 
 <td><input type="text" name="sm_license_key" value="<?php echo get_option('sm_license_key');?>" size="75" /></td>
</tr>
<tr>
  <td><br /><button name="submit" type="submit" size="75" class="button button-green"><?php _e("Mettre a jour","e-mailing-service");?></button></td>
</tr>
</table>
</form>
<br />
<?php
echo '</div><div class="message info">';
echo "<br><h3>".__("Si vous voulez repasser a l'offre gratuite sans interaction avec nos serveurs, cliquez ci-dessous, Attention, vous perdrez alors les statistiques des campagnes precedentes","e-mailing-service")."</h3>";
?>
<form action="?page=e-mailing-service/admin/configuration.php" method="post">
<input type="hidden" name="action" value="update_license" />
<button name="submit" type="submit" size="75" class="button button-green"><?php _e("Je ne veux plus autoriser E-mailing Service a interagir avec mon site","e-mailing-service");?></button>
</td>
</form>
<?php 
echo '</div>';
}
}?>
</div>
</div>
</section>
</div>