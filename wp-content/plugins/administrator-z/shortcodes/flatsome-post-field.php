<?php 
use Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
$a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
$a->shortcode_name = 'adminz_post_field';
$a->shortcode_type = 'container';
$a->shortcode_title = 'Post Field';
$a->shortcode_icon = 'text';
$options = [
	'post_field'=> [
		'type' =>'select',
		'heading' => 'Select Field',
		'default' => 'post_title',
		'options' => [
			"ID" => "ID",
			"post_author" => "post_author",
			"post_date" => "post_date",
			"post_date_gmt" => "post_date_gmt",
			"post_content" => "post_content",
			"post_title" => "post_title",
			"post_excerpt" => "post_excerpt",
			"post_status" => "post_status",
			"comment_status" => "comment_status",
			"ping_status" => "ping_status",
			"post_password" => "post_password",
			"post_name" => "post_name",
			"to_ping" => "to_ping",
			"pinged" => "pinged",
			"post_modified" => "post_modified",
			"post_modified_gmt" => "post_modified_gmt",
			"post_content_filtered" => "post_content_filtered",
			"post_parent" => "post_parent",
			"guid" => "guid",
			"menu_order" => "menu_order",
			"post_type" => "post_type",
			"post_mime_type" => "post_mime_type",
			"comment_count" => "comment_count",
			"filter" => "filter",
		]
	]
];

$options = array_merge(
	$options,
	require ADMINZ_DIR."/shortcodes/inc/flatsome-element-advanced.php",
);
$a->options = $options;
$a->shortcode_callback = function($atts, $content){
	extract(shortcode_atts(array(
		"post_field" => "post_title",
		"before" => "",
		"after" => "",
		"search" => "",
		"replace" => "",
    ), $atts));

    if(isset($_POST['ux_builder_action'])){
        return '<span style="background: #71cedf; border: 2px dashed #000; display: flex; color: white; justify-content: center; align-items: center;">Demo Post Field result for '.$post_field.'</span>'; 
    }

	if(!$post_field) return;

	global $post;
	ob_start();	
	echo get_post_field( $post_field, $post);
	return apply_filters('adminz_apply_content_change',ob_get_clean(), $atts, $content);
};

$a->general_element();
