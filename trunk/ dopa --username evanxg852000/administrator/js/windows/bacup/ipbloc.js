MyDesktop.IPbloc = Ext.extend(Ext.app.Module, {
    id:'grid-win',
    init : function(){
        this.launcher = {
            text: 'Liste des des ip bloque',
            iconCls:'icon-grid',
            handler : this.createWindow,
            scope: this
        }
    },

    createWindow : function(){
        var desktop = this.app.getDesktop();
        var win = desktop.getWindow('grid-win');
        if(!win){
            win = desktop.createWindow({
                id: 'grid-win',
                title:'Liste des des ip bloque',
                width:740,
                height:480,
                iconCls: 'icon-grid',
                shim:false,
                animCollapse:false,
                constrainHeader:true,
				items: [
						{
						xtype: 'textfield',
				fieldLabel: 'Director',
				name: 'director',
				vtype: 'name'
						},
						{
				xtype: 'datefield',
				fieldLabel: 'Released',
				name: 'released',
				disabledDays: [1,2,3,4,5]						
						}
				       ]

            });
        }
        win.show();
    }
		
});


