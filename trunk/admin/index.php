<?php 
include(smPATH . '/include/entete.php');
if(!isset($_GET["sm_lg"])){
$img_lg =substr(WPLANG, 0, 2);
} else {
$img_lg=$_GET["sm_lg"];	
}
if($img_lg == "fr"){
$sm_image ="Flat-Design-Pricing-Tables-2_fr.jpg";
$sm_lg_rep="/";	
}
elseif($img_lg == "it"){
$sm_image ="Flat-Design-Pricing-Tables-2_it.jpg";
$sm_lg_rep="/it/";			
}
elseif($img_lg == "de"){
$sm_image ="Flat-Design-Pricing-Tables-2_de.jpg";
$sm_lg_rep="/de/";			
}
elseif($img_lg == "pt"){
$sm_image ="Flat-Design-Pricing-Tables-2_pt.jpg";
$sm_lg_rep="/pt/";			
}
elseif($img_lg == "es"){
$sm_image ="Flat-Design-Pricing-Tables-2_es.jpg";
$sm_lg_rep="/es/";			
}
else{
$sm_image ="Flat-Design-Pricing-Tables-2_en.jpg";
$sm_lg_rep="/en/";			
}
?>
<p><em><?php _e("Notre script vous garantit la delivrabilites si votre serveur n'est pas blackliste et que votre newsletter correspond au critere editorial de chaque fournisseur d'email","e-mailing-service");?></em></p>
<p><em><?php _e('Nous garantissons ces resultats que sur nos serveurs SMTP ci-dessous',"e-mailing-service");?></em></p>
<table><tr>
  <td><a href="?page=e-mailing-service/admin/index.php&sm_lg=fr"><img src="<?php echo smURL;?>/img/France.png" width="48" height="48" border="0"/></a></td>
  <td><a href="?page=e-mailing-service/admin/index.php&sm_lg=de"><img src="<?php echo smURL;?>/img/Germany.png" width="48" height="48" border="0"/></a></td>
  <td><a href="?page=e-mailing-service/admin/index.php&sm_lg=it"><img src="<?php echo smURL;?>/img/Italy.png" width="48" height="48" border="0"/></a></td>
  <td><a href="?page=e-mailing-service/admin/index.php&sm_lg=pt"><img src="<?php echo smURL;?>/img/Portugal.png" width="48" height="48" border="0"/></a></td>
  <td><a href="?page=e-mailing-service/admin/index.php&sm_lg=es"><img src="<?php echo smURL;?>/img/Spain.png" width="48" height="48" border="0"/></a></td>
  <td><a href="?page=e-mailing-service/admin/index.php&sm_lg=en"><img src="<?php echo smURL;?>/img/us.png" width="48" height="48" border="0"/></a></td>
  </tr></table>
