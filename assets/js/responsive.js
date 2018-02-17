/*jshint strict: false */
/*global jQuery */

/* DESKTOP */

function auto_caculate_width(){
	
	// Returns width of browser viewport
	var browser_width;
	browser_width = jQuery(window ).width();
	
	if(browser_width >= 1260){
	
		var browser_height;
		browser_height = jQuery(window ).height();
		jQuery('body').height(browser_height);

		var main_width_search_calc;
		if(jQuery('.menu-bar').hasClass('collapse')){
			main_width_search_calc = (browser_width - 650);
			/* jQuery('.menu-bar-search input').css('background', 'red'); */
		}
		else { 
			main_width_search_calc = (browser_width - 865);
			/* jQuery('.menu-bar-search input').css('background', 'green'); */
		}

		var main_width_search_size; 
		main_width_search_size = main_width_search_calc+'px';

		jQuery('.menu-bar-search input').css('width', main_width_search_size);
		/* jQuery('.custom-logo').css('background', 'pink'); */
		
		
		//main section and sidebar			
		var main_width_calc;
		main_width_calc = (browser_width - 700);
		var main_width_size; 
		main_width_size = main_width_calc+'px';
		
		//main section cards width
		var main_cards_width_size;
		main_cards_width_size = (main_width_calc - 95);

		//main section full width
		var main_full_width_size;
		main_full_width_size = (main_width_calc + 595);
		
		//main section full width
		var main_full_width_subnav_size;
		main_full_width_subnav_size = (main_width_calc + 380);
		
		//main section dashboard width
		var main_full_dashboard_width_size;
		main_full_dashboard_width_size = (main_width_calc + 380);

		//section-left-form
		var section_left_form_width;
		section_left_form_width = (main_width_calc - 85);
		
		//section-left-form
		var section_left_form_subnav_width;
		section_left_form_subnav_width = (main_width_calc - 305);

		jQuery('.main-section, .main-section-subnav').css('width', main_width_size);
		jQuery('.main-section-dashboard').css('width', main_full_dashboard_width_size);
		jQuery('.main-section-cards').css('width', main_cards_width_size);
		jQuery('.main-section-full').css('width', main_full_width_size);
		jQuery('.main-section-subnav-full').css('width', main_full_width_subnav_size);
		jQuery('.section-left-form').css('width', section_left_form_width);
		jQuery('.section-left-form-subnav').css('width', section_left_form_subnav_width);
		
		/* jQuery('.main-section, .main-section-cards, .main-section-full, .section-left-form, .main-section-subnav, .main-section-dashboard').css('background', 'blue'); */

		/* Set card column height */
		var min_container_height;
		min_container_height = (browser_height - 190);

		/* Contacts list page */
		var main_section_card_height;
		main_section_card_height = jQuery('.main-section-cards').height();
		var aside_card_height;
		aside_card_height = jQuery('aside.cards').height();

		if(main_section_card_height > min_container_height){
			min_container_height = main_section_card_height;
		}
		if(aside_card_height > min_container_height){
			min_container_height = aside_card_height;
		}
		jQuery('.main-section-cards').css('min-height', min_container_height);
		jQuery('aside.cards').css('min-height', min_container_height);
		jQuery('aside.card-breakdown').css('min-height', min_container_height);
		
		/* jQuery('aside').css('background', 'green'); */


		/* Contacts edit page */

		min_container_height = (browser_height - 190);

		var section_left_form_height;
		section_left_form_height = jQuery('.section-left-form, .section-left-form-subnav').height();
		var aside_card_detail_height;
		aside_card_detail_height = jQuery('aside.card-breakdown').height();

		if(section_left_form_height > min_container_height){
			min_container_height = (section_left_form_height+40);
		}
		if(aside_card_detail_height > min_container_height){
			min_container_height = aside_card_detail_height;
		}


		jQuery('.section-left-form').css('min-height', min_container_height);
		jQuery('aside.card-breakdown').css('min-height', min_container_height);
	
	}// end of mobile check
	//

}

