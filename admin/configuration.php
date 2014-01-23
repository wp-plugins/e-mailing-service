<?php
include(smPATH . '/include/entete.php');
extract($_POST);
if(isset($_GET["manuel"])){
$manuel="manuel";	
} else {
$manuel="auto";	
}
?>
	<div class="wrap" id="sm_div">

		<div id="poststuff" class="metabox-holder has-right-sidebar">
		<div class="inner-sidebar">
			<div id="side-sortables" class="meta-box-sortabless ui-sortable" style="position:relative;">
<div id="box" class="postbox">
			<h3 class="hndle"><span><?php _e('Information sur les options',"e-mailing-service");?></span></h3>
			<div class="inside">
				<?php include(smPATH . '/include/license.php');?>


	</div>
    <br /><br />
    <h3 class="hndle"><span><?php _e('Configuration Wordress',"e-mailing-service");?></span></h3>
			<div class="inside">
				<?php
				
				echo "<p>".__("Plugin Version","e-mailing-service")." : ".get_option('sm_version')."</p>";				
				echo "<p>".__("Serveur OS","e-mailing-service")." : ".PHP_OS."</p>";				
				echo "<p>".__("Plugin fonctionne avec PHP Version: 5.0+","e-mailing-service")."<br>";
				echo "<p>".__("Votre version de PHP","e-mailing-service")." : " . phpversion() . "</p>";							
				echo "<p>".__("Memoire utilise","e-mailing-service")." : " . number_format(memory_get_usage()/1024/1024, 1) . " / " . ini_get('memory_limit') . "</p>";				
				echo "<p>".__("Pic utilisation de la memoire","e-mailing-service")." : " . number_format(memory_get_peak_usage()/1024/1024, 1) . " / " . ini_get('memory_limit') . "</p>";				
				$lav = sys_getloadavg();
				echo "<p>".__("Serveur Charge moyenne","e-mailing-service")." : ".$lav[0].", ".$lav[1].", ".$lav[2]."</p>";
				
				?>

	</div>
		</div>
        
        
        
 
</div>
</div>
	

<div class="has-sidebar sm-padded" >			
		<div id="post-body-content" class="has-sidebar-content">
			<div class="meta-box-sortabless">
