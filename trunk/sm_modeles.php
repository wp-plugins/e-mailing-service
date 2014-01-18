<?php
require_once(dirname(__FILE__).'/include/mceplugins.class.php');

new sm_modeles();

class sm_modeles {

private $version     = '1';
private $db_version  = '1';
private $post_type   = 'sm_modeles';
private $meta_param  = '_sm_modeles-share';
private $table       = 'posts';
private $base_url;


function __construct()
{
    $this->base_url = plugins_url(dirname(plugin_basename(__FILE__)));
    register_activation_hook(__FILE__, array(&$this, 'activation'));
    add_action('plugins_loaded', array(&$this, 'plugins_loaded'));
    add_action('save_post', array(&$this, 'save_post'));
    add_filter('mce_css', array(&$this, 'mce_css'));
    add_action('admin_head', array(&$this, 'admin_head'));
    add_action('admin_footer-post-new.php', array(&$this, 'admin_footer'));
    add_action('wp_ajax_sm_modeles', array(&$this, 'wp_ajax'));
    add_action('post_submitbox_start', array(&$this, 'post_submitbox_start'));
    add_filter('post_row_actions', array(&$this, 'row_actions'),10,2);
    add_filter('page_row_actions', array(&$this, 'row_actions'),10,2);
    add_filter('parse_query', array(&$this, 'parse_query'));
    add_action(
        'wp_before_admin_bar_render',
        array(&$this, 'wp_before_admin_bar_render')
    );
}

public function wp_before_admin_bar_render() {
    global $wp_admin_bar;
    if (is_single() || is_page()) {
        $wp_admin_bar->add_menu(array(
            'parent' => 'edit',
            'id' => 'new_template',
            'title' => __('Copie comme nouveau modele', 'sm_modeles'),
            'href' => $this->get_copy_template_url(get_the_ID())
        ));
    }
}

public function row_actions($actions, $post)
{
    $actions['copy_to_template'] = sprintf(
        '<a href="%s">%s</a>',
        $this->get_copy_template_url($post->ID),
        __('Copie comme nouveau modele', 'sm_modeles')
    );
    return $actions;
}

public function post_submitbox_start()
{
    if (isset($_GET['post']) && intval($_GET['post'])) {
?>
<div id="duplicate-action">
    <a class="submitduplicate duplication"
        href="<?php echo $this->get_copy_template_url($_GET['post']) ?>"><?php _e('Copie comme nouveau modele', 'e-mailing-service'); ?></a>
</div>
<?php
    }
}

public function activation()
{
    if (get_option("sm_modeles_db_version") == $this->db_version) {
        return;
    }

    global $wpdb;
    update_option("sm_modeles_db_version", $this->db_version);
    $sql = $wpdb->prepare('show tables like %s', $wpdb->prefix.$this->table);
    if ($wpdb->get_var($sql)) {
        $sql = "select * from ".mysql_real_escape_string($wpdb->prefix.$this->table);
        $res = $wpdb->get_results($sql);
        foreach ($res as $tpl) {
            $post = array();
            $post['post_title']   = $tpl->name;
            $post['post_content'] = $tpl->html;
            $post['post_excerpt'] = $tpl->desc;
            $post['post_author']  = $tpl->author;
            $post['post_date']    = $tpl->modified;
            $post['post_type']    = $this->post_type;
            $post['post_status']    = 'publish';
            $id = wp_insert_post($post);
            if ($id) {
                update_post_meta($id, $this->meta_param, $tpl->share);
            }
        }
    }
}


public function plugins_loaded()
{
    load_plugin_textdomain(
        'sm_modeles',
        false,
        dirname(plugin_basename(__FILE__)).'/languages'
    );
    $this->addCustomPostType();
}

private function fixed_role_issue()
{
        global $wp_roles;
        $roles = array('administrator', 'editor');
        foreach ($roles as $r) {
            $wp_roles->add_cap($r, "edit_others_posts");
        }
}

public function mce_css($css)
{
    $files   = preg_split("/,/", $css);
    $files[] = $this->base_url.'/editor.css';
    $files   = array_map('trim', $files);
    return join(",", $files);
}

public function admin_head(){
    if (version_compare($this->version, get_option('sm_modeles-version', 0))) {
        // bug recovery for 2.8.0
        $this->fixed_role_issue();
        update_option("sm_modeles-version", $this->version);
    }
    $plugin = $this->base_url.'/plugins/template/editor_plugin.js';

    $url    = admin_url('admin-ajax.php');
    $url    = add_query_arg('action', 'sm_modeles', $url);
    $url    = add_query_arg('action', 'sm_modeles', $url);
    $nonce  = wp_create_nonce("sm_modeles");
    $url    = add_query_arg('nonce', $nonce, $url);

    $inits['template_external_list_url'] = $url;
    $inits['template_popup_width']       = 600;
    $inits['template_popup_height']      = 500;

    new tinymcePlugins(
        'template',
        $plugin,
        array(&$this, 'addButton'),
        $inits
    );
    
    if (get_post_type() === $this->post_type) {
        if (get_option("sm_modeles_db_version") != $this->db_version) {
            $this->activation();
        }
        global $hook_suffix;
        if ($hook_suffix === 'post.php' || $hook_suffix === 'post-new.php') {
            remove_meta_box('slugdiv', $this->post_type, 'normal');
            if (get_option("sm_modeles_db_version") != $this->db_version) {
                $this->activation();
            }
            echo '<style>#visibility{display:none;}</style>';
        } elseif ($hook_suffix === 'edit.php') {
            add_filter("display_post_states", array(&$this, "display_post_states"));
        }
    }
	
}

public function display_post_states($stat)
{
    $share = get_post_meta(get_the_ID(), $this->meta_param, true);
    if ($share) {
        $stat[] = __('Partager', 'sm_modeles');
    }
    return $stat;
}

public function save_post($id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $id;

    if (isset($_POST['action']) && $_POST['action'] == 'inline-save')
        return $id;

    $p = get_post($id);
    if ($p->post_type === $this->post_type) {
        $me = wp_get_current_user();
        if ($p->post_author != $me->ID) {
            wp_die(__("Permission refuse","e-mailing-service"));
        }
        if (isset($_POST[$this->meta_param]) && $_POST[$this->meta_param]) {
            update_post_meta($id, $this->meta_param, 1);
        } else {
            delete_post_meta($id, $this->meta_param);
        }
    }
}

public function addButton($buttons = array())
{
    array_unshift($buttons, '|');
    array_unshift($buttons, 'template',"button_green");
    return $buttons;
}

private function addCustomPostType()
{

$args = array(
        'label' => __('Modeles','e-mailing-service'),
        'labels' => array(
            'singular_name' => __('Modeles','e-mailing-service'),
            'add_new_item' => __('Ajouter un modele','e-mailing-service'),
            'edit_item' => __('Modifier le modele','e-mailing-service'),
            'add_new' => __('Nouveau','e-mailing-service'),
            'new_item' => __('Nouveau modele','e-mailing-service'),
            'view_item' => __('Visualiser le modele','e-mailing-service'),
            'not_found' => __('Pas de modele .','e-mailing-service'),
            'not_found_in_trash' => __('Pas de modele.','e-mailing-service'),
            'search_items' => __('Chercher un modele','e-mailing-service'),
        ),
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => false,
        'show_in_nav_menus' => false,
        'register_meta_box_cb' => array(&$this, 'addMetaBox'),
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'revisions',
            'author',
        )
    );
    register_post_type($this->post_type, $args);
}


