
<?php
include(smPATH . '/include/entete.php');
echo "<h1>". __("Aide a l'utilisation du service","e-mailing-service")."</h1>";
extract($_GET);
if(!isset($section)){
$section='h_config';
}		
?>
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div>
	<h2 class="nav-tab-wrapper">
		<a href="?page=e-mailing-service/admin/aide.php&section=h_config" class="nav-tab <?php if ($section == 'h_config') echo 'nav-tab-active'; ?>">
			<?php _e('Aide a la Configuration',"e-mailing-service"); ?>
		</a>
		<a href="?page=e-mailing-service/admin/aide.php&section=h_email" class="nav-tab <?php if ($section == 'videos') echo 'nav-tab-active'; ?>">
			<?php _e("Aide a la gestion de vos destinataires", "e-mailing-service"); ?>
		</a>
		<a href="?page=e-mailing-service/admin/aide.php&section=h_send" class="nav-tab <?php if ($section == 'player') echo 'nav-tab-active'; ?>">
			<?php _e("Aide a l'envoi", "e-mailing-service"); ?>
		</a>
		<a href="?page=e-mailing-service/admin/aide.php&section=h_stats" class="nav-tab <?php if ($section == 'posts') echo 'nav-tab-active'; ?>">
			<?php _e('Aide a la lecture des statistiques', "e-mailing-service"); ?>
		</a>
		<a href="?page=e-mailing-service/admin/aide.php&section=h_template" class="nav-tab <?php if ($section == 'posts') echo 'nav-tab-active'; ?>">
			<?php _e("Aide a l'import de template", "e-mailing-service"); ?>
		</a>
	</h2><h2>
    <?php
	if(isset($_REQUEST['section'])){
		if ($_REQUEST['section'] == 'h_config') include(smPATH.'tuto/h_config.php');
		if ($_REQUEST['section'] == 'h_email') include(smPATH.'tuto/h_email.php');
		if ($_REQUEST['section'] == 'h_send') include(smPATH.'tuto/h_send.php');
		if ($_REQUEST['section'] == 'h_stats') include(smPATH.'tuto/h_stats.php');
		if ($_REQUEST['section'] == 'h_template') include(smPATH.'tuto/h_template.php');
	} else {
	include(smPATH.'tuto/h_config.php');	
	}
	?>
</div>