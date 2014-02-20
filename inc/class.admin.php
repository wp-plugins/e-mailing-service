<?php
class myTinyMceButton_Admin{

	function __construct() {
		// init process for button control
		add_action( 'admin_init', array (&$this, 'addButtons' ) );
		add_action( 'wp_ajax_mybutton_shortcodePrinter', array( &$this, 'wp_ajax_fct' ) );
	}
	
	/*
	* The content of the javascript popin for the insertion
	*
	*/
	function wp_ajax_fct(){
		?>
		<h2><?php _e("My shortcode button", 'mytmceb');?></h2>
		<p>
			<?php _e("Category: ", 'mytmceb');?><br /><?php wp_dropdown_categories(array('name' => 'mcb_category', 'id' => 'mcb_category'));?>
		</p>
		<p>
			<?php _e("Number of posts: ", 'mytmceb');?><br />
			<input type="number" min="-1" name="mcb_number" id="mcb_number" value="-1" />
		</p>
		<p class="description">
			<?php esc_html_e("Number of posts to display. -1 for no limits.", 'mytmceb');?>
		</p>
		<input name="mcb_button" id="mcb_button" type="submit" class="button-primary" value="<?php _e("Insert the Event", 'cilive');?>">
		<?php die();
	}

	/*
	* Add buttons to the tiymce bar
	*/
	function addButtons() {
		// Don't bother doing this stuff if the current user lacks permissions
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return false;
	
		if ( get_user_option('rich_editing') == 'true') {
			add_filter('mce_external_plugins', array (&$this,'addScriptTinymce' ) );
			add_filter('mce_buttons', array (&$this,'registerTheButton' ) );
		}
	}

	/*
	* Add buttons to the tiymce bar
	*
	*/
	function registerTheButton($buttons) {
		array_push($buttons, "|", "mybutton");
		return $buttons;
	}

	/*
	* Load the custom js for the tinymce button
	*

	*/
	function addScriptTinymce($plugin_array) {
		$plugin_array['mybutton'] = MTMCE_URL. '/inc/ressources/tinymce.js';
		return $plugin_array;
	}

	}
?>