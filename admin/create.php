
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
<?php _e("Assistant de creation de newsletter","e-mailing-service");?>
 </h2>
                </div>
         </div>
                 <section id="content">
            <div class="wrapper">                <section class="columns">                    

        <?php //echo "<p>".__("La liste de diffusion sert a classer les emails de vos clients par categories","e-mailing-service")."</p>";?>
                    
                    <br />
                    
                    <div class="grid_8"><?php

extract($_POST);
if(isset($action)){

if($action=="editor") {

	if( $_POST["modele_url"] == ''.smURL.'admin/no-modele.php'){
$modele_code='';		
	} else {
$modele_code=file_get_contents($_POST["modele_url"]);	
	}
if($_POST['editeur'] == "wordpress"){
		$page_udp = array( 'post_title'     => $_POST["subject"],
                   'post_type'      => 'newsletter',
                   'post_name'      => $_POST["subject"],
                   'post_content'   => $modele_code,
                   'post_status'    => 'publish',
                   'comment_status' => 'closed',
                   'ping_status'    => 'closed',
                   'post_author'    => $user_id,
                   'menu_order'     => 0,
				   'tags_input'  => $_POST["subject"]
                   );

        $PageID = wp_insert_post( $page_udp, FALSE );
		echo '<meta http-equiv="refresh" content="0; url=post.php?post='.$PageID.'&action=edit">';
} else {

		$page_udp = array( 'post_title'     => $_POST["subject"],
                   'post_type'      => 'newsletter',
                   'post_name'      => $_POST["subject"],
                   'post_content'   => $modele_code,
                   'post_status'    => 'publish',
                   'comment_status' => 'closed',
                   'ping_status'    => 'closed',
                   'post_author'    => $user_id,
                   'menu_order'     => 0,
				   'tags_input'  => $_POST["subject"]
                   );

        $PageID = wp_insert_post( $page_udp, FALSE );
		echo '<meta http-equiv="refresh" content="0; url=?page=e-mailing-service/admin/editor.php&action=edit&id='.$PageID.'">';
}
}
//fin du menu action
} else {
echo '<div class="message success">';
echo "<br><h1>".__("Création de votre newsletter","e-mailing-service")."</h1>";
echo "<h2>".__("Premiere etape , choisir le sujet et le modele","e-mailing-service")."</h2>";
echo '<form action="?page=e-mailing-service/admin/create.php" method="post">
<input name="action" type="hidden" value="editor" />
    <form>
    <table>
	<tr><td>'.__("Choisissez un editeur","e-mailing-service").'&nbsp;&nbsp;<td><p>
  <label><input name="editeur" type="radio" id="editeur_0" value="wordpress" checked="checked" />wordpress</label>
  <label><input type="radio" name="editeur" value="autre" id="editeur_1" />autre</label>
</td></tr>
    <tr><td>'.__("Sujet","e-mailing-service").'<td><input name="subject" type="text" size="100"/>&nbsp;&nbsp;</td></tr>
    <tr><td>'.__("Choisissez un modele","e-mailing-service").'&nbsp;&nbsp;</td>
    <td>
      <select name="modele_url" class="click" id="photo">
        <option value="'.smURL.'admin/no-modele.php" selected="selected">'.__("Pas de modele","e-mailing-service").'</option>';
$listemodeles = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix.'posts'."` WHERE post_type='sm_modeles' ORDER BY id DESC");
foreach ( $listemodeles as $listemodele ) 
{
echo '<option value="'.get_site_url().'/?post_type=sm_modeles&p='.$listemodele->ID.'">'.$listemodele->post_name.'</option>';
}
echo ' </select></td></tr>
   <tr><td>'.__("Passez à l'etape 2","e-mailing-service").'</td><td>   <input name="submit" type="submit" value="create" class="button button-green" /></td></tr>
    </table>
    </form></div>
<br>
    <div id="preview">'.__("Aperçu de la newsletter","e-mailing-service").'
      <div id="image"></div>
      <div id="Displaytitle"></div>
    </div>';

}
echo "<script type=\"text/javascript\">
$(document).ready(function(){
$('#preview').hide();	
$('#photo').click(update);
$('#title').keypress(update);
});
	
function update(){		
		
$('#preview').slideDown('slow');
var title = $('#title').val();
var photo = $('#photo').val();
$('#Displaytitle').html(title);
$('#image').html('<iframe src=\"'+photo+'\" width=\"99%\" height=\"900\" scrolling=\"no\" align=\"middle\"></iframe>');
}
</script>";
?>
</div>
</section>
</div>
</section>