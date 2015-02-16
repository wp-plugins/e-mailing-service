/*
Here are defined all document-ready dependent actions.
Feel free to add here all your actions dependent by document ready.
*/

jQuery(document).ready(function($) {
/*
Default functionality - do not edit this.
*/
	resizeSidebar();

	$(window).scroll(function(){
	//	console.log('scroll');
	});

	$(window).resize(function(a,b){
		resizeSidebar();
	});

	$('#gallery.row33 article').hover(function(){
		$(this).find('.overlay').stop().animate({backgroundColor: "#3d3d3d"},500);
		$(this).find('.overlay2').find('.overlay-ico').stop().fadeIn(500);
	}, function(){
		$(this).find('.overlay').stop().animate({backgroundColor: "#c2c2c2"},500, function(){
			
		});
		$(this).find('.overlay2').find('.overlay-ico').stop().fadeOut(500);
	});

	// To remove
	$('.addtocart2').click(function(e){
		e.preventDefault();
		var val = $('#shopping-cart-summary a span').html();
		val++;
		$('#shopping-cart-summary a span').html(val);
	});
	// Stop removing
	
	$('#customHostingForm').submit(function(e){
		e.preventDefault();
		params = $(this).serialize();
		$.post(template_url+'/sh/Ajax.php?action=cart&do=add&item=0', params, function(data){
			d = eval('('+data+')');
			updateCartNum(d.total);
		});
	});
	
	$('.changeperiod').change(function(){
		var selected = $('option:selected', this).val();
		var cartitem = $(this).attr('rel');
		$.post(template_url+'/sh/Ajax.php?action=cart&do=updateproduct', {item: cartitem, sel: selected}, function(data){
			d = eval('('+data+')');
			if(d.status == 1){
				document.location.reload();
			} else {
			
			}
			//updateCartNum(d.total);
		});
	});
	$('#submitorder').submit(function(e){
		e.preventDefault();
		error = false;
		$('input.required').each(function(){
			if($(this).val() == ''){
				$(this).addClass('error');
				error = true;
			} else {
				$(this).removeClass('error');
			}
		});
		if(error == true) return;
		
		params = $(this).serialize();
		var object = this;
		$.post(template_url+'/sh/Ajax.php?action=cart&do=submitorder', params, function(data){
			d = eval('('+data+')');
			if(d.status == 1){
				//$("input[type=text]", object).val("");
				$('.overlay_gen').fadeIn();
				if(typeof d.redirect_url == null)
					document.location.reload();
				else
					document.location = d.redirect_url;
			} else {
			
			}
			//updateCartNum(d.total);
		});
	});
	
	$('.submitorder').click(function(e){
		e.preventDefault();
		$('#submitorder').submit();
	});
	
	
	
	$('#DomainFormAdd').click(function(e){
		e.preventDefault();
		var domain = $('.success .domainname').text();
		$.post(template_url+'/sh/Ajax.php?action=cart&do=add&item=-1', {domain: domain}, function(data){
			d = eval('('+data+')');
			updateCartNum(d.total);
		});
	});
	
	
	$('#emptyCart').click(function(e){
		e.preventDefault();
		params = $(this).serialize();
		$.post(template_url+'/sh/Ajax.php?action=cart&do=empty', params, function(data){
			updateCartNum('0');
			d = eval('('+data+')');
			document.location.reload();
		});
	});
	
	$('.addtocart').click(function(e){
		e.preventDefault();
		id = $(this).attr('rel');
		$.post(template_url+'/sh/Ajax.php?action=cart&do=add&id='+id, {item: id}, function(data){
			d = eval('('+data+')');
			updateCartNum(d.total);
		});
	});
	$('.remfromcart').click(function(e){
		e.preventDefault();
		id = $(this).attr('rel');
		$.post(template_url+'/sh/Ajax.php?action=cart&do=rem&id='+id, {item: id}, function(data){
			d = eval('('+data+')');
			updateCartNum(d.total);
			document.location.reload();
		});
	});
	
	/* Custom hosting page actions*/
	$( "#slider1" ).slider({
            value:0,
            min: 0,
            max: custom_hosting_hdd_steps,
			range: "min",
			animate: true ,
            slide: function( event, ui ) {
				var left = $('.ui-slider-handle',this).css('left');
                $("#hdd" ).val(ui.value );
				updateCustomPrice();
            }
    });	
	$( "#slider2" ).slider({
            value:0,
            min: 0,
            max: custom_hosting_traffic_steps,
			range: "min",
			animate: true,
            slide: function( event, ui ) {
				var left = $('.ui-slider-handle',this).css('left');
                $( "#trf" ).val(ui.value );
				updateCustomPrice();
            }
    });
	/*
	var left = $('#slider .ui-slider-handle').css('left');
	$('#slider .fill').css('width', left);
	var steps = [];*/
	
	
	$('.styled input').change(function(){
		updateCustomPrice();
	});
	
	updateCustomPrice();
	
	$('#cf input[type=text], #cf textarea').focus(
		function(){
			if($(this).val() == $(this).prop("defaultValue")){
				$(this).val('');
			}
		}
	);	
	$('#cf input[type=text], #cf textarea').blur(
		function(){
			if($(this).val() == ''){
				$(this).val($(this).prop("defaultValue"));
			}
		}
	);
	
	
	$(".pgallery").prettyPhoto({animation_speed:pp_speed,theme:pp_theme,slideshow:pp_slideshow_time, autoplay_slideshow: pp_autoplay});
	$("a.overlay, a.overlay2").click(function(e){
		e.preventDefault();
		$(this).parent('article').find('.pgallery').click();
	});	
	
	/* Submit forms from anchor */
	$('.submitForm').click(function(e){
		e.preventDefault();
		$(this).parent('form').submit();
	});
	
	
	$('#cf .submitForm').click(function(e){
		e.preventDefault();
		$('#cf').submit();
	});
	/* Contact form handler */
	$('#cf').submit(function(e){
		e.preventDefault();
		var error = false;
		$('input[type=text], textarea',this).each(function(){
			if($(this).val() == $(this).prop("defaultValue")){
				error = true;
				$(this).addClass('error');
			} else {
				$(this).removeClass('error');
			}
		});
		if(error == true) return;
		$('#cf .error-message').hide();
		$('#cf .loader').fadeIn();
		var cfObject = this;
		$.post(template_url+'/sh/Ajax.php?action=contact', $(this).serialize(), function(data){
			data = eval('('+ data +')');
			if(data.status == 1){
				$('input[type=text], textarea', cfObject).val('');
				$('#cf .error-message').html(data.message);
			} else {
				$('#cf .error-message').html(data.message);
			}
			
			$('#cf .loader').hide();
			$('#cf .error-message').fadeIn();
			setTimeout("$('#cf .error-message').stop().fadeOut()", 5000);
		});
	});
	
	var $i = 0;
	$('select.withstyle').each(function(){
		$(this).wrap('<div style="position:relative; cursor:pointer;" class="new'+$i+' fl" />');
		var select = $(this).parent().find('select');
		select.addClass('styledselect');
		$('.new'+$i).append('<div class="openselect br3" style=""><span /></div>');
		var pl = select.css('padding-left');
		var ml = select.css('margin-left');
		var wi = select.outerWidth();
		select.css('padding-left',"0").css('margin-left',"0").css('cursor',"pointer");
		$('.new'+$i).css('padding-left', pl).css('margin-left', ml).css('width', wi);
		var value = $('option:selected', select).text();
		$('.new'+$i).find('.openselect > span').html(value);
		$i++;
	});
	
	
	$('select.withstyle').change(function(){
		var value = $('option:selected', this).text();
		$(this).parent().find('.openselect > span').html(value);
	});
	
	
	
	$('.verifybutton').click(function(e){
		e.preventDefault();
		
		$('.checkdomain').slideUp(function(){
		
			var dom 	= $('.checkdomain input[name=domain]').val();
			var ext 	= $('option:selected','.checkdomain select[name=ext]').val();
			var price 	= $('option:selected','.checkdomain select[name=ext]').attr('price');
			var fulldomain = dom + '.' + ext;
			$.get(template_url+'/sh/DomainCheck.php?name='+fulldomain+'&price='+price, function(data){
				var $data = eval('('+data+')');
				if($data.status == 'available'){
					var Cents = $data.cents;
					var Sum = $data.sum;
					var Period = $data.period;
					$('.success.hide #sum').html(Sum);
					$('.success.hide #cents').html(Cents);
					$('.success.hide #period').html(Period);
					$('.success.hide .domainname').html(dom + '.' + ext);
					$('.success.hide').slideDown();
				}else if($data.status == 'taken'){
					$('.fail.hide .domainname').html(dom + '.' + ext);
					$('.fail.hide').slideDown();
				}else {
					$('.generalError.hide .domainname').html(dom + '.' + ext);
					$('.generalError.hide').slideDown();
				}
				console.log($data);
			});
			
		});
	});
	
	$('.tryagain').click(function(e){
		e.preventDefault();
		$(this).parent().slideUp(function(){
			$('.checkdomain').slideDown();
		});
	});
	
	/*
	$('#homeslider').anythingSlider({ 
	  // Appearance 
	  theme               : "simplehosting", // Theme name 
	  mode                : "horiz",   // Set mode to "horizontal", "vertical" or "fade" (only first letter needed); replaces vertical option 
	  expand              : false,     // If true, the entire slider will expand to fit the parent element 
	  resizeContents      : true,      // If true, solitary images/objects in the panel will expand to fit the viewport 
	  showMultiple        : false,     // Set this value to a number and it will show that many slides at once 
	  easing              : "swing",   // Anything other than "linear" or "swing" requires the easing plugin or jQuery UI 
	 
	  buildArrows         : false,      // If true, builds the forwards and backwards buttons 
	  buildNavigation     : true,      // If true, builds a list of anchor links to link to each panel 
	  buildStartStop      : false,      // If true, builds the start/stop button 
	  
	  // Slideshow options 
	  autoPlay            : true,     // If true, the slideshow will start running; replaces "startStopped" option 
	  autoPlayLocked      : false,     // If true, user changing slides will not stop the slideshow 
	  autoPlayDelayed     : false,     // If true, starting a slideshow will delay advancing slides; if false, the slider will immediately advance to the next slide when slideshow starts 
	  pauseOnHover        : true,      // If true & the slideshow is active, the slideshow will pause on hover 
	  stopAtEnd           : false,     // If true & the slideshow is active, the slideshow will stop on the last page. This also stops the rewind effect when infiniteSlides is false. 
	  playRtl             : false,     // If true, the slideshow will move right-to-left 
	 
	  // Times 
	  delay               : 3000,      // How long between slideshow transitions in AutoPlay mode (in milliseconds) 
	  resumeDelay         : 3000,     // Resume slideshow after user interaction, only if autoplayLocked is true (in milliseconds). 
	  animationTime       : 600,       // How long the slideshow transition takes (in milliseconds) 
	  delayBeforeAnimate  : 0,         // How long to pause slide animation before going to the desired slide (used if you want your "out" FX to show). 
	 
		hashTags: false,
	});
	*/
	
	/* Center thumbs */
	var $W = $('.thumbNav').outerWidth();
	var $WP = $('.thumbNav').parent().width();
	var $W2 = parseInt($W / 2);
	var $WP2 = parseInt($WP / 2);
	var margin = $WP2 - $W;
	$('.thumbNav').css('margin-left', margin + 'px');
	
	
	/* Equalize VPS package container */
	equalize('.vpscontainer article');
	
	
	 $( ".sh-accordion" ).accordion({autoHeight: false, clearStyle: true});
	 
	 
	 
	 
	$('<div class="grid" id="grid-slider2"></div>').insertAfter('#slider2');
	if($('#grid-slider2')){
		if(custom_hosting_traffic_titles != null){
			width = 100 / custom_hosting_traffic_titles.length;
			widthc = 100 + width;
			dwdth = width / 2 + 1;
			$('#grid-slider2').css('width', widthc + '%');
			$('#grid-slider2').css('left', '-' + dwdth + '%');
			for(i=0;i < custom_hosting_traffic_titles.length; i++){
				$('#grid-slider2').append('<div class="slidervalue" style="width:'+width+'%;">'+custom_hosting_traffic_titles[i] + '</div>');
			}
		}
	}
	
	$('<div class="grid" id="grid-slider1"></div>').insertAfter('#slider1');
	if($('#grid-slider1')){
		if(custom_hosting_hdd_titles != null){
			width = 100 / custom_hosting_hdd_titles.length;
			widthc = 100 + width;
			dwdth = width / 2 + 1;
			$('#grid-slider1').css('width', widthc + '%');
			$('#grid-slider1').css('left', '-' + dwdth + '%');
			for(i=0;i < custom_hosting_hdd_titles.length; i++){
				$('#grid-slider1').append('<div class="slidervalue" style="width:'+width+'%;">'+custom_hosting_hdd_titles[i] + '</div>');
			}
		}
	}
	
	equalize('.gridcontainer .floating3boxes');
/*
Add your functions below.
*/

});

