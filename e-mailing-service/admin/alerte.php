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
			<h3 class="hndle"><span><?php _e('Information sur votre license',"e-mailing-service");?></span></h3>
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
echo "<h1>".__("Reglage des alertes","e-mailing-service")."</h1>";
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='sm_license' WHERE `option_name`='$licen'");
if(isset($action)){
	if($action =="update"){
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$sm_alerte_nl_cours."' WHERE `option_name`='sm_alerte_nl_cours'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_alerte_nl_fin' WHERE `option_name`='sm_alerte_nl_fin'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_alerte_inscrit' WHERE `option_name`='sm_alerte_inscrit'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$sm_alerte_blacklist."' WHERE `option_name`='sm_alerte_blacklist'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$sm_alerte_smtp."' WHERE `option_name`='sm_alerte_smtp'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_alerte_stats' WHERE `option_name`='sm_alerte_stats'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_alerte_email' WHERE `option_name`='sm_alerte_email'");
if(get_option('sm_alerte') == "oui"){
	    $host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);
		$array =array (
		"domaine_client" => $host,
		"license_key" => get_option('sm_license_key'),
		"login" => get_option('sm_login'),
		"action" => "alerte",
		"sm_alerte_smtp"  => $sm_alerte_smtp,
		"sm_alerte_email" => $sm_alerte_email,
		"sm_alerte_stats" => $sm_alerte_stats
		); 
       $flux =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_npai.php',$array);
	   //echo '<textarea name="" cols="100" rows="5">'.$flux.'</textarea>';		      
}
_e("Vos alertes ont bien ete mis a jour","e-mailing-service");	}
} else {
if(get_option('sm_alerte') !="oui"){
_e("Vous ne disposez pas de l'option alerte , rendez vous sur la page","e-mailing-service"); echo "<a href=\"".$_SERVER['PHP_SELF']."?page=e-mailing-service/admin/index.php\" target=\"_parent\">".__("Licence et options","e-mailing-service")."</a>";		
} else {
echo "<br><h3>".__("Vous allez recevoir un mail pour chaque alerte coches","e-mailing-service")."</h3>";
?>
<form action="admin.php?page=e-mailing-service/admin/alerte.php" method="post">
<input type="hidden" name="action" value="update" size="75" />
<table>
<tr>
  <td><?php _e("Email pour les alertes","e-mailing-service");?></td>
  <td><input type="text" name="sm_alerte_email" value="<?php echo get_option('sm_alerte_email');?>" /></td>
</tr>
<tr>
  <td><?php _e("Newsletter en cours d'envoi","e-mailing-service");?></td>
  <td><?php if(get_option('sm_alerte_nl_cours') =='oui'){?>
<label>
    <input name="sm_alerte_nl_cours" type="radio"  value="oui" checked="checked" size="75" /><?php _e("OUI","e-mailing-service");?></label> | <label><input type="radio" name="sm_alerte_nl_cours" value="non" size="75" /><?php _e("NON","e-mailing-service");?></label>  
    <?php } else { ?>
    <label><input name="sm_alerte_nl_cours" type="radio"  value="oui" size="75" /><?php _e("OUI","e-mailing-service");?></label> |<label> <input type="radio" name="sm_alerte_nl_cours" value="non"  checked="checked"/><?php _e("NON","e-mailing-service");?></label>
<?php } ?> </td>
</tr>
<tr>
  <td><?php _e("Newsletter termine","e-mailing-service");?></td>
  <td><?php if(get_option('sm_alerte_nl_fin',"e-mailing-service") =='oui'){?>
<label>
    <input name="sm_alerte_nl_fin" type="radio"  value="oui" checked="checked" size="75" /><?php _e("OUI","e-mailing-service");?></label> | <label><input type="radio" name="sm_alerte_nl_fin" value="non" size="75" /><?php _e("NON","e-mailing-service");?></label>  
    <?php } else { ?>
    <label><input name="sm_alerte_nl_fin" type="radio"  value="oui" size="75" /><?php _e("OUI","e-mailing-service");?></label> |<label> <input type="radio" name="sm_alerte_nl_fin" value="non"  checked="checked"/><?php _e("NON","e-mailing-service");?></label>
<?php } ?> </td>
</tr>
<tr>
  <td><?php _e("Nouvel inscrit","e-mailing-service");?></td>
  <td><?php if(get_option('sm_alerte_inscrit') =='oui'){?>
<label>
    <input name="sm_alerte_inscrit" type="radio"  value="oui" checked="checked" size="75" /><?php _e("OUI","e-mailing-service");?></label> | <label><input type="radio" name="sm_alerte_inscrit" value="non" size="75" /><?php _e("NON","e-mailing-service");?></label>  
    <?php } else { ?>
    <label><input name="sm_alerte_inscrit" type="radio"  value="oui" size="75" /><?php _e("OUI","e-mailing-service");?></label> |<label> <input type="radio" name="sm_alerte_inscrit" value="non"  checked="checked"/><?php _e("NON","e-mailing-service");?></label>
<?php } ?> </td>
</tr>
<tr>
  <td><?php _e("Blacklist et spamscore","e-mailing-service");?></td>
  <td><?php if(get_option('sm_alerte_blacklist') =='oui'){?>
<label>
    <input name="sm_alerte_blacklist" type="radio"  value="oui" checked="checked" size="75" /><?php _e("OUI","e-mailing-service");?></label> | <label><input type="radio" name="sm_alerte_blacklist" value="non" size="75" /><?php _e("NON","e-mailing-service");?></label>  
    <?php } else { ?>
    <label><input name="sm_alerte_blacklist" type="radio"  value="oui" size="75" /><?php _e("OUI","e-mailing-service");?></label> |<label> <input type="radio" name="sm_alerte_blacklist" value="non"  checked="checked"/><?php _e("NON","e-mailing-service");?></label>
<?php } ?> </td>
</tr>
<tr>
  <td><?php _e("Serveur SMTP indisponible");?></td>
  <td><?php if(get_option('sm_alerte_smtp') =='oui'){?>
<label>
    <input name="sm_alerte_smtp" type="radio"  value="oui" checked="checked" size="75" /><?php _e("OUI","e-mailing-service");?></label> | <label><input type="radio" name="sm_alerte_smtp" value="non" size="75" /><?php _e("NON","e-mailing-service");?></label>  
    <?php } else { ?>
    <label><input name="sm_alerte_smtp" type="radio"  value="oui" size="75" /><?php _e("OUI","e-mailing-service");?></label> |<label> <input type="radio" name="sm_alerte_smtp" value="non"  checked="checked"/><?php _e("NON","e-mailing-service");?></label>
<?php } ?> </td>
</tr>
<tr>
  <td><?php _e("Statistiques Journaliere");?></td>
  <td><?php if(get_option('sm_alerte_stats') =='oui'){?>
<label>
    <input name="sm_alerte_stats" type="radio"  value="oui" checked="checked" size="75" /><?php _e("OUI","e-mailing-service");?></label> | <label><input type="radio" name="sm_alerte_stats" value="non" size="75" /><?php _e("NON","e-mailing-service");?></label>  
    <?php } else { ?>
    <label><input name="sm_alerte_stats" type="radio"  value="oui" size="75" /><?php _e("OUI","e-mailing-service");?></label> |<label> <input type="radio" name="sm_alerte_stats" value="non"  checked="checked"/><?php _e("NON","e-mailing-service");?></label>
<?php } ?> </td>
</tr>
<tr>
  <td><input name="submit" value="<?php _e("Valider la configuration","e-mailing-service");?>" type="submit" size="75" /></td>
  <td></td>
</tr>
</table>
</form>
<?php 
}
}?>
</div></div></div></div>

</div>
