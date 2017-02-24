(function($,Drupal, drupalSettings){
	$(document).ready(function(){
		//alert('Hello !');

	// external links
	$('a[href^="https://"]').attr('target','_blank').addClass('external-link');
});
	//plier cacher

	Drupal.behaviors.collapsableBlock = {
		attach: function(context, settings){
			$('.sidebar .block h2', context).click(function(){
				$(this).parent().find('.content').slideToggle('fast');
		});
	}
}

//initialisation de match height

/*	Drupal.behaviors.collapsableBlock = {
		attach: function(context, settings){
            $('.views-col').matchHeight();
	}   
}*/
})(jQuery, Drupal, drupalSettings);