jQuery(document).ready(function(){
	auto_caculate_width();
});

jQuery(window).resize(function() {
	auto_caculate_width();
});

/* Collapsable menu */

jQuery(document).ready(function(){
	
	var mainsectioncards; 
	mainsectioncards = jQuery('.main-section-cards').width();
		
	var browser_width;
	browser_width = jQuery(window ).width();
	
	if(browser_width >= 1260){
		
		jQuery('.main-menu.collapse nav ul li.nav_top').mouseenter(function(){	
			
			if(jQuery('.main-menu').hasClass('animate_open')){
			}
			else{
				if(jQuery('.main-menu').hasClass('animating')){
					console.log('already animating');
				}
				else{
					jQuery('.main-menu').addClass('animating');
					jQuery('.sub_navigation').hide();
					jQuery('.nav-arrow').hide();

					jQuery('.main-menu.collapse .profile-current').animate({
						backgroundColor: '#51C6DA'
					}, '200');

					jQuery('.main-menu.collapse .profile-current img').animate({
						width: '+=18px',
						height: '+=18px'
					}, '200');

					jQuery(".main-menu").animate({
						width: '+=205px'
					}, 200);

					jQuery(".menu-bar .custom-logo, header.title .client-value").animate({
						marginLeft: '+=215px'
					}, 200);

					jQuery('.main-section, .main-section-full').animate({
						marginLeft: '+=205px',
						width: '-=205px', 
					}, 200);
					
					jQuery('.main-section-cards').animate({
						marginLeft: '+=215px',
						width: '-=215px', 
					}, 200);
					
					jQuery('.menu-bar-search input').animate({
						width: '-=215px', 
					}, 200);


					jQuery('.section-left-form').animate({
						width: '-=215px'
					}, 200);

					/* */

					setTimeout(function(){ 

						jQuery('.main-menu').removeClass('collapse');
						jQuery('.menu-bar').removeClass('collapse');
						jQuery('.main-menu .profile-current .col-lg-8').show();
						jQuery('.main-menu').addClass('animate_open');
						jQuery('.main-menu').removeClass('animating');
						
					}, 200);
				}

			}			   
		   		
		});
		

		jQuery('.main-menu').mouseleave(function(){	
						
			if(jQuery('.main-menu').hasClass('animate_open')){	
				
				if(jQuery('.main-menu').hasClass('animating')){
				}
				else{
				
					jQuery('.main-menu').addClass('animating');

					jQuery('.main-menu .profile-current .col-lg-8').hide();
					jQuery('.main-menu').addClass('collapse');

					jQuery('.main-menu .profile-current').animate({
						backgroundColor: '#4A5A6A'
					}, '200');

					jQuery('.main-menu .profile-current img').animate({
						width: '-=18px',
						height: '-=18px'
					}, '200');


					jQuery(".main-menu").animate({
						width: '-=205px'
					}, 200);

					jQuery(".menu-bar .custom-logo, header.title .client-value").animate({
						marginLeft: '-=215px'
					}, 200);

					jQuery('.main-section, .main-section-full').animate({
						width: '+=205px', 
						marginLeft: '-=205px'

					}, 200);
					
					jQuery('.main-section-cards').animate({
						width: '+=215px', 
						marginLeft: '-=215px'

					}, 200);
					
					jQuery('.menu-bar-search input').animate({
						width: '+=215px', 
					}, 200);
					
					jQuery('.section-left-form').animate({
						width: '+=215px'
					}, 200);

					/* */

					setTimeout(function(){ 

						jQuery('.sub_navigation').show();
						jQuery('.nav-arrow').show();
						jQuery('.menu-bar').addClass('collapse');
						jQuery('.main-menu').removeClass('animate_open');
						jQuery('.main-menu').removeClass('animating');
						
					}, 200);
					
				}

			}


		});
		
	} // end of mobile check

	
});