public function addMetaBox()
{
    add_meta_box(
        'sm_modeles-share',
        __('Partager', 'sm_modeles'),
        array(&$this, 'sharedMetaBox'),
        $this->post_type,
        'side',
        'low'
    );


}



public function sharedMetaBox($post, $box)
{
    $share = get_post_meta($post->ID, $this->meta_param, true);
    echo '<select name="'.$this->meta_param.'">';
    echo '<option value="0">'.__('Prive', 'e-mailing-service').'</option>';
    if ($share) {
        echo '<option value="1" selected="selected">'.__('Partager', 'e-mailing-service').'</option>';
    } else {
        echo '<option value="1">'.__('Partager', 'e-mailing-service').'</option>';
    }
    echo '</select>';
}

public function admin_footer()
{
    if (get_post_type() === $this->post_type) {
        if (isset($_GET['origin']) && intval($_GET['origin'])) {
            $origin = get_post(intval($_GET['origin']));
            if ($origin) {
                $template = array(
                    'post_title' => $origin->post_title,
                    'post_content' => wpautop($origin->post_content),
                );
                $template = json_encode($template);
                echo <<<EOL
<script type="text/javascript">
var origin = {$template};
jQuery('#title').val(origin.post_title);
jQuery('#content').val(origin.post_content);
</script>
EOL;
            }
        }
    }
}

public function wp_ajax()
{
    nocache_headers();
    if (!wp_verify_nonce($_GET['nonce'], 'sm_modeles')) {
        return;
    }
    $u = wp_get_current_user();
    header( 'Content-Type: application/x-javascript; charset=UTF-8' );
    if (isset($_GET['template_id']) && intval($_GET['template_id'])) {
        $p = get_post($_GET['template_id']);
        if ($p->post_status === 'publish') {
            if (intval($u->ID) && (intval($u->ID) === intval($p->post_author))) {
                echo apply_filters(
                    "sm_modeles",
                    wpautop($p->post_content),
                    stripslashes($p->post_content)
                );
            } else {
                $share = get_post_meta($p->ID, $this->meta_param, true);
                if ($share || current_user_can('administrator')) {
                    echo apply_filters(
                        "sm_modeles",
                        wpautop($p->post_content),
                        stripslashes($p->post_content)
                    );
                }
            }
        }
        exit;
    }
    $p = array(
        'post_status' => 'publish',
        'post_type'   => $this->post_type,
        'orderby'     => 'date',
        'order'       => 'DESC',
        'numberposts' => -1,
    );
    $posts = get_posts($p);

    $url    = admin_url('admin-ajax.php');
    $url    = add_query_arg('action', 'sm_modeles', $url);
    $nonce  = wp_create_nonce("sm_modeles");
    $url    = add_query_arg('nonce', $nonce, $url);

    $arr = array();
    foreach ($posts as $p) {
        if (intval($u->ID) && (intval($u->ID) !== intval($p->post_author))) {
            $share = get_post_meta($p->ID, $this->meta_param, true);
            if (!$share && !current_user_can('administrator')) {
                continue;
            }
        }
        $ID = intval($p->ID);
        $name = esc_html(apply_filters('tinymce_template_title', $p->post_title));
        $desc = esc_html(apply_filters('tinymce_template_excerpt', $p->post_excerpt));
        $url  = add_query_arg('template_id', $ID, $url);
        $arr[] = array($name, $url, $desc);
    }
    echo 'var tinyMCETemplateList = '.json_encode($arr);
    exit;
}

public function parse_query($q)
{
    if (is_admin() && !current_user_can('administrator') && empty($q->query['suppress_filters']) && $q->query['post_type'] === $this->post_type) {
        $uid = get_current_user_id();
        $q->set('author', $uid);
        return $q;
    } else {
        return $q;
    }
}

private function get_copy_template_url($id)
{
    return admin_url('post-new.php?post_type=sm_modeles&origin='.intval($id));
}


} // end class sm_modeles


// eof
