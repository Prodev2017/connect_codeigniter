/*jshint strict: false */
/*global jQuery */

/* Initialize Redactor Editor */

jQuery(function(){
	jQuery('.wysiwyg').redactor();
});

/* Initialize Datepicker */

jQuery( function() {
	jQuery( ".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
 });


/* Time pair */
/*
jQuery('#timepair .time').timepicker({
	'showDuration': true,
	'timeFormat': 'H:i',
	'show2400': true,
});

jQuery('#timepair').datepair();
*/

/* Time picker */

$('.time.start').timepicker();

$('.time.end').timepicker({
    'minTime': '0:00am',
    'maxTime': '11:30pm',
});

jQuery(document).ready(function(){
	
	/* Add row to quote builder */ 
	
	jQuery('.remove_row').on('click', function(){
		
		jQuery(this).parent().parent().parent().remove();
		
	});
	
	jQuery('.add_row').on('click', function(){
		
		/* Remove additional row after this row */
		
		var quote_row_html; 
		
		quote_row_html = '<div class="quote-row"><div class="quote_item"><label for="item">ITEM</label><div class="clearfix"></div><input type="text" name="item" class="form-control"></div><div class="quote_description"><label for="description">DESCRIPTION</label><div class="clearfix"></div><input type="text" name="description" class="form-control"></div><div class="quote_quantity"><label for="quantity">QUANTITY</label><div class="clearfix"></div><input type="text" name="quantity" class="form-control"></div><div class="quote_unitprice"><label for="unit_price">UNIT PRICE</label><div class="clearfix"></div><span class="label-left" for="unit_price">&pound;</span><span class="form-right"><input type="text" class="form-control" id="unit_price"></span></div><div class="quote_subtotal"><label for="sub_total">SUB TOTAL</label><div class="clearfix"></div><span class="label-left" for="sub_total">&pound;</span><span class="form-right"><input type="text" class="form-control" id="sub_total"></span></div><div class="quote_managerows"><div class="float-right"><div class="remove_row"></div><div class="add_row"></div></div><!-- end of float right --></div><div class="clearfix"></div></div><!-- end of quote row --><div class="clearfix"></div>';
		
		jQuery('.quote_builder').append(quote_row_html);
		
	});
	
	/* Draggable workflow */

	jQuery(".project").draggable({
		cursor: "move",
		helper: 'clone',
		revert: "invalid"
	});

	jQuery(".projects").droppable({
		tolerance: "intersect",
		accept: ".project",
		activeClass: "ui-state-default",
		hoverClass: "ui-state-hover",
		drop: function(event, ui) {        
			jQuery(this).append(jQuery(ui.draggable));
		}
	});
		
	/* To do toggles */
	
	jQuery('.toggle').click(function(){
		if(jQuery(this).hasClass('toggle-open')){
			jQuery(this).parent().parent().removeClass('active');
			jQuery(this).removeClass('toggle-open');
			jQuery(this).addClass('toggle-close');
		}
		else {
			jQuery(this).parent().parent().addClass('active');
			jQuery(this).removeClass('toggle-close');
			jQuery(this).addClass('toggle-open');
			
			
		}
		
	});
	
	/* Mobile nav toggle */
	
	jQuery('.toggle-navigation').click(function(){		
		
		if(jQuery('.toggle-navigation').hasClass('toggle-open')){
			console.log('close nav');
			jQuery('.toggle-navigation').removeClass('toggle-open');
			jQuery('.toggle-navigation').addClass('toggle-close');
			jQuery('.main-menu').fadeOut('fast');
			
		}
		else {
			console.log('open nav');
			jQuery('.toggle-navigation').removeClass('toggle-close');
			jQuery('.toggle-navigation').addClass('toggle-open');
			jQuery('.main-menu').fadeIn('fast');
			
		}
		
	});
	
	/* Toggle tab planned / past */
	
	jQuery('#tab_planned').click(function(){	
				
		if(jQuery(this).hasClass('toggle-open')){
			jQuery(this).removeClass('toggle-open');
			jQuery(this).addClass('toggle-close');
			jQuery('#tab_planned_content').slideUp();	
			
		}
		else {
			jQuery(this).removeClass('toggle-close');
			jQuery(this).addClass('toggle-open');
			jQuery('#tab_planned_content').slideDown();	
			
		}
		
	});
	
	jQuery('#tab_past').click(function(){	
				
		if(jQuery(this).hasClass('toggle-open')){
			jQuery(this).removeClass('toggle-open');
			jQuery(this).addClass('toggle-close');
			jQuery('#tab_past_content').slideUp();	
			
		}
		else {
			jQuery(this).removeClass('toggle-close');
			jQuery(this).addClass('toggle-open');
			jQuery('#tab_past_content').slideDown();	
			
		}
		
	});
	
	/* client planned tabs */
	
	jQuery('#tab_nav_planned .tabs').click(function(){
		
		var tab_id; 
		tab_id = jQuery(this).attr('id');
		console.log(tab_id);
				
		jQuery('#tab_nav_planned .tabs').removeClass('active');
		jQuery(this).addClass('active');
		
		jQuery('.tab-planned .tab').hide();
		jQuery('.'+tab_id).show();
		
	});
	
	/* client past tabs */
	
	jQuery('#tab_nav_past .tabs').click(function(){
		
		var tab_id; 
		tab_id = jQuery(this).attr('id');
		console.log(tab_id);
				
		jQuery('#tab_nav_past .tabs').removeClass('active');
		jQuery(this).addClass('active');
		
		jQuery('.tab-past .tab').hide();
		jQuery('.'+tab_id).show();
		
	});

	// clear form input fields on click
	$(".clear-input").on("click", function () {
		$(this).prev('input').val('');
	});

	// show other fields on click on this button
	$("#edit-full-record").on("click",function(){
		$(this).hide();
		$(".f-hide-small").fadeIn();
	});
	
});