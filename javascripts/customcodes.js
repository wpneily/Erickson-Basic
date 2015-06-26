(function() {  
    tinymce.create('tinymce.plugins.button1', {  
        init : function(ed, url) {  
            ed.addButton('button1', {  
                title : 'Add an Orange Button',  
                image : url+'/orange.png',  
                onclick : function() {  
                    var buttonLink = prompt("Button Link Address", "");
                    var buttonText = prompt("Button Text", "This is the button text");
                    ed.selection.setContent('[button1 url="' + buttonLink + '"]' + buttonText + '[/button1]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('button1', tinymce.plugins.button1);  
})();  
(function() {  
    tinymce.create('tinymce.plugins.button2', {  
        init : function(ed, url) {  
            ed.addButton('button2', {  
                title : 'Add a Gray Button',  
                image : url+'/gray.png',  
                onclick : function() {  
                    var buttonLink = prompt("Button Link Address", "");
                    var buttonText = prompt("Button Text", "This is the button text");
                    ed.selection.setContent('[button2 url="' + buttonLink + '"]' + buttonText + '[/button2]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('button2', tinymce.plugins.button2);  
})();  
(function() {  
    tinymce.create('tinymce.plugins.button3', {  
        init : function(ed, url) {  
            ed.addButton('button3', {  
                title : 'Add a Green Button',  
                image : url+'/green.png',  
                onclick : function() {  
                    var buttonLink = prompt("Button Link Address", "");
                    var buttonText = prompt("Button Text", "This is the button text");
                    ed.selection.setContent('[button3 url="' + buttonLink + '"]' + buttonText + '[/button3]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('button3', tinymce.plugins.button3);  
})();  
