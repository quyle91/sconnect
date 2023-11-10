<?php 
global $post;
$col_class    = array( 'post-item', 'col' );
$show_excerpt = $excerpt;

if(get_post_format() == 'video') $col_class[] = 'has-post-icon';
if($type == 'grid'){
    if($grid_total > $current_grid) $current_grid++;
    $current = $current_grid-1;

    $col_class[] = 'grid-col';
    if($grid[$current]['height']) $col_class[] = 'grid-col-'.$grid[$current]['height'];

    if($grid[$current]['span']) $col_class[] = 'large-'.$grid[$current]['span'];
    if($grid[$current]['md']) $col_class[] = 'medium-'.$grid[$current]['md'];

    // Set image size
    //if($grid[$current]['size']) $image_size = $grid[$current]['size'];

    // Hide excerpt for small sizes
    if($grid[$current]['size'] == 'thumbnail') $show_excerpt = 'false';
}
if($image_width === "0"){
    $classes_box[] = 'no-thumbnail';
}
$col_class = apply_filters('fbc_flatsome_custom_blog_item_class', $col_class, $the_query, $repeater);
?>
<div class="<?php echo implode(' ', $col_class); ?>" <?php echo $animate;?>>
    <div class="col-inner">
        <?php do_action('fbc_flatsome_custom_blog_col_inner_before') ?>
        <a href="<?php echo apply_filters('flatsome_custom_blog_link',get_permalink(),$post) ?>" class="plain">
            <div class="box <?php echo implode(' ', $classes_box); ?> box-blog-post has-hover">
                <?php if(has_post_thumbnail()) { ?>
                    <?php if($image_width !=="0"){ ?>
                    <div class="box-image" <?php echo get_shortcode_inline_css($css_args_img); ?>>
                        <div class="<?php echo implode(' ', $classes_image); ?>" <?php echo get_shortcode_inline_css($css_image_height); ?>>
                            <?php the_post_thumbnail($image_size); ?>
                            <?php if($image_overlay){ ?><div class="overlay" style="background-color: <?php echo $image_overlay;?>"></div><?php } ?>
                            <?php if($style == 'shade'){ ?><div class="shade"></div><?php } ?>
                        </div>
                        <?php if($post_icon && get_post_format()) { ?>
                            <div class="absolute no-click x50 y50 md-x50 md-y50 lg-x50 lg-y50">
                                <div class="overlay-icon">
                                    <i class="icon-play"></i>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                <?php } ?>

                <div class="box-text <?php echo implode(' ', $classes_text); ?>" <?php echo get_shortcode_inline_css($css_args); ?>>
                    <div class="box-text-inner blog-post-inner">
                        <?php do_action('flatsome_blog_post_before'); ?>
                        <?php do_action('fbc_flatsome_blog_post_before',['classes_box'=>$classes_box, 'classes'=>$classes_text]) ?>

                        <?php 
                        if($show_category !== 'false') { ?>
                            <?php do_action('flatsome_custom_blog_category_before',$args); ?>
                            <p class="cat-label <?php if($show_category == 'label') echo 'tag-label'; ?> is-xxsmall op-7 uppercase">
                                <?php
                                    foreach((get_the_category()) as $cat) {
                                    echo $cat->cat_name . ' ';
                                }
                                ?>
                            </p>
                            <?php do_action('flatsome_custom_blog_category_before',$args); ?>
                            <?php 
                        } 
                        ?>



                        <?php if($show_title =='true'): ?>
                            <?php do_action('flatsome_custom_blog_title_before',$args); ?>
                            <h5 class="post-title is-<?php echo $title_size; ?> <?php echo $title_style;?>">
                                <?php do_action('flatsome_custom_blog_before_title',get_the_ID()) ?>
                                <span><?php the_title(); ?></span>
                            </h5>
                            <?php do_action('flatsome_custom_blog_title_after',$args); ?>
                        <?php endif; ?>


                        

                        <?php if((!has_post_thumbnail() && $show_date !== 'false') || $show_date == 'text') {?><div class="post-meta is-small op-8"><?php echo get_the_date(); ?></div><?php } ?>
                        <?php if($show_divider == 'true'): ?>
                            <div class="is-divider"></div>
                        <?php endif; ?>

                        <?php if($show_excerpt !== 'false') { ?>
                            <p class="from_the_blog_excerpt <?php if($show_excerpt !== 'visible'){ echo 'show-on-hover hover-'.$show_excerpt; } ?>"><?php
                              $the_excerpt  = get_the_excerpt();
                              $excerpt_more = apply_filters( 'excerpt_more', ' [...]' );
                              echo flatsome_string_limit_words($the_excerpt, $excerpt_length) . $excerpt_more;
                            ?>
                            </p>
                        <?php } ?>

                        <?php if ( $comments == 'true' && comments_open() && '0' != get_comments_number() ) { ?>
                            <p class="from_the_blog_comments uppercase is-xsmall">
                                <?php
                                    $comments_number = get_comments_number( get_the_ID() );
                                    /* translators: %s: comment count */
                                    printf( _n( '%s Comment', '%s Comments', $comments_number, 'flatsome' ),
                                        number_format_i18n( $comments_number ) )
                                ?>
                            </p>
                        <?php } ?>

                        <?php if($readmore) { ?>
                            <button href="<?php echo apply_filters('flatsome_custom_blog_link',get_permalink(),$post) ?>" class="button <?php echo $readmore_color; ?> is-<?php echo $readmore_style; ?> is-<?php echo $readmore_size; ?> mb-0">
                                <?php echo $readmore ;?>
                            </button>
                        <?php } ?>

                        <?php do_action('fbc_flatsome_blog_post_after'); ?>
                        <?php do_action('flatsome_blog_post_after'); ?>
                    </div>
                </div>

                <?php if(has_post_thumbnail() && ($show_date == 'badge' || $show_date == 'true')) {?>
                    <?php if(!$badge_style) $badge_style = get_theme_mod('blog_badge_style', 'outline'); ?>
                    <div class="badge absolute top post-date badge-<?php echo $badge_style; ?>">
                        <div class="badge-inner">
                            <span class="post-date-day"><?php echo get_the_time('d', get_the_ID()); ?></span><br>
                            <span class="post-date-month is-xsmall"><?php echo get_the_time('M', get_the_ID()); ?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </a>
        <?php do_action('fbc_flatsome_custom_blog_col_inner_after') ?>
    </div>
</div>