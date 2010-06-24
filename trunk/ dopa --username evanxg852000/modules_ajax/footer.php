<?php
function footer()
{
	   Global $LANG;
	   
	    echo '<div class="footer">';
	    echo $LANG['conception'].$LANG['siteconception'].$LANG['copyright'];
        echo '<a href="#"  id="top" >'.$LANG['top'].'</A><br>  ';
		echo $LANG['validation'] ;
		echo '</div>';
		
		echo '<script language="JavaScript" type="text/javascript">';
		echo 'var cpg = new Spry.Widget.CollapsiblePanelGroup("CollapsiblePanelGroup1");';
		echo '</script>';  
}       
?>