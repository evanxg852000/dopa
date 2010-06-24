Ext.onReady(function(){

		
function ViewHelp(titre,contenu){
        cont_centre.add({
            title: titre,
            iconCls: 'tabs',
            html:contenu,
            closable:true
        }).show();
    }
					
		
//contenu haut




//contenu centre		
		   var cont_centre = new Ext.TabPanel({
                    region:'center',
                    deferredRender:false,
					 enableTabScroll:true,
					defaults: {autoScroll:true},
                    activeTab:0,
                    items:[{
                        contentEl:'home',
						iconCls: 'home',
                        title: 'Home',
                        closable:false,
                        autoScroll:true
                    }]
                })
//contenu ouest
	var tree = new Ext.tree.TreePanel({
         animate:true,
         enableDD:true,
         containerScroll: true,
         rootVisible:false,
		 collapsible: true,
		 iconCls:'folder',
		 region:'west',
         width:200,
         split:true,
         title:'Dossiers',
         autoScroll:true,
		 root: {
		text: 'Root',
		children: [{
			text: 'Configuration',
			leaf: true,
			id:'Configuration',
			iconCls:'subtree'
		},{
			text: 'Album',
			leaf: true,
			id:'album',
			iconCls:'folder'
		},{
			text: 'Banners',
			id:'banner',
			leaf: true,
			iconCls:'folder'
		},{
			text: 'Icons',
			id:'icons',
			leaf: true,
			iconCls:'folder'
		}]
	}
    });
	
	tree.on('click', function(n){
	var sn = this.selModel.selNode || {}; // selNode is null on initial selection
	if(LANG=='Francais')
		{
			lang_dir='fr' ;	
		}
		else
		{
			lang_dir='en' ;	
		}
		var conn = new Ext.data.Connection();
			conn.request({
				url: lang_dir+'/'+n.id+'.php',
				method: 'POST',
				success: function(resp,opt) {
								ViewHelp(n.id,resp.responseText); 	
						},
				failure: function(resp,opt) {
								Ext.Msg.alert('Error','Fichier non trouve !');
						}
				});
    });



//contenu est
var cont_est=new Ext.grid.PropertyGrid({
					editable: false,
                    closable: true,
                    source: {
                             "(name)": "Properties Grid",
                            "grouping": false,
                            "autoFitColumns": true,
                            "productionQuality": false,
                            "created": new Date(Date.parse('10/15/2006')),
                            "tested": false,
                            "version": .01,
                            "borderWidth": 1
                            }
                    })


//contenu bas



//viewport
       var viewport = new Ext.Viewport({
            layout:'border',
            items:[ 
				new Ext.BoxComponent({ // raw haut
					region:'north',
					el: 'bar',
					height:32
					}),{
                    region:'east',
                    title: 'Docs Version',
                    collapsible: true,
                    split:true,
                    width: 225,
                    minSize: 175,
                    maxSize: 400,
                    layout:'fit',
                    margins:'0 5 0 0',
                    items:cont_est
                 },{
                    region:'west',
                    id:'west-panel',
                    title:'Menu',
                    split:true,
                    width: 200,
                    minSize: 175,
                    maxSize: 400,
                    collapsible: true,
                    margins:'0 0 0 5',
                    layout:'accordion',
                    layoutConfig:{
                    animate:true
                    },
                    items: [
						tree
                    ,{
                        title:'Settings',
                        html:'<p>Some settings in here.</p>',
                        border:false,
                        iconCls:'folder'
                    }]
                },
				cont_centre
             ]
        });
		

    });
	