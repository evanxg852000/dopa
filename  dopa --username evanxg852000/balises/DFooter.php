<?php
function DPied()
{
	   Global $LANG,$JSWIDGETS; 
	    
	    echo $LANG['conception'].$LANG['siteconception'].$LANG['copyright'];
        echo '<a href="#"  id="top" >'.$LANG['top'].'</A><br> ';
		echo $LANG['validation'] ;
		
		echo '<script language="JavaScript" type="text/javascript">';
		for($i=0;$i<count($JSWIDGETS);$i++)
		{
			echo 'var cpg_'.$i.' = new Spry.Widget.CollapsiblePanelGroup("'.$JSWIDGETS[$i]['id'].'",'.$JSWIDGETS[$i]['config'].');';

			//echo 'var cpg_'.$i.' = new Spry.Widget.CollapsiblePanelGroup("'.$JSWIDGETS[$i]['id'].'");'; //CollapsiblePanelGroup1
		}
		echo '</script>';  
}       
/*exple
	<div id="pied">
		<?php DPied(); ?>
	</div>
*/	
?>