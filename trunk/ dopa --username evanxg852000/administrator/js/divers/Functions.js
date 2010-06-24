function info(){
	Ext.Msg.alert('Evance','Im going to do what you ask me to do!');
};
function traiterep(texte) //cette petite fonction converti du texte en tableau
	 {
		var nb_char=texte.length;
		var element="";
		var j=0; //compteur d'index du tableau
		var resultat= new Array();  // format du tableau= $LANGAGE|$SITENAME|$GREET_MSG|$COPYRIGHT|$MODE|$VALID_PROCEDURE|$EMAIL_ADMIN|$NB_CHARGEMENT_PAR_MN|$DELAI|$KEYWORDS|
		 for (i=0;i<=nb_char;i++)
		 {
			   if (texte.charAt(i)=="|")
				{
					resultat[j]=element;
					element='';
					j=j+1;
				}
				else
				{
				element=element+texte.charAt(i);	
				}

         }
	   return resultat;
	 };


function get_num()
{
var conn = new Ext.data.Connection();
		conn.request({
					url: 'admin-users/get_num_connecte.php',
					method:	'POST',	
					success: function(resp,opt) {
													var contenu=traiterep(resp.responseText);
													G_NUM_CONNECTE=contenu[0];
													if (contenu[1]=="Super_admin"){G_EST_SUPER_ADMIN=true;}else{G_EST_SUPER_ADMIN=false;}
												},
					failure: function(resp,opt) {
													Ext.Msg.alert('Error','Erreur d\initialisation abandonner !');
												}
		            });
};

function load_stats()
{
		var conn = new Ext.data.Connection();
		conn.request({
					url: 'admin-statistique/stats.php',
					method:	'POST',	
					success: function(resp,opt) {
													G_CONTENU_STATS=resp.responseText;
												},
					failure: function(resp,opt) {
													G_CONTENU_STATS="impossible de charger les statistiqe";
												}
		            });
};

function ouvre_fenetre(identifiant,tab,id)
{
    G_TABLE=tab;
    G_NUM=id;
	var module = MyDesktop.getModule(identifiant);
	if(module){
	module.createWindow();
	}							
};

function  chargement()
{
Ext.MessageBox.show({
           title: 'Initialisation',
           msg: 'Chargement des modules de base...',
           progressText: 'Chargement en cours...',
           width:300,
           progress:true,
           closable:false,
           animEl: 'mb6'
       });

       // this hideous block creates the bogus progress
       var f = function(v){
            return function(){
                if(v == 12){
                    Ext.MessageBox.hide();
                }else{
                    var i = v/11;
                    Ext.MessageBox.updateProgress(i, Math.round(100*i)+'% completed');
                }
           };
       };
       for(var i = 1; i < 13; i++){
           setTimeout(f(i), i*500);
       }
};

function openhelp()
{
window.open('help/index.html', 'new', 'width=1200,height=650,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no');
};

function openconfig()
{
	var module = MyDesktop.getModule('confg_editor');
	if(module){
	module.createWindow();
	}							
};

function waituninstall()
{
	Ext.MessageBox.show({
           msg: 'Desinstallation en cours...',
           progressText: 'Desinstallation...',
           width:300,
           wait:true,
           waitConfig: {interval:200},
           icon:'desinstall', 
           animEl: 'mb7'
       });
   setTimeout(function(){ Ext.MessageBox.hide();}, 4000);
};

function recove_file(repertoire,fichier)
{
var connexion = new Ext.data.Connection();
		connexion.request({
					url: 'common/recove_file.php',
					method:'POST',	
					params:{
					dir:repertoire,	
					file:fichier
					},
					success: function(resp,opt) {
													
													Ext.Msg.alert('Dopa',resp.responseText);
												},
					failure: function(resp,opt) {
													Ext.Msg.alert('Dopa','Imposible de recupere le fichier');
												}
		            });
};

function appercu_template(nom) //cette fonction ouvre une popup pour voire l'appercu du template choisi dans le gestionnaire de template
{
window.open('../appercu.php?design='+nom);
};

function get_max_size_upload()
{
		//initialisation pour obtenir le max file
		var req_max_size = new Ext.data.Connection();
		     req_max_size.request({
				url: 'installer/max_file_size.php',
				method:	'POST',	
						success: function(resp,opt) {	
														
														G_MAX_FILE_SIZE=resp.responseText;
													}
							});
};	
