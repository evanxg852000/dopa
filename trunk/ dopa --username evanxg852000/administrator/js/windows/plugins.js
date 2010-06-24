MyDesktop.Plugins = Ext.extend(Ext.app.Module, {
    id:'plugins',
    init : function(){
        this.launcher = {
            text: 'Gestion Plugins',
            iconCls:'plugin',
            handler : this.createWindow,
            scope: this
        }
    },

	createWindow : function(){
        var desktop = this.app.getDesktop();
		
	//===============================================inserer les variable (var pari= new) ici=================================
		
		var ds_model_plugins = Ext.data.Record.create([   {name: 'Num', mapping: 'Num'},'Nom', 'Lien', 'Publie']); // modele de la table
			
      var store_plugins=new Ext.data.Store({
			url: 'admin-plugins/plugins.php',
			reader: new Ext.data.JsonReader({
				root:'rows',
				id:'Num'
			},ds_model_plugins )
	    });
	 //fin instance 			

	// variable edition du grid
		
		var Nom_edit = new Ext.form.TextField();
				
	// dessin du grid (contenu de la fenetre) de la fenetre	
		var gride_plugins=  new Ext.grid.EditorGridPanel({
                        border:false,
					    store:store_plugins,
						clickstoEdit: 1,
                        columns: [
								{header: "Numero", width: 100, dataIndex: 'Num', sortable: true},
								{header: "Nom", width: 180, dataIndex: 'Nom', editor: Nom_edit , sortable: true},
								{header: "Lien", width: 180, dataIndex: 'Lien', sortable: true},
								{header: "Publie", width: 80, dataIndex: 'Publie', sortable: true},
							],
						sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
						listeners: {
									afteredit: function(e){
										var conn = new Ext.data.Connection();
											conn.request({
											url: 'admin-plugins/plugins-update.php',
											method: 'POST',
											params: {
												action: 'update',
											    Num: e.record.id,
												field: e.field,
												value: e.value
											},
											success: function(resp,opt) {
												e.commit();
											},
											failure: function(resp,opt) {
												e.reject();
											}
										});
									}
						
						},
						keys: [{}],
                        viewConfig: {
                            forceFit:true
                        },
                        //autoExpandColumn:'company',

                        tbar:[{
                            text:'Publier',
                            tooltip:'Add a new row',
                            iconCls:'publish',
							handler: function () { 
											var sm = gride_plugins.getSelectionModel();
												var sel = sm.getSelected();
												if (sm.hasSelection()){
													Ext.Msg.show({
														title: 'Dopa', 
														buttons: Ext.MessageBox.YESNOCANCEL,
														msg: 'Etes vous certain de vouloir publier '+sel.data.Nom+'?',
														fn: function(btn){
															if (btn == 'yes'){
																
																var conn = new Ext.data.Connection();
																conn.request({
																	url: 'admin-plugins/plugins-update.php',
																	params: {
																		action: 'publie',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		 store_plugins.load();
																	},
																	failure: function(resp,opt) { 
																		Ext.Msg.alert('Error','Suppression Impossible !'); 
																	}
																});
															}
														}
													});
												}
												else
												{
												Ext.Msg.alert('Dopa','selectioner une ligne!');
												}	
												
												
							}//info() est defini dans divers/function
                        },'-',{
                            text:'Depublier',
                            tooltip:'Remove the selected item',
                            iconCls:'unpublish',
							handler: function(){
												var sm = gride_plugins.getSelectionModel();
												var sel = sm.getSelected();
												if (sm.hasSelection()){
													Ext.Msg.show({
														title: 'Dopa', 
														buttons: Ext.MessageBox.YESNOCANCEL,
														msg: 'Etes vous certain de vouloir depublier '+sel.data.Nom+'?',
														fn: function(btn){
															if (btn == 'yes'){
																
																var conn = new Ext.data.Connection();
																conn.request({
																	url: 'admin-plugins/plugins-update.php',
																	params: {
																		action: 'depublie',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		 store_plugins.load();
																	},
																	failure: function(resp,opt) { 
																		Ext.Msg.alert('Error','Suppression Impossible !'); 
																	}
																});
															}
														}
													});
												}
												else
												{
												Ext.Msg.alert('Dopa','selectioner une ligne!');
												}
											}
							},'-',{
									text:'Desinstaller',
									tooltip:'Add a new row',
									iconCls:'remove',
									handler: function () { 
												var sm = gride_plugins.getSelectionModel();
												var sel = sm.getSelected();
												if (sm.hasSelection()){
													Ext.Msg.show({
														title: 'Dopa', 
														buttons: Ext.MessageBox.YESNOCANCEL,
														msg: 'Etes vous certain de vouloir desinstaller '+sel.data.Nom+'?',
														fn: function(btn){
															if (btn == 'yes'){
																var conn = new Ext.data.Connection();
																conn.request({
																	url: 'installer/desinstaller.php',
																	params: {
																		Type: 'plugin',
																		Num: sel.data.Num,
																		Lien: sel.data.Lien
																	},
																	success: function(resp,opt) { 
																		 gride_plugins.getStore().remove(sel);
																		 Ext.Msg.alert('Dopa',resp.responseText);
																	},
																	failure: function(resp,opt) { 
																		Ext.Msg.alert('Error','Desinstallation Impossible !'); 
																	}
																});
															}
														}
													});
												}
												else
												{
												Ext.Msg.alert('Dopa','selectioner une ligne!');
												}														
									}								
				
								},'-',{
									text:'Enregistrer',
									tooltip:'Add a new row',
									iconCls:'save',
									handler: function () { 
										store_plugins.load();				
									}							       	
							},'-',{
						    text:'Aide ?',
                            tooltip:'Add a new row',
                            iconCls:'help',
							handler: function () { 
								openhelp();				
							}//openhelp() est defini dans divers/function
						}]
                    })
					;
//fin dessin du gride_plugins
				
				
//===============================================FIN inserer les variable (var pari= new) ici=================================
				
//creation de la fenetre 				
        var win = desktop.getWindow('plugins');
        if(!win){
            win = desktop.createWindow({
                id: 'plugins',
                title:'Gestion Plugins',
                width:740,
                height:480,
                iconCls: 'plugin',
                shim:false,
                animCollapse:false,
                constrainHeader:true,
                layout: 'fit',
                items: gride_plugins,	//encapsulation du gride_plugins dans la fenetre 
				bbar: new Ext.StatusBar({
									defaultText: 'Dopa V0.3',
									id: 'bar-plugin',
									items: [{
										text: 'Dopa Home',
										tooltip:'Aller sur le site',
										iconCls:'dopa',
										handler: function()	{
													window.open('http://evansofts.com');
												}
										}, '-',    new Date().format('n/d/Y')]
								})
            });
			var mask_plugins = new Ext.LoadMask(Ext.get('plugins'), {store:store_plugins,msg:'Chargement...'}); //effet pour le chargement de donnee 
			store_plugins.load();
        }
        win.show();
    }
});

