<?php global $wp;
$postid = get_the_ID();
 $billet = get_post($postid);
 $title = $billet->post_title;
 $date = $billet->post_date;
 $contenu = $billet->post_content;
 $contenu = apply_filters('the_content', $contenu);
 $contenu = str_replace(']]>', ']]&gt;', $contenu);
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?>
</title>
</head>
<body>


				<?php 
				if(get_option('sm_affiche_txt_haut')=="oui"){
				echo get_option('sm_txt_haut');
				}
                echo $contenu;
				//get_template_part( 'content', get_post_format() );
				if(get_option('sm_affiche_txt_bas')=="oui"){ 
				echo get_option('sm_txt_bas');
				}
				if(get_option('sm_affiche_txt_affiliation')=="oui"){
		        echo get_option('sm_txt_affiliation');
				}
		?>


</body>
</html>
<?php exit();?>