<?php
set_time_limit(0);
?>
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
<?php _e("Liste de diffusion","e-mailing-service");?>
 </h2>
                </div>
         </div>
                 <section id="content">
            <div class="wrapper">                <section class="columns">                    

        <?php echo "<p>".__("La liste de diffusion sert a classer les emails de vos clients par categories","e-mailing-service")."</p>";?>
                    
                    <hr />
                    
                    <div class="grid_8">
     
<?php
if(isset($action)){

	if($action =="update"){
$wpdb -> query("UPDATE `$table_options`  SET  `option_value`='$sm_from' WHERE `option_name`='sm_from'");
echo "<br><br><div class=\"alert\">";
_e("Vos informations ont bien ete mis a jour","e-mailing-service");
echo "<br><br></div>";
	}
	elseif($action =="add"){
_e("Votre liste $liste a bien ete ajoute","e-mailing-service");
$liste=nettoie($liste);
$table_name = $wpdb->prefix.'sm_liste_'.$user_id.'_'.$liste.'';
$wpdb->insert($table_liste, array(  
            'liste_bd' => $table_name,  
            'liste_nom' => $liste,
			'champs1' => $champs1,
			'champs2' => $champs2,
			'champs3' => $champs3,
			'champs4' => $champs4,
			'champs5' => $champs5,
			'champs6' => $champs6,
			'champs7' => $champs7,
			'champs8' => $champs8,
			'champs9' => $champs9,
			'login' => $user_login,
       ));
 $wpdb->query("  
   CREATE TABLE IF NOT EXISTS `$table_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL DEFAULT '',
  `nom` varchar(250) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `lg` varchar(250) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `valide` enum('1','0') NOT NULL DEFAULT '1' COMMENT 'Si le client c''est desinscrit la valeur est 0',
  `bounces` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'Si l ''email n''est plus correct la valeur passe Ã  0',
  `optin` enum('0','1') NOT NULL DEFAULT '0',
  `champs1` varchar(250) NOT NULL,
  `champs2` varchar(250) NOT NULL,
  `champs3` varchar(250) NOT NULL,
  `champs4` varchar(250) NOT NULL,
  `champs5` varchar(250) NOT NULL,
  `champs6` varchar(250) NOT NULL,
  `champs7` varchar(250) NOT NULL,
  `champs8` varchar(250) NOT NULL,
  `champs9` varchar(250) NOT NULL,
  `cle` varchar(250) NOT NULL DEFAULT 'Hysmqponisgz564',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `valide` (`valide`),
  KEY `bounces` (`bounces`),
  KEY `cle` (`cle`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=0 AUTO_INCREMENT=0 ;");  
	}
	elseif($action =="division"){
	echo "<br><br><h2>".__('Diviser votre liste en plusieurs listes',"e-mailing-service")."</h2>";  	
echo '<form action="admin.php?page=e-mailing-service/admin/listes.php" method="post" target="_parent">
<input type="hidden" name="table_original_id" value="'.$liste_id.'" />
<input type="hidden" name="table_original" value="'.$liste.'" />
<input type="hidden" name="nb_total" value="'.$nbm.'" />
<input type="hidden" name="action" value="division_add" />
<p> '.__("Nombre de listes ?","e-mailing-service").'
 <input type="text" name="nb_liste" value="2" />
</p>
<p> '.__("prefix de la liste","e-mailing-service").'
 <input type="text" name="pfix" value="news" />
</p>
<input value="'.__("Valider","e-mailing-service").'" type="submit" />
</fom>';
	}
	elseif($action =="division_add"){
_e("Nombre par liste","e-mailing-service");
$limit_liste=ceil($nb_total/$nb_liste); 
echo "".$limit_liste." <br>";
for($i=0;$i<$nb_liste;$i++){
$liste=nettoie(''.$pfix.'_'.$i.'');
$table_name = $wpdb->prefix.'sm_liste_'.$liste.'';
	$wpdb->query("INSERT IGNORE INTO  `".$table_liste."` (liste_bd ,liste_nom,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9) SELECT '".$table_name ."','".$liste."',champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9 FROM `".$table_liste."` WHERE id='".$table_original_id."'",true);
 $wpdb->query("  
   CREATE TABLE IF NOT EXISTS `$table_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL DEFAULT '',
  `nom` varchar(250) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `lg` varchar(250) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `valide` enum('1','0') NOT NULL DEFAULT '1' COMMENT 'Si le client c''est desinscrit la valeur est 0',
  `bounces` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'Si l ''email n''est plus correct la valeur passe Ã  0',
  `optin` enum('0','1') NOT NULL DEFAULT '0',
  `champs1` varchar(250) NOT NULL,
  `champs2` varchar(250) NOT NULL,
  `champs3` varchar(250) NOT NULL,
  `champs4` varchar(250) NOT NULL,
  `champs5` varchar(250) NOT NULL,
  `champs6` varchar(250) NOT NULL,
  `champs7` varchar(250) NOT NULL,
  `champs8` varchar(250) NOT NULL,
  `champs9` varchar(250) NOT NULL,
  `cle` varchar(250) NOT NULL DEFAULT 'Hysmqponisgz564',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `valide` (`valide`),
  KEY `bounces` (`bounces`),
  KEY `cle` (`cle`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=0 AUTO_INCREMENT=0 ;");  
if($i==0){
$debut = 0;	
}
	$wpdb->query("INSERT IGNORE INTO `".$table_name."` (id,email,nom,ip,lg,date_creation,valide,bounces,optin,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,cle) SELECT id,email,nom,ip,lg,date_creation,valide,bounces,optin,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,cle FROM `".$table_original."` LIMIT $debut,$limit_liste",true);
	$debut = $limit_liste + $debut;
	}
	}
	elseif($action =="truncate"){
	echo "<br><br><h2>".__('Vider la liste',"e-mailing-service")."</h2>";  	
	echo '<form action="admin.php?page=e-mailing-service/admin/listes.php" method="post" target="_parent">
	<input type="hidden" name="liste" value="'.$liste.'" />
<input type="hidden" name="action" value="valide_truncate" />
<p> '.__("Voulez vous vraiment vider votre liste ?","e-mailing-service").'
  <label>
    <input type="radio" name="val_trunc" value="oui" id="val_trunc_0" />'.__("oui","e-mailing-service").'</label>
  <label>
    <input type="radio" name="val_trunc" value="non" id="val_trunc_1" checked/>'.__("non","e-mailing-service").'</label>
  <br />
</p><input value="'.__("Vider","e-mailing-service").'" type="submit" />
</fom>';
	}
	elseif($action =="valide_truncate"){
	if($val_trunc=="oui"){
	$sql = "TRUNCATE ".$liste.""; 
	echo '<br><br><h2>'.__("Votre liste a bien ete vide","e-mailing-service").'</h2>';
    $result = $wpdb->query($wpdb->prepare($sql,true)); 	
	} else {
	echo '<meta http-equiv="refresh" content="0; url=admin.php?page=e-mailing-service/admin/listes.php">';	
	}
	}
	elseif($action =="rename"){
	 echo "<br><br><h2>".__("Modifier les champs de votre liste","e-mailing-service")."</h2>";  	
	echo '<form action="admin.php?page=e-mailing-service/admin/listes.php" method="post" target="_parent">
	<input type="hidden" name="liste" value="'.$liste.'" />
<input type="hidden" name="action" value="update_name" />';
	$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_liste."` WHERE liste_bd ='".$liste."' and login='".$user_login."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
	
echo '<table>
<tr><td>Nom de la liste : </td><td><input name="liste_nom" type="text" value="'.$fivesdraft->liste_nom.'"/></td></tr>
<tr><td>Nom du premier champs : </td><td>'.__("Email","e-mailing-service").'</td></tr>
<tr><td>Nom du deuxieme champs : </td><td>'.__("Nom","e-mailing-service").'</td></tr>
<tr><td>Nom du troisieme champs : </td><td>'.__("IP","e-mailing-service").'</td></tr>
<tr><td>Nom du quatrieme champs : </td><td><input name="champs1" type="text" value="'.$fivesdraft->champs1.'"/></td></tr>
<tr><td>Nom du cinquieme champs : </td><td><input name="champs2" type="text" value="'.$fivesdraft->champs2.'"/></td></tr>
<tr><td>Nom du sixieme champs :  </td><td><input name="champs3" type="text" value="'.$fivesdraft->champs3.'"/></td></tr>
<tr><td>Nom du septieme champs :  </td><td><input name="champs4" type="text"value="'.$fivesdraft->champs4.'"/></td></tr>
<tr><td>Nom du huitime champs :  </td><td><input name="champs5" type="text" value="'.$fivesdraft->champs5.'"/></td></tr>
<tr><td>Nom du neuvieme champs :  </td><td><input name="champs6" type="text" value="'.$fivesdraft->champs6.'"/></td></tr>
<tr><td>Nom du dixieme champs : </td><td><input name="champs7" type="text" value="'.$fivesdraft->champs7.'"/></td></tr>
<tr><td>Nom du onzieme champs :  </td><td><input name="champs8" type="text" value="'.$fivesdraft->champs8.'"/></td></tr>
<tr><td>Nom du douzieme champs : </td><td><input name="champs9" type="text" value="'.$fivesdraft->champs9.'"/></td></tr>';
	}
echo '<tr><td></td><td><input value="'.__("Modifier les champs de votre liste","e-mailing-service").'" type="submit" /></td></tr>

</table>
</form>';
	
	}
	elseif($action =="update_name"){
    $wpdb->update( 
	$table_liste, 
	array( 
	        'liste_nom' => $liste_nom,
			'champs1' => $champs1,
			'champs2' => $champs2,
			'champs3' => $champs3,
			'champs4' => $champs4,
			'champs5' => $champs5,
			'champs6' => $champs6,
			'champs7' => $champs7,
			'champs8' => $champs8,
			'champs9' => $champs9
	), 
	array( 'liste_bd' => $liste ));
	echo '<br><br>'.__("Votre liste a bien ete modifie","e-mailing-service").'';
    echo '<meta http-equiv="refresh" content="0; url=admin.php?page=e-mailing-service/admin/listes.php">';
	}
	///////////// ajout d'email /////////////////
	
	elseif($action =="add_ajout_unique"){
      if(!isset($champs1)){ $champs1=""; }
	  if(!isset($champs2)){ $champs2=""; }
	  if(!isset($champs3)){ $champs3=""; }
	  if(!isset($champs4)){ $champs4=""; }
	  if(!isset($champs5)){ $champs5=""; }
	  if(!isset($champs6)){ $champs6=""; }
	  if(!isset($champs7)){ $champs7=""; }
	  if(!isset($champs8)){ $champs8=""; }
	  if(!isset($champs9)){ $champs9=""; }
       $wpdb->insert($liste, array(  
            'email' => $email,  
            'nom' => $nom,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'lg' => $_SERVER['HTTP_ACCEPT_LANGUAGE'] ,
            'date_creation' => current_time('mysql'),
			'champs1' => $champs1,
			'champs2' => $champs2,
			'champs3' => $champs3,
			'champs4' => $champs4,
			'champs5' => $champs5,
			'champs6' => $champs6,
			'champs7' => $champs7,
			'champs8' => $champs8,
			'champs9' => $champs9,
			'cle' => key_generate()
			  
       ));
	 echo "<br><br><h2>".__("L'email $email a bien ete ajoute","e-mailing-service")."</h2>";  
    }
	elseif($action =="search"){
    $fivesdrafts = $wpdb->get_results("SELECT liste_bd FROM `".$table_liste."` WHERE login='".$user_login."'");
    foreach ( $fivesdrafts as $fivesdraft ) 
    {
	$res=sm_search_bd($fivesdraft->liste_bd,$email);
	if($res != ''){
		list($id,$mails)=explode('|',$res);
	echo "<table><tr><td>".$mails."</td><td><a href=\"?page=e-mailing-service/admin/emails.php&liste=".$fivesdraft->liste_bd."&emailid=".$id."&action=update\" target=\"_parent\">
	 <img src=\"".smURL."/img/profile.png\" width=\"32\" height=\"32\" border=\"0\" title=\"".__("Voir la fiche complete","e-mailing-service")."\"/></a></td></tr></table><br>";	
	}
	}
		exit();
	 echo "<br><br><h2>".__("L'email $email a bien ete ajoute","e-mailing-service")."</h2>";  
    }
	elseif($action=="ajout"){
echo '<h2>'.__("Ajouter un email a votre liste","e-mailing-service").'</h2>';
$i=0;
echo '<form action="admin.php?page=e-mailing-service/admin/listes.php&liste='.$liste.'" name="form_bdd" id="form_bdd" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="add_ajout_unique">';
$tbaleau_insert ='<table class="widefat">
                         <thead><tr>';
$tbaleau_insert .="<th>".__("Email","e-mailing-service")."</th>";
$tbaleau_insert .="<th>".__("Nom","e-mailing-service")."</th>";
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_liste."` WHERE liste_bd ='".$liste."' and login='".$user_login."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
	if($fivesdraft->champs1 !=''){
$tbaleau_insert .="<th>".$fivesdraft->champs1."</th>";
	}
	if($fivesdraft->champs2 !=''){
$tbaleau_insert .="<th>".$fivesdraft->champs2."</th>";
	}if($fivesdraft->champs3 !=''){
$tbaleau_insert .="<th>".$fivesdraft->champs3."</th>";
}if($fivesdraft->champs4 !=''){
$tbaleau_insert .="<th>".$fivesdraft->champs4."</th>";
}if($fivesdraft->champs5 !=''){
$tbaleau_insert .="<th>".$fivesdraft->champs5."</th>";
}if($fivesdraft->champs6 !=''){
$tbaleau_insert .="<th>".$fivesdraft->champs6."</th>";
}if($fivesdraft->champs7 !=''){
$tbaleau_insert .="<th>".$fivesdraft->champs7."</th>";
}if($fivesdraft->champs8 !=''){
$tbaleau_insert .="<th>".$fivesdraft->champs8."</th>";
}if($fivesdraft->champs9 !=''){
$tbaleau_insert .="<th>".$fivesdraft->champs9."</th>";
}
$tbaleau_insert .="</tr><tr></thead><tdbody>";
$tbaleau_insert .="<td><input name=\"email\" type=\"text\" /></td>";
$tbaleau_insert .="<td><input name=\"nom\" type=\"text\" /></td>";
	if($fivesdraft->champs1 !=''){
$tbaleau_insert .="<td><input name=\"champs1\" type=\"text\" /></td>";
	}
	if($fivesdraft->champs2 !=''){
$tbaleau_insert .="<td><input name=\"champs2\" type=\"text\" /></td>";
	}if($fivesdraft->champs3 !=''){
$tbaleau_insert .="<td><input name=\"champs3\" type=\"text\" /></td>";
}if($fivesdraft->champs4 !=''){
$tbaleau_insert .="<td><input name=\"champs4\" type=\"text\" /></td>";
}if($fivesdraft->champs5 !=''){
$tbaleau_insert .="<td><input name=\"champs5\" type=\"text\" /></td>";
}if($fivesdraft->champs6 !=''){
$tbaleau_insert .="<td><input name=\"champs6\" type=\"text\" /></td>";
}if($fivesdraft->champs7 !=''){
$tbaleau_insert .="<td><input name=\"champs7\" type=\"text\" /></td>";
}if($fivesdraft->champs8 !=''){
$tbaleau_insert .="<td><input name=\"champs8\" type=\"text\" /></td>";
}if($fivesdraft->champs9 !=''){
$tbaleau_insert .="<td><input name=\"champs9\" type=\"text\" /></td>";
}
$i++;
     }
$tbaleau_insert .="</tr></tdbody>
</table>
<input type=\"submit\" value=\"".__("Ajouter","e-mailing-service")."\"> 
</form>
";	
if($i !=0){	
echo $tbaleau_insert;
} else {
echo __("Vous n'avez pas encore creer une liste de detinataire, vous devez en premier creer une liste afin d'ajouter des emails","e-mailing-service");
}
if($i !=0){	
echo "<br><br>";
$tab_champs ='';
$tab_champs .="<option value=\"null\">".__("null","e-mailing-service")."</option>";
$tab_champs .="<option value=\"email\">".__("Email","e-mailing-service")."</option>";
$tab_champs .="<option value=\"nom\">".__("Nom","e-mailing-service")."</option>";
$tab_champs .="<option value=\ip\">".__("IP","e-mailing-service")."</option>";
$tab_champs .="<option value=\lg\">".__("lg","e-mailing-service")."</option>";

$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_liste."` WHERE liste_bd ='".$liste."' and login='".$user_login."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{

	if($fivesdraft->champs1 !=''){
$tab_champs .="<option value=\"champs1\">".$fivesdraft->champs1."</option>";
	}
	if($fivesdraft->champs2 !=''){
$tab_champs .="<option value=\"champs2\">".$fivesdraft->champs2."</option>";
	}if($fivesdraft->champs3 !=''){
$tab_champs .="<option value=\"champs3\">".$fivesdraft->champs3."</option>";
}if($fivesdraft->champs4 !=''){
$tab_champs .="<option value=\"champs4\">".$fivesdraft->champs4."</option>";
}if($fivesdraft->champs5 !=''){
$tab_champs .="<option value=\"champs5\">".$fivesdraft->champs5."</option>";
}if($fivesdraft->champs6 !=''){
$tab_champs .="<option value=\"champs6\">".$fivesdraft->champs6."</option>";
}if($fivesdraft->champs7 !=''){
$tab_champs .="<option value=\"champs7\">".$fivesdraft->champs7."</option>";
}if($fivesdraft->champs8 !=''){
$tab_champs .="<option value=\"champs8\">".$fivesdraft->champs8."</option>";
}if($fivesdraft->champs9 !=''){
$tab_champs .="<option value=\"champs9\">".$fivesdraft->champs9."</option>";
}

     }
//$tab_champs .='</select>';
echo '<h2>'.__("Ajouter plusieurs emails a votre liste","e-mailing-service").'</h2>';
echo '<h3>'.__("Copier vos emails dans le formulaire , 1 email par ligne : ","e-mailing-service").'</h3>
<form action="admin.php?page=e-mailing-service/admin/listes.php&liste='.$liste.'" name="form_bdd" id="form_bdd" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="add_ajout_tab">
<p><textarea name="tab" cols="150" rows="30">
email@fai.com;dupond;
email2@fai.com;durand;</textarea>
<br />
D&eacute;limiteur : <select name="del">
<option value=";" selected>; Point virgule</option>
<option value=",">, Virgule</option>
<option value=":">: Deux points</option>
<option value="|">| Barre</option>
<option value="#"># Di&egrave;se</option>
</select>
</p>';?>

<?php _e("Correspondance des champs dans votre votre formulaire","e-mailing-service");?>
<table>
<tr>
<td><select name="col1"><option value="email" selected>email</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col2"><option value="nom" selected>nom</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col3"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col4"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col5"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col6"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col7"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col8"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col9"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col10"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col11"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col12"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
</tr>
</table>
<?php echo '<p>
<input type="submit" value="'.__("Importer les emails","e-mailing-service").'"> 
</p>';	
	}
	}
	elseif($action =="add_ajout_tab"){
$champs="";
if($col1 !='null'){
$champs .=trim("$col1");	
}
if($col2 !='null'){
$champs .=",".trim("$col2")."";		
}
elseif($col3 !='null'){
$champs .=",".trim("$col3")."";		
}
elseif($col4 !='null'){
$champs .=",".trim("$col4")."";		
}
elseif($col5 !='null'){
$champs .=",".trim("$col5")."";		
}
elseif($col6 !='null'){
$champs .=",".trim("$col6")."";		
}
elseif($col7 !='null'){
$champs .=",".trim("$col7")."";		
}
elseif($col8 !='null'){
$champs .=",".trim("$col8")."";	
}
elseif($col9 !='null'){
$champs .=",".trim("$col9")."";	
}
elseif($col10 !='null'){
$champs .=",".trim("$col10")."";		
}
elseif($col11 !='null'){
$champs .=",".trim("$col11")."";		
}
elseif($col12 !='null'){
$champs .=",".trim("$col12")."";		
}
$dossier_fichier=smPOST;
if(!is_dir(''.smPOST.'')){
mkdir(''.smPOST.'', 0777);
		   }
$aleas=rand(0,99999999);

$filename = ''.$dossier_fichier.'import_'.$aleas.'.txt';
$inF = fopen($filename,"w+");
fwrite($inF,$tab);
fclose($inF);
@chmod(0777,$filename);
$wpdb->query( "SHOW GLOBAL VARIABLES LIKE 'local_infile';");
$wpdb->query( "SET GLOBAL local_infile = 'ON';");
$wpdb->query( "SHOW GLOBAL VARIABLES LIKE 'local_infile';");
		
$requette ="LOAD DATA LOCAL INFILE '$filename' IGNORE INTO TABLE  `".$liste."`  FIELDS TERMINATED BY '".$del."' ENCLOSED BY '\"' LINES TERMINATED BY '\\n'  (
$champs 
)";