/*
Functions called into document ready handler
*/
function equalize(container){
   var Maximum = 0
   jQuery(container).each(function(){
       var tmp = jQuery(this).height();
       if(tmp > Maximum)
           Maximum = tmp;
   });
   jQuery(container).height(Maximum + 'px');
}
   
function updateCartNum(num){
	jQuery("#shopping-cart-summary").find('span').html(num);
}

function updateCustomPrice(){
		baseprice = custom_hosting_baseprice;
		jQuery('.styled input:checked').each(function(){
			var value = parseFloat(jQuery(this).attr('rel'));
			baseprice = value + baseprice;
		});
	if(custom_hosting_hdd_titles != null){
		var pricehdd = custom_hosting_hdd_price;
		var index = jQuery("#hdd" ).val();
		jQuery('.cspace').html(custom_hosting_hdd_titles[index]);
		baseprice += parseFloat(pricehdd[index]);
	}
	if(custom_hosting_traffic_titles != null){
		var pricetrf = custom_hosting_traffic_price;
		var index = jQuery("#trf" ).val();
		jQuery('.ctraffic').html(custom_hosting_traffic_titles[index]);
		baseprice += parseFloat(pricetrf[index]);
	}	
		baseprice = roundNumber(baseprice, 2);
		parts = (baseprice + "").split('.');
		if(typeof parts[1] == 'undefined'){
			decimal = '00';
			parts[1] = '';
		}
		else {
			if(parts[1].length == 1) parts[1] = '0' + parts[1];
			decimal = parts[1];
		}
		jQuery('.cartprice #sum').html(parts[0]);
		jQuery('.cartprice #cents').html(decimal);
}

function roundNumber(num, dec){
	var result = Math.round(num*Math.pow(10,dec)) / Math.pow(10, dec);
	return result;
}

function resizeSidebar(){
	var height = jQuery(window).height();
	var w = jQuery(window).width();
	width = w - 660;
	if(height < 100) height = 100;
	jQuery('aside').outerHeight(height);
	jQuery('#map').outerHeight(height);
	jQuery('#map').outerWidth(width);
	
	minHeightToHide = jQuery('nav.menu-container').outerHeight() + 270;
	
	if(height < minHeightToHide){
		jQuery('#social-links-and-footer').addClass('relative');
	}else {
		if(jQuery('#social-links-and-footer').hasClass('relative')){
			jQuery('#social-links-and-footer').removeClass('relative');
		}
	}
}


