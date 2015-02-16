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
<?php _e("Variable pour vos newsletters","e-mailing-service");?>
 </h2>
                </div>
         </div>
                 <section id="content">
            <div class="wrapper">                <section class="columns">                    

        <?php echo "<p>".__("Pour creer des newsletters dynamique, vous devez remplacer dans votre texte les mots par le code (shortcode) ci-dessous","e-mailing-service")."</p>";?>
                    
                    <hr />
                    
                    <div class="grid_8">
     
           <?php
extract($_POST);
if(isset($action)){
	if($action =="update"){
update_user_meta( $user_id, 'news_company', $sm_companyname, '');
update_user_meta( $user_id, 'news_adresse', $sm_companyadresse, '');
update_user_meta( $user_id, 'news_tel', $sm_telephone, '');
update_user_meta( $user_id, 'news_fax', $sm_fax, '');
update_user_meta( $user_id, 'news_facebook', $sm_link_facebook, '');
update_user_meta( $user_id, 'news_google', $sm_link_google, '');
update_user_meta( $user_id, 'news_twitter', $sm_link_twitter, '');
update_user_meta( $user_id, 'news_linkedin', $sm_link_linkedin, '');
update_user_meta( $user_id, 'news_tracking', $sm_tracking);
_e("Vos informations ont bien ete mis a jour","e-mailing-service");
	}

} else {

?>
<h2><?php _e("Variables sur vos informations","e-mailing-service");?></h2>
<form action="admin.php?page=e-mailing-service/admin/variables_user.php" method="post">
<input type="hidden" name="action" value="update" />
<table class="widefat">
                         <thead>
            <tr>
                <th><?php _e('Nom',"e-mailing-service");?></th>
                <th><?php _e('Shortcode',"e-mailing-service");?></th>
                <th><?php _e('Description',"e-mailing-service");?></th>
            </tr>
        </thead>
        <tbody>
<tr>
  <td><?php _e('Votre Nom',"e-mailing-service");?></td>
  <td>[news-societe]</td>
  <td><input type="text" name="sm_companyname"  size="75" value="<?php 
if(get_user_meta( $user_id, 'news_company',true)){
echo get_user_meta( $user_id, 'news_company',true);
} else {
add_user_meta( $user_id, 'news_company', 'My company', false);
echo 'my company';
} ?> "/></td>
</tr>
<tr>
  <td><?php _e('Votre Adresse',"e-mailing-service");?></td><td>[news-adresse]</td>
  <td><input type="text" name="sm_companyadresse" size="75" value="<?php 
if(get_user_meta( $user_id, 'news_adresse')){
echo get_user_meta( $user_id, 'news_adresse',true);
} else {
add_user_meta( $user_id, 'news_adresse', '', false);
}
?> 
" /></td>
</tr>
<tr>
  <td><?php _e('Votre Telephone',"e-mailing-service");?></td><td>[news-tel]</td>
  <td><input type="text" name="sm_telephone" size="75" value="<?php 
if(get_user_meta( $user_id, 'news_tel')){
echo get_user_meta( $user_id, 'news_tel',true);
} else {
add_user_meta( $user_id, 'news_tel', '', false);
}?>  
" /></td>
</tr>
<tr>
  <td><?php _e('Votre Fax',"e-mailing-service");?> </td>
  <td>[news-fax]</td>
  <td><input type="text" name="sm_fax" size="75" value="<?php 
if(get_user_meta( $user_id, 'news_fax')){
echo get_user_meta( $user_id, 'news_fax',true);
} else {
add_user_meta( $user_id, 'news_fax', '', false);
}?> 
" /></td>
</tr>
<tr>
  <td><?php _e('Lien Facebook',"e-mailing-service");?></td>
  <td>[news-link_facebook]</td>
  <td><input type="text" name="sm_link_facebook"  size="75" value="<?php if(get_user_meta( $user_id, 'news_facebook')){
echo get_user_meta( $user_id, 'news_facebook',true);
} else {
add_user_meta( $user_id, 'news_facebook', '', false);
}?> "/></td>
</tr>
<tr>
  <td><?php _e('Lien google',"e-mailing-service");?></td>
  <td>[news-link_google]</td>
  <td><input type="text" name="sm_link_google" size="75" value="<?php if(get_user_meta( $user_id, 'news_google')){