$resultat = $wpdb->query($requette);
$sql_liste = $wpdb->get_results("SELECT id FROM `$liste` WHERE `cle` like 'Hysmqponisgz564'" ) or die("erreur ligne ".__line__." ".mysql_error()."");
foreach ( $sql_liste as $req_liste ) 
{
$wpdb->query("UPDATE `".$liste."` SET `cle` ='".key_generate()."' WHERE id='".$req_liste->id."'");
}
unlink("".$filename."");
echo '<br><br><br><span style="color:#00f"><b>'.__("Vos emails ont ete importe","e-mailing-service").'</b></span>';			
	}
	
	///////////// import d'email /////////////////
	elseif($action=="import"){
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_liste."` WHERE liste_bd ='".$liste."' and login='".$user_login."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
	$nomliste=$fivesdraft->liste_nom;
}
echo "<h1>".__("Importation d'email dans votre liste","e-mailing-service")." ".$nomliste."</h1>";
$dossier_fichier=smPOST;
if($user_role =='administrator'){
echo "<h3>".__("Attention de verifier que le dossier","e-mailing-service")." ".$dossier_fichier." ".__("est les droits  (CHMOD a 0777)","e-mailing-service")."</h3>";
}



function ajouter($bd_table, $str_champs_valeurs){
	$i=0;
	$champs="";
	$valeurs="";
	
	$resultat = split("#", $str_champs_valeurs); 	
	
	for ($i = 0; $i<sizeof($resultat); $i++){  		
		$pos=strpos($resultat[$i],"=") ;			
		$champs.=substr($resultat[$i], 0, $pos) . ", "; 
		$valeurs.="'".substr($resultat[$i], $pos+1,strlen($resultat[$i])- $pos+1 )."', "; 
	}

	$champs=substr($champs,0,sizeof($valeurs)-3); 	
	$valeurs=substr($valeurs,0,sizeof($valeurs)-3);	
	
	$str_query="INSERT IGNORE INTO ".$bd_table."(".$champs.") VALUES (".$valeurs.")"; 
	$resultat = requette($str_query ,0,$id_bd);						
	 
	return $resultat;
}


