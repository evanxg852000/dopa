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
		var sto = new Ext.data.Store({
        // load using HTTP
        url: 'sheldon.xml',

        // the return will be XML, so lets set up a reader
        reader: new Ext.data.XmlReader({
               // records will have an "Item" tag
               record: 'Item',
               id: 'ASIN',
               totalRecords: 'total'
           }, [
               // set up the fields mapping into the xml doc
               // The first needs mapping, the others are very basic
               {name: 'Author', mapping: 'ItemAttributes > Author'},
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
