<?php
set_time_limit(0);
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
$id=0;
echo "<h2>".__("Envoi de votre newsletter","e-mailing-service")."</h2>";	
$fivesdrafts = $wpdb->get_results("SELECT id AS hie,id_newsletter,id_liste,pause,status,track1,track2,serveur,mode,login FROM `".$table_envoi."` WHERE (status='En attente' OR  status='Limite' OR  status='reactiver' OR status='suite' OR status='erreur_flux')  AND date_envoi < NOW() AND type ='newsletter' ORDER BY id desc LIMIT 0,1");
foreach ( $fivesdrafts as $fivesdraft ) 
{

	$sql2 ="UPDATE `".$table_envoi."` SET `status`='En cours', `date_demarrage`=NOW() WHERE id = '".$fivesdraft->hie."'";
    $result2 = $wpdb->query($sql2); 
	   
    $id=$fivesdraft->hie;
	$smliste = $wpdb->get_results("SELECT liste_bd,liste_nom  FROM `".$table_liste."` WHERE id= ".$fivesdraft->id_liste."");
    foreach ( $smliste as $smlistes ) 
    {
	$table_email= $smlistes->liste_bd;
	$liste_nom= $smlistes->liste_nom;	
	}
	if($fivesdraft->status == "En attente"){
	$wpdb->query("INSERT IGNORE INTO  `".$table_temps."` (email_id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,hie,cle) SELECT id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,".$fivesdraft->hie.",cle FROM `".$table_email."` WHERE valide='1' AND bounces='1' LIMIT 0,10000",true);
    $wpdb->query("INSERT IGNORE INTO  `".$table_suite."` (email_id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,hie,cle) SELECT id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,".$fivesdraft->hie.",cle FROM `".$table_email."` WHERE valide='1' AND bounces='1' LIMIT 10001,10000000",true);

	if(get_option('sm_alerte_nl_cours') == 'oui'){
	sm_alerte_envoi(''.__("Newsletter numero").' '.$fivesdraft->id_newsletter.' '.__("est en cours d'envois","e-mailing-service").'',''.__("Newsletter numero","e-mailing-service").' '.$fivesdraft->id_newsletter.' '.__("est en cours d'envois","e-mailing-service").'<br> '.date('Y-m-d H:i:s').'');
	}
	}
	elseif($fivesdraft->status == "suite"){
	$wpdb->query("INSERT IGNORE INTO  `".$table_temps."` (email_id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,hie,cle) SELECT id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,".$fivesdraft->hie.",cle FROM `".$table_suite."`  LIMIT 0,10000",true);
	$sqlsuite = "DELETE FROM ".$table_suite." WHERE hie='".$fivesdraft->hie."' LIMIT 10000"; 
    $resultsuite = $wpdb->query($sqlsuite);
	}

	echo "######### ".__("envoi newsletter n ","e-mailing-service")." ".$fivesdraft->id_newsletter." ##############<br>";
	echo "######### ".__("liste n ","e-mailing-service")." ".$fivesdraft->id_liste." ##############<br>";
	$post_content = get_post_field('post_content', $fivesdraft->id_newsletter);
    $post_id=$fivesdraft->id_newsletter;
	global $current_blog;
if ( is_multisite() ) {
$repertoire = ''.smPOSTURL.''.$current_blog->blog_id.'/img/'.$post_id.'';
$repertoire_path= ''.smPOST.''.$current_blog->blog_id.'/img/'.$post_id.'';
$fichier_log = ''.smPOST.''.$current_blog->blog_id.'/log/'.$fivesdraft->hie.'.txt';
$url_log = ''.smPOSTURL.''.$current_blog->blog_id.'/log/'.$fivesdraft->hie.'.txt';
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
$fichier_log = ''.smPOST.'1/log/'.$fivesdraft->hie.'.txt';
$url_log = ''.smPOSTURL.'1/log/'.$fivesdraft->hie.'.txt';
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
 if(get_option('sm_debug')=="oui")
    {
echo 'upload : '.$repertoire.'/'.$i.''.$extension.'<br>';
echo 'size : '.filesize(''.$repertoire_path.'/'.$i.''.$extension.'').'<br>';		
	}
}
	}


    if(get_option('sm_license')=="free" || !get_option('sm_license_key')){
	$txth=sm_schortode_txt(get_option('sm_txt_haut'),$fivesdraft->id_newsletter,$fivesdraft->hie);
	$sujet=sm_schortode_txt(get_post_field('post_title', $fivesdraft->id_newsletter),$fivesdraft->id_newsletter,$fivesdraft->hie);
	$corps=sm_schortode_txt($post_content,$fivesdraft->id_newsletter,$fivesdraft->hie);
	$txtb=sm_schortode_txt(get_option('sm_txt_bas'),$fivesdraft->id_newsletter,$fivesdraft->hie);
	$txta=sm_schortode_txt(get_option('sm_txt_affiliation'),$fivesdraft->id_newsletter,$fivesdraft->hie);
	} else {
		$array =array (
		"login" => get_option('sm_login'),
		"license_key" => get_option('sm_license_key'),
		"domaine_client" => str_replace("www.","",$_SERVER['HTTP_HOST']),
		"liste" => $fivesdraft->id_liste,
		"liste_nom" => $liste_nom,
		"sm_smtp_server" => get_option('sm_smtp_server'),
		"sm_serveur" => get_option('sm_serveur'),
		"sm_license" => get_option('sm_license'),  
		"corps" => $post_content,
		"sujet" => get_post_field('post_title', $fivesdraft->id_newsletter),
		"post_id" => $fivesdraft->id_newsletter,
		"hie" => $fivesdraft->hie,
		"txt_en_haut" => get_option('sm_txt_haut'),
		"txt_en_bas" => get_option('sm_txt_bas'),
		"txt_affiliation" => get_option('sm_txt_affiliation'),
		"track1" => $fivesdraft->track1,
		"track2" => $fivesdraft->track2		
		); 

        $flux1 =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_v2.php',$array);
        $xml2l =post_xml_data(addslashes($flux1),'item',array('resultat','txth','sujet','corps','txtb','txta'));
		foreach($xml2l as $row) {
		if($row[0] == 1)
	         {
		$bug= "<br><br><b><font color=green>".__("Tout s'est bien deroule","e-mailing-service")." : ".stripslashes($row[0])."</font></b><br><br>";
		$bug.=  "<textarea name=\"\" cols=\"100\" rows=\"10\">".stripslashes($row[1])."<br>".stripslashes($row[2])."<br>".stripslashes($row[3])."<br>".stripslashes($row[4])."<br>".stripslashes($row[5])."</textarea><br>";
	         }
	         else
	         {
		$bug=  "<textarea name=\"\" cols=\"100\" rows=\"10\">".$flux1."</textarea><br>";
	         }
		}
    if(get_option('sm_debug')=="oui")
    {
     echo $bug;
	}
	if($flux1==''){
	$sql2 ="UPDATE `".$table_envoi."` SET `status`='erreur_flux' WHERE id = '".$fivesdraft->hie."'";
    $result2 = $wpdb->query($sql2); 
	exit();	
	}
	elseif($row[0] == 0){
	$sql2 ="UPDATE `".$table_envoi."` SET `status`='erreur_license' WHERE id = '".$fivesdraft->hie."'";
    $result2 = $wpdb->query($sql2); 
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
	$smemail = $wpdb->get_results("SELECT * FROM `".$table_temps."` WHERE hie='".$fivesdraft->hie."'");
    foreach ( $smemail as $smemails ) 
    {
	if(get_option('sm_script_pause') == 'oui'){
	$requet_type =mysql_query("SELECT status  FROM `".$table_temps."` WHERE hie='".$fivesdraft->hie."' AND id='".$smemails->id."'"); 
    while ($res_type = mysql_fetch_array($requet_type)){
    extract($res_type);
	}
	if(!isset($status)){
	exit();	
	break;	
	}
	if($status =="pause"){
	exit();	
	break;
	}
	}
	if($fivesdraft->mode == "text/html"){
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
	//$img_track='<img name="google" src="'.get_option("siteurl").'/?utm_source='.$smemails->email_id.'&utm_campaign='.$fivesdraft->hie.'&ytm_medium=email" width="1" height="1" alt="" />';
	if($fivesdraft->mode == "text/html"){
	$contenu .='</body></html>';
	}
	$contenu=str_replace('[email_id]',$smemails->email_id,$contenu);
	$contenu=str_replace('[cle]',$smemails->cle,$contenu);	
	$contenu=str_replace('[email]',$smemails->email,$contenu);
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
	
	$title=str_replace('[email_id]',$smemails->email_id,$sujet);
	$title=str_replace('[email]',$smemails->email,$title);
	$title=str_replace('[cle]',$smemails->cle,$title);		
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
	
	$title=sm_schortode($title);
	$contenu=sm_schortode($contenu);
	
if($fivesdraft->serveur !='auto'){
	 $num=$fivesdraft->serveur;
	 if(!isset($_SESSION['sm_email_ret'])){
     $_SESSION['sm_email_ret'] = get_option('sm_email_ret_'.$num.'');
     }
	 $header = sm_optimisation_fai($smemails->email,$title,$num,$fivesdraft->mode);	
     } else {
     if(!isset($_SESSION['sm_email_ret'])){
     $_SESSION['sm_email_ret'] = get_option('sm_email_ret_1');
     }
	 if(!isset($_SESSION['sm_num'])){ $_SESSION['sm_num']=1; }
     $header = sm_optimisation_fai($smemails->email,$title,$_SESSION['sm_num'],$fivesdraft->mode);	
}
 

    $smlog = $wpdb->get_results("SELECT count(id) AS nbj FROM `".$table_log."` WHERE date like '".date('Y-m-d')."%'");
    foreach ( $smlog as $smlogs ) 
    {
	$nbjs=$smlogs->nbj;	
	}
	if(cgi_nlj() !=0){
    if($nbjs > cgi_nlj()){
	$sql3 ="UPDATE `".$table_envoi."` SET `status`='Limite', `date_fin`=NOW() WHERE id = '".$fivesdraft->hie."'";
    $result3 = $wpdb->query($sql3); 
	exit();
	}
	}
	if(get_option('sm_debug')=="oui")
    {
	echo "<br>####".trim($smemails->email)."####<br>";
	print_r($_SESSION);
	echo "<br>".__("Reponse","e-mailing-service")." :<br>";
	}
	echo "##server : ".$fivesdraft->serveur."<br>";
	if($fivesdraft->serveur =='auto'){
	add_action('phpmailer_init','sm_smtp_multi');
	} else {
	$_SESSION['sm_choix'] =$fivesdraft->serveur;
	add_action('phpmailer_init','sm_smtp_choix');	
	echo "##server : ".$_SESSION['sm_choix']."<br>";
	}
	mysql_query("DELETE FROM `".$table_temps."` WHERE id = '".$smemails->id."'");
        if(!isset($_SESSION["mail"])){
        $_SESSION["mail"] ="";
        }
        if($_SESSION["mail"] != $smemails->id){
        if( strpos(@file_get_contents($url_log),$smemails->id) == false) {
	if($fivesdraft->mode == "text/html"){
	$res=wp_mail( $smemails->email, $title, $contenu, $header, "");
	} else {
	$res=wp_mail( $smemails->email, $title, strip_tags($contenu), $header, "");	
	}
	}
	}
        $_SESSION["mail"] = $smemails->id;
        $fp = fopen($fichier_log,'a+');
        fseek($fp,SEEK_END);
        $nouverr=$smemails->id."\r\n";
        fputs($fp,$nouverr);
        fclose($fp);

	//add_action('phpmailer_init','sm_smtp_multi_remove');
	sleep($fivesdraft->pause);
	//$wpdb->flush();
	if($n==100){
	$sql2 ="UPDATE `".$table_envoi."` SET `nb_attente`='".nbattente($fivesdraft->hie)."' WHERE id = '".$fivesdraft->hie."'";
    $result2 = $wpdb->query($sql2);
	/*
	if(get_option('sm_license') !="free"){
	@file_get_contents("http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_mj.php?login=".get_option('sm_login')."&nb_envoi=".$ie."&action=nb_envoi&hie=".$fivesdraft->hie."");
	}
	*/
	$n=0;	
	}
	$n++;
	$ie++;
	$wpdb->insert($table_log, array(
            'email' => $smemails->email,  
            'nb_envoi' => $ie,
			'hie' => $fivesdraft->hie,
            'date' => current_time('mysql')  
   ));  
	}

	   $nbenvoi=nbenvoyer($fivesdraft->hie);
	   $nbattente=nbattente($fivesdraft->hie);
        if(sm_suite_nb($fivesdraft->hie) > 0){
        $sql3 ="UPDATE `".$table_envoi."` SET `status`='suite', `nb_envoi`='$nbenvoi' ,`nb_attente`='$nbattente' WHERE id = '".$fivesdraft->hie."'";
        $result3 = $wpdb->query($sql3);
		exit();
        } else {
	$sql3 ="UPDATE `".$table_envoi."` SET `status`='Terminer', `nb_envoi`='$nbenvoi', `date_fin`=NOW() WHERE id = '".$fivesdraft->hie."'";
    $result3 = $wpdb->query($sql3); 
	echo "######### ".__("envoi numero","e-mailing-service")." ".$fivesdraft->hie." ".__("termine","e-mailing-service")." ##############<br>";
	if(get_option('sm_alerte_nl_fin') == 'oui'){
	sm_alerte_envoi(''.__("Newsletter numero","e-mailing-service").' '.$fivesdraft->id_newsletter.' '.__("envoi termine","e-mailing-service").'',''.__("Newsletter numero","e-mailing-service").' '.$fivesdraft->id_newsletter.' '._("envoi termine").' '.$ie.' '.__("emails envoyes").'<br>'.date('Y-m-d H:i:s').'');
	}
	$sqllog = "DELETE FROM ".$table_log." WHERE hie='".$fivesdraft->hie."'"; 
    $resultlog = $wpdb->query($sql3);
	if(get_option('sm_license') !="free"){
@file_get_contents("http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_mj.php?login=".get_option('sm_login')."&nb_envoi=".nb_envoi_in($fivesdraft->hie)."&action=nb_envoi_fin&hie=".$fivesdraft->hie."");
	}
       	}

}
if($id ==0){
_e("Vous n'avez pas de newsletter qui doit tourner actuellement","e-mailing-service");	
}
?>