<?php
include(smPATH . '/include/entete.php');

if(cgi_bounces() == 'non'){
echo "<br><br>";
_e("Vous n'avez pas souscrit a l'option qui vous permet de recuperer les bounces","e-mailing-service");

} else {


?>
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div>
	<h2 class="nav-tab-wrapper">
    <a href="?page=e-mailing-service/admin/npai.php" class="nav-tab <?php if(!isset($_REQUEST['section'])){ echo 'nav-tab-active';} ?>">
			<?php _e('Liste des NPAI',"e-mailing-service"); ?>
		</a>
        <a href="?page=e-mailing-service/admin/npai.php&section=bounces_fai" class="nav-tab <?php if(isset($_REQUEST['section'])){ if ($_REQUEST['section'] == 'bounces_fai') echo 'nav-tab-active'; }?>">
			<?php _e("Reponses FAI", "e-mailing-service"); ?>
		</a>
		<a href="?page=e-mailing-service/admin/npai.php&section=hard_bounces" class="nav-tab <?php if(isset($_REQUEST['section'])){ if ($_REQUEST['section'] == 'hard_bounces') echo 'nav-tab-active'; }?>">
			<?php _e("Hard Bounces ", "e-mailing-service"); ?>
		</a>
		<a href="?page=e-mailing-service/admin/npai.php&section=bounces_import" class="nav-tab <?php if(isset($_REQUEST['section'])){ if ($_REQUEST['section'] == 'bounces_import') echo 'nav-tab-active'; }?>">
			<?php _e('Importer NPAI',"e-mailing-service"); ?>
		</a>
		<a href="?page=e-mailing-service/admin/npai.php&section=bounces_update" class="nav-tab <?php if(isset($_REQUEST['section'])){ if($_REQUEST['section'] == 'bounces_update') echo 'nav-tab-active'; } ?>">
			<?php _e("Retirer des listes les Hard bounces", "e-mailing-service"); ?>
		</a>
      	
	</h2><h2>
   <?php
 if(isset($_REQUEST['section'])){
	
		if ($_REQUEST['section'] == 'bounces_import') include(smPATH.'include/bounces_update.php');
		if ($_REQUEST['section'] == 'bounces_update') include(smPATH.'include/bounces_update_liste.php');

		
/////debut/////			
		if ($_REQUEST['section'] == 'hard_bounces'){
$total = $wpdb->get_var("
    SELECT COUNT(id)
    FROM ".$table_bounces_hard."
");
$comments_per_page = 100;
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
    $tbaleau_insert="";
    $tbaleau_insert .= '<table class="widefat">
                         <thead>';
    $tbaleau_insert .= "<tr>";
	$tbaleau_insert .= "<td><blockquote>".__('Email',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Retirer des listes',"e-mailing-service")."</blockquote></td>";
    $tbaleau_insert .= '</tr>           
        </thead>
        <tbody>';
$listeemail = $wpdb->get_results("SELECT * FROM `".$table_bounces_hard."` ORDER BY id DESC LIMIT $num,$comments_per_page");
foreach ( $listeemail as $listeemails ) 
{
    $tbaleau_insert .= "<tr>";
	$tbaleau_insert .= "<td><blockquote>".$listeemails->email."</blockquote></td>";
	if($listeemails->update == 0){
	$tbaleau_insert .= "<td><blockquote>".__('oui','e-mailing-service')."</blockquote></td>";
	} else {
	$tbaleau_insert .= "<td><blockquote>".__('non','e-mailing-service')."</blockquote></td>";	
	}
    $tbaleau_insert .= '</tr>';
}
$tbaleau_insert .= '</tbody></table>';
echo $tbaleau_insert ;

	}
/////fin/////	
			
/////debut/////			
		if ($_REQUEST['section'] == 'bounces_fai'){
$total = $wpdb->get_var("
    SELECT COUNT(id)
    FROM ".$table_log_bounces." GROUP BY fai
");
$comments_per_page = 5;
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

    $tbaleau_insert = '<table class="widefat">
                         <thead>';
    $tbaleau_insert .= "<tr>";
	$tbaleau_insert .= "<td><blockquote>".__('License NPAI',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('FAI',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Email',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Date email',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Categorie',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Type',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Sujet',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Lire le mail',"e-mailing-service")."</blockquote></td>"; 
    $tbaleau_insert .= '</tr>           
        </thead>
        <tbody>';
$listeemail = $wpdb->get_results("SELECT * FROM `".$table_log_bounces."`  WHERE fai !='' GROUP BY fai ORDER BY date DESC LIMIT $num,$comments_per_page");
foreach ( $listeemail as $listeemails ) 
{
	
?>
<?php
    $tbaleau_insert .= "<tr>
	<td><blockquote>".$listeemails->idb."</blockquote></td>
	<td><blockquote>".$listeemails->fai."</blockquote></td>
	<td><blockquote>".$listeemails->email."</blockquote></td>
	<td><blockquote>".$listeemails->date."</blockquote></td>
	<td><blockquote>".$listeemails->rules_cat."</blockquote></td>
	<td><blockquote>".$listeemails->bounce_type."</blockquote></td>
	<td><blockquote>".$listeemails->subject."</blockquote></td>
	<td><blockquote><a href=\"?page=e-mailing-service/admin/npai.php&section=bounces_fai_details&id=".$listeemails->id."\" title=\"".$listeemails->dsn_message."\" target=\"_blank\">".__('Details','e-mailing-service')."</a></blockquote></td>"; 
    $tbaleau_insert .= '</tr>';
}
$tbaleau_insert .= '</tbody></table>';
echo $tbaleau_insert ;

	}
/////fin/////		

/////debut/////			
		if ($_REQUEST['section'] == 'bounces_fai_details'){
$listeemail = $wpdb->get_results("SELECT * FROM `".$table_log_bounces."`  WHERE id ='".$_GET["id"]."'");
foreach ( $listeemail as $listeemails ) 
{
    $tbaleau_insert = "<table class=\"widefat\">
	<tr><td><blockquote>".$listeemails->idb."</blockquote></td></tr>
	<tr><td><blockquote>".$listeemails->fai."</blockquote></td></tr>
	<tr><td><blockquote>".$listeemails->email."</blockquote></td></tr>
	<tr><td><blockquote>".$listeemails->date."</blockquote></td></tr>
	<tr><td><blockquote>".$listeemails->rules_cat."</blockquote></td></tr>
	<tr><td><blockquote>".$listeemails->bounce_type."</blockquote></td></tr>
	<tr><td><blockquote>".$listeemails->subject."</blockquote></td></tr>
	<tr><td><blockquote>".$listeemails->diag_code."</blockquote></td></tr>
	<tr><td><blockquote>".$listeemails->dsn_message."</blockquote></td></tr>
	<tr><td><blockquote>".$listeemails->dsn_report."</blockquote></td></tr>
	</table>"; 
}
echo $tbaleau_insert ;

	}
/////fin/////		
	
} else {
$total = $wpdb->get_var("
    SELECT COUNT(id)
    FROM ".$table_log_bounces."
");
$comments_per_page = 100;
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
if(isset($_POST["action"])){
if($_POST["action"] == "empty_bounces"){
	$sql = "TRUNCATE ".$table_log_bounces.""; 
	echo '<br><br><h2>'.__("Les NPAI ont bien ete supprimes","e-mailing-service").'</h2>';
    $result = $wpdb->query($wpdb->prepare($sql,true)); 		
}
}
    $tbaleau_insert="<br><form action=\"?page=e-mailing-service/admin/npai.php\" method=\"post\">
	<input name=\"action\" type=\"hidden\" value=\"empty_bounces\" />
	<input name=\"submit\" type=\"submit\" value=\"".__('Vider les bounces','e-mailing-service')."\" />
	</form><br>";

    $tbaleau_insert .= '<table class="widefat">
                         <thead>';
    $tbaleau_insert .= "<tr>";
	$tbaleau_insert .= "<td><blockquote>".__('License NPAI',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Email',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Date email',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Categorie',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Type',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Sujet',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Details',"e-mailing-service")."</blockquote></td>"; 
    $tbaleau_insert .= '</tr>           
        </thead>
        <tbody>';
$listeemail = $wpdb->get_results("SELECT * FROM `".$table_log_bounces."` WHERE email !='' ORDER BY date DESC LIMIT $num,$comments_per_page");
foreach ( $listeemail as $listeemails ) 
{
    $tbaleau_insert .= "<tr>
	<td><blockquote>".$listeemails->idb."</blockquote></td>
	<td><blockquote>".$listeemails->email."</blockquote></td>
	<td><blockquote>".$listeemails->date."</blockquote></td>
	<td><blockquote>".$listeemails->rules_cat."</blockquote></td>
	<td><blockquote>".$listeemails->bounce_type."</blockquote></td>
	<td><blockquote>".$listeemails->subject."</blockquote></td>
	<td><blockquote><a href=\"?page=e-mailing-service/admin/npai.php&section=bounces_fai_details&id=".$listeemails->id."\" title=\"".$listeemails->dsn_message."\" target=\"_blank\">".__('Details','e-mailing-service')."</a></blockquote></td>"; 
    $tbaleau_insert .= '</tr>';
}
$tbaleau_insert .= '</tbody></table>';
echo $tbaleau_insert ;

	}
	
}  
 
   
   ?>
</div>
