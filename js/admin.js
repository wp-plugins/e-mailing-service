/*
Simple hosting JS for admin only.
Please do not thouch this unless you know what you`re doing.
*/

jQuery(function(){
	jQuery('#sh-settings').tabs();
	jQuery('.color').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).val(hex);
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	
	jQuery('#sh-settings .button-primary').click(function(e){
		e.preventDefault();
		e.stopPropagation();
		jQuery('#sh-settings .ui-tabs-panel[aria-hidden=false]').find('form').submit();
		
	});
	jQuery('#sh-settings .button').click(function(e){
		e.preventDefault();
		jQuery('#sh-settings .ui-tabs-panel').not('.ui-tabs-hide').find('form').get(0).reset();
	});
	
	jQuery('.sortable').sortable();
	
	jQuery('.addstep').click(function(e){
		e.preventDefault();
		$class = jQuery(this).attr('rel');
		jQuery(this).next('ul.sortable').append('<li><span>Name: <input type="text" name="ch['+$class+'][name][]"></span> <span>Price:<input type="text" name="ch['+$class+'][price][]"></span></li>');
	});
	
	
	jQuery('.addfield').click(function(e){
		e.preventDefault();
		$class = jQuery(this).attr('rel');
		if($class == 'domain'){
			$Content = '<li><span>Extension: <input type="text" name="domainTypes[name][]"></span> <span>Price: <input type="text" name="domainTypes[price][]"></span> </li>';
		}else if($class == 'order') {
			$Content = '<li><span>Field name: <input type="text" name="fields_'+$class+'[]"></span></li>';
		}else {
			$Content = '<li><span>Field title: <input type="text" name="fields_'+$class+'[]"></span></li>';
		}
		jQuery(this).next('ul.sortable').append($Content);
	});
	
	jQuery('#sh-settings ul.sortable li').each(function(){
		jQuery(this).append('<a class="removeitem" href="#"><img src="../wp-content/themes/simple-hosting/images/remove-from-cart.png" alt="X"></a>');
	});
	
	jQuery('.removeitem').click(function(e){
		e.preventDefault();
		jQuery(this).parent('li').remove();
	});
	
	jQuery('.togglenext').click(function(e){
		e.preventDefault();
		console.log(jQuery(this).parent().parent().next().toggle());
	});
});

function removeItem(t){
	jQuery(t).parent().remove();
}

function addAccordionItem(num){
	jQuery('div#accordion-widget-elements').append('<p><label for="">Heading: <input class="widefat" name="widget-accordion-widget['+num+'][elementtitles][]" type="text"/></label><label for="">Content: <textarea class="widefat" name="widget-accordion-widget['+num+'][elementcontent][]" /></textarea></label></p>');
	//jQuery('div#accordion-widget-elements').append(' <input class="widefat" name="widget-accordion-widget[2][elementtitles][]" type="text">');
	console.log('click');
	return false;
}