<?php
include_once(dirname(__FILE__) . '/functions.php');

my_mysql_select_db();
controle_ip(!empty($_SERVER['REMOTE_USER']));  //si le user est renseigné c'est que le mot de passe est faux => tentative de piratage
my_mysql_close();
?>
<html>
<head>
<title>Erreur 401</title>
<meta name="robots" content="noindex, follow">
</head>
<body>
<p align="center"><font size="3" color="#008000">La page <?php echo get_complete_url(); ?> est prot&eacute;g&eacute;e par mot de passe.</font></p>
<p align="center"><font size="2" color="#008000">Un mail est envoy&eacute; au webmaster et l'IP est bloqu&eacute;e en cas de tentative de piratage.</font></p>
<p align="center"><a href="http://<?php echo $_SERVER['HTTP_HOST'] . CHEMIN_RACINE; ?>">Accueil</a> <?php if (isset($_SERVER['HTTP_REFERER'])) { echo ' | <a href="' . $_SERVER['HTTP_REFERER'] . '" onclick="javascript:history.go(-1); return false;">Page pr&eacute;c&eacute;dente</a>'; } ?></p>
</body>
</html>
