MyDesktop.IPbloc = Ext.extend(Ext.app.Module, {
    id:'grid-win',
    init : function(){
        this.launcher = {
            text: 'Gestion des ip bloques',
            iconCls:'icon-grid',
            handler : this.createWindow,
            scope: this
        }
    },

	createWindow : function(){
        var desktop = this.app.getDesktop();
		
	//===============================================inserer les variable (var pari= new) ici=================================
		
		var ds_model_ip = Ext.data.Record.create([   {name: 'ipCon', mapping: 'ipCon'},'heureCon', 'dateCon', 'lheure','Nb_charg','Etat']); // modele de la table
			
      var store_ip=new Ext.data.Store({
			url: 'admin-ip/ip.php',
			reader: new Ext.data.JsonReader({
				root:'rows',
				id:'ipCon'
			},ds_model_ip )
	    });
	 //fin instance 			

	// variable edition du gride_ip

		var Nb_charg_edit = new Ext.form.TextField();
		var etat_edit = new Ext.form.TextField();
	// dessin du grid (contenu de la fenetre) de la fenetre	
		var gride_ip=  new Ext.grid.EditorGridPanel({
                        border:false,
					    store:store_ip,
						clickstoEdit: 1,
                        columns: [
								{header: "Adresse IP", width: 80, dataIndex: 'ipCon', sortable: true},
								{header: "Temps Con", width: 140, dataIndex: 'heureCon', sortable: true},
								{header: "Date Con", width: 140, dataIndex: 'dateCon', sortable: true},
								{header: "Heure Con", width: 200, dataIndex: 'lheure', sortable: true},
								{header: "Nb Chargement", width: 90, dataIndex: 'Nb_charg', editor: Nb_charg_edit , sortable: true},
								{header: "Interdit", width: 90, dataIndex: 'Etat', editor: etat_edit , sortable: true}
							],
						sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
						listeners: {
									afteredit: function(e){
										var conn = new Ext.data.Connection();
											conn.request({
											url: 'admin-ip/ip-update.php',
											method: 'POST',
											params: {
												action: 'update',
											    ipCon: e.record.id,
												field: e.field,
												value: e.value
											},
											success: function(resp,opt) {
												//Ext.Msg.alert('Error',e.record.id); pour verifier quel id
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
												var conn = new Ext.data.Connection();
													Ext.MessageBox.prompt('Adresse IP', 'Saisissez l\'adresse IP:', function (btn, text){
														  var ip_saisi=text;
														  var dt= new Date();
														  var dat=dt.format('Y-m-d');
														  var heure=dt.format('H:i:s');
														  var temp=dt.format('U'); 
														  
														  if (btn=='ok')
																  {
								   									    conn.request({
																		url: 'admin-ip/ip-update.php',
																		method:	'POST',	
																		params: {
																			action: 'insert',
																			ipCon: ip_saisi,
																			heureCon:temp,
																			dateCon:dat,
																			lheure:heure 
																		},
																		success: function(resp,opt) {		
																								var x= gride_ip.getStore().getCount();
																								gride_ip.getStore().insert(x, new ds_model_ip({ipCon:ip_saisi , heureCon:temp , dateCon:dat, lheure:heure , Nb_charg:'0', Etat:'Y'}));
																								gride_ip.startEditing(gride_ip.getStore().getCount()-1,1);
																		},
																		failure: function(resp,opt) {
																			Ext.Msg.alert('Error','Ajout Impossible !');
																		}
																	});
																  
																  }
																  else
																  {
																   Ext.MessageBox.alert('Dopa', 'Operation anulle.');
																  }
														}
													);												
												
												

												
												
							}//info() est defini dans divers/function
                        },'-',{
                            text:'Supprimmer',
                            tooltip:'Remove the selected item',
                            iconCls:'remove',
							handler: function(){
												var sm = gride_ip.getSelectionModel();
												var sel = sm.getSelected();
												if (sm.hasSelection()){
													Ext.Msg.show({
														title: 'Dopa', 
														buttons: Ext.MessageBox.YESNOCANCEL,
														msg: 'Etes vous certain de vouloir supprimer '+sel.data.ipCon+'?',
														fn: function(btn){
															if (btn == 'yes'){
																
																var conn = new Ext.data.Connection();
																conn.request({
																	url: 'admin-ip/ip-update.php',
																	params: {
																		action: 'delete',
																		ipCon: sel.data.ipCon
																	},
																	success: function(resp,opt) { 
																		gride_ip.getStore().remove(sel); 
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
										store_ip.load();				
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
//fin dessin du gride_ip
				
				
//===============================================FIN inserer les variable (var pari= new) ici=================================
				
//creation de la fenetre 				
        var win = desktop.getWindow('grid-win');
        if(!win){
            win = desktop.createWindow({
                id: 'grid-win',
                title:'Gestion des ip bloques',
                width:740,
                height:480,
                iconCls: 'icon-grid',
                shim:false,
                animCollapse:false,
                constrainHeader:true,
                layout: 'fit',
                items: gride_ip	//encapsulation du gride_ip dans la fenetre 
            });
			store_ip.load();
        }
        win.show();
    }
});

