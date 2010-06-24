<?php
include("connection.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- NE PAS CHANGER LES LIGNES PRECEDENTES-->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<LINK rel="stylesheet" href="style/css/connexion.css" type="text/css">
	<link rel="shortcut icon" href="style/images/favicon.ico" />
    <title></title>
 
</head>
<body >
<center>
<h2>Admin <?php echo $LANG['sitename']; ?> </h2>
<hr  id="tabsE"> </hr>
       <h2>Connection</h2>
<hr  id="tabsE"> </hr>
<table class="pag" width="1070" >
	<tr>
		<td width="1060" height="64" align="right" style="background:url('style/images/logo.png') no-repeat;">
		   <h2>Dopa Version 0.1</h2>
		</td>
	</tr>
    <tr>
	
        <td width="1060"  align="center" >
		<img src="style/images/security.png">
							<form action="index.php" method="post" name="login" class="login-username" >
									<p id="form-login-username">
										<label for="modlgn_username">Identifiant</label><br />
										<input id="modlgn_username" type="text" class="inputbox" size="18" alt="username" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"  >
									</p>
									<p id="form-login-password">
										<label for="modlgn_passwd">Mot de passe</label><br />
										<input id="modlgn_passwd" class="inputbox" size="18" type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>">
									</p>
										<input type="submit" name="connexion" class="button" value="Connexion" />
										<input type="button" name="view" class="button" value="Appercu" onclick="document.location.href='../index.php'"/>
							</form>
		</td>
    </tr>
	<tr>
		<td width="1060" height="10" align="center">
		   <div style=" padding: 5px 0; text-align: center; color:#9B0000 ;">
					     <font  style="font-family:verdana;font-size:11px" > &copy  2007-2009 Evansofts TM. Tous Droits Réservés.  </font> 
		   </div>
		</td>
	</tr>
</table>


	


	
	
</center>
</body>
</html>