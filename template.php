<?php global $wp,$wpbd;
$postid = get_the_ID();
 $billet = get_post($postid);
 $title = $billet->post_title;
 $date = $billet->post_date;
 $contenu = $billet->post_content;
 $contenu = str_replace(']]>', ']]&gt;', $contenu);
 if(isset($_SESSION["sm_emailid"]) && isset($_SESSION["sm_hie"])){
$table_envoi= $wpdb->prefix.'sm_historique_envoi';
$table_liste= $wpdb->prefix.'sm_liste';
	$req_smliste= $wpdb->get_results("SELECT id_liste FROM `".$table_envoi."` WHERE id='".$_SESSION["sm_hie"]."'");
    foreach ( $req_smliste as $req_smlistes ) 
    {
	$idliste=$req_smlistes->id_liste;	
	}
	$req_smbd= $wpdb->get_results("SELECT liste_bd FROM  `".$table_liste."` WHERE id='".$idliste."'");
    foreach ( $req_smbd as $req_smbds ) 
    {
	$liste_bd=$req_smbds->liste_bd;	
	}
	//SELECT * FROM `wp_13_sm_liste_test` WHERE  id='7'
	$smemail =$wpdb->get_results("SELECT * FROM `".$liste_bd."` WHERE  id='".$_SESSION["sm_emailid"]."'"); 
    foreach ( $smemail as $smemails ) 
	{
	$contenu=str_replace('[email]',$smemails->email,$contenu);
	$contenu=str_replace('[email_id]',$smemails->id,$contenu);	
	$contenu=str_replace('[nom]',$smemails->nom,$contenu);	
	$contenu=str_replace('[lg]',$smemails->lg,$contenu);
	$contenu=str_replace('[ip]',$smemails->ip,$contenu);
	$contenu=str_replace('[inscription]',$smemails->date_creation,$contenu);
	$contenu=str_replace('[champs1]',$smemails->champs1,$contenu);
	$contenu=str_replace('[champs2]',$smemails->champs2,$contenu);
	$contenu=str_replace('[champs3]',$smemails->champs3,$contenu);
	$contenu=str_replace('[champs4]',$smemails->champs4,$contenu);
	$contenu=str_replace('[champs5]',$smemails->champs5,$contenu);
	$contenu=str_replace('[champs6]',$smemails->champs6,$contenu);
	$contenu=str_replace('[champs7]',$smemails->champs7,$contenu);
	$contenu=str_replace('[champs8]',$smemails->champs8,$contenu);
	$contenu=str_replace('[champs9]',$smemails->champs9,$contenu);
	$contenu=str_replace('[date]',date('Ymshis'),$contenu);
	
	$title=str_replace('[email]',$smemails->email,$title);
	$title=str_replace('[email_id]',$smemails->id,$title);	
	$title=str_replace('[nom]',$smemails->nom,$title);	
	$title=str_replace('[lg]',$smemails->lg,$title);
	$title=str_replace('[ip]',$smemails->ip,$title);
	$title=str_replace('[inscription]',$smemails->date_creation,$title);
	$title=str_replace('[champs1]',$smemails->champs1,$title);
	$title=str_replace('[champs2]',$smemails->champs2,$title);
	$title=str_replace('[champs3]',$smemails->champs3,$title);
	$title=str_replace('[champs4]',$smemails->champs4,$title);
	$title=str_replace('[champs5]',$smemails->champs5,$title);
	$title=str_replace('[champs6]',$smemails->champs6,$title);
	$title=str_replace('[champs7]',$smemails->champs7,$title);
	$title=str_replace('[champs8]',$smemails->champs8,$title);
	$title=str_replace('[champs9]',$smemails->champs9,$title);
	$title=str_replace('[date]',date('Ymshis'),$title);
	$title=str_replace('[lien_desabo]','/upd/'.$_SESSION["sm_emailid"].'/'.$_SESSION["sm_hie"].'/',$title);
	$contenu=str_replace('[lien_desabo]','/upd/'.$_SESSION["sm_emailid"].'/'.$_SESSION["sm_hie"].'/',$contenu);
	}
 }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?>
</title>
</head>
<body><center>


				<?php
	$title=sm_schortode($title);
	$contenu=sm_schortode($contenu);
	$title=str_replace('[lien_page]','#',$title);
	$contenu=str_replace('[lien_page]','#',$contenu);
					 $contenu = apply_filters('the_content', $contenu);
                 echo $contenu;
		?>


</center></body>
</html>
<?php exit();?>