<?php
echo "<h1>".__("License et options","e-mailing-service")."</h1>";
if (!extension_loaded('libxml')) {
load_lib('libxml');
}
if(isset($action)){
	if($action =="update"){	
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$sm_login."' WHERE `option_name`='sm_login'");
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
		"login" => $sm_login,
		"email" => $email,
		"url" => str_replace("www.","",$_SERVER['HTTP_HOST']),
		"url_base" => get_option('siteurl'),
		"ip" => $_SERVER['REMOTE_ADDR'],
		"affiliate" => $affiliate_default,
		"lang" => WPLANG
		); 
		
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_user.php',$array);
		$xmll = @strstr($fluxl,'</xml>', true);
		$xml2l = @simplexml_load_string($xmll);
		if(!isset($xml2l->resultat)){
		_e("contact support, probleme avec l'extension libxml de votre serveur ou indisponibilite de nos serveurs","e-mailing-service");
		echo '<br><a href="?page=e-mailing-service/admin/configuration.php">'.__("retour","e-mailing-service").'</a>';	
		} else {
		if($xml2l->resultat=="1"){
		$nlic=$xml2l->licence_key;
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
		$xmll = @strstr($fluxl,'</xml>', true);
		$xml2l = @simplexml_load_string($xmll);
		echo '<textarea name="" cols="150" rows="10">'.$fluxl.'</textarea>';
		if(!isset($xml2l->resultat)){
		_e("probleme avec l'extension libxml de votre serveur, contact support","e-mailing-service");
		echo '<br><a href="?page=e-mailing-service/admin/configuration.php">'.__("retour","e-mailing-service").'</a>';	
		} else {
		if($xml2l->resultat=="1"){
		$nlic=$xml2l->licence_key;
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
		
echo "<br><h3>".__("Pour activer gratuitements des options supplementaires tel que les statistiques detailles et la reecriture des liens , vous devez nous autoriser a intergir avec votre site internet","e-mailing-service")."</h3>";		
echo "<p>".__("Cela ne nous permet pas d'acceder a vos donnees personnels, ni a vos listes d'emails","e-mailing-service")."</p>";		
echo "<p>".__("Cela permettra seulement de connaire l'url de votre site internet, ip et les informations de campagne tel que le titre et les liens, pour pouvoir vous retourner les statistiques","e-mailing-service")."</p>";?><br />
<form action="?page=e-mailing-service/admin/configuration.php" method="post">
<input type="hidden" name="action" value="update_info" />
<table>
<tr><td><?php _e("Choisissez un pseudo ( pas d'espace , ni de caractere speciales )","e-mailing-service");?></td></tr>
<tr><td><input type="text" name="sm_login" value="<?php echo get_option('sm_login');?>" size="75" /></td></tr>
<tr>
  <td><?php _e("Votre email (seulement pour vous tenir informes des options ou modifications sur votre compte et pugin e-mailing-service)","e-mailing-service");?></td>
 </tr><tr> <td><input type="text" name="email" value="<?php echo get_option('admin_email');?>" size="75" /></td>
</tr>
<tr>
  <td><input name="submit" value="<?php _e("Oui j'utorise E-mailing Service a interagir avec mon site","e-mailing-service");?>" type="submit" size="75" /></td>
</tr>
</table>
</form>
<?php echo "<br><p>".__("Si vous avez deja un compte (e-mailing-service ou serveurs-mail.net et que vous voulez regrouper vos statistiques, choisissez ce formulaire","e-mailing-service")."</p>";?>		

<form action="?page=e-mailing-service/admin/configuration.php" method="post">
<input type="hidden" name="action" value="update_membre" />
<table>
<tr><td><?php _e("Pseudo","e-mailing-service");?></td></tr>
<tr><td><input type="text" name="sm_login" value="" size="75" /></td></tr>
<tr><td><?php _e("Mot de passe","e-mailing-service");?></td></tr>
<tr><td><input type="password" name="pass" value="" size="75" /></td></tr>
<tr><td><?php _e("Email","e-mailing-service");?></td></tr>
<tr><td><input type="text" name="email" value="<?php echo get_option('admin_email');?>" size="75" /></td></tr>
<tr><td><input name="submit" value="<?php _e("Oui j'utorise E-mailing Service a interagir avec mon site","e-mailing-service");?>" type="submit" size="75" /></td></tr>
</table>
</form>
<?php
	} 
	
	
	else {
echo "<br><h3>".__("L'installation du plugin, la creation de compte, la creation de license est automatise , mais dans le cas d'une reinstallation ou d'un probleme divers, vous avez besoin de parametrer ci-desssous","e-mailing-service")."</h3>";
?>
<form action="?page=e-mailing-service/admin/configuration.php" method="post">
<input type="hidden" name="action" value="update" />
<table>
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
  <td><input name="submit" value="<?php _e("Valider la configuration","e-mailing-service");?>" type="submit" size="75" /></td>
</tr>
</table>
</form>
<br />
<?php
echo "<br><h3>".__("Si vous voulez repasser a l'offre gratuite sans interaction avec nos serveurs, cliquez ci-dessous, Attention, vous perdrez alors les statistiques des campagnes precedentes","e-mailing-service")."</h3>";
?>
<form action="?page=e-mailing-service/admin/configuration.php" method="post">
<input type="hidden" name="action" value="update_license" />
<input name="submit" value="<?php _e("Je ne veux plus autoriser E-mailing Service a interagir avec mon site","e-mailing-service");?>" type="submit" size="75" /></td>
</form>
<?php 
}
}?>
</div></div></div></div>
</div>
