
<?php
include(smPATH . '/include/entete.php');
extract($_POST);
//extract($_GET);
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


echo "<h1>". __('Support',"e-mailing-service")."</h1>";
?>
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div>
	<h2 class="nav-tab-wrapper">
		<a href="?page=e-mailing-service/admin/support.php&section=faq" class="nav-tab <?php if(isset($_REQUEST['section'])){ if ($_REQUEST['section'] == 'faq' || empty($_REQUEST['section'])) echo 'nav-tab-active';} ?>">
			<?php _e('FAQ',"e-mailing-service"); ?>
		</a>
		<a href="?page=e-mailing-service/admin/support.php&section=faq_question" class="nav-tab <?php if(isset($_REQUEST['section'])){ if ($_REQUEST['section'] == 'faq_question') echo 'nav-tab-active'; }?>">
			<?php _e("Posez une question public", "e-mailing-service"); ?>
		</a>
		<a href="?page=e-mailing-service/admin/support.php&section=ticket_liste" class="nav-tab <?php if(isset($_REQUEST['section'])){ if ($_REQUEST['section'] == 'ticket_liste') echo 'nav-tab-active'; }?>">
			<?php _e('Liste des tickets',"e-mailing-service"); ?>
		</a>
		<a href="?page=e-mailing-service/admin/support.php&section=ticket" class="nav-tab <?php if(isset($_REQUEST['section'])){ if($_REQUEST['section'] == 'ticket') echo 'nav-tab-active'; } ?>">
			<?php _e("Contacter le support technique", "e-mailing-service"); ?>
		</a>
      <a href="?page=e-mailing-service/admin/support.php&section=suggestion" class="nav-tab <?php if(isset($_REQUEST['section'])){ if ($_REQUEST['section'] == 'suggestion') echo 'nav-tab-active'; }?>">
			<?php _e("Suggestion", "e-mailing-service"); ?>
		</a>		
	</h2><h2>
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