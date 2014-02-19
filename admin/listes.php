<?php include(smPATH . '/include/entete.php');
extract($_POST);
extract($_GET);

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
$table_name = $wpdb->prefix.'sm_liste_'.$liste.'';
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
			'champs9' => $champs9
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
	$wpdb->query("INSERT IGNORE INTO `".$table_name."` (id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,cle) SELECT id,email,nom,ip,lg,date_creation,champs1,champs2,champs3,champs4,champs5,champs6,champs7,champs8,champs9,cle FROM `".$table_original."` LIMIT $debut,$limit_liste",true);
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
	$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_liste."` WHERE liste_bd ='".$liste."'");
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
	elseif($action=="ajout"){
echo '<h2>'.__("Ajouter un email a votre liste","e-mailing-service").'</h2>';
echo '<form action="admin.php?page=e-mailing-service/admin/listes.php&liste='.$liste.'" name="form_bdd" id="form_bdd" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="add_ajout_unique">';
$tbaleau_insert ='<table class="widefat">
                         <thead><tr>';
$tbaleau_insert .="<th><blockquote>".__("Email","e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__("Nom","e-mailing-service")."</blockquote></th>";
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_liste."` WHERE liste_bd ='".$liste."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
	if($fivesdraft->champs1 !=''){
$tbaleau_insert .="<th><blockquote>".$fivesdraft->champs1."</blockquote></th>";
	}
	if($fivesdraft->champs2 !=''){
$tbaleau_insert .="<th><blockquote>".$fivesdraft->champs2."</blockquote></th>";
	}if($fivesdraft->champs3 !=''){
$tbaleau_insert .="<th><blockquote>".$fivesdraft->champs3."</blockquote></th>";
}if($fivesdraft->champs4 !=''){
$tbaleau_insert .="<th><blockquote>".$fivesdraft->champs4."</blockquote></th>";
}if($fivesdraft->champs5 !=''){
$tbaleau_insert .="<th><blockquote>".$fivesdraft->champs5."</blockquote></th>";
}if($fivesdraft->champs6 !=''){
$tbaleau_insert .="<th><blockquote>".$fivesdraft->champs6."</blockquote></th>";
}if($fivesdraft->champs7 !=''){
$tbaleau_insert .="<th><blockquote>".$fivesdraft->champs7."</blockquote></th>";
}if($fivesdraft->champs8 !=''){
$tbaleau_insert .="<th><blockquote>".$fivesdraft->champs8."</blockquote></th>";
}if($fivesdraft->champs9 !=''){
$tbaleau_insert .="<th><blockquote>".$fivesdraft->champs9."</blockquote></th>";
}
$tbaleau_insert .="</tr><tr></thead><tdbody>";
$tbaleau_insert .="<td><blockquote><input name=\"email\" type=\"text\" /></blockquote></td>";
$tbaleau_insert .="<td><blockquote><input name=\"nom\" type=\"text\" /></blockquote></td>";
	if($fivesdraft->champs1 !=''){
$tbaleau_insert .="<td><blockquote><input name=\"champs1\" type=\"text\" /></blockquote></td>";
	}
	if($fivesdraft->champs2 !=''){
$tbaleau_insert .="<td><blockquote><input name=\"champs2\" type=\"text\" /></blockquote></td>";
	}if($fivesdraft->champs3 !=''){
$tbaleau_insert .="<td><blockquote><input name=\"champs3\" type=\"text\" /></blockquote></td>";
}if($fivesdraft->champs4 !=''){
$tbaleau_insert .="<td><blockquote><input name=\"champs4\" type=\"text\" /></blockquote></td>";
}if($fivesdraft->champs5 !=''){
$tbaleau_insert .="<td><blockquote><input name=\"champs5\" type=\"text\" /></blockquote></td>";
}if($fivesdraft->champs6 !=''){
$tbaleau_insert .="<td><blockquote><input name=\"champs6\" type=\"text\" /></blockquote></td>";
}if($fivesdraft->champs7 !=''){
$tbaleau_insert .="<td><blockquote><input name=\"champs7\" type=\"text\" /></blockquote></td>";
}if($fivesdraft->champs8 !=''){
$tbaleau_insert .="<td><blockquote><input name=\"champs8\" type=\"text\" /></blockquote></td>";
}if($fivesdraft->champs9 !=''){
$tbaleau_insert .="<td><blockquote><input name=\"champs9\" type=\"text\" /></blockquote></td>";
}
     }
$tbaleau_insert .="</tr></tdbody>
</table>
<input type=\"submit\" value=\"".__("Ajouter","e-mailing-service")."\"> 
</form>
";		
echo $tbaleau_insert;

echo "<br><br>";
$tab_champs ='';
$tab_champs .="<option value=\"null\">".__("null","e-mailing-service")."</option>";
$tab_champs .="<option value=\"email\">".__("Email","e-mailing-service")."</option>";
$tab_champs .="<option value=\"nom\">".__("Nom","e-mailing-service")."</option>";
$tab_champs .="<option value=\ip\">".__("IP","e-mailing-service")."</option>";
$tab_champs .="<option value=\lg\">".__("lg","e-mailing-service")."</option>";

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
$aleas=rand(0,99999999);

$filename = ''.$dossier_fichier.'/import_'.$aleas.'.txt';
$inF = fopen($filename,"w+");
fwrite($inF,$tab);
fclose($inF);

$wpdb->query( "SHOW GLOBAL VARIABLES LIKE 'local_infile';");
$wpdb->query( "SET GLOBAL local_infile = 'ON';");
$wpdb->query( "SHOW GLOBAL VARIABLES LIKE 'local_infile';");
		
$requette ="LOAD DATA LOCAL INFILE '$filename' IGNORE INTO TABLE  `".$liste."`  FIELDS TERMINATED BY '".$del."' ENCLOSED BY '\"' LINES TERMINATED BY '\\n'  (
$champs 
)";

