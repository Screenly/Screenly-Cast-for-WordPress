jQuery(document).ready(function($) {
	
	$('#srlySelectImage').click(function(e) {
		e.preventDefault();

		var custom_uploader = wp.media({
			title: 'Select Logo',
			button: {
				text: 'Select as Logo'
			},
			multiple: false  // Set this to true to allow multiple files to be selected
		})
		.on('select', function() {
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			$('#media_image').attr('src', attachment.url);
			$('#screenly_options_logo').val(attachment.url);
		})
		.open();
	});
	$('#media_image').attr('src', $('#screenly_options_logo').val());
	$('.srly_color_picker').wpColorPicker();
	
	$('#srly_brand_logo_width').change(function(){
		$("#srly_brand_logo_width_slider_output").html($("#srly_brand_logo_width").val()+"px");
	});
	$("#srly_brand_logo_width_slider_output").html($("#srly_brand_logo_width").val()+"px");
	
	$('#srly_brand_logo_height').change(function(){
		$("#srly_brand_logo_height_slider_output").html($("#srly_brand_logo_height").val()+"px");
	});
	$("#srly_brand_logo_height_slider_output").html($("#srly_brand_logo_height").val()+"px");
	
	$('#srly_time_font_size').change(function(){
		$("#srly_time_font_size_slider_output").html($("#srly_time_font_size").val()+"px");
	});
	$("#srly_time_font_size_slider_output").html($("#srly_time_font_size").val()+"px");
	
	$('#srly_time_font_weight').change(function(){
		$("#srly_time_font_weight_slider_output").html($("#srly_time_font_weight").val());
	});
	$("#srly_time_font_weight_slider_output").html($("#srly_time_font_weight").val());
	
	$('#srly_h1_font_size').change(function(){
		$("#srly_h1_font_size_slider_output").html($("#srly_h1_font_size").val()+"px");
	});
	$("#srly_h1_font_size_slider_output").html($("#srly_h1_font_size").val()+"px");
	
	$('#srly_h1_font_weight').change(function(){
		$("#srly_h1_font_weight_slider_output").html($("#srly_h1_font_weight").val());
	});
	$("#srly_h1_font_weight_slider_output").html($("#srly_h1_font_weight").val());
	
	$('#srly_a_font_weight').change(function(){
		$("#srly_a_font_weight_slider_output").html($("#srly_a_font_weight").val());
	});
	$("#srly_a_font_weight_slider_output").html($("#srly_a_font_weight").val());
	
	$('#srly_a_font_size').change(function(){
		$("#srly_a_font_size_slider_output").html($("#srly_a_font_size").val()+"px");
	});
	$("#srly_a_font_size_slider_output").html($("#srly_a_font_size").val()+"px");
	
	$('#srly_content_margin_top').change(function(){
		$("#srly_content_margin_top_slider_output").html($("#srly_content_margin_top").val()+"px");
	});
	$("#srly_content_margin_top_slider_output").html($("#srly_content_margin_top").val()+"px");
	
	$('#srly_content_line_height').change(function(){
		$("#srly_content_line_height_slider_output").html($("#srly_content_line_height").val()+"px");
	});
	$("#srly_content_line_height_slider_output").html($("#srly_content_line_height").val()+"px");
	
	$('#srly_content_font_weight').change(function(){
		$("#srly_content_font_weight_slider_output").html($("#srly_content_font_weight").val());
	});
	$("#srly_content_font_weight_slider_output").html($("#srly_content_font_weight").val());
	
	$('#srly_content_font_size').change(function(){
		$("#srly_content_font_size_slider_output").html($("#srly_content_font_size").val()+"px");
	});
	$("#srly_content_font_size_slider_output").html($("#srly_content_font_size").val()+"px");
	
	$('#srly_h1_margin').change(function(){
		$("#srly_h1_margin_slider_output").html($("#srly_h1_margin").val()+"px");
	});
	$("#srly_h1_margin_slider_output").html($("#srly_h1_margin").val()+"px");
	
	$('#srly_h1_padding').change(function(){
		$("#srly_h1_padding_slider_output").html($("#srly_h1_padding").val()+"px");
	});
	$("#srly_h1_padding_slider_output").html($("#srly_h1_padding").val()+"px");
	
	$('#srly_category_switch_period').change(function(){
		$("#srly_category_switch_period_slider_output").html($("#srly_category_switch_period").val()+" ms");
	});
	$("#srly_category_switch_period_slider_output").html($("#srly_category_switch_period").val()+" ms");
});