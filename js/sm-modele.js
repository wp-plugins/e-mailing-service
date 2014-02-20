tinymce.create('tinymce.plugins.wptuts', {
 init : function(ed,url) {
 ed.addButton('wptuts', {
 title : 'Ajouter une video wptuts',
 image : url + '/sm_shortut.png',
 onclick : function() {
 var wptutsId = prompt('Id de la video wptuts. Du type : vCXRt0kQvUE','');
 ed.selection.setContent('[wptuts id='+wptutsId+']');
 }
 })
 },
 createControl : function(n,cn){
 return null;
 }
 });
 tinymce.PluginManager.add('wptuts',tinymce.plugins.wptuts);