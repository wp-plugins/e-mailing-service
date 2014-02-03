<?php
/*
Plugin Name: e-mailing service
Version: 5.3
Plugin URI: http://www.e-mailing-service.net
Description: Send newsletters (emails) with wordpress. Detailed statistics AND rewritting on activation of the Free API
Author URI: http://www.e-mailing-service.net
*/
if(!function_exists('wp_get_current_user')) {
    include(ABSPATH . "wp-includes/pluggable.php"); 
}

// stop Subscribe2 being activated site wide on Multisite installs
if ( !function_exists( 'is_plugin_active_for_network' ) ) {
	require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

if ( is_plugin_active_for_network(plugin_basename(__FILE__)) ) {
	deactivate_plugins( plugin_basename(__FILE__) );
	$exit_msg = __('E-mailing service est deja installe', 'e-mailing-service');
	exit($exit_msg);
}
define( 'smVERSION', '5.3' );
define( 'smDBVERSION', '3.0' );
define( 'smPATH', trailingslashit(dirname(__FILE__)) );
define( 'smDIR', trailingslashit(dirname(plugin_basename(__FILE__))) );
define( 'smURL', plugin_dir_url(dirname(__FILE__)) . smDIR );

function sm_init() {
load_plugin_textdomain( 'e-mailing-service', false, smDIR . '/lang/' );
}
add_action('plugins_loaded', 'sm_init');

//////////////menu ///////////////////////

function register_sm_menu_page() {
   add_menu_page(__('E-mailing service', 'e-mailing-service'), __('E-mailing service', 'e-mailing-service'),  'manage_options',  smPATH . 'admin/index.php', NULL, smURL . 'include/email_edit.png');  
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Configuration SMTP', 'e-mailing-service'), __('Configuration SMTP', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/parametres.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Mass Mailing', 'e-mailing-service'), __('Mass Mailing', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/multi.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Destinataires', 'e-mailing-service'), __('Destinataires', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/listes.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Liste test', 'e-mailing-service'), __('Liste test', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/emails.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Creation Newsletter', 'e-mailing-service'), __('Creation Newsletter', 'e-mailing-service'), 'manage_options', 'post-new.php?post_type=newsletter', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Liste Newsetter', 'e-mailing-service'), __('Liste Newsetter', 'e-mailing-service'), 'manage_options',   'edit.php?post_type=newsletter', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Creation de modeles', 'e-mailing-service'), __('Creation de modeles', 'e-mailing-service'), 'manage_options',  'post-new.php?post_type=sm_modeles', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Liste Modeles', 'e-mailing-service'), __('Liste Modeles', 'e-mailing-service'), 'manage_options',  'edit.php?post_type=sm_modeles', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Import Modele', 'e-mailing-service'), __('Import modele', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/import_template.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Envois SMTP', 'e-mailing-service'), __('Envois SMTP', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/send.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Suivis', 'e-mailing-service'), __('Suivis', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/live.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Statistiques', 'e-mailing-service'), __('Statistiques', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/stats.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Statistiques SMTP', 'e-mailing-service'), __('Statistiques SMTP', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/stats_smtp.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('NPAI', 'e-mailing-service'), __('NPAI', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/npai.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Variables', 'e-mailing-service'), __('Variables', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/variables.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Blacklist', 'e-mailing-service'), __('Blacklist', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/blacklist.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Gestion des alertes', 'e-mailing-service'), __('Gestion des alertes', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/alerte.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Status SMTP', 'e-mailing-service'), __('Status SMTP', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/etat.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Aide', 'e-mailing-service'), __('Aide', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/aide.php', NULL); 
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Support', 'e-mailing-service'), __('Support', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/support.php', NULL); 
     add_submenu_page( 'e-mailing-service/admin/index.php', __('License et option', 'e-mailing-service'), __('License et options', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/configuration.php', NULL);    
   if(get_option('sm_debug')=='oui'){
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Update license', 'e-mailing-service'), __('Update license', 'e-mailing-service'), 'manage_options',  smPATH . 'include/cron_license.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Debug send', 'e-mailing-service'), __('Debug send', 'e-mailing-service'), 'manage_options',  smPATH . 'include/cron.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Debug send auto', 'e-mailing-service'), __('Debug send auto', 'e-mailing-service'), 'manage_options',  smPATH . 'include/cron_auto.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Debug bounces', 'e-mailing-service'), __('Debug bounces', 'e-mailing-service'), 'manage_options',  smPATH . 'include/bounces_update.php', NULL);
      add_submenu_page( 'e-mailing-service/admin/index.php', __('Update bounces', 'e-mailing-service'), __('Update bounces', 'e-mailing-service'), 'manage_options',  smPATH . 'include/bounces_update_liste.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Debug Blacklist', 'e-mailing-service'), __('Debug Blacklist', 'e-mailing-service'), 'manage_options',  smPATH . 'include/blacklist.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Debug alerte', 'e-mailing-service'), __('Debug alerte', 'e-mailing-service'), 'manage_options',  smPATH . 'include/cron_alerte.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Debug Vitesse', 'e-mailing-service'), __('Debug vitesse', 'e-mailing-service'), 'manage_options',  smPATH . 'include/test.php', NULL);  
   }

}

add_action('admin_menu', 'register_sm_menu_page');


	  ////////////////// post type ////////////////

add_action( 'init', 'sm_create_post_type' );
if(!function_exists('sm_create_post_type')){
function sm_create_post_type() {
	$news= array(
		'label' => __('Newsletter', 'e-mailing-service'),
        'labels' => array(
            'singular_name' => __('Newsletter', 'e-mailing-service'),
            'add_new_item' => __('Ajouter une newsletter', 'e-mailing-service'),
            'edit_item' => __('Modifier la newsletter', 'e-mailing-service'),
            'add_new' => __('Ajouter une newsletter', 'e-mailing-service'),
            'new_item' => __('Creation de newsletter', 'e-mailing-service'),
            'view_item' => __('Visualisez la newsletter', 'e-mailing-service'),
            'not_found' => __('La newsletter n\'existe plus', 'e-mailing-service'),
            'not_found_in_trash' => __('La newsletter n\'existe plus','e-mailing-service'),
            'search_items' => __('Recherche une newsletter', 'e-mailing-service'),
        ),
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'show_ui' => true,
        'capability_type' => 'post',
		'rewrite' => array('slug' => 'newsletter'),
		);
	register_post_type('newsletter', $news);
		
	$args = array(
        'label' => __('Modeles', 'e-mailing-service'),
        'labels' => array(
            'singular_name' => __('Modeles', 'e-mailing-service'),
            'add_new_item' => __('Nouveau modele', 'e-mailing-service'),
            'edit_item' => __('Modifier le modele', 'e-mailing-service'),
            'add_new' => __('Creer un modele', 'e-mailing-service'),
            'new_item' => __('Nouveau modele', 'e-mailing-service'),
            'view_item' => __('Visionner le modele', 'e-mailing-service'),
            'not_found' => __('Le modele ne fonctionne pas', 'e-mailing-service'),
            'not_found_in_trash' => __('Le modele ne fonctionne pas.','e-mailing-service'),
            'search_items' => __('Rechercher un modele', 'e-mailing-service'),
        ),
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => false,
        'show_in_nav_menus' => false,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'revisions',
            'author',
        )
    );
    register_post_type('sm_modeles', $args);
}
} 


