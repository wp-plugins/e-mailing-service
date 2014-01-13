<h2><?php _e("Ticket","e-mailing-service");?></h2>
<h3><?php _e("Les tickets ne concernent que les problemes techniques lies a la location d'un de nos serveurs ou un probleme avec le plugin !<br>  
Pour les questions de gestion de spam ou autre vous devez lire ou posez votre question sur la FAQ","e-mailing-service");?></h3>
<?php 
	if(get_option('sm_license')=="free" || !get_option('sm_license_key')){
_e("Pour pouvoir envoyer un ticket a notre support, vous devez activer gratuitement la permission d'interagir avec notre site dans la rubrique ","e-mailing-service");
echo "<a href=\"?page=e-mailing-service/admin/configuration.php\">".__("License et options","e-mailing-service")."</a>";		
	} else { 
	?>
<form action="?page=e-mailing-service/admin/support.php&section=ticket_liste" method="post">
<input type="hidden" name="action" value="insert" />
<table>
        <tbody>
<tr>
  <td><?php _e('Email',"e-mailing-service");?></td>
  <td><input type="text" name="email"  size="75" value="<?php echo get_option('admin_email'); ?> "/></td>
</tr>
<tr>
  <td><?php _e('Sujet',"e-mailing-service");?></td>
  <td><input type="text" name="sujet"  size="75" value=""/></td>
</tr>
<tr>
  <td><?php _e('Message',"e-mailing-service");?></td>
  <td><textarea name="message" cols="75" rows="20"></textarea>
    </td>
</tr>
<tr>
  <td></td>
  <td><input name="submit" value="<?php _e('Envoyez votre ticket',"e-mailing-service");?>" type="submit" /></td>
</tr>
</tbody>
</table>
</form>

<?php } ?>