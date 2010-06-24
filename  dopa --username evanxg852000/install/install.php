<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<title>Install DOPA V0.3</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="style/st.css" type="text/css" />
</head>
<?php 
//iclusion des fonctions et lybrairie
require_once('base/fonctions.php');
$error=array(); //tableau d'erreurs

	//afectation des donnees du formulaire
	//1
	$type_db=$_POST['typedb'];
	$serverdb=$_POST['serveurbd'];
	$userdb=$_POST['userdb'];
	$passbd=$_POST['motpassdb'];
	$dbname=$_POST['dbname'];
	$prefixe=$_POST['prefixedb'];
	$dbpath=$_POST['dbpath'];
	$mailadmin=$_POST['mailadmin'];
	//2
	$serversmtp=$_POST['hotesmtp'];
	$loginsmtp=$_POST['loginsmtp'];
	$passsmtp=$_POST['passsmtp'];
	$mailsmtp=$_POST['mailsmtp'];
	
	$serverftp=$_POST['hoteftp'];
	$portftp=$_POST['portftp'];	
	$loginftp=$_POST['loginftp'];
	$passftp=$_POST['passftp'];
	//3
	$sitename=$_POST['nomst'];
	$titlesite=$_POST['titre'];
	$lang=$_POST['langue'];
	$slogan=$_POST['slogan'];
	$description=$_POST['description'];
	$autheur=$_POST['autheurst'];
	$mode=$_POST['modeafichage'];
	
	$name_ets=$_POST['nomets'];
	$tel_ets=$_POST['tel'];
	$fax_ets=$_POST['fax'];
	$email_ets=$_POST['email'];
	$adresse_ets=$_POST['adresse'];
	//fin recuperation formulaire
	
	//seting des vars non changeables
	$VALID_PROCEDURE="GO"; 
	$DELAI=60;
	$NB_CHARGEMENT_PAR_MN=10;
	$MAILER = 'mail';
	$SENDMAIL = '/usr/sbin/sendmail';
	$SMTPAUTH = '0';
	$GENERATOR="Dopa";
	$ROBOT="index, follow";
	
	
	$path_root=get_path($_SERVER['SCRIPT_FILENAME']); //C:/wamp/www/DopaV03/
	
	//prepartion du contenu des fichiers config et config_var
$CONTENU_CONFIG='<?php  
$AUTHOR="'.$autheur.'";
$TITLE="'.$titlesite.'"; 
$DESCRIPTION="'.$description.'";
$GENERATOR="Dopa";
$ROBOT="index, follow";
//variable base de donnes
$TYPE_BD="'.$type_db.'";
$SERVER="'.$serverdb.'";
$USERNAME="'.$userdb.'";
$PASSSQL="'.$passbd.'";
$DBNAME="'.$dbname.'";
$DB_PREF="'.$prefixe.'"; 
$DBPATH="'.$dbpath.'";
//variables ftp
$PATH_ROOT="'.$path_root.'"; 
$HOST_FTP="'.$serverftp.'";
$PORT_FTP="'.$portftp.'";
$USER_FTP="'.$loginftp.'";
$PASS_FTP="'.$passftp.'";
/* variables mail */
$SMTPUSER = "'.$loginsmtp.'";
$SMTPPASS ="'.$passsmtp.'";
$SMTPHOST = "'.$serversmtp.'";
$MAILFROM = "'.$email_ets.'";
$MAILER = "mail";
$FROMNAME = "'.$name_ets.'";
$SENDMAIL = "/usr/sbin/sendmail";
$SMTPAUTH = "0";
/* variables entreprise */
$ESTNAME="'.$name_ets.'";
$FAX_ETS="'.$fax_ets.'";
$TEL_ETS="'.$tel_ets.'";
$EMAIL_ETS="'.$email_ets.'";
$ADRESSE_ETS="'.$adresse_ets.'";
?>';
	
$CONTENU_CONFIG_VAR='<?php 
$LANGAGE="'.$lang.'"; 
$SITENAME="'.$sitename.'";
$GREET_MSG="'.$slogan.'";  
$COPYRIGHT="'.$name_ets.'";   
$MODE="'.$mode.'";             
$KEYWORDS="'.$sitename.','.$name_ets.'";
$VALID_PROCEDURE="'.$VALID_PROCEDURE.'"; 
$DELAI='.$DELAI.';
$NB_CHARGEMENT_PAR_MN='.$NB_CHARGEMENT_PAR_MN.';
$EMAIL_ADMIN="'.$mailadmin.'";
?>';	
//creation e la base de donnee
include_once('base/database.php');
	switch($type_db)
	{
		case 'mysql':
			$db=new dbmysql($dbname,$serverdb,$userdb,$passbd);
			$test=$db->createtables($TABLES) ;
			unset($db);
			if(!$test)
				{
					$i=count($error);
					$error[$i]=false;
				}
		break;
		case 'sqlite':
			$db=new dbsqlite($dbpath,$dbname.'.ddb');
			$test=$db->createtables($TABLES_SQLITE) ;
			unset($db);
			if(!$test)
				{
					$i=count($error);
					$error[$i]=false;
				}
		break;
	}

//creation des fichiers config 
$test=createconfig('../kernel/configuration.php',$CONTENU_CONFIG);
if(!$test)
{
	$i=count($error);
	$error[$i]=false;
}
$test=createconfig('../kernel/configuration_var.php',$CONTENU_CONFIG_VAR);
if(!$test)
{
	$i=count($error);
	$error[$i]=false;
}
?>
<body>
<?php
//analyse du tableau d'eureur
if (count($error)==0)
{
echo '<div class="succes">	<h4 align="center">Installtion terminee avec succes</h4>
		<br>Login Admin: Admin
		<br>Pass Admin: admin
	</div>';
	echo 'NB: supprimer le repertoire d\'installation &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../index.php">Aller sur le site</A>';
}
else
{
	echo '<div class="fail">Echeque de l\'installation du fichier</div>';
}
?>
</body>
</html>