//////////////// creation des bases //////////////////////////////

function sm_mailing_install()  
{  
    global $wpdb;  
    $table_name = $wpdb->prefix.'sm_liste_test';
	$table_temps = $wpdb->prefix.'sm_temps';
	$table_liste = $wpdb->prefix.'sm_liste';  
	$table_log = $wpdb->prefix.'sm_log';
	$table_log_bounces = $wpdb->prefix.'sm_bounces_log';
	$table_stats_smtp = $wpdb->prefix.'sm_stats_smtp';
	$table_blacklist = $wpdb->prefix.'sm_blacklist';
	$table_spamscore = $wpdb->prefix.'sm_spamscore';
	$table_suite = $wpdb->prefix.'sm_suite';
	$table_bounces_hard = $wpdb->prefix.'sm_bounces_hard';
    $table_envoi_name = $wpdb->prefix.'sm_historique_envoi';  
 
    $wpdb->query("CREATE TABLE IF NOT EXISTS `$table_envoi_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_newsletter` int(11) NOT NULL,
  `id_liste` int(11) NOT NULL,
  `date_envoi` datetime NOT NULL,
  `date_demarrage` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `pause` varchar(250) NOT NULL DEFAULT '10',
  `status` enum('En attente','En cours','Terminer','Limite','pause','reactiver','stop','erreur_flux','erreur_license') NOT NULL DEFAULT 'En attente',
  `nb_envoi` int(11) NOT NULL,
  `nb_attente` int(11) NOT NULL,
  `type` enum('newsletter','post','page') NOT NULL DEFAULT 'newsletter',
  `track1` varchar(250) NOT NULL,
  `track2` varchar(250) NOT NULL,
  `serveur` varchar(250) NOT NULL DEFAULT 'auto',
  `mode` ENUM('text/plain','text/html') NOT NULL DEFAULT 'text/html',
  PRIMARY KEY (`id`),
  KEY `id_newsletter` (`id_newsletter`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;
"); 
  
  $wpdb->query("CREATE TABLE IF NOT EXISTS `$table_blacklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(250) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `blacklist` varchar(250) NOT NULL,
  `lien` varchar(250) NOT NULL,
  `delist` varchar(250) NOT NULL,
  `details` longtext NOT NULL,
  `type` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `black` (`ip`,`blacklist`),
  KEY `date` (`date`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;");

  $wpdb->query("CREATE TABLE IF NOT EXISTS `$table_spamscore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(250) NOT NULL,
  `smtp` varchar(250) NOT NULL,
  `spamscore` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` (`ip`,`smtp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;");

   $wpdb->query( "  
   CREATE TABLE IF NOT EXISTS `$table_liste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `liste_bd` varchar(250) NOT NULL,
  `liste_nom` varchar(250) NOT NULL,
  `champs1` varchar(250) NOT NULL,
  `champs2` varchar(250) NOT NULL,
  `champs3` varchar(250) NOT NULL,
  `champs4` varchar(250) NOT NULL,
  `champs5` varchar(250) NOT NULL,
  `champs6` varchar(250) NOT NULL,
  `champs7` varchar(250) NOT NULL,
  `champs8` varchar(250) NOT NULL,
  `champs9` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `liste_bd` (`liste_bd`),
  KEY `liste_nom` (`liste_nom`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;   
"); 
 
        $wpdb->query("  
   CREATE TABLE IF NOT EXISTS `$table_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL DEFAULT '',
  `nom` varchar(250) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `lg` varchar(250) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `valide` enum('1','0') NOT NULL DEFAULT '1' COMMENT 'Si le client c''est desinscrit la valeur est 0',
  `bounces` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'Si l ''email n''est plus correct la valeur passe Ã  0',
  `optin` enum('0','1') NOT NULL DEFAULT '0',
  `champs1` varchar(250) NOT NULL,
  `champs2` varchar(250) NOT NULL,
  `champs3` varchar(250) NOT NULL,
  `champs4` varchar(250) NOT NULL,
  `champs5` varchar(250) NOT NULL,
  `champs6` varchar(250) NOT NULL,
  `champs7` varchar(250) NOT NULL,
  `champs8` varchar(250) NOT NULL,
  `champs9` varchar(250) NOT NULL,
  `cle` varchar(250) NOT NULL DEFAULT 'Hysmqponisgz564',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `valide` (`valide`),
  KEY `bounces` (`bounces`),
  KEY `cle` (`cle`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;");  

 
   $wpdb->query("CREATE TABLE IF NOT EXISTS `$table_temps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL DEFAULT '',
  `nom` varchar(250) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `lg` varchar(250) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `champs1` varchar(250) NOT NULL,
  `champs2` varchar(250) NOT NULL,
  `champs3` varchar(250) NOT NULL,
  `champs4` varchar(250) NOT NULL,
  `champs5` varchar(250) NOT NULL,
  `champs6` varchar(250) NOT NULL,
  `champs7` varchar(250) NOT NULL,
  `champs8` varchar(250) NOT NULL,
  `champs9` varchar(250) NOT NULL,
  `hie` int(11) NOT NULL,
  `status` enum('pause','actif') NOT NULL DEFAULT 'actif',
  `cle` varchar(250) NOT NULL DEFAULT 'Hysmqponisgz564',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`,`hie`),
  KEY `cle` (`cle`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;"); 

          $wpdb->query("CREATE TABLE IF NOT EXISTS `$table_suite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL DEFAULT '',
  `nom` varchar(250) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `lg` varchar(250) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `champs1` varchar(250) NOT NULL,
  `champs2` varchar(250) NOT NULL,
  `champs3` varchar(250) NOT NULL,
  `champs4` varchar(250) NOT NULL,
  `champs5` varchar(250) NOT NULL,
  `champs6` varchar(250) NOT NULL,
  `champs7` varchar(250) NOT NULL,
  `champs8` varchar(250) NOT NULL,
  `champs9` varchar(250) NOT NULL,
  `hie` int(11) NOT NULL,
  `status` enum('pause','actif') NOT NULL DEFAULT 'actif',
  `cle` varchar(250) NOT NULL DEFAULT 'Hysmqponisgz564',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`,`hie`),
  KEY `cle` (`cle`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;"); 

$wpdb->query("CREATE TABLE IF NOT EXISTS `$table_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `nb_envoi` int(11) NOT NULL,
  `hie` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `date` (`date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;"); 


$wpdb->query("CREATE TABLE IF NOT EXISTS `$table_log_bounces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idb` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `fai` varchar(250) NOT NULL,
  `rules_cat` varchar(250) NOT NULL,
  `rules_no` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `subject` longtext NOT NULL,
  `bounce_type` varchar(250) NOT NULL,
  `diag_code` varchar(250) NOT NULL,
  `dsn_message` longtext NOT NULL,
  `dsn_report` longtext NOT NULL,
  `date_insert` varchar(250) NOT NULL,
  `update` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`,`date_insert`),
  KEY `idb` (`idb`,`fai`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ; "); 

$wpdb->query("CREATE TABLE IF NOT EXISTS `$table_bounces_hard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `update` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;"); 


$wpdb->query("CREATE TABLE IF NOT EXISTS `$table_stats_smtp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `nb_envoi` int(11) NOT NULL,
  `nb_reception` int(11) NOT NULL,
  `code_250` int(11) NOT NULL,
  `deferred` int(11) NOT NULL,
  `bounces` int(11) NOT NULL,
  `code_421` int(11) NOT NULL,
  `code_422` int(11) NOT NULL,
  `code_450` int(11) NOT NULL,
  `code_452` int(11) NOT NULL,
  `code_454` int(11) NOT NULL,
  `code_503` int(11) NOT NULL,
  `code_510` int(11) NOT NULL,
  `code_511` int(11) NOT NULL,
  `code_520` int(11) NOT NULL,
  `code_521` int(11) NOT NULL,
  `code_530` int(11) NOT NULL,
  `code_550` int(11) NOT NULL,
  `code_552` int(11) NOT NULL,
  `code_553` int(11) NOT NULL,
  `code_564` int(11) NOT NULL,
  `code_570` int(11) NOT NULL,
  `smtp` varchar(250) NOT NULL,
  `ip` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date_2` (`date`,`smtp`,`ip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;"); 
 
 $total = $wpdb->get_var("
    SELECT COUNT(id)
    FROM ".$table_name."
");
if($total==0){
       $wpdb->insert($table_name, array(  
            'email' => get_option('admin_email'),  
            'nom' => get_option('blogname'),
			'ip' => $_SERVER['REMOTE_ADDR'],
			'lg' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
            'date_creation' => current_time('mysql'),//attention au type de db  
       ));
	   
	   $wpdb->insert($table_liste, array(  
            'liste_bd' => $table_name,  
            'liste_nom' => 'test',
       ));  
	  	
	@chmod("".smPATH."post/", 0777); 
}

/////////////////////// creation des options //////////////////////////

add_option('sm_version',smVERSION); 
add_option('sm_db_version',smDBVERSION); 
add_option('sm_login',str_replace("www.","",$_SERVER['HTTP_HOST'])); 
add_option('sm_type_envoi','smtp');
add_option('sm_serveur', 'srv-free');

add_option('sm_txt_haut','<center><a href="[lien_page]">'.__("Lire le mail dans votre navigateur","e-mailing-service").'</a></center>');
add_option('sm_txt_bas','<center><h5>'.__("Veuillez ne pas repondre a cet email. Cette boite aux lettres n'etant pas consultee, vous ne recevrez aucune reponse.</h5>
<h5>Pour ne plus recevoir d\'email","e-mailing-service").', <a href="[lien_desabo]">'.__("il suffit de cliquez ICI","e-mailing-service").'</a>.</h5></center>');
add_option('sm_txt_affiliation','<center><pre>'.__("Service de routage d'email fournit par","e-mailing-service").' <a href="[lien_affiliation]" title="'.__("service de routage de mail","e-mailing-service").'">www.e-mailing-service.net</a></pre></center>');
add_option('sm_affiche_txt_haut','oui');
add_option('sm_affiche_txt_bas','oui');
add_option('sm_affiche_txt_affiliation','oui');
//v1

add_option('sm_email_exp', get_option('admin_email'));
add_option('sm_email_ret', get_option('admin_email'));
add_option('sm_from', get_option('blogname'));
add_option('sm_smtp_server','smtp.'.get_option('blogurl').'');
add_option('sm_smtp_authentification','non');
add_option('sm_smtp_port','25');
add_option('sm_smtp_login','');
add_option('sm_smtp_pass','');
add_option('sm_npai_serveur','');
add_option('sm_npai_port','110');
add_option('sm_npai_login','');
add_option('sm_npai_pass','');
//pour la v2
add_option('sm_email_exp_1', get_option('admin_email'));
add_option('sm_email_ret_1', get_option('admin_email'));
add_option('sm_from_1', get_option('blogname'));
add_option('sm_smtp_server_1','smtp.'.get_option('blogurl').'');
add_option('sm_smtp_authentification_1','non');
add_option('sm_smtp_port_1','25');
add_option('sm_smtp_login_1','');
add_option('sm_smtp_pass_1','');
add_option('sm_npai_serveur_1','');
add_option('sm_npai_port_1','110');
add_option('sm_npai_login_1','');
add_option('sm_npai_pass_1','');
///
add_option('sm_debug','non');
add_option('sm_charset','UTF-8');
add_option('sm_champs_nom','nom');
add_option('sm_auto','yes');
add_option('sm_auto_id_liste','1');
add_option('sm_auto_pause','1');
add_option('sm_script_pause','non');
add_option('sm_license','free');
add_option('sm_nbl','720');
add_option('sm_nbm','10000');
add_option('sm_bounces','non');
add_option('sm_blacklist','non');
add_option('sm_service_blacklist','non');
add_option('sm_alerte','oui');
add_option('sm_stats_smtp','non');
add_option('sm_alias','non');
add_option('sm_companyname',get_option('blogname'));
add_option('sm_companyadresse','adresse 58624 ville');
add_option('sm_telephone','Tel: 00 00 00 00 00');
add_option('sm_fax','Fax : 00 00 00 00 00');
add_option('sm_link_facebook','http://www.facebook.com');
add_option('sm_link_google','http://www.google.com');
add_option('sm_link_twitter','http://www.twitter.com');
add_option('sm_link_linkedin','http://www.linkedin.com');
add_option('sm_tracking','');
//pour les alertes
add_option('sm_alerte','oui');
add_option('sm_alerte_email',get_option('admin_email'));
add_option('sm_alerte_nl_cours','non');
add_option('sm_alerte_nl_fin','non');
add_option('sm_alerte_inscrit','non');
add_option('sm_alerte_blacklist','non');
add_option('sm_alerte_smtp','non');
add_option('sm_alerte_stats','non');
//pour la desinscription
add_option('sm_udp_titre',__('Gestion liste de diffusion','e-mailing-service'));
add_option('sm_udp_details',__('Si vous ne voulez plus recevoir des emails de notre part , valider le formulaire.<br>Vous ne recevrez plus aucun email de cette liste de diffusion.','e-mailing-service'));
add_option('sm_udp_bouton',__('Je confirme ma desinscription','e-mailing-service'));
add_option('sm_udp_merci',__('Vous etes bien desinscrit , vous ne recevrez plus d\'email de notre liste de diffusion','e-mailing-service'));
//pour le widget
add_option('sm_wiget_titre','sm_widget_titre');
add_option('sm_widget_demande_nom','oui');
add_option('sm_widget_demande_4','non');
add_option('sm_widget_demande_5','non');
add_option('sm_widget_demande_6','non');
add_option('sm_widget_demande_7','non');
add_option('sm_widget_demande_8','non');
add_option('sm_widget_demande_9','non');
add_option('sm_widget_demande_10','non');
add_option('sm_widget_demande_11','non');
add_option('sm_widget_demande_12','non');

	
		if(!get_option('sm_post_id_auto')) {
		global $current_user;
        get_currentuserinfo();
		$modele_default1=file_get_contents(''.smURL.'/include/modele_default.txt');
        $modele_default=str_replace("[url]",smURL,$modele_default1);
		$modele_default=str_replace("e-mailing-service//post/","e-mailing-service/post/", $modele_default);
		$page_modele = array( 'post_title'     => ''.__('Modele automatique').'',
                   'post_type'      => 'sm_modeles',
                   'post_name'      => 'modele-auto',
                   'post_content'   => $modele_default,
                   'post_status'    => 'publish',
                   'comment_status' => 'closed',
                   'ping_status'    => 'closed',
                   'post_author'    => $current_user->ID,
                   'menu_order'     => 0,
				   'tags_input'  => 'modele-auto'
                   );

       $PageID = wp_insert_post( $page_modele, TRUE );
       add_option('sm_post_id_auto',$PageID); 
		}
		if(!get_option('sm_post_id_auto2')) {
		global $current_user;
        get_currentuserinfo();
	   	$modele_default_news=file_get_contents(''.smURL.'/include/modele_news_default.txt');
		$page_modele_news = array( 'post_title'     => ''.__('Test shortcode pour mr [nom]').'',
                   'post_type'      => 'newsletter',
                   'post_name'      => 'modele-news',
                   'post_content'   => $modele_default_news,
                   'post_status'    => 'publish',
                   'comment_status' => 'closed',
                   'ping_status'    => 'closed',
                   'post_author'    => $current_user->ID,
                   'menu_order'     => 0,
				   'tags_input'  => 'modele-news'
                   );

       $PageID2 = wp_insert_post( $page_modele_news, TRUE );
       add_option('sm_post_id_auto2',$PageID2); 
       }
	   
		
}
register_activation_hook(__FILE__, 'sm_mailing_install'); 

//reecriture des liens


add_action('init','sm_rule_init');
if(!function_exists('sm_rule_init')){
function sm_rule_init() {
  global $wp,$wp_rewrite; 
  $wp->add_query_var('smlink');
  $wp->add_query_var('smemail');
  $wp->add_query_var('smdate');
  $wp->add_query_var('smhie');
  $wp->add_query_var('smnum');
  $wp->add_query_var('smaction');
  $wp->add_query_var('smfree');
  $wp->add_query_var('smidmp');
  $wp->add_query_var('smidmd');
  $wp->add_query_var('smcle');
  $wp_rewrite->add_rule('^out/(.*)/(.*)/(.*)/(.*)/(.*)/?','index.php?smlink=$matches[1]&smdate=$matches[2]&smemail=$matches[3]&smnum=$matches[4]&smcle=$matches[5]', 'top');
  $wp_rewrite->add_rule('^outp/(.*)/(.*)/(.*)/(.*)/(.*)/?','index.php?smlink=$matches[1]&smdate=$matches[2]&smidmp=$matches[3]&smnum=$matches[4]&smcle=$matches[5]', 'top');
  $wp_rewrite->add_rule('^outd/(.*)/(.*)/(.*)/(.*)/(.*)/?','index.php?smlink=$matches[1]&smdate=$matches[2]&smidmd=$matches[3]&smnum=$matches[4]&smcle=$matches[5]', 'top');
  $wp_rewrite->add_rule('^upd/(.*)/(.*)/(.*)/?','index.php?smemail=$matches[1]&smhie=$matches[2]&smcle=$matches[3]', 'top');
  $wp_rewrite->flush_rules();
}
}
//template newsletter

add_filter( 'template_include', 'sm_template' );
if(!function_exists('sm_template')){
function sm_template( $template ) { 
global $wp_query;      
$post_id = get_the_ID();       
  if ( get_post_type( $post_id ) == 'newsletter' ) 
  {        
  $file = smPATH . '/template.php'; 
   add_filter('edit_post_link', 'wpse_remove_edit_post_link');
   add_filter( 'the_title', 'remove_page_title' );  
  }    
   elseif ( get_post_type( $post_id ) == 'sm_modeles' ) 
  {        
  $file = smPATH . '/template.php'; 
   add_filter('edit_post_link', 'wpse_remove_edit_post_link');
   add_filter( 'the_title', 'remove_page_title' );  
  } 
  elseif(isset($wp_query->query_vars['smhie']) && !isset($wp_query->query_vars['action']))
  {        
  $file = smPATH . '/unsuscribe.php'; 
   add_filter('edit_post_link', 'wpse_remove_edit_post_link');
   add_filter( 'the_title', 'remove_page_title' );  
  }
  elseif(isset($wp_query->query_vars['action']))
  {        
  $file = smPATH . '/unsuscribe.php'; 
   add_filter('edit_post_link', 'wpse_remove_edit_post_link');
   add_filter( 'the_title', 'remove_page_title' );  
  } 
  else {        
  $file = $template;    
  } 
  return apply_filters( 'sm_template_newsletter' . $template, $file ); 
}
}

if(!function_exists('wpse_remove_edit_post_link')){
function wpse_remove_edit_post_link( $link ) {
 return '';
 }
}
if(!function_exists('remove_page_title')){
function remove_page_title() {
   return '';
}
}


if(!function_exists('sm_remove_menus')){
function sm_remove_menus () {
global $menu;
                $restricted = array(__('Newsletter'), __('Modeles'), __('Templates'), __('sm_modeles'));
                end ($menu);
                while (prev($menu)){
                        $value = explode(' ',$menu[key($menu)][0]);
                        if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
                }
}
}
add_action('admin_menu', 'sm_remove_menus');

if(!function_exists('sm_css_admin_head')){
function sm_css_admin_head(){
echo '<link rel="stylesheet" href="'.smURL.'sm.css" type="text/css" media="all" >';
}
add_action('admin_head', 'sm_css_admin_head');
}

///desinscrit ////



add_filter('wp_head', 'sm_head' );
if(!function_exists('sm_head')){
function sm_head() {
   global $wp_query;
  if(isset($wp_query->query_vars['smlink']) && !isset($wp_query->query_vars['smidmp']) && !isset($wp_query->query_vars['smidmd'])){
  $_SESSION["sm_hie"]=$wp_query->query_vars['smnum'];
  $_SESSION["sm_cle"]=$wp_query->query_vars['smcle'];
  echo sm_stats();
  }
  elseif(isset($wp_query->query_vars['smlink']) && isset($wp_query->query_vars['smidmp']) && !isset($wp_query->query_vars['smidmd'])){
  $_SESSION["sm_emailid"]=$wp_query->query_vars['smidmp'];
  $_SESSION["sm_hie"]=$wp_query->query_vars['smnum'];
  $_SESSION["sm_cle"]=$wp_query->query_vars['smcle'];
  echo sm_stats_page();  
  }
  elseif(isset($wp_query->query_vars['smlink']) && !isset($wp_query->query_vars['smidmp']) && isset($wp_query->query_vars['smidmd'])){
  $_SESSION["sm_emailid"]=$wp_query->query_vars['smidmd'];
  $_SESSION["sm_hie"]=$wp_query->query_vars['smnum'];
  $_SESSION["sm_cle"]=$wp_query->query_vars['smcle'];
	echo sm_stats_desinscrit();  
  }
global $wpdb;
echo @get_option("sm_tracking");
}
}
if(!function_exists('sm_stats')){
function sm_stats(){
global $wp_query;
$smlink= $wp_query->query_vars['smlink'];
$smemail= $wp_query->query_vars['smemail'];
$smdate= $wp_query->query_vars['smdate'];
$smnum= $wp_query->query_vars['smnum'];
$smcle= $wp_query->query_vars['smcle'];
if($smcle !=' '){
update_optin($smnum,$smemail,$smcle);
} else {
update_optin($smnum,$smemail);
}
$email=affiche_mail($smnum,$smemail);
	    $host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);
		$array =array (
		"domaine_client" => $host,
		"l" => $smlink,
		"smemail" => $email,
		"smcle" => $smcle,
		"smdate" => $smdate	
		); 		
  return xml_server_stats('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats.php',$array);
}
}
if(!function_exists('sm_stats_page')){
function sm_stats_page(){
global $wp_query;
$smlink= $wp_query->query_vars['smlink'];
$smidmp= $wp_query->query_vars['smidmp'];
$smdate= $wp_query->query_vars['smdate'];
$smnum= $wp_query->query_vars['smnum'];
$smcle= $wp_query->query_vars['smcle'];
if($smcle !=' '){
update_optin($smnum,$smidmp,$smcle);
} else {
update_optin($smnum,$smidmp);
}
$email=affiche_mail($smnum,$smemailid);
	    $host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);
		$array =array (
		"domaine_client" => $host,
		"l" => $smlink,
		"action" => "page",
		"smidmp" => $smidmp,
		"smcle" => $smcle,
		"smdate" => $smdate	
		); 		
  return xml_server_stats('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats.php',$array);
}
}
if(!function_exists('sm_stats_desinscrit')){
function sm_stats_desinscrit(){
global $wp_query;
$smlink= $wp_query->query_vars['smlink'];
$smidmd= $wp_query->query_vars['smidmd'];
$smdate= $wp_query->query_vars['smdate'];
$smnum= $wp_query->query_vars['smnum'];
$smcle= $wp_query->query_vars['smcle'];
if($smcle !=' '){
update_optin($smnum,$smidmp,$smcle);
} else {
update_optin($smnum,$smidmp);
}
$email=affiche_mail($smnum,$smemailid);
	    $host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);
		$array =array (
		"domaine_client" => $host,
		"l" => $smlink,
		"action" => "desinscrit",
		"smidmd" => $smidmd,
		"smemail" => $smidmd,
		"smcle" => $smcle,
		"smdate" => $smdate	
		); 		
  return xml_server_stats('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats.php',$array);
}
}
if(!function_exists('xml_server_stats')){
function xml_server_stats($url,$array){	   
	   $flux1= xml_server_api($url,$array);
       $xml2l =post_xml_data(addslashes($flux1),'item',array('resultat','lien'));
		if($xml2l ==''){
		   header('Location: '.get_option("blog_url").'');
		   exit();	
		}
		foreach($xml2l as $row) {
		if($row[0] == 1)
		{
	            if(!headers_sent()) {
	            wp_redirect( $row[1] );
                exit();
                } else {
                echo '<meta http-equiv="refresh" content="0; url='.$row[1].'">';
	            exit();
                }		
		} else {
		   header('Location: '.get_option("blog_url").'');
		   exit();					
		}
		}
}
}
/////SMTP //////
function sm_smtp_choix($phpmailer){
	global $wdpd;
	$num=$_SESSION['sm_choix'];
	//session pour debug//
	$_SESSION['sm_smtp_actif']= '##'.get_option('sm_smtp_actif_'.$num.'').'##';
	$_SESSION['sm_smtp_server']= '##'.get_option('sm_smtp_server_'.$num.'').'##';
	$_SESSION['sm_from']= '##'.get_option('sm_from_'.$num.'').'##';
	$_SESSION['sm_email_exp']= '##'.get_option('sm_email_exp_'.$num.'').'##';
	$_SESSION['sm_email_ret']= '##'.get_option('sm_email_ret_'.$num.'').'##';
	$_SESSION['sm_smtp_port']= '##'.get_option('sm_smtp_port_'.$num.'').'##';
	$_SESSION['sm_smtp_authentification']= '##'.get_option('sm_smtp_authentification_'.$num.'').'##';
	$_SESSION['sm_smtp_login']= '##'.get_option('sm_smtp_login_'.$num.'').'##';
	$_SESSION['sm_smtp_pass']= '##'.get_option('sm_smtp_pass_'.$num.'').'##';
	$phpmailer->Sender = get_option('sm_email_exp_'.$num.'');
	$phpmailer->From = get_option('sm_email_exp_'.$num.'');
	$phpmailer->FromName = get_option('sm_from_'.$num.'');
	$phpmailer->AddReplyTo = get_option('sm_email_ret_'.$num.'');
	$phpmailer->Host = get_option('sm_smtp_server_'.$num.'');
	$phpmailer->Port = get_option('sm_smtp_port_'.$num.'');
	$phpmailer->SMTPAuth = (get_option('sm_smtp_authentification_'.$num.'')=="oui") ? TRUE : FALSE;
	if($phpmailer->SMTPAuth){
		$phpmailer->Username =  get_option('sm_smtp_login_'.$num.'');
		$phpmailer->Password = get_option('sm_smtp_pass_'.$num.'');
	}
	$phpmailer->IsSMTP();
    if(get_option('sm_debug')=="oui")
    {
            $phpmailer->SMTPDebug = 2;
            $phpmailer->debug     = 1;


    //print htmlspecialchars( var_export( $phpmailer, true ) );
   
    $error = null;
    try
    {
        $sent = $phpmailer->Send();
        ! $sent AND $error = new WP_Error( 'phpmailerError', $sent->ErrorInfo );
    }
    catch ( phpmailerException $e )
    {
        $error = new WP_Error( 'phpmailerException', $e->errorMessage() );
    }
    catch ( Exception $e )
    {
        $error = new WP_Error( 'defaultException', $e->getMessage() );
    }

    if ( is_wp_error( $error ) )
        return printf(
            "%s: %s",
            $error->get_error_code(),
            $error->get_error_message()
        );
	}
	

}

function sm_smtp_multi($phpmailer){
	global $wdpd;
	//fix_phpmailer_messageid( $phpmailer );
	if(!isset($_SESSION['sm_license'])){
	$_SESSION['sm_license']=get_option('sm_license');
    }
    if($_SESSION['sm_license'] == 'mass-mailing' || $_SESSION['sm_license'] == 'api_mass-mailing' ){
	if(isset($_SESSION['sm_num'])){
	$num=$_SESSION['sm_num']+1;
	$_SESSION['sm_num']=$num;	
	}
	else {
	$_SESSION['sm_num']=1;
	$num=$_SESSION['sm_num'];	
	}
	if(get_option('sm_smtp_actif_'.$num.'')=="non"){
	$num=$_SESSION['sm_num']+1;
	$_SESSION['sm_num']=$num;		
	}
	if($num > get_option('sm_multi_nb')){
	$_SESSION['sm_num']=1;
	$num=$_SESSION['sm_num'];
	}
	for($i=1;$i<get_option('sm_multi_nb')+1;$i++){
	if(get_option('sm_smtp_actif_'.$num.'')=="non"){
	$num=$_SESSION['sm_num']+1;
	$_SESSION['sm_num']=$num;		
	}
    }
	//session pour debug//
	$_SESSION['sm_smtp_actif']= '##'.get_option('sm_smtp_actif_'.$num.'').'##';
	$_SESSION['sm_smtp_server']= '##'.get_option('sm_smtp_server_'.$num.'').'##';
	$_SESSION['sm_from']= '##'.get_option('sm_from_'.$num.'').'##';
	$_SESSION['sm_email_exp']= '##'.get_option('sm_email_exp_'.$num.'').'##';
	$_SESSION['sm_email_ret']= ''.get_option('sm_email_ret_'.$num.'').'';
	$_SESSION['sm_smtp_port']= '##'.get_option('sm_smtp_port_'.$num.'').'##';
	$_SESSION['sm_smtp_authentification']= '##'.get_option('sm_smtp_authentification_'.$num.'').'##';
	$_SESSION['sm_smtp_login']= '##'.get_option('sm_smtp_login_'.$num.'').'##';
	$_SESSION['sm_smtp_pass']= '##'.get_option('sm_smtp_pass_'.$num.'').'##';
	$phpmailer->Sender = get_option('sm_email_exp_'.$num.'');
	$phpmailer->From = get_option('sm_email_exp_'.$num.'');
	$phpmailer->FromName = get_option('sm_from_'.$num.'');
	$phpmailer->AddReplyTo = get_option('sm_email_ret_'.$num.'');
	$phpmailer->Host = get_option('sm_smtp_server_'.$num.'');
	$phpmailer->Port = get_option('sm_smtp_port_'.$num.'');
	$phpmailer->SMTPAuth = (get_option('sm_smtp_authentification_'.$num.'')=="oui") ? TRUE : FALSE;
	if($phpmailer->SMTPAuth){
		$phpmailer->Username =  get_option('sm_smtp_login_'.$num.'');
		$phpmailer->Password = get_option('sm_smtp_pass_'.$num.'');
	}
	
	} else {
	//session pour debug//
	$_SESSION['sm_num']=1;
	$_SESSION['sm_smtp_server']= '##'.get_option('sm_smtp_server').'##';
	$_SESSION['sm_from']= '##'.get_option('sm_from').'##';
	$_SESSION['sm_email_exp']= '##'.get_option('sm_email_exp').'##';
	$_SESSION['sm_smtp_port']= '##'.get_option('sm_smtp_port').'##';
	$_SESSION['sm_smtp_authentification']= '##'.get_option('sm_smtp_authentification').'##';
	$_SESSION['sm_smtp_login']= '##'.get_option('sm_smtp_login').'##';
	$_SESSION['sm_smtp_pass']= '##'.get_option('sm_smtp_pass').'##';
	$_SESSION['sm_email_ret']= ''.get_option('sm_email_ret').'';
	$phpmailer->Sender = get_option('sm_email_exp');
	$phpmailer->From = get_option('sm_email_exp');
	$phpmailer->FromName = get_option('sm_from');
	$phpmailer->AddReplyTo = get_option('sm_email_ret');
	$phpmailer->Host = get_option('sm_smtp_server');
	$phpmailer->Port = get_option('sm_smtp_port');
	$phpmailer->SMTPAuth = (get_option('sm_smtp_authentification')=="oui") ? TRUE : FALSE;
	if($phpmailer->SMTPAuth){
		$phpmailer->Username = get_option('sm_smtp_login');
		$phpmailer->Password = get_option('sm_smtp_pass');
	}	
	}
	//$phpmailer->XPriority = '';
	//$phpmailer->XMailer = '';
	$phpmailer->IsSMTP();
    if(get_option('sm_debug')=="oui")
    {
            $phpmailer->SMTPDebug = 2;
            $phpmailer->debug     = 1;


    //print htmlspecialchars( var_export( $phpmailer, true ) );
   
    $error = null;
    try
    {
        $sent = $phpmailer->Send();
        ! $sent AND $error = new WP_Error( 'phpmailerError', $sent->ErrorInfo );
    }
    catch ( phpmailerException $e )
    {
        $error = new WP_Error( 'phpmailerException', $e->errorMessage() );
    }
    catch ( Exception $e )
    {
        $error = new WP_Error( 'defaultException', $e->getMessage() );
    }

    if ( is_wp_error( $error ) )
        return printf(
            "%s: %s",
            $error->get_error_code(),
            $error->get_error_message()
        );
	}

}


////////cron ////////////////
add_filter('cron_schedules', 'minutes');
if(!file_exists('minutes')){
function minutes( $schedules )
{
    $schedules['minutes'] = array(
        'interval' => 180,
        'display' => __('Toutes les 3 mn')
    );
    return $schedules;
}
}
register_activation_hook(__FILE__, 'sm_crons');
function sm_crons() {
    wp_schedule_event(time(), 'minutes', 'sm_crons');
}
register_deactivation_hook(__FILE__, 'sm_cron_unschedule');
function sm_cron_unschedule() {
    $timestamp = wp_next_scheduled('sm_crons');
    wp_unschedule_event($timestamp, 'sm_crons');
    wp_clear_scheduled_hook('sm_crons');
}

//tous les 15 minutes
add_filter('cron_schedules', 'minutes15');
function minutes15( $schedules )
{
    $schedules['minutes15'] = array(
        'interval' => 900,
        'display' => __('Toutes les 15 mn')
    );
    return $schedules;
}
register_activation_hook(__FILE__, 'sm_crons15');
function sm_crons15() {
    wp_schedule_event(time(), 'minutes15', 'sm_crons15');
}
register_deactivation_hook(__FILE__, 'sm_cron_unschedule15');
function sm_cron_unschedule15() {
    $timestamp = wp_next_scheduled('sm_crons15');
    wp_unschedule_event($timestamp, 'sm_crons15');
    wp_clear_scheduled_hook('sm_crons15');
}
// toutes les heures
add_filter('cron_schedules', 'heure1');
function heure1( $schedules )
{
    $schedules['heure1'] = array(
        'interval' => 3600,
        'display' => __('Toutes les heures')
    );
    return $schedules;
}
function sm_crons_heure1() {
    wp_schedule_event(time(), 'heure1', 'sm_crons_heure1');
}
register_activation_hook(__FILE__, 'sm_crons_heure1');

register_deactivation_hook(__FILE__, 'sm_cron_unschedule_heure1');
function sm_cron_unschedule_heure1() {
    $timestamp = wp_next_scheduled('sm_crons_heure1');
    wp_unschedule_event($timestamp, 'sm_crons_heure1');
    wp_clear_scheduled_hook('sm_crons_heure1');
}
// toutes les 4 heures 
add_filter('cron_schedules', 'heures4');
function heures4( $schedules )
{
    $schedules['heures4'] = array(
        'interval' => 14400,
        'display' => __('Toutes les 4 heures')
    );
    return $schedules;
}
function sm_crons_heures4() {
    wp_schedule_event(time(), 'heures4', 'sm_crons_heures4');
}
register_activation_hook(__FILE__, 'sm_crons_heures4');

register_deactivation_hook(__FILE__, 'sm_cron_unschedule_heures4');
function sm_cron_unschedule_heures4() {
    $timestamp = wp_next_scheduled('sm_crons_heures4');
    wp_unschedule_event($timestamp, 'sm_crons_heures4');
    wp_clear_scheduled_hook('sm_crons_heures4');
}
// tous les jours
add_filter('cron_schedules', 'jours1');
function jours1( $schedules )
{
    $schedules['jours1'] = array(
        'interval' => 84600,
        'display' => __('Tous les jours')
    );
    return $schedules;
}
function sm_crons_jours1() {
    wp_schedule_event(time(), 'jours1', 'sm_crons_jours1');
}
register_activation_hook(__FILE__, 'sm_crons_jours1');

register_deactivation_hook(__FILE__, 'sm_cron_unschedule_jours1');
function sm_cron_unschedule_jours1() {
    $timestamp = wp_next_scheduled('sm_crons_jours1');
    wp_unschedule_event($timestamp, 'sm_crons_jours1');
    wp_clear_scheduled_hook('sm_crons_jours1');
}









function action_cron_minutes() 
{
//include(''.smPATH.'/include/cron.php');
sm_cron_fichier('/include/cron.php');
sm_cron_fichier('/include/cron_auto.php');
//
}
add_action('sm_crons', 'action_cron_minutes');

function action_cron15()
{
sm_cron_fichier('/include/cron_blocage.php');
sm_cron_fichier('/include/bounces.php');
}
add_action('sm_crons15', 'action_cron15');

function action_cron_heure()
{
sm_cron_fichier('/include/bounces_delete.php');
}
add_action('sm_crons_heure1', 'action_cron_heure');

function action_cron_heure4()
{
sm_cron_fichier('/include/blacklist.php');
sm_cron_fichier('/include/spamscore.php');
sm_cron_fichier('/include/bounces_update.php');
sm_cron_fichier('/include/bounces_update_liste.php');
}
add_action('sm_crons_heures4', 'action_cron_heure4');

function action_cron24()
{
sm_cron_fichier('/include/bounces_delete.php');
sm_cron_fichier('/include/cron_license.php');
}
add_action('sm_crons_jours1', 'action_cron24');




if(!function_exists('sm_cron_fichier')){
function sm_cron_fichier($fichier)
{
include(''.smPATH.''.$fichier.'');
}
}


//post
	function sm_meta_init() {
		add_meta_box('sm', __('Envoyer un email a votre liste de destinataires avec le lien de la page', 'e-mailing-service' ),'sm_meta_box', 'post', 'advanced');
		add_meta_box('sm', __('Envoyer un email a votre liste de destinataires avec le lien de la page', 'e-mailing-service' ), 'sm_meta_box', 'page', 'advanced');
	}

    add_action( 'add_meta_boxes', 'sm_meta_init');
	
	function sm_meta_box() {
		global $post_ID;
		if(get_post_meta($post_ID, '_smauto', FALSE)) { 
		} else { 
			add_post_meta($post_ID, '_smauto', 'no');
		}
		echo "<input type=\"hidden\" name=\"sm_meta_nonce\" id=\"sm_meta_nonce\" value=\"" . wp_create_nonce(wp_hash(plugin_basename(__FILE__))) . "\" />";
		echo __("Cochez pour envoyer le lien a votre liste de destinataires", 'e-mailing-service');
	if(get_option('sm_auto')=='yes'){
		echo '<table width="200">
<tr>
<td><label><input name="sm_meta_field" type="radio" id="sm_meta_field_0" value="yes" checked="checked" size="75" />'.__('oui','e-mailing-service').'</label></td><td>|</td> 
<td><label><input type="radio" name="sm_meta_field" value="no" id="sm_meta_field_1" size="75" />'.__('non','e-mailing-service').'</label></td> </tr>
</table>';			
		} else {
			echo '<table width="200">
<tr>
<td><label><input name="sm_meta_field" type="radio" id="sm_meta_field_0" value="yes" size="75" />'.__('oui','e-mailing-service').'</label></td><td> |</td> 
<td><label><input type="radio" name="sm_meta_field" value="no" id="sm_meta_field_1" checked="checked" size="75" />'.__('non','e-mailing-service').'</label></td> </tr>
</table>';					
		}

	} 
	
	function sm_meta_post($post_id) {
		global $wpdb;
		$table_envoi = $wpdb->prefix.'sm_historique_envoi';  
		if(get_post_meta($post_id, '_smauto', false)){
		if ( isset($_POST['sm_meta_field']) && $_POST['sm_meta_field'] == 'yes' ) {
		update_post_meta($post_id, '_smauto', 'yes');
		$the_post = get_post($post_id);
        $status = $the_post->post_status;
		$type = $the_post->post_type;     
		if($status == 'publish' && $type !='newsletter'){
		$total=0;
		$fivesdrafts = $wpdb->get_results("SELECT count(id) AS total FROM `".$table_envoi."` WHERE id_newsletter='".$post_id."'");
        foreach ( $fivesdrafts as $fivesdraft ) 
        {
		$total=$fivesdraft->total;
		}
		if($total==0){
	    $wpdb->insert("".$table_envoi."", array(  
            'id_newsletter' => $post_id,  
            'id_liste' => get_option('sm_auto_id_liste'),
			'pause' => get_option('sm_auto_pause'),
			'status' => 'En attente',
            'type' => $type,
			'track1'=> 'auto',
			'date_envoi' => current_time('mysql')
        ));
		}
	    }
		}
		}
	} 
	add_action('save_post','sm_meta_post',1, 2);



function affiche_mail($smhie,$smemail){
global $wpdb;
$table_liste = $wpdb->prefix.'sm_liste';  
$table_hie = $wpdb->prefix.'sm_historique_envoi';
$nb=0;
$fivesdrafts = $wpdb->get_results("SELECT id_liste  FROM `".$table_hie."` WHERE id='$smhie'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$id_liste =$fivesdraft->id_liste;
}
$listes = $wpdb->get_results("SELECT liste_bd  FROM `".$table_liste."` WHERE id='$id_liste'");
foreach ( $listes as $resliste ) 
{
$liste = $resliste->liste_bd;
}
$listese = $wpdb->get_results("SELECT email  FROM `".$liste."` WHERE id='$smemail'");
foreach ( $listese as $reslistee ) 
{
$email = $reslistee->email;
}
$_SESSION["sm_email"]=$email;
return $_SESSION["sm_email"];
}

function update_inscrit($smhie,$email,$email_id,$cle="Hysmqponisgz564"){
global $wpdb;
$table_liste = $wpdb->prefix.'sm_liste';  
$table_hie = $wpdb->prefix.'sm_historique_envoi';
$fivesdrafts = $wpdb->get_results("SELECT id_liste  FROM `".$table_hie."` WHERE id='$smhie'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$id_liste =$fivesdraft->id_liste;
}
$listes = $wpdb->get_results("SELECT liste_bd  FROM `".$table_liste."` WHERE id='$id_liste'");
foreach ( $listes as $resliste ) 
{
$liste = $resliste->liste_bd;
}
$wpdb->query("UPDATE ".$liste." set valide='0',optin='1' WHERE `id`='".$email_id."' AND `cle`='".$cle."'"); 
return true;
}
function update_optin($smhie,$email_id,$cle="Hysmqponisgz564"){
global $wpdb;
$table_liste = $wpdb->prefix.'sm_liste';  
$table_hie = $wpdb->prefix.'sm_historique_envoi';
$fivesdrafts = $wpdb->get_results("SELECT id_liste  FROM `".$table_hie."` WHERE `id`='".$smhie."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$id_liste =$fivesdraft->id_liste;
}
$listes = $wpdb->get_results("SELECT liste_bd  FROM `".$table_liste."` WHERE id='$id_liste'");
foreach ( $listes as $resliste ) 
{
mysql_query("UPDATE `".$resliste->liste_bd."` set `optin` = '1' WHERE `id`='".$email_id."' AND `cle`='".$cle."'") or die (mysql_error());
}
return true;
}
function sm_admin_head(){
$txt='<script src="'.smURL.'SpryAssets/SpryTooltip.js" type="text/javascript"></script>
<link href="'.smURL.'SpryAssets/SpryTooltip.css" rel="stylesheet" type="text/css">';
echo $txt;
}
add_action('admin_head', 'sm_admin_head');


function sm_no_generator() { return ''; }
add_filter('the_generator', 'sm_no_generator');

if( !function_exists( 'envoi_server' )) {
function envoi_server($url,$array)
{
	$args	=	http_build_query($array);
	$url	=	parse_url($url);

	if(isset($url['scheme']) && ($url['scheme'] == "https" || $url['scheme'] == "ssl"))
	{
		$scheme = "ssl://";
		$port='443';
	}
	else
	{
		$scheme = "";
		$port='80';
	}
	
		
	if(!$fp=fsockopen($scheme.$url['host'], $port, $errno, $errstr))
	{
		echo "non";
	}
	else
	{
		$size = strlen($args);
		$request = "POST ".$url['path']." HTTP/1.1\n";
		$request .= "Host: ".$url['host']."\n";
		$request .= "Connection: Close\r\n";
		$request .= "Content-type: application/x-www-form-urlencoded\n";
		$request .= "Content-length: ".$size."\n\n";
		$request .= $args."\n";
	    $fput = fputs($fp, $request);
		fclose ($fp);
		$out = true;
	}

	return $out;

}
}

if( !function_exists( 'xml_server_api' )) {
      function xml_server_api($url,$array)
       {
	$args	=	http_build_query($array);
	$url	=	parse_url($url);

	if(isset($url['port']))
	{
		$port=$url['port'];
	}
	else
	{
		$port='80';
	}

	if(!$fp=fsockopen($url['host'], $port, $errno, $errstr))
	{
		//$out = false;
	}
	else
	{
		$size = strlen($args);
		$request = "POST ".$url['path']." HTTP/1.1\n";
		$request .= "Host: ".$url['host']."\n";
		$request .= "Connection: Close\r\n";
		$request .= "Content-type: application/x-www-form-urlencoded\n";
		$request .= "Content-length: ".$size."\n\n";
		$request .= $args."\n";
		$fput = fputs($fp, $request);
	        $resultat ="";

		while (!feof($fp))
		{
			$resultat .= fgets($fp, 512);
		}

		fclose($fp);
		//$out = true;
	}

	$debut_flux = strpos($resultat,'<?xml version="1.0" encoding="UTF-8"?>');
	$flux = substr($resultat,$debut_flux);
	return $flux;
	      }
}
//mise à jour 

function sm_update_db(){
    global $wpdb;  
    $table_name = $wpdb->prefix.'sm_liste_test';
	$table_temps = $wpdb->prefix.'sm_temps';
	$table_liste = $wpdb->prefix.'sm_liste';  
	$table_log = $wpdb->prefix.'sm_log';
	$table_log_bounces = $wpdb->prefix.'sm_bounces_log';
	$table_stats_smtp = $wpdb->prefix.'sm_stats_smtp';
	$table_blacklist = $wpdb->prefix.'sm_blacklist';
	$table_spamscore = $wpdb->prefix.'sm_spamscore';
	$table_suite = $wpdb->prefix.'sm_suite';
	$table_bounces_hard = $wpdb->prefix.'sm_bounces_hard';
    $table_envoi_name = $wpdb->prefix.'sm_historique_envoi';  
if(get_option('sm_db_version') < '2.6'){
$listes = $wpdb->get_results("SELECT liste_bd  FROM `".$table_liste."`");
foreach ( $listes as $resliste ) 
{
$wpdb->query("ALTER TABLE `".$resliste->liste_bd."` ADD `cle` VARCHAR( 250) NOT NULL DEFAULT 'Hysmqponisgz564', ADD INDEX (`cle`)");
$wpdb->query("ALTER TABLE `".$resliste->liste_bd."` ADD `optin` ENUM('0','1') NOT NULL DEFAULT '0' AFTER `bounces`");
}
update_option( 'sm_db_version', '2.6' );
}
if(get_option('sm_db_version') >= '2.6' &&  get_option('sm_db_version') < '2.7'){
$wpdb->query("ALTER TABLE `".$table_temps."` ADD `cle` VARCHAR( 250) NOT NULL DEFAULT 'Hysmqponisgz564', ADD INDEX (`cle`)");
$wpdb->query("ALTER TABLE `".$table_suite."` ADD `cle` VARCHAR( 250) NOT NULL DEFAULT 'Hysmqponisgz564', ADD INDEX (`cle`)");
}
if(get_option('sm_db_version') >= '2.7' &&  get_option('sm_db_version') < smDBVERSION){
$wpdb->query("ALTER TABLE `".$table_bounces_hard."` ADD `update` ENUM('0','1') NOT NULL DEFAULT '0' ");
$wpdb->query("ALTER TABLE `".$wpdb->prefix."sm_liste_test` ADD `optin` ENUM('0','1') NOT NULL DEFAULT '0' AFTER `bounces`");
$wpdb->query("ALTER TABLE `".$table_temps."` ADD `cle` VARCHAR( 250) NOT NULL DEFAULT 'Hysmqponisgz564', ADD INDEX (`cle`)");
$wpdb->query("ALTER TABLE `".$table_suite."` ADD `cle` VARCHAR( 250) NOT NULL DEFAULT 'Hysmqponisgz564', ADD INDEX (`cle`)");
}
if(get_option('sm_db_version') >= '2.8' &&  get_option('sm_db_version') < smDBVERSION){
$wpdb->query("ALTER TABLE `".$table_envoi_name."` ADD `mode` ENUM('text/plain','text/html') NOT NULL DEFAULT 'text/html'");
}
if(get_option('sm_db_version') >= '2.9' &&  get_option('sm_db_version') < smDBVERSION){
$wpdb->query( "DROP TABLE `$table_liste`"); 
$wpdb->query( "  
   CREATE TABLE IF NOT EXISTS `$table_liste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `liste_bd` varchar(250) NOT NULL,
  `liste_nom` varchar(250) NOT NULL,
  `champs1` varchar(250) NOT NULL,
  `champs2` varchar(250) NOT NULL,
  `champs3` varchar(250) NOT NULL,
  `champs4` varchar(250) NOT NULL,
  `champs5` varchar(250) NOT NULL,
  `champs6` varchar(250) NOT NULL,
  `champs7` varchar(250) NOT NULL,
  `champs8` varchar(250) NOT NULL,
  `champs9` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `liste_bd` (`liste_bd`),
  KEY `liste_nom` (`liste_nom`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;   
");
	   $wpdb->insert($table_liste, array(  
            'liste_bd' => $table_name,  
            'liste_nom' => 'test',
       )); 
}
update_option( 'sm_db_version', smDBVERSION );
_e("mise à jour de la base de donnée du plugin e-mailing service (".$wpdb->prefix.")","e-mailing-service");	
}
function sm_update_db_check() {
	if(!get_option('sm_db_version')){
	add_option('sm_db_version','1.0'); 	
	}
    if (get_option('sm_db_version') < smDBVERSION) {
        sm_update_db();
    }
}
if ( is_multisite() ) { 
add_action( 'admin_head', 'sm_update_db_check' ); 
} else {
add_action( 'admin_head', 'sm_update_db_check' );		
}


if(!isset($SMINCLUDEOK)){
include(smPATH . '/include/fonctions_sm.php');
}

require_once(dirname(__FILE__)."/sm_widget.php");
require_once(dirname(__FILE__)."/sm_modeles.php");
require_once(dirname(__FILE__)."/sm_dashboard.php");

	
?>