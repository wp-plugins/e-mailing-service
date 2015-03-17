(function() {
   tinymce.create('tinymce.plugins.recentposts', {
      init : function(ed, url) {
         ed.addButton('links_newsltter', {
            title : 'Link unsuscribe',
            image : url+'wp-content/plugins/e-mailing-service/img/pencil.png',
               text: 'Layouts',
               
            onclick : function() {
             
                     ed.execCommand('mceInsertContent', false, '[lien-desabo]');
               
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Recent Posts",
            author : 'Konstantinos Kouratoras',
            authorurl : 'http://www.kouratoras.gr',
            infourl : 'http://www.smashingmagazine.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('links_newsltter', tinymce.plugins.recentposts);
})();