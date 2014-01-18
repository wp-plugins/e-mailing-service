<h2><?php _e("Posez une question public sur notre FAQ","e-mailing-service");?></h2>
<h3><?php _e("Verifier avant d'envoyer que votre question n'existe pas deja !<br>  
Si vous faites de la promotion abusive , vous prenez le risque d'etre bloque et de ne plus pouvoir acceder a la faq","e-mailing-service");?></h3>
<?php 
	if(get_option('sm_license')=="free" || !get_option('sm_license_key')){
_e("Pour pouvoir posez une question public sur notre FAQ, vous devez activer gratuitement la permission d'interagir avec notre site dans la rubrique ","e-mailing-service");
echo "<a href=\"?page=e-mailing-service/admin/configuration.php\">".__("License et options","e-mailing-service")."</a>";		
	} else { 
	?>
<form action="?page=e-mailing-service/admin/support.php&section=faq" method="post">
<input type="hidden" name="action" value="insert_question" />
<table>
        <tbody>
<tr>
  <td><?php _e('Email',"e-mailing-service");?></td>
  <td><input type="text" name="email"  size="75" value="<?php echo get_option('admin_email'); ?> "/></td>
</tr>
<tr>
  <td><?php _e('Question',"e-mailing-service");?></td>
  <td><textarea name="question" cols="75" rows="20"></textarea>
    </td>
</tr>
<tr>
  <td></td>
  <td><input name="submit" value="<?php _e('Posez votre question',"e-mailing-service");?>" type="submit" /></td>
</tr>
</tbody>
</table>
</form>

<?php } ?>
