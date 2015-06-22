 <div id="wrapper">
        <header id="page-header">
             <div class="wrapper">
<?php 
if ( is_plugin_active( 'admin-hosting/admin-hosting.php' ) ) {
	include(AH_PATH . '/include/entete.php');
} else {
	include(smPATH . '/include/entete.php');
}
if($user_role == 'administrator'){
?>
                </div>
        </header>
</div>
             <div id="page-subheader">
                <div class="wrapper">
 <h2>
<?php _e("Message","e-mailing-service");?>
 </h2>
                </div>
         </div>
                 <section id="content">
            <div class="wrapper">                <section class="columns">                    

        <?php echo "<p>".__("Liste des messages que vous avez reçu à l'aide du formulaire de contact, pour afficher le formulaire il suffit de coller sur votre page de contact le shortcode suivant","e-mailing-service")." [sm_form_contact name=yes][/sm_form_contact]</p>";?>
                    
                    <hr />
                    
                    <div class="grid_8"><?php
    $tbaleau_insert = '<table class="widefat">
                         <thead>';
    $tbaleau_insert .= "<tr>";
	$tbaleau_insert .= "<th><blockquote>".__('ID',"e-mailing-service")."</blockquote></th>";
	$tbaleau_insert .= "<th><blockquote>".__('Date',"e-mailing-service")."</blockquote></th>";
	$tbaleau_insert .= "<th><blockquote>".__('Sujet',"e-mailing-service")."</blockquote></th>";
	$tbaleau_insert .= "<th><blockquote>".__('Message',"e-mailing-service")."</blockquote></th>";
    $tbaleau_insert .= '</tr>           
        </thead>
        <tbody>';
$listeemail = $wpdb->get_results("SELECT * FROM `".$table_posts."` WHERE post_type='message' ORDER BY post_date DESC");
foreach ( $listeemail as $listeemails ) 
{
    
	$tbaleau_insert .= "<tr>
    <td><blockquote><a href=\"post.php?post=".$listeemails->ID."&action=edit\" target=\"_blank\">".$listeemails->ID."</a></blockquote></td>
	<td><blockquote>".$listeemails->post_date."</blockquote></td>
	<td><blockquote>".$listeemails->post_title."</blockquote></td>
	<td><blockquote>".substr($listeemails->post_content,0,300)."</blockquote></td>
    </tr>";
		$tbaleau_insert .= "<tr>
    <td><blockquote>xxxxxxxxxxxxxxxxxxxxxxxx</blockquote></td>
	<td><blockquote>xxxxxxxxxxxxxxxxxxxxxxxx</blockquote></td>
	<td><blockquote>xxxxxxxxxxxxxxxxxxxxxxxx</blockquote></td>
	<td><blockquote>xxxxxxxxxxxxxxxxxxxxxxxx</blockquote></td>
    </tr>";
}
$tbaleau_insert .= '</tbody></table>';
echo $tbaleau_insert ;
}
?>