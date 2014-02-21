<?php include(smPATH . '/include/entete.php');
extract($_POST);
extract($_GET);
    if(isset($action)){
	if($action =="update_mail"){
      if(!isset($champs1)){ $champs1=""; }
	  if(!isset($champs2)){ $champs2=""; }
	  if(!isset($champs3)){ $champs3=""; }
	  if(!isset($champs4)){ $champs4=""; }
	  if(!isset($champs5)){ $champs5=""; }
	  if(!isset($champs6)){ $champs6=""; }
	  if(!isset($champs7)){ $champs7=""; }
	  if(!isset($champs8)){ $champs8=""; }
	  if(!isset($champs9)){ $champs9=""; }
       $wpdb->update($liste, array(  
            'email' => $email,  
            'nom' => $nom,
			'champs1' => $champs1,
			'champs2' => $champs2,
			'champs3' => $champs3,
			'champs4' => $champs4,
			'champs5' => $champs5,
			'champs6' => $champs6,
			'champs7' => $champs7,
			'champs8' => $champs8,
			'champs9' => $champs9,
			'valide'  => $valide,
            'bounces' => $bounces),
	       array( 'id' => $emailid ));		  
	 echo "<br><br><div class=\"alert\"><h2>".__("L'email $email a bien ete modifie","e-mailing-service")."</h2></div><br>"; 
	 echo '<meta http-equiv="refresh" content="1; url=admin.php?page=e-mailing-service/admin/emails.php&liste='.$liste.'">';	 
    }
	elseif($action=="update"){
echo '<h2>'.__("Modifier l'email","e-mailing-service").'</h2>';
echo '<form action="admin.php?page=e-mailing-service/admin/emails.php&liste='.$liste.'" name="form_bdd" id="form_bdd" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="update_mail">
<input type="hidden" name="emailid" value="'.$emailid.'">';
$tbaleau_insert ='<table class="widefat">
                         <thead><tr>';
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_liste."` WHERE liste_bd ='".$liste."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{

}
$tbaleau_insert .="</tr><tdbody>";
$listeemail = $wpdb->get_results("SELECT * FROM `".$liste."` WHERE id='".$emailid."'");
foreach ( $listeemail as $listeemails ) 
{
    $tbaleau_insert .= "<tr>";
	$tbaleau_insert .="<td><blockquote>".__("Email","e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="<td><blockquote><input name=\"email\" type=\"text\" value=\"".$listeemails->email."\"/></blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
 $tbaleau_insert .="<td><blockquote>".__("Nom","e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="<td><blockquote><input name=\"nom\" type=\"text\"  value=\"".$listeemails->nom."\"/></blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
 	if($fivesdraft->champs1 !=''){
$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs1."</blockquote></td>";
$tbaleau_insert .="<td><blockquote><input name=\"champs1\" type=\"text\"  value=\"".$listeemails->champs1."\"/></blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
	}
	if($fivesdraft->champs2 !=''){
		$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs2."</blockquote></td>";
$tbaleau_insert .="<td><blockquote><input name=\"champs2\" type=\"text\" value=\"".$listeemails->champs2."\"/></blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
	}if($fivesdraft->champs3 !=''){
		$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs3."</blockquote></td>";
$tbaleau_insert .="<td><blockquote><input name=\"champs3\" type=\"text\" value=\"".$listeemails->champs3."\"/></blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
}if($fivesdraft->champs4 !=''){
	$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs4."</blockquote></td>";
$tbaleau_insert .="<td><blockquote><input name=\"champs4\" type=\"text\" value=\"".$listeemails->champs4."\"/></blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
}if($fivesdraft->champs5 !=''){
	$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs5."</blockquote></td>";
$tbaleau_insert .="<td><blockquote><input name=\"champs5\" type=\"text\" value=\"".$listeemails->champs5."\"/></blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
}if($fivesdraft->champs6 !=''){
	$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs6."</blockquote></td>";
$tbaleau_insert .="<td><blockquote><input name=\"champs6\" type=\"text\" value=\"".$listeemails->champs6."\"/></blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
}if($fivesdraft->champs7 !=''){
	$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs7."</blockquote></td>";
$tbaleau_insert .="<td><blockquote><input name=\"champs7\" type=\"text\" value=\"".$listeemails->champs7."\"/></blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
}if($fivesdraft->champs8 !=''){
	$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs8."</blockquote></td>";
$tbaleau_insert .="<td><blockquote><input name=\"champs8\" type=\"text\" value=\"".$listeemails->champs8."\"/></blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
}if($fivesdraft->champs9 !=''){
	$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs9."</blockquote></td>";
$tbaleau_insert .="<td><blockquote><input name=\"champs9\" type=\"text\" value=\"".$listeemails->champs9."\"/></blockquote></td>";
 $tbaleau_insert .= '</tr>';
}
 $tbaleau_insert .= '<tr><td><blockquote>'.__("Inscrit","e-mailing-service").' ? </blockquote></td><td><blockquote><select name="valide">';
if($listeemails->valide =='1'){ 
$tbaleau_insert .='
  <option value="0">'.__("Desinscrit").'</option>
  <option value="1"  selected="selected">'.__("Actif","e-mailing-service").'</option>
</select></blockquote></td></tr>'; } else { 
$tbaleau_insert .='
  <option value="0" selected="selected">'.__("Desinscrit","e-mailing-service").'</option>
  <option value="1">'.__("Actif").'</option>
</select></blockquote></td></tr>'; }
 }
 $tbaleau_insert .= '<tr><td><blockquote>'.__("Valide","e-mailing-service").' ? </blockquote></td><td><blockquote><select name="bounces">';
if($listeemails->bounces =='1'){ 
$tbaleau_insert .='
  <option value="0">'.__("Invalide").'</option>
  <option value="1"  selected="selected">'.__("Valide","e-mailing-service").'</option>
</select></blockquote></td></tr>'; } else { 
$tbaleau_insert .='
  <option value="0" selected="selected">'.__("Invalide","e-mailing-service").'</option>
  <option value="1">'.__("Valide","e-mailing-service").'</option>
</select></blockquote></td></tr>'; }

 
$tbaleau_insert .="
<tr>
<td><blockquote><input type=\"submit\" value=\"".__('modifier',"e-mailing-service")."\" class=\"form-submit\"></blockquote></td>
<td><blockquote></blockquote></td>
</tr>
</tdbody></table>
</form>
";		
echo $tbaleau_insert;
	   }
	   	elseif($action=="fiche"){
echo '<h2>'.__("Fiche client","e-mailing-service").'</h2>';
echo '<form action="admin.php?page=e-mailing-service/admin/emails.php&liste='.$liste.'" name="form_bdd" id="form_bdd" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="update_mail">
<input type="hidden" name="emailid" value="'.$emailid.'">';
$tbaleau_insert ='<table class="widefat">
                         <thead><tr>';
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_liste."` WHERE liste_bd ='".$liste."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{

}
$tbaleau_insert .="</tr><tdbody>";
$listeemail = $wpdb->get_results("SELECT * FROM `".$liste."` WHERE id='".$emailid."'");
foreach ( $listeemail as $listeemails ) 
{
	$tbaleau_insert .= "<tr><td><img src=\"".smURL."/img/profile.png\" width=\"64\" height=\"64\" border=\"0\" title=\"".__("Voir la fiche complete","e-mailing-service")."\"/></td><td></td></tr>";
	$tbaleau_insert .="<tr><td><blockquote>".__("Email","e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$listeemails->email."</blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
 $tbaleau_insert .="<td><blockquote>".__("Nom","e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$listeemails->nom."</blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
 $tbaleau_insert .="<td><blockquote>".__("Date Inscription","e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$listeemails->date_creation."</blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
 $tbaleau_insert .="<td><blockquote>".__("IP","e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$listeemails->ip."</blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
 $tbaleau_insert .="<td><blockquote>".__("Langue","e-mailing-service")."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$listeemails->lg."</blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
 	if($fivesdraft->champs1 !=''){
$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs1."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$listeemails->champs1."</blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
	}
	if($fivesdraft->champs2 !=''){
		$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs2."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$listeemails->champs2."</blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
	}if($fivesdraft->champs3 !=''){
		$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs3."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$listeemails->champs3."</blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
}if($fivesdraft->champs4 !=''){
	$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs4."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$listeemails->champs4."</blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
}if($fivesdraft->champs5 !=''){
	$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs5."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$listeemails->champs5."</blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
}if($fivesdraft->champs6 !=''){
	$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs6."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$listeemails->champs6."</blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
}if($fivesdraft->champs7 !=''){
	$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs7."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$listeemails->champs7."</blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
}if($fivesdraft->champs8 !=''){
	$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs8."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$listeemails->champs8."</blockquote></td>";
 $tbaleau_insert .= "</tr><tr>";
}if($fivesdraft->champs9 !=''){
	$tbaleau_insert .="<td><blockquote>".$fivesdraft->champs9."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$listeemails->champs9."</blockquote></td>";
 $tbaleau_insert .= '</tr>';
}
 }
$tbaleau_insert .="
</tdbody></table>
</form>
";		
echo $tbaleau_insert;
	   }
	   elseif($action=="delete"){
		   
		   echo "<br><br><h2>".__("Supprimer l'email","e-mailing-service")."</h2>";  	
	echo '<form action="admin.php?page=e-mailing-service/admin/emails.php&liste='.$liste.'" method="post" target="_parent">
	<input type="hidden" name="liste" value="'.$liste.'" />
	<input type="hidden" name="emailid" value="'.$emailid.'" />
<input type="hidden" name="action" value="valide_delete" />
<p>'.__("Voulez vous vraiment supprimer l'email ?").'
  <label>
    <input type="radio" name="val_trunc" value="oui" id="val_trunc_0" />'.__("oui","e-mailing-service").'</label>
  <label>
    <input type="radio" name="val_trunc" value="non" id="val_trunc_1" checked/>'.__("non","e-mailing-service").'</label>
  <br />
</p><input value="'.__("Supprimer").'" type="submit" />
</fom>';

	   }
	   elseif($action=="valide_delete"){
		   if($val_trunc=="oui"){
	         $sql ="DELETE FROM $liste WHERE id = '$emailid'";
             echo '<br><br><h2>'.__("Votre email a bien ete supprime","e-mailing-service").'</h2>';
             $result = $wpdb->query($wpdb->prepare($sql,true)); 	
			 echo '<meta http-equiv="refresh" content="1; url=admin.php?page=e-mailing-service/admin/emails.php&liste='.$liste.'">';	
	        } else {
	         echo '<meta http-equiv="refresh" content="0; url=admin.php?page=e-mailing-service/admin/emails.php&liste='.$liste.'">';	
	         }    
	   }
	} 
	else {
echo "<br><h1>".__("Liste de vos emails","e-mailing-service")."</h1>";
if(!isset($liste)){
$liste=$wpdb->prefix.'sm_liste_test'; 
}
$total = $wpdb->get_var("
    SELECT COUNT(id)
    FROM ".$liste."
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
$tbaleau_insert ='<table class="widefat">
                         <thead><tr>';
$tbaleau_insert .="<th><blockquote>".__("ID","e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__("Email","e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__("Date inscription","e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__("Nom","e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__("Fiche","e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__("Opt-in","e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__("Inscrit","e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__("Valide","e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__("Action","e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote></blockquote></th>";
$tbaleau_insert .="</tr> </thead>
        <tbody>";
	


$listeemail = $wpdb->get_results("SELECT * FROM `".$liste."` ORDER BY id DESC LIMIT $num,$comments_per_page");
foreach ( $listeemail as $listeemails ) 
{
    $tbaleau_insert .= "<tr>
	<td><blockquote>".$listeemails->id."</blockquote></td>
	<td><blockquote>".$listeemails->email."</blockquote></td>
	<td><blockquote>".$listeemails->date_creation."</blockquote></td>
	<td><blockquote>".$listeemails->nom."</blockquote></td>
	 <td><blockquote><a href=\"?page=e-mailing-service/admin/emails.php&liste=".$liste."&emailid=".$listeemails->id."&action=fiche\" target=\"_parent\">
	 <img src=\"".smURL."/img/profile.png\" width=\"32\" height=\"32\" border=\"0\" title=\"".__("Voir la fiche complete","e-mailing-service")."\"/></a></blockquote></td>";
if($listeemails->optin =='1'){ $tbaleau_insert .="<td><blockquote> <img src=\"".smURL."/img/ok.png\" width=\"32\" height=\"32\" border=\"0\" title=\"".__("Opt-in","e-mailing-service")."\"/></blockquote></td>"; } else { $tbaleau_insert .="<td>
<blockquote><img src=\"".smURL."/img/x.png\" width=\"32\" height=\"32\" border=\"0\" title=\"".__("Non opt-in","e-mailing-service")."\"/></blockquote></td>"; }
if($listeemails->valide =='1'){ $tbaleau_insert .="<td><blockquote> <img src=\"".smURL."/img/ok.png\" width=\"32\" height=\"32\" border=\"0\" title=\"".__("Actif","e-mailing-service")."\"/></blockquote></td>"; } else { $tbaleau_insert .="<td>
<blockquote><img src=\"".smURL."/img/x.png\" width=\"32\" height=\"32\" border=\"0\" title=\"".__("Desinscrit","e-mailing-service")."\"/></blockquote></td>"; }
if($listeemails->bounces =='1'){ $tbaleau_insert .="<td><blockquote> <img src=\"".smURL."/img/ok.png\" width=\"32\" height=\"32\" border=\"0\" title=\"".__("valide","e-mailing-service")."\"/></blockquote></td></blockquote></td>"; } else { $tbaleau_insert .="<td>
<blockquote><img src=\"".smURL."/img/x.png\" width=\"32\" height=\"32\" border=\"0\" title=\"".__("Invalide","e-mailing-service")."\"/></blockquote></td>"; }
$tbaleau_insert .= '
	 <td><blockquote><a href="admin.php?page=e-mailing-service/admin/emails.php&liste='.$liste.'&emailid='.$listeemails->id.'&action=update" target="_parent">
	 <img src="'.smURL.'/img/pencil.png" width="32" height="32" border="0" title="'.__("Modifier","e-mailing-service").'"/></a></blockquote></td>
	 <td><blockquote><a href="admin.php?page=e-mailing-service/admin/emails.php&liste='.$liste.'&emailid='.$listeemails->id.'&action=delete" target="_parent">
	 <img src="'.smURL.'/img/poubelle.png" width="32" height="32" border="0" title="'.__("Supprimer","e-mailing-service").'"/></a></blockquote></td>
</tr>';
}
$tbaleau_insert .= '</tbody></table>';
echo $tbaleau_insert ;
	}
?>