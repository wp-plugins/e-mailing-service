<?php
/*
Plugin Name: e-mailing service
Version: 10.0
Plugin URI: http://www.e-mailing-service.net
Description: Send newsletters (emails) with wordpress. Detailed statistics AND rewriting on activation of the Free API
Author URI: http://www.e-mailing-service.net
*/
if(function_exists('session_status')){
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
} else {
 session_start();	
}
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
if(!get_option('permalink_structure') ) { 
add_action('admin_notices', 'SM_rewrite');
}
function SM_rewrite()
{
echo '<div class="updated"><p>'.__('Attention permalink is not active ! "E-mailing service" does not work properly if the permalinks are not enabled.','admin-hosting').' <br> <a href="options-permalink.php">options-permalink.php</a></p></div>';
}
$upload_dir = wp_upload_dir();
define( 'smVERSION', '10.0' );
define( 'smDBVERSION', '4.5' );
define( 'smPATH', trailingslashit(dirname(__FILE__)) );
define( 'smDIR', trailingslashit(dirname(plugin_basename(__FILE__))) );
define( 'smURL', plugin_dir_url(dirname(__FILE__)) . smDIR );
define( 'smCONTENT',str_replace('/plugins/e-mailing-service/','',smPATH));
define( 'smPOST', ''.$upload_dir['basedir'].'/sm-post/');
define( 'smPOSTURL', ''.$upload_dir['baseurl'].'/sm-post/'); 


/*
function sm_load_textdomain() {
load_plugin_textdomain( 'e-mailing-service', false, smDIR . '/languages/' );
}
add_action('plugins_loaded', 'sm_load_textdomain');
*/

function sm_load_textdomain() {

	$domain = 'e-mailing-service';
	$locale = apply_filters( 'plugin_locale', 'fr_FR', $domain );
	load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
	load_plugin_textdomain( $domain, FALSE, ''.smDIR.'/languages/' );

}
add_action( 'init', 'sm_load_textdomain' );

//////////////menu ///////////////////////

