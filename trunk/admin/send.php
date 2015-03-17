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
<?php _e("Envoyer votre newsletter","e-mailing-service");?>
 </h2>
                </div>
         </div>
                 <section id="content">
            <div class="wrapper">                <section class="columns">                    

        <?php echo "<p>".__("Programmer l'heure et la date d'envoi de votre newsletter","e-mailing-service")."</p>";?>
                    
                    <hr />
                    
                    <div class="grid_8"><?php
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
            'date_envoi' => $date_envoi,
			'mode' => $mode,
			'login' => $user_login,
			'attachments' => $attachments,
			'user_id' => $user_id,
			'fromname' => $fromname,
			'reply_to' => $reply_to,
       ));
	    $hie = $wpdb->insert_id;
update_user_meta( $user_id, 'sm_fromname',$fromname);
update_user_meta( $user_id, 'sm_from', $fromname);
update_user_meta( $user_id, 'sm_reply',$reply_to);
	  _e("Votre mailing va bientot demarrer","e-mailing-service");
		echo '<meta http-equiv="refresh" content="1; url=admin.php?page=e-mailing-service/admin/live_user.php">';
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
            'date_envoi' => $date_envoi,
			'mode' => $mode,
			'login' => $user_login,
			'attachments' => '',
			'user_id' => $user_id,
       ));
	    $hie = $wpdb->insert_id;
		
	    _e("Votre mailing va bientot demarrer","e-mailing-service");
		echo '<meta http-equiv="refresh" content="1; url=admin.php?page=e-mailing-service/admin/live_user.php">';
	}
} else {
echo '<div class="message success">';
echo "<br><h1>".__("Envoyer votre newsletter","e-mailing-service")."</h1>";
echo "<p>".__("Votre newsletter partira quelques minutes apres la validation du formulaire si vous ne changer pas la date et l'heure d'envoi","e-mailing-service")."</p>";
echo '<form action="admin.php?page=e-mailing-service/admin/send.php" method="post" target="_parent"  enctype="multipart/form-data">
<input type="hidden" name="action" value="envoi" />';
echo '<table width="500">
                         <thead>';
echo "
<tr><td width=\"250\"><blockquote><b>".__("Choisir une liste","e-mailing-service")."</b></blockquote></td>
<td width=\"250\"><select name=\"liste\">";
$listes = $wpdb->get_results("SELECT * FROM `".$table_liste."` where login='".$user_login."'");
foreach ( $listes as $liste ) 
{
	  echo "<option value=\"".$liste->id."|".$liste->liste_bd."\" selected=\"selected\">".$liste->liste_nom." </option>";

}
$listes = $wpdb->get_results("SELECT * FROM `".$table_liste."` where type='location'");
foreach ( $listes as $liste ) 
{
echo '<option value="'.$liste->id.'|'.$liste->liste_bd.'">'.__('location','e-mailing-service').' : '.$liste->liste_nom.' '.$liste->tarif.' '.__('credit','e-mailing-service').' / email</option>';

}
echo "</select></td>
</tr>
<tr><td><blockquote><b>".__("Choisir une campagne","e-mailing-service")."</b></blockquote></td><td><select name=\"campagne\">";
if(isset($newsletter)){
$news = $wpdb->get_results("SELECT ID,post_title FROM `".$wpdb->prefix."posts` WHERE post_author='".$user_id."' AND ID ='".$newsletter."' ORDER BY ID DESC");
} else {
$news = $wpdb->get_results("SELECT ID,post_title FROM `".$wpdb->prefix."posts` WHERE post_author='".$user_id."' AND post_type='newsletter' AND post_status ='publish' ORDER BY ID DESC");	
}
foreach ( $news as $new ) 
{
	 echo "<option value=\"".$new->ID."\" selected=\"selected\">".substr($new->post_title,0,70)."</option>";

}
echo "</select></td></tr>
<tr><td><blockquote><b>".__("Choisir la date","e-mailing-service")."</b></blockquote></td><td><input name=\"date_envoi\" type=\"text\" value=\"".date('Y-m-d H:i:s')."\" /></td></tr>
<tr><td><blockquote><b>".__("From Name","e-mailing-service")."</b></blockquote></td><td>
<input name=\"fromname\" type=\"text\" value=\"".get_user_meta( $user_id, 'sm_reply',true)."\" /></td></tr>
<tr><td><blockquote><b>".__("Reply TO","e-mailing-service")."</b></blockquote></td><td>
<input name=\"reply_to\" type=\"text\" value=\"".get_user_meta( $user_id, 'sm_fromname',true)."\" /></td></tr>
<tr><td><blockquote><b><a href=\"#\" title=\"".__("exemple pause 1s = 1 mail par seconde = 84 600 mails par jours, pause 10 s = 8 460 mails par jours )","e-mailing-service")."\">".__("Temps de pause")."</a></b></blockquote></td>
<td><input name=\"pause\" type=\"text\" value=\"10\" size=\"4\"/> s </td></tr>
<tr><td><blockquote><b><a href=\"#\" title=\"".__("Permet de suivre vos liens dans les statistiques pour separer vos theme par exemple rencontre, commerce, ...","e-mailing-service")."\">".__("Tracking 1","e-mailing-service")."</a></b></blockquote></td>
<td><input name=\"track1\" type=\"text\" value=\"\" size=\"10\"/></td>
</tr>
<tr><td><blockquote><b><a href=\"#\" title=\"".__("Permet de suivre vos liens dans les statistiques pour separer vos clients ou autres)","e-mailing-service")."\">".__("Tracking 2","e-mailing-service")."</a></b></blockquote></td>
<td><input name=\"track2\" type=\"text\" value=\"\" size=\"10\"/></td>
</tr>
<tr><td><blockquote><b>".__("Format","e-mailing-service")."</b></blockquote></td><td>
<select name=\"mode\">";
echo "<option value=\"text/html\" selected=\"selected\">html</option>";
echo "<option value=\"text/plain\">text</option>";
echo '</select></td></tr>
<tr><td><blockquote><b>'.__("Piece jointe","e-mailing-service").'</b></blockquote></td><td><input name="file" type="file"/></td></tr>
';

echo "</thead></table><br>
<input name=\"envoyer\" type=\"submit\" class=\"button button-green\" value=\"".__("envoyer","e-mailing-service")."\"/></td>
";
echo "</form><br></div><br>";


echo '<div class="message info">';
echo "<br><h1>".__("Envoyer un article ou une page avec un serveur au choix","e-mailing-service")."</h1>";
echo '<form action="admin.php?page=e-mailing-service/admin/send.php" method="post" target="_parent">
<input type="hidden" name="action" value="envoi_article" />';
echo '<table width="500">';
echo "<tr><td><blockquote><b>".__("Choisir une liste","e-mailing-service")."</b></blockquote></td>
<td><blockquote><select name=\"liste\">";
$listes = $wpdb->get_results("SELECT * FROM `".$table_liste."` WHERE login ='".$user_login."'");
foreach ( $listes as $liste ) 
{
	  echo "<option value=\"".$liste->id."|".$liste->liste_bd."\" selected=\"selected\">".$liste->liste_nom."</option>";

}
echo "</select></blockquote></td></tr>
<tr>
<td><blockquote><b>".__("Choisir une campagne","e-mailing-service")."</b></blockquote></td>
<td><blockquote><select name=\"campagne\">";
$news = $wpdb->get_results("SELECT ID,post_title,post_type FROM `".$wpdb->prefix."posts` WHERE (post_type='post' OR post_type='page') AND post_status ='publish' ORDER BY ID ASC");
foreach ( $news as $new ) 
{
	 echo "<option value=\"".$new->ID."|".$new->post_type."\" selected=\"selected\">".substr($new->post_title,0,70)."</option>";

}
echo "</select></blockquote></td></tr>
<td><blockquote><b>".__("Choisir la date","e-mailing-service")."</b></blockquote></td>
<td><input name=\"date_envoi\" type=\"text\" value=\"".date('Y-m-d H:i:s')."\" /></td>
</tr>
<tr>
<td><blockquote><b><a href=\"#\" title=\"".__("exemple pause 1s = 1 mail par seconde = 84 600 mails par jours, pause 10 s = 8 460 mails par jours )","e-mailing-service")."\">".__("Temps de pause","e-mailing-service")."</a></b></blockquote></td>
<td><input name=\"pause\" type=\"text\" value=\"10\" size=\"4\"/> s </td>
</tr>
<tr>
<td><blockquote><b><a href=\"#\" title=\"".__("Permet de suivre vos liens dans les statistiques pour separer vos theme par exemple rencontre, commerce, ...","e-mailing-service")."\">".__("Tracking 1","e-mailing-service")."</a></b></blockquote></td>
<td><input name=\"track1\" type=\"text\" value=\"\" size=\"10\"/></td>
</tr>
<tr>
<td><blockquote><b><a href=\"#\" title=\"".__("Permet de suivre vos liens dans les statistiques pour separer vos clients ou autres)","e-mailing-service")."\">".__("Tracking 2","e-mailing-service")."</a></b></blockquote></td>
<td><input name=\"track2\" type=\"text\" value=\"\" size=\"10\"/></td>
</tr>
<tr>
<td><blockquote><b><a href=\"#\" title=\"".__("Permet de suivre vos liens dans les statistiques pour separer vos clients ou autres)","e-mailing-service")."\">".__("Tracking 2","e-mailing-service")."</a></b></blockquote></td>
<td><blockquote><select name=\"mode\">";
echo "<option value=\"text/html\" selected=\"selected\">html</option>";
echo "<option value=\"text/plain\">text</option>";
echo "</select></blockquote></td>
</tr>
<tr>
<td><input name=\"envoyer\" type=\"submit\" class=\"button button-blue\" value=\"".__("envoyer","e-mailing-service")."\"/></td>
<td></td>
</tr>";
echo " </tbody></table></form><br><div>";

}
?>