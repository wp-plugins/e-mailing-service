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
<?php _e("E-mailing service","e-mailing-service");?>
 </h2>
                </div>
         </div>
                 <section id="content">
            <div class="wrapper">                <section class="columns">                    

        <?php echo "<p>".__("Guide pour bien demarrer","e-mailing-service")."</p>";?>
                    
                    <hr />
                    
                    
                    
<div class="systeme_onglets">
        <div class="onglets">
            <span class="onglet_0 onglet" id="onglet_snapshot" onclick="javascript:change_onglet('snapshot');"><?php echo __('Demarrage','e-mailing-service'); ?></span>
            <span class="onglet_0 onglet" id="onglet_solde" onclick="javascript:change_onglet('solde');">1.<?php echo __('Configurer le plugin','e-mailing-service'); ?></span>
            <span class="onglet_0 onglet" id="onglet_contact" onclick="javascript:change_onglet('contact');">2.<?php echo __('Creer votre liste de contact','e-mailing-service'); ?></span>
            <span class="onglet_0 onglet" id="onglet_emails" onclick="javascript:change_onglet('emails');">3.<?php echo __('Ajouter vos contacts','e-mailing-service'); ?></span>
            <span class="onglet_0 onglet" id="onglet_newsletter" onclick="javascript:change_onglet('newsletter');">4.<?php echo __('Creer votre newsletter','e-mailing-service'); ?></span>
             <span class="onglet_0 onglet" id="onglet_send" onclick="javascript:change_onglet('send');">5.<?php echo __('Envoyer votre newsletter','e-mailing-service'); ?></span>
                  <span class="onglet_0 onglet" id="onglet_suivis" onclick="javascript:change_onglet('suivis');">6.<?php echo __('Suivis des campagnes','e-mailing-service'); ?></span>
                       <span class="onglet_0 onglet" id="onglet_stats" onclick="javascript:change_onglet('stats');">7.<?php echo __('Analyse des statistiques','e-mailing-service'); ?></span>
        </div>
        <div class="contenu_onglets">
            <div class="contenu_onglet" id="contenu_onglet_snapshot">
                <h1><?php echo __('Les differentes etapes a effectuer pour envoyer votre newsletter','e-mailing-service'); ?></h1>

              <ol>
              <li><?php echo ''.__('Configurer le plugin avec vos informations SMTP','e-mailing-service').' ( '.__('menu','e-mailing-service').'  <a href="?page=e-mailing-service/admin/setting.php">'.__('Setting', 'e-mailing-service').'</a> )';?> </li>
          <li><?php echo ''.__('Creer votre liste de contact','e-mailing-service').' ( '.__('menu','e-mailing-service').'  <a href="?page=e-mailing-service/admin/listes.php">'.__('Destinataires', 'e-mailing-service').'</a> )';?> </li>
         <li><?php echo ''.__('Ajouter vos contacts','e-mailing-service').' ( '.__('menu','e-mailing-service').'  <a href="?page=e-mailing-service/admin/listes.php">'.__('Destinataires', 'e-mailing-service').'</a> )';?> </li>
         <li><?php echo ''.__('Creer votre newsletter','e-mailing-service').' ( '.__('menu','e-mailing-service').'  <a href="?page=e-mailing-service/admin/create.php">'.__('Assistant Creation', 'e-mailing-service').'</a> )';?> </li>
      <li><?php echo ''.__('Envoyer votre newsletter','e-mailing-service').' ( '.__('menu','e-mailing-service').'  <a href="?page=e-mailing-service/admin/send_user.php">'.__('Envois Newsletter', 'e-mailing-service').'</a> )';?> </li>
     <li><?php echo ''.__("Suivre l'avancement de vos envois",'e-mailing-service').' ( '.__('menu','e-mailing-service').'  <a href="?page=e-mailing-service/admin/send_user.php">'.__('Suivis des campagnes', 'e-mailing-service').'</a> )';?> </li>
     <li><?php echo ''.__("Analyser les resultats de votre campagne",'e-mailing-service').' ( '.__('menu','e-mailing-service').'  <a href="?page=e-mailing-service/admin/listes_newsletter.php">'.__('Liste Newsetter', 'e-mailing-service').'</a> )';?> </li>
              </ol>
              <p>&nbsp;</p>
            </div>
            <div class="contenu_onglet" id="contenu_onglet_solde">
                <h1><?php echo __('Configurer le plugin','e-mailing-service'); ?></h1>
<?php

