<?php 
add_action('ux_builder_setup', function (){
    // Register variables
    $repeater_columns = '4';
    $repeater_type = 'slider';
    $repeater_post_type = 'post';
    $repeater_col_spacing = 'normal';
    $repeater_post_cat = 'category';
    $default_text_align = 'center';


    // Default flatsome fields option
    $flatsome_dir = get_template_directory()."/inc/builder/shortcodes";
    $layout_options = require( $flatsome_dir . '/commons/repeater-options.php' );
    $layout_options_slider = require( $flatsome_dir . '/commons/repeater-slider.php' );
    $post_options = require( $flatsome_dir . '/commons/repeater-posts.php' );
    $box_layouts = require( $flatsome_dir . '/values/box-layouts.php' );
    $size_options = require( $flatsome_dir . '/values/sizes.php' );
    $box_styles = require( $flatsome_dir . '/commons/box-styles.php' );

    // Fix 
    $post_options['options']['posts']['default'] = 12;


    // Add new custom field options
    $layout_options['options']['type']['options']['slide-vertical'] = 'Slide Vertical';
    $layout_options_slider['conditions'] .= ' || type === "slide-vertical"';

    // Add new group cell
    $layout_options_slider['options']['group_cells']= [
        'type' => 'slider',
        'heading' => 'Group Cells',
        'description'=> 'Mỗi lần next slide bao nhiêu item',
        //'conditions' => '',
        'default' => 0,
        'max' => 8,
        'min' => 0,
    ];
    $layout_options_slider['options']['slider_hide_nav']= [
        'type' => 'radio-buttons',
        'heading' => __('Always Visible'),
        'default' => '',
        'options' => array(
            ''  => array( 'title' => 'Off'),
            'true'  => array( 'title' => 'On'),
        ),
    ];
    $layout_options_slider['options']['auto_slide']['options'][1000] = '1 sec.';



    // add new post type select
    // add taxonomy for custom post type
    $post_types = loc_post_type(get_post_types());
    $_post_type = [
        'post_type' => array(
            'type' => 'select',
            'heading' => __( 'Post type' ),
            'default' => 'post'
        )
    ];



    $_taxonomies = [];
    $_taxonomies_clone = [];
    $_terms = [];
    $_terms_clone = [];



    foreach ($post_types as $key => $post_type_slug) {
        $_post_type['post_type']['options'][$post_type_slug] = get_post_type_object( $post_type_slug )->label;
        $taxonomies = get_object_taxonomies( ['post_type' => $post_type_slug],'objects' );

        if(!empty(($taxonomies))){

            $_taxonomies['__taxonomy_'.$post_type_slug] = [
                'type' => 'select',
                'heading' => 'Taxonomies '.get_post_type_object( $post_type_slug )->label,
                'default' => 'post',
                'conditions' => 'post_type === "'.$post_type_slug.'"',
                'options' => [
                    '' => 'No select'
                ]
            ];

            //clone
            $_taxonomies_clone['__taxonomy_'.$post_type_slug."_clone"] = [
                'type' => 'select',
                'heading' => " [clone] ".'Taxonomies '.get_post_type_object( $post_type_slug )->label,
                'default' => 'post',
                'conditions' => 'post_type === "'.$post_type_slug.'"',
                'options' => [
                    '' => 'No select'
                ]
            ];


            foreach ($taxonomies as $tax_slug => $tax_obj) {
                $_taxonomies['__taxonomy_'.$post_type_slug]['options'][$tax_slug] = $tax_obj->label;
                $_taxonomies_clone['__taxonomy_'.$post_type_slug."_clone"]['options'][$tax_slug] = $tax_obj->label; // clone

                $terms = get_terms( ['taxonomy'=>$tax_slug,'hide_empty'=>false], [] );
                if(!empty($terms) and is_array($terms)){

                    $term_in = [
                        'type' => 'select',
                        'heading' => 'Term '.$tax_obj->label,
                        'default' => 'post',
                        'conditions' => 'post_type === "'.$post_type_slug.'" && __taxonomy_'.$post_type_slug.' === "'.$tax_slug.'"',
                        'options'=> [
                            '' => 'No select'
                        ]
                    ];

                    $term_in_clone = [
                        'type' => 'select',
                        'heading' => '[clone] '.'Term '.$tax_obj->label,
                        'default' => 'post',
                        'conditions' => 'post_type === "'.$post_type_slug.'" && __taxonomy_'.$post_type_slug."_clone".' === "'.$tax_slug.'"',
                        'options'=> [
                            '' => 'No select'
                        ]
                    ];
                    
                    $term_not_in = [
                        'type' => 'select',
                        'heading' => 'Term NOT '.$tax_obj->label,
                        'default' => 'post',
                        'conditions' => 'post_type === "'.$post_type_slug.'" && __taxonomy_'.$post_type_slug.' === "'.$tax_slug.'"',
                        'options'=> [
                            '' => 'No select'
                        ]
                    ];

                    $term_not_in_clone = [
                        'type' => 'select',
                        'heading' => '[clone] '.'Term NOT '.$tax_obj->label,
                        'default' => 'post',
                        'conditions' => 'post_type === "'.$post_type_slug.'" && __taxonomy_'.$post_type_slug."_clone".' === "'.$tax_slug.'"',
                        'options'=> [
                            '' => 'No select'
                        ]
                    ];

                    
                    $_terms['__term_'.$tax_slug."_".$post_type_slug] = $term_in;
                    $_terms['__term_exclude_'.$tax_slug."_".$post_type_slug] = $term_not_in;

                    // clone
                    $_terms['__term_'.$tax_slug."_".$post_type_slug."_clone"] = $term_in_clone;
                    $_terms['__term_exclude_'.$tax_slug."_".$post_type_slug."_clone"] = $term_not_in_clone;

                    foreach ($terms as $index => $term) {
                        $_terms['__term_'.$tax_slug."_".$post_type_slug]['options'][$term->term_id] = $term->name;  
                        $_terms['__term_exclude_'.$tax_slug."_".$post_type_slug]['options'][$term->term_id] = $term->name; 

                        // clone
                        $_terms['__term_'.$tax_slug."_".$post_type_slug."_clone"]['options'][$term->term_id] = $term->name;  
                        $_terms['__term_exclude_'.$tax_slug."_".$post_type_slug."_clone"]['options'][$term->term_id] = $term->name; 
                    }
                }
            }
        }
    }

    /*echo '<pre>'; print_r($_taxonomies); echo '</pre>';
    echo '<pre>'; print_r($_taxonomies_clone); echo '</pre>';
    echo '<pre>'; print_r($_terms); echo '</pre>';
    die;*/



    // thêm full post type vào ids
    $post_options['options']['ids']['config']['postSelect']['post_type'] = array_merge(
        array_keys($post_types),
        $post_options['options']['ids']['config']['postSelect']['post_type']
    );

   

    $post_options['options'] = array_merge(
        $_post_type,
        $_taxonomies,
        $_taxonomies_clone,
        $_terms,
        $_terms_clone,
        $post_options['options']
    );
    // echo '<pre>'; print_r($_taxonomies); echo '</pre>';die;
    // echo '<pre>'; print_r($post_options['options']); echo '</pre>';
    
    


    $options =  array(
        'style_options' => array(
            'type' => 'group',
            'heading' => __( 'Style' ),
            'options' => array(
                'style' => array(
                    'type' => 'select',
                    'heading' => __( 'Style' ),
                    'default' => '',
                    'options' => $box_layouts
                ),
                'is_paged' => array(
                    'type' => 'radio-buttons',
                    'heading' => __('Show paged'),
                    'default' => 'true',
                    'options' => array(
                        'false'  => array( 'title' => 'Off'),
                        'true'  => array( 'title' => 'On'),
                    ),
                ), 
                'is_ajax' => array(
                    'type' => 'radio-buttons',
                    'heading' => __('Load'),
                    'conditions' => 'is_paged === "true"',
                    'description' => 'Mỗi page sẽ load số item = total post',
                    'default' => 'true',
                    'options' => array(
                        'false'  => array( 'title' => 'Paged'),
                        'true'  => array( 'title' => 'Ajax'),
                    ),
                ), 
            ),
        ),
        'layout_options' => $layout_options,
        'layout_options_slider' => $layout_options_slider,
        'post_options' => $post_options,
        'post_title_options' => array(
            'type' => 'group',
            'heading' => __( 'Title' ),
                'options' => array(
                    'title_size' => array(
                        'type' => 'select',
                        'heading' => 'Title Size',
                        'default' => '',
                        'options' => $size_options
                    ),
                    'title_style' => array(
                        'type' => 'radio-buttons',
                        'heading' => 'Title Style',
                        'default' => '',
                        'options' => array(
                            ''   => array( 'title' => 'Abc'),
                            'uppercase' => array( 'title' => 'ABC'),
                        )
                ),
            )
        ),
        'read_more_button' => array(
            'type' => 'group',
            'heading' => __( 'Read More' ),
                'options' => array(
                    'readmore' => array(
                        'type' => 'textfield',
                        'heading' => 'Text',
                        'default' => '',
                    ),
                    'readmore_color' => array(
                    'type' => 'select',
                    'heading' => 'Color',
                    'conditions' => 'readmore',
                    'default' => '',
                    'options' => array(
                        '' => 'Default',
                        'primary' => 'Primary',
                        'secondary' => 'Secondary',
                        'alert' => 'Alert',
                        'success' => 'Success',
                        'white' => 'White',
                    )
                ),
                'readmore_style' => array(
                    'type' => 'select',
                    'heading' => 'Style',
                    'conditions' => 'readmore',
                    'default' => 'outline',
                    'options' => array(
                        'z' => 'Default',
                        'outline' => 'Outline',
                        'link' => 'Simple',
                        'underline' => 'Underline',
                        'shade' => 'Shade',
                        'bevel' => 'Bevel',
                        'gloss' => 'Gloss',
                    )
                ),
                'readmore_size' => array(
                    'type' => 'select',
                    'conditions' => 'readmore',
                    'heading' => 'Size',
                    'default' => '',
                    'options' => $size_options,
                ),
            )
        ),


        'post_meta_options' => array(
            'type' => 'group',
            'heading' => __( 'Meta' ),
            'options' => array(
                'show_title' => array(
                    'type' => 'select',
                    'heading' => 'Title',
                    'default' => 'true',
                    'options' => array(
                        'true' => 'Show',
                        'false' => 'Hidden',
                    )
                ),
                'show_divider' => array(
                    'type' => 'select',
                    'heading' => 'Divider',
                    'default' => 'true',
                    'options' => array(
                        'true' => 'Show',
                        'false' => 'Hidden',
                    )
                ),
                'show_date' => array(
                    'type' => 'select',
                    'heading' => 'Date',
                    'default' => 'badge',
                    'options' => array(
                        'badge' => 'Badge',
                        'text' => 'Text',
                        'false' => 'Hidden',
                    )
                ),
                'badge_style' => array(
                    'type' => 'select',
                    'heading' => 'Badge Style',
                    'default' => '',
                    'conditions' => 'show_date == "badge"',
                    'options' => array(
                        '' => 'Default',
                        'outline' => 'Outline',
                        'square' => 'Square',
                        'circle' => 'Circle',
                        'circle-inside' => 'Circle Inside',
                    )
                ),
                'excerpt' => array(
                    'type' => 'select',
                    'heading' => 'Excerpt',
                    'default' => 'visible',
                    'options' => array(
                        'visible' => 'Visible',
                        'fade' => 'Fade In On Hover',
                        'slide' => 'Slide In On Hover',
                        'reveal' => 'Reveal On Hover',
                        'false' => 'Hidden',
                    )
                ),
               'excerpt_length' => array(
                    'type' => 'slider',
                    'heading' => 'Excerpt Length',
                    'default' => 15,
                    'max' => 150,
                    'min' => 5,
                ),
                'show_category' => array(
                    'type' => 'select',
                    'heading' => 'Category',
                    'default' => 'false',
                    'options' => array(
                        'label' => 'Label',
                        'text' => 'Text',
                        'false' => 'Hidden',
                    )
                ),
                'comments' => array(
                    'type' => 'select',
                    'heading' => 'Comments',
                    'default' => 'visible',
                    'options' => array(
                        'visible' => 'Visible',
                        'false' => 'Hidden',
                    )
                ),
            ),
        ),
    );


    
    $options = array_merge($options, $box_styles);
    //echo "<pre>";print_r($options);echo "</pre>";die;


    // Fĩx cat error in buildẻ
    if(isset($options['post_options']['options']['cat']['default'])){
        unset($options['post_options']['options']['cat']['default']);
    }

    add_ux_builder_shortcode('custom_blog_posts', array(
        'name'      => "Flatsome Custom Blog",
        'thumbnail' =>  get_template_directory_uri() . '/inc/builder/shortcodes/thumbnails/' . 'blog_posts' . '.svg',
        'scripts' => array(
            'flatsome-masonry-js' => get_template_directory_uri() .'/assets/libs/packery.pkgd.min.js',
            'flatsome-blog-custom' => FBC_PATH.'src/custom/flatsome-blog-custom.js',
            'slick-min'=> FBC_PATH.'src/slick/slick.min.js',
            'slick-custom-js' => FBC_PATH.'src/custom/slick.js'
        ),
        'styles' => array(
            'slick'=> FBC_PATH."src/slick/slick.css",
            'slick-theme'=> FBC_PATH."src/slick/slick-theme.css",
            'slick-custom-css'=> FBC_PATH."src/custom/slick.css",
        ),
        'presets' => array(
            array(
                'name' => __( 'Normal' ),
                'content' => '[custom_blog_posts style="normal" columns="3" columns__md="1" image_height="56.25%"]'
            ),
            array(
                'name' => __( 'Bounce' ),
                'content' => '[custom_blog_posts style="bounce" badge_style="square" image_height="75%"]'
            ),
            array(
                'name' => __( 'Push' ),
                'content' => '[custom_blog_posts style="push" columns="3" columns__md="1" badge_style="circle-inside" image_height="75%"]'
            ),
            array(
                'name' => __( 'Vertical' ),
                'content' => '[custom_blog_posts style="vertical" slider_nav_style="simple" slider_nav_position="outside" columns="2" columns__md="1" depth="2" image_height="89%" image_width="43"]'
            ),
            array(
                'name' => __( 'Overlay' ),
                'content' => '[custom_blog_posts style="overlay" depth="1" title_style="uppercase" show_date="text" image_height="144%" image_overlay="rgba(0, 0, 0, 0.17)" image_hover="zoom"]'
            ),
            array(
                'name' => __( 'Overlay - Grayscale' ),
                'content' => '[custom_blog_posts style="overlay" depth="1" animate="fadeInLeft" title_style="uppercase" show_date="text" image_height="144%" image_overlay="rgba(0, 0, 0, 0.56)" image_hover="color" image_hover_alt="overlay-remove-50"]'
           ),
            array(
                'name' => __( 'Masonery' ),
                'content' => '[custom_blog_posts type="masonry" columns="3" depth="2" image_height="180px"]'
           ),
           array(
                'name' => __( 'Grid' ),
                'content' => '[custom_blog_posts style="shade" type="grid" columns="3" depth="1" posts="4" title_size="larger" title_style="uppercase" readmore="Read More" badge_style="circle-inside" image_height="180px"]'
           ),
           array(
                'name' => __( 'Full Slider' ),
                'content' => '[custom_blog_posts style="shade" type="slider-full" grid="2" slider_nav_style="circle" columns="1" title_size="larger" show_date="text" excerpt="false" show_category="label" comments="false" image_size="large" image_overlay="rgba(0, 0, 0, 0.09)" image_hover="overlay-remove" text_size="large" text_hover="bounce" text_padding="10% 0px 10% 0px"]'
            ),
        ),
        'info'      => '{{ id }}',
        'options' => $options
    ));
},40);


function la_post_type_can_thiet($post_type){
    $return = true;
    switch ($post_type) {
        case 'attachment': $return = false ; break;
        case 'revision': $return = false ; break;
        case 'nav_menu_item': $return = false ; break;
        case 'custom_css': $return = false ; break;
        case 'customize_changeset': $return = false ; break;
        case 'oembed_cache': $return = false ; break;
        case 'user_request': $return = false ; break;
        case 'wp_block': $return = false ; break;
        case 'wp_template': $return = false ; break;
        case 'wp_template_part': $return = false ; break;
        case 'wp_global_styles': $return = false ; break;
        case 'wp_navigation': $return = false ; break;
        case 'blocks': $return = false ; break;
        case 'acf-field-group': $return = false ; break;
        case 'acf-field': $return = false ; break;
        case 'wpcf7_contact_form': $return = false ; break;
        case 'ux_template': $return = false ; break;
    }
    return $return;
}

function loc_post_type($post_type){
    $return = [];
    foreach ($post_type as $key => $value) {
        if(la_post_type_can_thiet($key)){
            $return[$key] = $value; 
        }
        
    }
    return $return;
}