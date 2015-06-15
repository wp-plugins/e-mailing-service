<?php
function rewrite_news($login,$id_liste,$liste_nom,$corps,$sujet,$post_id,$hie,$txt_en_haut,$txt_en_bas,$txt_affiliation,$track1,$track2){
global $wpdb;	
$domaine=$domaine_client;
$post_content=stripslashes($corps);
$post_title=stripslashes($sujet);
if(!isset($txt_en_haut)){
$txt_en_haut ="[lien_page]";	
} else {
$txt_en_haut=stripslashes($txt_en_haut);
}
if(!isset($txt_en_bas)){
$txt_en_bas ="lien de desinscription [lien_desabo]";	
} else {
$txt_en_bas=stripslashes($txt_en_bas);
}
if(!isset($txt_affiliation)){
$txt_affiliation="lien affiliation : [lien_affiliation]";	
} else {
$txt_affiliation=stripslashes($txt_affiliation);
}











function replace($string){
$string=stripslashes($string);
$string=preg_replace("`<!--:fr-->`"," ",$string);
$string=str_replace("<!--:-->","",$string);
$string=str_replace("[serveur]",$serveur,$string);
//$string=str_replace("[email]","\[email]",$string);
return $string;
}





//preg_match_all('!href="http://[A-Za-z0-9][A-Za-z0-9\-\.]+[A-Za-z0-9]\.[A-Za-z]{2,}[\43-\176]*+!isU', $post_content, $lien);
$post_content =str_replace("'",'"',$post_content);
preg_match_all('!href="http://[A-Za-z0-9][A-Za-z0-9\-\.]+[A-Za-z0-9]\.[A-Za-z]{2,}[\43-\176]*+!isU', $post_content,$lien,PREG_SET_ORDER);
//preg_match_all('!href="http://(.*)"!isU', $post_content, $lien);
preg_match_all('!href="https://[A-Za-z0-9][A-Za-z0-9\-\.]+[A-Za-z0-9]\.[A-Za-z]{2,}[\43-\176]*+!isU', $post_content, $ssl);
preg_match_all("/<img .*?(?=src)src=\"([^\"]+)\"/si", $post_content, $images); 
//print_r($images);

$xx=count($images[1]); 
	for($i=0; $i < $xx; $i++){
//				echo "<br> -------->  ";
//echo $images[1][$i];
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

if($extension == ".gif" || $extension == ".jpg" || $extension == ".bmp" || $extension == ".png"){
if($i==0){
$lien_image_lecture ='http://www.top-thumb.eu/action/clic_pdv_wp.php?u='.insert(''.$images[1][$i].'',$login,$track1,$track2).'&e='.$id_envoie.'&email=[email]&t=[date]&c=lecture';
$lien_image_court=''.$url_base.'/out/'.liens_court($lien_image_lecture).'/[date]/[email_id]/'.$hie.'/[cle]/';
$post_content=str_replace($images[1][$i],$lien_image_court,$post_content);
//$post_content=str_replace($lien_image_lecture,$lien_image_court,$post_content);
} else {
//$post_content=str_replace($images[1][$i],'http://'.$domaine.'/img/'.$post_id.'/'.$i.''.$extension.'',$post_content);
}
}
	}
	}
	
$lien_page_avant='http://www.top-thumb.eu/action/clic_pdv_wp.php?u='.insert(''.$url_base.'/?p='.$post_id.'',$login,$track1,$track2).'&e='.$id_envoie.'&email=[email]&t=[date]&c=clic_page';
$lien_page_court=''.$url_base.'/outp/'.liens_court($lien_page_avant).'/[date]/[email_id]/'.$hie.'/[cle]/';	
$txt_en_haut=stripslashes($txt_en_haut);

$lien_desabo_avant='http://www.top-thumb.eu/action/clic_pdv_wp.php?u='.insert(''.$url_base.'/upd/[email_id]/'.$hie.'/[cle]/',$login,$track1,$track2).'&e='.$id_envoie.'&email=[email]&t=[date]&c=desinscription';
$lien_desabo_court=''.$url_base.'/outd/'.liens_court($lien_desabo_avant).'/[date]/[email_id]/'.$hie.'/[cle]/';
$txt_en_bas=stripslashes($txt_en_bas);

