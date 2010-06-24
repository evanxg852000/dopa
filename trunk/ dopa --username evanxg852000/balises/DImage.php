<?php
function DImage($image,$titre,$L,$H)
{
	echo '<div class="image"  style=" border-width: 1px; float: left; width: 120px;" align="center">'."\n";
					echo '<img src="'.$image.'" width="'.$L.'" height="'.$H.'"  alt="'.$image.'" title="'.$image.'" border="0" />'."\n";
			        echo '<div class="labelimage" style="text-align: center;" align="center">'.$titre.'</div>'."\n";
	echo '</div>'."\n";
}
?>