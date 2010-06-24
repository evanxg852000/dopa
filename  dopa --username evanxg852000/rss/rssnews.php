<?php
include("../system.admin.php");

$sql = 'SELECT* From '.$DB_PREF.'rssnews';
$req=new DatabaseRequest($sql);
$resultat=$req->Select();	
unset($req);
$nb_ligne =count($resultat);

echo'<?xml version="1.0" encoding="ISO-8859-1"?>';
echo '<?xml-stylesheet type="text/xsl" href="style.xslt" ?>';
echo '<rss version="2.0">';
   echo '<channel>';
   
            echo '<title>'.$LANG['title_rss'].'</title>';
			echo '<link>'.$LANG['rssfournisseur'].'</link>';
			echo '<description>'.$LANG['description_rss'].'</description>';

 if ( $nb_ligne<=0 ) 
 {
	        echo'<item>';
					echo '<title>'.$LANG['aucun_rss'].'</title>'."\n";
					echo '<link>'.$LANG['rssfournisseur'].'</link>';
					echo '<guid isPermaLink="true">No_rss</guid>';
					echo '<description></description>';
					echo '<pubDate></pubDate>';
			echo '</item>';
	  
 }
 else 
 {
   for ( $i=0; $i<$nb_ligne; $i++) 
   {
	        echo '<item>';
					echo '<title>'.$resultat[$i]['Titre'].'</title>';
					echo '<link>'.$resultat[$i]['Lien'].'</link>';
					echo '<guid isPermaLink="true">num'.$resultat[$i]['Num'].'</guid>';
					echo '<description>'.$resultat[$i]['Description'].'</description>';
					echo '<pubDate>'.$resultat[$i]['Date'].'</pubDate>';
			echo '</item>';
   }
   
 }
   echo '</channel>'; 
echo '</rss>';
?>