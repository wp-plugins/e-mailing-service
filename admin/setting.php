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
<?php _e("Configuration du plugin","e-mailing-service");?>
 </h2>
                </div>
         </div>
                 <section id="content">
            <div class="wrapper">                <section class="columns">                    

        <?php echo "<p>".__("Vous devez disposer d'un serveur SMTP pour utiliser le plugin","e-mailing-service")."</p>";?>
                    
                    <hr />
                    
                    <div class="grid_8"><?php
extract($_POST);
if(!isset($_GET["manuel"])){
$manuel="manuel";	
} else {
$manuel="auto";	
}
?>
	<div class="wrap" id="sm_div">
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


if(get_user_meta( $user_id, 'sm_host',true) == ''){
add_user_meta( $user_id, 'sm_sender',''.$sm_email_exp.'',true);
add_user_meta( $user_id, 'sm_from', ''.$sm_from.'',true);
add_user_meta( $user_id, 'sm_host', ''.$sm_smtp_server.'',true);
add_user_meta( $user_id, 'sm_port', $sm_smtp_port,true);
add_user_meta( $user_id, 'sm_authentification', $sm_smtp_authentification,true);
add_user_meta( $user_id, 'sm_username', ''.$sm_smtp_login.'',true);
add_user_meta( $user_id, 'sm_pass', $sm_smtp_pass,true);
} else {
update_user_meta( $user_id, 'sm_sender',''.$sm_email_exp.'');
update_user_meta( $user_id, 'sm_from', ''.$sm_from.'');
update_user_meta( $user_id, 'sm_host', ''.$sm_smtp_server.'');
update_user_meta( $user_id, 'sm_port', $sm_smtp_port);
update_user_meta( $user_id, 'sm_authentification', $sm_smtp_authentification);
update_user_meta( $user_id, 'sm_username', ''.$sm_smtp_login.'');
update_user_meta( $user_id, 'sm_pass', $sm_smtp_pass);
}	

$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($sm_npai_serveur)."' WHERE `option_name`='sm_npai_serveur'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($sm_npai_port)."' WHERE `option_name`='sm_npai_port'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($sm_npai_login)."' WHERE `option_name`='sm_npai_login'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='".trim($sm_npai_pass)."' WHERE `option_name`='sm_npai_pass'");

