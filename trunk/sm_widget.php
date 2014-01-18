<?php 	 
class class_widget_sm extends WP_widget{ 
   
function __construct() {
$options = array("classname" => "sm-widget", "description" => "".__("Formulaire d'inscription a votre newsletter")."");     
$this->WP_widget("sm-widget", "".__("Inscription Newsletter")."", $options);   
}
    
function widget($arguments, $data)    { 
$defaut = array("titre" => "".__("Inscription newsletter","e-mailing-service")."",
       "description" => "".__("Pour recevoir les dernieres actualites inscrivez vous","e-mailing-service")."",  	   
       "demande_nom" => "".__("oui","e-mailing-service")."",               
	   "demande_4" => "".__("non","e-mailing-service")."", 
	   "demande_5" =>"".__("non","e-mailing-service")."", 
	   "demande_6" => "".__("non","e-mailing-service")."", 
	   "demande_7" => "".__("non","e-mailing-service")."", 
	   "demande_8" => "".__("non","e-mailing-service")."", 
	   "demande_9" => "".__("non","e-mailing-service")."", 
	   "demande_10" => "".__("non","e-mailing-service")."", 
	   "demande_11" => "".__("non","e-mailing-service")."", 
	   "demande_12" => "".__("non","e-mailing-service")."", 
	    "liste" => "".__("test","e-mailing-service").""
	   );    
	   $data = wp_parse_args($data, $defaut);     global $wpdb;    
$table_prefix = $wpdb->prefix;     extract($arguments);     
echo $before_widget;    echo $before_title . $data['titre'] . $after_title;    echo "<p>";
if($data['description'] !=''){
echo '<p>'.$data['description'].'</p>';
}
extract($_POST);
if(isset($action)){
if($action=='insert_inscrit_newsletter'){
if(!function_exists('sm_checkEmail')){
	function sm_checkEmail($email) {  
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) { 
	 return '1'; 	    
      } else {
    return '0';
      } 
	}
}	

	  if(sm_checkEmail($email)=="1"){
       $wpdb->replace($liste_bd, array(  
            'email' => $email,  
            'nom' => @$nom,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'lg' => substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,5),
            'date_creation' => current_time('mysql'),
			'champs1' => @$d4,
			'champs2' => @$d5,
			'champs3' => @$d6,
			'champs4' => @$d7,
			'champs5' => @$d8,
			'champs6' => @$d9,
			'champs7' => @$d10,
			'champs8' => @$d11,
			'champs9' => @$d12			  
       ));	   
	    echo "".__("Vous etes maintenant inscrit sur notre newsletter","e-mailing-service")."<br>";
		if(get_option('sm_alerte_inscrit') =='oui'){
sm_alerte_envoi(''.__("Nouvel inscrit a votre newsletter sur","e-mailing-service").' '.get_option('urlsite').'',''.__("Nouvel inscrit a votre newsletter","e-mailing-service").'<br>'.$nom.' : '.$email.'<br> '.date('Y-m-d H:i:s').'');	
		}
		$inscritok=1;
	  } else {
		echo "".__("Votre email est invalide","e-mailing-service")."";  
	   $inscritok=0;
	  }
}
}
if(!isset($inscritok) || $inscritok==0){
echo '
<form action="'.$_SERVER['PHP_SELF'].'" method="post" enctype="application/x-www-form-urlencoded" target="_parent" id="emailcatcher" >
<input name="action" type="hidden" value="insert_inscrit_newsletter"/>
<input name="liste" type="hidden" value="'.$data['liste'].'"/>
<table><tr><td>Email : </td><td><input name="email" type="text" /></td></tr>';
if($data['demande_nom'] =='oui'){
echo '<tr><td>Nom : </td><td><input name="nom" type="text" /></td></tr>';
}
	     $table_liste = $wpdb->prefix.'sm_liste'; 
         $fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_liste."` WHERE liste_bd ='".$data['liste']."'");
         foreach ( $fivesdrafts as $fivesdraft ) 
          { 
echo '<input name="liste_bd" type="hidden" value="'.$fivesdraft->liste_bd.'"/>';         
if($data['demande_4'] =='oui'){
echo '<td>'.$fivesdraft->champs1.' : </td><td><input name="d4" type="text" /></td></tr>';
} 
if($data['demande_5'] =='oui'){
echo '<td>'.$fivesdraft->champs2.' : </td><td><input name="d5" type="text" /></td></tr>';
}
if($data['demande_6'] =='oui'){
echo '<td>'.$fivesdraft->champs3.' : </td><td><input name="d6" type="text" /></td></tr>';
}
if($data['demande_7'] =='oui'){
echo '<td>'.$fivesdraft->champs4.' : </td><td><input name="d7" type="text" /></td></tr>';
}
if($data['demande_8'] =='oui'){
echo '<td>'.$fivesdraft->champs5.' : </td><td><input name="d8" type="text" /></td></tr>';
}
if($data['demande_9'] =='oui'){
echo '<td>'.$fivesdraft->champs6.' : </td><td><input name="d9" type="text" /></td></tr>';
}
if($data['demande_10'] =='oui'){
echo '<td>'.$fivesdraft->champs7.' : </td><td><input name="d10" type="text" /></td></tr>';
}
if($data['demande_11'] =='oui'){
echo '<td>'.$fivesdraft->champs8.' : </td><td><input name="d11" type="text" /></td></tr>';
}
if($data['demande_12'] =='oui'){
echo '<td>'.$fivesdraft->champs9.' : </td><td><input name="d12" type="text" /></td></tr>';
}
		  }
