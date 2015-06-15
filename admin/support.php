<div id="wrapper">
        <header id="page-header">
             <div class="wrapper">
               <?php 
if ( is_plugin_active( 'admin-hosting/admin-hosting.php' ) ) {
	include(AH_PATH . '/include/entete.php');
} else {
	include(smPATH . '/include/entete.php');
}?>
                          <div id="main-nav">
                    <ul class="clearfix">    
                    <?php
if(!isset($active_page)){
$active_page='faq';
}					
					?>        
<li <?php if($active_page=="faq"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/support.php&section=faq"><?php _e('FAQ','admin-hosting');?></a></li>
<li <?php if($active_page=="faq_question"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/support.php&section=faq_question"><?php _e("FAQ Question",'admin-hosting');?></a></li>
<li <?php if($active_page=="ticket_liste"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/support.php&section=ticket_liste"><?php _e("List Ticket",'admin-hosting');?></a></li>
<li <?php if($active_page=="ticket"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/support.php&section=ticket"><?php _e("Create ticket",'admin-hosting');?></a></li>
<li <?php if($active_page=="suggestion"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/support.php&section=suggestion"><?php _e("Suggestion",'admin-hosting');?></a></li>	
                    </ul>
                </div>
             </div>
             

                  <!--  <input placeholder="Search..." type="text" name="q" value="" />-->
              
             <div id="page-subheader">
                <div class="wrapper">
 <h2>
<?php _e("Support","e-mailing-service");?>

 </h2>
   </div>
         </div>
        </header>

                 <section id="content">
            <div class="wrapper">                                   

        <?php 
   if(isset($_REQUEST['section'])){
		if ($_REQUEST['section'] == 'faq')	{ echo "<p>".__("Verifier dans la FAQ que votre question n'a pas ete deja pose","e-mailing-service")."</p>";}
		if ($_REQUEST['section'] == 'faq_question') { echo "<p>".__("Posez votre question","e-mailing-service")."</p>"; }
		if ($_REQUEST['section'] == 'ticket_liste'){  echo "<p>".__("Liste des tickets","e-mailing-service")."</p>"; }
		if ($_REQUEST['section'] == 'ticket') { echo "<p>".__("Si vous avez un probleme technique lie au plugin , vous pouvez envoye un ticket","e-mailing-service")."</p>";}
		if ($_REQUEST['section'] == 'suggestion') { echo "<p>".__("Si vous souhaitez des ameliorations a proposer sur le plugin, faite en la demande","e-mailing-service")."</p>"; }
	} else {
	echo "<p>".__("Verifier dans la FAQ que votre question n'a pas ete deja posé","e-mailing-service")."</p>";
	}
		
?>
        
                    
                    <hr />
<?php
if(isset($action)){
global $wpdb;
	if($action =="insert"){
	    $host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);
		$array =array (
		"domaine_client" => $host,
		"license_key" => get_option('sm_license_key'),
		"login" => get_option('sm_login'),
		"action" => "ticket_insert",
		"email"  => $email,
		"sujet"  => $sujet,
		"message" => $message,
		"wplang" => WPLANG
		); 
       $flux=xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_ticket.php',$array);
	   //echo '<textarea name="" cols="100" rows="5">'.$flux.'</textarea>';	
	   _e("Votre ticket a bien ete envoye","e-mailing-service");
	}
	elseif($action =="ticket_reponse"){
	    $host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);
		$array =array (
		"domaine_client" => $host,
		"license_key" => get_option('sm_license_key'),
		"login" => get_option('sm_login'),
		"action" => "ticket_reponse",
		"ticket_id"  => $ticket_id,
		"message" => $message
		); 
       $flux=xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_ticket.php',$array);
	   //echo '<textarea name="" cols="100" rows="5">'.$flux.'</textarea>';	
	   _e("Votre reponse a bien ete envoye","e-mailing-service");
	}
	elseif($action =="insert_question"){
	    $host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);
		$array =array (
		"domaine_client" => $host,
		"license_key" => get_option('sm_license_key'),
		"login" => get_option('sm_login'),
		"action" => "faq_insert",
		"email"  => $email,
		"question" => $question,
		"wplang" => WPLANG
		); 
       $flux=xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_ticket.php',$array);
	   //echo '<textarea name="" cols="100" rows="5">'.$flux.'</textarea>';	
	   _e("Votre question est en ligne","e-mailing-service");
	}	
    elseif($action =="faq_reponse"){
	    $host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);
		$array =array (
		"domaine_client" => $host,
		"license_key" => get_option('sm_license_key'),
		"login" => get_option('sm_login'),
		"action" => "faq_reponse",
		"ticket_id"  => $ticket_id,
		"reponse" => $reponse
		); 
       $flux=xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_ticket.php',$array);
	   //echo '<textarea name="" cols="100" rows="5">'.$flux.'</textarea>';	
	   _e("Votre reponse a bien ete envoye","e-mailing-service");
	}
		elseif($action =="suggestion"){
	    $host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);
		$array =array (
		"domaine_client" => $host,
		"license_key" => get_option('sm_license_key'),
		"login" => get_option('sm_login'),
		"action" => "suggestion_insert",
		"email"  => $email,
		"suggestion" => $suggestion,
		"wplang" => WPLANG
		); 
       $flux=xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_ticket.php',$array);
	   //echo '<textarea name="" cols="100" rows="5">'.$flux.'</textarea>';	
	   _e("Votre demande est en ligne, il faut maintenant obtenir suffisement de vote, pour que nous devellopions votre demande","e-mailing-service");
	}	
	elseif($action =="suggestion_vote"){
	    $host=str_replace("http://","",$_SERVER['HTTP_HOST']);
		$host=str_replace("www.","",$host);
		$array =array (
		"domaine_client" => $host,
		"license_key" => get_option('sm_license_key'),
		"login" => get_option('sm_login'),
		"action" => "suggestion_vote",
		"email"  => $email,
		"suggestion_id" => $suggestion_id,
		"wplang" => WPLANG
		); 
       $flux=xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_ticket.php',$array);
	   _e("Merci d'avoir vote","e-mailing-service");
	}	
}



?>
    <?php
	if(isset($_REQUEST['section'])){
		if ($_REQUEST['section'] == 'faq') include(smPATH.'tuto/faq.php');
		if ($_REQUEST['section'] == 'faq_question') include(smPATH.'tuto/faq_question.php');
		if ($_REQUEST['section'] == 'ticket_liste') include(smPATH.'tuto/ticket_liste.php');
		if ($_REQUEST['section'] == 'ticket') include(smPATH.'tuto/ticket.php');
		if ($_REQUEST['section'] == 'suggestion') include(smPATH.'tuto/suggestion.php');
	} else {
	include(smPATH.'tuto/faq.php');	
	}

	?>
</div>