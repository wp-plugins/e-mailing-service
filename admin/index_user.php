<?php 
include(smPATH . '/include/entete.php');
if(isset($_GET["action"])){
if($_GET["action"] == "update"){
update_user_meta( $user_id, 'sm_lg', $_GET["sm_lg"], '');	
}
}
if(!isset($_GET["sm_lg"])){
$img_lg =get_user_meta( $user_id, 'sm_lg',true);
} else {
$img_lg=$_GET["sm_lg"];	
}
if($img_lg == "fr"){
$sm_image ="Flat-Design-Pricing-Tables-2_fr.jpg";
$sm_lg_rep="/";	
}
elseif($img_lg == "it"){
$sm_image ="Flat-Design-Pricing-Tables-2_it.jpg";
$sm_lg_rep="/it/";			
}
elseif($img_lg == "de"){
$sm_image ="Flat-Design-Pricing-Tables-2_de.jpg";
$sm_lg_rep="/de/";			
}
elseif($img_lg == "pt"){
$sm_image ="Flat-Design-Pricing-Tables-2_pt.jpg";
$sm_lg_rep="/pt/";			
}
elseif($img_lg == "es"){
$sm_image ="Flat-Design-Pricing-Tables-2_es.jpg";
$sm_lg_rep="/es/";			
}
else{
$sm_image ="Flat-Design-Pricing-Tables-2_en.jpg";
$sm_lg_rep="/en/";			
}
echo $sm_lg_rep;
?>
<table><tr>
  <td><a href="?page=e-mailing-service/admin/index_user.php&sm_lg=fr&action=update"><img src="<?php echo smURL;?>/img/France.png" width="48" height="48" border="0"/></a></td>
  <td><a href="?page=e-mailing-service/admin/index_user.php&sm_lg=de&action=update"><img src="<?php echo smURL;?>/img/Germany.png" width="48" height="48" border="0"/></a></td>
  <td><a href="?page=e-mailing-service/admin/index_user.php&sm_lg=it&action=update"><img src="<?php echo smURL;?>/img/Italy.png" width="48" height="48" border="0"/></a></td>
  <td><a href="?page=e-mailing-service/admin/index_user.php&sm_lg=pt&action=update"><img src="<?php echo smURL;?>/img/Portugal.png" width="48" height="48" border="0"/></a></td>
  <td><a href="?page=e-mailing-service/admin/index_user.php&sm_lg=es&action=update"><img src="<?php echo smURL;?>/img/Spain.png" width="48" height="48" border="0"/></a></td>
  <td><a href="?page=e-mailing-service/admin/index_user.php&sm_lg=en&action=update"><img src="<?php echo smURL;?>/img/us.png" width="48" height="48" border="0"/></a></td>
  </tr></table>
