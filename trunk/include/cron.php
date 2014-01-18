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


$fivesdrafts = $wpdb->get_results("SELECT id AS hie,id_newsletter,id_liste,pause,status,track1,track2,serveur FROM `".$table_envoi."` WHERE (status='En attente' OR  status='Limite' OR  status='reactiver' OR status='suite' OR status='erreur_flux') AND date_envoi < NOW()  AND type ='newsletter' ORDER BY id desc");
foreach ( $fivesdrafts as $fivesdraft ) 
{

	$smliste = $wpdb->get_results("SELECT liste_bd,liste_nom  FROM `".$table_liste."` WHERE id= ".$fivesdraft->id_liste."");
    foreach ( $smliste as $smlistes ) 
    {
	$table_email= $smlistes->liste_bd;
	$liste_nom= $smlistes->liste_nom;	
	}
	if($fivesdraft->status == "En attente"){
	$wpdb->query("INSERT IGNORE INTO  `".$table_temps."` (email_id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,hie) SELECT id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,".$fivesdraft->hie." FROM `".$table_email."` WHERE valide='1' AND bounces='1' LIMIT 0,10000",true);
    $wpdb->query("INSERT IGNORE INTO  `".$table_suite."` (email_id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,hie) SELECT id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,".$fivesdraft->hie." FROM `".$table_email."` WHERE valide='1' AND bounces='1' LIMIT 10000,10000000",true);
	if(get_option('sm_alerte_nl_cours') == 'oui'){
	sm_alerte_envoi(''.__("Newsletter numero").' '.$fivesdraft->id_newsletter.' '.__("est en cours d'envois","e-mailing-service").'',''.__("Newsletter numero","e-mailing-service").' '.$fivesdraft->id_newsletter.' '.__("est en cours d'envois","e-mailing-service").'<br> '.date('Y-m-d H:i:s').'');
	}
	}
	elseif($fivesdraft->status == "suite"){
	$wpdb->query("INSERT IGNORE INTO  `".$table_temps."` (email_id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,hie) SELECT id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,".$fivesdraft->hie." FROM `".$table_suite."`  LIMIT 0,10000",true);
	$sqlsuite = "DELETE FROM ".$table_suite." WHERE hie='".$fivesdraft->hie."' LIMIT 10000"; 
    $resultsuite = $wpdb->query($wpdb->prepare($sqlsuite,true));
	}

	$sql2 ="UPDATE `".$table_envoi."` SET `status`='En cours', `date_demarrage`=NOW() WHERE id = '".$fivesdraft->hie."'";
    $result2 = $wpdb->query($wpdb->prepare($sql2,true)); 
	echo "######### ".__("envoi newsletter n ","e-mailing-service")." ".$fivesdraft->id_newsletter." ##############<br>";
	echo "######### ".__("liste n ","e-mailing-service")." ".$fivesdraft->id_liste." ##############<br>";
    if(get_option('sm_license')=="free" || !get_option('sm_license_key')){
	$txth=sm_schortode_txt(get_option('sm_txt_haut'),$fivesdraft->id_newsletter,$fivesdraft->hie);
	$sujet=sm_schortode_txt(get_post_field('post_title', $fivesdraft->id_newsletter),$fivesdraft->id_newsletter,$fivesdraft->hie);
	$corps=sm_schortode_txt(get_post_field('post_content', $fivesdraft->id_newsletter),$fivesdraft->id_newsletter,$fivesdraft->hie);
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
		"corps" =>get_post_field('post_content', $fivesdraft->id_newsletter),
		"sujet" => get_post_field('post_title', $fivesdraft->id_newsletter),
		"post_id" => $fivesdraft->id_newsletter,
		"hie" => $fivesdraft->hie,
		"txt_en_haut" => get_option('sm_txt_haut'),
		"txt_en_bas" => get_option('sm_txt_bas'),
		"txt_affiliation" => get_option('sm_txt_affiliation'),
		"track1" => $fivesdraft->track1,
		"track2" => $fivesdraft->track2		
		); 

        $flux =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_beta.php',$array);
		$xml = strstr($flux,'</xml>', true);
		$xml2 = simplexml_load_string($xml);
  	    $result_reponse=$xml2->resultat;
			if($result_reponse == "1")
	         {
		$bug= "<br><br><b><font color=green>".__("Tout s'est bien deroule","e-mailing-service")." : ".$result_reponse."</font></b><br><br>";
		$bug.=  "<textarea name=\"\" cols=\"100\" rows=\"10\">".$xml2->txth."<br>".$xml2->sujet."<br>".$xml2->corps."<br>".$xml2->txtb."<br>".$xml2->txta."</textarea><br>";
	         }
	         else
	         {
		$bug=  "<textarea name=\"\" cols=\"100\" rows=\"10\">".$flux."</textarea><br>";
	         }
    if(get_option('sm_debug')=="oui")
    {
     echo $bug;
	}
	if($flux==''){
	$sql2 ="UPDATE `".$table_envoi."` SET `status`='erreur_flux' WHERE id = '".$fivesdraft->hie."'";
    $result2 = $wpdb->query($wpdb->prepare($sql2,true)); 
	exit();	
	}
	elseif($result_reponse == 0){
	$sql2 ="UPDATE `".$table_envoi."` SET `status`='erreur_license' WHERE id = '".$fivesdraft->hie."'";
    $result2 = $wpdb->query($wpdb->prepare($sql2,true)); 
	exit();	
	}
	$txth=$xml2->txth;
	$sujet=$xml2->sujet;
	$corps=$xml2->corps;
	$txtb=$xml2->txtb;
	$txta=$xml2->txta;
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
	$contenu ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>';
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
	$contenu .='</body></html>';
	$contenu=str_replace('[email_id]',$smemails->email_id,$contenu);	
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
	 $header = sm_optimisation_fai($smemails->email,$title,$num);
     } else {
     if(!isset($_SESSION['sm_email_ret'])){
     $_SESSION['sm_email_ret'] = get_option('sm_email_ret_1');
     }
     $header = sm_optimisation_fai($smemails->email,$title,$_SESSION['sm_num']); 		
}
 

    $smlog = $wpdb->get_results("SELECT count(id) AS nbj FROM `".$table_log."` WHERE date like '".date('Y-m-d')."%'");
    foreach ( $smlog as $smlogs ) 
    {
	$nbjs=$smlogs->nbj;	
	}
	if(cgi_nlj() !=0){
    if($nbjs > cgi_nlj()){
	$sql3 ="UPDATE `".$table_envoi."` SET `status`='Limite', `date_fin`=NOW() WHERE id = '".$fivesdraft->hie."'";
    $result3 = $wpdb->query($wpdb->prepare($sql3,true)); 
	exit();
	}
	}
	if(get_option('sm_debug')=="oui")
    {
	echo "<br>####".trim($smemails->email)."####<br>";
	print_r($_SESSION);
	echo "<br>".__("Reponse","e-mailing-service")." :<br>";
	}
	if($fivesdraft->serveur =='auto'){
	add_action('phpmailer_init','sm_smtp_multi');
	} else {
	$_SESSION['sm_choix'] =$fivesdraft->serveur;
	add_action('phpmailer_init','sm_smtp_choix');	
	}
	$res=wp_mail(trim($smemails->email), $title, $contenu, $header, '');
	$sql ="DELETE FROM `".$table_temps."` WHERE id = '".$smemails->id."'";
    $result = $wpdb->query($wpdb->prepare($sql,true));
	//add_action('phpmailer_init','sm_smtp_multi_remove');
	sleep($fivesdraft->pause);
	//$wpdb->flush();
	if($n==100){
	$sql2 ="UPDATE `".$table_envoi."` SET `nb_attente`='".nbattente($fivesdraft->hie)."' WHERE id = '".$fivesdraft->hie."'";
    $result2 = $wpdb->query($wpdb->prepare($sql2,true));
	if(get_option('sm_license') !="free"){
	@file_get_contents("http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_mj.php?login=".get_option('sm_login')."&nb_envoi=".$ie."&action=nb_envoi&hie=".$fivesdraft->hie."");
	}
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
        $result3 = $wpdb->query($wpdb->prepare($sql3,true));
		exit();
        } else {
	$sql3 ="UPDATE `".$table_envoi."` SET `status`='Terminer', `nb_envoi`='$nbenvoi', `date_fin`=NOW() WHERE id = '".$fivesdraft->hie."'";
    $result3 = $wpdb->query($wpdb->prepare($sql3,true)); 
	echo "######### ".__("envoi numero","e-mailing-service")." ".$fivesdraft->hie." ".__("termine","e-mailing-service")." ##############<br>";
	if(get_option('sm_alerte_nl_fin') == 'oui'){
	sm_alerte_envoi(''.__("Newsletter numero","e-mailing-service").' '.$fivesdraft->id_newsletter.' '.__("envoi termine","e-mailing-service").'',''.__("Newsletter numero","e-mailing-service").' '.$fivesdraft->id_newsletter.' '._("envoi termine").' '.$ie.' '.__("emails envoyes").'<br>'.date('Y-m-d H:i:s').'');
	}
	$sqllog = "DELETE FROM ".$table_log." WHERE hie='".$fivesdraft->hie."'"; 
    $resultlog = $wpdb->query($wpdb->prepare($sqllog,true));
	if(get_option('sm_license') !="free"){
	$array =array (
		"domaine_client" => str_replace("www.","",$_SERVER['HTTP_HOST']),
		"nb_envoi" => $ie,
		"action" => "nb_envoi",
		"hie" => $fivesdraft->hie	
	); 
    return xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_mj.php',$array);
	}
       	}

}
?>