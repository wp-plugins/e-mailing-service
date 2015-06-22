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
<?php _e("Suivis de vos envois","e-mailing-service");?>
 </h2>
                </div>
         </div>
                 <section id="content">
            <div class="wrapper">                                   

        <?php echo "<p>".__("Pour suivre en direct le nombres d'emails envoyes","e-mailing-service")."</p>";?>
                    
                    <hr />
                    
                  
<?php
extract($_POST);
if(isset($action)){
if($action =="pause"){
    $wpdb->update( 
	$table_envoi, 
	array( 
	        'status' => "pause"
	), 
	array( 'id' => $hie));
	$wpdb->update( 
	$table_temps, 
	array( 
	        'status' => "pause"
	), 
	array( 'hie' => $hie));
}
elseif($action=="reactiver"){
    $wpdb->update( 
	$table_envoi, 
	array( 
	        'status' => "reactiver"
	), 
	array( 'id' => $hie));
	$wpdb->update( 
	$table_temps, 
	array( 
	        'status' => "actif"
	), 
	array( 'hie' => $hie));

}
elseif($action =="stop"){
    $wpdb->update( 
	$table_envoi, 
	array( 
	        'status' => "stop",
			'date_fin' => current_time('mysql')
	), 
	array( 'id' => $hie));
	$wpdb->delete( 
	$table_temps, 
	array( 'hie' => $hie));
	$wpdb->delete( 
	$table_suite, 
	array( 'hie' => $hie));
}
}

$i=0;
	echo '<h1>'.__("Listes des campagnes envoyes","e-mailing-service").'</h1>';
$tbaleau_insert ='<table class="paginate10 sortable full">
                         <thead><tr>';