echo get_user_meta( $user_id, 'news_google',true);
} else {
add_user_meta( $user_id, 'news_google', '', false);
} ?> 
" /></td>
</tr>
<tr>
  <td><?php _e('Lien Twitter',"e-mailing-service");?></td>
  <td>[news-link_twitter]</td>
  <td><input type="text" name="sm_link_twitter" size="75" value="<?php if(get_user_meta( $user_id, 'news_twitter')){
echo get_user_meta( $user_id, 'news_twitter',true);
} else {
add_user_meta( $user_id, 'news_twitter', '', false);
} ?> 
" /></td>
</tr>
<tr>
  <td><?php _e('Lien Linkedin',"e-mailing-service");?> </td>
  <td>[news-link_linkedin]</td>
  <td><input type="text" name="sm_link_linkedin" size="75" value="<?php if(get_user_meta( $user_id, 'news_linkedin')){
echo get_user_meta( $user_id, 'news_linkedin',true);
} else {
add_user_meta( $user_id, 'news_linkedin', '', false);
} ?> 
" /></td>
</tr>
<tr>
  <td><?php _e('Code de tracking (google analytics par exemple)',"e-mailing-service");?> </td><td>[news-tracking]</td>
  <td><textarea name="sm_tracking" cols="75" rows="3"><?php if(get_user_meta( $user_id, 'news_tracking')){
echo get_user_meta( $user_id, 'news_tracking',true);
} else {
add_user_meta( $user_id, 'news_tracking', '', false);
} ?></textarea>
 </td>
</tr>
<tr>
  <td></td>
  <td><input name="submit" value="<?php _e('valider la configuration',"e-mailing-service");?>" type="submit" /></td>
</tr>
</tbody>
</table>
</form>
<?php 
}
?>
<h2><?php _e("Variables automatique sur notre plugin","e-mailing-service");?></h2>
    			<table class="widefat">
                         <thead>
            <tr>
                <th><?php _e('Nom',"e-mailing-service");?></th>
                <th><?php _e('Shortcode',"e-mailing-service");?></th>
                <th><?php _e('Description',"e-mailing-service");?></th>
            </tr>
        </thead>
        <tbody>
                  <tr>
                 <td><?php _e('Lien de desinscription',"e-mailing-service");?></td>
                 <td>[lien_desabo]</td>
                 <td><?php _e("affiche le lien de desabonnement exemple : (http://votre_site.com/upd/email_client/id_envoi/ )","e-mailing-service");?></td>
                 </tr>
                 <tr>
                 <td><?php _e('Lien de la newsletter',"e-mailing-service");?></td>
                 <td>[lien_page]</td>
                 <td><?php _e("affiche le Lien de la page de la newsletter en ligne par exemple : (http://votre_site.com/out/email_client/id_page/id_envoi/ )","e-mailing-service");?></td>
                 </tr>
                 <tr>
                 <td><?php _e("Lien d'affiliation","e-mailing-service");?></td>
                 <td>[lien_affiliation]</td>
                 <td><?php _e("affiche le lien de notre affiliation exemple : (http://votre_site.com/upd/email_client/id_envoi/ )","e-mailing-service");?></td>
                 </tr>
                 <tr>
                 <td><?php _e("Titre de l'article ou de la page  sur le template automatique","e-mailing-service");?></td>
                 <td>[link_titre]</td>
                 <td><?php _e("affiche le titre de l'article ou de la page","e-mailing-service");?></td>
                 </tr>
                 <tr>
                 <td><?php _e("Lien de l'article ou de la page sur le template automatique","e-mailing-service");?></td>
                 <td>[link]</td>
                 <td><?php _e("affiche le lien de l'article ou de la page","e-mailing-service");?></td>
                 </tr>
                 </tbody>
                 </table>            

