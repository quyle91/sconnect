<?php 
add_shortcode( 'custom_blog_posts', function($atts, $content = null, $tag = ''){
    $atts = wp_parse_args($_GET,$atts);
    extract(shortcode_atts(array(
        "_id" => 'row-'.rand(),
        'style' => '',
        'class' => '',
        'visibility' => '',
        'posts_per_page' => get_option('posts_per_page'),
        'is_paged' => 'true',
        'is_ajax' => 'true',
        'post_type'=>'post',
        'group_cells' => 0,
        'slide_to_show' => 3,
        'ztitle'=>'',

        // Layout
        "columns" => '4',
        "columns__sm" => '1',
        "columns__md" => '',
        'col_spacing' => '',
        "type" => 'slider', // slider, row, masonery, grid
        'width' => '',
        'grid' => '1',
        'grid_height' => '600px',
        'grid_height__md' => '500px',
        'grid_height__sm' => '400px',
        'slider_nav_style' => 'reveal',
        'slider_nav_position' => '',
        'slider_nav_color' => '',
        'slider_bullets' => 'false',
        'slider_arrows' => 'true',
        'slider_hide_nav'=>'',
        'auto_slide' => 'false',
        'infinitive' => 'false',
        'depth' => '',
        'depth_hover' => '',

        // posts
        'posts' => '12',
        'ids' => false, // Custom IDs
        'cat' => false,
        'category' => '', // Added for Flatsome v2 fallback
        'excerpt' => 'visible',
        'excerpt_length' => 15,
        'offset' => '',
        'orderby' => 'date',
        'order' => 'DESC',
        'tags' => '',

        // Read more
        'readmore' => '',
        'readmore_color' => '',
        'readmore_style' => 'outline',
        'readmore_size' => 'small',

        // div meta
        'post_icon' => 'true',
        'post_status' => 'publish',
        'comments' => 'true',
        'show_divider' => 'true',
        'show_title' => 'true',
        'show_date' => 'badge', // badge, text
        'badge_style' => '',
        'show_category' => 'false',

        //Title
        'title_size' => 'large',
        'title_style' => '',

        // Box styles
        'animate' => '',
        'text_pos' => 'bottom',
        'text_padding' => '',
        'text_bg' => '',
        'text_size' => '',
        'text_color' => '',
        'text_hover' => '',
        'text_align' => 'center',
        'image_size' => 'medium',
        'image_width' => '',
        'image_radius' => '',
        'image_height' => '56%',
        'image_hover' => '',
        'image_hover_alt' => '',
        'image_overlay' => '',
        'image_depth' => '',
        'image_depth_hover' => '',

    ), $atts));
    

    // Stop if visibility is hidden
    if($visibility == 'hidden') return;

    ob_start();
    $wrapper_class = array(
        'blog-posts-custom-element-wrapper', 
        'mb-0',
        'relative', 
        'type-'.$type,
        $post_type
    );
    $classes_box = array();
    $classes_image = array();
    $classes_text = array();

    // Fix overlay color
    if($style == 'text-overlay'){
      $image_hover = 'zoom';
    }
    $style = str_replace('text-', '', $style);

    // Fix grids
    if($type == 'grid'){
      if(!$text_pos) $text_pos = 'center';
      $columns = 0;
      $current_grid = 0;
      $grid = apply_filters('flatsome_get_grid',flatsome_get_grid($grid),$grid);
      $grid_total = count($grid);
      flatsome_get_grid_height($grid_height, $_id);
    }

    // fix slide vertical
    if($type == 'slide-vertical'){
        $columns = 0;
        $comments = false;
    }

    // Fix overlay
    if($style == 'overlay' && !$image_overlay) $image_overlay = 'rgba(0,0,0,.25)';

    // Set box style
    if($style) $classes_box[] = 'box-'.$style;
    if($style == 'overlay') $classes_box[] = 'dark';
    if($style == 'shade') $classes_box[] = 'dark';
    if($style == 'badge') $classes_box[] = 'hover-dark';
    if($text_pos) $classes_box[] = 'box-text-'.$text_pos;

    // Fix cho ignore_vertical
    if($class) $classes_box[] = $class;

    if($image_hover)  $classes_image[] = 'image-'.$image_hover;
    if($image_hover_alt)  $classes_image[] = 'image-'.$image_hover_alt;
    if($image_height) $classes_image[] = 'image-cover';

    // Text classes
    if($text_hover) $classes_text[] = 'show-on-hover hover-'.$text_hover;
    if($text_align) $classes_text[] = 'text-'.$text_align;
    if($text_size) $classes_text[] = 'is-'.$text_size;
    if($text_color == 'dark') $classes_text[] = 'dark';

    $css_args_img = array(
      array( 'attribute' => 'border-radius', 'value' => $image_radius, 'unit' => '%' ),
      array( 'attribute' => 'width', 'value' => $image_width, 'unit' => '%' ),
    );

    $css_image_height = array(
      array( 'attribute' => 'padding-top', 'value' => $image_height),
    );

    $css_args = array(
      array( 'attribute' => 'background-color', 'value' => $text_bg ),
      array( 'attribute' => 'padding', 'value' => $text_padding ),
    );

    // Add Animations
    if($animate) {$animate = 'data-animate="'.$animate.'"';}

    // Always show Nav if set
    if($slider_hide_nav ==  'true') {$class .= ' slider-show-nav';}



    // check ajax
    if(!wp_doing_ajax()):
    echo '<div id="' . esc_attr($_id) . '" class="' . implode( ' ', $wrapper_class ) . '">';
    endif;

    // Repeater styles
    $repeater['id'] = $_id;
    $repeater['tag'] = $tag;
    $repeater['type'] = $type;
    $repeater['class'] = $class;
    $repeater['visibility'] = $visibility;
    $repeater['style'] = $style;
    $repeater['slider_style'] = $slider_nav_style;
    $repeater['slider_nav_position'] = $slider_nav_position;
    $repeater['slider_nav_color'] = $slider_nav_color;
    $repeater['slider_bullets'] = $slider_bullets;
    $repeater['auto_slide'] = $auto_slide;
    $repeater['infinitive'] = $infinitive;
    $repeater['row_spacing'] = $col_spacing;
    $repeater['row_width'] = $width;
    $repeater['columns'] = $columns;
    $repeater['columns__md'] = $columns__md;
    $repeater['columns__sm'] = $columns__sm;
    $repeater['depth'] = $depth;
    $repeater['depth_hover'] = $depth_hover;


    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;         
    if(wp_doing_ajax()){
        if(isset($atts['page'])){
            $paged = $atts['page'];
        }
    }


    $args = array(
        'post_status' => $post_status,
        'paged' => $paged,
        'post_type' => $post_type,
        'offset' => $offset,
        'cat' => $cat,
        'tag__in' => $tags ? array_filter( array_map( 'trim', explode( ',', $tags ) ) ) : '',
        'posts_per_page' => $posts,
        'ignore_sticky_posts' => true,
        'orderby'             => $orderby,
        'order'               => $order,
    );

    // Added for Flatsome v2 fallback
    if ( get_theme_mod('flatsome_fallback', 0) && $category ) {
        $args['category_name'] = $category;
    }
    // echo '<pre>'; print_r($atts); echo '</pre>';

    $args['tax_query'] = [
        'relation' => 'AND',
    ];
    
    // Custom tax
    if(isset($atts['__taxonomy_'.$post_type])){
        $tax_slug = $atts['__taxonomy_'.$post_type];
        if(isset($atts['__term_'.$tax_slug."_".$post_type]) and $atts['__term_'.$tax_slug."_".$post_type] and $atts['__term_'.$tax_slug."_".$post_type] !="0"){
            $_terms = $atts['__term_'.$tax_slug."_".$post_type];
            $args['tax_query'][] = [
                'taxonomy' => $tax_slug,
                'field' => 'id',
                'terms' => explode(',',$_terms),
                'include_children' => true,
                'operator' => 'IN'
            ];
        }
        if(isset($atts['__term_exclude_'.$tax_slug."_".$post_type]) and $atts['__term_exclude_'.$tax_slug."_".$post_type] and $atts['__term_exclude_'.$tax_slug."_".$post_type] !="0"){
            $_terms = $atts['__term_exclude_'.$tax_slug."_".$post_type];
            $args['tax_query'][] = [
                'taxonomy' => $tax_slug,
                'field' => 'id',
                'terms' => explode(',',$_terms),
                'include_children' => true,
                'operator' => 'NOT IN'
            ];
        }
    }
    // tax clone 
    if(isset($atts['__taxonomy_'.$post_type."_clone"])){
        $tax_slug = $atts['__taxonomy_'.$post_type."_clone"];
        if(isset($atts['__term_'.$tax_slug."_".$post_type."_clone"]) and $atts['__term_'.$tax_slug."_".$post_type."_clone"] and $atts['__term_'.$tax_slug."_".$post_type."_clone"] !="0"){
            $_terms = $atts['__term_'.$tax_slug."_".$post_type."_clone"];
            $args['tax_query'][] = [
                'taxonomy' => $tax_slug,
                'field' => 'id',
                'terms' => explode(',',$_terms),
                'include_children' => true,
                'operator' => 'IN'
            ];
        }
        if(isset($atts['__term_exclude_'.$tax_slug."_".$post_type."_clone"]) and $atts['__term_exclude_'.$tax_slug."_".$post_type."_clone"] and $atts['__term_exclude_'.$tax_slug."_".$post_type."_clone"] !="0"){
            $_terms = $atts['__term_exclude_'.$tax_slug."_".$post_type."_clone"];
            $args['tax_query'][] = [
                'taxonomy' => $tax_slug,
                'field' => 'id',
                'terms' => explode(',',$_terms),
                'include_children' => true,
                'operator' => 'NOT IN'
            ];
        }
    }

    // echo '<pre>'; print_r($args); echo '</pre>';
    // If custom ids
    if ( !empty( $ids ) ) {
        $ids = explode( ',', $ids );
        $ids = array_map( 'trim', $ids );

        $args = array(
            'post__in' => $ids,
            // 'post_type' => $post_type,
            'post_type' => 'any',
            'post_status' => $post_status,
            'numberposts' => -1,
            'orderby' => 'post__in',
            'posts_per_page' => 9999,
            'ignore_sticky_posts' => true,
        );
    }
    add_filter( 'posts_where', 'custom_blog_posts_title_filter', 10, 1 );
    $args = apply_filters('custom_blog_posts_args',$args);
    $the_query = new WP_Query( $args );
    remove_filter( 'posts_where', 'custom_blog_posts_title_filter', 10, 1 );

    // Get repeater HTML.
    echo "<!-- custom blog posts startxxxx  -->";


    // Get slide option for slide-vertical
    if($type == 'slide-vertical'){
        $rtl = 'false';
        if(is_rtl()) {
            $rtl = 'true';
        }

        $atts_tmp = wp_parse_args( $repeater, array(
            'slider_bullets' => 'false',
            'auto_slide' => 'false',
            'infinitive' => 'true',
            'group_cells' => $group_cells? $group_cells : 1
        ) );

        $data = '{"imagesLoaded": true, "groupCells": '.$atts_tmp['group_cells'].', "dragThreshold" : 5, "cellAlign": "left","infinite": '.$atts_tmp['infinitive'].',"prevNextButtons": true,"percentPosition": true,"pageDots": '.$atts_tmp['slider_bullets'].', "rightToLeft": '.$rtl.', "autoPlay" : '.$atts_tmp['auto_slide'].'}';
        ?>
        <mark class="hidden" data-slide-vertical='<?php echo $data; ?>'></mark>
        <?php
        $repeater['type'] = 'row';
        $repeater['class'].= ' row-slide-vertical align-equal';
    }

    ob_start();
    get_flatsome_repeater_start($repeater);
    do_action('fbc_flatsome_custom_blog_repeater_after_start',$repeater);
    $get_flatsome_repeater_start = ob_get_clean();



    if($group_cells){
        $get_flatsome_repeater_start = str_replace('"groupCells": "100%"','"groupCells": '.$group_cells.'',$get_flatsome_repeater_start);
    }
    echo $get_flatsome_repeater_start;







    if($the_query->have_posts()):
        while ( $the_query->have_posts() ) : $the_query->the_post();
            do_action('fbc_flatsome_custom_blog_before_item', $the_query, $repeater);
            if($post_type == 'product'){
                $back_image = true;
                if(flatsome_option( 'product_hover' ) == 'none'){
                    $back_image = false;
                }
                require FBC_DIR ."/templates/single-product.php";
            }else{
                require FBC_DIR ."/templates/single-default.php";
            }
            do_action('fbc_flatsome_custom_blog_after_item', $the_query, $repeater);
        endwhile;
    endif;
    wp_reset_query();

    // Get repeater end.
    do_action('fbc_flatsome_custom_blog_repeater_before_end',$repeater);
    get_flatsome_repeater_end($repeater);
    echo "<!-- custom blog posts endxxxxx  -->";

    ////////// start paging 
    $htmlshortcode_start  = "[custom_blog_posts";
    foreach ((array)$atts as $key => $value) {
        $htmlshortcode_start .= " ". $key ."='".$value."'";
    }
    // paged - copied from flatsome/ inc/ structure/ structure-posts.php
    $prev_arrow = is_rtl() ? get_flatsome_icon('icon-angle-right') : get_flatsome_icon('icon-angle-left');
    $next_arrow = is_rtl() ? get_flatsome_icon('icon-angle-left') : get_flatsome_icon('icon-angle-right');
    
    if($is_paged == 'true'){
        $total = $the_query->max_num_pages; 
        if( $total > 1 )  {
            $current_page = $the_query->query['paged'];
            $pages = paginate_links(array(
                'current'       => max( 1, $current_page ),
                'total'         => $total,
                'mid_size'      => 3,
                'type'          => 'array',
                'prev_text'     => $prev_arrow,
                'next_text'     => $next_arrow,
            ) );
            if( is_array( $pages) ) {            
                echo '<ul class="page-numbers nav-pagination links text-center custom-blog-posts-page-numbers">';
                foreach ( $pages as $key => $page ) {
                    $page = str_replace("page-numbers","page-number",$page);
                    $page = str_replace("<a", '<a data-shortcode-start="'.$htmlshortcode_start.'"',$page);
                    echo "<li>".do_shortcode($page)."</li>";
                }
               echo '</ul>';
            }
        }
    }

    // check ajax
    if(!wp_doing_ajax()):
    echo '</div>';
    endif;
    ?>


    <?php if(!wp_doing_ajax()): ?>
        <?php if($is_ajax == 'true'): ?>
            <script type="text/javascript">
                jQuery(document).ready(function($){
                    $("body").on("click","#<?php echo $_id; ?> .custom-blog-posts-page-numbers a",function(){
                        let shortcode_start = $(this).attr("data-shortcode-start");
                        //get page 
                        let current_page = parseInt($(this).closest(".custom-blog-posts-page-numbers").find(".current").html());
                        let page = $(this).html();

                        if($(this).hasClass("prev")){
                            page = current_page - 1;
                        }
                        if($(this).hasClass("next")){
                            page = current_page +1;
                        }

                        let final_shortcode = shortcode_start + " page='"+page+"'" + ']';
                        let atag = $(this);
                        let wrapper = atag.closest('.blog-posts-custom-element-wrapper');
                        $.ajax({
                            type : "post",
                            dataType : "json",
                            url : '<?php echo admin_url('admin-ajax.php'); ?>',
                            data : {
                                action: "ajax_custom_blog_posts",
                                shortcode: final_shortcode
                            },
                            context: this,
                            beforeSend: function(){
                                wrapper.addClass("op-8");
                                wrapper.append('<div class="loading-spin large centered"></div>');
                            },
                            success: function(response) {
                                jQuery.scrollTo(wrapper, {duration: 500, axis: "y", offset: -150 })
                                if(response.data){
                                    wrapper.empty();
                                    wrapper.removeClass("op-8");
                                    wrapper.prepend(response.data);
                                    wrapper.find(".loading-spin").remove();
                                    // wrapper.trigger({
                                    //     type: "ajax_custom_blog_posts_after",
                                    //     results: response.data
                                    // });
                                    jQuery( document.body ).trigger( 
                                        'ajax_custom_blog_posts_after', 
                                        [
                                            response,
                                            wrapper,
                                            final_shortcode
                                        ]
                                    );
                                }
                            },
                            error: function( jqXHR, textStatus, errorThrown ){
                                
                            }
                        });
                        return false;
                    });
                });
            </script>
        <?php endif;
    endif;

    $content = ob_get_contents();
    ob_end_clean();

    // Global 
    wp_enqueue_script('flatsome-blog-custom', FBC_PATH.'src/custom/flatsome-blog-custom.js', array('jquery'), FBC_JS_VER, false);

    if($type == 'slide-vertical'){
        wp_enqueue_style( 'slick', FBC_PATH."src/slick/slick.css", '', '', 'all' );
        wp_enqueue_style( 'slick-theme', FBC_PATH."src/slick/slick-theme.css", '', '', 'all' );
        wp_enqueue_script('slick-min', FBC_PATH.'src/slick/slick.min.js', array('flatsome-blog-custom'), '1.8.0', false);
        //https://holevietnam.vn/wp-content/themes/flatsome-child/js/js_all_slick_custom.js?ver=6.0.3
        wp_enqueue_style( 'slick-custom-css', FBC_PATH."src/custom/slick.css", '', FBC_JS_VER, 'all' );
        wp_enqueue_script('slick-custom-js', FBC_PATH.'src/custom/slick.js', array('flatsome-blog-custom'), FBC_JS_VER, false);
    }

    
    return $content;
});

function custom_blog_posts_title_filter( $where ){
    global $wpdb;
    if(isset($_GET['ztitle'])){
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $_GET['ztitle'] ) ) . '%\'';
    }
    return $where;
}