echo '</tr>
<tr><td><input name="valider" type="submit" value="'.__("valider","e-mailing-service").'" /></td><td></td></tr>
</table>
</form><br><br>'; 
}
echo $after_widget;   
}     
function update($content_new, $content_old)    { 
 $content_new['titre'] = esc_attr($content_new['titre']); 
 $content_new['description'] = esc_attr($content_new['description']);       
 $content_new['demande_nom'] = esc_attr($content_new['demande_nom']);    
 $content_new['demande_4'] = esc_attr($content_new['demande_4']);  
 $content_new['demande_5'] = esc_attr($content_new['demande_5']);  
 $content_new['demande_6'] = esc_attr($content_new['demande_6']);  
 $content_new['demande_7'] = esc_attr($content_new['demande_7']);  
 $content_new['demande_8'] = esc_attr($content_new['demande_8']);  
 $content_new['demande_9'] = esc_attr($content_new['demande_9']);  
 $content_new['demande_10'] = esc_attr($content_new['demande_10']);  
 $content_new['demande_11'] = esc_attr($content_new['demande_11']);  
 $content_new['demande_12'] = esc_attr($content_new['demande_12']);  
 $content_new['liste'] = esc_attr($content_new['liste']);      
 return $content_new;   
}     
function form($data)    {
	   $defaut = array("titre" => "".__("Inscription newsletter","e-mailing-service")."",
	   "description" => "".__("Pour recevoir les dernieres actualites inscrivez vous","e-mailing-service")."",
	   "demande_nom" => "".__("oui","e-mailing-service")."",              
	   "demande_4" =>  "".__("non","e-mailing-service")."",    
	   "demande_5" => "".__("non","e-mailing-service")."",
	   "demande_6" => "".__("non","e-mailing-service")."",   
	   "demande_7" => "".__("non","e-mailing-service")."",  
	   "demande_8" => "".__("non","e-mailing-service")."",   
	   "demande_9" => "".__("non","e-mailing-service")."",   
	   "demande_10" => "".__("non","e-mailing-service")."",  
	   "demande_11" => "".__("non","e-mailing-service")."",   
	   "demande_12" => "".__("non","e-mailing-service")."",
	   "liste" => "".__("test","e-mailing-service")."",
	                   );    
	   $data = wp_parse_args($data, $defaut);     global $wpdb;    
	   $table_prefix = $wpdb->prefix;     ?>    <p>    
       <label for="<?php echo $this->get_field_id('titre'); ?>"><?php _e("Titre dans la sidebar","e-mailing-service");?> :</label><br />
       <p>
  <input value="<?php echo $data['titre']; ?>" name="<?php echo $this->get_field_name('titre'); ?>" id="<?php echo $this->get_field_id('titre'); ?>" type="text" />    
</p>    
      <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e("Description");?> :</label><br />
       <p><textarea name="<?php echo $this->get_field_name('description'); ?>" id="<?php echo $this->get_field_id('description'); ?>"  cols="30" rows="5"><?php echo $data['description']; ?></textarea>
</p>  
      <table><tr><td><?php _e("Demander le nom");?> ?</td><td>  
    <?php 
	if($data['demande_nom'] =='non'){
	 echo '<label><input name="'.$this->get_field_name('demande_nom').'" type="radio" id="'.$this->get_field_id('demande_nom').'" value="non" checked="checked" />'.__("non","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_nom').'" type="radio" id="'.$this->get_field_id('demande_nom').'" value="oui"/>'.__("oui","e-mailing-service").'</label>';	
	} else {
	echo  '<label><input name="'.$this->get_field_name('demande_nom').'" type="radio" id="'.$this->get_field_id('demande_nom').'" value="oui" checked="checked" />'.__("oui","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_nom').'" type="radio" id="'.$this->get_field_id('demande_nom').'" value="non"/>'.__("non","e-mailing-service").'</label>';	
	}
	?> 
        </td></tr><tr><td>4<?php _e("ieme champs","e-mailing-service");?> ?</td><td>    
    <?php if($data['demande_4'] =='non'){
	 echo '<label><input name="'.$this->get_field_name('demande_4').'" type="radio" id="'.$this->get_field_id('demande_4').'_1" value="'.__("non","e-mailing-service").'" checked="checked" />non</label>
	       <label><input name="'.$this->get_field_name('demande_4').'" type="radio" id="'.$this->get_field_id('demande_4').'_0" value="oui"/>'.__("oui","e-mailing-service").'</label>';	
	} else {
	echo  '<label><input name="'.$this->get_field_name('demande_4').'" type="radio" id="'.$this->get_field_id('demande_4').'_0" value="oui" checked="checked" />'.__("oui","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_4').'" type="radio" id="'.$this->get_field_id('demande_4').'_1" value="non"/>'.__("non","e-mailing-service").'</label>';	
	}
	?> 
               </td></tr><tr><td>5<?php _e("ieme champs","e-mailing-service");?> ?</td><td>  
    <?php if($data['demande_5'] =='non'){
	 echo '<label><input name="'.$this->get_field_name('demande_5').'" type="radio" id="'.$this->get_field_id('demande_5').'_1" value="non" checked="checked" />'.__("non","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_5').'" type="radio" id="'.$this->get_field_id('demande_5').'_0" value="oui"/>'.__("oui","e-mailing-service").'</label>';	
	} else {
	echo  '<label><input name="'.$this->get_field_name('demande_5').'" type="radio" id="'.$this->get_field_id('demande_5').'_0" value="oui" checked="checked" />'.__("oui","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_5').'" type="radio" id="'.$this->get_field_id('demande_5').'_1" value="non"/>'.__("non","e-mailing-service").'</label>';	
	}
	?> 
           </td></tr><tr><td>6<?php _e("ieme champs","e-mailing-service");?> ?</td><td>  
    <?php if($data['demande_6'] =='non'){
	 echo '<label><input name="'.$this->get_field_name('demande_6').'" type="radio" id="'.$this->get_field_id('demande_6').'_1" value="non" checked="checked" />'.__("non","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_6').'" type="radio" id="'.$this->get_field_id('demande_6').'_0" value="oui"/>'.__("oui","e-mailing-service").'</label>';	
	} else {
	echo  '<label><input name="'.$this->get_field_name('demande_6').'" type="radio" id="'.$this->get_field_id('demande_6').'_0" value="oui" checked="checked" />'.__("oui","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_6').'" type="radio" id="'.$this->get_field_id('demande_6').'_1" value="non"/>'.__("non","e-mailing-service").'</label>';	
	}
	?>  
           </td></tr><tr><td>7<?php _e("ieme champs","e-mailing-service");?> ?</td><td>  
    <?php if($data['demande_7']=='non'){
	 echo '<label><input name="'.$this->get_field_name('demande_7').'" type="radio" id="'.$this->get_field_id('demande_7').'_1" value="non" checked="checked" />'.__("non","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_7').'" type="radio" id="'.$this->get_field_id('demande_7').'_0" value="oui"/>'.__("oui","e-mailing-service").'</label>';	
	} else {
	echo  '<label><input name="'.$this->get_field_name('demande_7').'" type="radio" id="'.$this->get_field_id('demande_7').'_0" value="oui" checked="checked" />'.__("oui","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_7').'" type="radio" id="'.$this->get_field_id('demande_7').'_1" value="non"/>'.__("non","e-mailing-service").'</label>';	
	}
	?>  
           </td></tr><tr><td>8<?php _e("ieme champs","e-mailing-service");?> ?</td><td>  
    <?php if($data['demande_8'] =='non'){
	 echo '<label><input name="'.$this->get_field_name('demande_8').'" type="radio" id="'.$this->get_field_id('demande_8').'_1" value="non" checked="checked" />'.__("non","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_8').'" type="radio" id="'.$this->get_field_id('demande_8').'_0" value="oui"/>'.__("oui","e-mailing-service").'</label>';	
	} else {
	echo  '<label><input name="'.$this->get_field_name('demande_8').'" type="radio" id="'.$this->get_field_id('demande_8').'_0" value="oui" checked="checked" />'.__("oui","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_8').'" type="radio" id="'.$this->get_field_id('demande_8').'_1" value="non"/>'.__("non","e-mailing-service").'</label>';	
	}
	?>  
           </td></tr><tr><td>9<?php _e("ieme champs","e-mailing-service");?> ?</td><td>  
    <?php if($data['demande_9'] =='non'){
	 echo '<label><input name="'.$this->get_field_name('demande_9').'" type="radio" id="'.$this->get_field_id('demande_9').'_1" value="non" checked="checked" />'.__("non","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_9').'" type="radio" id="'.$this->get_field_id('demande_9').'_0" value="oui"/>'.__("oui","e-mailing-service").'</label>';	
	} else {
	echo  '<label><input name="'.$this->get_field_name('demande_9').'" type="radio" id="'.$this->get_field_id('demande_9').'_0" value="oui" checked="checked" />'.__("oui","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_9').'" type="radio" id="'.$this->get_field_id('demande_9').'_1" value="non"/>'.__("non","e-mailing-service").'</label>';	
	}
	?>  
           </td></tr><tr><td>10<?php _e("ieme champs","e-mailing-service");?> ?</td><td>  
    <?php if($data['demande_10'] =='non'){
	 echo '<label><input name="'.$this->get_field_name('demande_10').'" type="radio" id="'.$this->get_field_id('demande_10').'_1" value="non" checked="checked" />'.__("non","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_10').'" type="radio" id="'.$this->get_field_id('demande_10').'_0" value="oui"/>'.__("oui","e-mailing-service").'</label>';	
	} else {
	echo  '<label><input name="'.$this->get_field_name('demande_10').'" type="radio" id="'.$this->get_field_id('demande_10').'_0" value="oui" checked="checked" />'.__("oui","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_10').'" type="radio" id="'.$this->get_field_id('demande_10').'_1" value="non"/>'.__("non","e-mailing-service").'</label>';	
	}
	?>  
           </td></tr><tr><td>11<?php _e("ieme champs","e-mailing-service");?> ? </td><td> 
    <?php if($data['demande_11'] =='non'){
	 echo '<label><input name="'.$this->get_field_name('demande_11').'" type="radio" id="'.$this->get_field_id('demande_11').'_1" value="non" checked="checked" />'.__("non","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_11').'" type="radio" id="'.$this->get_field_id('demande_11').'_0" value="oui"/>'.__("oui","e-mailing-service").'</label>';	
	} else {
	echo  '<label><input name="'.$this->get_field_name('demande_11').'" type="radio" id="'.$this->get_field_id('demande_11').'_0" value="oui" checked="checked" />'.__("oui","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_11').'" type="radio" id="'.$this->get_field_id('demande_11').'_1" value="non"/>'.__("non","e-mailing-service").'</label>';	
	}
	?>  
           </td></tr><tr><td>12<?php _e("ieme champs","e-mailing-service");?> ?</td><td>  
    <?php if($data['demande_12'] =='non'){
	 echo '<label><input name="'.$this->get_field_name('demande_12').'" type="radio" id="'.$this->get_field_id('demande_12').'" value="non" checked="checked" />'.__("non","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_12').'" type="radio" id="'.$this->get_field_id('demande_12').'" value="oui"/>'.__("oui","e-mailing-service").'</label>';	
	} else {
	echo  '<label><input name="'.$this->get_field_name('demande_12').'" type="radio" id="'.$this->get_field_id('demande_12').'" value="oui" checked="checked" />'.__("oui","e-mailing-service").'</label>
	       <label><input name="'.$this->get_field_name('demande_12').'" type="radio" id="'.$this->get_field_id('demande_12').'" value="non"/>'.__("non","e-mailing-service").'</label>';	
	}
	
	?> </td></tr><tr><td><?php _e("Choisissez votre liste","e-mailing-service");?> : </td><td>
     <?php 
      echo '<select name="'.$this->get_field_name('liste').'">
       <option value="'.$data['liste'].'" selected="selected">'.sm_liste_title_bd($data['liste']).'</option>';    
	     $table_liste = $wpdb->prefix.'sm_liste'; 
         $fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_liste."`");
         foreach ( $fivesdrafts as $fivesdraft ) 
          {
		echo '<option value="'.$fivesdraft->liste_bd.'">'.$fivesdraft->liste_nom.'</option>';	 
          }
		 echo '</select></td></tr></table><br> ';
} 
}

function widget_sm(){    
register_widget("class_widget_sm");
}
add_action("widgets_init", "widget_sm");
?>