<h2><?php _e("Variables automatique sur votre liste d'envoi","e-mailing-service");?></h2>
<?php
				
				?>
				 <table class="widefat">
                         <thead>
            <tr>
                <th><?php _e('Nom',"e-mailing-service");?></th>
                <th><?php _e('Shortcode',"e-mailing-service");?></th>
                <th><?php _e('Description',"e-mailing-service");?></th>
            </tr>
        </thead>
        <tbody>
                  <tr>
                 <td><?php _e('Email',"e-mailing-service");?></td>
                 <td>[email]</td>
                 <td><?php _e("Email du destinataires","e-mailing-service");?></td>
                 </tr>
                 <tr>
                 <td><?php _e('Nom',"e-mailing-service");?></td>
                 <td>[nom]</td>
                 <td><?php _e("Nom du destinataires","e-mailing-service");?></td>
                 </tr>
                 <tr>
                 <td><?php _e('champs1',"e-mailing-service");?></td>
                 <td>[champs1]</td>
                 <td><?php _e("Affiche le contenu du champs1 de votre liste de desitnataires","e-mailing-service");?></td>
                 </tr>
                  <td><?php _e('champs2',"e-mailing-service");?></td>
                 <td>[champs2]</td>
                 <td><?php _e("Affiche le contenu du champs2 de votre liste de desitnataires","e-mailing-service");?></td>
                 </tr>
                  </tr>
                  <td><?php _e('champs3',"e-mailing-service");?></td>
                 <td>[champs3]</td>
                 <td><?php _e("Affiche le contenu du champs3 de votre liste de desitnataires","e-mailing-service");?></td>
                 </tr>
                 <td><?php _e('champs4',"e-mailing-service");?></td>
                 <td>[champs4]</td>
                 <td><?php _e("Affiche le contenu du champs4 de votre liste de desitnataires","e-mailing-service");?></td>
                 </tr>
                                   <td><?php _e('champs5',"e-mailing-service");?></td>
                 <td>[champs5]</td>
                 <td><?php _e("Affiche le contenu du champs5 de votre liste de desitnataires","e-mailing-service");?></td>
                 </tr>
                                   <td><?php _e('champs6',"e-mailing-service");?></td>
                 <td>[champs6]</td>
                 <td><?php _e("Affiche le contenu du champs6 de votre liste de desitnataires","e-mailing-service");?></td>
                 </tr>
                                   <td><?php _e('champs7',"e-mailing-service");?></td>
                 <td>[champs7]</td>
                 <td><?php _e("Affiche le contenu du champs7 de votre liste de desitnataires","e-mailing-service");?></td>
                 </tr>
                                   <td><?php _e('champs8',"e-mailing-service");?></td>
                 <td>[champs8]</td>
                 <td><?php _e("Affiche le contenu du champs8 de votre liste de desitnataires","e-mailing-service");?></td>
                 </tr>
                 <td><?php _e('champs9',"e-mailing-service");?></td>
                 <td>[champs9]</td>
                 <td><?php _e("Affiche le contenu du champs9 de votre liste de desitnataires","e-mailing-service");?></td>
                </tbody>
                 </table>
                 
 <h2><?php _e("Variables automatique sur liens","e-mailing-service");?></h2>
 <h3> <?php _e("A mettre dans le tracking de vos liens sponsor, ce qui vous permettre de recuperer chez celui-ci les informations","e-mailing-service");?></h3>
    			<table class="widefat">
                         <thead>
            <tr>
                <th><?php _e('Nom',"e-mailing-service");?></th>
                <th><?php _e('Shortcode',"e-mailing-service");?></th>
                <th><?php _e('Description',"e-mailing-service");?></th>
            </tr>
        </thead>
        <tbody>
                  <tr>
                 <td><?php _e('Date',"e-mailing-service");?></td>
                 <td>[date]</td>
                 <td><?php _e("(affiche par exemple : 20131020)","e-mailing-service");?></td>
                 </tr>
                 <tr>
                 <td><?php _e('Serveur',"e-mailing-service");?></td>
                 <td>[serveur]</td>
                 <td><?php _e("Pour ceux qu'utilise plusieurs serveurs SMTP avec nos offres affiche par exemple : srv1270-mx1","e-mailing-service");?></td>
                 </tr>
                 <tr>
                 <td><?php _e('auto',"e-mailing-service");?></td>
                 <td>[auto]</td>
                 <td><?php _e("Affiche (votre serveur)-(id de la campagne)- (id envoie)","e-mailing-service");?></td>
                 </tr>
                                  <tr>
                 <td><?php _e('Identifiant de la newsletter',"e-mailing-service");?></td>
                 <td>[campagne]</td>
                 <td><?php _e("Affiche l'identifiant de la newsletter affiche par exemple : 10","e-mailing-service");?></td>
                 </tr>
                                  <tr>
                 <td><?php _e("Identifiant d'envoi","e-mailing-service");?></td>
                 <td>[hie]</td>
                 <td><?php _e("Affiche l'identifiant d'envoi de votre campagne affiche par exemple : 5","e-mailing-service");?></td>
                 </tr>
                 </tbody>
                 </table>            
</div>
</section>
</div>
</section>