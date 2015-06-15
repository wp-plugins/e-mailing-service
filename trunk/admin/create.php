
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
echo "<br><h1>".__("Creation de votre newsletter","e-mailing-service")."</h1>";
echo "<h2>".__("Premiere etape , choisir le sujet et le modele","e-mailing-service")."</h2>";
echo '<form action="?page=e-mailing-service/admin/create.php" method="post">
<input name="action" type="hidden" value="editor" />
<input name="editeur" type="hidden" value="wordpress" />
    <form>
    <table>
    <tr><td>'.__("Sujet","e-mailing-service").'<td><input name="subject" type="text" size="100"/>&nbsp;&nbsp;</td></tr>
    <tr><td>'.__("Choisissez un modele","e-mailing-service").'&nbsp;&nbsp;</td>
    <td>
      <select name="modele_url" class="click" id="photo" onchange="photo">
        <option value="'.smURL.'admin/no-modele.php" selected="selected">'.__("Pas de modele","e-mailing-service").'</option>';
$listemodeles = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix.'posts'."` WHERE post_type='sm_modeles' ORDER BY id DESC");
foreach ( $listemodeles as $listemodele ) 
{
echo '<option value="'.get_site_url().'/?post_type=sm_modeles&p='.$listemodele->ID.'">'.$listemodele->post_name.'</option>';
}
echo ' </select></td></tr>
   <tr><td>'.__("Passez a l'etape 2","e-mailing-service").'</td><td>   <input name="submit" type="submit" value="create" class="button button-green" /></td></tr>
    </table>
    </form></div>
<br>
    <div id="preview">'.__("Apercu de la newsletter","e-mailing-service").'
      <div id="image"></div>
      <div id="Displaytitle"></div>
    </div>';

}
echo"
<style>
.left {
	width:400px;
	float:left;
	font-size:13px;
	color:#333;
	margin-right:20px;
}
.right {
	width:320px;
	float:left;
	margin-right:20px;
}
#preview {
	min-height:247px;
	background-color:#CCC;
	padding:10px;
	font-size:12px;
	color:#999;
	border:1px solid #CCC;
	width:870px;
}
#title {
	margin-top:10px;
	padding:5px;
	font-size:13px;
	color:#000;
	border:1px solid #CCC;
	font-family:Verdana, Geneva, sans-serif;
}
#photo {
	margin-bottom:10px;
}
#image {
	margin-top:5px;
}
#Displaytitle {
	font-size:14px;
	color:#333;
	margin-top:5px;
}
</style>";

?>
</div>
</section>
</div>
</section>