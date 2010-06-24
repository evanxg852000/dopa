<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<title>Install DOPA V0.3</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="style/style.css" type="text/css" />
<script language="javascript" src="base/fonctions.js"></script>
</head>
<body onload="initialisation()">
<?php
if(file_exists('../kernel/configuration.php'))//verifie si l'install existe   
{
	echo '<p class="error">Atention! Une Installation existe deja</p>';
}
?>
<FORM method="POST" name="install" id="install" action="install.php">

<FIELDSET id="etape1">
<LEGEND align=top>1 Base donnes</LEGEND>
<table border="0">
<tr>
	<td align="left" width="130px">
		<label for="typedb">Type de Base:</label>
	</td>
	<td>
		<select id="typedb" name="typedb" class="inputbox" onchange="change_typebd(this.form)"/>
			<option>mysql</option>
			<option>sqlite</option>
		</select>
	</td>
	<td align="left" width="130px">
		<label for="serveurbd">Serveur:</label>
	</td>
	<td>
		<input id="serveurbd" type="text" name="serveurbd" class="inputbox" value="localhost"  onblur="if(this.value=='') this.value='localhost';" onfocus="if(this.value=='localhost') this.value='';"/>
	</td>
	<td align="left" width="130px">
		<label for="userdb">Nom d'utilisateur:</label>
	</td>
	<td>
		<input id="userdb" type="text" name="userdb" class="inputbox" value="root"  onblur="if(this.value=='') this.value='root';" onfocus="if(this.value=='root') this.value='';"/>
	</td>
	<td align="left" width="130px">
		<label for="motpassdb">Mot Pass:</label>
	</td>
	<td>
		<input id="motpassdb" type="password" name="motpassdb" class="inputbox"  />
	</td>	
</tr>
<tr>
	<td align="left" width="130px">
		<label for="dbname">Nom base:</label>
	</td>
	<td>
		<input id="dbname" type="text" name="dbname" class="inputbox" value="Dopa"  onblur="if(this.value=='') this.value='Dopa';" onfocus="if(this.value=='Dopa') this.value='';"  />
	</td>
	<td align="left" width="130px">
		<label for="prefixedb">Prefixe Tables:</label>
	</td>
	<td>
		<input id="prefixedb" type="text" name="prefixedb" class="inputbox" value="dop_"  onblur="if(this.value=='') this.value='dop_';" onfocus="if(this.value=='dop_') this.value='';" />
	</td>
	<td align="left" width="130px">
		<label for="dbpath"> Chemin Base :</label>
	</td>
	<td>
		<input id="dbpath" type="text" name="dbpath" class="inputbox"  disabled="1"/>
	</td>
	<td align="left" width="130px">
		<label for="mailadmin">Mail Admin:</label>
	</td>
	<td>
		<input id="mailadmin" type="text" name="mailadmin" class="inputbox"  />
	</td>	
</tr>
</table>		
</FIELDSET>
	
<div class="vide"></div>

<FIELDSET id="etape2">
<LEGEND align=top>2-Serveur </LEGEND>
<table border="0">
<tr>
	<td align="left" width="130px">
		<label for="hotesmtp"> Hote smtp:</label>
	</td>
	<td>
		<input id="hotesmtp" type="text" name="hotesmtp" class="inputbox"  />
	</td>
	<td align="left" width="130px">
		<label for="loginsmtp"> Login Smtp:</label>
	</td>
	<td>
		<input id="loginsmtp" type="text" name="loginsmtp" class="inputbox"  />
	</td>
	<td align="left" width="130px">
		<label for="passsmtp">Pass Smtp:</label>
	</td>
	<td>
		<input id="passsmtp" type="text" name="passsmtp" class="inputbox"  />
	</td>
	<td align="left" width="130px">
		<label for="mailsmtp">Mail smtp:</label>
	</td>
	<td>
		<input id="mailsmtp" type="text" name="mailsmtp" class="inputbox"  />
	</td>	
</tr>
<!--
<tr>
	<td align="left" width="130px">
		<label for="mo">Slogan du site:</label>
	</td>
	<td>
		<input id="mo" type="text" name="remember" class="inputbox"  />
	</td>
	<td align="left" width="130px">
		<label for="moi">Description :</label>
	</td>
	<td>
		<input id="moi" type="text" name="remember" class="inputbox" value="yes" alt="Remember Me" />
	</td>
	<td align="left" width="130px">
		<label for="mo"> Autheur :</label>
	</td>
	<td>
		<input id="mo" type="text" name="remember" class="inputbox"  />
	</td>
	<td align="left" width="130px">
		<label for="mo">Tel:</label>
	</td>
	<td>
		<input id="mo" type="text" name="remember" class="inputbox"  />
	</td>	
