<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class HoiDongHocThuat {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-hoidonghocthuat';
        $a->shortcode_title = 'Sconnect Hội đồng học thuật';
        $a->shortcode_callback = function() use($a){
            // post type = giang_vien
            // taxonomy = vi_tri_giang_vien
            // Element: tab, row, col
            // $args = [
            //     'post_type' => 'giang_vien',
            //     'post_status' => ['publish'],
            //     'posts_per_page' => -1,
            // ];
            // $the_query = new \WP_Query( $args );
            // if ( $the_query->have_posts() ) :
            //     while ( $the_query->have_posts() ) : $the_query->the_post();
            //         echo "<pre>"; print_r(get_the_title()); echo "</pre>";
            //     endwhile;
            // endif;
            // wp_reset_postdata();


            ob_start();
            ?>
            <div class="hoidonghocthuat">
                <?php
                    echo "<pre class=sconnectpre>"; 
                    echo '<h4>Element name: '.$a->shortcode_name ."</h4>"; 
                    print_r(__FILE__); 
                    echo "</pre>";
                ?>
            </div>
            <style type="text/css">
                .hoidonghocthuat{

                }
            </style>
            <?php
            return ob_get_clean();
        };
        $a->options = [
            'text' => array(
                'type'       => 'textfield',
                'heading'    => 'Text ',
                'default' => 'Text',
            ),
        ];
        $a->general_element();

    }
}



