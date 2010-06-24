function Template(){
 var desktop = this.app.getDesktop();
		
	//===============================================inserer les variable (var pari= new) ici=================================
		function miniature(val) //cette fonction genere le html de la colone miniature
		{
		 return '<img src="../design/'+val+'/miniature.png" width="150" height="60">';
		};
		
		function etat_p(val) //cette fonction affiche une etoile dans la colone etat 
		{
			var cont_html="";
			if (val==1)
			{
				cont_html='<img src="style/icons/star.png" >';
			}
			else
			{
				cont_html='<img src="style/icons/stop.png" >';
			}
		 return cont_html;
		};
		
		var ds_model_template = Ext.data.Record.create([   {name: 'Num', mapping: 'Num'},'Nom', 'Etat']); // modele de la table
			
      var store_template=new Ext.data.Store({
			url: 'admin-template/template.php',
			reader: new Ext.data.JsonReader({
				root:'rows',
				id:'Num'
			},ds_model_template )
	    });
	 //fin instance 			

		
	// dessin du grid (contenu de la fenetre) de la fenetre	
		var gride_template=  new Ext.grid.EditorGridPanel({
                        border:false,
					    store:store_template,
						clickstoEdit: 1,
                        columns: [
								{header: "Numero", width: 100, dataIndex: 'Num', sortable: true},
								{header: "Nom", width: 180, dataIndex: 'Nom' , sortable: true},
								{header: "Etat", width: 180, dataIndex: 'Etat',renderer:etat_p, sortable: true},
								{header: "Miniature", width: 150, dataIndex: 'Nom',renderer: miniature, sortable: true}
							],
						sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
						keys: [{}],
                        viewConfig: {
                            forceFit:true
                        },
                        //autoExpandColumn:'company',

                        tbar:[{
									text:'Appercu',
									tooltip:'Add a new row',
									iconCls:'zoom-in',
									handler: function () { 
												var sm = gride_template.getSelectionModel();
												var sel = sm.getSelected();
												if (sm.hasSelection()){
													appercu_template(sel.data.Nom);
												}
												else
												{
												Ext.Msg.alert('Dopa','selectioner une ligne!');
												}														
									}
							},{
                            text:'Definir Comme Design',
                            tooltip:'Add a new row',
                            iconCls:'publish',
							handler: function () { 
											var sm = gride_template.getSelectionModel();
												var sel = sm.getSelected();
												if (sm.hasSelection()){
													Ext.Msg.show({
														title: 'Dopa', 
														buttons: Ext.MessageBox.YESNOCANCEL,
														msg: 'Etes vous certain de vouloir definir <b>'+sel.data.Nom+'</b> comme design actuelle?',
														fn: function(btn){
															if (btn == 'yes'){
																
																var conn = new Ext.data.Connection();
																conn.request({
																	url: 'admin-template/template-update.php',
																	params: {
																		action: 'default',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		 store_template.load();
																	},
																	failure: function(resp,opt) { 
																		Ext.Msg.alert('Error','operation echoue !'); 
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
									text:'Desinstaller',
									tooltip:'Add a new row',
									iconCls:'remove',
									handler: function () { 
												var sm = gride_template.getSelectionModel();
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
																		Type: 'design',
																		Num: sel.data.Num,
																		Nom: sel.data.Nom
																	},
																	success: function(resp,opt) { 
																		 gride_template.getStore().remove(sel);
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
									text:'Raffraichir',
									tooltip:'Raffraichir le tableau',
									iconCls:'refresh',
									handler: function () { 
										store_template.load();				
									}							       	
									},'-',{
									text:'Editer',
									tooltip:'Editer le css',
									iconCls:'css',
									handler: function () { 
										var sm = gride_template.getSelectionModel();
												var sel = sm.getSelected();
												if (sm.hasSelection()){
													window.open('admin-template/css-edit.php?template='+sel.data.Nom);
												}
												else
												{
												Ext.Msg.alert('Dopa','selectioner une ligne!');
												}						
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
//fin dessin du gride_template
			
//===============================================FIN inserer les variable (var pari= new) ici=================================
				
//creation de la fenetre 				
        var win = desktop.getWindow('template');
        if(!win){
            win = desktop.createWindow({
                id: 'template',
                title:'Gestion Template',
                width:740,
                height:480,
                iconCls: 'template',
                shim:false,
                animCollapse:false,
                constrainHeader:true,
                layout: 'fit',
                items: gride_template,	//encapsulation du gride_template dans la fenetre 
				bbar: new Ext.StatusBar({
									defaultText: 'Dopa V0.3',
									id: 'bar-template',
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
			var mask_template = new Ext.LoadMask(Ext.get('template'), {store:store_template,msg:'Chargement...'}); //effet pour le chargement de donnee 
			store_template.load();
        }
        win.show();
    }