function verif_exist($table, $champ, $exist){			
	$resultat = mysql_query("select * from ".$table_liste." where ".$champ." ='".$exist."'  and login='".$user_login."'")or die('Erreur SQL : '.__LINE__.' '.mysql_error());
	$nb_result_e = mysql_num_rows($resultat);
	if ($nb_result_e > 0){
		return 1;
	}else {
		return 0;
	}
}



?>
<h2><?php _e("Preparation du fichier","e-mailing-service");?> : </h2>
<p><?php _e("Fichier .csv ou fichier .txt","e-mailing-service");?> <?php _e("Poid maximum du fichier","e-mailing-service");?> : <?php echo ini_get('upload_max_filesize');?> </p>
<form action="<?php $_SERVER['PHP_SELF'];?>" name="form_bdd" id="form_bdd" method="post" enctype="multipart/form-data">
<input type="hidden" name="table" value="<?php echo $liste;?>">
<p style="font-weight:bold">&nbsp;</p>

<p><input type="file" name="fichiercsv" size="16">
D&eacute;limiteur : <select name="del">
<option value=";" selected>; <?php _e("Point virgule","e-mailing-service");?></option>
<option value=",">, <?php _e("Virgule","e-mailing-service");?></option>
<option value=":">: <?php _e("Deux points","e-mailing-service");?></option>
<option value="|">| <?php _e("Barre","e-mailing-service");?></option>
<option value="#"># <?php _e("Diese","e-mailing-service");?></option>
</select>
</p>

