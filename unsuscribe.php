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

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php 
			  
  global $wp_query;
  $smhie= $wp_query->query_vars['smhie'];
  $smemail= $wp_query->query_vars['smemail'];
  $smfree= $wp_query->query_vars['smfree'];
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
  echo '<br>
  <form action="'.get_option('siteurl').'/upd/'.$smemail.'/'.$smhie.'/'.$smcle.'/" method="post">
                    <input name="email" type="hidden" value="'.$email.'">
					<input name="email_id" type="hidden" value="'.$email_id.'">
					<input name="smcle" type="hidden" value="'.$smcle.'">
					<input name="smhie" type="hidden" value="'.$smhie.'">
					<input name="action" type="hidden" value="update_desinscrit">
					<pre>'.get_option('sm_udp_details').'</pre><br>
					  <table width="200" border"0">
				<tr><td><label><input type="radio" name="valide" value="oui"  checked>'.__('oui').'</label></td></tr>
				<tr><td><label><input type="radio" name="valide" value="non">'.__('non').'</label></td></tr>
				<tr><td><input name="sumit" type="submit" value="'.get_option('sm_udp_bouton').'"></td></tr>
				      </table>					  
					</form><br><br>'; 
					
		}
		?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
