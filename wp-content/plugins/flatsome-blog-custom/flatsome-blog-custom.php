<?php
/*
 * Plugin Name: Flatsome Custom Blog
 * Plugin URI: #
 * Description: Custom blog mặc định của flatsome
 * Author: htecom
 * Author URI: htecom.vn
 * Version: 1.1
 * Created: 27/11/2022
 * Last Update: 27/11/2022
 * Text Domain: #
 * License: #
 */


defined( 'ABSPATH' ) || exit;
if(!in_array('Flatsome', [wp_get_theme()->name, wp_get_theme()->parent_theme])) return;
define( 'FBC_PATH', plugin_dir_url(__FILE__) );
define( 'FBC_DIR', plugin_dir_path(__FILE__) );
define( 'FBC_JS_VER', false );
include_once( dirname(__FILE__ )."/builder.php" );
include_once( dirname(__FILE__ )."/shortcode.php" );
include_once( dirname(__FILE__ )."/ajax.php" );

add_filter('adminz_flatsome_hooks',function($a){
	$a[] = 'fbc_flatsome_blog_post_before';
	$a[] = 'fbc_flatsome_blog_post_after';
	return $a;
});


add_action('init',function(){
	remove_action( 'woocommerce_shop_loop_item_title', 'flatsome_woocommerce_shop_loop_category', 0 );
	add_action('woocommerce_shop_loop_item_title',function(){
		if ( ! flatsome_option( 'product_box_category' ) ) {return; } ?>

		<p class="category uppercase is-smaller no-text-overflow product-cat op-7">
			<?php
				global $product;
				$product_cats = wc_get_product_category_list( get_the_ID(), '\n', '', '' );
				$product_cats = explode( '\n', $product_cats );
				echo apply_filters('flatsome_woocommerce_shop_loop_category', implode(", ", $product_cats));
			?>
		</p>
		<?php
	},0);
});