<p>
<input type="hidden" name="action" value="import">
<input type="hidden" name="etape" value="2">
<input type="submit" value="<?php _e("Importer le fichier","e-mailing-service");?>"> 
</p>
</form>

<?php 
if(isset($etape)){
if($etape == 2){
?>
<form action="<?php $_SERVER['PHP_SELF'];?>" name="action" id="form_import" method="post">
<?php
$content_dir = $dossier_fichier;
$tmp_file = $_FILES['fichiercsv']['tmp_name'];
$type_file = $_FILES['fichiercsv']['type'];
$name_file = $_FILES['fichiercsv']['name'];
list($nomf,$extension)=explode(".",$name_file);
$extensions_valides = array( 'csv' , 'txt');
if ( in_array($extension,$extensions_valides) ){
      if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
       {
           _e("Impossible de copier le fichier dans $content_dir, verifier les droits ou l'espace disque de votre serveur","e-mailing-service");
       }
       ?>
<p><?php _e("Le fichier");?>  <span style="color:#00f"><strong><?php echo '<a href="'.$content_dir.'/'.$name_file.'">'.$name_file.'</a>'?></strong></span> <?php _e("a bien ete uploade","e-mailing-service");?></p>
       <?php

} else {
?>
<p style="color:red;font-weight:bold"><?php _e("Extension incorrecte (votre fichier se termine par","e-mailing-service");?> <?php echo $extension;?>, <?php _e("vous pouvez seulement uploader des fichier se terminant par <strong>.csv ou .txt. ","e-mailing-service");?></strong></p>
<?php
}
?>
<table width ="950" cellspacing="0" cellpadding="4" border="0" style="font-family:courier new;font-size:12px" align="center">
<tr>
<td colspan="3">
<form action="<?php $_SERVER['PHP_SELF'];?>" name="action" id="form_import" method="post">
<input type="hidden" name="etape" value="3">
<input type="hidden" name="action" value="import">
<input type="hidden" name="content_dir" value="<?php echo $content_dir ; ?>">
<input type="hidden" name="name_file" value="<?php echo $name_file ; ?>">

<?php
$tab_champs ='';
$tab_champs .="<option value=\"null\">".__("null","e-mailing-service")."</option>";
$tab_champs .="<option value=\"email\">".__("Email","e-mailing-service")."</option>";
$tab_champs .="<option value=\"nom\">".__("Nom","e-mailing-service")."</option>";
$tab_champs .="<option value=\"ip\">".__("IP","e-mailing-service")."</option>";
$tab_champs .="<option value=\"lg\">".__("lg","e-mailing-service")."</option>";
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_liste."` WHERE liste_bd ='".$liste."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
	if($fivesdraft->champs1 !=''){
$tab_champs .="<option value=\"champs1\">".$fivesdraft->champs1."</option>";
	}
	if($fivesdraft->champs2 !=''){
$tab_champs .="<option value=\"champs2\">".$fivesdraft->champs2."</option>";
	}if($fivesdraft->champs3 !=''){
$tab_champs .="<option value=\"champs3\">".$fivesdraft->champs3."</option>";
}if($fivesdraft->champs4 !=''){
$tab_champs .="<option value=\"champs4\">".$fivesdraft->champs4."</option>";
}if($fivesdraft->champs5 !=''){
$tab_champs .="<option value=\"champs5\">".$fivesdraft->champs5."</option>";
}if($fivesdraft->champs6 !=''){
$tab_champs .="<option value=\"champs6\">".$fivesdraft->champs6."</option>";
}if($fivesdraft->champs7 !=''){
$tab_champs .="<option value=\"champs7\">".$fivesdraft->champs7."</option>";
}if($fivesdraft->champs8 !=''){
$tab_champs .="<option value=\"champs8\">".$fivesdraft->champs8."</option>";
}if($fivesdraft->champs9 !=''){
$tab_champs .="<option value=\"champs9\">".$fivesdraft->champs9."</option>";
}
     }
//$tab_champs .='</select>';
?>
<p><?php _e("Votre fichier doit contenir , le champs email obligatoirement , pour le reste choisissez si vous souhaite le nombre de colonne et l'ordre</p>
Exemple de fichier :  email@fai.com;dupond;","e-mailing-service");?><br />

<table>
<tr>
<td><select name="col1"><option value="email" selected>email</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col2"><option value="nom" selected>nom</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col3"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col4"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col5"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col6"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col7"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col8"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col9"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col10"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col11"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
<td><select name="col12"><option value="null" selected>null</option><?php echo $tab_champs;?></select>;</td>
</tr>
</table>
<input type="hidden" name="del" value="<?php echo $del ; ?>">
<input type="hidden" name="nb_colones_csv" value="<?php echo count($tabcsv)-1 ; ?>">
<input type="submit"  value ="Terminer maintenant l'import de vos emails dans votre base de donnee">
</td>
</tr>
</table>
</form> 
<?php } 
	elseif($etape == 3){
$champs="";
if($col1 !='null'){
$champs .="$col1";	
}
if($col2 !='null'){
$champs .=",$col2";	
}
if($col3 !='null'){
$champs .=",$col3";	
}
if($col4 !='null'){
$champs .=",$col4";	
}
if($col5 !='null'){
$champs .=",$col5";	
}
if($col6 !='null'){
$champs .=",$col6";	
}
if($col7 !='null'){
$champs .=",$col7";	
}
if($col8 !='null'){
$champs .=",$col8";	
}
if($col9 !='null'){
$champs .=",$col9";	
}
if($col10 !='null'){
$champs .=",$col10";	
}
if($col11 !='null'){
$champs .=",$col11";	
}
if($col12 !='null'){
$champs .=",$col12";	
}
if(!file_exists("$content_dir$name_file")){
echo '<br><br><br><span style="color:#00f"><b>'.__("Votre fichier n'exite pas , verifier le chmod  0777 sur le dossier","e-mailing-service").' '.smPOST.'</b></span>';	
} else {
$wpdb->query( "SHOW GLOBAL VARIABLES LIKE 'local_infile';");
$wpdb->query( "SET GLOBAL local_infile = 'ON';");
$wpdb->query( "SHOW GLOBAL VARIABLES LIKE 'local_infile';");

$requette ="LOAD DATA LOCAL INFILE '$content_dir$name_file' IGNORE INTO TABLE  `".$liste."`  FIELDS TERMINATED BY '".$del."' ENCLOSED BY '\"' LINES TERMINATED BY '\\n'  (
$champs 
) ";
$resultat = $wpdb->query($requette);
$sql_liste = $wpdb->get_results("SELECT id FROM `$liste` WHERE `cle` like 'Hysmqponisgz564'" ) or die("erreur ligne ".__line__." ".mysql_error()."");
foreach ( $sql_liste as $req_liste ) 
{
$wpdb->query("UPDATE `".$liste."` SET `cle` ='".key_generate()."' WHERE id='".$req_liste->id."'");
}
unlink("".$content_dir."".$name_file."");
echo '<br><br><br><span style="color:#00f"><b>'.__("Vos emails ont ete importe","e-mailing-service").'</b></span>';
}
			}
}

	}
} else {
echo '<div class="message warning"><form action="admin.php?page=e-mailing-service/admin/listes.php" method="post" target="_parent">
<input type="hidden" name="action" value="search" />';
echo ''.__('Search email','e-mailing-service').' : <input type="text" name="email" value="@"/> <input name="submit" type="submit" class="button button-blue" value="'.__("search","e-mailing-service").'"/>';
echo '</form></div>';
echo '<div class="message info">
<table class="paginate10 sortable full">
<thead>';
echo "<tr>
<th>".__("Liste","e-mailing-service")."</th>
<th>".__("Emails","e-mailing-service")."</th>
<th><a href=\"#\" title=\"".__("Une adresse courriel Opt-In active a fait l'objet d'un consentement prealable par une validation par clic","e-mailing-service")."\">".__("Opt-in","e-mailing-service")."</a></th>
<th>".__("Desinscrits","e-mailing-service")."</th>
<th>".__("Invalide","e-mailing-service")."</th>";
if($user_role == 'administrator' ){
echo "<th>".__("Login","e-mailing-service")."</th>";	
}
echo "<th>".__("Action","e-mailing-service")."</th>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
</tr> </thead>
        <tbody>";
if ( !is_super_admin() ) {
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_liste."` WHERE login='".$user_login."' AND type='perso'");
} else {
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_liste."`");	
}
foreach ( $fivesdrafts as $fivesdraft ) 
{
	$bdl=$fivesdraft->liste_bd;
	 echo "<tr><td>".$fivesdraft->liste_nom."</td>";
	$user_count = $wpdb->get_results("SELECT COUNT(id) AS total FROM ".$bdl."" ) or die("erreur ligne ".__line__." ".mysql_error()."");
	foreach ( $user_count as $user_count ) 
     { 
	 	 echo "<td>".$user_count->total."</td>";

	 }
	 	$optin_counts = $wpdb->get_results("SELECT COUNT(id) AS total FROM ".$bdl." WHERE optin='1'" ) or die("erreur ligne ".__line__." ".mysql_error()."");
	foreach ( $optin_counts as $optin_count ) 
     { 
	 	 echo "<td>".$optin_count->total."</td>";

	 }
	 	$invalid_count = $wpdb->get_results("SELECT COUNT(id) AS total2 FROM ".$bdl." WHERE valide='0'" ) or die("erreur ligne ".__line__." ".mysql_error()."");
	foreach ( $invalid_count as $invalid_count ) 
     { 
	 echo "<td>".$invalid_count ->total2."</td>";

	 }
	 	 	$bounces_count = $wpdb->get_results("SELECT COUNT(id) AS total3 FROM ".$bdl." WHERE bounces='0'" ) or die("erreur ligne ".__line__." ".mysql_error()."");
	foreach ( $bounces_count as $bounces_count ) 
     { 
	 echo "<td>".$bounces_count ->total3."</td>";

	 }
     if($user_role == 'administrator' ){
	 echo '<td>'.$fivesdraft->login.'</td>'; }
	 echo "
	 <td><a href=\"admin.php?page=e-mailing-service/admin/emails.php&liste=".$fivesdraft->liste_bd."\" target=\"_parent\"><img src=\"".smURL."img/search.png\" width=\"32\" height=\"32\" border=\"0\" title=\"".__("Details","e-mailing-service")."\"/></a></td>
	 <td><a href=\"admin.php?page=e-mailing-service/admin/listes.php&liste=".$fivesdraft->liste_bd."&action=ajout\" target=\"_parent\"><img src=\"".smURL."img/doc_add.png\" width=\"32\" height=\"32\" border=\"0\" title=\"".__("Ajouter des emails","e-mailing-service")."\"/></a></td>
	 <td><a href=\"admin.php?page=e-mailing-service/admin/listes.php&liste=".$fivesdraft->liste_bd."&action=import\" target=\"_parent\"><img src=\"".smURL."img/doc_add.png\" width=\"32\" height=\"32\" border=\"0\" title=\"".__("Importer des emails","e-mailing-service")."\"/></a></td>
	 <td><a href=\"admin.php?page=e-mailing-service/admin/listes.php&liste=".$fivesdraft->liste_bd."&action=rename\" target=\"_parent\"><img src=\"".smURL."img/doc_edit.png\" width=\"32\" height=\"32\" border=\"0\" title=\"".__("Modifier la liste","e-mailing-service")."\" /></a></td>
	 <td><a href=\"admin.php?page=e-mailing-service/admin/listes.php&liste=".$fivesdraft->liste_bd."&action=truncate\" target=\"_parent\"><img src=\"".smURL."img/doc_delete.png\" width=\"32\" height=\"32\" border=\"0\" title=\"".__("Vider la liste","e-mailing-service")."\"/></a></td>
	 <td><a href=\"".smURL."include/export.php?liste=".$fivesdraft->liste_bd."&action=export&format=csv\" target=\"_parent\"><img src=\"".smURL."img/csv.png\" width=\"32\" height=\"32\" border=\"0\" title=\"".__("Exporter vos emails en fichier","e-mailing-service")." .csv\"/></a></td>
	<td><a href=\"".smURL."include/export.php?liste=".$fivesdraft->liste_bd."&action=export&format=xls\" target=\"_parent\"><img src=\"".smURL."img/xls.png\" width=\"32\" height=\"32\" border=\"0\" title=\"".__("Exporter vos emails en fichier","e-mailing-service")." .xls\"/></a></td>
	<td><a href=\"admin.php?page=e-mailing-service/admin/listes.php&liste=".$fivesdraft->liste_bd."&liste_id=".$fivesdraft->id."&nbm=".$user_count->total."&action=division\" target=\"_parent\"><img src=\"".smURL."division.png\" width=\"32\" height=\"32\" border=\"0\" title=\"".__("Diviser votre liste en plusieurs listes","e-mailing-service")."\"/></a></td>
	 ";
	 echo "</tr>";
}
echo "</tbody></table></div>";

