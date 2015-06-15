<div id="wrapper">
        <header id="page-header">
             <div class="wrapper">
               <?php 
if ( is_plugin_active( 'admin-hosting/admin-hosting.php' ) ) {
	include(AH_PATH . '/include/entete.php');
} else {
	include(smPATH . '/include/entete.php');
}?>
                          <div id="main-nav">
                    <ul class="clearfix">    
                    <?php
if(!isset($_GET['section'])){
$active_page='npai';
}	else {
$active_page=$_GET['section'];	
}
						
					?> 
<li <?php if($active_page=="npai"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/npai.php&section=npai"><?php _e('Liste des NPAI','admin-hosting');?></a></li>       
<li <?php if($active_page=="bounces_fai"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/npai.php&section=bounces_fai"><?php _e('Reponses FAI','admin-hosting');?></a></li>
<li <?php if($active_page=="hard_bounces"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/npai.php&section=hard_bounces"><?php _e("Hard Bounces ",'admin-hosting');?></a></li>
<li <?php if($active_page=="bounces_import"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/npai.php&section=bounces_import"><?php _e("Importer NPAI",'admin-hosting');?></a></li>
<li <?php if($active_page=="bounces_update"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/npai.php&section=bounces_update"><?php _e("Retirer des listes les Hard bounces non traites",'admin-hosting');?></a></li>
<li <?php if($active_page=="bounces_update_reset"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/npai.php&section=bounces_update_reset"><?php _e("Verifier les Hard bounces deja traites",'admin-hosting');?></a></li>	
                    </ul>
                </div>
             </div>
             

                  <!--  <input placeholder="Search..." type="text" name="q" value="" />-->
              
             <div id="page-subheader">
                <div class="wrapper">
 <h2>
<?php _e("NPAI","e-mailing-service");?>

 </h2>
   </div>
         </div>
        </header>

                 <section id="content">
            <div class="wrapper">                                   

        <?php 
   if(isset($_REQUEST['section'])){
		if ($_REQUEST['section'] == 'npai')	{ echo "<p>".__("Liste des emails retour, permet de comprendre la raison quand un email n'est pas arrive chez votre contact","e-mailing-service")."</p>";}
		if ($_REQUEST['section'] == 'bounces_fai') { echo "<p>".__("Information ISP","e-mailing-service")."</p>"; }
		if ($_REQUEST['section'] == 'hard_bounces'){  echo "<p>".__("Email invalide, ils sont desactivés de vos listes de contact automatiquement","e-mailing-service")."</p>"; }
		if ($_REQUEST['section'] == 'bounces_import') { echo "<p>".__("Lancer le cron d'importation des emails invalide manuellement","e-mailing-service")."</p>";}
		if ($_REQUEST['section'] == 'bounces_update') { echo "<p>".__("Mettre à jour vos listes manuellement","e-mailing-service")."</p>"; }
		if ($_REQUEST['section'] == 'bounces_update_reset') { echo "<p>".__("Verifier si vos listes ne contiennent pas des hard bounces deja traite","e-mailing-service")."</p>"; }
	} else {
	echo "<p>".__("Email retour indiquant d'eventuel probleme de delivrabilite","e-mailing-service")."</p>";
	}
		
?>
        
                    
                    <hr />             

                    
                    <div class="grid_8"><?php
if(cgi_bounces() == 'non'){
echo "<br><br>";
_e("Vous n'avez pas souscrit a l'option qui vous permet de recuperer les bounces","e-mailing-service");

} else {


 if(isset($_REQUEST['section'])){
	
		if ($_REQUEST['section'] == 'bounces_import') sm_cron_bounce_update();
		if ($_REQUEST['section'] == 'bounces_update') sm_cron_bounce_update_liste();
		if ($_REQUEST['section'] == 'bounces_update_reset') { $action="reset"; sm_cron_bounce_update_liste();}

		
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
			$tbaleau_insert="";
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
    $result = $wpdb->query($sql); 		
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
</div></div>
</section>
</div></section>