$resultat = mysql_query($requette)or die('<br>Erreur SQL : '.__LINE__.' '.$requette.' '.mysql_error().'');
$sql_liste = $wpdb->get_results("SELECT id FROM `$liste` WHERE `cle` like 'Hysmqponisgz564'" ) or die("erreur ligne ".__line__." ".mysql_error()."");
foreach ( $sql_liste as $req_liste ) 
{
mysql_query("UPDATE `".$liste."` SET `cle` ='".key_generate()."' WHERE id='".$req_liste->id."'") or die(mysql_error());
}
unlink("".$filename."");
echo '<br><br><br><span style="color:#00f"><b>'.__("Vos emails ont ete importe","e-mailing-service").'</b></span>';			
	}
	
	///////////// import d'email /////////////////
	elseif($action=="import"){
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_liste."` WHERE liste_bd ='".$liste."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
	$nomliste=$fivesdraft->liste_nom;
}
echo "<h1>".__("Importation d'email dans votre liste","e-mailing-service")." ".$nomliste."</h1>";
$dossier_fichier=smPOST;
echo "<h3>".__("Attention de verifier que le dossier","e-mailing-service")." ".$dossier_fichier." ".__("est les droits  (CHMOD a 0777)","e-mailing-service")."</h3>";




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
	$resultat = mysql_query("select * from ".$table_liste." where ".$champ." ='".$exist."'")or die('Erreur SQL : '.__LINE__.' '.mysql_error());
	$nb_result_e = mysql_num_rows($resultat);
	if ($nb_result_e > 0){
		return 1;
	}else {
		return 0;
	}
}



?>
<h2><?php _e("Preparation du fichier","e-mailing-service");?> : </h2>
<p><?php _e("Fichier .csv ou fichier .txt","e-mailing-service");?> </p>
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

