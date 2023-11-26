<?php 
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class BlogSmall {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-blog-small';
        $a->shortcode_title = 'Sconnect Blog Small';
        $a->shortcode_callback = function($atts) use($a){            
            if(!isset($atts['term_ids'])) return;
            extract($atts);
            ob_start();
            
            $term_ids = explode(',',$term_ids);
            $args = [
                'post_type' => 'post',
                'post_status' => ['publish'],
                'posts_per_page' => 5,
                'tax_query' => [
                    'relation' => 'AND',
                    [
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => $term_ids,
                        'include_children'=> false,
                        'operator' => 'IN'
                    ]
                ],
            ];
            $the_query = new \WP_Query( $args );
            if ( $the_query->have_posts() ) :
                echo '<ul class="'.sconnect_get_file_class(__FILE__).'">';
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                        // echo "<pre>"; print_r(get_the_title()); echo "</pre>";
                        ?>
                        <li class="bullet-arrow">
                            <a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
                        </li>
                        <?php
                    endwhile;
                echo '</ul>';
                echo '[button text="Xem thêm" letter_case="lowercase" style="link" icon="icon-angle-right"]';
                wp_reset_postdata();
            endif;
            
            

            return do_shortcode(ob_get_clean());
        };
        $a->options = [
            'term_ids' => array(
                'type'       => 'textfield',
                'heading'    => 'Terms ids',
                'description' => 'ID cách nhau bởi dấu phẩy',
                'default' => '',
            ),
        ];
        $a->general_element();

    }
}



