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

        <?php echo "<p>".__("Pour etre informé de la fin de vos newsletters, credits , etc..........","e-mailing-service")."</p>";?>
                    
                    <hr />
                    
                    <div class="grid_8">
     
           <?php
extract($_POST);
if(isset($_GET["manuel"])){
$manuel="manuel";	
} else {
$manuel="auto";	
}
?>
<div class="has-sidebar sm-padded" >			
		<div id="post-body-content" class="has-sidebar-content">
			<div class="meta-box-sortabless">
<?php
echo "<h1>".__("Reglage des alertes","e-mailing-service")."</h1>";
if(isset($action)){
	if($action =="update"){
update_user_meta( $user_id, 'sm_alerte_nl_cours', $sm_alerte_nl_cours);
update_user_meta( $user_id, 'sm_alerte_nl_fin', $sm_alerte_nl_fin);
update_user_meta( $user_id, 'sm_alerte_credit', $sm_alerte_credit);
update_user_meta( $user_id, 'sm_alerte_stats', $sm_alerte_stats);
update_user_meta( $user_id, 'sm_alerte_email', $sm_alerte_email);
_e("Vos alertes ont bien ete mis a jour","e-mailing-service");	
}


} else {
if(get_option('sm_alerte') !="oui"){
_e("Vous ne disposez pas de l'option alerte , rendez vous sur la page","e-mailing-service"); echo "<a href=\"".$_SERVER['PHP_SELF']."?page=e-mailing-service/admin/index.php\" target=\"_parent\">".__("Licence et options","e-mailing-service")."</a>";		
} else {
echo '<div class="message success">';
echo "<br><h3>".__("Vous allez recevoir un mail pour chaque alerte coches","e-mailing-service")."</h3>";
?>
<form action="admin.php?page=e-mailing-service/admin/alerte_user.php" method="post">
<input type="hidden" name="action" value="update" size="75" />
<table width="50%">
<tr height="20">
  <td><?php _e("Email pour les alertes","e-mailing-service");?></td>
  <td><input type="text" name="sm_alerte_email" size="50" value="<?php 
if(!get_user_meta( $user_id, 'sm_alerte_email',true)){
add_user_meta( $user_id, 'sm_alerte_email', '', true);
} else {
echo get_user_meta( $user_id, 'sm_alerte_email',true);	
}?>" /></td>
</tr>
<tr height="20">
  <td><?php _e("Newsletter en cours d'envoi","e-mailing-service");?></td>
  <td><?php 
if(!get_user_meta( $user_id, 'sm_alerte_nl_cours')){
add_user_meta( $user_id, 'sm_alerte_nl_cours', '', true);
}
  if(get_user_meta( $user_id, 'sm_alerte_nl_cours',true) =='oui'){?>
<label>
<input name="sm_alerte_nl_cours" type="radio"  value="oui" checked="checked" size="75" /><?php _e("OUI","e-mailing-service");?></label> | <label><input type="radio" name="sm_alerte_nl_cours" value="non" size="75" /><?php _e("NON","e-mailing-service");?></label>  
    <?php } else { ?>
    <label><input name="sm_alerte_nl_cours" type="radio"  value="oui" size="75" /><?php _e("OUI","e-mailing-service");?></label> |<label> <input type="radio" name="sm_alerte_nl_cours" value="non"  checked="checked"/><?php _e("NON","e-mailing-service");?></label>
<?php } ?> </td>
</tr>
<tr height="20">
  <td><?php _e("Newsletter termine","e-mailing-service");?></td>
  <td><?php 
if(!get_user_meta( $user_id, 'sm_alerte_nl_fin',true)){
add_user_meta( $user_id, 'sm_alerte_nl_fin', '', true);
} 
  if(get_user_meta( $user_id, 'sm_alerte_nl_fin',true) =='oui'){?>
<label>
    <input name="sm_alerte_nl_fin" type="radio"  value="oui" checked="checked" size="75" /><?php _e("OUI","e-mailing-service");?></label> | <label><input type="radio" name="sm_alerte_nl_fin" value="non" size="75" /><?php _e("NON","e-mailing-service");?></label>  
    <?php } else { ?>
    <label><input name="sm_alerte_nl_fin" type="radio"  value="oui" size="75" /><?php _e("OUI","e-mailing-service");?></label> |<label> <input type="radio" name="sm_alerte_nl_fin" value="non"  checked="checked"/><?php _e("NON","e-mailing-service");?></label>
<?php } ?> </td>
</tr>
<tr height="20">
  <td><?php _e("Statistiques Journaliere","e-mailing-service");?></td>
  <td><?php 
    if(!get_user_meta( $user_id, 'sm_alerte_stats',true)){
    add_user_meta( $user_id, 'sm_alerte_stats', '', true);
    } 
if(get_user_meta( $user_id, 'sm_alerte_stats',true) =='oui'){?>
<label>
    <input name="sm_alerte_stats" type="radio"  value="oui" checked="checked" size="75" /><?php _e("OUI","e-mailing-service");?></label> | <label><input type="radio" name="sm_alerte_stats" value="non" size="75" /><?php _e("NON","e-mailing-service");?></label>  
    <?php } else { ?>
    <label>
<input name="sm_alerte_stats" type="radio" value="oui" size="75" /><?php _e("OUI","e-mailing-service");?></label> |<label> <input type="radio" name="sm_alerte_stats" value="non" checked="checked"/><?php _e("NON","e-mailing-service");?></label>
<?php } ?> </td>
</tr>
<tr height="20">
  <td><?php _e("Credits epuisés","e-mailing-service");?></td>
  <td><?php 
    if(!get_user_meta( $user_id, 'sm_alerte_credit',true)){
    add_user_meta( $user_id, 'sm_alerte_credit', '', true);
    } 
if(get_user_meta( $user_id, 'sm_alerte_credit',true) =='oui'){?>
<label>
    <input name="sm_alerte_credit" type="radio"  value="oui" checked="checked" size="75" /><?php _e("OUI","e-mailing-service");?></label> | <label><input type="radio" name="sm_alerte_credit" value="non" size="75" /><?php _e("NON","e-mailing-service");?></label>  
    <?php } else { ?>
    <label>
<input name="sm_alerte_credit" type="radio" value="oui" size="75" /><?php _e("OUI","e-mailing-service");?></label> |<label> <input type="radio" name="sm_alerte_credit" value="non" checked="checked"/><?php _e("NON","e-mailing-service");?></label>
<?php } ?> </td>
</tr>
<tr height="20">
  <td><button name="submit" type="submit" size="75" class="button button-green"><?php _e("Valider la configuration","e-mailing-service");?></button></td>
  <td></td>
</tr>
</table>
</form>
</div>
<?php 
}
}?>
</div></div></div></div>

</div>
</div>
</section>
</div>