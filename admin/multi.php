<?php include(smPATH . '/include/entete.php');?>
	
		<div id="poststuff" class="metabox-holder has-right-sidebar">
		<div class="inner-sidebar">
			<div id="side-sortables" class="meta-box-sortabless ui-sortable" style="position:relative;">
<div id="box" class="postbox">
			<h3 class="hndle"><span><?php _e('Information sur votre license',"e-mailing-service");?></span></h3>
			<div class="inside">
				<?php include(smPATH . '/include/license.php');?>


	</div>
		</div>
        
        
 
</div>
</div>
<?php
extract($_POST);
if(isset($action)){
	if($action =="update"){
		//print_r($_POST);
for($i=1;$i<$nb+1;$i++){
	$ns=$i;
if( get_option('sm_serveur_'.$ns.'') ) {
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($_POST['sm_serveur_'.$ns.''])."' WHERE `option_name`='sm_serveur_".$ns."'");
} else { add_option('sm_serveur_'.$ns.'',''.trim($_POST['sm_serveur_'.$ns.'']).'');   }
if( get_option('sm_from_'.$ns.'') ) {
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($_POST['sm_from_'.$ns.''])."' WHERE `option_name`='sm_from_".$ns."'");
} else { add_option('sm_from_'.$ns.'',''.trim($_POST['sm_from_'.$ns.'']).'');   }
if( get_option('sm_email_exp_'.$ns.'') ) {
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($_POST['sm_email_exp_'.$ns.''])."' WHERE `option_name`='sm_email_exp_".$ns."'");
} else { add_option('sm_email_exp_'.$ns.'',''.trim($_POST['sm_email_exp_'.$ns.'']).'');  }
if( get_option('sm_email_ret_'.$ns.'') ) {
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($_POST['sm_email_ret_'.$ns.''])."' WHERE `option_name`='sm_email_ret_".$ns."'");
} else { add_option('sm_email_ret_'.$ns.'',''.trim($_POST['sm_email_ret_'.$ns.'']).'');   }
if( get_option('sm_smtp_server_'.$ns.'') ) {
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($_POST['sm_smtp_server_'.$ns.''])."' WHERE `option_name`='sm_smtp_server_".$ns."'");
} else { add_option('sm_smtp_server_'.$ns.'',''.trim($_POST['sm_smtp_server_'.$ns.'']).'');   }
if( get_option('sm_smtp_port_'.$ns.'') ) {
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($_POST['sm_smtp_port_'.$ns.''])."' WHERE `option_name`='sm_smtp_port_".$ns."'");
} else { add_option('sm_smtp_port_'.$ns.'',''.trim($_POST['sm_smtp_port_'.$ns.'']).'');   }
if( get_option('sm_smtp_authentification_'.$ns.'') ) {
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($_POST['sm_smtp_authentification_'.$ns.''])."' WHERE `option_name`='sm_smtp_authentification_".$ns."'");
} else { add_option('sm_smtp_authentification_'.$ns.'',''.trim($_POST['sm_smtp_authentification_'.$ns.'']).'');   }
if( get_option('sm_smtp_login_'.$ns.'') ) {
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$_POST['sm_smtp_login_'.$ns.'']."' WHERE `option_name`='sm_smtp_login_".$ns."'");
} else { add_option('sm_smtp_login_'.$ns.'',''.trim($_POST['sm_smtp_login_'.$ns.'']).'');   }
if( get_option('sm_smtp_pass_'.$ns.'') ) {
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".$_POST['sm_smtp_pass_'.$ns.'']."' WHERE `option_name`='sm_smtp_pass_".$ns."'");
} else { add_option('sm_smtp_pass_'.$ns.'',''.trim($_POST['sm_smtp_pass_'.$ns.'']).'');   }
if( get_option('sm_email_ret_'.$ns.'') ) {
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($_POST['sm_email_ret_'.$ns.''])."' WHERE `option_name`='sm_email_ret_".$ns."'");
} else { add_option('sm_email_ret_'.$ns.'',''.trim($_POST['sm_email_ret_'.$ns.'']).'');   }
if( get_option('sm_npai_serveur_'.$ns.'') ) {
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($_POST['sm_npai_serveur_'.$ns.''])."' WHERE `option_name`='sm_npai_serveur_".$ns."'");
} else { add_option('sm_npai_serveur_'.$ns.'',''.trim($_POST['sm_npai_serveur_'.$ns.'']).'');   }
if( get_option('sm_npai_port_'.$ns.'') ) {
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($_POST['sm_npai_port_'.$ns.''])."' WHERE `option_name`='sm_npai_port_".$ns."'");
} else { add_option('sm_npai_port_'.$ns.'',''.trim($_POST['sm_npai_port_'.$ns.'']).'');   }
if( get_option('sm_npai_login_'.$ns.'') ) {
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($_POST['sm_npai_login_'.$ns.''])."' WHERE `option_name`='sm_npai_login_".$ns."'");
} else { add_option('sm_npai_login_'.$ns.'',''.trim($_POST['sm_npai_login_'.$ns.'']).'');   }
if( get_option('sm_npai_pass_'.$ns.'') ) {
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($_POST['sm_npai_pass_'.$ns.''])."' WHERE `option_name`='sm_npai_pass_".$ns."'");
} else { add_option('sm_npai_pass_'.$ns.'',''.trim($_POST['sm_npai_pass_'.$ns.'']).'');   }
if( get_option('sm_smtp_actif_'.$ns.'') ) {
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($_POST['sm_smtp_actif_'.$ns.''])."' WHERE `option_name`='sm_smtp_actif_".$ns."'");
} else { add_option('sm_smtp_actif_'.$ns.'',''.trim($_POST['sm_smtp_actif_'.$ns.'']).'');  }
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_txt_affiliation' WHERE `option_name`='sm_txt_affiliation'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_affiche_txt_haut' WHERE `option_name`='sm_affiche_txt_haut'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_affiche_txt_bas' WHERE `option_name`='sm_affiche_txt_bas'");
if(get_option('sm_blacklist') == "oui" || get_option('sm_bounces') == "oui"){
	    $host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);
		$array =array (
		"domaine_client" => $host,
		"license_key" => get_option('sm_license_key'),
		"login" => get_option('sm_login'),
		"action" => "update",
		"smtp_serveur"  => $_POST['sm_smtp_server_'.$ns.''],
		"npai_serveur" => $_POST['sm_npai_serveur_'.$ns.''],
		"npai_port" => $_POST['sm_npai_port_'.$ns.''],
		"npai_login" => $_POST['sm_npai_login_'.$ns.''],
		"npai_pass" => $_POST['sm_npai_pass_'.$ns.''],
		"option_blacklist"=> get_option('sm_blacklist'),
		"option_bounces"=> "oui"
		); 
       $flux =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_npai.php',$array);
	   // echo '<textarea name="" cols="100" rows="5">'.$flux.'</textarea>';	
	      
}