echo ''.__("Avez vous un serveur SMTP ?","e-mailing-service").' : ';
echo '<ul><li>'.__("Si vous n'avez pas de serveur SMTP, vous pouvez choisir une formule parmis nos offres","e-mailing-service").' (<a href="http://www.e-mailing-service.net/options/">'.__('voir les offres SMTP','e-mailing-service').'</a>)<br>';
echo ''.__("Dans ce cas la configuration du plugin avec notre service SMTP est automatique aprés paiement, aucune connaissance n'est necessaire","e-mailing-service").'<br>';
echo ''.__("Nos formules sont conseilles pour eviter de faire blacklisté votre site","e-mailing-service").'<br> </li></ul>';
_e("Si vous possedez deja un serveur SMTP, vous devez donc renseigner le formulaire et donc possedez les informations necessaires (serveur, email, port, login et mot de passe)","e-mailing-service");
echo '<br>';
echo '<br>';
_e("Pour les options, ce que vous devez savoir :","e-mailing-service");
echo '<br>';
echo '<br>';
_e("Affichage texte en haut , texte de desabonnement et affiliation servent a parametrer les informations importante de votre newsletter , sans avoir a toujours les indiquer sur votre template","e-mailing-service");
echo '<br>';
_e("Attention a la variable [lien_desabo] , si elle n'est pas presente sur votre template et que vous avez desactiver le lien de desabonnement , votre newsletter ne partiras pas, car retirer le lien de desabonnement est considere comme du spam !","e-mailing-service");
echo '<br>';
_e("Vous pouvez connaitre facilement toutes les variables disponible dans le menu variables","e-mailing-service");
echo '<br>';
echo '<br>';
_e("Si vous cocher la case 'Envoi automatique des nouveaux posts et nouvelles pages' , a chaque fois que vous publier une nouvelle newsletter ou un nouveau post , le lien est envoye a votre liste par defaut","e-mailing-service");
echo '<br>';
_e("Vous pouvez modifier le modele ou creer un nouveau modele a partir de la liste de modeles","e-mailing-service");
echo '<br>';
echo '<br>';
_e("Le temps pause est le delai d'attente entre chaque email envoyes , plus le temps de pause est court plus , votre newsletter sera envoye rapidement.","e-mailing-service");
echo '<br>';
_e("Si vous envoyez trop vite , votre serveur pourra etre bloque ou blackliste par les fournisseurs d'email.","e-mailing-service");
echo '<br>';
echo '<br>';
_e("Possibilite de mettre les campagnes en pause : vous pouvez l'activer ou le desactiver en cours d'envoi , pour le mettre en place que si vous en avez vraiment besoin , car sinon ralentit le script","e-mailing-service");
echo '<br>';
echo '<br>';
_e("Changement de configuration en cours d'envoi , il est possible de changer la configuration en cours d'envoi , cela changera votre serveur SMTP sur le script d'envoi","e-mailing-service");
echo '<br>';
echo '<br>';
?>
<br /><br /><a href="?page=e-mailing-service/admin/solde.php"><img src="<?php echo smURL;?>/screenshot-10.png" width="750" border="0"/></a>
<br /><br /><br /><br /></div>
            <div class="contenu_onglet" id="contenu_onglet_contact">
                <h1><?php echo __('Creer votre liste de contact','e-mailing-service'); ?></h1>
           <?php
		   echo ''.__("La liste permet de definir plusieurs categorie de contact, la desinscription est individuel par liste","e-mailing-service").'';?>   
           <br /><br /><a href="?page=e-mailing-service/admin/liste.php"><img src="<?php echo smURL;?>/screenshot-11.png" width="750" border="0"/></a><br />
                 

            </div>
               <div class="contenu_onglet" id="contenu_onglet_emails">
                <h1><?php echo __('Ajouter vos contacts','e-mailing-service'); ?></h1>
                
                <?php
		   echo ''.__("Une fois votre liste cree, vous pouvez ajouter des emails manuellement ou importer vos fichiers emails en .csv ou .txt","e-mailing-service").'';?> 
             <br /><br /><a href="?page=e-mailing-service/admin/liste.php"><img src="<?php echo smURL;?>/screenshot-12.png" width="750" border="0"/></a><br />
             <?php echo '<table width="700" border="1">
  <tr>
    <th scope="row"> '.__('Ajouter vos emails','e-mailing-service').'</th>
    <td><img src="'.smURL.'img/doc_add.png" width="32" height="32" border="0" title="'.__("Ajouter des emails","e-mailing-service").'"/></a></td>
    <td>'.__("Permet d'ajouter des emails",'e-mailing-service').'</td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>';


