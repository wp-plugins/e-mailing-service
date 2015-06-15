<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); 
global $wpbd;
?>



			<?php 
			  
  global $wp_query;
  $smhie= $wp_query->query_vars['smhie'];
  $smemail= $wp_query->query_vars['smemail'];
  if(isset($wp_query->query_vars['smfree'])){
  $smfree= $wp_query->query_vars['smfree'];
  } else { $smfree=0; }
  $smcle= $wp_query->query_vars['smcle'];
  $smemail=str_replace('%5BZ%5D','@',$smemail);
  $smemail=str_replace('[Z]','@',$smemail);
  if($smfree=='1'){
    $email=affiche_mail($smhie,$smemail);
  } else {
	$email_id = $_SESSION["sm_emailid"];
	$smhie = $_SESSION["sm_hie"];
	$smcle = $_SESSION["sm_cle"];
	$email = affiche_mail($smhie,$email_id); 
	$smemail=$email_id;
  }
  if(isset($_POST["action"])){
  if($_POST["action"] == "update_desinscrit"){
  if($_POST["valide"]=="oui"){
  if($_POST["smcle"] == ' '){
  update_inscrit($_POST["smhie"],$_POST["email"],$_POST["email_id"]);
  } else {
  update_inscrit($_POST["smhie"],$_POST["email"],$_POST["email_id"],$_POST["smcle"]);	  
  }
  echo get_option('sm_udp_merci');
  } 
  } 
  } else {

 echo '<center><br><p>'.get_option('sm_udp_details').'</p>
  <form action="'.get_option('siteurl').'/upd/'.$wp_query->query_vars['smemail'].'/'.$wp_query->query_vars['smhie'].'/'.$wp_query->query_vars['smemail'].'/" method="post">
                    <input name="email" type="hidden" value="'.$wp_query->query_vars['smemail'].'">
					<input name="email_id" type="hidden" value="'.$wp_query->query_vars['smemail'].'">
					<input name="smcle" type="hidden" value="'.$wp_query->query_vars['smcle'].'">
					<input name="smhie" type="hidden" value="'.$wp_query->query_vars['smhie'].'">
					<input name="action" type="hidden" value="update_desinscrit">
					<label><input type="radio" name="valide" value="oui"  checked>'.__('oui').'</label><label>
					<input type="radio" name="valide" value="non">'.__('non').'</label>
				    <input name="sumit" type="submit" value="'.__("Oui je souhaite me desinscrire","admin-hsoting").'">
					</form><br><br></center>'; 
  }
  
		?>



<?php get_footer(); ?>
