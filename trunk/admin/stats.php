<?php include(smPATH . '/include/entete.php');
global $wpdb;
if(!isset($SMINCLUDEOK)){
include(smPATH . '/include/fonctions_sm.php');
}
	if(get_option('sm_license')=="free" || !get_option('sm_license_key')){
$total = $wpdb->get_var("
    SELECT COUNT(id)
    FROM ".$table_envoi."
");
$comments_per_page = 10;
$page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
$npage = $page - 1;
$num = $npage * $comments_per_page;

echo paginate_links( array(
    'base' => add_query_arg( 'cpage', '%#%' ),
    'format' => '',
    'prev_text' => __('&laquo;'),
    'next_text' => __('&raquo;'),
    'total' => ceil($total / $comments_per_page),
    'current' => $page
));
echo '<h1>'.__("Statistiques","e-mailing-service").'</h1>';
_e("Nous ne pouvons pas fournir de statistiques detailles si vous nous fournissez pas l'autorisation d'interagir avec votre site, c'est entierement gratuit,  pour cela rendez vous dans le menu ","e-mailing-service");
echo "<a href=\"?page=e-mailing-service/admin/configuration.php\">".__("License et options","e-mailing-service")."</a><br>";
echo '<table><tr>
<td>
<form action="?page=e-mailing-service/admin/stats.php" method="post">
<input name="action" type="hidden" value="campagne" />
<input name="submit" type="submit" value="'.__("Statistiques par Campagne","e-mailing-service").'" />
</form>
</td>
<td>
</td>
<td>
<form action="?page=e-mailing-service/admin/stats.php" method="post">
<input name="action" type="hidden" value="envoi" />
<input name="submit" type="submit" value="'.__("Statistiques par envoi","e-mailing-service").'" />
</form>
</td>
<td></td>
<td>
<form action="?page=e-mailing-service/admin/stats.php" method="post">
<input name="action" type="hidden" value="liste" />
<input name="submit" type="submit" value="'.__("Statistiques par liste","e-mailing-service").'" />
</form>
</td>
</tr></table>';
extract($_POST);
if(!isset($action)){
$action="campagne";	
}
if($action=="envoi"){
echo '<h2>'.__("Listes des campagnes envoyes","e-mailing-service").'</h2>';
$tbaleau_insert ='<table class="paginate50 sortable full">
                         <thead><tr>';
$tbaleau_insert .="<th><blockquote>".__('Id envoi',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Type',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Campagne',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Liste',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Nb emails envoyes',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="</tr></thead><tdboy>";
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_envoi."` ORDER BY id DESC");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$tbaleau_insert .="<tr><td><blockquote>".$fivesdraft->id."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->type."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".sm_template_title($fivesdraft->id_newsletter)."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".sm_liste_title($fivesdraft->id_liste)."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->nb_envoi."</blockquote></td>";	
$tbaleau_insert .="</tr>";	
}
$tbaleau_insert .="</tdboy></table>";
echo $tbaleau_insert;
}
elseif($action=="campagne"){
echo '<h2>'.__("Statistiques par campagne","e-mailing-service").'</h2>';
$tbaleau_insert ='<table class="paginate50 sortable full">
                         <thead><tr>';
$tbaleau_insert .="<th><blockquote>".__('Id envoi',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Type',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Campagne',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Liste',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Nb emails envoyes',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="</tr></thead><tdboy>";
$fivesdrafts = $wpdb->get_results("SELECT sum(nb_envoi) AS tot_news,id_newsletter,id_liste,id,type FROM `".$table_envoi."` GROUP BY id_newsletter");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$tbaleau_insert .="<tr><td><blockquote>".$fivesdraft->id."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->type."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".sm_template_title($fivesdraft->id_newsletter)."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".sm_liste_title($fivesdraft->id_liste)."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->tot_news."</blockquote></td>";	
$tbaleau_insert .="</tr>";	
}
$tbaleau_insert .="</tdboy></table>";
echo $tbaleau_insert;		
}
elseif($action=="liste"){
echo '<h2>'.__("Statistiques par campagne","e-mailing-service").'</h2>';
$tbaleau_insert ='<table class="paginate50 sortable full">
                         <thead><tr>';
$tbaleau_insert .="<th><blockquote>".__('Id envoi',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Type',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Campagne',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Liste',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Nb emails envoyes',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="</tr></thead><tdboy>";
$fivesdrafts = $wpdb->get_results("SELECT sum(nb_envoi) AS tot_news,id_newsletter,id_liste,id,type FROM `".$table_envoi."` GROUP BY id_liste");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$tbaleau_insert .="<tr><td><blockquote>".$fivesdraft->id."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->type."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".sm_template_title($fivesdraft->id_newsletter)."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".sm_liste_title($fivesdraft->id_liste)."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->tot_news."</blockquote></td>";	
$tbaleau_insert .="</tr>";	
}
$tbaleau_insert .="</tdboy></table>";
echo $tbaleau_insert;		
}
	} else {
?>
<script language="JavaScript" type="text/javascript"> 
function loadPage(url){ 
document.getElementById('f_2').innerHTML = '<iframe src="' + url + '" width="100%" height="600"></iframe>';
 } 
</script>
<script language="JavaScript" type="text/javascript"> 
function loadPage(url){ 
document.getElementById('f_4').innerHTML = '<iframe src="' + url + '" width="100%" height="1200"></iframe>';
 } 
</script> 
<script language="JavaScript" type="text/javascript"> 
function loadPage(url){ 
document.getElementById('f_6').innerHTML = '<iframe src="' + url + '" width="100%" height="600"></iframe>';
 } 
</script> 
<script language="JavaScript" type="text/javascript"> 
function loadPage(url){ 
document.getElementById('f_8').innerHTML = '<iframe src="' + url + '" width="100%" height="2000"></iframe>';
 } 
</script> 
 
<table width="90%">
<tr>
<td><div id="f_1"> 
<button onClick="javascript:loadPage('http://www.serveurs-mail.net/wp-code/cgi_wordpress_stats.php?stats=mensuel&login=<?php echo get_option('sm_login')?>&key=<?php echo get_option('sm_license_key')?>');"><?php _e("Statistiques Mensuel","e-mailing-service");?></button>
 </div> <td>
<td>
<div id="f_3"> 
<button onClick="javascript:loadPage('http://www.serveurs-mail.net/wp-code/cgi_wordpress_stats.php?stats=jour&login=<?php echo get_option('sm_login')?>&key=<?php echo get_option('sm_license_key')?>');"><?php _e("Statistiques detatille du jour","e-mailing-service");?></button>
 </div> </td>
 <td>
<div id="f_5"> 
<button onClick="javascript:loadPage('http://www.serveurs-mail.net/wp-code/cgi_wordpress_stats.php?stats=campagne&login=<?php echo get_option('sm_login')?>&key=<?php echo get_option('sm_license_key')?>');"><?php _e("Statistiques par Campagne","e-mailing-service");?></button>
 </div> </td>
 <td>
<div id="f_7"> 
<button onClick="javascript:loadPage('http://www.serveurs-mail.net/wp-code/cgi_wordpress_stats.php?stats=hie&login=<?php echo get_option('sm_login')?>&key=<?php echo get_option('sm_license_key')?>');"><?php _e("Statistiques par envoi","e-mailing-service");?></button>
 </div> </td>
 </tr></table>
<div id="f_2"></div> 
<div id="f_4"></div> 
<div id="f_6"></div> 
<div id="f_8"></div> 
</div> 
</div> 
<?php } ?>