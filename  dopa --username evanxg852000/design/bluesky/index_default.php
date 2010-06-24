<?php
head("<!-- vos fichier js dans votre template -->") ; //c'est dans ce comment qu vous devez inserer vos fichier js
// ou autre chose dans le head
?>
<body>
<?php
search('cherche');

rss();
echo "<br>";
day();
echo "<br>";
compteur();
admin_online();
plugin();
newsletter();
footer();

?>
	
	
</body>

</html>