<img src="<?php echo get_option('siteurl');?>/wp-content/plugins/e-mailing-service/admin/images/<?php echo $sm_image;?>" alt="" name="FlatDesignPricingTables2_fr" width="1025" height="1175" border="0" usemap="#FlatDesignPricingTables2_frMap" id="FlatDesignPricingTables2_fr" />
<map name="FlatDesignPricingTables2_frMap">
 <area shape="rect" coords="292,1072,470,1116" href="http://www.e-mailing-service.net<?php echo $sm_lg_rep;?>options/?option=srv-mx&log=<?php echo @get_option('sm_login');?>&wplang=<?php echo WPLANG;?>" target="_blank">
  <area shape="rect" coords="520,1073,713,1117" href="http://www.e-mailing-service.net<?php echo $sm_lg_rep;?>options/?option=srv-smtp&log=<?php echo @get_option('sm_login');?>&wplang=<?php echo WPLANG;?>" target="_blank">
  <area shape="rect" coords="766,1070,951,1117" href="http://www.e-mailing-service.net<?php echo $sm_lg_rep;?>options/?option=mass-mailing&log=<?php echo @get_option('sm_login');?>&wplang=<?php echo WPLANG;?>" target="_blank">
  <area shape="rect" coords="298,495,484,543" href="?page=e-mailing-service/admin/configuration.php" target="_parent" />
  <area shape="rect" coords="524,495,710,543" href="http://www.e-mailing-service.net<?php echo $sm_lg_rep;?>options/?option=api-premium&log=<?php echo @get_option('sm_login');?>&wplang=<?php echo WPLANG;?>" target="_blank">
  <area shape="rect" coords="763,494,956,543" href="http://www.e-mailing-service.net<?php echo $sm_lg_rep;?>options/?option=api-mass-mailing&log=<?php echo @get_option('sm_login');?>&wplang=<?php echo WPLANG;?>" target="_blank">
  <area shape="rect" coords="235,164,256,187" href="#" id="sprytrigger1">
  <area shape="rect" coords="235,164,256,187" href="#" id="sprytrigger3">
  <area shape="rect" coords="234,195,259,218" href="#" id="sprytrigger4">
  <area shape="rect" coords="234,733,259,759" href="#" id="sprytrigger5">
  <area shape="rect" coords="235,770,258,790" href="#" id="sprytrigger6">
  <area shape="rect" coords="236,800,257,823" href="#" id="sprytrigger7">
  <area shape="rect" coords="235,830,259,854" href="#" id="sprytrigger8">
  <area shape="rect" coords="233,862,258,884" href="#" id="sprytrigger9">
  <area shape="rect" coords="235,891,259,917" href="#" id="sprytrigger10">
  <area shape="rect" coords="233,925,260,948" href="#" id="sprytrigger11">
  <area shape="rect" coords="233,956,260,981" href="#" id="sprytrigger12">
  <area shape="rect" coords="236,991,259,1010" href="#" id="sprytrigger13">
  <area shape="rect" coords="233,1016,262,1048" href="#" id="sprytrigger14">
  <area shape="rect" coords="232,226,260,251" href="#" id="sprytrigger15">
  <area shape="rect" coords="234,259,259,281" href="#" id="sprytrigger16">
  <area shape="rect" coords="232,287,257,313" href="#" id="sprytrigger17">
  <area shape="rect" coords="230,321,261,345" href="#" id="sprytrigger18">
  <area shape="rect" coords="231,348,261,377" href="#" id="sprytrigger19">
  <area shape="rect" coords="236,385,259,406" href="#" id="sprytrigger20">
  <area shape="rect" coords="234,416,259,439" href="#" id="sprytrigger21">
  <area shape="rect" coords="235,449,258,470" href="#" id="sprytrigger22">
