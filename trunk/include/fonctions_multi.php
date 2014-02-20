<?php
    function sm_smtp_multi_1($phpmailer){
	global $wdpd;
	$phpmailer->Mailer = "smtp";
	
	$phpmailer->From = get_option('sm_email_exp_1');
	$phpmailer->FromName = get_option('sm_from_1');
	$phpmailer->Sender = $phpmailer->From; 
	$phpmailer->Host = get_option('sm_smtp_server_1');
	$phpmailer->Port = get_option('sm_smtp_port_1');
	$phpmailer->SMTPAuth = (get_option('sm_smtp_authentification_1')=="oui") ? TRUE : FALSE;
	if($phpmailer->SMTPAuth){
		$phpmailer->Username =  get_option('sm_smtp_login_1');
		$phpmailer->Password = get_option('sm_smtp_pass_1');
	}
    if(get_option('sm_debug')=="oui")
    {
        $phpmailer->SMTPDebug = 2;
    }
    }
	function sm_smtp_multi_2($phpmailer){
	global $wdpd;
	$phpmailer->Mailer = "smtp";
	
	$phpmailer->From = get_option('sm_email_exp_2');
	$phpmailer->FromName = get_option('sm_from_2');
	$phpmailer->Sender = $phpmailer->From; 
	$phpmailer->Host = get_option('sm_smtp_server_2');
	$phpmailer->Port = get_option('sm_smtp_port_2');
	$phpmailer->SMTPAuth = (get_option('sm_smtp_authentification_2')=="oui") ? TRUE : FALSE;
	if($phpmailer->SMTPAuth){
		$phpmailer->Username =  get_option('sm_smtp_login_2');
		$phpmailer->Password = get_option('sm_smtp_pass_2');
	}
    if(get_option('sm_debug')=="oui")
    {
        $phpmailer->SMTPDebug = 2;
    }
    }
?>