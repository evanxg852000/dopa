

<html>
<head>
<title>Erreur 404</title>
<meta name="robots" content="noindex, follow">
</head>
<body>
<p align="center"><font size="3" color="#008000">La page <?php echo get_complete_url(); ?> n'existe pas ou a &eacute;t&eacute; d&eacute;plac&eacute;e.</font></p>
<p align="center"><font size="2" color="#008000">Un mail a &eacute;t&eacute; envoy&eacute; au webmaster afin de corriger cette erreur.</font></p>
<p align="center"><a href="http://<?php echo $_SERVER['HTTP_HOST'] . CHEMIN_RACINE; ?>">Accueil</a> <?php if (isset($_SERVER['HTTP_REFERER'])) { echo ' | <a href="' . $_SERVER['HTTP_REFERER'] . '" onclick="javascript:history.go(-1); return false;">Page pr&eacute;c&eacute;dente</a>'; } ?></p>
</body>
</html>