if ( get_option( 'sm_from_alert' ) !== false ) {
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_from_alert' WHERE `option_name`='sm_from_alert'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_email_alert_exp' WHERE `option_name`='sm_email_alert_exp'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_email_alert_ret' WHERE `option_name`='sm_email_alert_ret'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_smtp_alert_server' WHERE `option_name`='sm_smtp_alert_server'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_smtp_alert_port' WHERE `option_name`='sm_smtp_alert_port'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_smtp_alert_authentification' WHERE `option_name`='sm_smtp_alert_authentification'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_smtp_alert_login' WHERE `option_name`='sm_smtp_alert_login'");
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_smtp_alert_pass' WHERE `option_name`='sm_smtp_alert_pass'");
} else {
 add_option('sm_from_alert', $sm_from_alert, 'null', 'no');
 add_option('sm_email_alert_exp', $sm_email_alert_exp, 'null', 'no');
 add_option('sm_email_alert_ret', $sm_email_alert_ret, 'null', 'no');
 add_option('sm_smtp_alert_server', $sm_smtp_alert_server, 'null', 'no');
 add_option('sm_smtp_alert_port', $sm_smtp_alert_port, 'null', 'no');
 add_option('sm_smtp_alert_authentification', $sm_smtp_alert_authentification, 'null', 'no');
 add_option('sm_smtp_alert_login', $sm_smtp_alert_login, 'null', 'no');
 add_option('sm_smtp_alert_pass', $sm_smtp_alert_pass, 'null', 'no');		
}


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
?>	
<?php		
$licen=get_option('sm_license');
if($licen=="srv-smtp"){
		$host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);
		$array =array (
		"site" => $host,
		"license_key" => get_option('license_key'),
		"login" => get_option('sm_login'),
		"action" => "infos",
		); 
		$string=xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_serveur.php',$array);
		//echo '<textarea name="bug" cols="150" rows="10">'.$string.'</textarea>';
		$xml2l = post_xml($string,'item',array('resultat','cgi_smtp_server','cgi_smtp_port','cgi_smtp_login','cgi_smtp_pass','cgi_authentification','cgi_npai_server','cgi_npai_port','cgi_npai_login','cgi_npai_pass','cgi_server'));
        foreach($xml2l as $row) {
		$cgi_smtp_server=$row[1];
		$cgi_smtp_port=$row[2];
		$cgi_smtp_login=$row[3];
		$cgi_smtp_pass=$row[4];
		$cgi_authentification=$row[5];
		$cgi_npai_server=$row[6];
		$cgi_npai_port=$row[7];
		$cgi_npai_login=$row[8];
		$cgi_npai_pass=$row[9];
		$cgi_server=$row[10];
        }
}
echo "<br><a href=\"admin.php?page=e-mailing-service/admin/setting.php&manuel=auto\" target=\"_parent\">".__("Parametre manuel")."</a>";
?>	
<form action="admin.php?page=e-mailing-service/admin/setting.php" method="post">
<input type="hidden" name="action" value="update" size="75" />
<input type="hidden" name="sm_type_envoi" value="smtp" size="75" />
<input type="hidden" name="sm_license" value="<?php echo "$licen"; ?>" size="75" />
<div class="systeme_onglets">
        <div class="onglets">
            <span class="onglet_0 onglet" id="onglet_infos" onclick="javascript:change_onglet('infos');"><?php echo __('Information','e-mailing-service'); ?></span>
            <span class="onglet_0 onglet" id="onglet_smtp" onclick="javascript:change_onglet('smtp');"><?php echo __('SMTP setting','e-mailing-service'); ?></span>
            <span class="onglet_0 onglet" id="onglet_pop3" onclick="javascript:change_onglet('pop3');"><?php echo __('POP3 Setting','e-mailing-service'); ?></span>
            <span class="onglet_0 onglet" id="onglet_user" onclick="javascript:change_onglet('user');"><?php echo __('General Setting','e-mailing-service'); ?></span>
            <span class="onglet_0 onglet" id="onglet_smtp_alert" onclick="javascript:change_onglet('smtp_alert');"><?php echo __('SMTP setting for alert','e-mailing-service'); ?></span>
        </div>
        <div class="contenu_onglets">
            <div class="contenu_onglet" id="contenu_onglet_infos">
                <h3 class="hndle"><span><?php _e('Configuration Wordress',"e-mailing-service");?></span></h3>
				<?php				
				echo "<p>".__("Plugin Version","e-mailing-service")." : ".get_option('sm_version')."</p>";				
				echo "<p>".__("Serveur OS","e-mailing-service")." : ".PHP_OS."</p>";				
				echo "<p>".__("Plugin fonctionne avec PHP Version: 5.0+","e-mailing-service")."<br>";
				echo "<p>".__("Votre version de PHP","e-mailing-service")." : " . phpversion() . "</p>";							
				echo "<p>".__("Memoire utilise","e-mailing-service")." : " . number_format(memory_get_usage()/1024/1024, 1) . " / " . ini_get('memory_limit') . "</p>";				
				echo "<p>".__("Pic utilisation de la memoire","e-mailing-service")." : " . number_format(memory_get_peak_usage()/1024/1024, 1) . " / " . ini_get('memory_limit') . "</p>";				
				$lav = sys_getloadavg();
				echo "<p>".__("Serveur Charge moyenne","e-mailing-service")." : ".$lav[0].", ".$lav[1].", ".$lav[2]."</p>";	
				echo '<p>upload_max_filesize = ' . ini_get('upload_max_filesize') . '</p>';
                echo '<p>post_max_size = ' . ini_get('post_max_size') . '</p>';
                echo '<p>memory_limit = ' . ini_get('memory_limit') . '</p>';
				include(smPATH . '/include/license.php');			
				?>

            </div>
            <div class="contenu_onglet" id="contenu_onglet_smtp">
               <h1><?php echo __('SMTP setting','e-mailing-service'); ?></h1>
