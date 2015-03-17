<?php
global $wpdb;
if(!isset($SMINCLUDEOK)){
include(smPATH . '/include/fonctions_sm.php');
}
date_default_timezone_set('Europe/Paris');
$table_envoi= $wpdb->prefix.'sm_historique_envoi';
$table_posts= $wpdb->prefix.'posts';
$table_liste= $wpdb->prefix.'sm_liste';
$table_temps= $wpdb->prefix.'sm_temps';
$table_suite= $wpdb->prefix.'sm_suite';
$table_log= $wpdb->prefix.'sm_log';
if(!isset($_GET["id"])){
$id=1;	
} else { $id=$_GET["id"]; }
echo '<h2>'.__("Test importation d'image sur l'envoi numero","e-mailing-service").' '.$id.'</h2><br>';
echo '<p>'.__("Pour tester sur un autre envoi rentrer son identifiant dans le formulaire ci-dessous","e-mailing-service").'</p><br>';
echo '<form action="admin.php?page=e-mailing-service/admin/debug.php&section=upload" method="get" target="_parent">
<input type="text" name="id" value="" />
<input type="hidden" name="page" value="e-mailing-service/admin/debug.php" />
<input type="hidden" name="section" value="upload" />
<input name="envoyer" type="submit" value="'.__("envoyer").'"/></form><br>';
$fivesdrafts = $wpdb->get_results("SELECT id AS hie,id_newsletter,id_liste,pause,status,serveur,mode FROM `".$table_envoi."` WHERE id='".$id."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{

	    $titre=get_post_field('post_title', $fivesdraft->id_newsletter);
		$lien=get_post_field('guid', $fivesdraft->id_newsletter);
		$title=sm_schortode($titre);
	    $post_content =sm_schortode(sm_affiche_template($titre,$lien));
		
$post_id=$fivesdraft->id_newsletter;
global $current_blog;
if ( is_multisite() ) {
$repertoire = ''.smPOSTURL.''.$current_blog->blog_id.'/img/'.$post_id.'';
$repertoire1 =''.smPOST.''.$current_blog->blog_id.'';
$repertoire2=''.smPOST.''.$current_blog->blog_id.'/img';
$repertoire3=''.smPOST.''.$current_blog->blog_id.'/img/'.$post_id.'';
$repertoire_path= ''.smPOST.''.$current_blog->blog_id.'/img/'.$post_id.'';
if(!is_dir(''.smPOST.''.$current_blog->blog_id.'')){
mkdir(''.smPOST.''.$current_blog->blog_id.'', 0777);
		   }
if(!is_dir(''.smPOST.''.$current_blog->blog_id.'/img')){
mkdir(''.smPOST.''.$current_blog->blog_id.'/img', 0777);
		   }
if(!is_dir(''.smPOST.''.$current_blog->blog_id.'/img/'.$post_id.'')){
mkdir(''.smPOST.''.$current_blog->blog_id.'/img/'.$post_id.'', 0777);
		   }
	
} else {
$repertoire = ''.smPOSTURL.'1/img/'.$post_id.'';
$repertoire1 =''.smPOST.'1';
$repertoire2 =''.smPOST.'1/img';
$repertoire3 =''.smPOST.'1/img/'.$post_id.'';
$repertoire_path = ''.smPOST.'1/img/'.$post_id.'';
if(!is_dir(''.smPOST.'1')){
mkdir(''.smPOST.'1', 0777);
		   }
if(!is_dir(''.smPOST.'1/img')){
mkdir(''.smPOST.'1/img', 0777);
		   }
if(!is_dir(''.smPOST.'1/img/'.$post_id.'')){
mkdir(''.smPOST.'1/img/'.$post_id.'', 0777);
		   }
		
}

  
		   

	preg_match_all("/<img .*?(?=src)src=\"([^\"]+)\"/si", $post_content, $images); 
    $xx=count($images[1]); 
	for($i=0; $i < $xx; $i++){
     $size = @getimagesize($images[1][$i]); 
switch ($size['mime']) { 
    case "image/gif": 
$extension=".gif"; 
        break; 
    case "image/jpeg": 
$extension=".jpg";
        break; 
    case "image/png": 
$extension=".png";
        break; 
    case "image/bmp": 
$extension=".bmp"; 
        break; 
}

 if($extension == ".gif" || $extension == ".jpg" || $extension == ".bmp" || $extension == ".png"){
@file_put_contents(''.$repertoire_path.'/'.$i.''.$extension.'', file_get_contents($images[1][$i]));
@chmod(''.$repertoire_path.'/'.$i.''.$extension.'',0644);
$post_content=str_replace($images[1][$i],''.$repertoire.'/'.$i.''.$extension.'',$post_content);
 if(get_option('sm_debug')=="oui")
    {
echo 'upload : '.$repertoire.'/'.$i.''.$extension.'<br>';
if(is_dir($repertoire1)){
} else {
echo ''.__('upload','e-mailing-service').' : '.__('impossible verifier les droit 0777 sur le dossier','e-mailing-service').''.$repertoire1.' <br>';	
}	
if(is_dir($repertoire2)){
} else {
echo ''.__('upload','e-mailing-service').' : '.__('impossible verifier les droit 0777 sur le dossier','e-mailing-service').' '.$repertoire2.' <br>';	
}	
if(is_dir($repertoire3)){
} else {
echo ''.__('upload','e-mailing-service').' : '.__('impossible verifier les droit 0777 sur le dossier','e-mailing-service').' '.$repertoire3.' <br>';	
}	
if(@file(''.$repertoire.'/'.$i.''.$extension.'')){
echo ''.__('upload','e-mailing-service').' : '.__('correct','e-mailing-service').'<br>';
} else {
echo ''.__('upload','e-mailing-service').' : '.__('impossible verifier les droit 0777 sur le dossier','e-mailing-service').' '.$repertoire.' <br>';	
}
	}
}
	}
 

}
?>