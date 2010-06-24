MyDesktop.Articles = Ext.extend(Ext.app.Module, {
    id:'articles',
    init : function(){
        this.launcher = {
            text: 'Gestion Articles',
            iconCls:'icon-grid',
            handler : this.createWindow,
            scope: this
        }
    },

    createWindow : function(){
        var desktop = this.app.getDesktop();
	//===============================================inserer les variable (var pari= new) ici=================================
		
		var ds_model_articles = Ext.data.Record.create([{name: 'Num', mapping: 'Num'},'Nom', 'Publie','Publie_ho','Num_ca']); // modele de la table
			
      var store_articles=new Ext.data.Store({
			url: 'admin-articles/articles.php',
			reader: new Ext.data.JsonReader({
				root:'rows',
				id:'Num'
			},ds_model_articles )
	    });
	 //fin instance 			

	// variable edition du grid
		var Nom_article_edit = new Ext.form.TextField();
		var indexe_edit=new Ext.form.ComboBox({	mode: 'local',store: ['Y','N'],	triggerAction: 'all'});
					//============================================recuperation des categorie pour remplir le combo============================
										var categorie_loader = new Ext.data.Store({
										reader: new Ext.data.JsonReader({
											fields: ['Num', 'Nom'],
											root: 'rows'
										}),
										proxy: new Ext.data.HttpProxy({
											url: 'admin-categories/categories.php'
										}),
											autoLoad: true
										});
										var Categorie_edit=new Ext.form.ComboBox({
											mode: 'local',
											store:categorie_loader,
											displayField:'Nom',
											triggerAction: 'all',
											valueField: 'Num'	
										});
										
					//==============================================fin recuperation des categorie pour remplir le combo======================
	// dessin du grid (contenu de la fenetre) de la fenetre	
		var gride_articles=  new Ext.grid.EditorGridPanel({
                        border:false,
					    store:store_articles,
						clickstoEdit: 1,
                        columns: [
								{header: "Numero", width: 100, dataIndex: 'Num', sortable: true},
								{header: "Nom", width: 180, dataIndex: 'Nom', editor: Nom_article_edit , sortable: true},
								{header: "Publie", width: 100, dataIndex: 'Publie' , sortable: true},
								{header: "Indexe", width: 50, dataIndex: 'Publie_ho', editor: indexe_edit},
								{header: "Categorie", width: 90, dataIndex: 'Num_ca', editor: Categorie_edit , sortable: true}
							],
						sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
						listeners: {
									afteredit: function(e){
										var conn = new Ext.data.Connection();
											conn.request({
											url: 'admin-articles/articles-update.php',
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
							
												var x= gride_articles.getStore().getCount();
												var conn = new Ext.data.Connection();
												conn.request({
													url: 'admin-articles/articles-update.php',
													method:	'POST',	
													params: {
														action: 'insert',
														Nom:'New Article',
														Num: x+1,
													},
													success: function(resp,opt) {		
																			//var x= gride_articles.getStore().getCount();
																			gride_articles.getStore().insert(x, new ds_model_articles({Num: x+1, Nom:'New Article', Publie:'N',Num_ca:'0'}));
																			gride_articles.startEditing(gride_articles.getStore().getCount()-1,1);
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
											var sm = gride_articles.getSelectionModel();
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
																	url: 'admin-articles/articles-update.php',
																	params: {
																		action: 'publie',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		 store_articles.load();
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
												var sm = gride_articles.getSelectionModel();
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
																	url: 'admin-articles/articles-update.php',
																	params: {
																		action: 'depublie',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		 store_articles.load();
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
												var sm = gride_articles.getSelectionModel();
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
																	url: 'admin-articles/articles-update.php',
																	params: {
																		action: 'delete',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		 gride_articles.getStore().remove(sel);
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
										store_articles.load();				
									}							       	
									},'-',{
									text:'Editer',
									tooltip:'Add a new row',
									iconCls:'edit',
									handler: function () { 	
									      		var sm = gride_articles.getSelectionModel();
												var sel = sm.getSelected();
												if (sm.hasSelection()){
													var ligne=sel.data.Num ; //ligne selectione
								                    ouvre_fenetre('editor','article',ligne); //ouvre l'editeur avec les la table et l'id
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
//fin dessin du gride_articles
				
				
//===============================================FIN inserer les variable (var pari= new) ici=================================
				
//creation de la fenetre
		
		
		
        var wini = desktop.getWindow('articles');
        if(!wini){
            wini = desktop.createWindow({
                id: 'articles',
                title:'Gestion Articles',
                width:740,
                height:480,
                iconCls: 'icon-grid',
                shim:false,
                animCollapse:false,
                constrainHeader:true,
                layout: 'fit',
				items: gride_articles,	//encapsulation du gride_articles dans la fenetre 
				bbar: new Ext.StatusBar({
							defaultText: 'Dopa V0.3',
							id: 'bar-article',
							items: [{
								text: 'Dopa Home',
								tooltip:'Aller a sur le site',
								iconCls:'dopa',
								handler: function()	{
											window.open('http://evansofts.com');
										}
								}, '-',    new Date().format('n/d/Y')]
						})
            });
			var mask_articles = new Ext.LoadMask(Ext.get('articles'),{store:store_articles,msg:'Chargement...'}); //effet pour le chargement de donnee 
			store_articles.load();
        }
        wini.show();
    }
	
});

