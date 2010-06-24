<?php 
//VARIABLES DE CONFIGURATION

//variable du site et configuration
$AUTHOR="evance soumaoro";
$TITLE="Evansofts"; //titre de la page web
$DESCRIPTION="Dopa un cms comme le cms";
$GENERATOR="Dopa";
$ROBOT="index, follow";
$MAINTENANCE_MSG = 'Ce site est en maintenance.<br /> Merci de revenir ultérieurement.';
	
//variable base de donnes
$TYPE_BD="mysql"; //ou sqlite
$SERVER="localhost";
$USERNAME="root";
$PASSSQL="";
$DBNAME="dopa";
$DB_PREF=""; //dop_categorie (dop_)
	
/*   -description for Sqlite-:
$DBPATH="C:/wamp/sqlitemanager/";
 $DBNAME="dopa";
 */


//variables ftp
$PATH_ROOT="C:/wamp/www/DopaV03/"; //chemin racine du site sera definit a l'installation
$HOST_FTP="127.0.0.1";
$PORT_FTP= '21';
$USER_FTP= '';
$PASS_FTP= '';

/* Mail Settings */
$mailer = 'mail';
$mailfrom = 'evansoft@yahoo.fr';
$fromname = 'music';
$sendmail = '/usr/sbin/sendmail';
$smtpauth = '0';
$smtpuser = '';
$smtppass = '';
$smtphost = 'localhost';

/* variables entreprise */
$ESTNAME='evansoft co';
$FAX_ETS='223657';
$TEL_ETS='76 514 96 46';
$EMAIL_ETS='evansofts@yahoo.fr';
$ADRESSE_ETS='Conakry,Guinee';
?>