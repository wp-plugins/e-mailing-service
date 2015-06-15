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
<?php _e("Gestion de vos credits et forfaits","e-mailing-service");?>
 </h2>
                </div>
         </div>
                 <section id="content">
            <div class="wrapper">                <section class="columns">                    

        <?php echo "<p>".__("Suivez les disponibilites d'envoi qu'il vous reste","e-mailing-service")."</p>";?>
                    
                    <hr />
                    
                  
<?php
echo '<div class="message success">';
echo '<h1>'.ah_credit($user_login).' '.get_option('ah_curency1').'</h1>';
$nb_mail_possible =ah_credit($user_login) / get_option('ah_tarif_credit');
echo '<p>'.__("Vous pouvez envoyer","e-mailing-service").' '.$nb_mail_possible.' '.__("emails","e-mailing-service").' '.__("avec votre solde","e-mailing-service").'</p>';
echo '</div>';
if(ah_service_actif($user_login) == 'marketing'){
echo '<div class="message info">';
$reference = get_service_marketing($user_login);
echo '<h1>'.__("Votre forfait","e-mailing-service").' '.$reference.'</h1>';
$nb_envoi_mois = sm_nb_envois_mois($user_login);
$reste = ah_limit_month($user_login,$reference) - $nb_envoi_mois;
echo '<p>'.__("Capacite d'envoi de votre forfait","e-mailing-service").' : '.ah_limit_month($user_login,$reference).' '.__("emails","e-mailing-service").'</p>';
echo '<p>'.__("Vous avez envoye","e-mailing-service").' : '.sm_nb_envois_mois($user_login).' '.__("emails","e-mailing-service").'</p>';	
echo '<p>'.__("Il vous reste ","e-mailing-service").' : '.$reste.' '.__("emails","e-mailing-service").'</p>';
echo '</div>';
}
elseif(ah_service_actif($user_login) == 'smtp'){
$reference = get_service_marketing($user_login);
echo '<div class="message info">';
echo '<h1>'.__("Votre forfait","e-mailing-service").' '.$reference.'</h1>';
$nb_envoi_mois = sm_nb_envois_mois($user_login);
$reste = ah_limit_month($user_login,$reference) - $nb_envoi_mois;
echo '<p>'.__("Capacite d'envoi de votre forfait","e-mailing-service").' : '.ah_limit_month($user_login,$reference).' '.__("emails","e-mailing-service").'</p>';
echo '<p>'.__("Vous avez envoye","e-mailing-service").' : '.sm_nb_envois_mois($user_login).' '.__("emails","e-mailing-service").'</p>';	
echo '<p>'.__("Il vous reste ","e-mailing-service").' : '.$reste.' '.__("emails","e-mailing-service").'</p>';
echo '</div>';
}
elseif(ah_service_actif($user_login) == 'server'){
	echo '<div class="message info">';
$reference = get_service_marketing($user_login);
echo '<h1>'.__("Unlimited","e-mailing-service").'</h1>';
echo '<p>'.__("Vous avez un serveur , vous n'avez donc aucune limite d'envoi sur l'interface","e-mailing-service").'</p>';
echo '<p>'.__("Server","e-mailing-service").' : '.get_user_meta( $user_id, 'sm_host',true).' '.__("Port","e-mailing-service").' : '.get_user_meta( $user_id, 'sm_port',true).'</p>';
echo '</div>';
}
?>


</div>
</section>
</div>
</section>
