<?php
include(smPATH . '/include/fonctions_sm.php');
$table_liste = $wpdb->prefix.'sm_liste'; 
extract($_POST);
if(isset($action)){
	if($action == "envoi"){
	   $wpdb->insert("".$wpdb->prefix."sm_historique_envoi", array(  
            'id_newsletter' => $campagne,  
            'id_liste' => $liste,
            'date_envoi' => date('Y-m-d H:i:s')
       ));
	   $hie = $wpdb->insert_id;
	    list($id_liste,$table_liste)=explode("|",$liste);
		$array =array (
		"domaine_client" => str_replace("www.","",$_SERVER['HTTP_HOST']),
		"liste" => $id_liste,
		"campagne" => $campagne,
		"jour_hie" => $jour_hie,
		"heure_hie" => $heure_hie,
		"hie" => $hie,
		"bd" => DB_NAME,
		"bd_table" => $table_liste,
		"bd_login" => DB_USER,
		"bd_pass" => DB_PASSWORD,
		"bd_ip" => DB_HOST,
		"sm_smtp_server" => get_option('sm_smtp_server'),
		"sm_smtp_authentification" => get_option('sm_smtp_authentification'),
		"sm_smtp_port" => get_option('sm_smtp_port'),
		"sm_smtp_login" => get_option('sm_smtp_login'),
		"sm_smtp_pass" => get_option('sm_smtp_pass'),
		"multi_blog_id" => get_current_blog_id()
		); 
		return envoi_server('http://www.serveurs-mail.net/wp-code/cgi_wordpress.php',$array);
		//echo "<iframe border=\"1\" height=\"600\" width=\"750\" src=\"http://www.serveurs-mail.net/wp-code/cgi_wordpress.php?domaine_client=".get_option("siteurl")."&liste=".$id_liste."&campagne=".$campagne."&jour_hie=".$jour_hie."&heure_hie=".$heure_hie."&hie=".$hie."&bd=".DB_NAME."&bd_table=".$table_liste."&bd_login=".DB_USER."&bd_pass=".DB_PASSWORD."&bd_ip=".DB_HOST."&
		//sm_smtp_server=".get_option('sm_smtp_server')."&sm_smtp_authentification=".get_option('sm_smtp_authentification')."&sm_smtp_port=".get_option('sm_smtp_port')."&sm_smtp_login=".get_option('sm_smtp_login')."&sm_smtp_pass=".get_option('sm_smtp_pass')."&multi_blog_id=".get_current_blog_id()."\" />";
	    echo "Votre mailing va demarrer";
	}
} else {

echo "<br><h1>Envoyer votre newsletter</h1>";
echo "<h2>Votre newsletter partira 15 mn apres la validation du formulaire si vous ne changer pas la date et l'heure d'envoi</h2>";
echo '<form action="admin.php?page=e-mailing-service/admin/envoi.php" method="post" target="_parent">
<input type="hidden" name="action" value="envoi" />';
echo "<table border=\"1\" width=\"90%\">";
echo "<tr><td><blockquote><b>Choisir une lise</b></blockquote></td><td><blockquote><b>Choisir une campagne</b></blockquote></td><td><blockquote><b>Choisir la date</b></blockquote></td><td></td></tr>";
echo "<tr>
<td><blockquote><select name=\"liste\">";
$listes = $wpdb->get_results("SELECT * FROM `".$table_liste."`");
foreach ( $listes as $liste ) 
{
	  echo "<option value=\"".$liste->id."|".$liste->liste_bd."\" selected=\"selected\">".$liste->liste_nom."</option>";

}
echo "</select></blockquote></td>
<td><blockquote><select name=\"campagne\">";
$news = $wpdb->get_results("SELECT ID,post_title FROM `".$wpdb->prefix."posts` WHERE post_type='newsletter' AND post_status ='publish' ORDER BY ID DESC");
foreach ( $news as $new ) 
{
	 echo "<option value=\"".$new->ID."\" selected=\"selected\">".$new->post_title."</option>";

}
echo "</select></blockquote></td>
<td>
<blockquote><select name=\"jour_hie\">";
  echo '<option value="0" selected="selected">0 jours</option>';	
for($i=0;$i<30;$i++){
  echo "<option value=\"".$i."\">".$i." jours</option>";	
}
echo "</select><select name=\"heure_hie\">";
  echo '<option value="0" selected="selected">0 heure</option>';	
for($i=0;$i<24;$i++){
	
  echo "<option value=\"".$i."\">".$i." h</option>";	
}
echo "</select></blockquote>

</td>
<td><input name=\"envoyer\" type=\"submit\" value=\"envoyer\"/></td>

";
echo "</table></form>";

}
?>