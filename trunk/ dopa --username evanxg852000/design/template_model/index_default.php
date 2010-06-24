<?php DHead("<!-- comment -->") ?>
<?php
/*marche
DCherche();
DAffichedate();
DCalendrier();
DBanner(array('a.jpg','b.jpg','c.jpg','d.png'));
DFlashNews();
DNews();
DCompteur();
DAdminEnligne();
DNewsletter();
DRss();
DMenu(true);
DEligne(true);
DPied();
DSondage(2);
DPublicite(1);
*/
?>
<body>
<div id="cherche">
			<?php DCherche() ?>
</div>

	<div id="header">
	
		<div class="logo"><h1><a href="index.php"><?php echo $SITENAME ?></a><span><?php echo $GREET_MSG ?></span></h1></div>
		 <?php MenuHorizontal() ?>
		 
	</div>

<div id="contenu">
	<div id="cadre_droite">
			
			<div class="mod_menu" >
				<?php DMenu(1) ?>									
			</div>
							
			<div class="mod_menu" style="background:#495674">
				<?php DEligne(3) ?>									
			</div>
			
			<div class="mod_menu" style="background:#495674">
				<?php DExtentions(1) ?>									
			</div>
		
			<div class="mod_menu" style="background:#495674">
				<?php DSondage(2) ?>									
			</div>
			
			<div class="mod_menu" style="background:#495674">
				<?php DPublicite(1) ?>									
			</div>

			<div class="mod_menu" style="background:#495674">
				<?php DIdentification(1) ?>									
			</div>
	<div class="mod_menu" style="background:#495674">
				<?php DFlashNews(2); ?>									
			</div>
	</div>
	
	<div id="contenu_pricipal">
		<?php DContenu() ?>	
		
		
	</div>

	<p id="footer"><?php DPied()?></p>

</div>
</body>
</html>





	

	

</body>

</html>
