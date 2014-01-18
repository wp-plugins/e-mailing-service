<?php

define('MTMCE_URL', plugins_url('/', __FILE__));
 define('MTMCE_DIR', dirname(__FILE__));
 define('MTMCE_VERSION', '1.0');
 define( 'smPATH', trailingslashit(dirname(__FILE__)) );
define( 'smDIR', trailingslashit(dirname(plugin_basename(__FILE__))) );
define( 'smURL', plugin_dir_url(dirname(__FILE__)) . smDIR );
 
require_once (smPATH . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'class.client.php');
 function MyTinyMceButton_Init() {
 global $myTinyMce;
 
// Load translations
 load_plugin_textdomain('mytmceb', false, basename(rtrim(dirname(__FILE__), '/')) . '/languages');
 
// Load client
 $myTinyMce['client'] = new myTinyMceButton_Client();
 
// Admin
 if (is_admin()) {
 require_once (smPATH . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'class.admin.php');
 $myTinyMce['admin'] = new myTinyMceButton_Admin();
 
}
 }
 
add_action('plugins_loaded', 'MyTinyMceButton_Init');
?>