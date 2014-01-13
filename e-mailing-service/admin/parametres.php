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
			<h3 class="hndle"><span><?php _e('Informations',"e-mailing-service");?></span></h3>
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
echo "<h1>".__("Parametres E-mailing Service")."</h1>";
if(isset($action)){
	if($action =="update"){
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($sm_serveur)."' WHERE `option_name`='sm_serveur'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_license' WHERE `option_name`='sm_license'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_type_envoi' WHERE `option_name`='sm_type_envoi'");

$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_from' WHERE `option_name`='sm_from'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_email_exp' WHERE `option_name`='sm_email_exp'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_email_ret' WHERE `option_name`='sm_email_ret'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_smtp_server' WHERE `option_name`='sm_smtp_server'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_smtp_port' WHERE `option_name`='sm_smtp_port'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_smtp_authentification' WHERE `option_name`='sm_smtp_authentification'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_smtp_login' WHERE `option_name`='sm_smtp_login'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_smtp_pass' WHERE `option_name`='sm_smtp_pass'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($sm_npai_serveur)."' WHERE `option_name`='sm_npai_serveur'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($sm_npai_port)."' WHERE `option_name`='sm_npai_port'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($sm_npai_login)."' WHERE `option_name`='sm_npai_login'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($sm_npai_pass)."' WHERE `option_name`='sm_npai_pass'");

$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_from' WHERE `option_name`='sm_from_1'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_email_exp' WHERE `option_name`='sm_email_exp_1'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_email_ret' WHERE `option_name`='sm_email_ret_1'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_smtp_server' WHERE `option_name`='sm_smtp_server_1'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_smtp_port' WHERE `option_name`='sm_smtp_port_1'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_smtp_authentification' WHERE `option_name`='sm_smtp_authentification_1'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_smtp_login' WHERE `option_name`='sm_smtp_login_1'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_smtp_pass' WHERE `option_name`='sm_smtp_pass_1'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($sm_npai_serveur)."' WHERE `option_name`='sm_npai_serveur_1'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($sm_npai_port)."' WHERE `option_name`='sm_npai_port_1'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($sm_npai_login)."' WHERE `option_name`='sm_npai_login_1'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($sm_npai_pass)."' WHERE `option_name`='sm_npai_pass_1'");

$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_txt_haut' WHERE `option_name`='sm_txt_haut'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_txt_bas' WHERE `option_name`='sm_txt_bas'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_txt_affiliation' WHERE `option_name`='sm_txt_affiliation'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_affiche_txt_haut' WHERE `option_name`='sm_affiche_txt_haut'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_affiche_txt_bas' WHERE `option_name`='sm_affiche_txt_bas'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_affiche_txt_affiliation' WHERE `option_name`='sm_affiche_txt_affiliation'");

