MyDesktop.Categories = Ext.extend(Ext.app.Module, {
    id:'categories',
    init : function(){
        this.launcher = {
            text: 'Gestion Categories',
            iconCls:'categorie',
            handler : this.createWindow,
            scope: this
        }
    },

	createWindow : function(){
        var desktop = this.app.getDesktop();
		
	//===============================================inserer les variable (var pari= new) ici=================================
		
		var ds_model_categories = Ext.data.Record.create([   {name: 'Num', mapping: 'Num'},'Nom', 'Publie']); // modele de la table
			
      var store_categories=new Ext.data.Store({
			url: 'admin-categories/categories.php',
			reader: new Ext.data.JsonReader({
				root:'rows',
				id:'Num'
			},ds_model_categories )
	    });
	 //fin instance 			

	// variable edition du grid
		
		var Nom_edit = new Ext.form.TextField();
		
	// dessin du grid (contenu de la fenetre) de la fenetre	
		var gride_categories=  new Ext.grid.EditorGridPanel({
                        border:false,
					    store:store_categories,
						clickstoEdit: 1,
                        columns: [
								{header: "Numero", width: 100, dataIndex: 'Num', sortable: true},
								{header: "Nom", width: 180, dataIndex: 'Nom', editor: Nom_edit , sortable: true},
								{header: "Publie", width: 100, dataIndex: 'Publie' , sortable: true},
							],
						sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
						listeners: {
									afteredit: function(e){
										var conn = new Ext.data.Connection();
											conn.request({
											url: 'admin-categories/categories-update.php',
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
							text:'Ajouter',
                            tooltip:'Add a new row',
                            iconCls:'add',
							handler: function () { 
							
												var x= gride_categories.getStore().getCount();
												var conn = new Ext.data.Connection();
												conn.request({
													url: 'admin-categories/categories-update.php',
													method:	'POST',	
													params: {
														action: 'insert',
														Nom:'New Categorie',
														Num: x+1,
													},
													success: function(resp,opt) {		
																			//var x= gride_categories.getStore().getCount();
																			gride_categories.getStore().insert(x, new ds_model_categories({Num: x+1, Nom:'New Categorie', Publie:'N'}));
																			gride_categories.startEditing(gride_categories.getStore().getCount()-1,1);
													},
													failure: function(resp,opt) {
														Ext.Msg.alert('Error','Ajout Impossible !');
													}
												});
							               }//info() est defini dans divers/function
							},{
                            text:'Publier',
                            tooltip:'Add a new row',
                            iconCls:'publish',
							handler: function () { 
											var sm = gride_categories.getSelectionModel();
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
																	url: 'admin-categories/categories-update.php',
																	params: {
																		action: 'publie',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		 store_categories.load();
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
												var sm = gride_categories.getSelectionModel();
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
																	url: 'admin-categories/categories-update.php',
																	params: {
																		action: 'depublie',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		 store_categories.load();
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
									text:'Supprimer',
									tooltip:'Add a new row',
									iconCls:'remove',
									handler: function () { 
												var sm = gride_categories.getSelectionModel();
												var sel = sm.getSelected();
												if (sm.hasSelection()){
													Ext.Msg.show({
														title: 'Dopa', 
														buttons: Ext.MessageBox.YESNOCANCEL,
														msg: 'Etes vous certain de vouloir supprimer '+sel.data.Nom+'?',
														fn: function(btn){
															if (btn == 'yes'){
																
																var conn = new Ext.data.Connection();
																conn.request({
																	url: 'admin-categories/categories-update.php',
																	params: {
																		action: 'delete',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		 gride_categories.getStore().remove(sel);
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
									text:'Enregistrer',
									tooltip:'Add a new row',
									iconCls:'save',
									handler: function () { 
										store_categories.load();				
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
//fin dessin du gride_categories
				
				
//===============================================FIN inserer les variable (var pari= new) ici=================================
				
//creation de la fenetre 				
        var win = desktop.getWindow('categories');
        if(!win){
            win = desktop.createWindow({
                id: 'categories',
                title:'Gestion Categories',
                width:740,
                height:480,
                iconCls: 'categorie',
                shim:false,
                animCollapse:false,
                constrainHeader:true,
                layout: 'fit',
                items: gride_categories,	//encapsulation du gride_categories dans la fenetre 
				bbar: new Ext.StatusBar({
									defaultText: 'Dopa V0.3',
									id: 'bar-categiries',
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
			var mask_categories = new Ext.LoadMask(Ext.get('categories'), {store:store_categories,msg:'Chargement...'}); //effet pour le chargement de donnee 
			store_categories.load();
        }
        win.show();
    }
});

