<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Papermashup.com | jQuery Form Preview Tool</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#preview').hide();	
$("#photo").click(update);
$("#title").keypress(update);
});
	
function update(){		
		
$('#preview').slideDown('slow');
var title = $("#title").val();
var photo = $("#photo").val();
$('#Displaytitle').html(title);
$('#image').html('<iframe src="'+photo+'" width="750" height="900"></iframe> ');
}


</script>
<style>
.left {
	width:400px;
	float:left;
	font-size:13px;
	color:#333;
	margin-right:20px;
}
.right {
	width:400px;
	float:left;
	margin-right:20px;
}
#preview {
	min-height:910px;
	background-color:#FFC;
	padding:10px;
	font-size:12px;
	color:#999;
	border:1px solid #FF9;
}
#title {
	margin-top:10px;
	padding:5px;
	font-size:13px;
	color:#000;
	border:1px solid #CCC;
	font-family:Verdana, Geneva, sans-serif;
}
#photo {
	margin-bottom:10px;
}
#image {
	margin-top:5px;
}
#Displaytitle {
	font-size:14px;
	color:#333;
	margin-top:5px;
}
</style>
</head>
<body>
<div id="container">
  <h3>jQuery Form Preview Demo</h3>

    <form>
    <table>
    <tr>Subject<td><td><input name="subject" type="text" /></td></tr>
    <tr><td>Choisit un modele</td>
    <td>
      <select name="pic" class="click" id="photo">
        <option value="http://www.serveursmtp.fr/wp-content/plugins/admin-hosting/admin_marketing/admin/resources/email_templates/Basic/Basic%20Template%201/index.html" selected="selected">Tweet.me.it</option>
        <option value="http://www.serveurs-mail.net">Dotdashcreate.com</option>
        <option value="http://www.serveursmtp.fr/wp-content/plugins/admin-hosting/admin_marketing/admin/resources/email_templates/Basic/Basic%20Template%201/index.html">Papermashup.com</option>
      </select></td></tr>
   <tr><td>Passez à l'etape 2</td><td>   <input name="submit" type="submit" value="create" /></td></tr>
    </table>
    </form>
<br>
    <div id="preview"> This is how your advert will look
      <div id="image"></div>
      <div id="Displaytitle"></div>
    </div>

  <div class="clear"></div>
</div>
</body>
</html>
