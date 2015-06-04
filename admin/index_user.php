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
            <span class="onglet_0 onglet" id="onglet_solde" onclick="javascript:change_onglet('solde');">1.<?php echo __('Verifier votre solde','e-mailing-service'); ?></span>
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
              <li><?php echo ''.__('Verifier votre solde','e-mailing-service').' ( '.__('menu','e-mailing-service').'  <a href="?page=e-mailing-service/admin/solde.php">'.__('Account', 'e-mailing-service').'</a> )';?> </li>
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
                <h1><?php echo __('Verifier votre solde','e-mailing-service'); ?></h1>
<?php

echo ''.__("Vous avez plusieurs façon d'alimenter votre solde","e-mailing-service").' : ';
echo '<ol><li>'.__("Avec des credits, vous choisissez le montant, vous n'avez pas d'options, les envois ce font de nos serveurs avec nos noms de domaines","e-mailing-service").' (<a href="?page=admin-hosting/admin_financial/index.php&section=add-credit">'.__('Crediter votre compte','e-mailing-service').'</a>)</li>';
echo '<li>'.__("En choisissant un forfait email marketing, sans engagement, les envois ce font de nos serveurs avec nos noms de domaines, en option vous pouvez choisir un domaine et avoir une ip dedie","e-mailing-service").' (<a href="?page=admin-hosting/admin_service/index.php&section=email_order&cat=email">'.__('Choisir un forfait','e-mailing-service').'</a>)</li>';
echo '<li>'.__("Avec un serveur dedie, l'interface est illimite , le serveur, le nom de domaine et les ip sont a votre noms, vous êtes independant","e-mailing-service").' (<a href="?page=admin-hosting/admin_service/index.php&section=server_order&cat=server">'.__('Choisir un serveur','e-mailing-service').'</a>)</li></ol>';

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
</table>';?>

            </div>
               <div class="contenu_onglet" id="contenu_onglet_newsletter">
                <h1><?php echo __('Creer votre newsletter','e-mailing-service'); ?></h1>
                                <?php
		   echo '<p>'.__("Choisissez un modele, si vous en avez besoin, sinon mettez seulement le titre qui sera le sujet de la newsletter et cliquez sur suivant","e-mailing-service").'</p>';
		    echo '<p>'.__("Pour visonner les modeles,choisir le nom dans le menu deroulant","e-mailing-service").'</p>'; 
		   ?> 
             <br /><br /><a href="?page=e-mailing-service/admin/liste.php"><img src="<?php echo smURL;?>/screenshot-13.png" width="750" border="0"/></a><br />
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
<script type="text/javascript">
        //<!--
                var anc_onglet = 'snapshot';
                change_onglet(anc_onglet);
        //-->
</script>