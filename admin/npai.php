<?php
include(smPATH . '/include/entete.php');

if(cgi_bounces() == 'non'){
echo "<br><br>";
_e("Vous n'avez pas souscrit a l'option qui vous permet de recuperer les bounces","e-mailing-service");

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
    $tbaleau_insert="";
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
$listeemail = $wpdb->get_results("SELECT * FROM `".$table_log_bounces."` ORDER BY date DESC LIMIT $num,$comments_per_page");
foreach ( $listeemail as $listeemails ) 
{
    $tbaleau_insert .= "<tr>
	<td><blockquote>".$listeemails->idb."</blockquote></td>
	<td><blockquote>".$listeemails->email."</blockquote></td>
	<td><blockquote>".$listeemails->date."</blockquote></td>
	<td><blockquote>".$listeemails->rules_cat."</blockquote></td>
	<td><blockquote>".$listeemails->bounce_type."</blockquote></td>
	<td><blockquote>".$listeemails->subject."</blockquote></td>
	<td><blockquote>".$listeemails->diag_code."</blockquote></td>"; 
    $tbaleau_insert .= '</tr>';
}
$tbaleau_insert .= '</tbody></table>';
echo $tbaleau_insert ;

	}
?>