<?php
function DRss()
{
	Global $LANG;
	echo '<A href="rss/rssnews.php" target="_blank"><img src="media/icons/rss/'.$LANG['rss_icon'].'.png" style="BORDER: 0px">'.$LANG['rss_label'].'</A>'."\n";
}
/*exple
	<div id="rss">
		DRss()
	</div>
*/
?>