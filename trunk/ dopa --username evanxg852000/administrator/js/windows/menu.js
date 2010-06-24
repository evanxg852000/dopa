MyDesktop.Menu = Ext.extend(Ext.app.Module, {
    id:'menu',
    init : function(){
        this.launcher = {
            text: 'Gestion Menu',
            iconCls:'menu',
            handler : this.createWindow,
            scope: this
        }
    },

			
    createWindow : function(){
        var desktop = this.app.getDesktop();
		
		var type_menu_form = new Ext.FormPanel({ 
			url: 'admin-menu/menu-submit.php',
			border:false,
			labelAlign: 'top',
			frame:true,
			bodyStyle:'padding:5px 5px 0',
			items: [{
				xtype: 'combo',
                    fieldLabel: 'Type Du Menu Horizontal',
                    name: 'Type',
					mode: 'local',
					allowBlank :false,
					blankText: 'Ce champ est obligatoire',
					store:['Menu Simple','Menu Tabulaire','Menu Deroulant'],
				    triggerAction: 'all',
					editable: false,
                    anchor:'95%'
			}],
			buttons: [{
				text: 'Save',
				handler: function(){
                    type_menu_form.getForm().submit({
                        success: function(f,a){
							Ext.Msg.alert('Dopa',a.result.msg);
                        },
                        failure: function(f,a){
                            if (a.failureType === Ext.form.Action.CONNECT_FAILURE){
                                Ext.Msg.alert('Failure', 'Server reported:'+a.response.status+' '+a.response.statusText);
                            }
                            if (a.failureType === Ext.form.Action.SERVER_INVALID){
                                Ext.Msg.alert('Warning', a.result.errormsg);
                            }
                        }
                    });
				}
			}, {
				text: 'Annuler',
				handler: function(){
					type_menu_form.getForm().reset();
				}
			}]
		});
 
        var wini = desktop.getWindow('menu');
        if(!wini){
            wini = desktop.createWindow({
                id: 'menu',
                title:'Gestion Menu',
                width:200,
                height:125,
                iconCls: 'menu',
                shim:false,
                animCollapse:false,
                constrainHeader:true,
				items:  type_menu_form
            });
        }
        wini.show();
    }	
});

