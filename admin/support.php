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
<li <?php if($active_page=="faq"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/support.php&section=faq"><?php _e('FAQ','admin-hosting');?></a></li>
<li <?php if($active_page=="faq_question"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/support.php&section=faq_question"><?php _e("Server check ",'admin-hosting');?></a></li>
<li <?php if($active_page=="ticket_liste"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/support.php&section=ticket_liste"><?php _e("Statistics smtp for server",'admin-hosting');?></a></li>
<li <?php if($active_page=="ticket"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/support.php&section=ticket"><?php _e("Order",'admin-hosting');?></a></li>
<li <?php if($active_page=="suggestion"){ echo 'class="active"';} ?> ><a href="?page=e-mailing-service/admin/support.php&section=suggestion"><?php _e("Order",'admin-hosting');?></a></li>	
                    </ul>
                </div>
             </div>
             <div id="page-subheader">
                <div class="wrapper">
 <h2>
 <?php
 if(isset($_REQUEST['section'])){
	    if ($_REQUEST['section'] == 'server_detail') { _e("Server",'admin-hosting'); echo " ".$_GET["serveur"]."";}
		if ($_REQUEST['section'] == 'server_check') { _e("Server check",'admin-hosting'); }
		elseif ($_REQUEST['section'] == 'server_smtp') { _e("Statistics smtp",'admin-hosting');}
		elseif ($_REQUEST['section'] == 'server_email') { _e("Gestion des adresses emails",'admin-hosting');}
		elseif ($_REQUEST['section'] == 'domain_renew'){  _e("Domains Renewal",'admin-hosting');}
		elseif ($_REQUEST['section'] == 'domain_registration') { _e("Domain Registration",'admin-hosting');}
		elseif ($_REQUEST['section'] == 'domain_whois') {_e("Whois Information",'admin-hosting');}
		elseif ($_REQUEST['section'] == 'domain_dns'){  _e("Advanced DNS Management",'admin-hosting');}
		elseif ($_REQUEST['section'] == 'server_smtp'){  _e("SMTP information",'admin-hosting');}
		elseif ($_REQUEST['section'] == 'server_stats_smtp'){  _e("SMTP statistics",'admin-hosting');}
		elseif ($_REQUEST['section'] == 'server_option'){  _e("Order Options",'admin-hosting');}
		elseif ($_REQUEST['section'] == 'server_web'){  _e("Web service",'admin-hosting');}
		elseif ($_REQUEST['section'] == 'server_list'){  _e("Server list",'admin-hosting');}
		elseif ($_REQUEST['section'] == 'server_order'){  _e("Server order",'admin-hosting');}
		elseif ($_REQUEST['section'] == 'serveur_install'){  _e("Server install",'admin-hosting');}
		elseif ($_REQUEST['section'] == 'server_install'){  _e("Server install",'admin-hosting');}
		elseif ($_REQUEST['section'] == 'load'){  _e("Load Balancing",'admin-hosting');}
		elseif ($_REQUEST['section'] == 'stats'){  _e("Statistics SMTP",'admin-hosting');}
		elseif ($_REQUEST['section'] == 'stats_live'){  _e("Live statistics",'admin-hosting');}
 } else {
	  _e("Server list",'admin-hosting');
 }
   ?>					
</h2>
                  <!--  <input placeholder="Search..." type="text" name="q" value="" />-->
                </div>
         </div>
        </header>
</div>
             <div id="page-subheader">
                <div class="wrapper">
 <h2>
<?php _e("Suivis de vos envois","e-mailing-service");?>
 </h2>
                </div>
         </div>
                 <section id="content">
            <div class="wrapper">                                   

        <?php echo "<p>".__("Pour suivre en direct le nombres d'emails envoyes","e-mailing-service")."</p>";?>
                    
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