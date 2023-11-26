<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class ChuongTrinhDaoTaoItem {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-chuongtrinh-daotao-item';
        $a->shortcode_title = 'Sconnect Chương Trình Đào Tạo Item';
        $a->shortcode_callback = function() use($a){
            global $Sconnect_ChuongTrinh;
            $sync = $Sconnect_ChuongTrinh->sync;
            $term = $sync->get_term_sync(get_the_ID());
            if(is_wp_error( $term )) return;
            if(!isset($term->term_id)) return;

            ob_start();
            echo '<div class="'.sconnect_get_file_class(__FILE__).'">';

            $args = [
                'post_type' => ['khoa', 'bo_mon', 'lop'],
                'post_status' => ['publish'],
                'posts_per_page' => -1,
                'tax_query' => [
                    'relation' => 'AND',
                    [
                        'taxonomy' => $sync->taxname,
                        'field' => 'id',
                        'terms' => [$term->term_id],
                        'include_children'=> false,
                        'operator' => 'IN'
                    ]
                ],
            ];

            $the_query = new \WP_Query( $args );
            if ( $the_query->have_posts() ) :
                ?>
                    [row 
                        col_bg="var(--primary-color)" 
                        padding="20px 20px 20px 20px" 
                        class="<?php echo sconnect_get_file_class(__FILE__); ?>"
                    ]
                    <?php
                        while ( $the_query->have_posts() ) : $the_query->the_post();                    
                            echo get_template_part( 
                                'template-parts/single-chuongtrinhdaotao-item', 
                                get_post_type(), 
                                [
                                    'the_query'=>$the_query
                                ]
                            );                    
                        endwhile;
                        ?>
                    [/row]
                <?php 
                wp_reset_postdata();
            endif;
            echo '</div>';
            return do_shortcode(ob_get_clean());
        };
        $a->options = [
            // 'style' => array(
            //     'type'       => 'select',
            //     'heading'    => 'Text ',
            //     'default' => '1',
            //     'options' => [
            //         '1' => 'Style 1',
            //         '2' => 'Style 2',
            //         '3' => 'Style 3'
            //     ]
            // ),
        ];
        $a->general_element();

    }
}



