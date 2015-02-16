 <div id="wrapper">
        <header id="page-header">
             <div class="wrapper">
<?php 
if ( is_plugin_active( 'admin-hosting/admin-hosting.php' ) ) {
	include(AH_PATH . '/include/entete.php');
} else {
	include(smPATH . '/include/entete.php');
}
extract($_POST);
extract($_GET);
?>
                </div>
        </header>
</div>
             <div id="page-subheader">
                <div class="wrapper">
 <h2>
<?php _e("Envoyer votre newsletter","e-mailing-service");?>
 </h2>
                </div>
         </div>
                 <section id="content">
            <div class="wrapper">                <section class="columns">                    

        <?php echo "<p>".__("Programmer l'heure et la date d'envoi de votre newsletter","e-mailing-service")."</p>";?>
                    
                    <hr />
                    
                    <div class="grid_8"><?php
if(cgi_bounces() == 'non'){
echo "<br><br>";
_e("Vous n\'avez pas souscrit a l'option qui vous permet de recuperer les bounces","e-mailing-service");

} else {
echo '<br><br>';
$total = $wpdb->get_var("
    SELECT COUNT(id)
    FROM ".$table_blacklist."
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
	$tbaleau_insert .= "<td><blockquote>".__('IP',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Type',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Blacklist',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Lien pour se desinscrire',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Details',"e-mailing-service")."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".__('Date de mise a jour',"e-mailing-service")."</blockquote></td>";
    $tbaleau_insert .= '</tr>           
        </thead>
        <tbody>';
$listeemail = $wpdb->get_results("SELECT * FROM `".$table_blacklist."`  ORDER BY date DESC, ip DESC  LIMIT $num,$comments_per_page ");
foreach ( $listeemail as $listeemails ) 
{
    
	$tbaleau_insert .= "<tr>
	<td><blockquote>".$listeemails->ip."</blockquote></td>
	<td><blockquote>".$listeemails->type."</blockquote></td>
	<td><blockquote>".$listeemails->lien."</blockquote></td>";
	if($listeemails->delist!=''){
	$tbaleau_insert .= "<td><blockquote><a href=\"".$listeemails->delist."\" target=\"_blank\">".__("Delister","e-mailing-service")."</a></blockquote></td>";
	} else {
	$tbaleau_insert .= "<td></td>";	
	}
	$tbaleau_insert .= "<td><blockquote>".$listeemails->details."</blockquote></td>";
	$tbaleau_insert .= "<td><blockquote>".$listeemails->date."</blockquote></td>";
    $tbaleau_insert .= '</tr>';
}
$tbaleau_insert .= '</tbody></table>';
echo $tbaleau_insert ;
	}
?>