_e("Dans le menu widget de votre wordpress , vous devez activer notre widget , pour ajouter le formulaire d'inscription sur votre site. ","e-mailing-service");
echo '<br><br>';
_e("Si vous avez l'option NPAI (bounces) est active sur votre license, les email invalide (hard bounces) serons desactive de vos listes","e-mailing-service");
echo '<br>';
echo '<br>';
echo '<h2>'.__("Menu","e-mailing-service").' '.__("Importation d'email","e-mailing-service").'</h2><br>';
_e("Vous devez avoir le dossier /e-mailing-service/post avec l'autorisation sur le dossier (CHMOD 777) pour pouvoir importer des fichiers emails, une fois importer vos fichiers sont supprimes","e-mailing-service");
echo '<br>';
_e("Pas defaut en general vous pouvez importer un fichier de 2mo, pour augmenter celui-ci , il faut rajouter dans votre fichier .htaccess","e-mailing-service");
echo ": <br><textarea name=\"\" cols=\"50\" rows=\"3\">
php_flag post_max_size 50M
php_flag upload_max_filesize 50M
php_flag upload_max_size 50M</textarea>";
echo '<br>';
echo '<br>';?>


            </div>
               <div class="contenu_onglet" id="contenu_onglet_newsletter">
                <h1><?php echo __('Creer votre newsletter','e-mailing-service'); ?></h1>
                                <?php
		   echo '<p>'.__("Choisissez un modele, si vous en avez besoin, sinon mettez seulement le titre qui sera le sujet de la newsletter et cliquez sur suivant","e-mailing-service").'</p>';
		    echo '<p>'.__("Pour visonner les modeles,choisir le nom dans le menu deroulant","e-mailing-service").'</p>'; 
		   ?> 
             <br /><br /><a href="?page=e-mailing-service/admin/liste.php"><img src="<?php echo smURL;?>/screenshot-13.png" width="750" border="0"/></a><br /><br /><br />
             
             <?php
			 			echo '<h2>'.__("Menu","e-mailing-service").' '.__("Importation de modele","e-mailing-service").'</h2><br>';
_e("Vous devez avoir le dossier /e-mailing-service/post avec l'autorisation sur le dossier (CHMOD 777) pour pouvoir importer des fichier .zip","e-mailing-service");
echo "<br>";
_e("Le plugin a ete teste avec les design pour le marketing par email : ","e-mailing-service");
echo  '<a href="http://themeforest.net/category/marketing/email-templates?ref=tous1site" target="_blank">Themeforest</a>';
echo '<br>';
_e("Pas defaut en general vous pouvez importer un fichier de 2mo, pour augmenter celui-ci , il faut rajouter dans votre fichier .htaccess","e-mailing-service");
echo ": <br><textarea name=\"\" cols=\"50\" rows=\"5\">
php_flag post_max_size 50M
php_flag upload_max_filesize 50M
php_flag upload_max_size 50M</textarea>";
echo '<br>';
echo '<br>';
?>
            </div>
            
              <div class="contenu_onglet" id="contenu_onglet_send">
                <h1><?php echo __('Envoyer votre newsletter','e-mailing-service'); ?></h1>
                                <?php
		   echo '<p>'.__("Pour envoyer votre newsletter, il suffit de choisir votre newsletter, votre liste de contact et de cliquez sur envoyer","e-mailing-service").'</p>';
		    echo '<p>'.__("Le tracking ne sert qu'aux clients qui travaillent avec des sites d'affiliation et veulent tracer leur revenu","e-mailing-service").'</p>'; 
			  echo '<p>'.__("Le temps de pause determine la vitesse d'envoi de votre newsletter 10 correspond a 1 mail toutes les 10 secondes","e-mailing-service").'</p>'; 
		   ?> 
             <br /><br /><a href="?page=e-mailing-service/admin/send_user.php"><img src="<?php echo smURL;?>/screenshot-14.png" width="750" border="0"/></a><br />
            </div>
            
              <div class="contenu_onglet" id="contenu_onglet_suivis">
                <h1><?php echo __('Suivis des campagnes','e-mailing-service'); ?></h1>
                                <?php
		   echo '<p>'.__("Ce menu permet de suivre ll'avancement de vos envois, si le status est en attente , c'est que votre newsletter n'est pas encore partis","e-mailing-service").'</p>';
		   ?> 
             <br /><br /><a href="?page=e-mailing-service/admin/send_user.php"><img src="<?php echo smURL;?>/screenshot-15.png" width="750" border="0"/></a><br />
            </div>
            
              <div class="contenu_onglet" id="contenu_onglet_stats">
                <h1><?php echo __('Analyse des statistiques','e-mailing-service'); ?></h1>
                                <?php
		   echo '<p>'.__("Permet de connaitre le taux d'ouverture et de clics sur votre newsletter","e-mailing-service").'</p>';
		    echo '<p>'.__("Vous avez egalement la possibilite d'exporter les statistiques","e-mailing-service").'</p>'; 
		   ?> 
             <br /><br /><a href="?page=e-mailing-service/admin/send_user.php"><img src="<?php echo smURL;?>/screenshot-16.png" width="750" border="0"/></a><br />
            </div>
            
            
            
        </div>
    </div>&nbsp;
    

                    
                    
                    
                    
                    
               
</section>
</div>
</section>
<?php add_action( 'admin_print_scripts', 'sm_onglet_js' );?>