function register_sm_menu_page() {
   add_menu_page(__('Messages', 'e-mailing-service'), __('Messages', 'e-mailing-service'),  'administrator',  smPATH . 'admin/message.php', NULL, smURL . 'include/email_edit.png');   
   add_menu_page(__('E-mailing service', 'e-mailing-service'), __('E-mailing service', 'e-mailing-service'),  'manage_options',  smPATH . 'admin/index.php', NULL, smURL . 'include/email_edit.png');  
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Contact list', 'e-mailing-service'), __('Contact list', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/listes.php', NULL);
   add_submenu_page( smPATH . 'admin/listes.php', __('Liste test', 'e-mailing-service'), __('Liste test', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/emails.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Creer une newsletter', 'e-mailing-service'), __('Creer une newsletter', 'e-mailing-service'), 'manage_options', smPATH . 'admin/create.php', NULL);
   add_submenu_page( smPATH . 'admin/create.php', __('with wordpress', 'e-mailing-service'), __('with wordpress', 'e-mailing-service'), 'manage_options', 'post-new.php?post_type=newsletter', NULL);
   add_submenu_page(smPATH . 'admin/create.php', __('with elrte', 'e-mailing-service'), __('with elrte', 'e-mailing-service'), 'manage_options', smPATH . 'admin/editor.php', NULL);   
   add_submenu_page( 'e-mailing-service/admin/index_user.php', __('Import Newsetter', 'e-mailing-service'), __('Import Newsetter', 'e-mailing-service'), 'manage_options',   smPATH . 'admin/import_newsletter.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Liste Newsetter', 'e-mailing-service'), __('Liste Newsetter', 'e-mailing-service'), 'manage_options',   smPATH . 'admin/listes_newsletter.php', NULL);
     add_submenu_page( 'e-mailing-service/admin/index.php', __('Envoyer une newsletter', 'e-mailing-service'), __('Envoyer une newsletter', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/send_user.php', NULL);
	   add_submenu_page( '', __('Envoyer une newsletter', 'e-mailing-service'), __('Envoyer une newsletter', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/send.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Suivis des campagnes', 'e-mailing-service'), __('Suivis des campagnes', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/live_user.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Statistiques', 'e-mailing-service'), __('Statistiques', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/stats_user.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Variables', 'e-mailing-service'), __('Variables', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/variables.php', NULL);

   add_submenu_page( 'e-mailing-service/admin/index.php', __('Creer un modele', 'e-mailing-service'), __('Creation de modeles', 'e-mailing-service'), 'manage_options',  'post-new.php?post_type=sm_modeles', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Liste Modeles', 'e-mailing-service'), __('Liste Modeles', 'e-mailing-service'), 'manage_options',  'edit.php?post_type=sm_modeles', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Import Modele', 'e-mailing-service'), __('Import modele', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/import_template.php', NULL);
   

    add_submenu_page( 'e-mailing-service/admin/index.php', __('NPAI', 'e-mailing-service'), __('NPAI', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/npai.php', NULL);
    add_submenu_page( 'e-mailing-service/admin/index.php', __('Blacklist', 'e-mailing-service'), __('Blacklist', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/blacklist.php', NULL);
    add_submenu_page( 'e-mailing-service/admin/index.php', __('Gestion des alertes', 'e-mailing-service'), __('Gestion des alertes', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/alerte.php', NULL);
     add_submenu_page( 'e-mailing-service/admin/index.php', __('Setting', 'e-mailing-service'), __('Setting', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/setting.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('License et options', 'e-mailing-service'), __('License et options', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/configuration.php', NULL);   

    add_submenu_page( 'e-mailing-service/admin/index.php', __('Support', 'e-mailing-service'), __('Support', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/support.php', NULL); 
    add_submenu_page( 'e-mailing-service/admin/index.php', __('Debug', 'e-mailing-service'), __('Debug', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/debug.php', NULL);
	add_submenu_page( smPATH . 'admin/debug.php', __('Status de services', 'e-mailing-service'), __('Status de services', 'e-mailing-service'), 'manage_options',  smPATH . 'admin/etat.php', NULL);  


}
function register_sm_menu_page_client() {
	if(is_plugin_active('admin-hosting/admin-hosting.php') ) {
	if(get_option('AH_user_mailing')== 'yes'){
	$droit_user='ah-user';		
	} else {
	$droit_user='mailing-user';		
	}
	} else {
	$droit_user='mailing-user';	
	}

   add_menu_page(__('E-mailing service', 'e-mailing-service'), __('E-mailing service', 'e-mailing-service'), $droit_user,  smPATH . 'admin/index_user.php', NULL, smURL . 'include/email_edit.png');  
   add_submenu_page( 'e-mailing-service/admin/index_user.php', __('Destinataires', 'e-mailing-service'), __('Destinataires', 'e-mailing-service'), $droit_user,  smPATH . 'admin/listes.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index.php', __('Liste test', 'e-mailing-service'), __('Liste test', 'e-mailing-service'), $droit_user,  smPATH . 'admin/emails.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index_user.php', __('Assistant Creation', 'e-mailing-service'), __('Assistant Creation', 'e-mailing-service'), $droit_user, smPATH . 'admin/create.php', NULL);
   add_submenu_page( smPATH . 'admin/create.php', __('with wordpress', 'e-mailing-service'), __('with wordpress', 'e-mailing-service'), $droit_user, 'post-new.php?post_type=newsletter', NULL);
   add_submenu_page(smPATH . 'admin/create.php', __('with elrte', 'e-mailing-service'), __('with elrte', 'e-mailing-service'), $droit_user, smPATH . 'admin/editor.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index_user.php', __('Import Newsetter', 'e-mailing-service'), __('Import Newsetter', 'e-mailing-service'), $droit_user,   smPATH . 'admin/import_newsletter.php', NULL);

   add_submenu_page( 'e-mailing-service/admin/index_user.php', __('Liste Newsetter', 'e-mailing-service'), __('Liste Newsetter', 'e-mailing-service'), $droit_user,   smPATH . 'admin/listes_newsletter.php', NULL);
   
   add_submenu_page( 'e-mailing-service/admin/index_user.php', __('Envois Newsletter', 'e-mailing-service'), __('Envois Newsletter', 'e-mailing-service'), $droit_user,  smPATH . 'admin/send_user.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index_user.php', __('Suivis des campagnes', 'e-mailing-service'), __('Suivis des campagnes', 'e-mailing-service'), $droit_user,  smPATH . 'admin/live_user.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index_user.php', __('Statistiques', 'e-mailing-service'), __('Statistiques', 'e-mailing-service'), $droit_user,  smPATH . 'admin/stats_user.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index_user.php', __('Variables', 'e-mailing-service'), __('Variables', 'e-mailing-service'), $droit_user,  smPATH . 'admin/variables_user.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index_user.php', __('Gestion des alertes', 'e-mailing-service'), __('Gestion des alertes', 'e-mailing-service'), $droit_user, smPATH . 'admin/alerte_user.php', NULL);
   add_submenu_page( 'e-mailing-service/admin/index_user.php', __('Account', 'e-mailing-service'), __('Account', 'e-mailing-service'), $droit_user, smPATH . 'admin/solde.php', NULL);
}


if ( !is_super_admin() ) {
add_action('admin_menu', 'register_sm_menu_page_client');
}
else {
add_action('admin_menu', 'register_sm_menu_page');
}

  ////////// javascript   /////////////////
  
function sm_js_init($hook) {

echo '<!-- hook : '.$hook.' -->';

        $occurence = Array("e-mailing-service"); 
        while (list($element, $valeur) = each($occurence)) {
                $pos = strpos($hook,$valeur);
                if(is_int($pos)!=false || $hook == 'index.php')
						{						 

wp_enqueue_script('jquery');

wp_enqueue_script( 'e-mailing-service-js5',''.smURL.'js/coo_form.js' );
wp_enqueue_script( 'e-mailing-service-js6',''.smURL.'js/html5.js');
wp_enqueue_script( 'e-mailing-service-js7',''.smURL.'js/selectivizr.js');
wp_enqueue_script( 'e-mailing-service-js8',''.smURL.'js/ie.js' );
wp_enqueue_script( 'e-mailing-service-js9',''.smURL.'js/excanvas.js' );
	
wp_enqueue_script( 'e-mailing-service-js10',''.smURL.'js/onglet.js' );
wp_enqueue_script( 'e-mailing-service-js11',''.smURL.'js/jquery.tools.min.js');
wp_enqueue_script( 'e-mailing-service-js12',''.smURL.'js/visualize.jQuery.js' );
wp_enqueue_script( 'e-mailing-service-js13',''.smURL.'js/jquery.tables.js');

//help
wp_enqueue_script( 'e-mailing-service-js14',''.smURL.'SpryAssets/SpryTooltip.js');

//form preview
wp_enqueue_script( 'e-mailing-service-js15',''.smURL.'js/preview.min.js');
wp_enqueue_script( 'e-mailing-service-js16',''.smURL.'js/sm_onglet.js',false,'',true);



						}


     }
          }


add_action( 'admin_enqueue_scripts', 'sm_js_init' );



function sm_enque_css() {
	wp_enqueue_style( 'e-mailing-service-sm', ''.smURL.'css/sm.css' ,'','','screen');
	wp_enqueue_style( 'e-mailing-service-reset', ''.smURL.'css/reset.css','','','screen');
	wp_enqueue_style( 'e-mailing-service-style', ''.smURL.'css/style.css' ,'','','screen');
	wp_enqueue_style( 'e-mailing-service-messages', ''.smURL.'css/messages.css' ,'','','screen');
	wp_enqueue_style( 'e-mailing-service-forms', ''.smURL.'css/forms.css' ,'','','screen');
	wp_enqueue_style( 'e-mailing-service-visualize', ''.smURL.'css/visualize.css' ,'','','screen');
	wp_enqueue_style( 'e-mailing-service-tables', ''.smURL.'css/tables.css' ,'','','screen');
	wp_enqueue_style( 'e-mailing-service-aristo', ''.smURL.'css/uniform.aristo.css' ,'','','screen');
	wp_enqueue_style( 'e-mailing-service-invoice', ''.smURL.'css/invoice.css' ,'','','screen');
	wp_enqueue_style( 'e-mailing-service-ie8', ''.smURL.'css/ie8.css' ,'','','screen');
	wp_enqueue_style( 'e-mailing-service-ie', ''.smURL.'css/ie.css' ,'','','screen');
	wp_enqueue_style( 'e-mailing-service-spry', ''.smURL.'SpryAssets/SpryTooltip.css' ,'','','screen');

}

add_action( 'admin_enqueue_scripts', 'sm_enque_css' );




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
	
		$message = array(
		'label' => __('Message', 'e-mailing-service'),
        'labels' => array(
            'singular_name' => __('Message', 'e-mailing-service'),
            'add_new_item' => __('Ajouter un message', 'e-mailing-service'),
            'edit_item' => __('Modifier le message', 'e-mailing-service'),
            'add_new' => __('Ajouter un message', 'e-mailing-service'),
            'new_item' => __('Creation de message', 'e-mailing-service'),
            'view_item' => __('Visualisez les messages', 'e-mailing-service'),
            'not_found' => __('Le message n\'existe plus', 'e-mailing-service'),
            'not_found_in_trash' => __('Le message n\'existe plus','e-mailing-service'),
            'search_items' => __('Recherche un message', 'e-mailing-service'),
        ),
        'public' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => false,
        'show_ui' => false,
        'capability_type' => 'post',
		'rewrite' => array('slug' => 'message'),
		);
	register_post_type('message', $message);
}
} 


//////////////// creation des bases //////////////////////////////

function sm_mailing_install()  
{  
    global $wpdb;  
	$current_user = wp_get_current_user();
    $user_login=$current_user->user_login;
    $user_id=$current_user->ID;
    $table_name = $wpdb->prefix.'sm_liste_test';
	$table_user_wordpress = $wpdb->prefix.'wordpress_user';
	$table_temps = $wpdb->prefix.'sm_temps';
	$table_liste = $wpdb->prefix.'sm_liste';  
	$table_log = $wpdb->prefix.'sm_log';
	$table_bounces_log = $wpdb->prefix.'sm_bounces_log';
	$table_stats_smtp = $wpdb->prefix.'sm_stats_smtp';
	$table_blacklist = $wpdb->prefix.'sm_blacklist';
	$table_spamscore = $wpdb->prefix.'sm_spamscore';
	$table_suite = $wpdb->prefix.'sm_suite';
	$table_bounces_hard = $wpdb->prefix.'sm_bounces_hard';
    $table_envoi_name = $wpdb->prefix.'sm_historique_envoi';
	$table_bounces_log = $wpdb->prefix.'sm_bounces_log';
	$table_messageid=$wpdb->prefix.'sm_stats_messageid';  
 
    $wpdb->query("CREATE TABLE IF NOT EXISTS `$table_envoi_name` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_newsletter` int(11) NOT NULL,
  `id_liste` int(11) NOT NULL,
  `date_envoi` datetime NOT NULL,
  `date_demarrage` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `pause` varchar(250) NOT NULL DEFAULT '10',
  `status` enum('En attente','En cours','Terminer','Limite','pause','reactiver','stop','erreur_flux','erreur_license','suite','suspended','bug','error') NOT NULL DEFAULT 'En attente',
  `nb_envoi` int(11) NOT NULL,
  `nb_attente` int(11) NOT NULL,
  `type` enum('newsletter','post','page') NOT NULL DEFAULT 'newsletter',
  `track1` varchar(250) NOT NULL,
  `track2` varchar(250) NOT NULL,
  `serveur` varchar(250) NOT NULL DEFAULT 'auto',
  `mode` enum('text/plain','text/html') NOT NULL DEFAULT 'text/html',
  `login` varchar(250) NOT NULL DEFAULT 'admin',
  `attachments` varchar(250) NOT NULL,
  `txth` longtext NOT NULL,
  `sujet` longtext NOT NULL,
  `corps` longtext NOT NULL,
  `txtb` longtext NOT NULL,
  `txta` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `fromname` varchar(250) NOT NULL,
  `reply_to` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_newsletter` (`id_newsletter`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=150230 ;
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
  `login` varchar(250) NOT NULL DEFAULT 'admin',
  `type` enum('perso','location') NOT NULL DEFAULT 'perso',
  PRIMARY KEY (`id`),
  UNIQUE KEY `liste_bd` (`liste_bd`),
  KEY `liste_nom` (`liste_nom`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14896 ;
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

  $wpdb->query("  
   CREATE TABLE IF NOT EXISTS `$table_user_wordpress` (
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


$wpdb->query("CREATE TABLE IF NOT EXISTS `$table_bounces_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idb` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `hie` varchar(250) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"); 

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

$wpdb->query("CREATE TABLE IF NOT EXISTS `$table_bounces_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idb` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `hie` varchar(250) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=322496 ;"); 

$wpdb->query("CREATE TABLE IF NOT EXISTS `".$table_messageid."` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `messageid` varchar(250) NOT NULL,
  `server` varchar(250) NOT NULL,
  `status` longtext NOT NULL,
  `hie` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `messageid` (`messageid`,`hie`),
  KEY `hie` (`hie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86980 ;"); 
 
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
			'login' => $user_login,
       ));
	   $wpdb->insert($table_liste, array(  
            'liste_bd' => $table_user_wordpress,  
            'liste_nom' => 'wordpress_user',
			'login' => $user_login,
       ));   
	 
	 if(!is_dir(smPOST)){
    @mkdir(smPOST, 0777);
	@chmod(smPOST, 0777); 
		   }	
		   
   
}






/////////////////////// creation des options //////////////////////////

add_option('sm_version',smVERSION); 
add_option('sm_db_version',smDBVERSION); 
add_option('sm_login',str_replace("www.","",$_SERVER['HTTP_HOST'])); 
add_option('sm_type_envoi','smtp');
add_option('sm_serveur', 'srv-free');
add_option('sm_domain',str_replace("www.","",$_SERVER['HTTP_HOST'])); 

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
add_option('sm_smtp_user_login_stats', $user_login);
add_option('sm_smtp_user_id_stats', $user_id);
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
//pour la location et vente du service
add_option('sm_location','non');


	
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
  
  $wp->add_query_var('sm_action');
  $wp->add_query_var('sm_email');
  $wp->add_query_var('sm_sujet');
  $wp->add_query_var('sm_message');
  
  $wp_rewrite->add_rule('^out/(.*)/(.*)/(.*)/(.*)/(.*)/(.*)?','index.php?smlink=$matches[1]&smdate=$matches[2]&smemail=$matches[3]&smnum=$matches[4]&smcle=$matches[5]', 'top');	
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
                $restricted = array(__('Newsletter'), __('Modeles'), __('Templates'), __('Template'),__('sm_modeles'));
                end ($menu);
                while (prev($menu)){
                        $value = explode(' ',$menu[key($menu)][0]);
                        if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
                }
}
}
add_action('admin_menu', 'sm_remove_menus');



/*
add_action('admin_head-index.php', 'AH_dashbord_style');
if(!function_exists('AH_dashbord_style')){
function AH_dashbord_style() {
	SM_custom_login_css();
}
}
*/

add_action( 'init', 'SM_register_shortcodes');
function SM_register_shortcodes(){
   add_shortcode('sm_form_contact', 'SM_form_contact');
}

if(!function_exists('SM_send_message')){
function SM_send_message($sm_email,$sm_sujet,$sm_message,$ip){
	
$message = ''.__('Message du formulaire de contact sur','e-mailing-service').' '.get_site_url().'<br><br>';
$message .= ''.$sm_message.'<br><br>';
$message .= ''.__('Email','e-mailing-service').' <a href="mailto:'.$sm_email.'">'.$sm_email.'</a><br>';
$message .= ''.__('IP','e-mailing-service').' : '.$ip.'<br>';
$message .= ''.__("Date d'envoi",'e-mailing-service').' : '.date('Y-m-d H:i:s').'<br>';


	$my_post = array(
  'post_title'    => $sm_sujet,
  'post_content'  => $message,
  'post_status'   => 'private',
  'post_author'   => 1,
  'comment_status'=> 'closed',
  'ping_status'	=> 'closed',
  'post_type' => 'message',
  'post_password' => wp_generate_password()
     );

    $post_id = wp_insert_post( $my_post );
	
	$header = sm_optimisation_fai(get_option('sm_alerte_email'),$sm_sujet,1,"text/html");	
	wp_mail( get_option('sm_alerte_email'), $sm_sujet, $message, $header, "");	
	
  }
}

function SM_force_type_private($post)
{
    $post['post_password'] = '6jsjs5900';
    $post['post_status'] = 'private';
    return $post;
}

if(!function_exists('SM_form_contact')){
function SM_form_contact($atts, $content = null){	
extract(shortcode_atts(array(
      'name' => 'yes',
	  'style' => '',
   ), $atts));
global $wp_query;

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}


if(isset($wp_query->query_vars['sm_action']) && $wp_query->query_vars['sm_action'] == 'post_message' ){
$sm_action =$wp_query->query_vars['sm_action'];
$sm_email= $wp_query->query_vars['sm_email'];
$sm_sujet= $wp_query->query_vars['sm_sujet'];
$sm_message= $wp_query->query_vars['sm_message'];

  if($sm_sujet !='' && $sm_email != '' && $sm_message !=''){
SM_send_message($sm_email,$sm_sujet,$sm_message,$ip);
$content .=  "<h2>".__("Votre message a ete envoye","e-mailing-service")."</h2>";
  } else {
$content .=  "<h2>".__("Tous les champs sont obligatoires","e-mailing-service")."</h2>";
$content .=  "[sm_form_contact name=yes][/sm_form_contact]";
  }
} else {

$content .= '<form action="" method="post">
<input type="hidden" name="sm_action" value="post_message" />';
$content .= '<table class="widefat">
                         ';
$content .=  "
<tr><td><b>".__("Email","e-mailing-service")." *</b></td><td><input name=\"sm_email\" type=\"text\" value=\"\" /></td></tr>
<tr><td><b>".__("Sujet","e-mailing-service")." *</b></td><td><input name=\"sm_sujet\" type=\"text\" value=\"\" size=\"40\"/></td></tr>
<tr><td><b>".__("Message","e-mailing-service")." *</b></td><td><textarea name=\"sm_message\" cols=\"50\" rows=\"10\"></textarea></td></tr>
<tr><td></td><td><input name=\"envoyer\" type=\"submit\" value=\"".__("send","e-mailing-service")."\"/></td></tr>
</table>
</form>
";
}
return $content;

}  
}



///desinscrit ////



add_filter('wp_head', 'sm_head' );
if(!function_exists('sm_head')){
function sm_head() {
   global $wp_query;
   /*
  if(isset($wp_query->query_vars['smlink']) && !isset($wp_query->query_vars['smidmp']) && !isset($wp_query->query_vars['smidmd'])){
  $_SESSION["sm_hie"]=$wp_query->query_vars['smnum'];
  $_SESSION["sm_cle"]=$wp_query->query_vars['smcle'];
  return sm_stats();
  }
  elseif(isset($wp_query->query_vars['smlink']) && isset($wp_query->query_vars['smidmp']) && !isset($wp_query->query_vars['smidmd'])){
  $_SESSION["sm_emailid"]=$wp_query->query_vars['smidmp'];
  $_SESSION["sm_hie"]=$wp_query->query_vars['smnum'];
  $_SESSION["sm_cle"]=$wp_query->query_vars['smcle'];
  return sm_stats_page();  
  }
  */
  if(isset($wp_query->query_vars['smlink']) && !isset($wp_query->query_vars['smidmp']) && isset($wp_query->query_vars['smidmd'])){
  $_SESSION["sm_emailid"]=$wp_query->query_vars['smidmd'];
  $_SESSION["sm_hie"]=$wp_query->query_vars['smnum'];
  $_SESSION["sm_cle"]=$wp_query->query_vars['smcle'];
	return sm_stats_desinscrit();  
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
xml_server_stats('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats.php',$array);
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
$email=affiche_mail($smnum,$smidmp);
	    $host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);
		$array =array (
		"domaine_client" => $host,
		"l" => $smlink,
		"action" => "page",
		"smidmp" => $smidmp,
		"smemail" => $email,
		"smcle" => $smcle,
		"smdate" => $smdate	
		); 
xml_server_stats('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats.php',$array);
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
update_optin($smnum,$smidmd,$smcle);
} else {
update_optin($smnum,$smidmd);
}
$email=affiche_mail($smnum,$smidmd);
	    $host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);
		$array =array (
		"domaine_client" => $host,
		"l" => $smlink,
		"action" => "desinscrit",
		"smidmd" => $smidmd,
		"smemail" => $email,
		"smcle" => $smcle,
		"smdate" => $smdate	
		); 	
xml_server_stats('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats.php',$array);
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
			
		$lien = str_replace('http://http://','http://',$row[1]);
                @header('Location: '.$lien.'');
	            if(!headers_sent()) {
				@header('Location: '.$lien.'');
				echo '<meta http-equiv="refresh" content="0; url='.$lien.'">';
                exit();
                } else {
				echo '<meta http-equiv="refresh" content="0; url='.$lien.'">';
	            exit();
                }		
		} else {
		   header('Location: '.get_option("blog_url").'');
		   exit();					
		}
		}
}
}
add_action('template_redirect','sm_stats_redirect');
function sm_stats_redirect() {
global $wp_query;
if(isset($wp_query->query_vars['smlink']) && !isset($wp_query->query_vars['smidmp']) && !isset($wp_query->query_vars['smidmd'])){
$smlink= $wp_query->query_vars['smlink'];
$smemail= $wp_query->query_vars['smemail'];
$smdate= $wp_query->query_vars['smdate'];
$smnum= $wp_query->query_vars['smnum'];
$smcle= $wp_query->query_vars['smcle'];
session_start();
$_SESSION["sm_hie"]=$wp_query->query_vars['smnum'];
$_SESSION["sm_cle"]=$wp_query->query_vars['smcle'];
$email=affiche_mail($smnum,$smemail);
sm_stats();
exit();	
  }
   elseif(isset($wp_query->query_vars['smlink']) && isset($wp_query->query_vars['smidmp']) && !isset($wp_query->query_vars['smidmd'])){
  $_SESSION["sm_emailid"]=$wp_query->query_vars['smidmp'];
  $_SESSION["sm_hie"]=$wp_query->query_vars['smnum'];
  $_SESSION["sm_cle"]=$wp_query->query_vars['smcle'];
sm_stats_page();  
  }
  /*
  elseif(isset($wp_query->query_vars['smlink']) && !isset($wp_query->query_vars['smidmp']) && isset($wp_query->query_vars['smidmd'])){
  $_SESSION["sm_emailid"]=$wp_query->query_vars['smidmd'];
  $_SESSION["sm_hie"]=$wp_query->query_vars['smnum'];
  $_SESSION["sm_cle"]=$wp_query->query_vars['smcle'];
sm_stats_desinscrit();  
  }
  */
}
if(!function_exists('sm_nb_envois_mois')){
function sm_nb_envois_mois($user_login){
global $wpdb;
$table_envoi= $wpdb->prefix.'sm_historique_envoi';
$total = $wpdb->get_var("SELECT sum(nb_envoi) AS total FROM `".$table_envoi."` WHERE login='".$user_login."' AND date_envoi like '".date('Y-m')."-%'");
return $total;	
}
}

/////SMTP //////
function sm_smtp_choix($phpmailer){
	global $wdpd;
	$num=$_SESSION['sm_choix'];
	//session pour debug//
	$_SESSION['sm_smtp_actif']= '##'.get_option('sm_smtp_actif_'.$num.'').'##';
	$_SESSION['sm_smtp_server']= '##'.get_option('sm_smtp_server_'.$num.'').'##';
	$_SESSION['sm_from']= get_option('sm_from_'.$num.'');
	$_SESSION['sm_email_exp']= get_option('sm_email_exp_'.$num.'');
	$_SESSION['sm_email_ret']= get_option('sm_email_ret_'.$num.'');
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


    print htmlspecialchars( var_export( $phpmailer, true ) );
     /*
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
	*/
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
	list($mx,$domaine,$ext)=explode('.',get_option('sm_smtp_server_'.$num.''));
	$semi_rand = sha1(microtime()); 
    $message_id = '<' . $semi_rand . '@'.$domaine.'.'.$ext.'>';
	$_SESSION['message-id']=''.$semi_rand.'@'.$domaine.'.'.$ext.'';
	$_SESSION['sm_smtp_actif']= '##'.get_option('sm_smtp_actif_'.$num.'').'##';
	$_SESSION['sm_smtp_server']= '##'.get_option('sm_smtp_server_'.$num.'').'##';
	$_SESSION['sm_from']= get_option('sm_from_'.$num.'');
	$_SESSION['sm_email_exp']= get_option('sm_email_exp_'.$num.'');
	$_SESSION['sm_email_ret']= get_option('sm_email_ret_'.$num.'');
	$_SESSION['sm_smtp_port']= '##'.get_option('sm_smtp_port_'.$num.'').'##';
	$_SESSION['sm_smtp_authentification']= '##'.get_option('sm_smtp_authentification_'.$num.'').'##';
	$_SESSION['sm_smtp_login']= '##'.get_option('sm_smtp_login_'.$num.'').'##';
	$_SESSION['sm_smtp_pass']= '##'.get_option('sm_smtp_pass_'.$num.'').'##';
	$phpmailer->Sender = get_option('sm_email_exp_'.$num.'');
	$phpmailer->From = get_option('sm_email_exp_'.$num.'');
	$phpmailer->FromName = get_option('sm_from_'.$num.'');
	$phpmailer->AddReplyTo = get_option('sm_email_ret_'.$num.'');
	$phpmailer->MessageID = $message_id;
	$phpmailer->Host = get_option('sm_smtp_server_'.$num.'');
	$phpmailer->Port = get_option('sm_smtp_port_'.$num.'');
	$phpmailer->SMTPAuth = (get_option('sm_smtp_authentification_'.$num.'')=="oui") ? TRUE : FALSE;
	if($phpmailer->SMTPAuth){
		$phpmailer->Username =  get_option('sm_smtp_login_'.$num.'');
		$phpmailer->Password = get_option('sm_smtp_pass_'.$num.'');
	}
	
	} else {
	//session pour debug//
	$num=1;
	//session pour debug//
	
    list($mx,$domaine,$ext)=explode('.',get_option('sm_smtp_server_'.$num.''));
	$semi_rand = sha1(microtime()); 
    $message_id = '<' . $semi_rand . '@'.$domaine.'.'.$ext.'>';
	$_SESSION['message-id']=''.$semi_rand.'@'.$domaine.'.'.$ext.'';
	$_SESSION['sm_smtp_actif']= '##'.get_option('sm_smtp_actif_'.$num.'').'##';
	$_SESSION['sm_smtp_server']= '##'.get_option('sm_smtp_server_'.$num.'').'##';
	$_SESSION['sm_from']= get_option('sm_from_'.$num.'');
	$_SESSION['sm_email_exp']= get_option('sm_email_exp_'.$num.'');
	$_SESSION['sm_email_ret']= get_option('sm_email_ret_'.$num.'');
	$_SESSION['sm_smtp_port']= '##'.get_option('sm_smtp_port_'.$num.'').'##';
	$_SESSION['sm_smtp_authentification']= '##'.get_option('sm_smtp_authentification_'.$num.'').'##';
	$_SESSION['sm_smtp_login']= '##'.get_option('sm_smtp_login_'.$num.'').'##';
	$_SESSION['sm_smtp_pass']= '##'.get_option('sm_smtp_pass_'.$num.'').'##';
	$phpmailer->Sender = get_option('sm_email_exp_'.$num.'');
	$phpmailer->MessageID = $message_id;
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
	}
	//$phpmailer->XPriority = '';
	//$phpmailer->XMailer = '';
	$phpmailer->IsSMTP();
    if(get_option('sm_debug')=="oui")
    {
            $phpmailer->SMTPDebug = 2;
            $phpmailer->debug     = 1;


    print htmlspecialchars( var_export( $phpmailer, true ) );
    /*
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
	*/
    }

}
function sm_smtp_user($phpmailer){
	if(!isset($_SESSION["user_id"])){
	$host = get_option('sm_smtp_server_1');
	$sender = get_option('sm_email_exp_1');
	$from = get_option('sm_from_1');
	$fromname = get_option('sm_from_1');
	$reply_to = get_option('sm_email_ret_1');
	$port = get_option('sm_smtp_port_1');
	$auth = get_option('sm_smtp_authentification_1');
	$username = get_option('sm_smtp_login_1');
	$pass = get_option('sm_smtp_pass_1');
	if($auth =="oui") { $auth1 = TRUE; } else { $auth1 = FALSE; }	
	
	} else {
	$user_id=$_SESSION["user_id"];
	$host = get_user_meta( $user_id, 'sm_host',true);
	if($host ==''){
	$host = get_option('sm_smtp_server_1');
	$sender = get_option('sm_email_exp_1');
	$from = get_option('sm_from_1');
	$fromname = get_option('sm_from_1');
	$reply_to = get_option('sm_email_ret_1');
	$port = get_option('sm_smtp_port_1');
	$auth = get_option('sm_smtp_authentification_1');
	$username = get_option('sm_smtp_login_1');
	$pass = get_option('sm_smtp_pass_1');
	if($auth =="oui") { $auth1 = TRUE; } else { $auth1 = FALSE; }	
	  } else {
	$sender = get_user_meta( $user_id, 'sm_sender',true);
	$from = get_user_meta( $user_id, 'sm_from',true);
	$fromname = get_user_meta( $user_id, 'sm_fromname',true);
	$reply_to = get_user_meta( $user_id, 'sm_reply',true);
	$port = get_user_meta( $user_id, 'sm_port',true);
	$auth = get_user_meta( $user_id, 'sm_authentification',true);
	$username = get_user_meta( $user_id, 'sm_username',true);
	$pass = get_user_meta( $user_id, 'sm_pass',true);
	if($auth =="oui") { $auth1 = TRUE; } else { $auth1 = FALSE; }
	  }  
	}
	if(isset($_SESSION['alert'])){
	$host = get_option('sm_smtp_alert_server');
	$sender = get_option('sm_email_alert_exp');
	$from = get_option('sm_alert_from');
	$fromname = get_option('sm_alert_from');
	$reply_to = get_option('sm_alert_email_ret');
	$port = get_option('sm_smtp_alert_port');
	$auth = get_option('sm_smtp_alert_authentification');
	$username = get_option('sm_smtp_alert_login');
	$pass = get_option('sm_smtp_alert_pass');
	if($auth =="oui") { $auth1 = TRUE; } else { $auth1 = FALSE; }
			}
			
	@list($mx,$domaine,$ext,$autre)=explode('.',$host);
	if($autre !=''){
	$domaine_envoi =''.$domaine.'.'.$ext.'.'.$autre.''; 	
	} else {
	$domaine_envoi =''.$domaine.'.'.$ext.'';
	}
	$semi_rand = sha1(microtime()); 
    $message_id = '<' . $semi_rand . '@'.$domaine_envoi.'>';
	$_SESSION['message-id']=''.$semi_rand.'@'.$domaine_envoi.'';
	$_SESSION['sm_smtp_server']= $host;
	$_SESSION['sm_from']= $fromname;
	$_SESSION['sm_email_exp']= $sender;
	$_SESSION['sm_email_ret']= $reply_to;
	$_SESSION['sm_smtp_port']= $port;
	$_SESSION['sm_smtp_authentification']= '##'.$auth.'##';
	$_SESSION['sm_smtp_login']= '##'.$username.'##';
	$_SESSION['sm_smtp_pass']= '##'.$pass.'##';
	$_SESSION['sm_smtp_function']= '##sm_smtp_user##';
	
	$phpmailer->Sender = $sender;
	$phpmailer->From = $sender;
	$phpmailer->FromName = $fromname;
	$phpmailer->AddReplyTo = $reply_to;
	$phpmailer->MessageID = $message_id;
	$phpmailer->Host = $host;
	$phpmailer->Port = $port;
	$phpmailer->SMTPAuth = $auth1;
	if($phpmailer->SMTPAuth){
		$phpmailer->Username =  $username;
		$phpmailer->Password = $pass;
	}
	/*
	if(!$phpmailer->Send()) {
    echo "Mailer Error: " . $phpmailer->ErrorInfo;
	sm_log_sent('','',$message_id,$host,$phpmailer->ErrorInfo);
    } else {
    echo "Message sent!";
	sm_log_sent('','',$message_id,$host,'sent');
	}
	*/
	// Send!
    $_SESSION["error"] ='sent';
		try{
    $phpmailer->IsSMTP();
    $_SESSION["error"] ="successfully sent";
    } catch(Exception $e){
    $_SESSION["error"] = $phpmailer->ErrorInfo;
	echo $phpmailer->ErrorInfo;
	echo "<br> ".$phpmailer->Host."";
	echo "<br> ".$phpmailer->Sender."";
	echo "<br> ".$phpmailer->SMTPAuth."";
	echo "<br> ".$phpmailer->Username."";
	echo "<br> ".$phpmailer->Password."";	
    }
	
	if(get_option('sm_debug')=="oui")
    {
            $phpmailer->SMTPDebug = 2;
            $phpmailer->debug     = 1;

    echo htmlspecialchars( var_export( $phpmailer, true ) );
	}

 


}
add_action('phpmailer_init','sm_smtp_user');

////////cron ////////////////
add_filter('cron_schedules', 'minutes');
if(!function_exists('minutes')){
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
sm_send_newsletter();
sm_send_article();
}
add_action('sm_crons', 'action_cron_minutes');

function action_cron15()
{
sm_cron_blocage();
sm_cron_bounce();
sm_cron_stats();
}
add_action('sm_crons15', 'action_cron15');

function action_cron_heure()
{
sm_cron_bounces_delete();
}
add_action('sm_crons_heure1', 'action_cron_heure');

function action_cron_heure4()
{
sm_cron_blacklist();
sm_cron_bounce_update();
sm_cron_bounce_update_liste();
}
add_action('sm_crons_heures4', 'action_cron_heure4');

function action_cron24()
{
sm_userwordpress_update();
sm_cron_license();
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
			'date_envoi' => current_time('mysql'),
			'login' => get_option('sm_smtp_user_login_stats'),
			'attachments' => '',
			'user_id' => get_option('sm_smtp_user_id_stats'),
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
$fivesdrafts = $wpdb->get_results("SELECT id_liste  FROM `".$table_hie."` WHERE id='".$smhie."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$id_liste =$fivesdraft->id_liste;
}
$listes = $wpdb->get_results("SELECT liste_bd  FROM `".$table_liste."` WHERE id='".$id_liste."'");
foreach ( $listes as $resliste ) 
{
$liste = $resliste->liste_bd;
$listese = $wpdb->get_results("SELECT email  FROM `".$liste."` WHERE id='$smemail'");
foreach ( $listese as $reslistee ) 
{
$email = $reslistee->email;
}
}
if(!isset($email)){ $email=""; }
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
$wpdb->query("UPDATE `".$resliste->liste_bd."` set `optin` = '1' WHERE `id`='".$email_id."' AND `cle`='".$cle."'");
}
return true;
}



function sm_userwordpress_update(){
global $wpdb;
$table_user_wordpress = $wpdb->prefix.'wordpress_user';
$blogusers = get_users( 'blog_id='.$GLOBALS['blog_id'].'' );
foreach ( $blogusers as $user ) {
$wpdb->query("INSERT IGNORE INTO ".$table_user_wordpress." FROM   `email`='".esc_html( $user->user_email )."',  `nom`  = '".esc_html( $user->display_name )."',`lg`= '".$_SERVER['HTTP_ACCEPT_LANGUAGE']."',`cle` = ".key_generate()."'");			  
}
	
}

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
if(!function_exists('ah_service_actif')){
 function ah_service_actif($user_login){
	 if(is_plugin_active('admin-hosting/admin-hosting.php')) {
	    if(get_serveur($user_login) =='1'){
		return 1;	
		}
		elseif(get_service($user_login) =='1'){
		return 2;		
		}
		else {
		return 3;		
		}

	 } else {
return 0;		 
	 }
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
	$table_bounces_log = $wpdb->prefix.'sm_bounces_log';
	$table_stats_smtp = $wpdb->prefix.'sm_stats_smtp';
	$table_blacklist = $wpdb->prefix.'sm_blacklist';
	$table_spamscore = $wpdb->prefix.'sm_spamscore';
	$table_suite = $wpdb->prefix.'sm_suite';
	$table_bounces_hard = $wpdb->prefix.'sm_bounces_hard';
    $table_envoi_name = $wpdb->prefix.'sm_historique_envoi'; 
	$table_bounces_log = $wpdb->prefix.'sm_bounces_log';
	$table_messageid=$wpdb->prefix.'sm_stats_messageid'; 
	$table_user_wordpress = $wpdb->prefix.'wordpress_user';  
if(get_option('sm_db_version') < '4.5'){
$wpdb->query("ALTER TABLE  `".$table_bounces_log."` ADD  `hie` INT NOT NULL AFTER  `fai`");	
}
if(get_option('sm_db_version') < '4.4'){
$wpdb->query("ALTER TABLE  `".$table_envoi_name."` CHANGE  `status`  `status` ENUM(  'En attente',  'En cours',  'Terminer',  'Limite',  'pause',  'reactiver',  'stop',  'erreur_flux',  'erreur_license',  'suite',  'suspended',  'bug',  'error',  'failed' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  'En attente'");	
$wpdb->query("ALTER TABLE  `".$table_envoi_name."` ADD  `txth` LONGTEXT NOT NULL");
$wpdb->query("ALTER TABLE  `".$table_envoi_name."` ADD  `sujet` LONGTEXT NOT NULL");
$wpdb->query("ALTER TABLE  `".$table_envoi_name."` ADD  `corps` LONGTEXT NOT NULL");
$wpdb->query("ALTER TABLE  `".$table_envoi_name."` ADD  `txtb` LONGTEXT NOT NULL");
$wpdb->query("ALTER TABLE  `".$table_envoi_name."` ADD  `txta` LONGTEXT NOT NULL");
$wpdb->query("ALTER TABLE  `".$table_envoi_name."` ADD  `attachments` LONGTEXT NOT NULL");
$wpdb->query("ALTER TABLE  `".$table_envoi_name."` ADD  `user_id` LONGTEXT NOT NULL");
$wpdb->query("ALTER TABLE  `".$table_envoi_name."` ADD  `fromname` LONGTEXT NOT NULL");
$wpdb->query("ALTER TABLE  `".$table_envoi_name."` ADD  `reply_to` LONGTEXT NOT NULL");
$wpdb->insert($table_liste, array(  
            'liste_bd' => $table_user_wordpress,  
            'liste_nom' => 'wordpress_user',
			'login' => $user_login,
));   
$wpdb->query("  
   CREATE TABLE IF NOT EXISTS `$table_user_wordpress` (
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
$wpdb->query("CREATE TABLE IF NOT EXISTS `$table_bounces_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idb` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `hie` varchar(250) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=322496 ;"); 

$wpdb->query("CREATE TABLE IF NOT EXISTS `".$table_messageid."` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `messageid` varchar(250) NOT NULL,
  `server` varchar(250) NOT NULL,
  `status` longtext NOT NULL,
  `hie` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `messageid` (`messageid`,`hie`),
  KEY `hie` (`hie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86980 ;"); 
}
if(get_option('sm_db_version') < '3.4'){	
$wpdb->query("ALTER TABLE  `".$table_liste."` ADD `login` VARCHAR( 250 ) NOT NULL DEFAULT 'admin'");
$wpdb->query("ALTER TABLE  `".$table_envoi_name."` ADD `login` VARCHAR( 250) NOT NULL DEFAULT 'admin'");
$wpdb->query("ALTER TABLE  `".$table_liste."` ADD `type` ENUM( 'perso', 'location' ) NOT NULL DEFAULT 'perso'");
$wpdb->query("ALTER TABLE  `".$table_envoi_name."` CHANGE  `status`  `status` ENUM(  'suite', 'En attente',  'En cours',  'Terminer',  'Limite',  'pause',  'reactiver',  'stop',  'erreur_flux',  'erreur_license' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  'En attente'");
}
if(get_option('sm_db_version') < '3.6'){	
$wpdb->query("ALTER TABLE  `".$table_bounces_log."` ADD  `hie` INT NOT NULL AFTER  `email`");
}
if(get_option('sm_db_version') < '3.4'){	
$wpdb->query("ALTER TABLE  `".$table_liste."` ADD `login` VARCHAR( 250 ) NOT NULL DEFAULT 'admin'");
$wpdb->query("ALTER TABLE  `".$table_envoi_name."` ADD `login` VARCHAR( 250) NOT NULL DEFAULT 'admin'");
$wpdb->query("ALTER TABLE  `".$table_liste."` ADD `type` ENUM( 'perso', 'location' ) NOT NULL DEFAULT 'perso'");
$wpdb->query("ALTER TABLE  `".$table_envoi_name."` CHANGE  `status`  `status` ENUM(  'suite', 'En attente',  'En cours',  'Terminer',  'Limite',  'pause',  'reactiver',  'stop',  'erreur_flux',  'erreur_license' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  'En attente'");
}
if(get_option('sm_db_version') < '2.6'){
$listes = $wpdb->get_results("SELECT liste_bd  FROM `".$table_liste."`");
foreach ( $listes as $resliste ) 
{
$wpdb->query("ALTER TABLE `".$resliste->liste_bd."` ADD `cle` VARCHAR( 250) NOT NULL DEFAULT 'Hysmqponisgz564', ADD INDEX (`cle`)");
$wpdb->query("ALTER TABLE `".$resliste->liste_bd."` ADD `optin` ENUM('0','1') NOT NULL DEFAULT '0' AFTER `bounces`");
}
update_option( 'sm_db_version', '2.6' );
}
if(get_option('sm_db_version') == '2.6' &&  get_option('sm_db_version') < '2.7'){
$wpdb->query("ALTER TABLE `".$table_temps."` ADD `cle` VARCHAR( 250) NOT NULL DEFAULT 'Hysmqponisgz564', ADD INDEX (`cle`)");
$wpdb->query("ALTER TABLE `".$table_suite."` ADD `cle` VARCHAR( 250) NOT NULL DEFAULT 'Hysmqponisgz564', ADD INDEX (`cle`)");
}
if(get_option('sm_db_version') == '2.7' &&  get_option('sm_db_version') < smDBVERSION){
$wpdb->query("ALTER TABLE `".$table_bounces_hard."` ADD `update` ENUM('0','1') NOT NULL DEFAULT '0' ");
$wpdb->query("ALTER TABLE `".$wpdb->prefix."sm_liste_test` ADD `optin` ENUM('0','1') NOT NULL DEFAULT '0' AFTER `bounces`");
$wpdb->query("ALTER TABLE `".$table_temps."` ADD `cle` VARCHAR( 250) NOT NULL DEFAULT 'Hysmqponisgz564', ADD INDEX (`cle`)");
$wpdb->query("ALTER TABLE `".$table_suite."` ADD `cle` VARCHAR( 250) NOT NULL DEFAULT 'Hysmqponisgz564', ADD INDEX (`cle`)");
}
if(get_option('sm_db_version') == '2.8' &&  get_option('sm_db_version') < smDBVERSION){
$wpdb->query("ALTER TABLE `".$table_envoi_name."` ADD `mode` ENUM('text/plain','text/html') NOT NULL DEFAULT 'text/html'");
}
if(get_option('sm_db_version') == '2.9' &&  get_option('sm_db_version') < smDBVERSION){
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
_e("mise a jour de la base de donnee du plugin e-mailing service","e-mailing-service");	
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


apply_filters('got_rewrite', true);

//remove_role('mailing-user');
if (!get_role('mailing-user')) {
	$role = add_role('mailing-user', 'E-mailing service V2',array(
        'publish_sm_modeles' => true,
        'edit_sm_modeles' => true,
        'edit_others_sm_modeles' => false,
        'delete_sm_modeles' => false,
        'delete_others_sm_modeles' => false,
        'mailing-user_private_sm_modeles' => false,
        'edit_sm_modeles' => true,
        'delete_sm_modeles' => true,
        'mailing-user_sm_modeles' => true, 
		 'delete_posts' => true,
         'edit_posts' => true,
	     'edit_published_posts' => true,
	     'publish_posts' => true,
	     'upload_files' => true,
        'read' => true,      
        )); 

}


add_filter( 'posts_where', 'HA_devplus_attachments_wpquery_where' );
function HA_devplus_attachments_wpquery_where( $where ){
	global $current_user;

	if( is_user_logged_in() ){
		// we spreken over een ingelogde user
		if( isset( $_POST['action'] ) ){
			// library query
			if( $_POST['action'] == 'query-attachments' ){
				$where .= ' AND post_author='.$current_user->data->ID;
			}
		}
	}

	return $where;
}



add_action('media_buttons','SM_select_shortcode',11);
function SM_select_shortcode(){

    global $shortcode_tags;

     $shortcodes_list = '&nbsp;<select id="sc_select"><option>'.__('Shortcode for newsletter','e-mailing-service').'</option>';
     $shortcodes_list .= '<option value=\'<a href="[lien_desabo]">'.__('Unsuscribe','e-mailing-service').'</a>\'>'.__('Link unsuscribe','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'<a href="[lien_page]">'.__('View online','e-mailing-service').'</a>\'>'.__('Link view online','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'<a href="[lien_affiliation]">'.__('Send a newsltter','e-mailing-service').'</a>\'>'.__('Link affiliate','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'[link_titre]\'>'.__('Title of article','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'[link]\'>'.__('Link to the article ','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'\'>----------------------'.__('Automatic shortcode on your information','e-mailing-service').'-----------------------</option>';
	 $shortcodes_list .= '<option value=\'[news-societe]\'>'.__('Your name','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'[news-adresse]\'>'.__('Adress','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'[news-tel]\'>'.__('your Phone','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'[news-fax]\'>'.__('Your fax','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'[news-link_facebook]\'>'.__('Facebook link','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'[news-link_google]\'>'.__('Google+ link','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'[news-link_twitter]\'>'.__('Twitter link','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'[news-link_linkedin]\'>'.__('Linkedin link','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'[news-tracking]\'>'.__('Tracking code','e-mailing-service').'</option>';
	  $shortcodes_list .= '<option value=\'\'>----------------------'.__('Automatic shortcode on contact list','e-mailing-service').'-----------------------</option>';
	 $shortcodes_list .= '<option value=\'[email]\'>'.__('Email customer','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'[nom]\'>'.__('Name customer','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'[champs1]\'>'.__('Row','e-mailing-service').' 1</option>';
	 $shortcodes_list .= '<option value=\'[champs2]\'>'.__('Row','e-mailing-service').' 2</option>';
	 $shortcodes_list .= '<option value=\'[champs3]\'>'.__('Row','e-mailing-service').' 3</option>';
	 $shortcodes_list .= '<option value=\'[champs4]\'>'.__('Row','e-mailing-service').' 4</option>';
	 $shortcodes_list .= '<option value=\'[champs5]\'>'.__('Row','e-mailing-service').' 5</option>';
	 $shortcodes_list .= '<option value=\'[champs6]\'>'.__('Row','e-mailing-service').' 6</option>';
	 $shortcodes_list .= '<option value=\'[champs7]\'>'.__('Row','e-mailing-service').' 7</option>';
	 $shortcodes_list .= '<option value=\'[champs8]\'>'.__('Row','e-mailing-service').' 8</option>';
	 $shortcodes_list .= '<option value=\'[champs9]\'>'.__('Row','e-mailing-service').' 9</option>';
     $shortcodes_list .= '<option value=\'\'>----------------------'.__('Automatic shortcode on your campaign','e-mailing-service').'-----------------------</option>';
	 $shortcodes_list .= '<option value=\'[date]\'>'.__('Date','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'[serveur]\'>'.__('Server ID','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'[auto]\'>'.__('Displays (your server) - (id of the campaign) - (id sends)','e-mailing-service').'</option>';
	 $shortcodes_list .= '<option value=\'[campagne]\'>'.__('Newsletter ID','e-mailing-service').'</option>';
	  $shortcodes_list .= '<option value=\'[hie]\'>'.__('campaign ID','e-mailing-service').'</option>';

     echo $shortcodes_list;
     echo '</select>';
}
add_action('admin_head', 'button_js');
function button_js() {
        echo '<script type="text/javascript">
        jQuery(document).ready(function(){
           jQuery("#sc_select").change(function() {
                          send_to_editor(jQuery("#sc_select :selected").val());
                          return false;
                });
        });
        </script>';
}

function sm_serveur_non_ok(){
	if ( is_admin() ) {
if(sm_getStatus(get_option('sm_smtp_server_1'),"25","1") !='1' && sm_getStatus(get_option('sm_smtp_server_1'),"587","1") !='1'){
echo '<div class="updated"><p>'.__('Attention smtp server is not active ! "E-mailing service" does not work properly if the smtp server is not active','e-mailing-service').' <br> 
<a href="http://www.e-mailing-service.net">'.__('Commander un serveur SMTP','e-mailing-service').'</a></p></div>';	
}
if(!get_option('sm_license_key')|| get_option('sm_license') =="free") { 
echo '<div class="updated"><p>'.__("Your license is not active ! FREE, activate your license allows you to have detailed statistics",'e-mailing-service').' <br> 
<a href="?page=e-mailing-service/admin/configuration.php">'.__('FREE, activate your license','e-mailing-service').'</a></p></div>';	
}
}
}
add_action('admin_notices', 'sm_serveur_non_ok');

include(smPATH . '/include/fonctions_sm.php');
require_once(dirname(__FILE__)."/sm_widget.php");
require_once(dirname(__FILE__)."/sm_dashboard.php");
sm_cron_fichier('include/cron_v5.php');
sm_cron_fichier('include/cron_auto_v3.php');
sm_cron_fichier('include/blacklist.php');
sm_cron_fichier('include/bounces.php');
sm_cron_fichier('include/bounces_update.php');
sm_cron_fichier('include/bounces_update_liste.php');	
sm_cron_fichier('include/bounces_delete.php');
sm_cron_fichier('include/cron_license.php');
sm_cron_fichier('include/cron_stats.php');
sm_cron_fichier('include/export.php');
?>