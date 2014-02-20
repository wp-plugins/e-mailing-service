(function() {
	var called = false;
	tinymce.create('tinymce.plugins.template', {
		init : function(ed, url) {
			ed.addButton('template', {
				title : 'My button',
				image : url + '4',
				cmd : 'mceMyButtonInsert',
			});

			ed.addCommand('mceMyButtonInsert', function(ui, v) {
				tb_show('', ajaxurl + '?action=template_shortcodePrinter');
				if(called == false) {
					called = true;
					jQuery('#mcb_button').live("click", function(e) {
						e.preventDefault();

						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, template_create_shortcode());

						tb_remove();
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('template', tinymce.plugins.template);
})();

function template_create_shortcode() {
	return '[my-listing  category="' + jQuery('#mcb_category').val() + '" posts_per_page="' + jQuery('#mcb_number').val() + '"]';
}