</map>
<div class="tooltipContent" id="sprytooltip3">
 <blockquote>
   <h2><?php _e("Serveur SMTP","e-mailing-service");?></h2>
   <?php _e("<pre>Vous allez pouvoir parametrer un serveur SMTP qui va vous permettre d'envoyer sans prendre le risque de blacklister votre site principal.Le script fonctionne avec tous les serveurs SMTP.Nous garantissont les resultats inbox de nos scripts que sur nos serveurs SMTP.</pre>","e-mailing-service");?>
 </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip4">
  <blockquote>
    <h2><?php _e("REWRITING","e-mailing-service");?></h2>
    <?php _e("<pre><p>Tous les liens sont en reecriture d'url ce qui permet d'avoir des liens courts et de passer les barrieres anti-spam </p>
    <p>&nbsp;</p></pre>","e-mailing-service");?>
  </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip5">
  <blockquote>
    <h2><?php _e("Gestion NPAI","e-mailing-service");?></h2>
    <?php _e("<pre>Les NPAI sont les email en reponse avotre envoi,  en general , il previenne d'un email invalide, un eventuel blacklistage etc...

En bref des informations necessaires pour garder une base de donnee propre sans email invalide, et de continuer aconserver un bon pourcentage de delivrabilite.</pre>","e-mailing-service");?>
  </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip6">
  <blockquote>
    <h2><?php _e("Nom de domaine","e-mailing-service");?></h2>
   <pre> <?php _e("Si l'option est coche , on vous offre un nom de domaine que vous choisissez vous meme apres paiement,  qui sera dedie avos envois de newsletters.
Meilleur delivrabilite.","e-mailing-service");?></pre>
  </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip7">
  <blockquote>
    <h2><?php _e("Gestion NPAI","e-mailing-service");?></h2>
    <?php _e("<pre>Les NPAI sont les email en reponse avotre envoi,  en general , il previenne d'un email invalide, un eventuel blacklistage etc... 

En bref des informations necessaires pour garder une base de donnee propre sans email invalide, et de continuer aconserver un bon pourcentage de delivrabilite.

Si vous souscrivez anos serveurs SMTP , le script de gestion des NPAI est offert !</pre>","e-mailing-service");?>
  </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip8">
  <blockquote>
    <h2><?php _e("IP dedie","e-mailing-service");?></h2>
    <?php echo "<pre>".__("Vous etes seules sur votre IP ce qui permet d'etre sur de la qualite de vos envois, personne ne peut faire blacklister votre serveur par erreur")." ".__("vous etes le seul responsable en cas d'incident, et vous pouvez donc gerer la desinscription au cas ou vous etiez inscrit sur une liste anti-spam.")."
	".__("Indispensable pour une delivrabilite maximum","e-mailing-service").".</pre>";?>
  </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip9">
  <blockquote>
    <h2><?php _e("Script Multi-SMTP","e-mailing-service");?></h2>
    <?php _e("<pre>Si vous souscrivez al'offre mass mailing , le script multi-smtp est offert, des serveurs MX avec ip dedie et serveur dedie vous sont fournis suivant vos besoins 
et le script SMTP va envoyer atour de role sur les differents serveurs SMTP .

Fortement conseille si vous envoyer plus de 60 000 emails  par jours.</pre>","e-mailing-service");?>
  </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip10">
  <blockquote>
    <h2><?php _e("Alias d'email","e-mailing-service");?></h2>
    <?php _e("<pre>Ce que l'on appelle alias d'email et le nom de votre email par exemple alias@monnom.com
Si vous ne prenez pas une offre avec nom de domaine , l'alias vous sera fournit automatiquement , vous ne pourrez pas la choisir</pre>","e-mailing-service");?>
  </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip11">
  <blockquote>
    <h2><?php _e("Statistiques des liens","e-mailing-service");?></h2>
    <?php _e("<pre>Vous avez des statistiques d'envoi, d'ouverture , de clic , clic email dans navigateur ( vous ne visualisez pas cet email ), les desinscriptions.

Le classement est possible , par jour , par FAI , par tracking, par url , par serveur</pre>","e-mailing-service");?>
  </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip12">
  <blockquote>
    <h2><?php _e("Statistiques serveurs","e-mailing-service");?></h2>
    <?php _e("<pre>Statistiques sur les fichiers log du serveur SMTP, emails delivres ,emails mis spam , bounces .... </pre>","e-mailing-service");?>
  </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip13">
  <blockquote>
    <h2><?php _e("Blacklist et Spam Score","e-mailing-service");?></h2>
    <?php _e("<pre>Remontes journaliers :</pre>","e-mailing-service");?>
<ul>
<li><?php _e("<pre>du nombre d'inscription sur les listes anti-spam (blacklist), avec liens pour vous desinscrire au cas ou. </pre>","e-mailing-service");?></li>   
<li><?php _e("<pre>du spam score (note de qualite des emailing la note est sur 100 , la meilleur note etant 100) importante notemment pour hotmail.</pre>","e-mailing-service");?></li>
</ul>
</blockquote>
</div>
<div class="tooltipContent" id="sprytooltip14">
  <blockquote>
    <h2><?php _e("Limite d'envois","e-mailing-service");?></h2>
    <?php _e("<pre>Vous pouvez choisir la vitesse d'envois , mais si vous arrivez au bout de votre limite journaliere, le script s'arretera et reprendra le lendemain matin a 0h01.</pre>","e-mailing-service");?>
  </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip15">
  <blockquote>
    <h2><?php _e("Gestion NPAI","e-mailing-service");?></h2>
    <?php _e("<pre>Les NPAI sont les email en reponse avotre envoi,  en general , il previenne d'un email invalide, un eventuel blacklistage etc... 

En bref des informations necessaires pour garder une base de donnee propre sans email invalide, et de continuer aconserver un bon pourcentage de delivrabilite.

Si vous souscrivez anos serveurs SMTP , le script de gestion des NPAI est offert !</pre>","e-mailing-service");?>
  </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip16">
  <blockquote>
    <h2><?php _e("Importation de modeles","e-mailing-service");?></h2>
    <?php _e("<pre>Script d'importation de modeles en fichier zip ou url.
Votre modeles est alors installe automatiquement.

Il vous suffit alors de choisir un modele lors de la creation de votre newsletter et celui-ci ce met en place tous seul.
</pre>","e-mailing-service");?>
  </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip17">
  <blockquote>
    <h2><?php _e("Script Multi-SMTP","e-mailing-service");?></h2>
    <?php _e("<pre>Si vous choisissez l'offre mass mailing , vous pouvez parametrer plusieurs SMTP 
et le script effctuera une rotation reguliere entre les differents SMTP pour repartir la charge d'envoi.
Les deux premiers sont offerts a la souscription, 3 euros 50 par SMTP supplementaire.
</pre>","e-mailing-service");?>
  </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip18">
  <blockquote>
    <h2><?php _e("Gestion destinataires","e-mailing-service");?></h2>
    <?php _e("<pre>Avec le script vous allez facilement pouvoir gerer une aplusieurs liste de contact (inscrire,modifier,supprimer,desinscrire) </pre>","e-mailing-service");?>
  </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip19">
  <blockquote>
    <h2><?php _e("Statistiques des liens","e-mailing-service");?></h2>
    <?php _e("<pre>Vous avez des statistiques d'envoi, d'ouverture , de clic , clic email dans navigateur ( vous ne visualisez pas cet email ), les desinscriptions.

Le classement est possible , par jour , par FAI , par tracking, par url , par serveur</pre>","e-mailing-service");?>
  </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip20">
  <blockquote>
    <h2><?php _e("Statistiques serveurs","e-mailing-service");?></h2>
    <?php _e("<pre>Statistiques sur les fichiers log du serveur SMTP, emails delivres ,emails mis spam , bounces .... </pre>","e-mailing-service");?>
  </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip21">
  <blockquote>
    <h2><?php _e("Blacklist et Spam Score","e-mailing-service");?></h2>
    <?php _e("<pre>Remontes journaliers :</pre>","e-mailing-service");?>
    <ul>
      <li>
        <?php _e("<pre>du nombre d'inscription sur les listes anti-spam (blacklist), avec liens pour vous desinscrire au cas ou. </pre>","e-mailing-service");?>
      </li>
      <li><?php _e("<pre>du spam score (note de qualite des emailing la note est sur 100 , la meilleur note etant 100) importante notemment pour hotmail.</pre>","e-mailing-service");?></li>
     
    </ul>
    <strong><?php _e("Disponible en option au tarifs de 2 euros /mois</pre>","e-mailing-service");?></strong>
  </blockquote>
</div>
<div class="tooltipContent" id="sprytooltip22">
  <blockquote>
    <h2><?php _e("Limite d'envois","e-mailing-service");?></h2>
    <?php _e("<pre>Vous pouvez choisir la vitesse d'envois , mais si vous arrivez au bout de votre limite journaliere, le script s'arretera et reprendra le lendemain matin a 0h01.</pre>","e-mailing-service");?>
  </blockquote>
</div>
<script type="text/javascript">
var sprytooltip3 = new Spry.Widget.Tooltip("sprytooltip3", "#sprytrigger3", {useEffect:"blind"});
var sprytooltip4 = new Spry.Widget.Tooltip("sprytooltip4", "#sprytrigger4", {useEffect:"blind"});
var sprytooltip5 = new Spry.Widget.Tooltip("sprytooltip5", "#sprytrigger5", {useEffect:"blind"});
var sprytooltip6 = new Spry.Widget.Tooltip("sprytooltip6", "#sprytrigger6", {useEffect:"blind"});
var sprytooltip7 = new Spry.Widget.Tooltip("sprytooltip7", "#sprytrigger7", {useEffect:"blind"});
var sprytooltip8 = new Spry.Widget.Tooltip("sprytooltip8", "#sprytrigger8", {useEffect:"blind"});
var sprytooltip9 = new Spry.Widget.Tooltip("sprytooltip9", "#sprytrigger9", {useEffect:"blind"});
var sprytooltip10 = new Spry.Widget.Tooltip("sprytooltip10", "#sprytrigger10", {useEffect:"blind"});
var sprytooltip11 = new Spry.Widget.Tooltip("sprytooltip11", "#sprytrigger11", {useEffect:"blind"});
var sprytooltip12 = new Spry.Widget.Tooltip("sprytooltip12", "#sprytrigger12", {useEffect:"blind"});
var sprytooltip13 = new Spry.Widget.Tooltip("sprytooltip13", "#sprytrigger13", {useEffect:"blind"});
var sprytooltip14 = new Spry.Widget.Tooltip("sprytooltip14", "#sprytrigger14", {useEffect:"blind"});
var sprytooltip15 = new Spry.Widget.Tooltip("sprytooltip15", "#sprytrigger15", {useEffect:"blind"});
var sprytooltip16 = new Spry.Widget.Tooltip("sprytooltip16", "#sprytrigger16", {useEffect:"blind"});
var sprytooltip17 = new Spry.Widget.Tooltip("sprytooltip17", "#sprytrigger17", {useEffect:"blind"});
var sprytooltip18 = new Spry.Widget.Tooltip("sprytooltip18", "#sprytrigger18", {useEffect:"blind"});
var sprytooltip19 = new Spry.Widget.Tooltip("sprytooltip19", "#sprytrigger19", {useEffect:"blind"});
var sprytooltip20 = new Spry.Widget.Tooltip("sprytooltip20", "#sprytrigger20", {useEffect:"blind"});
var sprytooltip21 = new Spry.Widget.Tooltip("sprytooltip21", "#sprytrigger21", {useEffect:"blind"});
var sprytooltip22 = new Spry.Widget.Tooltip("sprytooltip22", "#sprytrigger22", {useEffect:"blind"});
</script>
