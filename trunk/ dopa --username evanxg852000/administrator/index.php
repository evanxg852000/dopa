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
    <title>Dopa Admin | <?php echo $LANG['sitename']; ?></title>

	
	
</head>
<body >
<div id="contenu">
	<div id="header">
		<h1><A href="../index.php" id="logo"><h2>Admin-<?php echo $LANG['sitename']; ?> </h2></A><span>Dopa V0.3 Express Edition</span></h1>
		<ul id="menu">
			<li><a href="../index.php">Accueil-<?php  echo $LANG['sitename']; ?> </a></li>
			<li><a href="#">Dopa Ressources </a></li>
			<li><a href="#">Forum Dopa</a></li>
		</ul>
	</div>
	<center>
	<div id="ecart">  </div>
	<div id="login" class="section">
	
	   <!-- 	<div id="fail" class="info_div"><img src="style/images/ico_error.png"><span class="ico_cancel">Incorrect username or password!</span></div>
				--><form name="loginform" id="loginform" action="index.php" method="post">
				
					<label><strong>Username</strong></label>
					<input type="text"  class="inputbox" alt="username" name="login" id="user_login"  size="28" />
					<br />
					
					<label><strong>Password</strong></label>
					<input type="password" class="inputbox"  name="pass"  alt="pass" id="user_pass"  size="28" class="input"/>
					<br />
					
					<strong>Remember Me</strong>				<input type="checkbox" id="remember" class="input noborder" /> 
					<br />
				
					<input id="save"  name="connexion" class="loginbutton" type="submit" class="submit" value="Connexion" />
					
				</form>
				<a href="#" id="passwordrecoverylink">Forgot your username or password?</a>
	    </div>		
    </center>
	<P id="footer">Evansofts TM. Tous Droits Réservés.  &copy  2007-2009</P>
</div>
</body>
</html>