MyDesktop.CONFG_Editor = Ext.extend(Ext.app.Module, {
    id:'confg_editor',
    init : function(){
        this.launcher = {
            text: 'Configuration',
            iconCls:'computer',
            handler : this.createWindow,
            scope: this
        }
    },

    createWindow : function(){
        var desktop = this.app.getDesktop();
//chargement du combo langue		
		var Lang= new Ext.data.Store({
            reader: new Ext.data.JsonReader({
                fields: ['Id','Lang'],
                root: 'rows'
            }),
            proxy: new Ext.data.HttpProxy({
                url: 'admin-configuration/lang-load.php'
            }),
            autoLoad: true
        });
	
			
  var config_form = new Ext.FormPanel({
	    url: 'admin-configuration/config-edit-submit.php',
		 border:false,
        labelAlign: 'top',
        frame:true,
        bodyStyle:'padding:5px 5px 0',
        items: [{
            layout:'column',
            items:[{
                columnWidth:.3,
                layout: 'form',
                items: [{
                    xtype:'combo',
                    fieldLabel: 'Language',
                    name: 'LANGAGE',
					mode: 'local',
					store: Lang,
					triggerAction: 'all',
					editable: false,
					displayField:'Lang',
					valueField: 'Id',
                    anchor:'95%'
					},{
					xtype:'textfield',
                    fieldLabel: 'Site Name',
                    name: 'SITENAME',
                    anchor:'95%'
					},{
                    xtype:'textfield',
                    fieldLabel: 'Slogan',
                    name: 'GREET_MSG',
                    anchor:'95%'
                }]
				},{
				columnWidth:.3,
                layout: 'form',
                items: [{
                    xtype:'textfield',
                    fieldLabel: 'Entreprise',
                    name: 'COPYRIGHT',
                    anchor:'95%'
                    },{
					xtype:'combo',
                    fieldLabel: 'Mode d\'affichage',
                    name: 'MODE',
					triggerAction: 'all',
					editable: false,
					store: ['Default','Ajax'],
                    anchor:'95%'
					},{
                    xtype:'textfield',
                    fieldLabel: 'Procedure Valide',
                    name: 'VALID_PROCEDURE',
                    anchor:'95%'
                }]
				},{
                columnWidth:.3,
                layout: 'form',
                items: [{
                    xtype:'textfield',//hidden
                    fieldLabel: 'Email Admin',
                    name: 'EMAIL_ADMIN',
                    anchor:'95%'
                },{
                    xtype:'combo',
                    fieldLabel: 'Nombre Chargement /Mn',
                    name: 'NB_CHARGEMENT_PAR_MN',
					triggerAction: 'all',
					store: ['2','3','4','5','6','7','8','9','10','15','25'],
                    anchor:'95%'
                },{
					xtype:'combo',
                    fieldLabel: 'Delai (seconde)',
                    name: 'DELAI',
					triggerAction: 'all',
					store: ['30','60','120','180','240','300'],
                    anchor:'95%'
				}]
            }]
        },{
            xtype:'htmleditor',//textarea
            fieldLabel:'Mot Cles',            
			name:'KEYWORDS',
            height:240,
            anchor:'98%'
        }],
        buttons:[{
				text: 'Save',
				handler: function(){
                    config_form.getForm().submit({
                        success: function(f,a){
                            Ext.Msg.alert('Dopa','Changement effectue<br>Un backup de l\'ancien fichier est dispobnible');
                        },
                        failure: function(f,a){
                            if (a.failureType === Ext.form.Action.CONNECT_FAILURE){
                                Ext.Msg.alert('Echec', 'Server reported:'+a.response.status+' '+a.response.statusText);
                            }
                            if (a.failureType === Ext.form.Action.SERVER_INVALID){
                                Ext.Msg.alert('Warning', a.result.errormsg);
                            }
                        }
                    });
				}
			}, {
				text: 'Cancel',
				handler: function(){
					//config_form.getForm().reset();
					 Ext.Msg.alert('Dopa', 'Veillez fermer la fenetre');
				}
			},{
				text:'Recupere le backup',
			    handler: function(){
					recove_file("kernel/","configuration_var.php");
                } 
			}]

    });

    //requete de lecture du fichier de configuration
     
	 
	var req_load = new Ext.data.Connection();
		     req_load.request({
				url: 'admin-configuration/config-edit.php',
				method:	'POST',	
/*NO parametre	params: {
				sample1: 'news',
				sample2:'2',
						}, */
						success: function(resp,opt) {													
													contenu=traiterep(resp.responseText);
													config_form .getForm().findField('LANGAGE').setValue(contenu[0]);
													config_form .getForm().findField('SITENAME').setValue(contenu[1]);
													config_form .getForm().findField('GREET_MSG').setValue(contenu[2]);
													config_form .getForm().findField('COPYRIGHT').setValue(contenu[3]);
													config_form .getForm().findField('MODE').setValue(contenu[4]);
													config_form .getForm().findField('VALID_PROCEDURE').setValue(contenu[5]);
													config_form .getForm().findField('EMAIL_ADMIN').setValue(contenu[6]);
													config_form .getForm().findField('NB_CHARGEMENT_PAR_MN').setValue(contenu[7]);
													config_form .getForm().findField('DELAI').setValue(contenu[8]);
													config_form .getForm().findField('KEYWORDS').setValue(contenu[9]);
													},
													failure: function(resp,opt) {
													Ext.Msg.alert('Error','chargement impossible!');
													}
							});
		
        var wini = desktop.getWindow('confg_editor');
        if(!wini){
            wini = desktop.createWindow({
                id: 'confg_editor',
                title:'Configuration',
                width:740,
                height:480,
                iconCls: 'computer',
                shim:false,
                animCollapse:false,
                constrainHeader:true,
				layout: 'fit',
				items:config_form ,
				tbar:[{
					text:'Php Info()',
                    tooltip:'Add a new row',
                    iconCls:'php',
				    handler: function(){
							window.open('common/php-info.php');
                       } 
					},'-',{	
					text:'Serveur',
                    tooltip:'Variables serveur',
                    iconCls:'server',
				    handler: function(){
							window.open('common/server-info.php');
                       }
		        }]

            });
        }
        wini.show();
    }
		
});

