<?php
global $wpdb;
$SMINCLUDEOK="ok";
$table_options= $wpdb->prefix.'options';
$table_envoi= $wpdb->prefix.'sm_historique_envoi';
$table_posts= $wpdb->prefix.'posts';
$table_liste= $wpdb->prefix.'sm_liste';
$table_temps= $wpdb->prefix.'sm_temps';
$table_suite= $wpdb->prefix.'sm_suite';
$table_log= $wpdb->prefix.'sm_log';
$table_log_bounces= $wpdb->prefix.'sm_bounces_log';
$table_bounces_hard= $wpdb->prefix.'sm_bounces_hard';
$table_bounces_log= $wpdb->prefix.'sm_bounces_log';
$table_stats_smtp = $wpdb->prefix.'sm_stats_smtp';
$table_blacklist= $wpdb->prefix.'sm_blacklist';
$table_spamscore = $wpdb->prefix.'sm_spamscore';
$table_messageid=$wpdb->prefix.'sm_stats_messageid';

if( !function_exists( 'nettoie' )) {
function nettoie($str, $charset='utf-8')
{
	$str=strtolower($str);
	$str = str_replace('/','',$str);
	$str = str_replace('\'','',$str);
	$str = str_replace('+','plus',$str);
	$str = str_replace('@','-',$str);
	$str = str_replace(' ','-',$str);
	$str = str_replace(' ','-',$str);
	$str = str_replace(' ','-',$str);
	$str = str_replace(' ','-',$str);
	$str = str_replace("(","-",$str);
	$str = str_replace(")","",$str);
	$str = str_replace("]","-",$str);
	$str = str_replace("[","",$str);
	$str = str_replace("?","e",$str);
	$str = str_replace("l'","-",$str);
	$str = str_replace("d'","-",$str);
	$str = str_replace("'","-",$str);
	$str = str_replace(",","-",$str);
	$str = str_replace(":","-",$str);
	$str = str_replace("__","_",$str);
	$str = str_replace("__","_",$str);
	$str = str_replace("--","_",$str);
	$str = str_replace("--","_",$str);
	$str = str_replace("--","_",$str);
	$str = str_replace("--","_",$str);
	$str = str_replace("-","_",$str);
    $str = htmlentities($str, ENT_NOQUOTES, $charset);
    
    $str = preg_replace('#\&([A-za-z])(?:acute|cedil|circ|grave|ring|tilde|uml)\;#', '\1', $str);
    $str = preg_replace('#\&([A-za-z]{2})(?:lig)\;#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#\&[^;]+\;#', '', $str); // supprime les autres caracteres
    
	$fin=strrchr($str,"_");
    if($fin == "_"){
    $str=substr($str, 0, -1);
    }

    $debut=substr($str,0,1);
	if($debut == "_"){
	$str = substr($str,1); 	
	}
	
    return stripslashes($str);
}
}
if(!function_exists('get_login')){
function get_login($user_id){
$user_info = get_userdata($user_id);
return $user_info->user_login;
}
}
if( !function_exists( 'key_generate' )) {
function key_generate(){
$lettre=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','1','2','3','4','5','6','7','8','9','0');
$m=date('Ymdhis');
$key=$m;
for($i=1;$i<5;$i++){
$key	.= $lettre[rand(1,60)];	
}
return $key;	
}
}
if( !function_exists( 'envoi_server' )) {
function envoi_server($url,$array)
{
	$args	=	http_build_query($array);
	$url	=	parse_url($url);

	if(isset($url['port']))
	{
		$port=$url['port'];
	}
	else
	{
		$port='80';
	}

	if(!$fp=fsockopen($url['host'], $port, $errno, $errstr))
	{
		$out = false;
	}
	else
	{
		$size = strlen($args);
		$request = "POST ".$url['path']." HTTP/1.1\n";
		$request .= "Host: ".$url['host']."\n";
		$request .= "Connection: Close\r\n";
		$request .= "Content-type: application/x-www-form-urlencoded\n";
		$request .= "Content-length: ".$size."\n\n";
		$request .= $args."\n";
		$fput = fputs($fp, $request);
		fclose ($fp);
		$out = true;
	}

	return $out;
}
}
if( !function_exists( 'post_xml' )) {
function post_xml($fichier,$item,$champs) {
   $chaine = $fichier;
      $tmp = preg_split("/<\/?".$item.">/",$chaine);
      for($i=1;$i<sizeof($tmp)-1;$i+=2)
         foreach($champs as $champ) {
            $tmp2 = preg_split("/<\/?".$champ.">/",$tmp[$i]);
            $tmp3[$i-1][] = @$tmp2[1];
         }
      return @$tmp3;
   }
}
if( !function_exists( 'lit_xml' )) {
function lit_xml($fichier,$item,$champs) {
   if($chaine = @implode("",@file($fichier))) {
      $tmp = preg_split("/<\/?".$item.">/",$chaine);
      for($i=1;$i<sizeof($tmp)-1;$i+=2)
         foreach($champs as $champ) {
            $tmp2 = preg_split("/<\/?".$champ.">/",$tmp[$i]);
            $tmp3[$i-1][] = @$tmp2[1];
         }
      return @$tmp3;
   }
}
}
if( !function_exists( 'post_xml_data' )) {
function post_xml_data($fichier,$item,$champs) {
   $chaine = $fichier;
      $tmp = preg_split("/<\/?".$item.">/",$chaine);
      for($i=1;$i<sizeof($tmp)-1;$i+=2)
         foreach($champs as $champ) {
            $tmp2 = preg_split("/<\/?".$champ.">/",$tmp[$i]);
            $tmp[$i]=str_replace("<![CDATA[","",$tmp[$i]);
			$tmp[$i]=str_replace("]]>","",$tmp[$i]);
            $tmp3[$i-1][] = @$tmp2[1];
         }
      return @$tmp3;
   }
}
if( !function_exists( 'lit_xml_data' )) {
function lit_xml_data($fichier,$item,$champs) {
   if($chaine = @implode("",@file($fichier))) {
      $tmp = preg_split("/<\/?".$item.">/",$chaine);
      for($i=1;$i<sizeof($tmp)-1;$i+=2)
         foreach($champs as $champ) {
            $tmp2 = preg_split("/<\/?".$champ.">/",$tmp[$i]);
            $tmp[$i]=str_replace("<![CDATA[","",$tmp[$i]);
			$tmp[$i]=str_replace("]]>","",$tmp[$i]);
            $tmp3[$i-1][] = @$tmp2[1];
         }
      return @$tmp3;
   }
}
}
if(!function_exists('sm_cgi_annonce')){
function sm_cgi_annonce(){
	    if(!isset($_SESSION['sm_annonce'])){	
        $array =array (
		"login" => get_option('sm_login'),
		"license_key" => get_option('sm_license_key'),
		"site" => str_replace("www.","",$_SERVER['HTTP_HOST']),
		"ip" => $_SERVER['REMOTE_ADDR'],
		"action" => "annonce"
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_npai.php',$array);
				$xml2l =post_xml_data($fluxl,'item',array('annonce'));
          foreach($xml2l as $row) {
		$_SESSION['sm_annonce']= $row[0] ; 
           } 
		return $_SESSION['sm_annonce']; 
		} else {
		return $_SESSION['sm_annonce'];	
		}
}
}
if(!function_exists('cgi_nlj')){
function cgi_nlj(){
	    if(!isset($_SESSION['sm_nlj'])){
		if(get_option('sm_license')=="free" || !get_option('sm_license_key')){
		$_SESSION['sm_nlj']=get_option('sm_nbl');	
		} else {
        $array =array (
		"login" => get_option('sm_login'),
		"license_key" => get_option('sm_license_key'),
		"site" => str_replace("www.","",$_SERVER['HTTP_HOST']),
		"ip" => $_SERVER['REMOTE_ADDR']
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_license.php',$array);
		   $xml2l =post_xml($fluxl,'item',array('limite_journaliere'));
          foreach($xml2l as $row) {
				$_SESSION['sm_nlj']= $row[0]; 
           } 
		}
		return $_SESSION['sm_nlj']; 
		} else {
		return $_SESSION['sm_nlj'];	
		}
}
}
if(!function_exists('cgi_bounces')){
function cgi_bounces(){
	    if(!isset($_SESSION['sm_bounces'])){
		if(get_option('sm_license')=="free" || !get_option('sm_license_key')){
		$_SESSION['sm_bounces']=get_option('sm_bounces');	
		} else {	
        $array =array (
		"login" => get_option('sm_login'),
		"license_key" => get_option('sm_license_key'),
		"site" => str_replace("www.","",$_SERVER['HTTP_HOST']),
		"ip" => $_SERVER['REMOTE_ADDR']
		); 
        $fluxl =xml_server_api('http://www.tous1site.name/wp-code/cgi_wordpress_license.php',$array);
		$xml2l =post_xml($fluxl,'item',array('bounces'));
		//echo '<textarea name="" cols="150" rows="10">'.$xml2l.'</textarea>';
          foreach($xml2l as $row) {
	    	$_SESSION['sm_bounces']= $row[0];
           } 
		
		}
		return $_SESSION['sm_bounces']; 
		} else {
		return $_SESSION['sm_bounces'];	
		}
}
}
if(!function_exists('cgi_blacklist')){
function cgi_blacklist(){
	    if(!isset($_SESSION['sm_blacklist'])){	
	    if(get_option('sm_license')=="free" || !get_option('sm_license_key')){
		$_SESSION['sm_blacklist']=get_option('sm_blacklist');	
		} else {
        $array =array (
		"login" => get_option('sm_login'),
		"license_key" => get_option('sm_license_key'),
		"site" => str_replace("www.","",$_SERVER['HTTP_HOST']),
		"ip" => $_SERVER['REMOTE_ADDR']
		); 
        $fluxl =xml_server_api('http://www.tous1site.name/wp-code/cgi_wordpress_license.php',$array);
		$xml2l =post_xml($fluxl,'item',array('stats_backlist'));
		//echo '<textarea name="" cols="150" rows="10">'.$fluxl.'</textarea>';
		if($xml2l !='')
		{
          foreach($xml2l as $row) {
			  $_SESSION['sm_blacklist']= $row[0]; 
           } 
		} else {
		$_SESSION['sm_blacklist']='oui';	
		}
		} 
		}
		return $_SESSION['sm_blacklist'];	

}
}
if(!function_exists('cgi_stats_smtp')){
function cgi_stats_smtp(){
	    if(!isset($_SESSION['sm_stats_smtp'])){	
	    if(get_option('sm_license')=="free" || !get_option('sm_license_key')){
		$_SESSION['sm_stats_smtp']=get_option('sm_stats_smtp');	
		} else {
        $array =array (
		"login" => get_option('sm_login'),
		"license_key" => get_option('sm_license_key'),
		"site" => str_replace("www.","",$_SERVER['HTTP_HOST']),
		"ip" => $_SERVER['REMOTE_ADDR']
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_license.php',$array);
		  $xml2l =post_xml($fluxl,'item',array('stats_smtp'));
          foreach($xml2l as $row) {
$_SESSION['sm_stats_smtp']= $row[0];
           } 
		}
		return $_SESSION['sm_stats_smtp']; 
		} else {
		return $_SESSION['sm_stats_smtp'];	
		}
}
}

if( !function_exists( 'update_license2' )) {
function update_license2($url,$array){
 $ch = curl_init();
 curl_setopt_array($ch, array(CURLOPT_URL            => $url,
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_POST           => true,
                              CURLOPT_POSTFIELDS     => http_build_query($array)));
  
 $string = curl_exec($ch);
 curl_close($ch);
  $xml2l =post_xml($string,'item',array('license'));
  foreach($xml2l as $row) {
   return $row[0] ;
  } 
}
}
if( !function_exists( 'update_serveur' )) {
function update_serveur($url,$array){
 $ch = curl_init();
 curl_setopt_array($ch, array(CURLOPT_URL            => $url,
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_POST           => true,
                              CURLOPT_POSTFIELDS     => http_build_query($array)));
  
$string = curl_exec($ch);
curl_close($ch);
$xml2l =post_xml($string,'item',array('resultat'));
    foreach($xml2l as $row) {
    return $row[0] ;
    }
}
}
if( !function_exists( 'nb_destinataire' )) {
function nb_destinataire($liste){
global $wpdb;
$table_liste= $wpdb->prefix.'sm_liste';
$total=0;
$fivesdrafts = $wpdb->get_results("SELECT liste_bd FROM `".$table_liste."` WHERE id ='".$liste."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$total= $wpdb->get_var("SELECT count(id) AS total FROM `".$fivesdraft->liste_bd."`");
}
return $total;	
}
}
if( !function_exists( 'nb_clic' )) {
function nb_clic($hie,$user_login,$host){
	$res="";
	$xml2=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php?action=hie_id&hie='.$hie.'&login='.$user_login.'&domaine_client='.$host.'&key='.get_option('sm_license_key').'','item',array('resultat','lecture','clic','page','affiliation','desinscrit'));
if($xml2!='') {
    foreach($xml2 as $row) {
	$clic= $row[2] + $row[3] + $row[4];
	$res="".$row[1]."|".$clic."|".$row[5]."|";	
	}
}
return $res;
}
}
if( !function_exists( 'nbenvoyer' )) {
function nbenvoyer($hie){
global $wpdb;	
$nb=0;
$table_log = $wpdb->prefix.'sm_log';
$fivesdrafts = $wpdb->get_results("SELECT count(id) AS nb FROM `".$table_log."` WHERE hie='$hie'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$nb=$fivesdraft->nb;
}
return $nb;
}
}
if( !function_exists( 'nbattente' )) {
function nbattente($hie){
global $wpdb;
$nb=0;
$table_temps= $wpdb->prefix.'sm_temps';
$fivesdrafts = $wpdb->get_results("SELECT count(id) AS nba FROM `".$table_temps."` WHERE hie='$hie'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$nba=$fivesdraft->nba;
}
$table_suite= $wpdb->prefix.'sm_suite';
$fivesdrafts1 = $wpdb->get_results("SELECT count(id) AS nbs FROM `".$table_suite."` WHERE hie='$hie'");
foreach ( $fivesdrafts1 as $fivesdraft1 ) 
{
$nbs=$fivesdraft1->nbs;
}
$nb=$nbs+$nba;
return $nb;
}
}
if( !function_exists( 'nbattente_in' )) {
function nbattente_in($hie){
global $wpdb;
$nb=0;
$table_envoi= $wpdb->prefix.'sm_historique_envoi';
$nb_attente=0;
$fivesdrafts = $wpdb->get_results("SELECT nb_attente FROM `".$table_envoi."` WHERE id='$hie'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$nb_attente=$fivesdraft->nb_attente;
}
return $nb_attente;
}
}
if( !function_exists( 'nb_envoi_in' )) {
function nb_envoi_in($hie){
global $wpdb;
$table_envoi= $wpdb->prefix.'sm_historique_envoi';
$nb_envoi=0;
$fivesdrafts = $wpdb->get_results("SELECT nb_envoi FROM `".$table_envoi."` WHERE id='$hie'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$nb_envoi=$fivesdraft->nb_envoi;
}
return $nb_envoi;
}
}
if( !function_exists( 'sm_schortode' )) {
function sm_schortode($txt){
global $wpdb;
$txt=str_replace('[societe]', get_option('sm_companyname'),$txt);
$txt=str_replace('[adresse]', get_option('sm_companyadresse'),$txt);
$txt=str_replace('[tel]', get_option('sm_telephone'),$txt);
$txt=str_replace('[fax]', get_option('sm_fax'),$txt);
$txt=str_replace('[email_ret]', get_option('sm_email_ret'),$txt);
$txt=str_replace('[site_url]', get_option('siteurl'),$txt);
$txt=str_replace('[site_name]', get_option('blogname'),$txt);
$txt=str_replace('[site_desc]', get_option('blogdescription'),$txt);
$txt=str_replace('[site_email]', get_option('admin_email'),$txt);
$txt=str_replace('[date_jour]', date("l j F Y"),$txt);
$txt=str_replace('[date]', date('Ymdhis'),$txt);
$txt=str_replace('[link_facebook]', get_option('sm_link_facebook'),$txt);
$txt=str_replace('[link_google]', get_option('sm_link_google'),$txt);
$txt=str_replace('[link_twitter]', get_option('sm_link_twitter'),$txt);
$txt=str_replace('[link_linkedin]', get_option('sm_link_linkedin'),$txt);
return $txt;
}
}
if( !function_exists( 'sm_schortode_txt' )) {
function sm_schortode_txt($txt,$idn=0,$hie){
global $wpdb;
$txt=str_replace('[lien_affiliation]','http://www.e-mailing-service.net?aff_id='.get_option('sm_login').'',$txt);
$txt=str_replace('[lien_page]',''.get_option('siteurl').'/?p='.$idn.'',$txt);
$txt=str_replace('[lien_desabo]',''.get_option('siteurl').'/index.php?smemail=[email_id]&smhie='.$hie.'&smfree=1&smcle=[cle]',$txt);
return $txt;
}
}
if( !function_exists( 'sm_search_bd' )) {
function sm_search_bd($table_bd,$email){
global $wpdb;	
$id='0';
$fivesdrafts = $wpdb->get_results("SELECT id,email AS mails FROM `".$table_bd."` WHERE email like '%".$email."%'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$id ="".$fivesdraft->id."|".$fivesdraft->mails."";
}
return $id;
}
}

if( !function_exists( 'sm_liste_title' )) {
function sm_liste_title($id){
global $wpdb;	
$table_liste= $wpdb->prefix.'sm_liste';
$liste_nom='?';
$fivesdrafts = $wpdb->get_results("SELECT liste_nom FROM `".$table_liste."` WHERE id='".$id."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$liste_nom =$fivesdraft->liste_nom;
}
return $liste_nom;
}
}
if( !function_exists( 'sm_liste_title_bd' )) {
function sm_liste_title_bd($bd){
global $wpdb;	
$table_liste= $wpdb->prefix.'sm_liste';
$fivesdrafts = $wpdb->get_results("SELECT liste_nom FROM `".$table_liste."` WHERE liste_bd='$bd'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$liste_nom =$fivesdraft->liste_nom;
}
return $liste_nom;
}
}
if( !function_exists( 'sm_template_title' )) {
function sm_template_title($id){
global $wpdb;	
$table_posts= $wpdb->prefix.'posts';
$fivesdrafts = $wpdb->get_results("SELECT post_title FROM `".$table_posts."` WHERE ID='".$id."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$post_title =$fivesdraft->post_title;
}
return $post_title;
}
}
if( !function_exists( 'sm_affiche_template' )) {
function sm_affiche_template($title,$link){
global $wpdb;	
$table_posts= $wpdb->prefix.'posts';
$fivesdrafts = $wpdb->get_results("SELECT post_content,guid,post_title FROM `".$table_posts."` WHERE ID='".get_option('sm_post_id_auto')."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$post_content =$fivesdraft->post_content;
}
$post_content=str_replace('[link]','[lien_page]',$post_content);
$post_content=str_replace('[link_titre]',$title,$post_content);
return $post_content;
}
}
if(!function_exists('sm_alerte_envoi' )) {
function sm_alerte_envoi($sujet,$detail,$user_id)
{
$sender = get_user_meta( $user_id, 'sm_sender',true);
$from = get_user_meta( $user_id, 'sm_from',true);
$to = get_user_meta( $user_id, 'sm_alerte_email',true);
$reply_to = get_user_meta( $user_id, 'sm_reply',true);
$header = "From: ".$from."
To: ".$to."
Reply-to: ".$reply_to ."
Subject: ".$sujet."
Content-Type: text/html; charset=utf-8; format=flowed;
Errors-To: ".get_option('sm_email_ret')."

";  
wp_mail(get_user_meta( $user_id, 'sm_alerte_email'), $sujet, $detail, $header, "");		
}
}

if(!function_exists('sm_suite_nb' )) {
function sm_suite_nb($hie){
global $wpdb;
$nb=0;
$table_suite = $wpdb->prefix.'sm_suite';
$fivesdrafts = $wpdb->get_results("SELECT count(id) AS nb FROM `".$table_suite."` WHERE hie='$hie'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$nb=$fivesdraft->nb;
}
return $nb;
}
}
if(!function_exists('sm_blacklist' )) {
function sm_blacklist($ip){
global $wpdb;
$nb=0;
$table_blacklist = $wpdb->prefix.'sm_blacklist';
$fivesdrafts = $wpdb->get_results("SELECT count(id) AS nb FROM `".$table_blacklist."` WHERE ip='$ip' GROUP BY date DESC");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$nb=$fivesdraft->nb;
}
if($nb < 2){
$nbc= '<span class="sm_table_bleu">&nbsp;&nbsp;'.$nb.'&nbsp;&nbsp;</span>';
}
elseif($nb < 6){
$nbc= '<span class="sm_table_orange">&nbsp;&nbsp;'.$nb.'&nbsp;&nbsp;</span>';
}
elseif($nb > 5){
$nbc= '<span class="sm_table_rouge">&nbsp;&nbsp;'.$nb.'&nbsp;&nbsp;</span>';
}
return $nbc;
}
}
if(!function_exists('sm_spamscore' )) {
function sm_spamscore($smtp){
global $wpdb;
$nb=0;
$table_spamscore = $wpdb->prefix.'sm_spamscore';
$fivesdrafts = $wpdb->get_results("SELECT spamscore FROM `".$table_spamscore."` WHERE smtp='$smtp'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$nb=$fivesdraft->spamscore;
}
if($nb > 90 || $nb == "0" || $nb == "?" ){
$nbc= '<span class="sm_table_bleu">&nbsp;&nbsp;'.$nb.'&nbsp;&nbsp;</span>';
}
elseif($nb < 91 && $nb > 19 ){
$nbc= '<span class="sm_table_orange">&nbsp;&nbsp;'.$nb.'&nbsp;&nbsp;</span>';
}
elseif($nb < 20){
$nbc= '<span class="sm_table_rouge">&nbsp;&nbsp;'.$nb.'&nbsp;&nbsp;</span>';
}
return $nbc;
}
}

if(!function_exists('sm_getStatus' )) { 
function sm_getStatus($smtp,$port,$style=0){
$ip = gethostbyname($smtp);
   $socket = @fsockopen($ip, $port, $errorNo, $errorStr, 3);
   if($style=='1'){
	 if(!$socket) return 0;
	 else return 1;   
   } else {
   if(!$socket) return '<span class="sm_table_rouge">&nbsp;&nbsp;'.__("offline","e-mailing-service").'&nbsp;&nbsp;</span>';
     else return '<span class="sm_table_vert">&nbsp;&nbsp;'.__("online","e-mailing-service").'&nbsp;&nbsp;</span>';
   }
}
}
if(!function_exists('sm_optimisation_fai' )) { 
function sm_optimisation_fai($email,$sujet,$num=1,$mode="text/html",$fromname='serveurs-mail.net',$reply_to='',$error_to=''){
@list($nameemail,$faiemail)=explode('@',$email);
if($faiemail == "yahoo.com"){
$header = "Reply-to: ".$reply_to."
Content-Type: ".$mode."; charset=utf-8; format=flowed;
Errors-To: ".$error_to."
List-Unsubscribe: <mailto: ".$_SESSION['sm_email_ret'].">
Precedence: bulk



";
} 
if($faiemail == "orange.fr"){
$header = "Reply-to: ".$reply_to."
Subject: ".$sujet."
Content-Type: ".$mode."; charset=utf-8; format=flowed;
Errors-To: ".$_SESSION['sm_email_ret']."
List-Unsubscribe: <mailto: ".$error_to.">



";
} 
if($faiemail == "gmail.com"){
$header = "Reply-to: ".$reply_to."
Subject: ".$sujet."
Content-Type: ".$mode."; charset=utf-8; format=flowed;
Errors-To: ".$error_to."
Precedence: bulk



";
}
else {
if(!isset($_SESSION['sm_email_ret'])){
	$erroto=$reply_to;
} else {
	$erroto=$_SESSION['sm_email_ret'];
}
$header = "Reply-to: ".$reply_to."
Subject: ".$sujet."
Content-Type: ".$mode."; charset=utf-8; format=flowed;
Errors-To: ".$erroto."




"; 
}
return $header;
}
}
if( !function_exists( 'xml_server_api' )) {
      function xml_server_api($url,$array)
       {
	$args	=	http_build_query($array);
	$url	=	parse_url($url);

	if(isset($url['port']))
	{
		$port=$url['port'];
	}
	else
	{
		$port='80';
	}

	if(!$fp=fsockopen($url['host'], $port, $errno, $errstr))
	{
		//$out = false;
	}
	else
	{
		$size = strlen($args);
		$request = "POST ".$url['path']." HTTP/1.1\n";
		$request .= "Host: ".$url['host']."\n";
		$request .= "Connection: Close\r\n";
		$request .= "Content-type: application/x-www-form-urlencoded\n";
		$request .= "Content-length: ".$size."\n\n";
		$request .= $args."\n";
		$fput = fputs($fp, $request);
	        $resultat ="";

		while (!feof($fp))
		{
			$resultat .= fgets($fp,4096);
 
		}

		fclose($fp);
		//$out = true;
	}

	$debut_flux = strpos($resultat,'<?xml version="1.0" encoding="UTF-8"?>');
	$flux = substr($resultat,$debut_flux);
	return $flux;
	      }
}
if( !function_exists( 'sm_cron_blocage' )) {
function sm_cron_blocage(){
global $wpdb;
$table_envoi= $wpdb->prefix.'sm_historique_envoi';
$id=0;
echo "<h2>".__("Tester la vitesse d'envoi de votre newsletter","e-mailing-service")."</h2>";	
$fivesdrafts = $wpdb->get_results("SELECT id AS hie,status,nb_attente,pause FROM `".$table_envoi."` WHERE status='En cours' ORDER BY id desc");
foreach ( $fivesdrafts as $fivesdraft ) 
{
_e("Si votre newsletter envoi moin vite que le reglage que vous avez effectue lors de l'envoi , c'est que votre Hebergement wordpress est trop lent","e-mailing-service");
echo "<br>";	
	$id=$fivesdraft->hie;
$nb_avant_sleep=nbattente($fivesdraft->hie);
echo _e("Nombre en attente","e-mailing-service");
echo " : ".$nb_avant_sleep."<br>";
$pause= $fivesdraft->pause+10;
sleep($pause);
$apres=nbattente($fivesdraft->hie);
echo _e("Nombre en attente apres ","e-mailing-service");
echo "".$pause." ".__("secondes","e-mailing-service")." : ".$apres." <br>";
if($nb_avant_sleep == $apres){
echo _e("le status va etre reactiver","e-mailing-service");
        $sql3 ="UPDATE `".$table_envoi."` SET `status`='reactiver' WHERE id = '".$fivesdraft->hie."'";
        $result3 = $wpdb->query($wpdb->prepare($sql3,true));	
}
}
if($id ==0){
_e("Vous n'avez pas de newsletter qui tourne actuellement, vous ne pouvez donc pas verifier la vitesse d'envoi","e-mailing-service");	
}
}
}
?>