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
                    
                    <div class="grid_8">
<?php                    

if(isset($_POST["action"])){
	if($_POST["action"] == "envoi"){
		if($user_role !='administrator'){
		    if(ah_service_actif($user_login) == 1){
		
$infossmtp = $wpdb->get_results("SELECT * FROM `".AH_table_server_list."` WHERE login='".$user_login."' LIMIT 1");
foreach ( $infossmtp as $infossmtps ) 
{
	if($infossmtps->version == 'load'){ $port = 27; } else { $port = 25;  }
	if(get_user_meta( $user_id, 'sm_host',true) == ''){
add_user_meta( $user_id, 'sm_sender',''.$infossmtps->email.'@'.$infossmtps->domaine.'',true);
add_user_meta( $user_id, 'sm_from', ''.$infossmtps->email.'@'.$infossmtps->domaine.'',true);
add_user_meta( $user_id, 'sm_host', ''.$infossmtps->mx.'.'.$infossmtps->domaine.'',true);
add_user_meta( $user_id, 'sm_port', $port,true);
add_user_meta( $user_id, 'sm_authentification', 'oui',true);
add_user_meta( $user_id, 'sm_username', ''.$infossmtps->email.'@'.$infossmtps->domaine.'',true);
add_user_meta( $user_id, 'sm_pass', $infossmtps->pass_email_redirection,true);
} else {
update_user_meta( $user_id, 'sm_sender',''.$infossmtps->email.'@'.$infossmtps->domaine.'');
update_user_meta( $user_id, 'sm_from', ''.$infossmtps->email.'@'.$infossmtps->domaine.'');
update_user_meta( $user_id, 'sm_host', ''.$infossmtps->mx.'.'.$infossmtps->domaine.'');
update_user_meta( $user_id, 'sm_port', $port);
update_user_meta( $user_id, 'sm_authentification', 'oui');
update_user_meta( $user_id, 'sm_username', ''.$infossmtps->email.'@'.$infossmtps->domaine.'');
update_user_meta( $user_id, 'sm_pass', $infossmtps->pass_email_redirection);
}	
}

			}
			 elseif(ah_service_actif($user_login) == 2){
		    $nb_total_a_envoyes = nb_destinataire($liste);
			$nb_envoi_mois = sm_nb_envois_mois($user_login);
$infossmtp = $wpdb->get_results("SELECT * FROM `".AH_table_service_list."` WHERE login='".$user_login."' LIMIT 1");
foreach ( $infossmtp as $infossmtps ) 
{
$port=25;
				if(ah_limit_month($reference) < $nb_total_envoyes){
	if(get_user_meta( $user_id, 'sm_host',true) == ''){
add_user_meta( $user_id, 'sm_sender',''.$infossmtps->email.'@'.$infossmtps->domaine.'',true);
add_user_meta( $user_id, 'sm_from', ''.$infossmtps->email.'@'.$infossmtps->domaine.'',true);
add_user_meta( $user_id, 'sm_host', ''.$infossmtps->mx.'.'.$infossmtps->domaine.'',true);
add_user_meta( $user_id, 'sm_port', $port, true);
add_user_meta( $user_id, 'sm_authentification', 'oui',true);
add_user_meta( $user_id, 'sm_username', ''.$infossmtps->email.'@'.$infossmtps->domaine.'',true);
add_user_meta( $user_id, 'sm_pass', $infossmtps->pass_email_redirection,true);
} else {
update_user_meta( $user_id, 'sm_sender',''.$infossmtps->email.'@'.$infossmtps->domaine.'');
update_user_meta( $user_id, 'sm_from', ''.$infossmtps->email.'@'.$infossmtps->domaine.'');
update_user_meta( $user_id, 'sm_host', ''.$infossmtps->mx.'.'.$infossmtps->domaine.'');
update_user_meta( $user_id, 'sm_port', $port);
update_user_meta( $user_id, 'sm_authentification', 'oui');
update_user_meta( $user_id, 'sm_username', ''.$infossmtps->email.'@'.$infossmtps->domaine.'');
update_user_meta( $user_id, 'sm_pass', $infossmtps->pass_email_redirection);
}
} else {
echo "<h2>".__("Vous etes arrive au bout de votre quota , vous ne pouvez plus envoyer avant le mois suivant","e-mailing-service")." : ".$nb_credit_necessaire." ".__("credits necessaires","admin-hosting")."</h2>";	
exit();	
}
}
			 }
			elseif(ah_service_actif($user_login) == 3){
		    $nb_total_envoyes = nb_destinataire($liste);
	        $nb_credit = get_option('ah_tarif_credit') * $nb_total_envoyes;
			if(ah_credit($user_login) < $nb_credit){
	        $nb_mail_possible =ah_credit($user_login) / get_option('ah_tarif_credit');
			$nb_credit_necessaire = get_option('ah_tarif_credit') * $nb_total_envoyes;
			echo "<h2>".__("Votre solde de credit n'est pas suffisant pour envoyer un mailing, vous devez crediter votre compte","e-mailing-service")." : ".$nb_credit_necessaire." ".__("credits necessaires","admin-hosting")."</h2>";	
            form_add_credit();
              exit();
	         } 
			}
		}
if($_FILES['file']['name'] !=''){
$uploaddir = smPOST;
$uploadfile = $uploaddir . date('Ymshis') . basename($_FILES['file']['name']);

if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
		     $attachments = ''.$uploadfile.'';
} else {
   _e("Probleme avec la piece jointe contacter le support","e-mailing-service");
		 exit();
}
} else {
$attachments ='';	
}
update_user_meta( $user_id, 'sm_fromname',$fromname);
update_user_meta( $user_id, 'sm_from', $fromname);
update_user_meta( $user_id, 'sm_reply',$reply_to);

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
		    if(ah_service_actif($user_login) == 3){
		  	$wpdb->insert(AH_table_financial_credit, array(
            'membre_login' => $user_login,  
            'credit' => - $nb_credit,
			'type' => __('solde','admin-hosting'),
            'information' =>  ''.__('Debit campagne numero','admin-hosting').' : '.$hie.''
            ));
			}
if(get_user_meta( $user_id, 'sm_host',true) == ''){
add_user_meta( $user_id, 'sm_host',get_option('sm_smtp_server_1'),true);
add_user_meta( $user_id, 'sm_sender',get_option('sm_smtp_sender_1'),true);
add_user_meta( $user_id, 'sm_port', get_option('sm_smtp_port_1'),true);
add_user_meta( $user_id, 'sm_authentification', get_option('sm_smtp_authentification_1'),true);
add_user_meta( $user_id, 'sm_username', get_option('sm_smtp_login_1'),true);
add_user_meta( $user_id, 'sm_pass',get_option('sm_smtp_pass_1'),true);
}
	     _e("Votre mailing va bientot demarrer","e-mailing-service");
		echo '<meta http-equiv="refresh" content="1; url=admin.php?page=e-mailing-service/admin/live_user.php">';
			
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
			'mode' => $mode,			
       ));
	    $hie = $wpdb->insert_id;
		
	    _e("Votre mailing va bientot demarrer","e-mailing-service");
		echo '<meta http-equiv="refresh" content="1; url=admin.php?page=e-mailing-service/admin/live_user.php">';
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
			'mode' => $mode,	
       ));
	    $hie = $wpdb->insert_id;
		
	    _e("Votre mailing va bientot demarrer","e-mailing-service");
		echo '<meta http-equiv="refresh" content="1; url=admin.php?page=e-mailing-service/admin/live_user.php">';
	}
} else {


if($user_role == 'administrator'){
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
</tr></tbody></table></form>";
echo "</div>";	
}

echo '<div class="message success">';
echo "<br><h1>".__("Envoyer votre newsletter","e-mailing-service")."</h1>";

if(ah_service_actif($user_login) > 1){
echo "<h3>1 ".__("mail envoyes avec vos listes","e-mailing-service")." = ".get_option('ah_tarif_credit')." ".__("credit","e-mailing-service")."<h3>";

echo '<button><strong>'.ah_credit($user_login).' '.__('credit','e-mailing-service').'</strong></button>';
  if(ah_credit($user_login) < 1) {	
  echo "<h2>".__("Votre solde de credit n'est pas suffisant pour envoyer un mailing, vous devez crediter votre compte","e-mailing-service")."</h2>";	
  form_add_credit();
  exit();
  } 
} 
echo "<p>".__("Votre newsletter partira quelques minutes apres la validation du formulaire si vous ne changer pas la date et l'heure d'envoi","e-mailing-service")."</p>";
echo '<form action="admin.php?page=e-mailing-service/admin/send_user.php" method="post" target="_parent"  enctype="multipart/form-data">
<input type="hidden" name="action" value="envoi" />';
echo '<table width="500">
                         <thead>';
echo "
<tr><td width=\"50%\"><blockquote><b>".__("Choisir une liste","e-mailing-service")."</b></blockquote></td>
<td width=\"200\"><select name=\"liste\">";
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
<tr>
<td width=\"200\"><blockquote><b>".__("Choisir la date","e-mailing-service")."</b></blockquote></td><td><input name=\"date_envoi\" type=\"text\" value=\"".date('Y-m-d H:i:s')."\" /></td></tr>
<tr><td><blockquote><b>".__("From Name","e-mailing-service")."</b></blockquote></td><td>
<input name=\"reply_to\" type=\"text\" value=\"".get_user_meta( $user_id, 'sm_reply',true)."\" /></td></tr>
<tr><td><blockquote><b>".__("Reply TO","e-mailing-service")."</b></blockquote></td><td>
<input name=\"fromname\" type=\"text\" value=\"".get_user_meta( $user_id, 'sm_fromname',true)."\" /></td></tr>
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
<input name=\"envoyer\" type=\"submit\" class=\"button button-green\" value=\"".__("envoyer","e-mailing-service")."\"/></td></form><br>
";
echo "</div>";




}


?></div></section></div></section>