$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_debug' WHERE `option_name`='sm_debug'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_charset' WHERE `option_name`='sm_charset'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_nbl' WHERE `option_name`='sm_nbl'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_auto' WHERE `option_name`='sm_auto'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_auto_id_liste' WHERE `option_name`='sm_auto_id_liste'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_auto_pause' WHERE `option_name`='sm_auto_pause'");
//$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_auto_template' WHERE `option_name`='sm_auto_template'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_post_id_auto' WHERE `option_name`='sm_post_id_auto'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_script_pause' WHERE `option_name`='sm_script_pause'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_udp_bouton' WHERE `option_name`='sm_udp_bouton'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_udp_details' WHERE `option_name`='sm_udp_details'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_udp_titre' WHERE `option_name`='sm_udp_titre'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_udp_merci' WHERE `option_name`='sm_udp_merci'");
if(get_option('sm_bounces')=="oui" || get_option('sm_blacklist')=="oui" ){
	    $host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);
		$array =array (
		"domaine_client" => $host,
		"license_key" => get_option('license_key'),
		"login" => get_option('sm_login'),
		"action" => "update",
		"smtp_serveur"  => $sm_smtp_server,
		"npai_serveur" => $sm_npai_serveur,
		"npai_port" => $sm_npai_port,
		"npai_login" => $sm_npai_login,
		"npai_pass" => $sm_npai_pass,
		"option_blacklist"=> get_option('sm_blacklist'),
		"option_bounces"=> get_option('sm_bounces')
		); 
		return xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_npai.php',$array);
	   
}
_e("Vos informations ont bien ete mis a jour","e-mailing-service");
	}
} else {
if($licen=="mass-mailing"){
_e("Vous disposez d'une license de Mass Mailing, pour configurer vos serveurs , rendez vous sur la page","e-mailing-service");
echo " <a href=\"".$_SERVER['PHP_SELF']."?page=e-mailing-service/admin/multi.php\" target=\"_parent\">".__("Mass Mailing","e-mailing-service")."</a>";		
} 
elseif($licen=="api_mass-mailing"){
_e("Vous disposez d'une license pour l'API Mass Mailing, pour configurer vos serveurs , rendez vous sur la page","e-mailing-service"); 
echo " <a href=\"".$_SERVER['PHP_SELF']."?page=e-mailing-service/admin/multi.php\" target=\"_parent\">".__("Mass Mailing","e-mailing-service")."</a>";		
}
elseif($licen=="srv-smtp" && $manuel=="auto"){
		$det_serveur=update_serveur('http://www.serveurs-mail.net/wp-code/cgi_wordpress_serveur.php',$array);
        list($cgi_serveur,$cgi_domaine,$cgi_mx,$cgi_alias,$cgi_retour,$cgi_status,$cgi_port,$cgi_alias_pass,$cgi_authentification,$cgi_version,$cgi_nbl,$cgi_npai_server,$cgi_npai_port,$cgi_npai_login,$cgi_npai_pass)=explode("|",$det_serveur);
echo "<a href=\"admin.php?page=e-mailing-service/admin/parametres.php&manuel=manuel\" target=\"_parent\">".__("Parametre manuel")."</a>";
?>
<form action="admin.php?page=e-mailing-service/admin/parametres.php" method="post">
<input type="hidden" name="action" value="update" size="75" />
<input type="hidden" name="sm_type_envoi" value="smtp" size="75" />
<input type="hidden" name="sm_license" value="<?php echo "$licen"; ?>" size="75" />
<input type="hidden" name="sm_nbl" value="<?php echo $cgi_nbl; ?>" size="75" />
<input type="hidden" name="sm_serveur" value="<?php echo "$cgi_serveur"; ?>" size="75" />
<input type="hidden" name="sm_smtp_port" value="<?php echo "$cgi_port"; ?>" size="75" />
<input type="hidden" name="sm_email_exp" value="<?php echo "$cgi_alias@$cgi_domaine"; ?>" size="75" />
<input type="hidden" name="sm_email_ret" value="<?php echo "$cgi_retour"; ?>" size="75" />
<input type="hidden" name="sm_smtp_server" value="<?php echo "$cgi_mx.$cgi_domaine"; ?>" size="75" />
<input type="hidden" name="sm_smtp_authentification" value="<?php echo "$cgi_authentification"; ?>" size="75" />
<input type="hidden" name="sm_smtp_login" value="<?php echo "$cgi_alias@$cgi_domaine"; ?>" size="75" />
<input type="hidden" name="sm_smtp_pass" value="<?php echo "$cgi_alias_pass"; ?>" size="75" />
<table>
<tr>
  <td><?php _e("License","e-mailing-service");?></td>
  <td><?php echo $licen;?></td>
</tr>
<tr>
  <td><?php _e("Serveur","e-mailing-service");?></td>
  <td><?php echo $cgi_serveur;?> </td>
</tr>
<tr>
  <td><?php _e("SMTP","e-mailing-service");?></td>
  <td><?php echo "$cgi_mx.$cgi_domaine"; ?></td>
</tr>
<tr>
  <td><?php _e("Email","e-mailing-service");?></td>
  <td><?php echo "$cgi_alias@$cgi_domaine"; ?></td>
</tr>
<tr>
  <td><?php _e("Port","e-mailing-service");?></td>
  <td><?php echo "$cgi_port"; ?></td>
</tr>
<tr>
  <td><?php _e("Avec authentification","e-mailing-service");?> ?</td>
  <td><?php echo "$cgi_authentification"; ?></td>
</tr>
<tr>
  <td><?php _e('Email NPAI',"e-mailing-service");?></td>
  <td><input type="text" name="sm_email_ret" value="<?php echo $cgi_retour;?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Serveur NPAI',"e-mailing-service");?></td>
  <td><input type="text" name="sm_npai_serveur" value="<?php echo $cgi_npai_server;?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Port NPAI',"e-mailing-service");?></td>
  <td><input type="text" name="sm_npai_port" value="<?php echo $cgi_npai_port;?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Login NPAI',"e-mailing-service");?></td>
  <td><input type="text" name="sm_npai_login" value="<?php echo $cgi_npai_login;?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Pass NPAI',"e-mailing-service");?></td>
  <td><input type="password" name="sm_npai_pass" value="<?php echo $cgi_npai_pass;?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e("Version du serveur","e-mailing-service");?></td>
  <td><?php echo "$cgi_version"; ?></td>
</tr>
<tr>
  <td width="290"><?php _e("Nom de l'expediteur","e-mailing-service");?> (From:)</td>
  <td width="506"><label for="nom_exp"></label>
    <input type="text" name="sm_from" value="<?php echo get_option('sm_from'); ?> "/></td>
</tr>
<tr>
  <td><?php _e("Email de l'expediteur","e-mailing-service");?></td>
  <td><?php echo "$cgi_alias@$cgi_domaine"; ?></td>
</tr>
<tr>
  <td><?php _e("Texte en Haut de la newsletter","e-mailing-service");?></td>
  <td><textarea name="sm_txt_haut"  cols="60" rows="8"><?php echo get_option('sm_txt_haut'); ?> 
</textarea></td>
</tr>
<tr>
  <td><?php _e("Utiliser texte en haut","e-mailing-service");?></td>
  <td><?php if(get_option('sm_affiche_txt_haut') =='oui'){?>
<label><input name="sm_affiche_txt_haut" type="radio" id="type_envoi_0" value="oui" checked="checked" size="75" /><?php _e('oui',"e-mailing-service");?></label> | 
<label><input type="radio" name="sm_affiche_txt_haut" value="non" id="type_envoi_1" size="75" /><?php _e('non',"e-mailing-service");?></label>
    <?php } else { ?>
<label><input name="sm_affiche_txt_haut" type="radio" id="type_envoi_0" value="oui" size="75" /><?php _e('oui',"e-mailing-service");?></label>
<label><input type="radio" name="sm_affiche_txt_haut" value="non" id="type_envoi_1"  checked="checked"/><?php _e('non',"e-mailing-service");?></label>
<?php } ?> </td>
</tr>
<tr>
  <td><?php _e("Lien desabonnement");?></td>
  <td><textarea name="sm_txt_bas" cols="60" rows="8"><?php echo get_option('sm_txt_bas'); ?> 
</textarea></td>
</tr>
<tr>
  <td><?php _e("Utiliser texte de desabonnement","e-mailing-service");?></td>
  <td><?php if(get_option('sm_affiche_txt_haut') =='oui'){?>
<label><input name="sm_affiche_txt_bas" type="radio" id="type_envoi_0" value="oui" checked="checked" size="75" /><?php _e('oui',"e-mailing-service");?></label> | 
<label><input type="radio" name="sm_affiche_txt_bas" value="non" id="type_envoi_1" size="75" /><?php _e('non',"e-mailing-service");?></label>
    <?php } else { ?>
<label><input name="sm_affiche_txt_bas" type="radio" id="type_envoi_0" value="oui" size="75" /><?php _e('oui',"e-mailing-service");?></label>
<label><input type="radio" name="sm_affiche_txt_bas" value="non" id="type_envoi_1"  checked="checked"/><?php _e('non',"e-mailing-service");?></label>
<?php } ?> </td>
</tr>
<tr>
  <td><?php _e("Texte Affiliation (voir les commissions dans l'aide)","e-mailing-service");?></td>
  <td><textarea name="sm_txt_affiliation" cols="60" rows="8"><?php echo get_option('sm_txt_affiliation'); ?> 
</textarea></td>
</tr>
<tr>
  <td><?php _e("Utiliser texte en pour notre affiliation","e-mailing-service");?></td>
  <td><?php if(get_option('sm_affiche_affiliation') =='oui'){?>
<label><input name="sm_affiche_txt_affiliation" type="radio" id="type_envoi_0" value="oui" checked="checked" size="75" /><?php _e('oui',"e-mailing-service");?></label> | 
<label><input type="radio" name="sm_affiche_txt_affiliation" value="non" id="type_envoi_1" size="75" /><?php _e('non',"e-mailing-service");?></label>
    <?php } else { ?>
<label><input name="sm_affiche_txt_affiliation" type="radio" id="type_envoi_0" value="oui" size="75" /><?php _e('oui',"e-mailing-service");?></label>
<label><input type="radio" name="sm_affiche_txt_affiliation" value="non" id="type_envoi_1"  checked="checked"/><?php _e('non',"e-mailing-service");?></label>
<?php } ?> </td>
</tr>
<tr>
  <td><?php _e("Texte sur le bouton de desinscription","e-mailing-service");?></td>
  <td><textarea name="sm_udp_bouton" cols="60" rows="3"><?php echo get_option('sm_udp_bouton'); ?> 
</textarea></td>
</tr>
<tr>
  <td><?php _e("Texte de la page de desinscription","e-mailing-service");?></td>
  <td><textarea name="sm_udp_details" cols="60" rows="3"><?php echo get_option('sm_udp_details'); ?> 
</textarea></td>
</tr>
<tr>
  <td><?php _e("Texte de la page de confirmation","e-mailing-service");?></td>
  <td><textarea name="sm_udp_merci" cols="60" rows="3"><?php echo get_option('sm_udp_merci'); ?> 
</textarea></td>
</tr>
<tr>
  <td><?php _e("Titre de la page de desinscription","e-mailing-service");?></td>
  <td><textarea name="sm_udp_titre" cols="60" rows="3"><?php echo get_option('sm_udp_titre'); ?> 
</textarea></td>
</tr>
<tr>
  <td width="290"><?php _e("Charset (exemple : ISO-8859-15  ou UTF-8)","e-mailing-service");?></td>
  <td width="506">
    <input type="text" name="sm_charset" value="<?php echo get_option('sm_charset'); ?>" size="75" /> 
</td>
</tr>
<tr>
  <td><?php _e("Envoi automatique des nouveaux posts et nouvelles pages","e-mailing-service");?></td>
  <td><?php if(get_option('sm_auto') =='yes'){?>
<label><input name="sm_auto" type="radio" id="type_envoi_0" value="yes" checked="checked" size="75" /><?php _e('oui',"e-mailing-service");?></label> | 
<label><input type="radio" name="sm_auto" value="no" id="type_envoi_1" size="75" /><?php _e('non',"e-mailing-service");?></label> 
    <?php } else { ?>
<label><input name="sm_auto" type="radio" id="type_envoi_0" value="yes" size="75" /><?php _e('oui',"e-mailing-service");?></label> | 
<label><input type="radio" name="sm_auto" value="no" id="type_envoi_1"  checked="checked"/><?php _e('non',"e-mailing-service");?></label> 
<?php } ?> </td>
</tr>
<tr>
  <td width="290"><?php _e("Liste de destinataires pour les envois automatiques","e-mailing-service");?></td>
  <td width="506"><?php 
echo "<select name=\"sm_auto_id_liste\">";
echo "<option value=\"".get_option('sm_auto_id_liste')."\" selected=\"selected\">".sm_liste_title(get_option('sm_auto_id_liste'))."</option>";
$listes = $wpdb->get_results("SELECT * FROM `".$table_liste."`");
foreach ( $listes as $liste ) 
{
	  echo "<option value=\"".$liste->id."\">".$liste->liste_nom."</option>";

}
echo "</select>";
?>
</td>
</tr>
<tr>
  <td width="290"><?php _e("Temps de pause entre chaque envoi automatique","e-mailing-service");?></td>
  <td width="506">
    <input type="text" name="sm_auto_pause" value="1" size="75" /> seconde 
</td>
</tr>
<tr>
   <td><?php _e("Template pour l'envoi du lien des nouvelles pages et nouveaux posts","e-mailing-service");?></td>
  <td width="506"><?php 
echo "<select name=\"sm_post_id_auto\">";
echo "<option value=\"".get_option('sm_post_id_auto')."\" selected=\"selected\">".sm_template_title(get_option('sm_post_id_auto'))."</option>";
$listes = $wpdb->get_results("SELECT * FROM `".$table_posts."` WHERE post_type='sm_modeles' AND post_status ='publish'");
foreach ( $listes as $liste ) 
{
	  echo "<option value=\"".$liste->ID."\">".$liste->post_title."</option>";

}
echo "</select>";
?>
</td>
</tr>
<tr>
  <td><?php _e("Possibilite de mettre les campagnes en pause (consomme plus de memoire)","e-mailing-service");?></td>
  <td><?php if(get_option('sm_script_pause') =='oui'){?>
<p><label>
    <input name="sm_script_pause" type="radio" id="type_envoi_0" value="oui" checked="checked" size="75" /><?php _e("oui","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_script_pause" value="non" id="type_envoi_1" size="75" /><?php _e("non","e-mailing-service");?></label> <br size="75" />
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_script_pause" type="radio" id="type_envoi_0" value="oui" size="75" /><?php _e("oui","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_script_pause" value="non" id="type_envoi_1"  checked="checked"/><?php _e("non","e-mailing-service");?></label> <br size="75" />
</p>
<?php } ?> </td>
</tr>
<tr>
  <td>Debug</td>
  <td><?php if(get_option('sm_debug') =='oui'){?>
<label><input name="sm_debug" type="radio" id="type_envoi_0" value="oui" checked="checked" size="75" /><?php _e('oui',"e-mailing-service");?></label> |
<label><input type="radio" name="sm_debug" value="non" id="type_envoi_1" size="75" /><?php _e('non',"e-mailing-service");?></label> 
    <?php } else { ?>
    <label>
    <input name="sm_debug" type="radio" id="type_envoi_0" value="oui" size="75" /><?php _e('oui',"e-mailing-service");?></label> | 
  <label>
    <input type="radio" name="sm_debug" value="non" id="type_envoi_1"  checked="checked"/><?php _e('non',"e-mailing-service");?></label>
<?php } ?> </td>
</tr>
<tr>
  <td></td>
  <td><input  name="submit"  value="<?php _e("valider la configuration","e-mailing-service");?>" type="submit" size="75" /></td>
</tr>
</table>
</form>	
	
<?php } else{
echo "<a href=\"admin.php?page=e-mailing-service/admin/parametres.php\" target=\"_parent\">".__("Parametres Automatiques","e-mailing-service")."</a>";
?>
<form action="admin.php?page=e-mailing-service/admin/parametres.php" method="post">
<input type="hidden" name="action" value="update" size="75" />
<input type="hidden" name="sm_type_envoi" value="smtp" size="75" />
<input type="hidden" name="sm_license" value="<?php echo get_option('sm_license');?>" size="75" />
<input type="hidden" name="sm_serveur" value="srv-api" size="75" />
<input type="hidden" name="sm_nbl" value="720" size="75" />
<table>
<tr>
  <td><?php _e("License","e-mailing-service");?></td>
  <td><?php echo get_option('sm_license');?> </td>
</tr>
<tr>
  <td width="290"><?php _e("Nom de l'expediteur (From:)","e-mailing-service");?></td>
  <td width="506"><label for="nom_exp"></label>
    <input type="text" name="sm_from" value="<?php echo get_option('sm_from_1'); ?>" size="75"/></td>
</tr>
<tr>
  <td><?php _e("Email de l'expediteur","e-mailing-service");?></td>
  <td><input type="text" name="sm_email_exp"  value="<?php echo get_option('sm_email_exp_1'); ?>" size="75"/></td>
</tr>
<tr>
  <td><?php _e("Email reponse","e-mailing-service");?></td>
  <td><input type="text" name="sm_email_ret" value="<?php echo get_option('sm_email_ret_1'); ?>" size="75" /></td>
</tr>
<tr>
  <td><?php _e("SMTP SERVER","e-mailing-service");?></td>
  <td><input type="text" name="sm_smtp_server" value="<?php echo get_option('sm_smtp_server_1'); ?>" size="75" /></td>
</tr>
<tr>
  <td><?php _e("Port","e-mailing-service");?></td>
  <td><input type="text" name="sm_smtp_port" value="<?php echo get_option('sm_smtp_port_1'); ?>" size="75" /></td>
</tr>
<tr>
  <td><?php _e("Avec ou sans authentification par mot de passe","e-mailing-service");?></td>
  <td><?php if(get_option('sm_smtp_authentification_1') =='oui'){?>
<p><label>
    <input name="sm_smtp_authentification" type="radio" id="type_envoi_0" value="oui" checked="checked" size="75" />
    <?php _e("avec authentification ?","e-mailing-service");?> <?php _e("oui","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_smtp_authentification" value="non" id="type_envoi_1" size="75" /><?php _e("pas d'authentification","e-mailing-service");?></label> <br size="75" />
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_smtp_authentification" type="radio" id="type_envoi_0" value="oui" size="75" />
    <?php _e("avec authentification?","e-mailing-service");?> <?php _e("oui","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_smtp_authentification" value="non" id="type_envoi_1"  checked="checked"/><?php _e("pas d'authentification","e-mailing-service");?></label> <br size="75" />
</p>
<?php } ?> </td>
</tr>
<tr>
  <td><?php _e("Si avec authentification precisez le login","e-mailing-service");?></td>
  <td><input type="text" name="sm_smtp_login" value="<?php echo get_option('sm_smtp_login_1'); ?>" size="75" /></td>
</tr>
<tr>
  <td><?php _e("Si avec authentification precisez le mot de passe","e-mailing-service");?></td>
  <td><input type="password" name="sm_smtp_pass" value="<?php echo get_option('sm_smtp_pass_1'); ?>" size="75" /></td>
</tr>
<tr>
  <td><?php _e('Serveur NPAI',"e-mailing-service");?></td>
  <td><input type="text" name="sm_npai_serveur" value="<?php echo get_option('sm_npai_serveur_1'); ?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Port NPAI',"e-mailing-service");?></td>
  <td><input type="text" name="sm_npai_port" value="<?php echo get_option('sm_npai_port_1'); ?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Login NPAI',"e-mailing-service");?></td>
  <td><input type="text" name="sm_npai_login" value="<?php echo get_option('sm_npai_login_1'); ?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Pass NPAI',"e-mailing-service");?></td>
  <td><input type="password" name="sm_npai_pass" value="<?php echo get_option('sm_npai_pass_1'); ?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e("Texte en Haut de la newsletter","e-mailing-service");?></td>
  <td><textarea name="sm_txt_haut"  cols="80" rows="8"><?php echo get_option('sm_txt_haut'); ?> 
</textarea></td>
</tr>
<tr>
  <td><?php _e("Afficher le texte en haut","e-mailing-service");?></td>
  <td><?php if(get_option('sm_affiche_txt_haut') =='oui'){?>
<p><label>
    <input name="sm_affiche_txt_haut" type="radio" id="type_envoi_0" value="oui" checked="checked" size="75" />
    <?php _e("OUI","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_affiche_txt_haut" value="non" id="type_envoi_1" size="75" /><?php _e("NON","e-mailing-service");?></label> <br size="75" />
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_affiche_txt_haut" type="radio" id="type_envoi_0" value="oui" size="75" /><?php _e("OUI","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_affiche_txt_haut" value="non" id="type_envoi_1"  checked="checked"/><?php _e("NON","e-mailing-service");?></label> <br size="75" />
</p>
<?php } ?> </td>
</tr>
<tr>
  <td><?php _e("Lien desabonnement","e-mailing-service");?></td>
  <td><textarea name="sm_txt_bas" cols="80" rows="8"><?php echo get_option('sm_txt_bas'); ?> 
</textarea></td>
</tr>
<tr>
  <td><?php _e("Afficher le texte de desabonnement","e-mailing-service");?></td>
  <td><?php if(get_option('sm_affiche_txt_bas') =='oui'){?>
<p><label>
    <input name="sm_affiche_txt_bas" type="radio" id="type_envoi_0" value="oui" checked="checked" size="75" />
    <?php _e("OUI","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_affiche_txt_bas" value="non" id="type_envoi_1" size="75" /><?php _e("NON","e-mailing-service");?></label> <br size="75" />
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_affiche_txt_bas" type="radio" id="type_envoi_0" value="oui" size="75" /><?php _e("OUI","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_affiche_txt_bas" value="non" id="type_envoi_1"  checked="checked"/><?php _e("NON","e-mailing-service");?></label> <br size="75" />
</p>
<?php } ?> </td>
</tr>
<tr>
  <td><?php _e("Texte Affiliation (voir les commissions dans l'aide)","e-mailing-service");?></td>
  <td><textarea name="sm_txt_affiliation" cols="80" rows="8"><?php echo get_option('sm_txt_affiliation'); ?> 
</textarea></td>
</tr>
<tr>
  <td><?php _e("Afficher le lien de notre affiliation","e-mailing-service");?></td>
  <td><?php if(get_option('sm_affiche_txt_affiliation') =='oui'){?>
<p><label>
    <input name="sm_affiche_txt_affiliation" type="radio" id="type_envoi_0" value="oui" checked="checked" size="75" />
    <?php _e("OUI");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_affiche_txt_affiliation" value="non" id="type_envoi_1" size="75" /><?php _e("NON","e-mailing-service");?></label> <br size="75" />
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_affiche_txt_affiliation" type="radio" id="type_envoi_0" value="oui" size="75" /><?php _e("OUI","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_affiche_txt_affiliation" value="non" id="type_envoi_1"  checked="checked"/><?php _e("NON","e-mailing-service");?></label> <br size="75" />
</p>
<?php } ?> </td>
</tr>
<tr>
  <td><?php _e("Texte sur le bouton de desinscription","e-mailing-service");?></td>
  <td><textarea name="sm_udp_bouton" cols="60" rows="3"><?php echo get_option('sm_udp_bouton'); ?> 
</textarea></td>
</tr>
<tr>
  <td><?php _e("Texte de la page de desinscription","e-mailing-service");?></td>
  <td><textarea name="sm_udp_details" cols="60" rows="3"><?php echo get_option('sm_udp_details'); ?> 
</textarea></td>
</tr>
<tr>
  <td><?php _e("Texte de la page de confirmation","e-mailing-service");?></td>
  <td><textarea name="sm_udp_merci" cols="60" rows="3"><?php echo get_option('sm_udp_merci'); ?> 
</textarea></td>
</tr>
<tr>
  <td><?php _e("Titre de la page de desinscription","e-mailing-service");?></td>
  <td><textarea name="sm_udp_titre" cols="60" rows="3"><?php echo get_option('sm_udp_titre'); ?> 
</textarea></td>
</tr>
<tr>
  <td width="290"><?php _e("Charset (exemple : ISO-8859-15  ou UTF-8)","e-mailing-service");?></td>
  <td width="506">
    <input type="text" name="sm_charset" value="<?php echo get_option('sm_charset'); ?>" size="75" /> 
</td>
</tr>
<tr>
   <td><?php _e("Template pour l'envoi du lien des nouvelles pages et nouveaux posts","e-mailing-service");?></td>
  <td width="506"><?php 
echo "<select name=\"sm_post_id_auto\">";
echo "<option value=\"".get_option('sm_post_id_auto')."\" selected=\"selected\">".sm_template_title(get_option('sm_post_id_auto'))."</option>";
$listes = $wpdb->get_results("SELECT * FROM `".$table_posts."` WHERE post_type='sm_modeles' AND post_status ='publish'");
foreach ( $listes as $liste ) 
{
	  echo "<option value=\"".$liste->ID."\">".$liste->post_title."</option>";

}
echo "</select>";
?>
</td>
</tr>
<tr>
  <td><?php _e("Envoi automatique des nouveaux posts et nouvelles pages","e-mailing-service");?></td>
  <td><?php if(get_option('sm_auto') =='yes'){?>
<p><label>
    <input name="sm_auto" type="radio" id="type_envoi_0" value="yes" checked="checked" size="75" /><?php _e("oui","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_auto" value="no" id="type_envoi_1" size="75" /><?php _e("non","e-mailing-service");?></label> <br size="75" />
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_auto" type="radio" id="type_envoi_0" value="yes" size="75" /><?php _e("oui","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_auto" value="no" id="type_envoi_1"  checked="checked"/><?php _e("non","e-mailing-service");?></label> <br size="75" />
</p>
<?php } ?> </td>
</tr>
<tr>
  <td width="290"><?php _e("Liste de destinataires pour les envois automatiques","e-mailing-service");?></td>
  <td width="506"><?php 
echo "<select name=\"sm_auto_id_liste\">";
echo "<option value=\"".get_option('sm_auto_id_liste')."\" selected=\"selected\">".sm_liste_title(get_option('sm_auto_id_liste'))."</option>";
$listes = $wpdb->get_results("SELECT * FROM `".$table_liste."`");
foreach ( $listes as $liste ) 
{
	  echo "<option value=\"".$liste->id."\">".$liste->liste_nom."</option>";

}
echo "</select>";
?>
</td>
</tr>
<tr>
  <td width="290"><?php _e("Temps de pause entre chaque envoi automatique","e-mailing-service");?></td>
  <td width="506">
    <input type="text" name="sm_auto_pause" value="1" size="10" /> seconde 
</td>
</tr>
<tr>
  <td><?php _e("Possibilite de mettre les campagnes en pause (consomme plus de memoire)","e-mailing-service");?></td>
  <td><?php if(get_option('sm_script_pause') =='oui'){?>
<p><label>
    <input name="sm_script_pause" type="radio" id="type_envoi_0" value="oui" checked="checked" size="75" /><?php _e("oui","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_script_pause" value="non" id="type_envoi_1" size="75" /><?php _e("non","e-mailing-service");?></label> <br size="75" />
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_script_pause" type="radio" id="type_envoi_0" value="oui" size="75" /><?php _e("oui","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_script_pause" value="non" id="type_envoi_1"  checked="checked"/><?php _e("non","e-mailing-service");?></label> <br size="75" />
</p>
<?php } ?> </td>
</tr>
<tr>
  <td><?php _e("Debug","e-mailing-service");?></td>
  <td><?php if(get_option('sm_debug') =='oui'){?>
<p><label>
    <input name="sm_debug" type="radio" id="type_envoi_0" value="oui" checked="checked" size="75" /><?php _e("oui","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_debug" value="non" id="type_envoi_1" size="75" /><?php _e("non","e-mailing-service");?></label> <br size="75" />
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_debug" type="radio" id="type_envoi_0" value="oui" size="75" /><?php _e("oui","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_debug" value="non" id="type_envoi_1"  checked="checked"/><?php _e("non","e-mailing-service");?></label> <br size="75" />
</p>
<?php } ?> </td>
</tr>
<tr>
  <td></td>
  <td><input name="submit" value="<?php _e("valider la configuration","e-mailing-service");?>" type="submit" size="75" /></td>
</tr>
</table>
</form>
<?php 
}
}?>
</div></div></div></div>

</div>
