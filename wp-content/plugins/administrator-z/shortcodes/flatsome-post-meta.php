<?php 
use Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
$a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
$a->shortcode_name = 'adminz_post_meta';
$a->shortcode_type = 'container';
$a->shortcode_title = 'Post Meta';
$a->shortcode_icon = 'text';
$options = [
	'meta_key'=> [
		'type' =>'textfield',
		'heading' => 'Meta key',
		'default' => '_thumbnail_id',
		'description' => 'Test Meta Url: '.get_site_url()."?testmeta=post_id",
	]
];
$options = array_merge(
	$options,
	require ADMINZ_DIR."/shortcodes/inc/flatsome-element-advanced.php",
);




$a->options = $options;



$a->shortcode_callback = function($atts, $content){
	extract(shortcode_atts(array(
		"meta_key" => "_thumbnail_id"
    ), $atts));

	if(isset($_POST['ux_builder_action'])){
        return '<span style="background: #71cedf; border: 2px dashed #000; display: flex; color: white; justify-content: center; align-items: center;">Demo Post Meta result for '.$meta_key.'</span>'; 
    }

	if(!$meta_key) return;

    ob_start();	
	echo get_post_meta( get_the_ID(), $meta_key, true);
	return apply_filters('adminz_apply_content_change',ob_get_clean(), $atts, $content);
};

$a->general_element();