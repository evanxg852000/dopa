function Statistique(){
        var desktop = this.app.getDesktop();
	
	    var ds_model_sondage = Ext.data.Record.create([   {name: 'Num', mapping: 'Num'},'Nom', 'Question', 'Publie']); // modele de la table
        var store_sondage=new Ext.data.Store({
			url: 'admin-statistique/sondage.php',
			reader: new Ext.data.JsonReader({
				root:'rows',
				id:'Num'
			},ds_model_sondage )
	    });
	
		var Nom_sondage_edit = new Ext.form.TextField();
		var Question_sondage_edit = new Ext.form.TextField();
		
		var gride_sondage=  new Ext.grid.EditorGridPanel({
						id: 'sondage',
                        border:false,
						height:180,
					    store:store_sondage,
						clickstoEdit: 1,
                        columns: [
								{header: "Numero", width: 50, dataIndex: 'Num', sortable: true},
								{header: "Nom", width: 140, dataIndex: 'Nom', editor:Nom_sondage_edit ,sortable: true},
								{header: "Question", width: 140, dataIndex: 'Question',editor:Question_sondage_edit, sortable: true},
								{header: "Publie", width: 140, dataIndex: 'Publie', sortable: true},
							],
						sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
						listeners: {
									afteredit: function(e){
										var conn = new Ext.data.Connection();
											conn.request({
											url: 'admin-statistique/sondage-update.php',
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
                        tbar:[{
                            text:'Ajouter',
                            tooltip:'lire le message selectione',
                            iconCls:'add',
							handler: function () { 
												var x= gride_sondage.getStore().getCount();
												var conn = new Ext.data.Connection();
												conn.request({
													url: 'admin-statistique/sondage-update.php',
													method:	'POST',	
													params: {
														action: 'insert',
														Nom:'Nouveau Sondage',
														Num: x+1,
													},
													success: function(resp,opt) {		
																			gride_sondage.getStore().insert(x, new ds_model_sondage({Num: x+1, Nom:'Nouveau Sondage',Question:'' ,Publie:'N'}));
																			gride_sondage.startEditing(gride_sondage.getStore().getCount()-1,1);
													},
													failure: function(resp,opt) {
														Ext.Msg.alert('Error','Ajout Impossible !');
													}
												});
							            } 
                        },'-',{
                            text:'Supprimmer',
                            tooltip:'Remove the selected item',
                            iconCls:'remove',
							handler: function(){
												var sm = gride_sondage.getSelectionModel();
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
																	url: 'admin-statistique/sondage-update.php',
																	params: {
																		action: 'delete',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		gride_sondage.getStore().remove(sel); 
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
									text:'Publier',
									tooltip:'Add a new row',
									iconCls:'publish',
									handler: function () { 
												var sm = gride_sondage.getSelectionModel();
												var sel = sm.getSelected();
												if (sm.hasSelection()){																
																var conn = new Ext.data.Connection();
																conn.request({
																	url: 'admin-statistique/sondage-update.php',
																	params: {
																		action: 'publish',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		 store_sondage.load();
																	},
																	failure: function(resp,opt) { 
																		Ext.Msg.alert('Error','Suppression Impossible !'); 
																	}
																});
												}
												else
												{
												Ext.Msg.alert('Dopa','selectioner une ligne!');
												}
									}	
								},'-',{
									text:'Enregister',
									tooltip:'Add a new row',
									iconCls:'save',
									handler: function () { 
										store_sondage.load();				
									}							       	
							},'-',{
									text:'Lister les reponses possibles',
									tooltip:'Add a new row',
									iconCls:'reponse',
									handler: function () {
											var sm = gride_sondage.getSelectionModel();
											var sel = sm.getSelected();
												if (sm.hasSelection()){
													Lister_type_rep(sel.data.Num);
												}
												else
												{
													Ext.Msg.alert('Dopa','selectioner une ligne!');
												}
									}	
							}]
                    });
//==============================================================================
		function Lister_type_rep(numero) {
			store_type_reponse_sondage.baseParams ={
				Numero: numero
			};
			store_type_reponse_sondage.load();
		};

		var Reponse_sondage_edit = new Ext.form.TextField();
		
		var ds_model_type_reponse_sondage = Ext.data.Record.create([   {name: 'Num', mapping: 'Num'},'Reponse', 'Nb_vote','Num_so']);
        var store_type_reponse_sondage=new Ext.data.Store({
			proxy:new Ext.data.HttpProxy ({
					url:'admin-statistique/type-reponse-sondage.php'
					}),
			reader: new Ext.data.JsonReader({
				root:'rows',
				id:'Num'
			},ds_model_type_reponse_sondage )
	    });
	

	
		var gride_type_reponse_sondage=  new Ext.grid.EditorGridPanel({
						id:'type_reponse_sondage',
                        border:true,
						width:363,
						height:243,
					    store:store_type_reponse_sondage,
						clickstoEdit: 1,
                        columns: [
								{header: "Numero", width: 90, dataIndex: 'Num', sortable: true},
								{header: "Type Reponse", width: 140, dataIndex: 'Reponse',editor:Reponse_sondage_edit,  sortable: true},
								{header: "Nb Voie", width: 140, dataIndex: 'Nb_vote',  sortable: true},
								{header: "Num Sondage", width: 130, dataIndex: 'Num_so', sortable: true},
							],
						sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
						listeners: {
									afteredit: function(e){
										var conn = new Ext.data.Connection();
											conn.request({
											url: 'admin-statistique/type-reponse-sondage-update.php',
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
                        tbar:[{
                            text:'Ajouter',
                            tooltip:'lire le message selectione',
                            iconCls:'add',
							handler: function () {
												var sm = gride_sondage.getSelectionModel();
												var sel = sm.getSelected();
												var num_sondage=sel.data.Num;
												var x= gride_type_reponse_sondage.getStore().getCount();
												var conn = new Ext.data.Connection();
												conn.request({
													url: 'admin-statistique/type-reponse-sondage-update.php',
													method:	'POST',	
													params: {
														action: 'insert',
														Num: x+1,
														Reponse:'Nouvelle Reponse',
														Num_so: num_sondage
													},
													success: function(resp,opt) {		
																			gride_type_reponse_sondage.getStore().insert(x, new ds_model_sondage({Num: x+1, Reponse:'Nouvelle Reponse',Num_so:num_sondage}));
																			gride_type_reponse_sondage.startEditing(gride_type_reponse_sondage.getStore().getCount()-1,1);
													},
													failure: function(resp,opt) {
														Ext.Msg.alert('Error','Ajout Impossible !');
													}
												});		
							}
                        },'-',{
                            text:'Supprimmer',
                            tooltip:'Remove the selected item',
                            iconCls:'remove',
							handler: function(){
												var sm =  gride_type_reponse_sondage.getSelectionModel();
												var sel = sm.getSelected();
												if (sm.hasSelection()){
													Ext.Msg.show({
														title: 'Dopa', 
														buttons: Ext.MessageBox.YESNOCANCEL,
														msg: 'Etes vous certain de vouloir supprimer '+sel.data.Reponse+'?',
														fn: function(btn){
															if (btn == 'yes'){
																var conn = new Ext.data.Connection();
																conn.request({
																	url: 'admin-statistique/type-reponse-sondage-update.php',
																	params: {
																		action: 'delete',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		 gride_type_reponse_sondage.getStore().remove(sel); 
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
									text:'Enregister',
									tooltip:'Add a new row',
									iconCls:'save',
									handler: function () { 
										store_type_reponse_sondage.load();			
									}
							}],
                    });	
//===============================================================================

								
			    var stats = new Ext.Panel({
						title:'Statistique du site/Raport du sondage',
						border:true,
						width:363,
						height:243,
						html: G_CONTENU_STATS
						});
			
//=================================================================================
				
var cadre_du_bas= new Ext.Panel({
		layout :'table',
		width:726,
		border: true,
		items:[	gride_type_reponse_sondage,	stats],
		bbar: new Ext.StatusBar({
							defaultText: 'Dopa V0.3',
							id: 'statistique-status',
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
    				
        var wini = desktop.getWindow('statistique');
        if(!wini){
            wini = desktop.createWindow({
                id: 'statistique',
                title:'Gestion Statistique',
				maximizable:false,
				resizable : false,
                width:740,
                height:480,
                iconCls: 'stats',
                shim:false,
                animCollapse:false,
                constrainHeader:true,
				items:[gride_sondage,cadre_du_bas]
            });
			var mask_sondage = new Ext.LoadMask(Ext.get('sondage'), {store:store_sondage,msg:'Chargement...'});  
			store_sondage.load();
			var mask_sondage_type = new Ext.LoadMask(Ext.get('type_reponse_sondage'), {store:store_type_reponse_sondage,msg:'Chargement...'});
			store_type_reponse_sondage.load();
        }
        wini.show();
    }