$requette ="LOAD DATA LOCAL INFILE '$content_dir$name_file' IGNORE INTO TABLE  `$liste`  FIELDS TERMINATED BY '".$del."' ENCLOSED BY '\"' LINES TERMINATED BY '\\n'  (
$champs 
) ";
$resultat = mysql_query($requette)or die('<br>'.__('Erreur SQL contact support or FAQ',"e-mailing-service").' : '.__LINE__.' '.mysql_error().'');
$sql_liste = $wpdb->get_results("SELECT id FROM `$liste` WHERE `cle` like 'Hysmqponisgz564'" ) or die("erreur ligne ".__line__." ".mysql_error()."");
foreach ( $sql_liste as $req_liste ) 
{
mysql_query("UPDATE `".$liste."` SET `cle` ='".key_generate()."' WHERE id='".$req_liste->id."'") or die(mysql_error());
}
unlink("".$content_dir."".$name_file."");
echo '<br><br><br><span style="color:#00f"><b>'.__("Vos emails ont ete importe","e-mailing-service").'</b></span>';
}
			}
}

	}
} else {
echo "<br><h1>".__("Listes de diffusion","e-mailing-service")."</h1>";
echo "<h2>".__("La liste de diffusion sert a classer les emails de vos clients par categories","e-mailing-service")."</h2>";
echo '<table class="widefat">
                         <thead>';
echo "<tr><td><blockquote><b>".__("Nom de votre liste","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b>".__("Nb d'emails","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b><a href=\"#\" title=\"".__("Une adresse courriel Opt-In active a fait l'objet d'un consentement prealable par une validation par clic","e-mailing-service")."\">".__("Opt-in","e-mailing-service")."</a></b></blockquote></td>
<td><blockquote><b>".__("Nb de desinscrits","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b>".__("Nb Invalide","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b>".__("Action","e-mailing-service")."</b></blockquote></td>
<td><blockquote><b></b></blockquote></td>
<td><blockquote><b></b></blockquote></td>
<td><blockquote><b></b></blockquote></td>
<td><blockquote><b></b></blockquote></td>
</tr> </thead>
        <tbody>";
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_liste."`");
foreach ( $fivesdrafts as $fivesdraft ) 
{
	$bdl=$fivesdraft->liste_bd;
	 echo "<tr><td><blockquote>".$fivesdraft->liste_nom."</blockquote></td>";
	$user_count = $wpdb->get_results("SELECT COUNT(id) AS total FROM ".$bdl."" ) or die("erreur ligne ".__line__." ".mysql_error()."");
	foreach ( $user_count as $user_count ) 
     { 
	 	 echo "<td><blockquote>".$user_count->total."</blockquote></td>";

	 }
	 	$optin_counts = $wpdb->get_results("SELECT COUNT(id) AS total FROM ".$bdl." WHERE optin='1'" ) or die("erreur ligne ".__line__." ".mysql_error()."");
	foreach ( $optin_counts as $optin_count ) 
     { 
	 	 echo "<td><blockquote>".$optin_count->total."</blockquote></td>";

	 }
	 	$invalid_count = $wpdb->get_results("SELECT COUNT(id) AS total2 FROM ".$bdl." WHERE valide='0'" ) or die("erreur ligne ".__line__." ".mysql_error()."");
	foreach ( $invalid_count as $invalid_count ) 
     { 
	 echo "<td><blockquote>".$invalid_count ->total2."</blockquote></td>";

	 }
	 	 	$bounces_count = $wpdb->get_results("SELECT COUNT(id) AS total3 FROM ".$bdl." WHERE bounces='0'" ) or die("erreur ligne ".__line__." ".mysql_error()."");
	foreach ( $bounces_count as $bounces_count ) 
     { 
	 echo "<td><blockquote>".$bounces_count ->total3."</blockquote></td>";

	 }
	 echo "
	 <td><blockquote><a href=\"admin.php?page=e-mailing-service/admin/emails.php&liste=".$fivesdraft->liste_bd."\" target=\"_parent\"><img src=\"".smURL."/img/search.png\" width=\"64\" height=\"64\" border=\"0\" title=\"".__("Details","e-mailing-service")."\"/></a></blockquote></td>
	 <td><blockquote><a href=\"admin.php?page=e-mailing-service/admin/listes.php&liste=".$fivesdraft->liste_bd."&action=ajout\" target=\"_parent\"><img src=\"".smURL."/img/doc_add.png\" width=\"64\" height=\"64\" border=\"0\" title=\"".__("Ajouter des emails","e-mailing-service")."\"/></a></blockquote></td>
	 <td><blockquote><a href=\"admin.php?page=e-mailing-service/admin/listes.php&liste=".$fivesdraft->liste_bd."&action=import\" target=\"_parent\"><img src=\"".smURL."/img/doc_add.png\" width=\"64\" height=\"64\" border=\"0\" title=\"".__("Importer des emails","e-mailing-service")."\"/></a></blockquote></td>
	 <td><blockquote><a href=\"admin.php?page=e-mailing-service/admin/listes.php&liste=".$fivesdraft->liste_bd."&action=rename\" target=\"_parent\"><img src=\"".smURL."/img/doc_edit.png\" width=\"64\" height=\"64\" border=\"0\" title=\"".__("Modifier la liste","e-mailing-service")."\" /></a></blockquote></td>
	 <td><blockquote><a href=\"admin.php?page=e-mailing-service/admin/listes.php&liste=".$fivesdraft->liste_bd."&action=truncate\" target=\"_parent\"><img src=\"".smURL."/img/doc_delete.png\" width=\"64\" height=\"64\" border=\"0\" title=\"".__("Vider la liste","e-mailing-service")."\"/></a></blockquote></td>
	 	 <td><blockquote><a href=\"".smURL."include/export.php?liste=".$fivesdraft->liste_bd."&action=export&format=csv\" target=\"_parent\"><img src=\"".smURL."/img/csv.png\" width=\"64\" height=\"64\" border=\"0\" title=\"".__("Exporter vos emails en fichier","e-mailing-service")." .csv\"/></a></blockquote></td>
		 	 	 <td><blockquote><a href=\"".smURL."include/export.php?liste=".$fivesdraft->liste_bd."&action=export&format=xls\" target=\"_parent\"><img src=\"".smURL."/img/xls.png\" width=\"64\" height=\"64\" border=\"0\" title=\"".__("Exporter vos emails en fichier","e-mailing-service")." .xls\"/></a></blockquote></td>
				 <td><blockquote><a href=\"admin.php?page=e-mailing-service/admin/listes.php&liste=".$fivesdraft->liste_bd."&liste_id=".$fivesdraft->id."&nbm=".$user_count->total."&action=division\" target=\"_parent\"><img src=\"".smURL."/img/division.png\" width=\"64\" height=\"64\" border=\"0\" title=\"".__("Diviser votre liste en plusieurs listes","e-mailing-service")."\"/></a></blockquote></td>
	 ";
	 echo "</tr>";
}
echo "</tdbody></table>";
echo "<h2>".__("Creation d'une nouvelle liste de diffusion","e-mailing-service")."</h2>";
echo "<h3>".__("Choisissez les noms de vos colonnes pour enregistrer vos abonnes","e-mailing-service")."</h3>";
echo '<form action="admin.php?page=e-mailing-service/admin/listes.php" method="post" target="_parent">
<table class="widefat">
                         <thead>
<tr><td><blockquote>'.__("Nom de la liste","e-mailing-service").' : </blockquote></td><td><input name="liste" type="text" /></td></tr>
<tr><td><blockquote>'.__("Nom du premier champs","e-mailing-service").' : </blockquote></td><td>'.__("Email").'</td></tr>
<tr><td><blockquote>'.__("Nom du deuxieme champs","e-mailing-service").' : </blockquote></td><td>'.__("Nom").'</td></tr>
<tr><td><blockquote>'.__("Nom du troisieme champs","e-mailing-service").' : </blockquote></td><td>'.__("IP").'</td></tr>
<tr><td><blockquote>'.__("Nom du quatrieme champs","e-mailing-service").' : </blockquote></td><td><input name="champs1" type="text" value="'.__("Prenom","e-mailing-service").'"/></td></tr>
<tr><td><blockquote>'.__("Nom du cinquieme champs","e-mailing-service").' : </blockquote></td><td><input name="champs2" type="text" value="'.__("Adresse","e-mailing-service").'"/></td></tr>
<tr><td><blockquote>'.__("Nom du sixieme champs","e-mailing-service").' :  </blockquote></td><td><input name="champs3" type="text" value="'.__("CP","e-mailing-service").'"/></td></tr>
<tr><td><blockquote>'.__("Nom du septieme champs","e-mailing-service").' :  </blockquote></td><td><input name="champs4" type="text" value="'.__("Ville","e-mailing-service").'"/></td></tr>
<tr><td><blockquote>'.__("Nom du huitime champs","e-mailing-service").' :  </blockquote></td><td><input name="champs5" type="text" value="'.__("Pays","e-mailing-service").'"/></td></tr>
<tr><td><blockquote>'.__("Nom du neuvieme champs","e-mailing-service").' :  </blockquote></td><td><input name="champs6" type="text" value="'.__("societe","e-mailing-service").'"/></td></tr>
<tr><td><blockquote>'.__("Nom du dixieme champs","e-mailing-service").' : </blockquote></td><td><input name="champs7" type="text" value=""/></td></tr>
<tr><td><blockquote>'.__("Nom du onzieme champs","e-mailing-service").' :  </blockquote></td><td><input name="champs8" type="text" value=""/></td></tr>
<tr><td><blockquote>'.__("Nom du douzieme champs","e-mailing-service").' : </blockquote></td><td><input name="champs9" type="text" value=""/></td></tr>
<tr><td><blockquote><input name="Ajouter" type="submit" value="'.__("Ajouter","e-mailing-service").'"/></td><td></td></tr>
<input type="hidden" name="action" value="add" />
</thead></table>
</form>';
}



?>
 