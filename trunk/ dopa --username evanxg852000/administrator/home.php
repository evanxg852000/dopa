<?php
session_start();
if (!isset($_SESSION['login']) && !isset($_SESSION['pass'])) {
header ('Location: index.php');
exit();
}
include('common/calender.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Dopa 0.2 | Admin</title>

	<!-- divers -->

	<script type="text/javascript" src="js/divers/Variables-Globales.js"></script>	
	<script type="text/javascript" src="../library/evanjs/horloge.js"></script>
	<script type="text/javascript" src="js/divers/Functions.js"></script>
	<!-- /divers -->
 	<!-- library -->
	 <link rel="stylesheet" type="text/css" href="../library/extjs/resources/css/ext-all.css" />
 	 <script type="text/javascript" src="../library/extjs/adapter/ext/ext-base.js"></script>
	 <script type="text/javascript" src="../library/extjs/ext-all.js"></script>
	 <script type="text/javascript" src="../library/extjs/FileUploadField.js"></script>
	<!-- /library -->
    <!-- desktop -->
    <script type="text/javascript" src="js/module/StartMenu.js"></script>
    <script type="text/javascript" src="js/module/TaskBar.js"></script>
    <script type="text/javascript" src="js/module/Desktop.js"></script>
    <script type="text/javascript" src="js/module/App.js"></script>
    <script type="text/javascript" src="js/module/Module.js"></script>
	<script type="text/javascript" src="js/configuration.js"></script>
	<!-- /desktop -->
	<!-- fenetres -->
	<script type="text/javascript" src="js/windows/accesoires.js"></script>
				<!-- fenetres accessoires-->
					<script type="text/javascript" src="js/windows/accesoires/template.js"></script>
					<script type="text/javascript" src="js/windows/accesoires/medias.js"></script>
					<script type="text/javascript" src="js/windows/accesoires/messages.js"></script>
	                <script type="text/javascript" src="js/windows/accesoires/statistique.js"></script>
					<script type="text/javascript" src="js/windows/accesoires/publicite.js"></script>
				<!-- /fenetres accessoires-->	
	<script type="text/javascript" src="js/windows/ipbloc.js"></script>
	<script type="text/javascript" src="js/windows/news.js"></script>
	<script type="text/javascript" src="js/windows/articles.js"></script>
	<script type="text/javascript" src="js/windows/categories.js"></script>
	<script type="text/javascript" src="js/windows/menu.js"></script>
	<script type="text/javascript" src="js/windows/rss.js"></script>
	<script type="text/javascript" src="js/windows/plugins.js"></script>
	<script type="text/javascript" src="js/windows/editor.js"></script>
	<script type="text/javascript" src="js/windows/installer.js"></script>
	<script type="text/javascript" src="js/windows/users.js"></script>
	<script type="text/javascript" src="js/windows/configuration_edit.js"></script>
	<!-- /fenetres -->

    <link rel="stylesheet" type="text/css" href="style/css/desktop.css" />
	<link rel="stylesheet" type="text/css" href="style/css/medias.css" />
	<link rel="stylesheet" type="text/css" href="style/css/calendar.css" />
</head>
<body scroll="no">

<div id="x-desktop">

    <div id="layer1" >
		 <?php calender(); ?>
    </div>
	
    <p><a href="help/index.html" target="_blank" style="margin:5px; float:right;"><img src="style/images/shortcut/aide.png" /></a></p>
			
    <dl id="x-shortcuts">

		<dt id="articles-shortcut">
			<a href="#"><img src="style/images/s.gif" />  
				<div>Articles</div>
			</a>
        </dt>

		<dt id="categories-shortcut">
			<a href="#"><img src="style/images/s.gif" />  
				<div>Categorie</div>
			</a>
        </dt>
		
		<dt id="confg_editor-shortcut">
			<a href="#"><img src="style/images/s.gif" />  
				<div>Configuration</div>
			</a>
        </dt>
		
		<dt id="editor-shortcut">
			<a href="#"><img src="style/images/s.gif" />  
				<div>Editeur</div>
			</a>
        </dt>
		
		<dt id="installer-shortcut">
			<a href="#"><img src="style/images/s.gif" />  
				<div>Installer</div>
			</a>
        </dt>	
		
        <dt id="grid-win-shortcut">
			<a href="#"><img src="style/images/s.gif" /> 
				<div>Securite</div>
			</a>
        </dt>
		
        <dt id="users-shortcut">
			<a href="#" ><img src="style/images/s.gif" />
				<div>Utilisateurs</div>
			</a>
        </dt>
		
    </dl>
</div>
<div id="ux-taskbar">
	<div id="ux-taskbar-start" style="background-color:black; background-image:url('style/images/taskbar/black/taskbar-start-panel-bg.gif'); background-repeat:repeat-x; background-position:0% 0%; padding:0; position:absolute; left:0px; z-index:1;"></div>
	<div id="ux-taskbuttons-panel" style="background-image:url('style/images/taskbar/black/taskbuttons-panel-bg.gif');"><FORM name="horloge"><INPUT id="watch" TYPE="text" size="18" NAME="watch" SIZE=15 VALUE =""></FORM></div>
	<div class="x-clear"></div>
</div>

</body>
</html>
