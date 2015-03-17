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
<?php _e("Reglage de vos alertes","e-mailing-service");?>
 </h2>
                </div>
         </div>
                 <section id="content">
            <div class="wrapper">                <section class="columns">                    

        <?php echo "<p>".__("Pour etre informe de la fin de vos newsletters, credits , etc..........","e-mailing-service")."</p>";?>
                    
                    <hr />
                    
                    <div class="grid_8">
     
           <?php
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
echo '<div class="message success">';
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
   <td><button name="submit" type="submit" size="75" class="button button-green"><?php _e("Valider la configuration","e-mailing-service");?></button></td>
  <td></td>
</tr>
</table>
</form>
<?php 
}
}?>
</div></div></div></div>

</div>
</div>
</section>
</div>