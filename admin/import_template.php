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
<?php _e("Reglage de vos alertes","e-mailing-service");?>
 </h2>
                </div>
         </div>
                 <section id="content">
            <div class="wrapper">                <section class="columns">                    

        <?php echo "<p>".__("Importer des modele pour vos clients","e-mailing-service")."</p>";?>
                    
                    <hr />
                    
                    <div class="grid_8">
<?php
$dossier_fichier=smPOST;
define('FS_CHMOD_FILE', 0664);
define('FS_CHMOD_DIR', 0775);
ini_set( "upload_max_filesize", "100M" );
ini_set( "post_max_size", "100M" );
extract($_POST);
extract($_GET);
function ScanDirectory($Directory,$template){
$i=1;
  $MyDirectory = opendir($Directory) or die('Erreur');
	while($Entry = @readdir($MyDirectory)) {
		if(is_dir($Directory.'/'.$Entry)&& $Entry != '.' && $Entry != '..') {
                         //echo '<ul>'.$Directory;
			ScanDirectory($Directory.'/'.$Entry,$template);
                        echo '</ul>';
		}
		else {
			//echo '<li>'.$Entry.'</li>';
			list($namef,$ext)=explode('.',$Entry);
			if($ext =="html"){
			//echo '<li><h1>'.$i.' - '.$Entry.'</h1></li>';
			$template[$i]=sm_copy_template($Directory,$Entry,$template);
			$i++;
			}
                }
	}
  closedir($MyDirectory);
}

function sm_copy_template($Directory,$Entry,$template){
$Directory=str_replace('//','/',$Directory);	
$fichier=''.$Directory.'/'.$Entry.'';
$dossier_fichier=smPOST;
$dossier=str_replace($dossier_fichier,"",$Directory);
$site="".smPOSTURL."".$dossier."";
//$site=str_replace(get_site_url(),'',$lien);
$code = file_get_contents($fichier);  
$code = preg_replace('!'.$fichier.'!isU', '', $code); 
preg_match('!<title>(.+)</title>!isU', $code, $title); 
preg_match_all('!http://[A-Za-z0-9][A-Za-z0-9\-\.]+[A-Za-z0-9]\.[A-Za-z]{2,}[\43-\176]*+!isU', $code, $lien); 
preg_match("/<body.*\/body>/s", $code, $body);
preg_match_all("/<img .*?(?=src)src=\"([^\"]+)\"/si", $code, $images);
$body=$body[0]; 
$variable = array_unique($images[1]);
//print_r($variable);
$xx=count($images[1]); 
for($i=0; $i < $xx; $i++){
	 if(isset($variable[$i])){   
  $imgd=$variable[$i];
  if (strpos($variable[$i],'http:') !== false) 
 {
 //echo 'externe -> <textarea name="txt" cols="100" rows="1">'.$variable[$i].'</textarea><br><img src="'.$variable[$i].'" /><br>';
 } else {
 $img =''.$site.'/'.$variable[$i].'';
 $body=str_replace($imgd,$img,$body);
 //echo 'interne -> <textarea name="txt" cols="200" rows="1">'.$imgd.'</textarea><br><img src="'.$img.'" /><br>';
 }
}}

	
$title=str_replace("<title>","",$title[0]);
$title=str_replace("</title>","",$title);
        
		$page_udp = array( 'post_title'     => "$template - $title",
                   'post_type'      => 'sm_modeles',
                   'post_name'      => $title,
                   'post_content'   => $body,
                   'post_status'    => 'publish',
                   'comment_status' => 'closed',
                   'ping_status'    => 'closed',
                   'post_author'    => 1,
                   'menu_order'     => 0,
				   'tags_input'  => $title
                   );

        $PageID = wp_insert_post( $page_udp, FALSE );
		echo '<br> ---> '.__("Creation template","e-mailing-service").' <a href="'.get_site_url().'/?post_type=sm_modeles&p='.$PageID.'" target="_blank">'.$template.' - '.$title.'</a>';
				
}
?>
<h2><?php echo _e("Importation de template","e-mailing-service");?>  : </h2>
<h3><?php echo _e("Le plugin a ete teste avec les design pour le marketing par email : ","e-mailing-service");?> <a href="http://themeforest.net/category/marketing/email-templates?ref=tous1site" target="_blank">Themeforest</a> </h3>
<p><?php _e("Fichier ZIP","e-mailing-service")?></p>
<form action="<?php $_SERVER['PHP_SELF'];?>" name="form_bdd" id="form_bdd" method="post" enctype="multipart/form-data">
<input type="file" name="fichiercsv" size="16">
<input type="hidden" name="action" value="import">
<input type="hidden" name="etape" value="2">
<input type="submit" value="Importer le fichier"> 
</form>
<?php 
WP_Filesystem();
if(isset($etape)){
if($etape == 2){
$content_dir = $dossier_fichier;
$MAXIMUM_FILESIZE = 20 * 1024 * 1024; 
$tmp_file = $_FILES['fichiercsv']['tmp_name'];
$type_file = $_FILES['fichiercsv']['type'];
$name_file = $_FILES['fichiercsv']['name'];
list($nomf,$extension)=explode(".",$name_file);
$extensions_valides = array( 'zip');
      if ( in_array($extension,$extensions_valides) ){
      if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
       {
           exit("".__("Impossible de copier le fichier dans $content_dir, verifier les droits ou l'espace disque de votre serveur","e-mailing-service")."");
       }

       ?>
<p><?php _e("Le fichier","e-mailing-service");?> <span style="color:#00f"><strong><?php echo '<a href="'.$content_dir.'/'.$name_file.'">'.$name_file.'</a>'?></strong></span><?php _e(" a bien &eacute;t&eacute; upload&eacute;","e-mailing-service");?></p>
       <?php
	   sleep(5);
      $zip = new ZipArchive;
      $zipped = $zip->open(''.$dossier_fichier.''.$name_file.'');
      if ( $zipped ) {
      $zip->extractTo(''.$dossier_fichier.''.$nomf.'');
      $zip->close();
      unlink(''.$dossier_fichier.''.$name_file.'');
      }
	  }
?>
<form action="<?php $_SERVER['PHP_SELF'];?>" name="form_bdd" id="form_bdd" method="post" enctype="multipart/form-data">
<input type="hidden" name="dossier"value="<?php echo ''.$dossier_fichier.''.$nomf.'';?>">
<input type="hidden" name="action" value="import">
<input type="hidden" name="template" value="<?php echo ''.$nomf.'';?>">
<input type="hidden" name="etape" value="3">
<input type="submit" value="<?php _e("Terminer la creation de modele","e-mailing-service");?>"> 
</form>
<?php
}
if($etape == 3){
$dir = "".$dossier."/";
ScanDirectory($dir,$template);
}
}

?>

</div></div></div></div>

</div>