<table>
<tr>
  <td><?php _e("Email de l'expediteur","e-mailing-service");?></td>
  <td><input type="text" name="sm_email_exp"  value="<?php if($manuel=='auto') { echo $cgi_smtp_login; } else { echo get_option('sm_email_exp_1'); } ?>" size="75"/></td>
</tr>
<tr>
  <td><?php _e("Email reponse","e-mailing-service");?></td>
  <td><input type="text" name="sm_email_ret" value="<?php if($manuel=='auto') { echo $cgi_smtp_login; } else { echo get_option('sm_email_ret_1'); }?>" size="75" /></td>
</tr>
<tr>
  <td><?php _e("SMTP SERVER","e-mailing-service");?></td>
  <td><input type="text" name="sm_smtp_server" value="<?php if($manuel=='auto') { echo $cgi_smtp_server; } else { echo get_option('sm_smtp_server_1'); }  ?>" size="75" /></td>
</tr>
<tr>
  <td><?php _e("Port","e-mailing-service");?></td>
  <td><input type="text" name="sm_smtp_port" value="<?php if($manuel=='auto') {  echo $cgi_smtp_port; } else { echo get_option('sm_smtp_port_1'); } ?>" size="75" /></td>
</tr>
<tr>
  <td><?php _e("Avec ou sans authentification par mot de passe","e-mailing-service");?></td>
  <td><?php if($manuel=='auto') {  $auth=$cgi_authentification; } else { $auth=get_option('sm_smtp_authentification_1'); } if($auth=='oui'){?>
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
  <td><input type="text" name="sm_smtp_login" value="<?php if($manuel=='auto') { echo $cgi_smtp_login;  } else { echo get_option('sm_smtp_login_1'); }?>" size="75" /></td>
</tr>
<tr>
  <td><?php _e("Si avec authentification precisez le mot de passe","e-mailing-service");?></td>
  <td><input type="password" name="sm_smtp_pass" value="<?php if($manuel=='auto') { echo $cgi_smtp_pass;  } else { echo get_option('sm_smtp_pass_1'); }?>" size="75" /></td>
</tr>
</table>
               
            </div>
            <div class="contenu_onglet" id="contenu_onglet_pop3">
                <h1><?php echo __('POP3 setting','e-mailing-service'); ?></h1>
<table>
<tr>
  <td><?php _e('Serveur NPAI',"e-mailing-service");?></td>
  <td><input type="text" name="sm_npai_serveur" value="<?php if($manuel=='auto') { echo $cgi_npai_server;  } else { echo get_option('sm_npai_serveur_1'); } ?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Port NPAI',"e-mailing-service");?></td>
  <td><input type="text" name="sm_npai_port" value="<?php if($manuel=='auto') { echo $cgi_npai_port;  } else { echo get_option('sm_npai_port_1'); } ?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Login NPAI',"e-mailing-service");?></td>
  <td><input type="text" name="sm_npai_login" value="<?php if($manuel=='auto') { echo $cgi_npai_login;  } else { echo get_option('sm_npai_login_1'); } ?>"    size="75" /></td>
</tr>
<tr>
  <td><?php _e('Pass NPAI',"e-mailing-service");?></td>
  <td><input type="password" name="sm_npai_pass" value="<?php if($manuel=='auto') { echo $cgi_npai_pass;  } else { echo get_option('sm_npai_pass_1'); } ?>"    size="75" /></td>
</tr>
</table>             

            </div>
               <div class="contenu_onglet" id="contenu_onglet_user">
                <h1><?php echo __('User setting','e-mailing-service'); ?></h1>
<table>
 <tr>
  <td width="290"><?php _e("Nom de l'expediteur","e-mailing-service");?> (From:)</td>
  <td width="506"><label for="nom_exp"></label>
    <input type="text" name="sm_from" value="<?php echo get_option('sm_from'); ?> "/></td>
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
</table>

            </div>
          <div class="contenu_onglet" id="contenu_onglet_smtp_alert">
               <h1><?php echo __('SMTP setting for alert','e-mailing-service'); ?></h1>
<table>
<tr>
  <td><?php _e("From","e-mailing-service");?></td>
  <td><input type="text" name="sm_from_alert"  value="<?php  echo  get_option('sm_from_alert'); ?>" size="75"/></td>
</tr>
<tr>
  <td><?php _e("Email de l'expediteur","e-mailing-service");?></td>
  <td><input type="text" name="sm_email_alert_exp"  value="<?php echo get_option('sm_email_alert_exp');  ?>" size="75"/></td>
</tr>
<tr>
  <td><?php _e("Email reponse","e-mailing-service");?></td>
  <td><input type="text" name="sm_email_alert_ret" value="<?php echo get_option('sm_email_alert_ret'); ?>" size="75" /></td>
</tr>
<tr>
  <td><?php _e("SMTP SERVER","e-mailing-service");?></td>
  <td><input type="text" name="sm_smtp_alert_server" value="<?php  echo get_option('sm_smtp_alert_server');   ?>" size="75" /></td>
</tr>
<tr>
  <td><?php _e("Port","e-mailing-service");?></td>
  <td><input type="text" name="sm_smtp_alert_port" value="<?php echo get_option('sm_smtp_alert_port');  ?>" size="75" /></td>
</tr>
<tr>
  <td><?php _e("Avec ou sans authentification par mot de passe","e-mailing-service");?></td>
  <td><?php $auth=get_option('sm_smtp_alert_authentification');  if($auth=='oui'){?>
<p><label>
    <input name="sm_smtp_alert_authentification" type="radio" id="type_envoi_0" value="oui" checked="checked" size="75" />
    <?php _e("avec authentification ?","e-mailing-service");?> <?php _e("oui","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_smtp_alert_authentification" value="non" id="type_envoi_1" size="75" /><?php _e("pas d'authentification","e-mailing-service");?></label> <br size="75" />
</p>
    <?php } else { ?>
    <p><label>
    <input name="sm_smtp_alert_authentification" type="radio" id="type_envoi_0" value="oui" size="75" />
    <?php _e("avec authentification?","e-mailing-service");?> <?php _e("oui","e-mailing-service");?></label>
  <br size="75" />
  <label>
    <input type="radio" name="sm_smtp_alert_authentification" value="non" id="type_envoi_1"  checked="checked"/><?php _e("pas d'authentification","e-mailing-service");?></label> <br size="75" />
</p>
<?php } ?> </td>
</tr>
<tr>
  <td><?php _e("Si avec authentification precisez le login","e-mailing-service");?></td>
  <td><input type="text" name="sm_smtp_alert_login" value="<?php if($manuel=='auto') { echo $cgi_smtp_login;  } else { echo get_option('sm_smtp_alert_login'); }?>" size="75" /></td>
</tr>
<tr>
  <td><?php _e("Si avec authentification precisez le mot de passe","e-mailing-service");?></td>
  <td><input type="password" name="sm_smtp_alert_pass" value="<?php if($manuel=='auto') { echo $cgi_smtp_pass;  } else { echo get_option('sm_smtp_alert_pass'); }?>" size="75" /></td>
</tr>
</table>
               
            </div>
               
        </div>
    </div>		

<br /><button  name="submit" class="button button-green" type="submit" size="75" /><?php _e("valider la configuration","e-mailing-service");?></button>
</form>	
	

<?php } ?>
</div>
<script type="text/javascript">
        //<!--
                var anc_onglet = 'infos';
                change_onglet(anc_onglet);
        //-->
</script>