$lien_affiliation_avant='http://www.top-thumb.eu/action/clic_pdv_wp.php?u='.insert_affiliation('http://www.e-mailing-service.net/?ap_id='.$login.'',$login,$track1,$track2).'&e='.$id_envoie.'&email=[email]&t=[date]&c=clic_affiliation';
$lien_affiliation_court=''.$url_base.'/out/'.liens_court($lien_affiliation_avant).'/[date]/[email_id]/'.$hie.'/[cle]/';
$txt_affiliation=stripslashes($txt_affiliation);



$nb=count($lien); 
for($z=0;$z<$nb;$z++){
$lien[$z][0]= preg_replace('!href="!isU','',$lien[$z][0]);
//echo "<br>lien : ".$lien[$z][0]."<br>";
$site[$z]='http://www.top-thumb.eu/action/clic_pdv_wp.php?u='.insert(''.$lien[$z][0].'',$login,$track1,$track2).'&e='.$id_envoie.'&email=[email]&t=[date]&c=clic';
$site_court[$z]=''.$url_base.'/out/'.liens_court($site[$z]).'/[date]/[email_id]/'.$hie.'/[cle]/';
$form_track_lien .="<table><input name=\"idlien_[$z]\" type=\"hidden\" value=\"".insert(''.$lien[$z][0].'',$login,$track1,$track2)."\" /></td></tr><table>";
$post_content=str_replace('href="'.$lien[$z][0].'"','href="'.$site_court[$z].'"',$post_content);
	}
	

$nb=count($ssl[0]); 
for($z=0;$z<$nb;$z++){
$ssl[0][$i]= preg_replace('!href="!isU', '', $ssl[0][$i]);
$site[$i]='http://www.top-thumb.eu/action/clic_pdv_wp.php?u='.insert(''.$ssl[0][$i].'',$login,$track1,$track2).'&e='.$id_envoie.'&email=[email]&t=[date]&c=clic';
$site_court[$i]=''.$url_base.'/out/'.liens_court($site[$i]).'/[date]/[email_id]/'.$hie.'/[cle]/';
$form_track_lien .="<table><input name=\"idlien_[$i]\" type=\"hidden\" value=\"".insert(''.$ssl[0][$i].'',$login,$track1,$track2)."\" /></td></tr><table>";
$post_content=str_replace($ssl[0][$i],$site_court[$i],$post_content);
	}


//remplace les variables
$post_content=str_replace("[lien_page]",$lien_page_court,$post_content);
$post_content=str_replace("[titre_news]",$post_title,$post_content);
$txt_en_haut=str_replace("[lien_page]",$lien_page_court,$txt_en_haut);
$txt_en_haut=str_replace("[titre_news]",$post_title,$txt_en_haut);
$txt_en_bas=str_replace("[lien_page]",$lien_page_court,$txt_en_bas);
$txt_en_bas=str_replace("[titre_news]",$post_title,$txt_en_bas);
$txt_affiliation=str_replace("[lien_page]",$lien_page_court,$txt_affiliation);
$txt_affiliation=str_replace("[titre_news]",$post_title,$txt_affiliation);

$post_content=str_replace('[lien_desabo]',$lien_desabo_court,$post_content);
$txt_en_haut=str_replace('[lien_desabo]',$lien_desabo_court,$txt_en_haut);
$txt_en_bas=str_replace('[lien_desabo]',$lien_desabo_court,$txt_en_bas);
$txt_affiliation=str_replace('[lien_desabo]',$lien_desabo_court,$txt_affiliation);

$post_content=str_replace('[lien_affiliation]',$lien_affiliation_court,$post_content);
$txt_en_haut=str_replace('[lien_affiliation]',$lien_affiliation_court,$txt_en_haut);
$txt_en_bas=str_replace('[lien_affiliation]',$lien_affiliation_court,$txt_en_bas);
$txt_affiliation=str_replace('[lien_affiliation]',$lien_affiliation_court,$txt_affiliation);


$txt_en_haut=trim($txt_en_haut);
$txt_en_bas=trim($txt_en_bas);
$txt_affiliation=trim($txt_affiliation);

$xml='<?xml version="1.0" encoding="UTF-8"?>
<item>
<resultat>1</resultat>
<txth><![CDATA['.$txt_en_haut.']]></txth>
<txtb><![CDATA['.$txt_en_bas.']]></txtb>
<txta><![CDATA['.$txt_affiliation.']]></txta>
<sujet><![CDATA['.replace($post_title).']]></sujet>
<corps><![CDATA['.replace($post_content).']]></corps>
<resultat_detail><![CDATA[Probleme avec votre license contacter le support]]></resultat_detail>
</item></xml>';
return $xml;
 


}
?>