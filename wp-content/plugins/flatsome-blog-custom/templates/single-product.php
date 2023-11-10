<?php 
global $product;
if($style == 'default'){
 	wc_get_template_part( 'content', 'product' );
} else {
  	// Ensure visibility.
  	// if ( empty( $product ) || false === wc_get_loop_product_visibility( $product->get_id() ) || ! $product->is_visible() ) {continue; }

	$classes_col = array('col');
	$out_of_stock = ! $product->is_in_stock();
	if($out_of_stock) $classes[] = 'out-of-stock';

	if($type == 'grid'){
        if($grid_total > $current_grid) $current_grid++;
        $current = $current_grid-1;
        $classes_col[] = 'grid-col';
        if($grid[$current]['height']) $classes_col[] = 'grid-col-'.$grid[$current]['height'];

        if($grid[$current]['span']) $classes_col[] = 'large-'.$grid[$current]['span'];
			 if($grid[$current]['md']) $classes_col[] = 'medium-'.$grid[$current]['md'];
        // Set image size
        if($grid[$current]['size']) $image_size = $grid[$current]['size'];
    }
    $classes_col = apply_filters('fbc_flatsome_custom_blog_item_class', $classes_col, $the_query, $repeater);
	?>
	<div class="<?php echo implode(' ', $classes_col); ?>" <?php echo $animate;?>>
		<div class="col-inner">
			<?php do_action('fbc_flatsome_custom_blog_col_inner_before') ?>
			<?php woocommerce_show_product_loop_sale_flash(); ?>
			<div class="box product-small <?php echo implode(' ', $classes_box); ?> has-hover">
				<div class="box-image" <?php echo get_shortcode_inline_css($css_args_img); ?>>
					<div class="<?php echo implode(' ', $classes_image); ?>" <?php echo get_shortcode_inline_css($css_image_height); ?>>
						<a href="<?php echo get_the_permalink(); ?>" aria-label="<?php echo esc_attr( $product->get_title() ); ?>">
							<?php
								if($back_image) flatsome_woocommerce_get_alt_product_thumbnail($image_size);
								echo woocommerce_get_product_thumbnail($image_size);
							?>
						</a>
						<?php if($image_overlay){ ?><div class="overlay fill" style="background-color: <?php echo $image_overlay;?>"></div><?php } ?>
						 <?php if($style == 'shade'){ ?><div class="shade"></div><?php } ?>
					</div>
					<div class="image-tools top right show-on-hover">
						<?php do_action('flatsome_product_box_tools_top'); ?>
					</div>
					<?php if($style !== 'shade' && $style !== 'overlay') { ?>
						<div class="image-tools <?php echo flatsome_product_box_actions_class(); ?>">
							<?php  do_action('flatsome_product_box_actions'); ?>
						</div>
					<?php } ?>
					<?php if($out_of_stock) { ?><div class="out-of-stock-label"><?php _e( 'Out of stock', 'woocommerce' ); ?></div><?php }?>
				</div>

				<div class="box-text <?php echo implode(' ', $classes_text); ?>" <?php echo get_shortcode_inline_css($css_args); ?>>
					<?php
						do_action( 'woocommerce_before_shop_loop_item_title' );

						echo '<div class="title-wrapper">';
						do_action( 'woocommerce_shop_loop_item_title' );
						echo '</div>';

						echo '<div class="price-wrapper">';
						do_action( 'woocommerce_after_shop_loop_item_title' );
						echo '</div>';

						if($style == 'shade' || $style == 'overlay') {
						echo '<div class="overlay-tools">';
							do_action('flatsome_product_box_actions');
						echo '</div>';
						}

						do_action( 'flatsome_product_box_after' );

					?>
				</div>
			</div>
		</div>
	</div>
	<?php 
}