//fin de la boucle
}
if( get_option('sm_multi_nb') ) {
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$nb' WHERE `option_name`='sm_multi_nb'");
} else { add_option('sm_multi_nb',''.$nb.'');  }
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_type_envoi' WHERE `option_name`='sm_type_envoi'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='mass-mailing' WHERE `option_name`='sm_license'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_txt_haut' WHERE `option_name`='sm_txt_haut'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_txt_bas' WHERE `option_name`='sm_txt_bas'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_txt_affiliation' WHERE `option_name`='sm_txt_affiliation'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_debug' WHERE `option_name`='sm_debug'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_charset' WHERE `option_name`='sm_charset'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_auto' WHERE `option_name`='sm_auto'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_auto_id_liste' WHERE `option_name`='sm_auto_id_liste'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_auto_pause' WHERE `option_name`='sm_auto_pause'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_auto_template' WHERE `option_name`='sm_post_id_auto'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_script_pause' WHERE `option_name`='sm_script_pause'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_udp_bouton' WHERE `option_name`='sm_udp_bouton'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_udp_details' WHERE `option_name`='sm_udp_details'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_udp_titre' WHERE `option_name`='sm_udp_titre'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_udp_merci' WHERE `option_name`='sm_udp_merci'");
_e("Vos informations ont bien ete mis a jour","e-mailing-service");
	}	
} else {


echo "<h1>".__("Parametres Mass Mailing","e-mailing-service")."</h1>";

if(get_option('sm_license') == "mass-mailing"){
?>
<form action="admin.php?page=e-mailing-service/admin/multi.php" method="post">
<input type="hidden" name="action" value="update" />
<input type="hidden" name="sm_type_envoi" value="smtp" />
<input type="hidden" name="sm_license" value="<?php echo get_option('sm_license'); ?>" />
<?php 
$xml=lit_xml('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_multi.php?login='.get_option('sm_login').'&url='.$host.'&licence_key='.get_option('sm_license_key').'','item',array('resultat','numero','serveur','smtp','authentification','port','email','login','pass','version','status','email_retour','npai_serveur','npai_port','npai_login','npai_pass'));
if ($xml!='') {
foreach($xml as $row) {	
?>
<h2><?php _e('SERVEUR SMTP NUMERO',"e-mailing-service");?> <?php echo $row[1];?></h2>
<table  border="0">		
<tr>
  <td><?php _e('Serveur',"e-mailing-service");?></td>
  <td><input name="sm_serveur_<?php echo $row[1];?>" type="text" value="<?php echo $row[2];?>"   size="75"  /></td>
</tr>
<tr>
  <td><?php _e('SMTP',"e-mailing-service");?></td>
  <td><input type="text" name="sm_smtp_server_<?php echo $row[1];?>" value="<?php echo $row[3];?>"    size="75" /></td>

</tr>
<tr>
  <td><?php _e('Email',"e-mailing-service");?></td>
  <td><input type="text" name="sm_email_exp_<?php echo $row[1];?>" value="<?php echo $row[6];?>"    size="75" /></td>
</tr>
<tr>
  <td width="290"><?php _e('Nom de l\'expediteur (From:)',"e-mailing-service");?></td>
  <td width="506"><label for="nom_exp"></label>
  <input name="sm_from_<?php echo $row[1];?>" type="text" value="<?php echo get_option('sm_from'); ?>"/></td>
</tr>
<tr>
  <td><?php _e('Port',"e-mailing-service");?></td>
  <td><input type="text" name="sm_smtp_port_<?php echo $row[1];?>" value="<?php echo $row[5];?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Avec ou sans authentification par mot de passe',"e-mailing-service");?></td>
  <td><?php if ($row[4]=="oui"){?>
<p><label>
    <input name="sm_smtp_authentification_<?php echo $row[1];?>" type="radio" id="typ_eenvoi_0" value="oui" checked="checked" size="75" />
    <?php _e('avec authentification',"e-mailing-service");?> ? <?php _e('oui',"e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_smtp_authentification_<?php echo $row[1];?>" value="non" id="type_envoi_1" size="75" /><?php _e("pas d'authentification","e-mailing-service");?></label> <br size="75" />
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_smtp_authentification_<?php echo $row[1];?>" type="radio" id="typ_eenvoi_0" value="oui" size="75" />
    <?php _e("avec authentification","e-mailing-service");?> ? <?php _e('oui',"e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_smtp_authentification_<?php echo $row[1];?>" value="non" id="type_envoi_1"  checked="checked"/><?php _e("pas d'authentification","e-mailing-service");?></label> <br size="75" />
</p>
<?php } ?> </td>
</tr>
<?php if ($row[4]=="oui"){ ?>
<tr>
  <td><?php _e('Login',"e-mailing-service");?></td>
  <td><input type="text" name="sm_smtp_login_<?php echo $row[1];?>" value="<?php echo $row[7];?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Pass',"e-mailing-service");?></td>
  <td><input type="password" name="sm_smtp_pass_<?php echo $row[1];?>" value="<?php echo $row[8];?>"    size="75" /></td>
</tr>
<?php } else { 
echo '<input type="hidden" name="sm_smtp_login_'.$row[1].'" value="" />';
echo '<input type="hidden" name="sm_smtp_pass_'.$row[1].'" value=""/>';
}?>
<tr>
  <td><?php _e('Email NPAI',"e-mailing-service");?></td>
  <td><input type="text" name="sm_email_ret_<?php echo $row[1];?>" value="<?php echo $row[11];?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Serveur NPAI',"e-mailing-service");?></td>
  <td><input type="text" name="sm_npai_serveur_<?php echo $row[1];?>" value="<?php echo $row[12];?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Port NPAI',"e-mailing-service");?></td>
  <td><input type="text" name="sm_npai_port_<?php echo $row[1];?>" value="<?php echo $row[13];?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Login NPAI',"e-mailing-service");?></td>
  <td><input type="text" name="sm_npai_login_<?php echo $row[1];?>" value="<?php echo $row[14];?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Pass NPAI',"e-mailing-service");?></td>
  <td><input type="password" name="sm_npai_pass_<?php echo $row[1];?>" value="<?php echo $row[15];?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Version du serveur',"e-mailing-service");?></td>
  <td><input type="text" name="sm_smtp_version_<?php echo $row[1];?>" value="<?php echo $row[9];?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Status',"e-mailing-service");?></td>
  <td><input type="text" name="sm_smtp_status_<?php echo $row[1];?>" value="<?php echo $row[10];?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Actif',"e-mailing-service");?></td>
  <td><?php if(get_option('sm_smtp_actif_'.$row[1].'') =='oui'){?>
<p><label>
    <input name="sm_smtp_actif_<?php echo $row[1];?>" type="radio" id="typ_eenvoi_0" value="oui" checked="checked" /><?php _e('oui',"e-mailing-service");?></label> | 
  <label>
    <input type="radio" name="sm_smtp_actif_<?php echo $row[1];?>" value="non" id="typ_eenvoi_1" /><?php _e('non',"e-mailing-service");?></label> 
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_smtp_actif_<?php echo $row[1];?>" type="radio" id="typ_eenvoi_0" value="oui" /><?php _e('oui',"e-mailing-service");?></label> |
  <label>
    <input type="radio" name="sm_smtp_actif_<?php echo $row[1];?>" value="non" id="typ_eenvoi_1"  checked="checked"/><?php _e('non',"e-mailing-service");?></label> <br />
</p>
<?php } ?> </td>
</tr>
</table>
<br />
<?php
}
}
?>
<input type="hidden" name="nb" value="<?php echo $row[1];?>" />
<table>
<tr>
  <td><?php _e("Texte en Haut de la newsletter","e-mailing-service");?></td>
  <td><textarea name="sm_txt_haut"  cols="60" rows="8"><?php echo get_option('sm_txt_haut'); ?> 
</textarea></td>
</tr>
<tr>
  <td><?php _e("Utiliser texte en haut");?></td>
  <td><?php if(get_option('sm_affiche_txt_haut') =='oui'){?>
<label><input name="sm_affiche_txt_haut" type="radio" id="type_envoi_0" value="oui" checked="checked" size="75" /><?php _e('oui',"e-mailing-service");?></label> | 
<label><input type="radio" name="sm_affiche_txt_haut" value="non" id="type_envoi_1" size="75" /><?php _e('non',"e-mailing-service");?></label>
    <?php } else { ?>
<label><input name="sm_affiche_txt_haut" type="radio" id="type_envoi_0" value="oui" size="75" /><?php _e('oui',"e-mailing-service");?></label>
<label><input type="radio" name="sm_affiche_txt_haut" value="non" id="type_envoi_1"  checked="checked"/><?php _e('non',"e-mailing-service");?></label>
<?php } ?> </td>
</tr>
<tr>
  <td><?php _e("Lien desabonnement","e-mailing-service");?></td>
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
    <input type="text" name="sm_charset" value="<?php echo get_option('sm_charset'); ?>" /> 
</td>
</tr>
<tr>
  <td><?php _e("Envoi automatique des nouveaux posts et nouvelles pages","e-mailing-service");?></td>
  <td><?php if(get_option('sm_auto') =='yes'){?>
<p><label>
    <input name="sm_auto" type="radio" id="typ_eenvoi_0" value="yes" checked="checked" /><?php _e('oui',"e-mailing-service");?></label>
  <br />
  <label>
    <input type="radio" name="sm_auto" value="no" id="typ_eenvoi_1" /><?php _e('non',"e-mailing-service");?></label> <br />
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_auto" type="radio" id="typ_eenvoi_0" value="yes" /><?php _e('oui',"e-mailing-service");?></label>
  <br />
  <label>
    <input type="radio" name="sm_auto" value="no" id="typ_eenvoi_1"  checked="checked"/><?php _e('non',"e-mailing-service");?></label> <br />
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
    <input type="text" name="sm_auto_pause" value="1" /> seconde 
</td>
</tr>
<tr>
   <td><?php _e("Template pour l'envoi du lien des nouvelles pages et nouveaux posts","e-mailing-service");?></td>
  <td width="506"><?php 
echo "<select name=\"sm_auto_template\">";
echo "<option value=\"".get_option('sm_post_id_auto')."\" selected=\"selected\">".get_the_title(get_option('sm_post_id_auto'))."</option>";
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
  <td><?php _e("Debug","e-mailing-service");?></td>
  <td><?php if(get_option('sm_debug') =='oui'){?>
<p><label>
    <input name="sm_debug" type="radio" id="typ_eenvoi_0" value="oui" checked="checked" /><?php _e('oui',"e-mailing-service");?></label>
  <br />
  <label>
    <input type="radio" name="sm_debug" value="non" id="typ_eenvoi_1" /><?php _e('non',"e-mailing-service");?></label> <br />
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_debug" type="radio" id="typ_eenvoi_0" value="oui" /><?php _e('oui',"e-mailing-service");?></label>
  <br />
  <label>
    <input type="radio" name="sm_debug" value="non" id="typ_eenvoi_1"  checked="checked"/><?php _e('non',"e-mailing-service");?></label> <br />
</p>
<?php } ?> </td>
</tr>
<tr>
  <td></td>
  <td><input  name="submit" value="<?php _e('valider la configuration',"e-mailing-service");?>" type="submit" /></td>
</tr>
</table>
</form>	
	
<?php } 
elseif($licen=='api_mass-mailing'){
	?>
<form action="admin.php?page=e-mailing-service/admin/multi.php" method="post">
<input type="hidden" name="action" value="update" />
<input type="hidden" name="sm_typ_eenvoi" value="smtp" />
<input type="hidden" name="sm_license" value="<?php echo "$licen"; ?>" />
<?php 
for($i=1;$i<=$xml2l->mass_mailing_nb;$i++){
?>
<input name="sm_version_<?php echo $i;?>" type="hidden" value=""  size="75"  />
<input name="sm_status_<?php echo $i;?>" type="hidden" value=""  size="75"  />
<input name="sm_serveur_<?php echo $i;?>" type="hidden" value="api_<?php echo $i;?>"  size="75"  />
<h2><?php _e("SERVEUR SMTP NUMERO","e-mailing-service");?> <?php echo $i;?></h2>
<table  border="0">		
<tr>
  <td>SMTP</td>
  <td><input type="text" name="sm_smtp_server_<?php echo $i;?>" value="<?php echo get_option('sm_smtp_server_'.$i.'');?>"   size="75" /></td>

</tr>
<tr>
  <td>Email</td>                                  
  <td><input type="text" name="sm_email_exp_<?php echo $i;?>" value="<?php echo get_option('sm_email_exp_'.$i.''); ?>"   size="75" /></td>
</tr>
<tr>
  <td width="290"><?php _e("Nom de l'expediteur (From:)","e-mailing-service");?></td>
  <td width="506"><label for="nom_exp"></label>
    <input name="sm_from_<?php echo $i;?>" type="text" value="<?php echo get_option('sm_from_'.$i.''); ?>"/></td>
</tr>
<tr>
  <td>Port</td>
  <td><input type="text" name="sm_smtp_port_<?php echo $i;?>" value="<?php echo get_option('sm_smtp_port_'.$i.''); ?>" size="75" /></td>
</tr>
<tr>
  <td>Avec ou sans authentification par mot de passe</td>
  <td><?php if(get_option('sm_smtp_authentification_'.$i.'') =='oui'){?>
<p><label>
    <input name="sm_smtp_authentification_<?php echo $i;?>"type="radio" id="type_envoi_0" value="oui" checked="checked" size="75" />
    <?php _e('avec authentification',"e-mailing-service");?> ? <?php _e('oui');?></label> |
  <label>
    <input type="radio" name="sm_smtp_authentification_<?php echo $i;?>" value="non" id="type_envoi_1" size="75" /><?php _e("pas d'authentification","e-mailing-service");?></label>
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_smtp_authentification_<?php echo $i;?>" type="radio" id="typ_eenvoi_0" value="oui" size="75" />
    <?php _e('avec authentification',"e-mailing-service");?> ? <?php _e('oui');?></label> |
  <label>
    <input type="radio" name="sm_smtp_authentification_<?php echo $i;?>" value="non" id="typ_eenvoi_1"  checked="checked"/><?php _e("pas d'authentification","e-mailing-service");?></label> <br size="75" />
</p>
<?php } ?> </td>
</tr>
<tr>
  <td>Login</td>
  <td><input type="text" name="sm_smtp_login_<?php echo $i;?>" value="<?php echo get_option('sm_smtp_login_'.$i.''); ?>"  size="75" /></td>
</tr>
<tr>
  <td>Pass</td>
  <td><input type="password" name="sm_smtp_pass_<?php echo $i;?>" value="<?php echo get_option('sm_smtp_pass_'.$i.''); ?>"  size="75" /></td>
</tr>
<tr>
  <td>Email NPAI</td>
  <td><input type="text" name="sm_email_ret_<?php echo $i;?>" value="<?php echo get_option('sm_email_ret_'.$i.''); ?>"   size="75" /></td>
</tr>
<tr>
  <td>Serveur NPAI</td>
  <td><input type="text" name="sm_npai_serveur_<?php echo $i;?>" value="<?php echo get_option('sm_npai_serveur_'.$i.''); ?>"  size="75" /></td>
</tr>
<tr>
  <td>Port NPAI</td>
  <td><input type="text" name="sm_npai_port_<?php echo $i;?>" value="<?php echo get_option('sm_npai_port_'.$i.''); ?>"   size="75" /></td>
</tr>
<tr>
  <td>Login NPAI</td>
  <td><input type="text" name="sm_npai_login_<?php echo $i;?>" value="<?php echo get_option('sm_npai_login_'.$i.''); ?>"   size="75" /></td>
</tr>
<tr>
  <td>Pass NPAI</td>
  <td><input type="password" name="sm_npai_pass_<?php echo $i;?>" value="<?php echo get_option('sm_npai_pass_'.$i.''); ?>"   size="75" /></td>
</tr>
<tr>
  <td>Actif</td>
  <td><?php if(get_option('sm_smtp_actif_'.$i.'') =='oui'){?>
<p><label>
    <input name="sm_smtp_actif_<?php echo $i;?>" type="radio" id="typ_eenvoi_0" value="oui" checked="checked" /><?php _e('oui');?></label>
 |
  <label>
    <input type="radio" name="sm_smtp_actif_<?php echo $i;?>" value="non" id="typ_eenvoi_1" /><?php _e('non');?></label> 
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_smtp_actif_<?php echo $i;?>" type="radio" id="typ_eenvoi_0" value="oui" /><?php _e('oui');?></label>
 |
  <label>
    <input type="radio" name="sm_smtp_actif_<?php echo $i;?>" value="non" id="typ_eenvoi_1"  checked="checked"/><?php _e('non');?></label>
</p>
<?php } ?> </td>
</tr>
</table>
<br />
<?php
}
?>
<input type="hidden" name="nb" value="<?php echo $xml2l->mass_mailing_nb;?>" />
<table>
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
  <td><?php _e("Lien desabonnement","e-mailing-service");?></td>
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
    <input type="text" name="sm_charset" value="<?php echo get_option('sm_charset'); ?>" /> 
</td>
</tr>
<tr>
  <td><?php _e('Envoi automatique des nouveaux posts et nouvelles pages',"e-mailing-service");?></td>
  <td><?php if(get_option('sm_auto') =='yes'){?>
<p><label>
    <input name="sm_auto" type="radio" id="typ_eenvoi_0" value="yes" checked="checked" /><?php _e('oui',"e-mailing-service");?></label>
  <br />
  <label>
    <input type="radio" name="sm_auto" value="no" id="typ_eenvoi_1" /><?php _e('non',"e-mailing-service");?></label> <br />
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_auto" type="radio" id="typ_eenvoi_0" value="yes" /><?php _e('oui',"e-mailing-service");?></label>
  <br />
  <label>
    <input type="radio" name="sm_auto" value="no" id="typ_eenvoi_1"  checked="checked"/><?php _e('non',"e-mailing-service");?></label> <br />
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
    <input type="text" name="sm_auto_pause" value="1" /> <?php _e("seconde","e-mailing-service");?> 
</td>
</tr>
<tr>
   <td><?php _e("Template pour l'envoi du lien des nouvelles pages et nouveaux posts","e-mailing-service");?></td>
  <td width="506"><?php 
echo "<select name=\"sm_auto_template\">";
echo "<option value=\"".get_option('sm_post_id_auto')."\" selected=\"selected\">".get_the_title(get_option('sm_post_id_auto'))."</option>";
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
    <input name="sm_script_pause" type="radio" id="sm_script_pause_0" value="oui" checked="checked" size="75" /><?php _e("oui","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_script_pause" value="non" id="sm_script_pause_1" size="75" /><?php _e("non","e-mailing-service");?></label> <br size="75" />
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_script_pause" type="radio" id="sm_script_pause_0" value="oui" size="75" /><?php _e("oui","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_script_pause" value="non" id="sm_script_pause_1"  checked="checked"/><?php _e("non","e-mailing-service");?></label> <br size="75" />
</p>
<?php } ?> </td>
</tr>
<tr>
  <td>Debug</td>
  <td><?php if(get_option('sm_debug') =='oui'){?>
<p><label>
    <input name="sm_debug" type="radio" id="typ_eenvoi_0" value="oui" checked="checked" /><?php _e('oui',"e-mailing-service");?></label>
  <br />
  <label>
    <input type="radio" name="sm_debug" value="non" id="typ_eenvoi_1" /><?php _e('non',"e-mailing-service");?></label> <br />
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_debug" type="radio" id="typ_eenvoi_0" value="oui" /><?php _e('oui',"e-mailing-service");?></label>
  <br />
  <label>
    <input type="radio" name="sm_debug" value="non" id="typ_eenvoi_1"  checked="checked"/><?php _e('non',"e-mailing-service");?></label> <br />
</p>
<?php } ?> </td>
</tr>
<tr>
  <td></td>
  <td><input name="submit" value="<?php _e('valider la configuration',"e-mailing-service");?>" type="submit" /></td>
</tr>
</table>
</form>	
<?php 
} else {
include(smPATH . '/include/pub-mass-mailing.php');
	 ?>
<?php
}
}
?>