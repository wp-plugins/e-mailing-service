	<!-- jQuery and jQuery UI -->
	<script src="../editor/js/jquery-1.6.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="../editor/js/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8">

	<!-- elRTE -->
	<script src="../editor/js/elrte.min.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="css/elrte.min.css" type="text/css" media="screen" charset="utf-8">

	<!-- elRTE translation messages -->
	<script src="../editor/js/i18n/elrte.ru.js" type="text/javascript" charset="utf-8"></script>

	<script type="text/javascript" charset="utf-8">
		$().ready(function() {
			var opts = {
				cssClass : 'el-rte',
				lang     : 'fr',
				height   : 450,
				toolbar  : 'maxi',
				cssfiles : ['css/elrte-inner.css']
			}
			$('#editor').elrte(opts);
		})
	</script>
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
if($action=="save") {
		$page_udp = array( 'post_title'     => $_POST["subject"],
                   'post_type'      => 'newsletter',
                   'post_name'      => $_POST["subject"],
                   'post_content'   => $_POST['editor'],
                   'post_status'    => 'publish',
                   'comment_status' => 'closed',
                   'ping_status'    => 'closed',
                   'post_author'    => $user_id,
                   'menu_order'     => 0,
				   'tags_input'  => $_POST["subject"]
                   );

        $PageID = wp_insert_post( $page_udp, FALSE );
		?>
<form action="?page=e-mailing-service/admin/editor.php" method="post">
<input name="action" type="hidden" value="save" />
<input name="subject" type="hidden" value="<?php echo $_POST['subject'];?>" />
<div class="message info">
<div id="editor">
<?php echo stripslashes($_POST['editor']);?>
</div>
</div>
</form>	
<?php }
elseif($action=='edit'){
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."posts` WHERE ID='".$id."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
echo '<form action="?page=e-mailing-service/admin/editor.php" method="post">
<input name="action" type="hidden" value="save" />
<input name="subject" type="hidden" value="'.$fivesdraft->post_name.'" />
<div class="message info">
<div id="editor">
'.stripslashes($fivesdraft->post_content).'
</div>
</div>
</form>';	
}
}
elseif($action=="editor") {

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

echo '<div class="message info">';
echo "<br><h1>".__("Creation de votre newsletter","e-mailing-service")."</h1>";
echo "<p>".__("Modifier les textes et les images (pour copier directement du code html , mettez l'onglet en bas à gauche sur source)","e-mailing-service")."</p>";
echo "<p>".__("Pour enregister votre newsletter cliquez sur la disquette","e-mailing-service")."</p><br>";
?>
<form action="?page=e-mailing-service/admin/editor.php" method="post">
<input name="subject" type="hidden" value="<?php echo $_POST['subject'];?>" />
<input name="action" type="hidden" value="save" />
<div id="editor">
<?php echo $modele_code;?>
</div>
</form>
<?php
echo '</div>';
}
}

//fin du menu action
}
?>
</div>
</section>
</div>
</section>