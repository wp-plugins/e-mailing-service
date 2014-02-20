<?php 
include(smPATH . '/include/entete.php');
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
$total = $wpdb->get_var("
    SELECT COUNT(id)
    FROM ".$table_envoi."
");
$comments_per_page = 10;
$page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
$npage = $page - 1;
$num = $npage * $comments_per_page;

echo paginate_links( array(
    'base' => add_query_arg( 'cpage', '%#%' ),
    'format' => '',
    'prev_text' => __('&laquo;'),
    'next_text' => __('&raquo;'),
    'total' => ceil($total / $comments_per_page),
    'current' => $page
));
	echo '<h1>'.__("Listes des campagnes envoyes","e-mailing-service").'</h1>';
$tbaleau_insert ='<table class="widefat">
                         <thead><tr>';
$tbaleau_insert .="<td><blockquote>".__('Id envoi',"e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".__('Type',"e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".__('Campagne',"e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".__('Liste',"e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".__('Date envoi',"e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".__('Date demarrage',"e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".__('Date de fin',"e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".__('Status',"e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".__('Nb emails envoyes',"e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".__('Nb emails en attente',"e-mailing-service")."</blockquote></td>";
if(get_option('sm_script_pause') =="oui"){
$tbaleau_insert .="<td><blockquote>".__('Stopper',"e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".__('Pause',"e-mailing-service")."</blockquote></td>";
}
$tbaleau_insert .="<td><blockquote>".__('Reactiver',"e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="</tr></thead><tdboy>";
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_envoi."` ORDER BY id DESC LIMIT $num,$comments_per_page");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$tbaleau_insert .="<tr><td><blockquote>".$fivesdraft->id."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->type."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->id_newsletter."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->id_liste."</blockquote></td>";
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
<input name="submit" type="image" value="submit" src="'.smURL.'/img/vert.png" alt="'.__("Reactiver la campagne","e-mailing-service").'" />
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

$tbaleau_insert .="</tr>";	
}
$tbaleau_insert .="</tdboy></table>";
echo $tbaleau_insert;
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
	 </blockquote>
</div>
<script type="text/javascript">
var sprytooltip22 = new Spry.Widget.Tooltip("sprytooltip22", "#sprytrigger3", {useEffect:"blind"});
</script>