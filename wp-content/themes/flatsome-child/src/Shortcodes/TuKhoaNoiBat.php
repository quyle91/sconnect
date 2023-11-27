<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class TuKhoaNoiBat {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-tukhoa-noibat';
        $a->shortcode_title = 'Sconnect Từ khoá nổi bật';
        $a->shortcode_callback = function() use($a){
            ob_start();
            ?>
            <div class="tukhoanoibat">
                <div class="row align-middle">
                    <div class="col small-12 large-3">
                        <h3 class="mb-0 uppercase">
                            <?php echo __("Từ khoá nổi bật",'sconnect') ?>
                        </h3>
                    </div>
                    <div class="col small-12 large-9">
                        <div class="tagcloud">
                            <?php
                                $terms = get_terms( 
                                    [
                                        'taxonomy' => 'post_tag',
                                        'hide_empty' => 'true',
                                        'orderby' => 'count',
                                        'hide_empty' =>true,
                                    ]
                                );
                                if(!empty($terms) and is_array($terms)){
                                    echo '
                                    [adminz_slider_custom 
                                        slide_item_padding="5px"  
                                        bullets="false" 
                                        freescroll="true" 
                                        nav_pos="outside" 
                                        hide_nav="true"  
                                        nav_color="dark" 
                                        nav_style="simple"
                                    ]';
                                    foreach ($terms as $key => $term) {
                                        ?>
                                            [adminz_slider_custom_item_wrap]
                                                <a 
                                                    style="white-space: nowrap;"
                                                    class="tag" href="<?php echo get_term_link( $term );?>">
                                                    <?php echo esc_attr($term->name); ?>
                                                </a>
                                            [/adminz_slider_custom_item_wrap]
                                        <?php
                                    }
                                    echo '[/adminz_slider_custom]';
                                }
                            ?>
                        </div>
                    </div>
                </div>               
            </div>            
            <?php
            return do_shortcode(ob_get_clean());
        };
        $a->options = [
            'text' => array(
                'type'       => 'textfield',
                'heading'    => 'Text ',
                'default' => 'Text',
            ),
        ];
        $a->general_element();

        add_action('wp_footer', function(){
            ?>
            <style type="text/css">
                .tukhoanoibat{
                    
                }
                .tukhoanoibat .tagcloud{
                    padding: 0 5px;
                }
                @media (min-width: 850px){
                    .tukhoanoibat .tagcloud{
                        padding: 0 40px;
                    }
                }
            </style>
            <?php
        });

    }
}