if(get_option('sm_location')=='yes'){
	echo '<div class="grid_8">';
echo '<table class="widefat">
                         <thead>';
echo "<tr><td><b>".__("Nom de votre liste","e-mailing-service")."</b></td>
<td><b>".__("Nb d'emails","e-mailing-service")."</b></td>
<td><b>".__("Description","e-mailing-service")."</b></td>
<td><b>".__("Tarif","e-mailing-service")."</b></td>
</tr> </thead>
        <tbody>";

$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_liste."` WHERE type='location'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
	$bdl=$fivesdraft->liste_bd;
	 echo "<tr><td>".$fivesdraft->liste_nom."</td>";
	$user_count = $wpdb->get_results("SELECT COUNT(id) AS total FROM ".$bdl." WHERE valide='1' AND bounces='1'" ) or die("erreur ligne ".__line__." ".mysql_error()."");
	foreach ( $user_count as $user_count ) 
     { 
	 	 echo "<td>".$user_count->total."</td>";

	 }
	  echo "<td>".$fivesdraft->description."</td>";	
	  echo "<td>".$fivesdraft->tarif." EUR / ".__("email","e-mailing-service")."</td>";
	 echo "</tr>";
}
echo "</tdbody></table></div>";	
}
echo '<div class="message success"><h2>'.__("Creation d'une nouvelle liste de diffusion","e-mailing-service").'</h2>';
echo "<p>".__("Choisissez les noms de vos colonnes pour enregistrer vos abonnes","e-mailing-service")."</p>";
echo '<form action="admin.php?page=e-mailing-service/admin/listes.php" method="post" target="_parent">
<table width="50%">
                         <thead>
