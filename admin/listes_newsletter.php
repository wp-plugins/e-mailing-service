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
<?php _e("Newsletter list","e-mailing-service");?>
 </h2>
                </div>
         </div>
                 <section id="content">
            <div class="wrapper">                <section class="columns">                    

        <?php echo "<p>".__("List des newsletters, vous pouvez envoyer plusieurs fois la meme newsletter","e-mailing-service")."</p>";?>
                    
                    <hr />
                    
                    <div class="grid_8">
     
<?php
if(isset($action)){

	if($action =="update"){
	}
	elseif($action =="add"){
	}
} else {
$tab ='<table class="paginate50 sortable full">
<thead>
<tr>
<th>'.__('ID','e-mailing-service').'</th>
<th>'.__('Title','e-mailing-service').'</th>
<th>'.__('Date','e-mailing-service').'</th>';
if($user_role=='administrator'){
$tab .='<th>'.__('User','e-mailing-service').'</th>';
}
$tab .='<th>'.__('Action','e-mailing-service').'</th>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
</tr>
</thead>
';
if($user_role=='administrator'){
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."posts` WHERE post_status='publish' AND post_type='newsletter' ORDER bY id DESC LIMIT 500");
} else {
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."posts` WHERE post_author='".$user_id."' AND post_status='publish'AND post_type='newsletter'  ORDER bY id DESC LIMIT 200");	
}
foreach ( $fivesdrafts as $fivesdraft ) 
{
$tab .='<tr>
<td>'.$fivesdraft->ID.'</td>
<td>'.stripslashes($fivesdraft->post_title).'</td>
<td>'.$fivesdraft->post_date.' </td>';
if($user_role=='administrator'){
$tab .='<td>'.get_login($fivesdraft->post_author).'</td>';
}
$tab .='<td>
<a href="'.get_site_url().'/?post_type=newsletter&p='.$fivesdraft->ID.'" target="_blank"><img src="'.smURL.'img/search.png" width="32" height="32" border="0" title="'.__("view","e-mailing-service").'"/></a>
</td>
<td>
<a href="post.php?post='.$fivesdraft->ID.'&action=edit" target="_parent"><img src="'.smURL.'img/wordpress.png" width="32" height="32" border="0" title="'.__("Edit whith wordpress editor","e-mailing-service").'"/></a>
</td>
<td>
<a href="?page=e-mailing-service/admin/editor.php&action=edit&id='.$fivesdraft->ID.'" target="_parent">
<img src="'.smURL.'img/doc_edit.png" width="32" height="32" border="0" title="'.__("edit wift elrte editor","e-mailing-service").'"/></a>
</td>
<td>
<a href="?page=e-mailing-service/admin/send_user.php&newsletter='.$fivesdraft->ID.'" target="_parent"><img src="'.smURL.'img/send_mail.png" width="32" height="32" border="0" title="'.__("Send newsletter","e-mailing-service").'" /></a>
</td>
<td>
<a href="?page=e-mailing-service/admin/stats_user.php&section=detail&id='.$fivesdraft->ID.'" target="_parent">
<img src="'.smURL.'img/pie_chart.png" width="32" height="32" border="0" title="'.__("statistic","e-mailing-service").'"/></a>
</td>

</tr>
';
}
$tab .='</table>'; 

echo $tab;
}
?>
</div>
</section>
</div>
</section>