</tr> 
-->
<tr>
	<td align="left" width="130px">
		<label for="hoteftp">Hote Ftp :</label>
	</td>
	<td>
		<input id="hoteftp" type="text" name="hoteftp" class="inputbox" value="127.0.0.1"  onblur="if(this.value=='') this.value='127.0.0.1';" onfocus="if(this.value=='127.0.0.1') this.value='';" />
	</td>
	<td align="left" width="130px">
		<label for="portftp">Port Ftp:</label>
	</td>
	<td>
		<input id="portftp" type="text" name="portftp" class="inputbox" value="21" onblur="if(this.value=='') this.value='21';" onfocus="if(this.value=='21') this.value='';" />
	</td>
	<td align="left" width="130px">
		<label for="loginftp">Login Ftp:</label>
	</td>
	<td>
		<input id="loginftp" type="text" name="loginftp" class="inputbox"  />
	</td>	
	<td align="left" width="100px">
		<label for="passftp">Pass FTP:</label>
	</td>
	<td>
		<input id="passftp" type="password" name="passftp" class="inputbox"  />
	</td>	
</tr>
</table>		
</FIELDSET>
	
<div class="vide"></div>
	
<FIELDSET id="etape3">
<LEGEND align=top>3 Site et Entreprise </LEGEND>
<table border="0">
<tr>
	<td align="left" width="130px">
		<label for="nomst"> Nom du site:</label>
	</td>
	<td>
		<input id="nomst" type="text" name="nomst" class="inputbox"  />
	</td>
	<td align="left" width="130px">
		<label for="titre"> Titre du site:</label>
	</td>
	<td>
		<input id="titre" type="text" name="titre" class="inputbox" />
	</td>
	<td align="left" width="130px">
		<label for="langue"> Langue du site:</label>
	</td>
	<td>
		<select id="langue" name="langue" class="inputbox"  />
			<option>fr</option>
			<option>en</option>
		</select>
	</td>
</tr>
<tr>
	<td align="left" width="130px">
		<label for="slogan">Slogan du site:</label>
	</td>
	<td>
		<input id="slogan" type="text" name="slogan" class="inputbox"  />
	</td>
	<td align="left" width="130px">
		<label for="description">Description du Site :</label>
	</td>
	<td>
		<input id="description" type="text" name="description" class="inputbox" />
	</td>
	<td align="left" width="130px">
		<label for="autheurst"> Autheur du Site :</label>
	</td>
	<td>
		<input id="autheurst" type="text" name="autheurst" class="inputbox"  />
	</td>	
</tr>
<tr>
	<td align="left" width="130px">
		<label for="modeafichage">Mode d'Affichage:</label>
	</td>
	<td>
		<select id="modeafichage" name="modeafichage" class="inputbox"  />
			<option>default</option>
			<option>ajax</option>
		</select>
	</td>
	<td align="left" width="130px">
		<label for="nomets">Nom de l'Entreprise:</label>
	</td>
	<td>
		<input id="nomets" type="text" name="nomets" class="inputbox" />
	</td>
	<td align="left" width="130px">
		<label for="tel">Tel:</label>
	</td>
	<td>
		<input id="tel" type="text" name="tel" class="inputbox"  />
	</td>	

</tr>
<tr>
	<td align="left" width="130px">
		<label for="fax">Fax:</label>
	</td>
	<td>
		<input id="fax" type="text" name="fax" class="inputbox" />
	</td>
	<td align="left" width="130px">
		<label for="email">E-mail:</label>
	</td>
	<td>
		<input id="email" type="text" name="email" class="inputbox"  />
	</td>
	<td align="left" width="130px">
		<label for="adresse">Adresse:</label>
	</td>
	<td>
		<input id="adresse" type="text" name="adresse" class="inputbox"  />
	</td>	
</tr>
</table>
</FIELDSET>
	
<div class="vide"></div>

<FIELDSET id="finalisation">
<LEGEND align=top>Installation</LEGEND>
			
	<INPUT type="button"  class="button" value="Installer..." onclick="verifie_form(install)"/>&nbsp;<INPUT type="button" class="button" value="Verifier le System" onclick="document.location.href='verifiersystem.php'">		
</FIELDSET>
</FORM>
	

	
</body>
</html>