<tr><td>'.__("Nom de la liste","e-mailing-service").' : </td><td><input name="liste" type="text" /></td></tr>
<tr><td>'.__("Email","e-mailing-service").' : </td><td>'.__("Email","e-mailing-service").'</td></tr>
<tr><td>'.__("Nom","e-mailing-service").' : </td><td>'.__("Nom","e-mailing-service").'</td></tr>
<tr><td>'.__("IP","e-mailing-service").' : </td><td>'.__("IP","e-mailing-service").'</td></tr>
<tr><td>'.__("Champs","e-mailing-service").' 4 : </td><td><input name="champs1" type="text" value="'.__("Prenom","e-mailing-service").'"/></td></tr>
<tr><td>'.__("Champs","e-mailing-service").' 5 : </td><td><input name="champs2" type="text" value="'.__("Adresse","e-mailing-service").'"/></td></tr>
<tr><td>'.__("Champs","e-mailing-service").' 6 : </td><td><input name="champs3" type="text" value="'.__("CP","e-mailing-service").'"/></td></tr>
<tr><td>'.__("Champs","e-mailing-service").' 7 : </td><td><input name="champs4" type="text" value="'.__("Ville","e-mailing-service").'"/></td></tr>
<tr><td>'.__("Champs","e-mailing-service").' 8 : </td><td><input name="champs5" type="text" value="'.__("Pays","e-mailing-service").'"/></td></tr>
<tr><td>'.__("Champs","e-mailing-service").' 9 : </td><td><input name="champs6" type="text" value="'.__("societe","e-mailing-service").'"/></td></tr>
<tr><td>'.__("Champs","e-mailing-service").' 10 : </td><td><input name="champs7" type="text" value=""/></td></tr>
<tr><td>'.__("Champs","e-mailing-service").' 11 : </td><td><input name="champs8" type="text" value=""/></td></tr>
<tr><td>'.__("Champs","e-mailing-service").' 12 : </td><td><input name="champs9" type="text" value=""/></td></tr>
<tr><td><input name="Ajouter" type="submit" value="'.__("Ajouter","e-mailing-service").'" class="button button-green"/></td><td></td></tr>
<input type="hidden" name="action" value="add" />
</thead></table>
</form></div>';
}



?>
</div>
</section>
</div>
</section>