$tbaleau_insert .="<th><blockquote>".__('Id envoi',"e-mailing-service")."</blockquote></th>";
if($user_role=='administrator'){
$tbaleau_insert .="<th><blockquote>".__('User',"e-mailing-service")."</blockquote></th>";
}
$tbaleau_insert .="<th><blockquote>".__('Type',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Campagne',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Liste',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Date envoi',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Date demarrage',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Date de fin',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Status',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Nb emails envoyes',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Nb emails en attente',"e-mailing-service")."</blockquote></th>";
if(get_option('sm_script_pause') =="oui"){
$tbaleau_insert .="<th><blockquote>".__('Stopper',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Pause',"e-mailing-service")."</blockquote></th>";
}
$tbaleau_insert .="<th><blockquote>".__('Reactiver',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Log',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Statistics',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="</tr></thead><tdboy>";
if($user_role=='administrator'){
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_envoi."` ORDER BY id DESC LIMIT 100");
} else {
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_envoi."` WHERE login='$user_login' ORDER BY id DESC LIMIT 100");	
}
foreach ( $fivesdrafts as $fivesdraft ) 
{
$tbaleau_insert .="<tr><td><blockquote>".$fivesdraft->id."</blockquote></td>";
if($user_role=='administrator'){
$tbaleau_insert .="<td><blockquote>".$fivesdraft->login."</blockquote></td>";	
}
$tbaleau_insert .="<td><blockquote>".$fivesdraft->type."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".get_the_title( $fivesdraft->id_newsletter )."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".sm_liste_title($fivesdraft->id_liste)."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->date_envoi."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->date_demarrage."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->date_fin."</blockquote></td>";
$tbaleau_insert .="<td><blockquote><span id='sprytrigger3'>".__($fivesdraft->status,'e-mailing-service')."</span></blockquote></td>";
if($fivesdraft->status =='En cours'){
$tbaleau_insert .="<td><blockquote>".nbenvoyer($fivesdraft->id)."</blockquote></td>";	
$tbaleau_insert .="<td><blockquote>".nbattente($fivesdraft->id)."</blockquote></td>";
if(get_option('sm_script_pause') =="oui"){
$tbaleau_insert .='<td><blockquote><form action="'.$_SERVER['PHP_SELF'].'?page=e-mailing-service/admin/live.php" method="post">
<input name="action" type="hidden" value="stop" />
<input name="hie" type="hidden" value="'.$fivesdraft->id.'" />
<input name="submit" type="image" value="submit" src="'.smURL.'/img/rouge.png" alt="'.__("Stopper la campagne","e-mailing-service").'" />
</form></blockquote></td>';
$tbaleau_insert .='<td><blockquote><form action="'.$_SERVER['PHP_SELF'].'?page=e-mailing-service/admin/live.php" method="post">
<input name="action" type="hidden" value="pause" />
<input name="hie" type="hidden" value="'.$fivesdraft->id.'" />
<input name="submit" type="image" value="submit" src="'.smURL.'/img/bleu.png" alt="'.__("Mettre la campagne en pause","e-mailing-service").'" />
</form></blockquote></td>';
}
$tbaleau_insert .='<td><blockquote><form action="'.$_SERVER['PHP_SELF'].'?page=e-mailing-service/admin/live.php" method="post">
<input name="action" type="hidden" value="reactiver" />
<input name="hie" type="hidden" value="'.$fivesdraft->id.'" />
<input name="submit" type="image" value="submit" src="'.smURL.'/img/vert.png" alt="'.__("Probleme contacter le support (code 2)","e-mailing-service").'" />
</form></blockquote></td>';	
} 
elseif($fivesdraft->status =='erreur_flux'){
$tbaleau_insert .="<td><blockquote>".nbenvoyer($fivesdraft->id)."</blockquote></td>";	
$tbaleau_insert .="<td><blockquote>".nbattente($fivesdraft->id)."</blockquote></td>";
if(get_option('sm_script_pause') =="oui"){
$tbaleau_insert .='<td></td>';
$tbaleau_insert .='<td></td>';
}
$tbaleau_insert .='<td><blockquote><form action="'.$_SERVER['PHP_SELF'].'?page=e-mailing-service/admin/live.php" method="post">
<input name="action" type="hidden" value="reactiver" />
<input name="hie" type="hidden" value="'.$fivesdraft->id.'" />
<input name="submit" type="image" value="submit" src="'.smURL.'/img/vert.png" alt="'.__("Reactiver la campagne","e-mailing-service").'" />
</form></blockquote></td>';	
} 
elseif($fivesdraft->status =='erreur_license'){
$tbaleau_insert .="<td><blockquote>".nbenvoyer($fivesdraft->id)."</blockquote></td>";	
$tbaleau_insert .="<td><blockquote>".nbattente($fivesdraft->id)."</blockquote></td>";
if(get_option('sm_script_pause') =="oui"){
$tbaleau_insert .='<td></td>';
$tbaleau_insert .='<td></td>';
}
$tbaleau_insert .='<td><blockquote><form action="'.$_SERVER['PHP_SELF'].'?page=e-mailing-service/admin/live.php" method="post">
<input name="action" type="hidden" value="reactiver" />
<input name="hie" type="hidden" value="'.$fivesdraft->id.'" />
<input name="submit" type="image" value="submit" src="'.smURL.'/img/vert.png" alt="'.__("Reactiver la campagne","e-mailing-service").'" />
</form></blockquote></td>';	
} 
elseif($fivesdraft->status =='erreur_license'){
$tbaleau_insert .="<td><blockquote>".nbenvoyer($fivesdraft->id)."</blockquote></td>";	
$tbaleau_insert .="<td><blockquote>".nbattente($fivesdraft->id)."</blockquote></td>";
if(get_option('sm_script_pause') =="oui"){
$tbaleau_insert .='<td></td>';
$tbaleau_insert .='<td></td>';
}
$tbaleau_insert .='<td><blockquote><form action="'.$_SERVER['PHP_SELF'].'?page=e-mailing-service/admin/live.php" method="post">
<input name="action" type="hidden" value="reactiver" />
<input name="hie" type="hidden" value="'.$fivesdraft->id.'" />
<input name="submit" type="image" value="submit" src="'.smURL.'/img/vert.png" alt="'.__("Reactiver la campagne","e-mailing-service").'" />
</form></blockquote></td>';	
} 
elseif($fivesdraft->status =='error'){
$tbaleau_insert .="<td><blockquote>".nbenvoyer($fivesdraft->id)."</blockquote></td>";	
$tbaleau_insert .="<td><blockquote>".nbattente($fivesdraft->id)."</blockquote></td>";
if(get_option('sm_script_pause') =="oui"){
$tbaleau_insert .='<td></td>';
$tbaleau_insert .='<td></td>';
}
$tbaleau_insert .='<td><blockquote><form action="'.$_SERVER['PHP_SELF'].'?page=e-mailing-service/admin/live.php" method="post">
<input name="action" type="hidden" value="reactiver" />
<input name="hie" type="hidden" value="'.$fivesdraft->id.'" />
<input name="submit" type="image" value="submit" src="'.smURL.'/img/vert.png" alt="'.__("Reactiver la campagne","e-mailing-service").'" />
</form></blockquote></td>';	
}
elseif($fivesdraft->status =='failed'){
$tbaleau_insert .="<td><blockquote>".nbenvoyer($fivesdraft->id)."</blockquote></td>";	
$tbaleau_insert .="<td><blockquote>".nbattente($fivesdraft->id)."</blockquote></td>";
if(get_option('sm_script_pause') =="oui"){
$tbaleau_insert .='<td></td>';
$tbaleau_insert .='<td></td>';
}
$tbaleau_insert .='<td><blockquote><form action="'.$_SERVER['PHP_SELF'].'?page=e-mailing-service/admin/live.php" method="post">
<input name="action" type="hidden" value="reactiver" />
<input name="hie" type="hidden" value="'.$fivesdraft->id.'" />
<input name="submit" type="image" value="submit" src="'.smURL.'/img/vert.png" alt="'.__("Reactiver la campagne","e-mailing-service").'" />
</form></blockquote></td>';	
}
elseif($fivesdraft->status =='Limite'){
$tbaleau_insert .="<td><blockquote>".nbenvoyer($fivesdraft->id)."</blockquote></td>";	
$tbaleau_insert .="<td><blockquote>".nbattente($fivesdraft->id)."</blockquote></td>";
if(get_option('sm_script_pause') =="oui"){
$tbaleau_insert .='<td></td>';
$tbaleau_insert .='<td></td>';
}
$tbaleau_insert .='<td></td>';	
}
elseif($fivesdraft->status =='pause'){
$tbaleau_insert .="<td><blockquote>".nbenvoyer($fivesdraft->id)."</blockquote></td>";	
$tbaleau_insert .="<td><blockquote>".nbattente($fivesdraft->id)."</blockquote></td>";
if(get_option('sm_script_pause') =="oui"){
$tbaleau_insert .='<td></td>
<td><blockquote><form action="'.$_SERVER['PHP_SELF'].'?page=e-mailing-service/admin/live.php" method="post">
<input name="action" type="hidden" value="stop" />
<input name="hie" type="hidden" value="'.$fivesdraft->id.'" />
<input name="submit" type="image" value="submit" src="'.smURL.'/img/rouge.png" alt="'.__("Stopper la campagne","e-mailing-service").'" />
</form></blockquote></td>';
}
$tbaleau_insert .='<td><blockquote><form action="'.$_SERVER['PHP_SELF'].'?page=e-mailing-service/admin/live.php" method="post">
<input name="action" type="hidden" value="reactiver" />
<input name="hie" type="hidden" value="'.$fivesdraft->id.'" />
<input name="submit" type="image" value="submit" src="'.smURL.'/img/vert.png" alt="'.__("Reactiver la campagne","e-mailing-service").'" />
</form></blockquote></td>';	
} 
elseif($fivesdraft->status =='reactiver'){
$tbaleau_insert .="<td><blockquote>".nbenvoyer($fivesdraft->id)."</blockquote></td>";	
$tbaleau_insert .="<td><blockquote>".nbattente($fivesdraft->id)."</blockquote></td>";
if(get_option('sm_script_pause') =="oui"){
$tbaleau_insert .='<td><blockquote><form action="'.$_SERVER['PHP_SELF'].'?page=e-mailing-service/admin/live.php" method="post">
<input name="action" type="hidden" value="stop" />
<input name="hie" type="hidden" value="'.$fivesdraft->id.'" />
<input name="submit" type="image" value="submit" src="'.smURL.'/img/rouge.png" alt="'.__("Stopper la campagne","e-mailing-service").'" />
</form></blockquote></td>';
$tbaleau_insert .='<td><blockquote><form action="'.$_SERVER['PHP_SELF'].'?page=e-mailing-service/admin/live.php" method="post">
<input name="action" type="hidden" value="pause" />
<input name="hie" type="hidden" value="'.$fivesdraft->id.'" />
<input name="submit" type="image" value="submit" src="'.smURL.'/img/bleu.png" alt="'.__("Mettre la campagne en pause","e-mailing-service").'" />
</form></blockquote></td>';
}
$tbaleau_insert .='<td></td>';	
} 
elseif($fivesdraft->status =='stop'){
$tbaleau_insert .="<td><blockquote>".nbenvoyer($fivesdraft->id)."</blockquote></td>";	
$tbaleau_insert .="<td><blockquote>".nbattente($fivesdraft->id)."</blockquote></td>";
if(get_option('sm_script_pause') =="oui"){
$tbaleau_insert .='<td></td>';
$tbaleau_insert .='<td></td>';
}
$tbaleau_insert .='<td></td>';	
}
elseif($fivesdraft->status =='En attente'){
$tbaleau_insert .="<td><blockquote>".nbenvoyer($fivesdraft->id)."</blockquote></td>";	
$tbaleau_insert .="<td><blockquote>".nbattente($fivesdraft->id)."</blockquote></td>"; 
if(get_option('sm_script_pause') =="oui"){
$tbaleau_insert .='<td></td>';
$tbaleau_insert .='<td></td>';
}
$tbaleau_insert .='<td></td>';	
}
else {
$tbaleau_insert .="<td><blockquote>".$fivesdraft->nb_envoi."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>0</blockquote></td>";
if(get_option('sm_script_pause') =="oui"){	
$tbaleau_insert .='<td></td>';
$tbaleau_insert .='<td></td>';
}
$tbaleau_insert .='<td></td>';
}
$tbaleau_insert .='<td>
<a href="?page=e-mailing-service/admin/stats_user.php&section=log&hie='.$fivesdraft->id.'" target="_parent">
<img src="'.smURL.'img/log.jpg" width="32" height="32" border="0" title="'.__("log on live","e-mailing-service").'"/></a>
</td>';
$tbaleau_insert .='<td>
<a href="?page=e-mailing-service/admin/stats_user.php&section=detail_hie&id='.$fivesdraft->id.'" target="_parent">
<img src="'.smURL.'img/pie_chart.png" width="32" height="32" border="0" title="'.__("statistic","e-mailing-service").'"/></a>
</td>';
$tbaleau_insert .="</tr>";	
$i++;
}
$tbaleau_insert .="</tdboy></table>";
echo $tbaleau_insert;
if($i > 0){
?>

<div class="tooltipContent" id="sprytooltip22">
  <blockquote>
			<h2><span><?php _e('Description des status',"e-mailing-service");?></span></h2>
<?php _e('En Attente',"e-mailing-service");?> = "<?php _e('La newsletter attend le cron (tache qui va demarrer le script d\'envoi de l\'emailing)',"e-mailing-service");?>"<br /> 
<?php _e('En cours',"e-mailing-service");?> = "<?php _e('Votre newsletter est en cours d\'envoi',"e-mailing-service");?>"<br />           
<?php _e('Terminer',"e-mailing-service");?> = "<?php _e('Votre newsletter a ete envoye',"e-mailing-service");?>"<br />
<?php _e('Limite',"e-mailing-service");?> = "<?php _e('Vous avez atteint la limite journaliere de votre license , l\'envoi reprendra demain.',"e-mailing-service");?>"<br /> 
<?php _e('Pause',"e-mailing-service");?> = "<?php _e('Vous avez mis votre cmapagne en pause',"e-mailing-service");?>"<br />       
<?php _e('Stop',"e-mailing-service");?> = "<?php _e('Votre newsletter a ete stoppe',"e-mailing-service");?>"<br />
<?php _e('erreur_flux',"e-mailing-service");?> = "<?php _e('API surement en panne momentanement, le script va faire une nouvelle tentative dans quelques minutes',"e-mailing-service");?>"<br />
<?php _e('erreur_license',"e-mailing-service");?> = "<?php _e('Probleme avec votre license , contacter le support',"e-mailing-service");?>"<br />
<?php _e('suite',"e-mailing-service");?> = "<?php _e('Petite pause avant les 10 000 mails suivant',"e-mailing-service");?>"<br />
<?php _e('bug',"e-mailing-service");?> = "<?php _e('Probleme avec le serveur smtp',"e-mailing-service");?>"<br />
<?php _e('error',"e-mailing-service");?> = "<?php _e('Probleme avec le serveur smtp',"e-mailing-service");?>"<br />
	 </blockquote>
</div>
<script type="text/javascript">
var sprytooltip22 = new Spry.Widget.Tooltip("sprytooltip22", "#sprytrigger3", {useEffect:"blind"});
</script>
</div>

<?php } ?>


</div>
</section>
</div>
</section>
