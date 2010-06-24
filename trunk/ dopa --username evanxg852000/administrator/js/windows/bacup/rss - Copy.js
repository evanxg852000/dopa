MyDesktop.rss = Ext.extend(Ext.app.Module, {
    id:'win',
    init : function(){
        this.launcher = {
            text: 'rss',
            iconCls:'icon-grid',
            handler : this.createWindow,
            scope: this
        }
    },

	createWindow : function(){
        var desktop = this.app.getDesktop();
	//instance new 	
      var sto=new Ext.data.Store({
			url: 'rssnews.php',
			reader: new Ext.data.JsonReader({
				root:'rows',
				id:'id'
			}, [
			     {name: 'Author', mapping: 'Author'},
				'Title', 'Manufacturer', 'ProductGroup'
			])
	    });
	 //fin instance 			

        var win = desktop.getWindow('win');
        if(!win){
            win = desktop.createWindow({
                id: 'win',
                title:'rss',
                width:740,
                height:480,
                iconCls: 'icon-grid',
                shim:false,
                animCollapse:false,
                constrainHeader:true,

                layout: 'fit',
                items:
				
                    new Ext.grid.GridPanel({
                        border:false,
					    store:sto,
                        columns: [
								{header: "Author", width: 120, dataIndex: 'Author', sortable: true},
								{header: "Title", width: 180, dataIndex: 'Title', sortable: true},
								{header: "Manufacturer", width: 115, dataIndex: 'Manufacturer', sortable: true},
								{header: "Product Group", width: 100, dataIndex: 'ProductGroup', sortable: true}
							],
                        viewConfig: {
                            forceFit:true
                        },
                        //autoExpandColumn:'company',

                        tbar:[{
                            text:'Ajouter IP',
                            tooltip:'Add a new row',
                            iconCls:'add'
                        }, '-', {
                            text:'Options',
                            tooltip:'Blah blah blah blaht',
                            iconCls:'option'
                        },'-',{
                            text:'Supprimet',
                            tooltip:'Remove the selected item',
                            iconCls:'remove'
                        }]
                    })
					
					
					
            });
			sto.load();
        }
        win.show();
    }
});

