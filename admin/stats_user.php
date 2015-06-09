<div id="wrapper">
        <header id="page-header">
             <div class="wrapper">
               <?php include(smPATH . '/include/entete.php');?>
                 <div id="main-nav">  
                    <!-- <ul class="clearfix">         
<li><a href="admin.php?page=e-mailing-service/admin/stats_user.php" class="nav-tab <?php if(isset($_REQUEST['section'])){ if ($_REQUEST['section'] == 'journalier' || empty($_REQUEST['section'])) echo 'nav-tab-active';} ?>">
			<?php _e('Statistiques journalieres',"e-mailing-service"); ?>
		</a>
</li>
<li><a href="admin.php?page=e-mailing-service/admin/stats_user.php&section=hie" class="nav-tab <?php if(isset($_REQUEST['section'])){ if ($_REQUEST['section'] == 'hie') echo 'nav-tab-active'; }?>">
			<?php _e("Statistiques par campagne", "e-mailing-service"); ?>
		</a></li>
<li><a href="admin.php?page=e-mailing-service/admin/stats_user.php&section=campagne" class="nav-tab <?php if(isset($_REQUEST['section'])){ if ($_REQUEST['section'] == 'campagne') echo 'nav-tab-active'; }?>">
			<?php _e("Statistiques par newsletter", "e-mailing-service"); ?>
		</a></li>
<li><a href="admin.php?page=e-mailing-service/admin/stats_user.php&section=smtp" class="nav-tab <?php if(isset($_REQUEST['section'])){ if ($_REQUEST['section'] == 'smtp') echo 'nav-tab-active'; }?>">
			<?php _e("Statistiques SMTP", "e-mailing-service"); ?>
		</a></li>
                 </ul>-->
                    <br /><br />               
                </div>
             </div>
             <div id="page-subheader">
                <div class="wrapper">
 <h2>
 <?php
 if(isset($_REQUEST['section'])){
		if ($_REQUEST['section'] == 'campagne') { _e("Statistiques par newsletter",'admin-hosting'); }
		elseif ($_REQUEST['section'] == 'journalier') { _e("Statisques par date",'admin-hosting'); }
		elseif ($_REQUEST['section'] == 'hie') { _e("Statistiques par campagne",'admin-hosting'); }
		elseif ($_REQUEST['section'] == 'smtp') { _e("Statistiques SMTP",'admin-hosting'); }
        elseif ($_REQUEST['section'] == 'detail') { echo ''.__('Newsletter Statistics for','e-mailing-service').' "'.get_the_title($_GET["id"]).'"'; }
		elseif ($_REQUEST['section'] == 'detail_hie') { echo ''.__('Email Campaign Statistics for id','e-mailing-service').' '.$_GET["id"].''; }
		elseif ($_REQUEST['section'] == 'log') { echo ''.__('Log in live','e-mailing-service').''; }
 } else {
	  _e("Statistiques",'admin-hosting');
 }
   ?>					
</h2>
                  <!--  <input placeholder="Search..." type="text" name="q" value="" />-->
                </div>
         </div>
        </header>
 
                 <section id="content">
            <div class="wrapper">                                 

        <?php echo "<p>".__("Le temps d'actualisation des statistiques peut etre plus ou moin decale, sauf pour les statistiques en direct","e-mailing-service")."</p>";?>
                    
                    <hr />
