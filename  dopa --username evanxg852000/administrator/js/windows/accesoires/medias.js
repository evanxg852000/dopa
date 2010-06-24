function Media(){
        var desktop = this.app.getDesktop();
		var dir='images'; //declaration du repertoire pour definir le code
			
		var thumbTemplate = new Ext.XTemplate(
			'<tpl for=".">',
				'<div class="thumb-wrap" id="{name}">',
				'<div class="thumb"><img src="{url}" title="{name}"></div>',
				'<span>{name}</span></div>',
			'</tpl>'
		);
		thumbTemplate.compile();
		
		var store_repertoire = new Ext.data.JsonStore({
			    url:'admin-medias/Get-Images.php',
			    root: 'images',
			    fields: [
			        'name', 'url',
			        {name:'size', type: 'float'},
			        {name:'lastmod', type:'date', dateFormat:'timestamp'}
			    ],
			    listeners: {
			    	'load': {fn:function(){ view.select(0); },single:true}
			    }
			});
			
		    view = new Ext.DataView({
				id: 'explorer',
				tpl:thumbTemplate,
				singleSelect: true,
				border:true,
				loadingText:'Chargement...',
				overClass:'x-view-over',
				itemSelector: 'div.thumb-wrap',
				emptyText : '<div style="padding:10px;">Aucune  images ne correspond a ce filtre</div>',
				store: store_repertoire,
				listeners: {
					'selectionchange': {fn:DefinirCode, scope:this, buffer:100},
				},
			});
		
	function DefinirCode (){
		var selNode =view.getSelectedNodes();
	    selNode = selNode[0];
		var d = Ext.getCmp('chemin').setValue('<img src="media/'+dir+'/'+selNode.id+'"/>');
	};
		
	function filter(){
		var filter = Ext.getCmp('filter');
		view.store.filter('name', filter.getValue());
		view.select(0);
	};
	
	 function sortImages(){
		var v = Ext.getCmp('sortSelect').getValue();
    	view.store.sort(v, v == 'name' ? 'asc' : 'desc');
    	view.select(0);
    };
//======================================================
	
	var tree = new Ext.tree.TreePanel({
         animate:true,
         enableDD:true,
         containerScroll: true,
         rootVisible:false,
		 collapsible: true,
		 region:'west',
         width:200,
         split:true,
         title:'Dossiers',
         autoScroll:true,
		 root: {
		text: 'Root',
		children: [{
			text: 'Images',
			leaf: true,
			id:'images',
			iconCls:'images'
		},{
			text: 'Album',
			leaf: true,
			id:'album',
			iconCls:'album'
		},{
			text: 'Banners',
			id:'banner',
			leaf: true,
			iconCls:'banner'
		},{
			text: 'Icons',
			id:'icons',
			leaf: true,
			iconCls:'icons'
		}]
	}
    });
	
	tree.on('click', function(n){
    	var sn = this.selModel.selNode || {}; // selNode is null on initial selection
			dir=n.id;
			store_repertoire.load({params: {Repertoire: dir}});  	
    });
//========================================================
        var wini = desktop.getWindow('mediaview');
        if(!wini){
            wini = desktop.createWindow({
                id: 'mediaview',
                title:'Gestion Medias',
                width:648,
                height:390,
                iconCls: 'media',
                shim:false,
				maximizable: false,
				resizable : false,
                animCollapse:false,
                constrainHeader:true,
				layout: 'border',
				border: false,
				items:[
						tree
				,{
					id: 'img-chooser-view',
					region: 'center',
					autoScroll: true,
					items:view,
                    tbar:[{
                    	text: 'Filter:'
                    },{
                    	xtype: 'textfield',
                    	id: 'filter',
                    	selectOnFocus: true,
                    	width: 65,
						listeners: {
                    		'render': {fn:function(){
						    	Ext.getCmp('filter').getEl().on('keyup', function(){
						    		filter();
						    	});
                    		}}
                    	}
                     }, ' ', '-', {
                    	text: 'Trier:'
                    }, {
                    	id: 'sortSelect',
                    	xtype: 'combo',
				        typeAhead: true,
				        triggerAction: 'all',
				        width: 70,
				        editable: false,
				        mode: 'local',
				        displayField: 'desc',
				        valueField: 'name',
				        lazyInit: false,
				        value: 'name',
				        store: new Ext.data.SimpleStore({
					        fields: ['name', 'desc'],
					        data : [['name', 'Name'],['size', 'File Size'],['lastmod', 'Last Modified']]
					    }),
						   listeners: {
							'select': {fn:sortImages, scope:this}
					    }
				    },{
						text: 'Code:'
						},{
					   	xtype: 'textfield',
                    	id: 'chemin',
                    	selectOnFocus: true,
                    	width: 160
						}]
				}],
				bbar: new Ext.StatusBar({
									defaultText: 'Dopa V0.3',
									id: 'media-view',
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
				var mask_repertoire = new Ext.LoadMask(Ext.get('mediaview'), {store:store_repertoire,msg:'Chargement...'}); 
				store_repertoire.load({	params: {Repertoire: dir}
			});
        }
        wini.show();
    }