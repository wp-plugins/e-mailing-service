<?php
set_time_limit(0);
require_once('../../../../wp-load.php');
if(!function_exists('get_option')){
function get_option($option_name){
global $wpdb; 
$table_options = $wpdb->prefix.'options';
$total = $wpdb->get_var("SELECT option_value FROM `".$table_options."` WHERE option_name='".$option_name."'");
return $total;			
}
}

global $wpdb;
date_default_timezone_set('Europe/Paris');
$table_envoi= $wpdb->prefix.'sm_historique_envoi';
$table_posts= $wpdb->prefix.'posts';
$table_liste= $wpdb->prefix.'sm_liste';
$table_temps= $wpdb->prefix.'sm_temps';
$table_suite= $wpdb->prefix.'sm_suite';
$table_log= $wpdb->prefix.'sm_log';
$table_messageid=$wpdb->prefix.'sm_stats_messageid';
$id=0;


echo "<h2>".__("Envoi de votre newsletter","e-mailing-service")."</h2>";	
$q31=mysql_query("SELECT id AS hie,id_newsletter,id_liste,pause,status,track1,track2,serveur,mode,login,attachments FROM `".$table_envoi."` WHERE (status='En attente' OR  status='Limite' OR  status='reactiver' OR status='suite' OR status='erreur_flux')  AND date_envoi < NOW() AND type ='newsletter' ORDER BY id desc LIMIT 0,1");
while ($r31 = mysql_fetch_array($q31))
{
extract($r31);
     if($status =='En attente'){
	 mysql_query("UPDATE `".$table_envoi."` SET `status`='En cours', `date_demarrage`=NOW() WHERE id = '".$hie."'");	
	 } else {
	 mysql_query("UPDATE `".$table_envoi."` SET `status`='En cours' WHERE id = '".$hie."'");			 
	 }
  	
	$smliste = mysql_query("SELECT liste_bd,liste_nom  FROM `".$table_liste."` WHERE id= ".$id_liste."");
    while ($r2 = mysql_fetch_array($smliste))
    {
	extract($r2);
	$table_email= $liste_bd;
	$liste_nom= $liste_nom;	
	}
	if($status == "En attente"){
	mysql_query("INSERT IGNORE INTO  `".$table_temps."` (email_id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,hie,cle) SELECT id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,".$hie.",cle FROM `".$table_email."` WHERE valide='1' AND bounces='1' LIMIT 0,10000");
    mysql_query("INSERT IGNORE INTO  `".$table_suite."` (email_id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,hie,cle) SELECT id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,".$hie.",cle FROM `".$table_email."` WHERE valide='1' AND bounces='1' LIMIT 10001,10000000");

	if(get_option('sm_alerte_nl_cours') == 'oui'){
	sm_alerte_envoi(''.__("Newsletter numero").' '.$id_newsletter.' '.__("est en cours d'envois","e-mailing-service").'',''.__("Newsletter numero","e-mailing-service").' '.$id_newsletter.' '.__("est en cours d'envois","e-mailing-service").'<br> '.date('Y-m-d H:i:s').'');
	}
	}
	elseif($status == "suite"){
	mysql_query("INSERT IGNORE INTO  `".$table_temps."` (email_id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,hie,cle) SELECT id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,".$hie.",cle FROM `".$table_suite."`  LIMIT 0,10000");
	mysql_query("DELETE FROM ".$table_suite." WHERE hie='".$hie."' LIMIT 10000"); 
	}

	echo "######### ".__("envoi newsletter n ","e-mailing-service")." ".$id_newsletter." ##############<br>";
	echo "######### ".__("liste n ","e-mailing-service")." ".$id_liste." ##############<br>";
	$post_content = get_post_field('post_content', $id_newsletter);
    $post_id=$id_newsletter;
	global $current_blog;
if ( is_multisite() ) {
$repertoire = ''.smPOSTURL.''.$current_blog->blog_id.'/img/'.$post_id.'';
$repertoire_path= ''.smPOST.''.$current_blog->blog_id.'/img/'.$post_id.'';
$fichier_log = ''.smPOST.''.$current_blog->blog_id.'/log/'.$hie.'.txt';
$url_log = ''.smPOSTURL.''.$current_blog->blog_id.'/log/'.$hie.'.txt';
if(!is_dir(''.smPOST.''.$current_blog->blog_id.'')){
mkdir(''.smPOST.''.$current_blog->blog_id.'', 0777);
		   }
if(!is_dir(''.smPOST.''.$current_blog->blog_id.'/img')){
mkdir(''.smPOST.''.$current_blog->blog_id.'/img', 0777);
		   }
if(!is_dir(''.smPOST.''.$current_blog->blog_id.'/log')){

mkdir(''.smPOST.''.$current_blog->blog_id.'/log', 0777);
		   }
if(!is_dir(''.smPOST.''.$current_blog->blog_id.'/img/'.$post_id.'')){
mkdir(''.smPOST.''.$current_blog->blog_id.'/img/'.$post_id.'', 0777);
		   }
	
} else {
$repertoire = ''.smPOSTURL.'1/img/'.$post_id.'';
$repertoire_path = ''.smPOST.'1/img/'.$post_id.'';
$fichier_log = ''.smPOST.'1/log/'.$hie.'.txt';
$url_log = ''.smPOSTURL.'1/log/'.$hie.'.txt';
if(!is_dir(''.smPOST.'1')){
mkdir(''.smPOST.'1', 0777);
		   }
if(!is_dir(''.smPOST.'1/img')){
mkdir(''.smPOST.'1/img', 0777);
		   }
if(!is_dir(''.smPOST.'1/log')){
mkdir(''.smPOST.'1/log', 0777);
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
if(file_exists(''.$repertoire_path.'/'.$i.''.$extension.'')){
	if(filesize(''.$repertoire_path.'/'.$i.''.$extension.'') > 0){
$post_content=str_replace($images[1][$i],''.$repertoire.'/'.$i.''.$extension.'',$post_content);
	}
}
	}
 if(get_option('sm_debug')=="oui")
    {
echo 'upload : '.$repertoire.'/'.$i.''.$extension.'<br>';
echo 'size : '.filesize(''.$repertoire_path.'/'.$i.''.$extension.'').'<br>';		
	}

	if($xx == 0){
	preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/i', $post_content, $images); 	
    $xx=count($images[3]);
	for($i=0; $i < $xx; $i++){
		echo " boucle image ".$images[3][$i]."<br>";
     $size = @getimagesize($images[3][$i]); 
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
@file_put_contents(''.$repertoire_path.'/'.$i.''.$extension.'', file_get_contents($images[2][$i]));
@chmod(''.$repertoire_path.'/'.$i.''.$extension.'',0644);
if(file_exists(''.$repertoire_path.'/'.$i.''.$extension.'')){
	if(filesize(''.$repertoire_path.'/'.$i.''.$extension.'') > 0){
$post_content=str_replace($images[3][$i],''.$repertoire.'/'.$i.''.$extension.'',$post_content);
	}
}


	}
 if(get_option('sm_debug')=="oui")
    {
echo 'upload : '.$repertoire.'/'.$i.''.$extension.'<br>';
echo 'size : '.filesize(''.$repertoire_path.'/'.$i.''.$extension.'').'<br>';		
	}
}
	}
	}



    if(get_option('sm_license')=="free" || !get_option('sm_license_key')){
	$txth=sm_schortode_txt(get_option('sm_txt_haut'),$id_newsletter,$hie);
	$sujet=sm_schortode_txt(get_post_field('post_title', $id_newsletter),$id_newsletter,$hie);
	$corps=sm_schortode_txt($post_content,$id_newsletter,$hie);
	$txtb=sm_schortode_txt(get_option('sm_txt_bas'),$id_newsletter,$hie);
	$txta=sm_schortode_txt(get_option('sm_txt_affiliation'),$id_newsletter,$hie);
	echo "<br>############ free license ############<br> ";
	} else {
		$array =array (
		"login" => $login,
		"license_key" => get_option('sm_license_key'),
		"domaine_client" => str_replace("www.","",$_SERVER['HTTP_HOST']),
		"liste" => $id_liste,
		"liste_nom" => $liste_nom,
		"sm_smtp_server" => get_option('sm_smtp_server'),
		"sm_serveur" => get_option('sm_serveur'),
		"sm_license" => get_option('sm_license'),  
		"corps" => $post_content,
		"sujet" => get_post_field('post_title', $id_newsletter),
		"post_id" => $id_newsletter,
		"hie" => $hie,
		"txt_en_haut" => get_option('sm_txt_haut'),
		"txt_en_bas" => get_option('sm_txt_bas'),
		"txt_affiliation" => get_option('sm_txt_affiliation'),
		"track1" => $track1,
		"track2" => $track2		
		); 

        $flux1 =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_v2.php',$array);
        $xml2l =post_xml_data(addslashes($flux1),'item',array('resultat','txth','sujet','corps','txtb','txta'));
		foreach($xml2l as $row) {
		if($row[0] == 1)
	         {
	  echo "<br>############ resultat : ".$row[0]." ############<br> ";
		$bug= "<br><br><b><font color=green>".__("Tout s'est bien deroule","e-mailing-service")." : ".stripslashes($row[0])."</font></b><br><br>";
		$bug.=  "<textarea name=\"\" cols=\"100\" rows=\"10\">".stripslashes($row[1])."<br>".stripslashes($row[2])."<br>".stripslashes($row[3])."<br>".stripslashes($row[4])."<br>".stripslashes($row[5])."</textarea><br>";
	         }
	         else
	         {
		$bug=  "<textarea name=\"\" cols=\"100\" rows=\"10\">".$flux1."</textarea><br>";
	         }
		}
		 echo $bug;
    if(get_option('sm_debug')=="oui")
    {
     echo $bug;
	}
	if($flux1==''){
	mysql_query("UPDATE `".$table_envoi."` SET `status`='erreur_flux' WHERE id = '".$hie."'");
	exit();	
	}
	elseif($row[0] == 0){
	mysql_query("UPDATE `".$table_envoi."` SET `status`='erreur_license' WHERE id = '".$hie."'");
	exit();	
	}
	$txth=stripslashes($row[1]);
	$sujet=stripslashes($row[2]);
	$corps=stripslashes($row[3]);
	$txtb=stripslashes($row[4]);
	$txta=stripslashes($row[5]);
	}
	
	$n=1;
	$ie=0;
	$q3=mysql_query("SELECT * FROM `".$table_temps."` WHERE hie='".$hie."'");
    while ($r3 = mysql_fetch_array($q3))
    {
    extract($r3);
	

	if(get_option('sm_script_pause') == 'oui'){
	if(!isset($status)){
	exit();	
	break;	
	}
	if($status =="pause"){
	exit();	
	break;
	}
	}
	if($mode == "text/html"){
	$contenu ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>';
	} else {
	$contenu = "";
	}
    if(get_option('sm_affiche_txt_haut')=="oui"){
	$contenu .=$txth;
	}
	$contenu .=$corps;
	if(get_option('sm_affiche_txt_bas')=="oui"){
	$contenu .=$txtb;
	}
	if(get_option('sm_affiche_txt_affiliation')=="oui"){
	$contenu .=$txta;
	}
	//$img_track='<img name="google" src="'.get_option("siteurl").'/?utm_source='.$email_id.'&utm_campaign='.$hie.'&ytm_medium=email" width="1" height="1" alt="" />';
	if($mode == "text/html"){
	$contenu .='</body></html>';
	}
	$contenu=str_replace('[email_id]',$email_id,$contenu);
	$contenu=str_replace('[cle]',$cle,$contenu);	
	$contenu=str_replace('[email]',$email,$contenu);
	$contenu=str_replace('[nom]',$nom,$contenu);	
	$contenu=str_replace('[lg]',$lg,$contenu);
	$contenu=str_replace('[ip]',$ip,$contenu);
	$contenu=str_replace('[inscription]',$date_creation,$contenu);
	$contenu=str_replace('[champs1]',$champs1,$contenu);
	$contenu=str_replace('[champs2]',$champs2,$contenu);
	$contenu=str_replace('[champs3]',$champs3,$contenu);
	$contenu=str_replace('[champs4]',$champs4,$contenu);
	$contenu=str_replace('[champs5]',$champs5,$contenu);
	$contenu=str_replace('[champs6]',$champs6,$contenu);
	$contenu=str_replace('[champs7]',$champs7,$contenu);
	$contenu=str_replace('[champs8]',$champs8,$contenu);
	$contenu=str_replace('[champs9]',$champs9,$contenu);
	$contenu=str_replace('[date]',date('Ymshis'),$contenu);
	
	$title=str_replace('[email_id]',$email_id,$sujet);
	$title=str_replace('[email]',$email,$title);
	$title=str_replace('[cle]',$cle,$title);		
	$title=str_replace('[nom]',$nom,$title);	
	$title=str_replace('[lg]',$lg,$title);
	$title=str_replace('[ip]',$ip,$title);
	$title=str_replace('[inscription]',$date_creation,$title);
	$title=str_replace('[champs1]',$champs1,$title);
	$title=str_replace('[champs2]',$champs2,$title);
	$title=str_replace('[champs3]',$champs3,$title);
	$title=str_replace('[champs4]',$champs4,$title);
	$title=str_replace('[champs5]',$champs5,$title);
	$title=str_replace('[champs6]',$champs6,$title);
	$title=str_replace('[champs7]',$champs7,$title);
	$title=str_replace('[champs8]',$champs8,$title);
	$title=str_replace('[champs9]',$champs9,$title);
	$title=str_replace('[date]',date('Ymshis'),$title);
	
	$title=sm_schortode($title);
	$contenu=sm_schortode($contenu);
	
if($serveur !='auto'){
	 $num=$serveur;
	 if(!isset($_SESSION['sm_email_ret'])){
     $_SESSION['sm_email_ret'] = get_option('sm_email_ret_'.$num.'');
     }
	 $headers = sm_optimisation_fai($email,$title,$num,$mode);	
     } else {
     if(!isset($_SESSION['sm_email_ret'])){
     $_SESSION['sm_email_ret'] = get_option('sm_email_ret_1');
     }
	 if(!isset($_SESSION['sm_num'])){ $_SESSION['sm_num']=1; }
     $headers= sm_optimisation_fai($email,$title,$_SESSION['sm_num'],$mode);	
}
 
echo "<br>####".trim($email)."####<br>";
    $smlog = mysql_query("SELECT count(id) AS nbj FROM `".$table_log."` WHERE date like '".date('Y-m-d')."%'");
    while ($r4 = mysql_fetch_array($smlog))
    {
    extract($r4);
	$nbjs=$nbj;	
	}
	if(cgi_nlj() !=0){
    if($nbjs > cgi_nlj()){
	mysql_query("UPDATE `".$table_envoi."` SET `status`='Limite', `date_fin`=NOW() WHERE id = '".$hie."'");
	exit();
	}
	}
	if(get_option('sm_debug')=="oui")
    {
	echo "<br>####".trim($email)."####<br>";
	print_r($_SESSION);
	echo "<br>".__("Reponse","e-mailing-service")." :<br>";
	}
	echo "##server : ".$serveur."<br>";
	if($serveur =='auto'){
	add_action('phpmailer_init','sm_smtp_multi');
	} else {
	$_SESSION['sm_choix'] =$serveur;
	add_action('phpmailer_init','sm_smtp_choix');	
	echo "##server : ".$_SESSION['sm_choix']."<br>";
	}
	mysql_query("DELETE FROM `".$table_temps."` WHERE id = '".$id."'");
	$headers .= 'List-ID: '.$hie.'';
	if($mode == "text/html"){
	$res=wp_mail( $email, $title, $contenu, $headers, array( $attachments));
	} else {
	$res=wp_mail( $email, $title, strip_tags($contenu), $headers, array( $attachments));	
	}
	mysql_query("INSERT IGNORE INTO  `word_serveursmail`.`".$table_messageid."` (`id` ,`email` ,`messageid` ,`status` ,`hie`) VALUES (NULL ,  '".trim($email)."',  '".$_SESSION['message-id']."',  '?',  '".$hie."')");

	
	
        $_SESSION["mail"] = $id;
        $fp = fopen($fichier_log,'a+');
        fseek($fp,SEEK_END);
        $nouverr=$id."\r\n";
        fputs($fp,$nouverr);
        fclose($fp);

	//add_action('phpmailer_init','sm_smtp_multi_remove');
	sleep($pause);
	//$wpdb->flush();
	if($n==100){
	mysql_query("UPDATE `".$table_envoi."` SET `nb_attente`='".nbattente($hie)."' WHERE id = '".$hie."'");
	$n=0;	
	}
	$n++;
	$ie++;
   mysql_query("INSERT INTO `".$table_log."` (`id`, `email`, `nb_envoi`, `hie`) VALUES ('', '".$email."', '".$ie."', '".$hie."');"); 
	}

	   $nbenvoi=nbenvoyer($hie);
	   $nbattente=nbattente($hie);
        if(sm_suite_nb($hie) > 0){
        mysql_query("UPDATE `".$table_envoi."` SET `status`='suite', `nb_envoi`='$nbenvoi' ,`nb_attente`='$nbattente' WHERE id = '".$hie."'");
		exit();
        } else {
	    mysql_query("UPDATE `".$table_envoi."` SET `status`='Terminer', `nb_envoi`='$nbenvoi', `date_fin`=NOW() WHERE id = '".$hie."'");
	    echo "######### ".__("envoi numero","e-mailing-service")." ".$hie." ".__("termine","e-mailing-service")." ##############<br>";
	if(get_option('sm_alerte_nl_fin') == 'oui'){
	sm_alerte_envoi(''.__("Newsletter numero","e-mailing-service").' '.$id_newsletter.' '.__("envoi termine","e-mailing-service").'',''.__("Newsletter numero","e-mailing-service").' '.$id_newsletter.' '._("envoi termine").' '.$ie.' '.__("emails envoyes").'<br>'.date('Y-m-d H:i:s').'');
	}
	mysql_query("DELETE FROM ".$table_log." WHERE hie='".$hie."'"); 
	if(get_option('sm_license') !="free"){
@file_get_contents("http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_mj.php?login=".get_option('sm_login')."&nb_envoi=".nb_envoi_in($hie)."&action=nb_envoi_fin&hie=".$hie."");
	}
       	}

}
if($id ==0){
_e("Vous n'avez pas de newsletter qui doit tourner actuellement","e-mailing-service");	
}
?>