<?php
$table_liste = $wpdb->prefix.'sm_liste';  
	if(get_option('sm_license')=="free" || !get_option('sm_license_key')){
		echo '<!-- no license -->';
echo '<h1>'.__("Statistiques","e-mailing-service").'</h1>';
_e("Nous ne pouvons pas fournir de statistiques detailles si vous nous fournissez pas l'autorisation d'interagir avec votre site, c'est entierement gratuit,  pour cela rendez vous dans le menu ","e-mailing-service");
echo "<a href=\"?page=e-mailing-service/admin/configuration.php\">".__("License et options","e-mailing-service")."</a><br>";
echo '<table><tr>
<td>
<form action="?page=e-mailing-service/admin/stats.php" method="post">
<input name="action" type="hidden" value="campagne" />
<input name="submit" type="submit" value="'.__("Statistiques par Campagne","e-mailing-service").'" />
</form>
</td>
<td>
</td>
<td>
<form action="?page=e-mailing-service/admin/stats.php" method="post">
<input name="action" type="hidden" value="envoi" />
<input name="submit" type="submit" value="'.__("Statistiques par envoi","e-mailing-service").'" />
</form>
</td>
<td></td>
<td>
<form action="?page=e-mailing-service/admin/stats.php" method="post">
<input name="action" type="hidden" value="liste" />
<input name="submit" type="submit" value="'.__("Statistiques par liste","e-mailing-service").'" />
</form>
</td>
</tr></table>';
extract($_POST);
if(!isset($action)){
$action="campagne";	
}

if($action=="envoi"){
echo '<h2>'.__("Listes des campagnes envoyes","e-mailing-service").'</h2>';
$tbaleau_insert =' <table class="paginate10 sortable full">
                         <thead><tr>';
$tbaleau_insert .="<th><blockquote>".__('Id envoi',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Type',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Campagne',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Liste',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Nb emails envoyes',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="</tr></thead><tdboy>";
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_envoi."` ORDER BY id DESC LIMIT $num,$comments_per_page");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$tbaleau_insert .="<tr><td><blockquote>".$fivesdraft->id."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->type."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".sm_template_title($fivesdraft->id_newsletter)."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".sm_liste_title($fivesdraft->id_liste)."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->nb_envoi."</blockquote></td>";	
$tbaleau_insert .="</tr>";	
}
$tbaleau_insert .="</tdboy></table>";
echo $tbaleau_insert;
}
elseif($action=="campagne"){
echo '<h2>'.__("Statistiques par campagne","e-mailing-service").'</h2>';
$tbaleau_insert =' <table class="paginate10 sortable full">
                         <thead><tr>';
$tbaleau_insert .="<th><blockquote>".__('Id envoi',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Type',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Campagne',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Liste',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Nb emails envoyes',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="</tr></thead><tdboy>";
$fivesdrafts = $wpdb->get_results("SELECT sum(nb_envoi) AS tot_news,id_newsletter,id_liste,id,type FROM `".$table_envoi."` GROUP BY id_newsletter LIMIT $num,$comments_per_page");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$tbaleau_insert .="<tr><td><blockquote>".$fivesdraft->id."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->type."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".sm_template_title($fivesdraft->id_newsletter)."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".sm_liste_title($fivesdraft->id_liste)."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->tot_news."</blockquote></td>";	
$tbaleau_insert .="</tr>";	
}
$tbaleau_insert .="</tdboy></table>";
echo $tbaleau_insert;		
}
elseif($action=="liste"){
echo '<h2>'.__("Statistiques par campagne","e-mailing-service").'</h2>';
$tbaleau_insert =' <table class="paginate10 sortable full">
                         <thead><tr>';
$tbaleau_insert .="<th><blockquote>".__('Id envoi',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Type',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Campagne',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Liste',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="<th><blockquote>".__('Nb emails envoyes',"e-mailing-service")."</blockquote></th>";
$tbaleau_insert .="</tr></thead><tdboy>";
$fivesdrafts = $wpdb->get_results("SELECT sum(nb_envoi) AS tot_news,id_newsletter,id_liste,id,type FROM `".$table_envoi."` GROUP BY id_liste LIMIT $num,$comments_per_page");
foreach ( $fivesdrafts as $fivesdraft ) 
{
$tbaleau_insert .="<tr><td><blockquote>".$fivesdraft->id."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->type."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".sm_template_title($fivesdraft->id_newsletter)."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".sm_liste_title($fivesdraft->id_liste)."</blockquote></td>";
$tbaleau_insert .="<td><blockquote>".$fivesdraft->tot_news."</blockquote></td>";	
$tbaleau_insert .="</tr>";	
}
$tbaleau_insert .="</tdboy></table>";
echo $tbaleau_insert;		
}
	} else {
$date_m1=date('Y-m-d H:i:s');
$date_m2=date('Y-m-d');
$h_m1=date('H')-1;
 $i=0; 
 $date=date('Y-m-d');
$y=(isset($_POST["y"]) && !empty($_POST["y"])) ? $_POST["y"] : date('Y');
//$m=(isset($_POST["m"]) && !empty($_POST["m"])) ? $_POST["m"] : date('m');
if(!isset($m)){
$m=	date('m');
}
$srv=(isset($_POST["srv"]) && !empty($_POST["srv"])) ? $_POST["srv"] : 'tous';
$cp=(isset($_POST["cp"]) && !empty($_POST["cp"])) ? $_POST["cp"] : 'tous';
$t1=(isset($_POST["t1"]) && !empty($_POST["t1"])) ? $_POST["t1"] : 'tous';
$t2=(isset($_POST["t2"]) && !empty($_POST["t2"])) ? $_POST["t2"] : 'tous';
$fai=(isset($_POST["fai"]) && !empty($_POST["fai"])) ? $_POST["fai"] : 'tous';
$site=(isset($_POST["site"]) && !empty($_POST["site"])) ? $_POST["site"] : 'tous';
$pays=(isset($_POST["pays"]) && !empty($_POST["pays"])) ? $_POST["pays"] : 'tous';
$name_mois["01"]="Janvier";
$name_mois["02"]="Fevrier";
$name_mois["03"]="Mars";
$name_mois["04"]="Avril";
$name_mois["05"]="Mai";
$name_mois["06"]="Juin";
$name_mois["07"]="Juillet";
$name_mois["08"]="Aout";
$name_mois["09"]="Septembre";
$name_mois["10"]="Octobre";
$name_mois["11"]="Novembre";
$name_mois["12"]="Decembre";
$stats_campagne ="";
$variable="";
if($srv !='tous'){
$variable .= "serveur='$srv' AND ";	
}
if($t1 !='tous'){
$variable .= "track1='$t1' AND ";	
}
if($t2 !='tous'){
$variable .= "track2='$t2' AND ";	
}
if($fai !='tous'){
$variable .= "fai='$fai' AND ";	
}
if($site !='tous'){
$variable .= "site_stats='$site' AND ";	
}
if($pays !='tous'){
$variable .= "pays='$pays' AND ";	
}
$sum=0;
$stats_serveur="";

?>

    <?php
	if(isset($_REQUEST['section'])){
		if ($_REQUEST['section'] == 'hie'){
	$xml2=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php?action=hie&login='.$user_login.'&domaine_client='.$host.'&key='.get_option('sm_license_key').'','item',array('resultat','id','titre','liste','date','nb_emails','email_ouvert','pour_ouver','clic','pour_clic','page','pour_page','affiliation','pour_affiliation','desinscrit','pour_desinscrit'));
$tableau_ticket = ' <table class="paginate10 sortable full">
				<thead>
						<tr>
                            <th>ID</th>
							<th>CAMPAGNE</th>
                            <th>LISTE</th>
                            <th>DATE</th>
                            <th>Nb Emails</th>
                            <th>Emails ouvert</th>
							<th>% ouverture</th>
							<th>CLICS </th>
							<th>% CLICS</th>
                            <th>PAGE</th>
							<th>% PAGE</th>
                            <th>Affiliation</th>
							<th>% Affiliation</th>
                            <th>Desinscrit</th>
							<th>% Desinscrit</th>
						</tr>
					</thead>					
					<tbody>';
if($xml2!='') {
    foreach($xml2 as $row) {
$tableau_ticket .= "<tr>
<td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td>
<td>".$row[6]."</td><td>".$row[7]." %</td><td>".$row[8]."</td><td>".$row[9]." %</td><td>".$row[10]."</td>
<td>".$row[11]." %</td><td>".$row[12]."</td><td>".$row[13]." %</td><td>".$row[14]."</td><td>".$row[15]." %</td>

</tr>
	"; 
    }
    }
$tableau_ticket .= '</tbody></table>';
echo $tableau_ticket;
    
		}
		
	if ($_REQUEST['section'] == 'hie_graphique'){
	$table_envoi= $wpdb->prefix.'sm_historique_envoi';
	$user_count = $wpdb->get_results("SELECT * FROM `".$table_envoi."` WHERE id='".$_GET["hie"]."'");
	foreach ( $user_count as $user_counts ) 
     { 	
list($ouverture,$clic,$desinscrit)=explode("|",nb_clic($_GET["hie"],$user_login,$host));
echo '<table class="paginate10 sortable full">
<tr>
<td valign="top">
<h1>'.__("Statistiques de l'envoi numero","admin-hosting").' '.$_GET["hie"].'</h1>
<h2>'.__("Statistiques de depart","admin-hosting").' : '.$user_counts->date_envoi.'</h2>
<h2>'.__("Statistiques de fin","admin-hosting").' : '.$user_counts->date_fin.'</h2>
<h2>'.__("Destinataires","admin-hosting").' : '.nb_destinataire($user_counts->id_liste).'</h2>
<h2>'.__("Ouverture","admin-hosting").' : '.$ouverture.'</h2>
<h2>'.__("Clics","admin-hosting").' : '.$clic.'</h2>
<h2>'.__("Desinscrit","admin-hosting").' : '.$desinscrit.'</h2>
</td>
<td><br><img src="http://www.tous1site.name/wp-code/cgi_wordpress_api_stats_pie.php?action=hie&lecture='.$ouverture.'&clic='.$clic.'&desinscrit='.$desinscrit.'" width="50%"/></td>
</tr>
</table>';
	 }
	$xml2=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php?action=hie_graphique&hie='.$_GET["hie"].'&login='.$user_login.'&domaine_client='.$host.'&key='.get_option('sm_license_key').'','item',array('id','lien','clic','clic_unique'));
$tableau_ticket = '<h1>'.__('Clic sur vos liens','admin-hosting').'</h1> <table class="paginate10 sortable full">
				<thead>
						<tr>
                            <th>'.__('Liens','admin-hosting').'</th>
                            <th>'.__('Nombres de Clics','admin-hosting').'</th>
						</tr>
					</thead>					
					<tbody>';
if($xml2!='') {
    foreach($xml2 as $row) {
$tableau_ticket .= "<tr>
<td><a href=\"".$row[1]."\" target=\"_blank\">".$row[1]."</a></td><td>".$row[2]."</td>
</tr>
	"; 
    }
    }
$tableau_ticket .= '</tbody></table>';
echo $tableau_ticket;
    
		}
		if ($_REQUEST['section'] == 'smtp'){
if(is_plugin_active('admin-hosting/admin-hosting.php')) {
$req_serveurs = $wpdb->get_results("SELECT serveur FROM `".AH_table_server_list."` WHERE login like '".$user_login."'");
foreach ( $req_serveurs as $req_serveur ) 
{
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".AH_table_server_ip."` WHERE serveur like '".$req_serveur->serveur."'");
foreach ( $fivesdrafts as $fivesdraft ) 
{
echo "<h1>".__("Statistiques SMTP du serveur")." ".$fivesdraft->smtp_server."</h1>";
?>
<center>
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_smtp_v2.php?smtp=<?php echo $fivesdraft->smtp_server;?>&domaine_client=<?php echo $host;?>&login=<?php echo $user_login;?>&key=<?php echo get_option('sm_license_key');?>" width="40%"  alt="" />
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_smtp_v2.php?smtp=<?php echo $fivesdraft->smtp_server;?>&domaine_client=<?php echo $host;?>&date=<?php echo date('Y-m-d', strtotime("-1 day"));?>&login=<?php echo $user_login;?>&key=<?php echo get_option('sm_license_key');?>" width="40%" alt="" />
<br />
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_smtp_v2.php?smtp=<?php echo $fivesdraft->smtp_server;?>&domaine_client=<?php echo $host;?>&action=mois&login=<?php echo $user_login;?>&key=<?php echo get_option('sm_license_key');?>" width="600" height="600" alt="" />
</center>
<?php		
}
} 
} 
	
		}
if ($_REQUEST['section'] == 'detail'){?>	
<div class="systeme_onglets">
        <div class="onglets">
            <span class="onglet_0 onglet" id="onglet_snapshot" onclick="javascript:change_onglet('snapshot');"><?php echo __('Statistiques snapshot','e-mailing-service'); ?></span>
            <span class="onglet_0 onglet" id="onglet_open" onclick="javascript:change_onglet('open');"><?php echo __('Open Statistics','e-mailing-service'); ?></span>
            <span class="onglet_0 onglet" id="onglet_link" onclick="javascript:change_onglet('link');"><?php echo __('Link Statistics','e-mailing-service'); ?></span>
            <span class="onglet_0 onglet" id="onglet_bounces" onclick="javascript:change_onglet('bounces');"><?php echo __('Bounces statistics','e-mailing-service'); ?></span>
            <span class="onglet_0 onglet" id="onglet_unsuscribe" onclick="javascript:change_onglet('unsuscribe');"><?php echo __('Unsuscribe Statistics','e-mailing-service'); ?></span>
        </div>
        <div class="contenu_onglets">
            <div class="contenu_onglet" id="contenu_onglet_snapshot">
                <h1><?php echo __('Snapshot statistics','e-mailing-service'); ?></h1>
 <?php
$total_envoi = $wpdb->get_var("SELECT SUM( nb_envoi ) AS total FROM  `".$table_envoi."` WHERE id_newsletter =  '".$_GET["id"]."'");
$xml2=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php?action=newsletter&id='.$_GET["id"].'&login='.$user_login.'&domaine_client='.$host.'&key='.get_option('sm_license_key').'','item',array('resultat','id','titre','lecture','clic','clic_page','clic_affiliation','desinscription','bounces'));
if($xml2!='') {
    foreach($xml2 as $row) {
$pourcent_lecture=round(100 * $row[3] / $total_envoi,2 );
$pourcent_clic=round(100 * $row[4] / $total_envoi,2 );
	}
}
?>
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_pie_v2.php?domaine_client=<?php echo $host;?>&key=<?php echo get_option('sm_license_key');?>&nb_env=<?php echo $total_envoi;?>&nb_bounces=<?php echo $row[8];?>&nb_ouvert=<?php echo $row[3];?>" alt="" align="right" hspace="50"  vspace="50"/>
<ul>
<li><a href="<?php echo get_option('siteurl')?>/?p=<?php echo $_GET["id"];?>" target="_blank"><?php echo __('View online','e-mailing-service'); ?> </a></li>
<li><?php echo __('Sent To','e-mailing-service'); ?>  :  <?php echo $total_envoi;?></li>
<li><?php echo __('Opened','e-mailing-service'); ?>  :  <?php echo $row[3];?></li>
<li><?php echo __('Open Rate','e-mailing-service'); ?>  : <?php echo $pourcent_lecture;?> %</li>
<li><?php echo __('Click link','e-mailing-service'); ?>  :  <?php echo $row[4];?></li>
<li><?php echo __('Click-through Rate','e-mailing-service'); ?>  :  <?php echo $pourcent_clic;?> %</li>
<li><?php echo __('Click online','e-mailing-service'); ?>  :  <?php echo $row[5];?></li>
<li><?php echo __('Click affiliate link','e-mailing-service'); ?>  :  <?php echo $row[7];?></li>
<li><?php echo __('Unsuscribe','e-mailing-service'); ?>  :  <?php echo $row[5];?></li>
<li><?php echo __('Bounced','e-mailing-service'); ?>  :  <?php echo $row[8];?></li>
</ul>

<br /><br /><br />
<br /><br /><br />
<br /><br /><br />
<br /><br /><br />
<br /><br /><br />
<br /><br /><br />
            </div>
            <div class="contenu_onglet" id="contenu_onglet_open">
                <h1><?php echo __('Open statistics','e-mailing-service'); ?></h1>
                <?php
if(isset($graph)){
	if($graph == 'days7'){
echo '<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_days.php?domaine_client='.$host.'&key='.get_option('sm_license_key').'&login='.$user_login.'&idc='.$_GET["id"].'&action=open" alt="" align="right" hspace="50"  vspace="50" height="500" width="850"/>';	
	}
	elseif($graph == 'year'){
echo '<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_year.php?domaine_client='.$host.'&key='.get_option('sm_license_key').'&login='.$user_login.'&idc='.$_GET["id"].'&action=open" alt="" align="right" hspace="50"  vspace="50" height="500" width="850"/>';	
	}
} else {
echo '<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_days.php?domaine_client='.$host.'&key='.get_option('sm_license_key').'&login='.$user_login.'&idc='.$_GET["id"].'&action=open" alt="" align="right" hspace="50"  vspace="50" height="500" width="850"/>';	
} ?><ul>
<li><a href="<?php echo get_option('siteurl')?>/?p=<?php echo $_GET["id"];?>" target="_blank"><?php echo __('View online','e-mailing-service'); ?> </a></li>
<li><?php echo __('Sent To','e-mailing-service'); ?>  :  <?php echo $total_envoi;?></li>
<li><?php echo __('Opened','e-mailing-service'); ?>  :  <?php echo $row[3];?></li>
<li><?php echo __('Open Rate','e-mailing-service'); ?>  : <?php echo $pourcent_lecture;?> %</li>
<li><?php echo __('Click link','e-mailing-service'); ?>  :  <?php echo $row[4];?></li>
<li><?php echo __('Click-through Rate','e-mailing-service'); ?>  :  <?php echo $pourcent_clic;?> %</li>
<li><?php echo __('Click online','e-mailing-service'); ?>  :  <?php echo $row[5];?></li>
<li><?php echo __('Click affiliate link','e-mailing-service'); ?>  :  <?php echo $row[7];?></li>
<li><?php echo __('Unsuscribe','e-mailing-service'); ?>  :  <?php echo $row[5];?></li>
<li><?php echo __('Bounced','e-mailing-service'); ?>  :  <?php echo $row[8];?></li>
</ul>
<?php 

$tbaleau_insert1 =' <table class="paginate10 sortable full">
                         <thead><tr>';
$tbaleau_insert1 .="<th align=\"left\"><blockquote>".__("Email","admin-hosting")."</blockquote></th>";
$tbaleau_insert1 .="<th align=\"left\"><blockquote>".__("Date opened","admin-hosting")."</blockquote></th>";
$tbaleau_insert1 .="<th align=\"left\"><blockquote>".__("Tracking 1","admin-hosting")."</blockquote></th>";
$tbaleau_insert1 .="<th align=\"left\"><blockquote>".__("Tracking 2","admin-hosting")."</blockquote></th>";
$tbaleau_insert1 .="<th align=\"left\"><blockquote>".__("Pays","admin-hosting")."</blockquote></th>";
$tbaleau_insert1 .="</tr> </thead>
        <tbody>";
		
		$array =array (
		"site" =>  $host,
		"license_key" => get_option('sm_license_key'), 
		"login" => $user_login,
		"ip" => $_SERVER['REMOTE_ADDR'],
		"action" => "list_open",
		"id" => $_GET["id"]
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php',$array);
		$xml_open = post_xml_data($fluxl,'item',array('resultat','id','email','date','track1','track2','pays'));
		//echo '<textarea name="bug" cols="150" rows="10">'.$fluxl.'</textarea>';
		if($xml_open !=''){
		foreach($xml_open as $ang) {
			if($ang[0] == 1){
			 $tbaleau_insert1 .= "<tr>
	<td><blockquote>".$ang[2]."</blockquote></td>
	<td><blockquote>".$ang[3]."</blockquote></td>
	<td><blockquote>".$ang[4]."</blockquote></td>
	<td><blockquote>".$ang[5]."</blockquote></td>
	<td><blockquote>".$ang[6]."</blockquote></td>
                             </tr>";
                             }

		}
		$tbaleau_insert1 .= '</tbody></table>';	
		echo $tbaleau_insert1;
		}

?>

            </div>
            <div class="contenu_onglet" id="contenu_onglet_link">
                <h1><?php echo __('Link statistics','e-mailing-service'); ?></h1>
                <?php
if(isset($graph)){
	if($graph == 'days7'){
echo '<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_days.php?domaine_client='.$host.'&key='.get_option('sm_license_key').'&login='.$user_login.'&idc='.$_GET["id"].'&action=clic" alt="" align="right" hspace="50"  vspace="50" height="500" width="850"/>';	
	}
	elseif($graph == 'year'){
echo '<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_year.php?domaine_client='.$host.'&key='.get_option('sm_license_key').'&login='.$user_login.'&idc='.$_GET["id"].'&action=clic" alt="" align="right" hspace="50"  vspace="50" height="500" width="850"/>';	
	}
} else {
echo '<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_days.php?domaine_client='.$host.'&key='.get_option('sm_license_key').'&login='.$user_login.'&idc='.$_GET["id"].'&action=clic" alt="" align="right" hspace="50"  vspace="50" height="500" width="850"/>';	
} ?>
<ul>
<li><a href="<?php echo get_option('siteurl')?>/?p=<?php echo $_GET["id"];?>" target="_blank"><?php echo __('View online','e-mailing-service'); ?> </a></li>
<li><?php echo __('Sent To','e-mailing-service'); ?>  :  <?php echo $total_envoi;?></li>
<li><?php echo __('Opened','e-mailing-service'); ?>  :  <?php echo $row[3];?></li>
<li><?php echo __('Open Rate','e-mailing-service'); ?>  : <?php echo $pourcent_lecture;?> %</li>
<li><?php echo __('Click link','e-mailing-service'); ?>  :  <?php echo $row[4];?></li>
<li><?php echo __('Click-through Rate','e-mailing-service'); ?>  :  <?php echo $pourcent_clic;?> %</li>
<li><?php echo __('Click online','e-mailing-service'); ?>  :  <?php echo $row[5];?></li>
<li><?php echo __('Click affiliate link','e-mailing-service'); ?>  :  <?php echo $row[7];?></li>
<li><?php echo __('Unsuscribe','e-mailing-service'); ?>  :  <?php echo $row[5];?></li>
<li><?php echo __('Bounced','e-mailing-service'); ?>  :  <?php echo $row[8];?></li>
</ul>
<?php
$tbaleau_insert =' <table class="paginate10 sortable full">
                         <thead><tr>';
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Email","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Date clicked","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Link","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="</tr> </thead>
        <tbody>";
		
		$array =array (
		"site" =>  $host,
		"license_key" => get_option('sm_license_key'), 
		"login" => $user_login,
		"ip" => $_SERVER['REMOTE_ADDR'],
		"action" => "list_link",
		"id" => $_GET["id"]
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php',$array);
		$xml2l = post_xml_data($fluxl,'item',array('resultat','id','email','date','link'));
		//echo '<textarea name="bug" cols="150" rows="10">'.$fluxl.'</textarea>';
		if($xml2l !=''){
		foreach($xml2l as $link1) {
			if($link1[0] == 1){
			 $tbaleau_insert .= '<tr>
	<td><blockquote>'.$link1[2].'</blockquote></td>
	<td><blockquote>'.$link1[3].'</blockquote></td>
	<td><blockquote><a href="'.$link1[4].'" target="_blank">'.$link1[4].'</a></blockquote></td>
                             </tr>';
                             }

		}
		$tbaleau_insert .= '</tbody></table>';	
		echo $tbaleau_insert;
		}

?>
            </div>
               <div class="contenu_onglet" id="contenu_onglet_bounces">
                <h1><?php echo __('Bounced statistics','e-mailing-service'); ?></h1>
 <?php
$requete = "";
$i=0;

$fivesdrafts = $wpdb->get_results("SELECT id FROM `".$table_envoi."` WHERE id_newsletter = '".$_GET["id"]."'");		
foreach ( $fivesdrafts as $fivesdraft ) 
{
	if($i == 0){
$requete .= " hie = '".$fivesdraft->id."'";	
	} else {
$requete .= " OR hie = '".$fivesdraft->id."'";			
	}
	$i++;
}

$total_hard = $wpdb->get_var("SELECT count( id ) AS total FROM `".$table_bounces_log."` WHERE (".$requete.") AND bounce_type ='hard'");
$total_soft = $wpdb->get_var("SELECT count( id ) AS total FROM `".$table_bounces_log."` WHERE (".$requete.") AND bounce_type !='hard'");
$pourcent_hard=round(100 * $total_hard / $total_envoi, 2 );
$pourcent_soft=round(100 * $total_soft / $total_envoi, 2 );
?>
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_pie_v2.php?domaine_client=<?php echo $host;?>&key=<?php echo get_option('sm_license_key');?>&nb_env=<?php echo $total_envoi;?>&hard=<?php echo $total_hard;?>&soft=<?php echo $total_soft;?>&action=bounces" alt="" align="right" hspace="50"  vspace="50"/>
<ul>
<li><a href="<?php echo get_option('siteurl')?>/?p=<?php echo $_GET["id"];?>" target="_blank"><?php echo __('View online','e-mailing-service'); ?> </a></li>
<li><?php echo __('Sent To','e-mailing-service'); ?>  :  <?php echo $total_envoi;?></li>
<li><?php echo __('Total Hard bounce','e-mailing-service'); ?>  :  <?php echo $total_hard; ?></li>
<li><?php echo __('Hard bounce Rate','e-mailing-service'); ?>  : <?php echo $pourcent_hard;?> %</li>
<li><?php echo __('Total Soft bounce','e-mailing-service'); ?>  :  <?php echo $total_soft;?></li>
<li><?php echo __('Soft bounce Rate','e-mailing-service'); ?>  :  <?php echo $pourcent_soft;?> %</li>
</ul>
<?php 

$tbaleau_insert =' <table class="paginate10 sortable full">
                         <thead><tr>';
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("ID Campaign","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Email","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Date bounced","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Type","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Type","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Details","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="</tr> </thead>
        <tbody>";



$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_bounces_log."` WHERE (".$requete.") ORDER BY id DESC LIMIT 100");
foreach ( $fivesdrafts as $fivesdraft ) 
{
			 $tbaleau_insert .= "<tr>
	<td><blockquote>".$fivesdraft->hie."</blockquote></td>
	<td><blockquote>".$fivesdraft->email."</blockquote></td>
	<td><blockquote>".$fivesdraft->date."</blockquote></td>
	<td><blockquote>".$fivesdraft->rules_cat."</blockquote></td>
	<td><blockquote>".$fivesdraft->bounce_type."</blockquote></td>
	<td><blockquote>".$fivesdraft->diag_code."</blockquote></td>
                             </tr>";
}

$tbaleau_insert .= '</tbody></table>';	
echo $tbaleau_insert;
?>
            </div>
               <div class="contenu_onglet" id="contenu_onglet_unsuscribe">
                <h1><?php echo __('Unsubscribe statistics','e-mailing-service'); ?></h1>
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_pie_v2.php?domaine_client=<?php echo $host;?>&key=<?php echo get_option('sm_license_key');?>&nb_env=<?php echo $total_envoi;?>&nb_unsuscribe=<?php echo $row[7];?>&action=unsuscribe" alt="" align="right" hspace="50"  vspace="50"/>
<ul>
<li><a href="<?php echo get_option('siteurl')?>/?p=<?php echo $_GET["id"];?>" target="_blank"><?php echo __('View online','e-mailing-service'); ?> </a></li>
<li><?php echo __('Sent To','e-mailing-service'); ?>  :  <?php echo $total_envoi;?></li>
<li><?php echo __('Click Unsubscribe','e-mailing-service'); ?>  :  <?php echo $row[7];?></li>
</ul>
<?php
$tbaleau_insert =' <table class="paginate10 sortable full">
                         <thead><tr>';
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Email","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Date opened","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Tracking 1","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Tracking 2","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Pays","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="</tr> </thead>
        <tbody>";
		
		$array =array (
		"site" =>  $host,
		"license_key" => get_option('sm_license_key'), 
		"login" => $user_login,
		"ip" => $_SERVER['REMOTE_ADDR'],
		"action" => "list_unsubscribe",
		"id" => $_GET["id"]
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php',$array);
		$xml2l = post_xml_data($fluxl,'item',array('resultat','id','email','date','track1','track2','pays'));
		//echo '<textarea name="bug" cols="150" rows="10">'.$fluxl.'</textarea>';
		if($xml2l !=''){
		foreach($xml2l as $row) {
			if($row[0] == 1){
			 $tbaleau_insert .= "<tr>
	<td><blockquote>".$row[2]."</blockquote></td>
	<td><blockquote>".$row[3]."</blockquote></td>
	<td><blockquote>".$row[4]."</blockquote></td>
	<td><blockquote>".$row[5]."</blockquote></td>
	<td><blockquote>".$row[6]."</blockquote></td>
                             </tr>";
                             }

		}
		$tbaleau_insert .= '</tbody></table>';	
		echo $tbaleau_insert;
		}

?>
            </div>
        </div>
    </div>
    
<?php } ?>	
<?php
if ($_REQUEST['section'] == 'detail_hie'){
if($user_role=='administrator'){
$fivesdrafts= $wpdb->get_results("SELECT * FROM  `".$table_envoi."` WHERE id =  '".$_GET["id"]."'");
} else {
$fivesdrafts= $wpdb->get_results("SELECT * FROM  `".$table_envoi."` WHERE id =  '".$_GET["id"]."' AND login='".$user_login."'");	
}
foreach ( $fivesdrafts as $fivesdraft ) 
{
$total_envoi=$fivesdraft->nb_envoi;
$id_newsletter=$fivesdraft->id_newsletter;
$id_liste=$fivesdraft->id_liste;
$status=$fivesdraft->status;
}
if(!isset($total_envoi)){
_e('you do not have access to these statistics','e-mailing-service');	
exit();
}
if($user_role=='administrator'){
$user_login=$fivesdraft->login;
}

$liste=$wpdb->get_var("SELECT liste_bd FROM `".$table_liste."` WHERE login='".$user_login."' AND id='".$id_liste."'");
if($status !='Terminer'){
$total_envoi=nbenvoyer($fivesdraft->id);
$nb_email = $wpdb->get_var("SELECT COUNT(id) AS total FROM ".$liste." WHERE valide='1' AND bounces='1' " ) or die("erreur ligne ".__line__." ".mysql_error()."");
} else {
$nb_email = $total_envoi;	
}

$li='http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php?action=newsletter_hie&hie='.$_GET["id"].'&login='.$user_login.'&site='.$host.'&key='.get_option('sm_license_key').'';
$xml2=lit_xml_data($li,'item',array('resultat','id','titre','lecture','clic','clic_page','clic_affiliation','desinscription','bounces'));
if($xml2!='') {
    foreach($xml2 as $row) {
	$tpl=100 * $row[3];	
	$pl=$tpl/$total_envoi;
$pourcent_lecture=round($pl,2);
$pourcent_clic=round(100 * $row[4] / $total_envoi, 2 );
   } 
}


//echo "<textarea name=\"\" cols=\"100\" rows=\"10\">".$xml2."</textarea><br>";
?>		
<div class="systeme_onglets">
        <div class="onglets">
            <span class="onglet_0 onglet" id="onglet_snapshot" onclick="javascript:change_onglet('snapshot');"><?php echo __('Statistiques snapshot','e-mailing-service'); ?></span>
            <span class="onglet_0 onglet" id="onglet_open" onclick="javascript:change_onglet('open');"><?php echo __('Open Statistics','e-mailing-service'); ?></span>
            <span class="onglet_0 onglet" id="onglet_link" onclick="javascript:change_onglet('link');"><?php echo __('Link Statistics','e-mailing-service'); ?></span>
            <span class="onglet_0 onglet" id="onglet_bounces" onclick="javascript:change_onglet('bounces');"><?php echo __('Bounces statistics','e-mailing-service'); ?></span>
            <span class="onglet_0 onglet" id="onglet_unsuscribe" onclick="javascript:change_onglet('unsuscribe');"><?php echo __('Unsuscribe Statistics','e-mailing-service'); ?></span>
        </div>
        <div class="contenu_onglets">
            <div class="contenu_onglet" id="contenu_onglet_snapshot">
                <h1><?php echo __('Snapshot statistics','e-mailing-service'); ?></h1>
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_pie_v2.php?domaine_client=<?php echo $host;?>&key=<?php echo get_option('sm_license_key');?>&nb_env=<?php echo $total_envoi;?>&nb_bounces=<?php echo $row[8];?>&nb_ouvert=<?php echo $row[3];?>" alt="" align="right" hspace="50"  vspace="50"/>
<ul>
<li><?php echo __('Newsletter subject','e-mailing-service'); ?>  :  <a href="<?php echo get_option('siteurl')?>/?p=<?php echo $_GET["id"];?>" target="_blank"><?php echo get_the_title($id_newsletter);?> </a></li>
<li><?php echo __('Contact list','e-mailing-service'); ?>  :  <?php echo sm_liste_title($fivesdraft->id_liste);?></li>
<li><?php echo __('Sent To','e-mailing-service'); ?>  :  <?php echo $total_envoi;?></li>
<li><?php echo __('Date send','e-mailing-service'); ?>  :  <?php echo $fivesdraft->date_envoi;?></li>
<li><?php echo __('Date start','e-mailing-service'); ?>  :  <?php echo $fivesdraft->date_demarrage;?></li>
<li><?php echo __('Date finish','e-mailing-service'); ?>  :  <?php echo $fivesdraft->date_fin;?></li>
<li><?php echo __('Number send','e-mailing-service'); ?>  :  <?php echo "".$total_envoi."/".$nb_email."";?>
<li><?php echo __('Opened','e-mailing-service'); ?>  :  <?php echo $row[3];?></li>
<li><?php echo __('Open Rate','e-mailing-service'); ?>  : <?php echo $pourcent_lecture;?> %</li>
<li><?php echo __('Click link','e-mailing-service'); ?>  :  <?php echo $row[4];?></li>
<li><?php echo __('Click-through Rate','e-mailing-service'); ?>  :  <?php echo $pourcent_clic;?> %</li>
<li><?php echo __('Click online','e-mailing-service'); ?>  :  <?php echo $row[5];?></li>
<li><?php echo __('Click affiliate link','e-mailing-service'); ?>  :  <?php echo $row[6];?></li>
<li><?php echo __('Unsuscribe','e-mailing-service'); ?>  :  <?php echo $row[7];?></li>
<li><?php echo __('Bounced','e-mailing-service'); ?>  :  <?php echo $row[8];?></li>

</ul>

<br /><br /><br />
<br /><br /><br />
<br /><br /><br />
<br /><br /><br /><br /><br /><br />
<br /><br /><br />
            </div>
            <div class="contenu_onglet" id="contenu_onglet_open">
                <h1><?php echo __('Open statistics','e-mailing-service'); ?></h1>
 <?php
if(isset($graph)){
	if($graph == 'days7'){
echo '<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_days.php?domaine_client='.$host.'&key='.get_option('sm_license_key').'&login='.$user_login.'&hie='.$_GET["id"].'&action=hie_open" alt="" align="right" hspace="50"  vspace="50" height="500" width="850"/>';	
	}
	elseif($graph == 'year'){
echo '<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_year.php?domaine_client='.$host.'&key='.get_option('sm_license_key').'&login='.$user_login.'&hie='.$_GET["id"].'&action=hie_open" alt="" align="right" hspace="50"  vspace="50" height="500" width="850"/>';	
	}
} else {
echo '<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_days.php?domaine_client='.$host.'&key='.get_option('sm_license_key').'&login='.$user_login.'&hie='.$_GET["id"].'&action=hie_open" alt="" align="right" hspace="50"  vspace="50" height="500" width="850"/>';	
} ?>
<br />
<ul>
<li><?php echo __('Newsletter subject','e-mailing-service'); ?>  :  <a href="<?php echo get_option('siteurl')?>/?p=<?php echo $_GET["id"];?>" target="_blank"><?php echo get_the_title($id_newsletter);?> </a></li>
<li><?php echo __('Contact list','e-mailing-service'); ?>  :  <?php echo sm_liste_title($fivesdraft->id_liste);?></li>
<li><?php echo __('Sent To','e-mailing-service'); ?>  :  <?php echo $total_envoi;?></li>
<li><?php echo __('Date send','e-mailing-service'); ?>  :  <?php echo $fivesdraft->date_envoi;?></li>
<li><?php echo __('Date start','e-mailing-service'); ?>  :  <?php echo $fivesdraft->date_demarrage;?></li>
<li><?php echo __('Date finish','e-mailing-service'); ?>  :  <?php echo $fivesdraft->date_fin;?></li>
<li><?php echo __('Opened','e-mailing-service'); ?>  :  <?php echo $row[3];?></li>
<li><?php echo __('Open Rate','e-mailing-service'); ?>  : <?php echo $pourcent_lecture;?> %</li>
<li><?php echo __('Click link','e-mailing-service'); ?>  :  <?php echo $row[4];?></li>
<li><?php echo __('Click-through Rate','e-mailing-service'); ?>  :  <?php echo $pourcent_clic;?> %</li>
<li><?php echo __('Click online','e-mailing-service'); ?>  :  <?php echo $row[5];?></li>
<li><?php echo __('Click affiliate link','e-mailing-service'); ?>  :  <?php echo $row[6];?></li>
<li><?php echo __('Unsuscribe','e-mailing-service'); ?>  :  <?php echo $row[7];?></li>
<li><?php echo __('Bounced','e-mailing-service'); ?>  :  <?php echo $row[8];?></li>
<li>&nbsp;</li>
<?php echo "
<li><a href=\"".smURL."include/export.php?liste=".sm_liste_title($fivesdraft->id_liste)."&action=export&format=csv_open_total&hie=".$_GET["id"]."\" target=\"_parent\">".__("Exporter les statistiques en fichier","e-mailing-service")." .csv</a></li>
<li><a href=\"".smURL."include/export.php?liste=".sm_liste_title($fivesdraft->id_liste)."&action=export&format=csv_open_email&hie=".$_GET["id"]."\" target=\"_parent\">".__("Exporter seulement les emails en fichier","e-mailing-service")." .csv</a></li>
<li><a href=\"".smURL."include/export.php?liste=".sm_liste_title($fivesdraft->id_liste)."&action=export&format=xls_open_total&hie=".$_GET["id"]."\" target=\"_parent\">".__("Exporter les statistiques en fichier","e-mailing-service")." .xls</a></li>
<li><a href=\"".smURL."include/export.php?liste=".sm_liste_title($fivesdraft->id_liste)."&action=export&format=xls_open_email&hie=".$_GET["id"]."\" target=\"_parent\">".__("Exporter seulement les emails en fichier","e-mailing-service")." .xls</a></li>
";
?>
</ul>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br />
<?php 
$tbaleau_insert1 =' <table class="paginate10 sortable full">
                         <thead><tr>';
$tbaleau_insert1 .="<th align=\"left\"><blockquote>".__("Email","admin-hosting")."</blockquote></th>";
$tbaleau_insert1 .="<th align=\"left\"><blockquote>".__("Date opened","admin-hosting")."</blockquote></th>";
$tbaleau_insert1 .="<th align=\"left\"><blockquote>".__("Tracking 1","admin-hosting")."</blockquote></th>";
$tbaleau_insert1 .="<th align=\"left\"><blockquote>".__("Tracking 2","admin-hosting")."</blockquote></th>";
$tbaleau_insert1 .="<th align=\"left\"><blockquote>".__("Pays","admin-hosting")."</blockquote></th>";
$tbaleau_insert1 .="</tr> </thead>
        <tbody>";
		
		$array =array (
		"site" =>  $host,
		"license_key" => get_option('sm_license_key'), 
		"login" => $user_login,
		"ip" => $_SERVER['REMOTE_ADDR'],
		"action" => "list_open_hie",
		"id" => $_GET["id"]
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php',$array);
		$xml_open = post_xml_data($fluxl,'item',array('resultat','id','email','date','track1','track2','pays'));
		//echo '<textarea name="bug" cols="150" rows="10">'.$fluxl.'</textarea>';
		if($xml_open !=''){
		foreach($xml_open as $rang) {
			if($rang[0] == 1){
			 $tbaleau_insert1 .= "<tr>
	<td><blockquote>".$rang[2]."</blockquote></td>
	<td><blockquote>".$rang[3]."</blockquote></td>
	<td><blockquote>".$rang[4]."</blockquote></td>
	<td><blockquote>".$rang[5]."</blockquote></td>
	<td><blockquote>".$rang[6]."</blockquote></td>
                             </tr>";
                             }

		}
		$tbaleau_insert1 .= '</tbody></table>';	
				echo $tbaleau_insert1;
		}

?>

            </div>
            <div class="contenu_onglet" id="contenu_onglet_link">
                <h1><?php echo __('Link statistics','e-mailing-service'); ?></h1>
                <?php
if(isset($graph)){
	if($graph == 'days7'){
echo '<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_days.php?domaine_client='.$host.'&key='.get_option('sm_license_key').'&login='.$user_login.'&hie='.$_GET["id"].'&action=hie_clic" alt="" align="right" hspace="50"  vspace="50" height="500" width="850"/>';	
	}
	elseif($graph == 'year'){
echo '<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_year.php?domaine_client='.$host.'&key='.get_option('sm_license_key').'&login='.$user_login.'&hie='.$_GET["id"].'&action=hie_clic" alt="" align="right" hspace="50"  vspace="50" height="500" width="850"/>';	
	}
} else {
echo '<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_days.php?domaine_client='.$host.'&key='.get_option('sm_license_key').'&login='.$user_login.'&hie='.$_GET["id"].'&action=hie_clic" alt="" align="right" hspace="50"  vspace="50" height="500" width="850"/>';	
} ?><br />
<ul>
<li><?php echo __('Newsletter subject','e-mailing-service'); ?>  :  <a href="<?php echo get_option('siteurl')?>/?p=<?php echo $_GET["id"];?>" target="_blank"><?php echo get_the_title($id_newsletter);?> </a></li>
<li><?php echo __('Contact list','e-mailing-service'); ?>  :  <?php echo sm_liste_title($fivesdraft->id_liste);?></li>
<li><?php echo __('Sent To','e-mailing-service'); ?>  :  <?php echo $total_envoi;?></li>
<li><?php echo __('Date send','e-mailing-service'); ?>  :  <?php echo $fivesdraft->date_envoi;?></li>
<li><?php echo __('Date start','e-mailing-service'); ?>  :  <?php echo $fivesdraft->date_demarrage;?></li>
<li><?php echo __('Date finish','e-mailing-service'); ?>  :  <?php echo $fivesdraft->date_fin;?></li>
<li><?php echo __('Opened','e-mailing-service'); ?>  :  <?php echo $row[3];?></li>
<li><?php echo __('Open Rate','e-mailing-service'); ?>  : <?php echo $pourcent_lecture;?> %</li>
<li><?php echo __('Click link','e-mailing-service'); ?>  :  <?php echo $row[4];?></li>
<li><?php echo __('Click-through Rate','e-mailing-service'); ?>  :  <?php echo $pourcent_clic;?> %</li>
<li><?php echo __('Click online','e-mailing-service'); ?>  :  <?php echo $row[5];?></li>
<li><?php echo __('Click affiliate link','e-mailing-service'); ?>  :  <?php echo $row[6];?></li>
<li><?php echo __('Unsuscribe','e-mailing-service'); ?>  :  <?php echo $row[7];?></li>
<li><?php echo __('Bounced','e-mailing-service'); ?>  :  <?php echo $row[8];?></li>
<li>&nbsp;</li>
<?php echo "
<li><a href=\"".smURL."include/export.php?liste=".sm_liste_title($fivesdraft->id_liste)."&action=export&format=csv_link_total&hie=".$_GET["id"]."\" target=\"_parent\">".__("Exporter les statistiques en fichier","e-mailing-service")." .csv</a></li>
<li><a href=\"".smURL."include/export.php?liste=".sm_liste_title($fivesdraft->id_liste)."&action=export&format=csv_link_email&hie=".$_GET["id"]."\" target=\"_parent\">".__("Exporter seulement les emails en fichier","e-mailing-service")." .csv</a></li>
<li><a href=\"".smURL."include/export.php?liste=".sm_liste_title($fivesdraft->id_liste)."&action=export&format=xls_link_total&hie=".$_GET["id"]."\" target=\"_parent\">".__("Exporter les statistiques en fichier","e-mailing-service")." .xls</a></li>
<li><a href=\"".smURL."include/export.php?liste=".sm_liste_title($fivesdraft->id_liste)."&action=export&format=xls_link_email&hie=".$_GET["id"]."\" target=\"_parent\">".__("Exporter seulement les emails en fichier","e-mailing-service")." .xls</a></li>
";
?>
</ul>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br />
<?php
$tbaleau_insert =' <table class="paginate10 sortable full">
                         <thead><tr>';
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Email","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Date clicked","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Link","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="</tr> </thead>
        <tbody>";
		
		$array =array (
		"site" =>  $host,
		"license_key" => get_option('sm_license_key'), 
		"login" => $user_login,
		"ip" => $_SERVER['REMOTE_ADDR'],
		"action" => "list_link_hie",
		"id" => $_GET["id"]
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php',$array);
		$xml2l = post_xml_data($fluxl,'item',array('resultat','id','email','date','link'));
		//echo '<textarea name="bug" cols="150" rows="10">'.$fluxl.'</textarea>';
		if($xml2l !=''){
		foreach($xml2l as $anh) {
			if($anh[0] == 1){
			 $tbaleau_insert .= '<tr>
	<td><blockquote>'.$anh[2].'</blockquote></td>
	<td><blockquote>'.$anh[3].'</blockquote></td>
	<td><blockquote><a href="'.$anh[4].'" target="_blank">'.$anh[4].'</a></blockquote></td>
                             </tr>';
                             }

		}
		$tbaleau_insert .= '</tbody></table>';	
				echo $tbaleau_insert;
		}

?>
            </div>
               <div class="contenu_onglet" id="contenu_onglet_bounces">
                <h1><?php echo __('Bounced statistics','e-mailing-service'); ?></h1>
 <?php

$i=0;

$total_hard = $wpdb->get_var("SELECT count( id ) AS total FROM `".$table_bounces_log."` WHERE hie = '".$_GET["id"]."' AND bounce_type ='hard'");
$total_soft = $wpdb->get_var("SELECT count( id ) AS total FROM `".$table_bounces_log."` WHERE  hie = '".$_GET["id"]."' AND bounce_type !='hard'");
$pourcent_hard=round(100 * $total_hard / $total_envoi, 2 );
$pourcent_soft=round(100 * $total_soft / $total_envoi, 2 );
?>
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_pie_v2.php?domaine_client=<?php echo $host;?>&key=<?php echo get_option('sm_license_key');?>&nb_env=<?php echo $total_envoi;?>&hard=<?php echo $total_hard;?>&soft=<?php echo $total_soft;?>&action=bounces" alt="" align="right" hspace="50"  vspace="50"/>
<ul>
<li><?php echo __('Sent To','e-mailing-service'); ?>  :  <?php echo $total_envoi;?></li>
<li><?php echo __('Total Hard bounce','e-mailing-service'); ?>  :  <?php echo $total_hard; ?></li>
<li><?php echo __('Hard bounce Rate','e-mailing-service'); ?>  : <?php echo $pourcent_hard;?> %</li>
<li><?php echo __('Total Soft bounce','e-mailing-service'); ?>  :  <?php echo $total_soft;?></li>
<li><?php echo __('Soft bounce Rate','e-mailing-service'); ?>  :  <?php echo $pourcent_soft;?> %</li>
<li>&nbsp;</li>
<?php echo "
<li><a href=\"".smURL."include/export.php?liste=".sm_liste_title($fivesdraft->id_liste)."&action=export&format=csv_hard_bounces&hie=".$_GET["id"]."\" target=\"_parent\">".__("Exporter Hard Bounces en fichier","e-mailing-service")." .csv</a></li>
<li><a href=\"".smURL."include/export.php?liste=".sm_liste_title($fivesdraft->id_liste)."&action=export&format=csv_soft_bounces&hie=".$_GET["id"]."\" target=\"_parent\">".__("Exporter Soft Bounces en fichier","e-mailing-service")." .csv</a></li>
<li><a href=\"".smURL."include/export.php?liste=".sm_liste_title($fivesdraft->id_liste)."&action=export&format=xls_hard_bounces&hie=".$_GET["id"]."\" target=\"_parent\">".__("Exporter Hard Bounces en fichier","e-mailing-service")." .xls</a></li>
<li><a href=\"".smURL."include/export.php?liste=".sm_liste_title($fivesdraft->id_liste)."&action=export&format=xls_soft_bouncesl&hie=".$_GET["id"]."\" target=\"_parent\">".__("Exporter Soft Bounces en fichier","e-mailing-service")." .xls</a></li>
";
?>
</ul>

<br /><br /><br /><br /><br /><br /><br /><br />
<?php 

$tbaleau_insert =' <table class="paginate10 sortable full">
                         <thead><tr>';
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("ID Campaign","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Email","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Date bounced","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Type","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Type","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Details","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="</tr> </thead>
        <tbody>";


$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_bounces_log."` WHERE hie='".$_GET["id"]."' ORDER BY id DESC LIMIT 100");
foreach ( $fivesdrafts as $fivesdraft ) 
{
			 $tbaleau_insert .= "<tr>
	<td><blockquote>".$fivesdraft->hie."</blockquote></td>
	<td><blockquote>".$fivesdraft->email."</blockquote></td>
	<td><blockquote>".$fivesdraft->date."</blockquote></td>
	<td><blockquote>".$fivesdraft->rules_cat."</blockquote></td>
	<td><blockquote>".$fivesdraft->bounce_type."</blockquote></td>
	<td width=\"50%\"><blockquote>".$fivesdraft->diag_code."</blockquote></td>
                             </tr>";
}
$tbaleau_insert .= '</tbody></table>';	
echo $tbaleau_insert;
?>
            </div>
               <div class="contenu_onglet" id="contenu_onglet_unsuscribe">
                <h1><?php echo __('Unsubscribe statistics','e-mailing-service'); ?></h1>
<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_pie_v2.php?domaine_client=<?php echo $host;?>&key=<?php echo get_option('sm_license_key');?>&nb_env=<?php echo $total_envoi;?>&nb_unsuscribe=<?php echo $row[7];?>&action=unsuscribe" alt="" align="right" hspace="50"  vspace="50"/>
<ul>
<li><?php echo __('Sent To','e-mailing-service'); ?>  :  <?php echo $total_envoi;?></li>
<li><?php echo __('Click Unsubscribe','e-mailing-service'); ?>  :  <?php echo $row[7];?></li>
<li>&nbsp;</li>
<?php echo "
<li><a href=\"".smURL."include/export.php?liste=".sm_liste_title($fivesdraft->id_liste)."&action=export&format=csv_unsuscribe&hie=".$_GET["id"]."\" target=\"_parent\">".__("Exporter desinscrit en fichier","e-mailing-service")." .csv</a></li>
<li><a href=\"".smURL."include/export.php?liste=".sm_liste_title($fivesdraft->id_liste)."&action=export&format=xls_unsuscribes&hie=".$_GET["id"]."\" target=\"_parent\">".__("Exporter desinscrit en fichier","e-mailing-service")." .xls</a></li>
";
?>
</ul><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

<?php
$tbaleau_insert =' <table class="paginate10 sortable full">
                         <thead><tr>';
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Email","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Date opened","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Tracking 1","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Tracking 2","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Pays","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="</tr> </thead>
        <tbody>";
		
		$array =array (
		"site" =>  $host,
		"license_key" => get_option('sm_license_key'), 
		"login" => $user_login,
		"ip" => $_SERVER['REMOTE_ADDR'],
		"action" => "list_unsubscribe_hie",
		"id" => $_GET["id"]
		); 
        $fluxl =xml_server_api('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php',$array);
		$xml2l = post_xml_data($fluxl,'item',array('resultat','id','email','date','track1','track2','pays'));
		//echo '<textarea name="bug" cols="150" rows="10">'.$fluxl.'</textarea>';
		if($xml2l !=''){
		foreach($xml2l as $row) {
			if($row[0] == 1){
			 $tbaleau_insert .= "<tr>
	<td><blockquote>".$row[2]."</blockquote></td>
	<td><blockquote>".$row[3]."</blockquote></td>
	<td><blockquote>".$row[4]."</blockquote></td>
	<td><blockquote>".$row[5]."</blockquote></td>
	<td><blockquote>".$row[6]."</blockquote></td>
                             </tr>";
                             }

		}
		$tbaleau_insert .= '</tbody></table>';	
			echo $tbaleau_insert;	
		}

?>
            </div>
        </div>
    </div>		
<?php		
	}

if ($_REQUEST['section'] == 'log'){
$tbaleau_insert =' <table class="paginate50 sortable full">
                         <thead><tr>';
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Campaign ID","admin-hosting")."</blockquote></th>";					
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Email","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Message-ID","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Date","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="<th align=\"left\"><blockquote>".__("Details","admin-hosting")."</blockquote></th>";
$tbaleau_insert .="</tr> </thead>
        <tbody>";
if(isset($_GET["hie"])){
	if($user_role=='administrator'){
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_messageid."` WHERE hie='".$_GET["hie"]."' ORDER BY id DESC LIMIT 100");
	} else {
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_messageid."` WHERE hie='".$_GET["hie"]."' AND user_id='".$user_id."' ORDER BY id DESC LIMIT 100");		
	}
} else {
	if($user_role=='administrator'){
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_messageid."` ORDER BY id DESC LIMIT 100");
	} else {
$fivesdrafts = $wpdb->get_results("SELECT * FROM `".$table_messageid."` WHERE user_id='".$user_id."' ORDER BY id DESC LIMIT 100");		
	}
}
foreach ( $fivesdrafts as $fivesdraft ) 
{
			 $tbaleau_insert .= "<tr>
	<td><blockquote>".$fivesdraft->hie."</blockquote></td>
	<td><blockquote>".$fivesdraft->email."</blockquote></td>
		<td><blockquote>".$fivesdraft->messageid."</blockquote></td>
	<td><blockquote>".$fivesdraft->date."</blockquote></td>
	<td><blockquote>".$fivesdraft->status."</blockquote></td>
                             </tr>";
}

$tbaleau_insert .= '</tbody></table>';	
echo $tbaleau_insert;
}
				if ($_REQUEST['section'] == 'campagne'){
	$xml2=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php?action=campagne&login='.$user_login.'&domaine_client='.$host.'&key='.get_option('sm_license_key').'','item',array('resultat','id','titre','lecture','clic','clic_page','clic_affiliation','desinscription'));
$tableau_ticket = '<table class="paginate10 sortable full">
				<thead>
						<tr>
                            <th>ID</th>
							<th>CAMPAGNE</th>
							<th>Lecture</th>
                            <th>CLIC</th>
                            <th>CLIC PAGE</th>
							<th>CLIC AFFILIATION</th>
							<th>DESINSCRIT</th>
						</tr>
					</thead>					
					<tbody>';
if($xml2!='') {
    foreach($xml2 as $row) {
$tableau_ticket .= "<tr>
<td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td>
<td>".$row[6]."</td><td>".$row[7]."</td>
</tr>
	"; 
    }
    }
$tableau_ticket .= '</tbody></table>';
echo $tableau_ticket;
    
		}
		
		} 
		elseif('section' =='journalier') {
?>
	<div class="h1 with-menu">

<form class="form" id="tab-stats" method="post" action="?page=e-mailing-service/admin/stats_user.php&section=<?php echo $section;?>">
<table width="95%">
<tr>
<td>
<select name="m" id="m">
                                <option value="<?php echo $m;?>" selected="selected">
<?php echo ''.__('Mois','admin-hosting').' : '.__($name_mois[$m],'admin-hosting').''; ?> </option>
								<option value="01">Janvier</option>
								<option value="02">Fevrier</option>
                                <option value="03">Mars</option>
								<option value="04">Avril</option>
                                <option value="05">Mai</option>
								<option value="06">Juin</option>
                                <option value="07">Juillet</option>
								<option value="08">Aout</option>
                                <option value="09">Septembre</option>
								<option value="10">Octobre</option>
                                <option value="11">Novembre</option>
								<option value="12">Decembre</option>
</select>
</td>
<td>
							<select name="y" id="y">
                            <option value="<?php echo $y;?>" selected="selected">
				<?php echo ''.__('Annee','admin-hosting').' : '.$y.'';?> </option>                            
                            <?php 
							for($i=2013;$i<$y;$i++){
								echo "<option value=\"$i\">$i</option>";
							}
							
							?>
							</select>
</td>
<td>
							<select name="srv" id="srv">
                            <option value="tous" selected="selected">
							<?php _e('Tous les serveurs','admin-hosting');?>
                            </option>                            
<?php
	$xml_select_serveur=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php?action=select_serveur&login='.$user_login.'&domaine_client='.$host.'&key='.get_option('sm_license_key').'','item',array('resultat','des','nb'));
    if($xml_select_serveur!='') {
    foreach($xml_select_serveur as $row_serveur) {
    echo "<option value=\"".$row_serveur[1]."\">".$row_serveur[1]." (".$row_serveur[2].")</option>"; 
    }
    }
							 
							?>
							</select>
                            </td>
<td>
							<select name="fai" id="fai">
                            <option value="tous" selected="selected"><?php _e('Tous les fournisseurs','admin-hosting');?></option>                            
 <?php

	$xml_select_fai=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php?action=select_fai&login='.$user_login.'&domaine_client='.$host.'&key='.get_option('sm_license_key').'','item',array('resultat','des','nb'));
    if($xml_select_fai!='') {
    foreach($xml_select_fai as $row_fai) {
    echo "<option value=\"".$row_fai[1]."\">".$row_fai[1]." (".$row_fai[2].")</option>"; 
    }
    }
							 
							?>
							</select>
                            </td>
<td>
							<select name="site" id="site">
                            <option value="tous" selected="selected">
							<?php _e('Tous les sites','admin-hosting');?></option>                            
<?php
	$xml_select_site=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php?action=select_site&login='.$user_login.'&domaine_client='.$host.'&key='.get_option('sm_license_key').'','item',array('resultat','des','nb'));
    if($xml_select_site!='') {
    foreach($xml_select_site as $row_site) {
    echo "<option value=\"".$row_site[1]."\">".$row_site[1]." (".$row_site[2].")</option>"; 
    }
    }
							 
							?>
							</select>
                            </td>
<td>
							<select name="t1" id="t1">
                            <option value="tous" selected="selected"><?php _e('Tous les tracks','admin-hosting');?>1</option>   <?php
	$xml_select_track1=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php?action=select_track1&login='.$user_login.'&domaine_client='.$host.'&key='.get_option('sm_license_key').'','item',array('resultat','des','nb'));
    if($xml_select_track1!='') {
    foreach($xml_select_track1 as $row_track1) {
    echo "<option value=\"".$row_track1[1]."\">".$row_track1[1]." (".$row_track1[2].")</option>"; 
    }
    }
							 
							?>
							</select>
                            </td>
<td>
							<select name="t2" id="t2">
                            <option value="tous" selected="selected"><?php _e('Tous les tracks','admin-hosting');?>2</option>                            
<?php
	$xml_select_track2=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php?action=select_track2&login='.$user_login.'&domaine_client='.$host.'&key='.get_option('sm_license_key').'','item',array('resultat','des','nb'));
    if($xml_select_track2!='') {
    foreach($xml_select_track2 as $row_track2) {
    echo "<option value=\"".$row_track2[1]."\">".$row_track2[1]." (".$row_track2[2].")</option>"; 
    }
    }
							 
							?>
							</select>
                            </td>

<td>
							<select name="pays" id="pays">
                            <option value="tous" selected="selected"><?php _e('Tous les pays','admin-hosting');?></option>                            
                            <?php
	$xml_select_pays=lit_xml_data('http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php?action=select_pays&login='.$user_login.'&domaine_client='.$host.'&key='.get_option('sm_license_key').'','item',array('resultat','des','nb'));
    if($xml_select_pays!='') {
    foreach($xml_select_pays as $row_sp) {
    echo "<option value=\"".$row_sp[1]."\">".$row_sp[1]." (".$row_sp[2].")</option>"; 
    }
    }
							 
							?>
							</select>
                            </td>
<td>
<button class="button button-green" type="submit"><?php _e('Valider la selection','admin-hosting');?></button>
</td>
</tr>
</table>
</form>
                <?php

    $tableau_ticket="<br>";
    $tableau_ticket .= '<table class="paginate50 sortable full"><thead>';
$tableau_ticket .= "<tr>
<th>".__("Date","admin-hosting")."</th>
<th>".__("Ouverture","admin-hosting")."</th>
<th>".__("Clic lien","admin-hosting")."</th>
<th>".__("Clic page","admin-hosting")."</th>
<th>".__("Clic affiliation","admin-hosting")."</th>
<th>".__("Clic desinscription","admin-hosting")."</th>
</tr></thead> <tbody>";
$li='http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_detaille.php?action=newsletter_jour&login='.$user_login.'&site='.$host.'&mois='.date('Y-m').'&key='.get_option('sm_license_key').'';
$xml2=lit_xml_data($li,'item',array('resultat','date','lecture','clic','clic_page','clic_affiliation','desinscription','bounces'));
    foreach($xml2 as $row) {
$tableau_ticket .= "<tr><td>".$row[1]."</td><td>".(int)$row[2]."</td><td>".(int)$row[3]."</td><td>".(int)$row[4]."</td><td>".(int)$row[5]."</td><td>".(int)$row[6]."</td></tr>
	"; 
    }
    $tableau_ticket .= ' </tbody></table>';			
    echo $tableau_ticket ;
	 } 
	else {
echo '<img name="stats" src="http://www.serveurs-mail.net/wp-code/cgi_wordpress_api_stats_year.php?domaine_client='.$host.'&key='.get_option('sm_license_key').'&login='.$user_login.'&action=clic" alt="" align="left" hspace="50"  vspace="50" height="500" width="850"/>';			
	}
	}
?>
</div>



</div>
</section>
<script type="text/javascript">
        //<!--
                var anc_onglet = 'snapshot';
                change_onglet(anc_onglet);
        //-->
</script>

