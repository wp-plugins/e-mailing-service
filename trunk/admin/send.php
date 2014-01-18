<?php
include(smPATH . '/include/entete.php');
extract($_POST);
if(isset($action)){
	if($action == "envoi"){
	   $wpdb->insert("".$wpdb->prefix."sm_historique_envoi", array(  
            'id_newsletter' => $campagne,  
            'id_liste' => $liste,
			'pause' => $pause,
			'status' => 'En attente',
			'type' => 'newsletter',
			'track1' => $track1,
			'track2' => $track2,
            'date_envoi' => $date_envoi
       ));
	    $hie = $wpdb->insert_id;
		
	  _e("Votre mailing va bientot demarrer","e-mailing-service");
		echo '<meta http-equiv="refresh" content="1; url=admin.php?page=e-mailing-service/admin/live.php">';
	}
	elseif($action == "envoi_article"){
		list($ID,$POSTTYPE)=explode("|",$campagne);
	   $wpdb->insert("".$wpdb->prefix."sm_historique_envoi", array(  
            'id_newsletter' => $ID,  
            'id_liste' => $liste,
			'pause' => $pause,
			'status' => 'En attente',
			'type' => $POSTTYPE,
			'track1' => $track1,
			'track2' => $track2,
            'date_envoi' => $date_envoi
       ));
	    $hie = $wpdb->insert_id;
		
	    _e("Votre mailing va bientot demarrer","e-mailing-service");
		echo '<meta http-equiv="refresh" content="1; url=admin.php?page=e-mailing-service/admin/live.php">';
	}
		elseif($action == "envoi_choix_auto"){
		list($ID,$POSTTYPE)=explode("|",$campagne);
	   $wpdb->insert("".$wpdb->prefix."sm_historique_envoi", array(  
            'id_newsletter' => $ID,  
            'id_liste' => $liste,
			'pause' => $pause,
			'status' => 'En attente',
			'type' => $POSTTYPE,
			'track1' => $track1,
			'track2' => $track2,
            'date_envoi' => $date_envoi,
			'serveur' => $serveur,			
       ));
	    $hie = $wpdb->insert_id;
		
	    _e("Votre mailing va bientot demarrer","e-mailing-service");
		echo '<meta http-equiv="refresh" content="1; url=admin.php?page=e-mailing-service/admin/live.php">';
	}
	elseif($action == "envoi_choix"){
	    $wpdb->insert("".$wpdb->prefix."sm_historique_envoi", array(  
            'id_newsletter' => $campagne,  
            'id_liste' => $liste,
			'pause' => $pause,
			'status' => 'En attente',
			'type' => 'newsletter',
			'track1' => $track1,
			'track2' => $track2,
            'date_envoi' => $date_envoi,
			'serveur' => $serveur,	
       ));
	    $hie = $wpdb->insert_id;
		
	    _e("Votre mailing va bientot demarrer","e-mailing-service");
		echo '<meta http-equiv="refresh" content="1; url=admin.php?page=e-mailing-service/admin/live.php">';
	}
} else {

echo "<br><h1>".__("Envoyer votre newsletter","e-mailing-service")."</h1>";
echo "<h2>".__("Votre newsletter partira quelques minutes apres la validation du formulaire si vous ne changer pas la date et l'heure d'envoi","e-mailing-service")."</h2>";
echo '<form action="admin.php?page=e-mailing-service/admin/send.php" method="post" target="_parent">
<input type="hidden" name="action" value="envoi" />';
echo '<table class="widefat">
                         <thead>';
echo "<tr>
<td><blockquote><b>".__("Choisir une liste","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b>".__("Choisir une campagne","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b>".__("Choisir la date","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b><a href=\"#\" title=\"".__("exemple pause 1s = 1 mail par seconde = 84 600 mails par jours, pause 10 s = 8 460 mails par jours )","e-mailing-service")."\">".__("Temps de pause")."</a></b></blockquote></td>
<td><blockquote><b><a href=\"#\" title=\"".__("Permet de suivre vos liens dans les statistiques pour separer vos theme par exemple rencontre, commerce, ...","e-mailing-service")."\">".__("Tracking 1","e-mailing-service")."</a></b></blockquote></td>
<td><blockquote><b><a href=\"#\" title=\"".__("Permet de suivre vos liens dans les statistiques pour separer vos clients ou autres)","e-mailing-service")."\">".__("Tracking 2","e-mailing-service")."</a></b></blockquote></td>
<td></td></tr>";

echo "</thead> <tbody><tr>
<td><blockquote><select name=\"liste\">";
$listes = $wpdb->get_results("SELECT * FROM `".$table_liste."`");
foreach ( $listes as $liste ) 
{
	  echo "<option value=\"".$liste->id."|".$liste->liste_bd."\" selected=\"selected\">".$liste->liste_nom."</option>";

}
echo "</select></blockquote></td>
<td><blockquote><select name=\"campagne\">";
$news = $wpdb->get_results("SELECT ID,post_title FROM `".$wpdb->prefix."posts` WHERE post_type='newsletter' AND post_status ='publish' ORDER BY ID DESC");
foreach ( $news as $new ) 
{
	 echo "<option value=\"".$new->ID."\" selected=\"selected\">".substr($new->post_title,0,70)."</option>";

}
echo "</select></blockquote></td>
<td><input name=\"date_envoi\" type=\"text\" value=\"".date('Y-m-d H:i:s')."\" /></td>
<td><input name=\"pause\" type=\"text\" value=\"10\" size=\"4\"/> s </td>
<td><input name=\"track1\" type=\"text\" value=\"\" size=\"10\"/></td>
<td><input name=\"track2\" type=\"text\" value=\"\" size=\"10\"/></td>
<td><input name=\"envoyer\" type=\"submit\" value=\"".__("envoyer")."\"/></td>

";
echo " </tbody></table></form><br>";
echo "<br><h1>".__("Envoyer le lien d'un article ou d'un page","e-mailing-service")."</h1>";
echo "<h2>".__("Si vous avez coche dans les parametres l'envoi automatiques des nouveaux articles , vous n'avez pas besoin de vous servir de ce menu","e-mailing-service")."</h2>";
echo '<form action="admin.php?page=e-mailing-service/admin/send.php" method="post" target="_parent">
<input type="hidden" name="action" value="envoi_article" />';
echo '<table class="widefat">
                         <thead>';
echo "<tr>
<td><blockquote><b>".__("Choisir une liste","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b>".__("Choisir une campagne","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b>".__("Choisir la date","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b><a href=\"#\" title=\"".__("exemple pause 1s = 1 mail par seconde = 84 600 mails par jours, pause 10 s = 8 460 mails par jours )")."\">".__("Temps de pause","e-mailing-service")."</a></b></blockquote></td>
<td><blockquote><b><a href=\"#\" title=\"".__("Permet de suivre vos liens dans les statistiques pour separer vos theme par exemple rencontre, commerce, ...")."\">".__("Tracking 1","e-mailing-service")."</a></b></blockquote></td>
<td><blockquote><b><a href=\"#\" title=\"".__("Permet de suivre vos liens dans les statistiques pour separer vos clients ou autres)","e-mailing-service")."\">".__("Tracking 2","e-mailing-service")."</a></b></blockquote></td>
<td></td></tr>";

echo "</thead> <tbody><tr>
<td><blockquote><select name=\"liste\">";
$listes = $wpdb->get_results("SELECT * FROM `".$table_liste."`");
foreach ( $listes as $liste ) 
{
	  echo "<option value=\"".$liste->id."|".$liste->liste_bd."\" selected=\"selected\">".$liste->liste_nom."</option>";

}
echo "</select></blockquote></td>
<td><blockquote><select name=\"campagne\">";
$news = $wpdb->get_results("SELECT ID,post_title,post_type FROM `".$wpdb->prefix."posts` WHERE (post_type='post' OR post_type='page') AND post_status ='publish' ORDER BY ID ASC");
foreach ( $news as $new ) 
{
	 echo "<option value=\"".$new->ID."|".$new->post_type."\" selected=\"selected\">".substr($new->post_title,0,70)."</option>";

}
echo "</select></blockquote></td>
<td><input name=\"date_envoi\" type=\"text\" value=\"".date('Y-m-d H:i:s')."\" /></td>
<td><input name=\"pause\" type=\"text\" value=\"10\" size=\"4\"/> s </td>
<td><input name=\"track1\" type=\"text\" value=\"\" size=\"10\"/></td>
<td><input name=\"track2\" type=\"text\" value=\"\" size=\"10\"/></td>
<td><input name=\"envoyer\" type=\"submit\" value=\"".__("envoyer","e-mailing-service")."\"/></td>

";
echo " </tbody></table></form>";
if(get_option('sm_license') =="mass-mailing" || get_option('sm_license') == 'api_mass-mailing'){
echo "<br><h1>".__("Envoyer la newsletter avec un serveur au choix","e-mailing-service")."</h1>";
echo '<form action="admin.php?page=e-mailing-service/admin/send.php" method="post" target="_parent">
<input type="hidden" name="action" value="envoi_choix" />';
echo '<table class="widefat">
                         <thead>';
echo "<tr>
<td><blockquote><b>".__("Choisir une liste","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b>".__("Choisir une campagne","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b>".__("Choisir un serveur","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b>".__("Choisir la date","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b><a href=\"#\" title=\"".__("exemple pause 1s = 1 mail par seconde = 84 600 mails par jours, pause 10 s = 8 460 mails par jours )","e-mailing-service")."\">".__("Temps de pause","e-mailing-service")."</a></b></blockquote></td>
<td><blockquote><b><a href=\"#\" title=\"".__("Permet de suivre vos liens dans les statistiques pour separer vos theme par exemple rencontre, commerce, ...","e-mailing-service")."\">".__("Tracking 1","e-mailing-service")."</a></b></blockquote></td>
<td><blockquote><b><a href=\"#\" title=\"".__("Permet de suivre vos liens dans les statistiques pour separer vos clients ou autres)","e-mailing-service")."\">".__("Tracking 2","e-mailing-service")."</a></b></blockquote></td>
<td></td></tr>";

echo "</thead> <tbody><tr>
<td><blockquote><select name=\"liste\">";
$listes = $wpdb->get_results("SELECT * FROM `".$table_liste."`");
foreach ( $listes as $liste ) 
{
	  echo "<option value=\"".$liste->id."|".$liste->liste_bd."\" selected=\"selected\">".$liste->liste_nom."</option>";

}
echo "</select></blockquote></td>
<td><blockquote><select name=\"campagne\">";
$news = $wpdb->get_results("SELECT ID,post_title FROM `".$wpdb->prefix."posts` WHERE post_type='newsletter' AND post_status ='publish' ORDER BY ID DESC");
foreach ( $news as $new ) 
{
	 echo "<option value=\"".$new->ID."\" selected=\"selected\">".substr($new->post_title,0,70)."</option>";

}
echo "</select></blockquote></td>
<td><blockquote><select name=\"serveur\">";
for($num=1;$num<get_option('sm_multi_nb')+1;$num++){
	 echo "<option value=\"".$num."\" selected=\"selected\">".get_option('sm_smtp_server_'.$num.'')."</option>";
}
echo "</select></blockquote></td>
<td><input name=\"date_envoi\" type=\"text\" value=\"".date('Y-m-d H:i:s')."\" /></td>
<td><input name=\"pause\" type=\"text\" value=\"10\" size=\"4\"/> s </td>
<td><input name=\"track1\" type=\"text\" value=\"\" size=\"10\"/></td>
<td><input name=\"track2\" type=\"text\" value=\"\" size=\"10\"/></td>
<td><input name=\"envoyer\" type=\"submit\" value=\"".__("envoyer")."\"/></td>

";
echo " </tbody></table></form>";
echo "<br><h1>".__("Envoyer un article ou une page avec un serveur au choix","e-mailing-service")."</h1>";
echo '<form action="admin.php?page=e-mailing-service/admin/send.php" method="post" target="_parent">
<input type="hidden" name="action" value="envoi_choix_auto" />';
echo '<table class="widefat">
                         <thead>';
echo "<tr>
<td><blockquote><b>".__("Choisir une liste","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b>".__("Choisir une campagne","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b>".__("Choisir un serveur","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b>".__("Choisir la date","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b><a href=\"#\" title=\"".__("exemple pause 1s = 1 mail par seconde = 84 600 mails par jours, pause 10 s = 8 460 mails par jours )","e-mailing-service")."\">".__("Temps de pause","e-mailing-service")."</a></b></blockquote></td>
<td><blockquote><b><a href=\"#\" title=\"".__("Permet de suivre vos liens dans les statistiques pour separer vos theme par exemple rencontre, commerce, ...","e-mailing-service")."\">".__("Tracking 1","e-mailing-service")."</a></b></blockquote></td>
<td><blockquote><b><a href=\"#\" title=\"".__("Permet de suivre vos liens dans les statistiques pour separer vos clients ou autres)","e-mailing-service")."\">".__("Tracking 2","e-mailing-service")."</a></b></blockquote></td>
<td></td></tr>";

echo "</thead> <tbody><tr>
<td><blockquote><select name=\"liste\">";
$listes = $wpdb->get_results("SELECT * FROM `".$table_liste."`");
foreach ( $listes as $liste ) 
{
	  echo "<option value=\"".$liste->id."|".$liste->liste_bd."\" selected=\"selected\">".$liste->liste_nom."</option>";

}
echo "</select></blockquote></td>
<td><blockquote><select name=\"campagne\">";
$news = $wpdb->get_results("SELECT ID,post_title,post_type FROM `".$wpdb->prefix."posts` WHERE (post_type='post' OR post_type='page') AND post_status ='publish' ORDER BY ID ASC");
foreach ( $news as $new ) 
{
	 echo "<option value=\"".$new->ID."|".$new->post_type."\" selected=\"selected\">".substr($new->post_title,0,70)."</option>";

}
echo "</select></blockquote></td>
<td><blockquote><select name=\"serveur\">";
for($num=1;$num<get_option('sm_multi_nb')+1;$num++){
	 echo "<option value=\"".$num."\" selected=\"selected\">".get_option('sm_smtp_server_'.$num.'')."</option>";
}
echo "</select></blockquote></td>
<td><input name=\"date_envoi\" type=\"text\" value=\"".date('Y-m-d H:i:s')."\" /></td>
<td><input name=\"pause\" type=\"text\" value=\"10\" size=\"4\"/> s </td>
<td><input name=\"track1\" type=\"text\" value=\"\" size=\"10\"/></td>
<td><input name=\"track2\" type=\"text\" value=\"\" size=\"10\"/></td>
<td><input name=\"envoyer\" type=\"submit\" value=\"".__("envoyer","e-mailing-service")."\"/></td>

";
echo " </tbody></table></form>";
}
}
?>