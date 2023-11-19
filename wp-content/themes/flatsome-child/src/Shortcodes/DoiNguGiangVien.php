<?php 
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class DoiNguGiangVien {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-doi-ngu-giang-vien';
        $a->shortcode_title = 'Sconnect Đội ngũ giảng viên';
        $a->shortcode_callback = function() use($a){
            ob_start();

            $terms = get_terms([
                'taxonomy' => 'bo-mon'
            ]);

            if(!empty($terms) and is_array($terms)){
                ?>
                [tabgroup align="center"]
                    <?php
                    foreach ($terms as $key => $term) {
                        ?>
                        [tab title="<?php echo esc_attr($term->name); ?>"]

                        [custom_blog_posts 
                            style="normal" 
                            type="row" 
                            columns="3" 
                            columns__sm="2" 
                            columns__md="1" 
                            post_type="giang_vien" 
                            __taxonomy_giang_vien="bo-mon" 
                            __term_bo-mon_giang_vien="<?php echo esc_attr($term->term_id); ?>" 
                            posts="9" 
                            image_height="56.25%"
                        ]
                        [/tab]
                        <?php
                    }
                ?>
                [/tabgroup]
                <?php
            }
            return do_shortcode(ob_get_clean());
        };
        
        // $a->options = [
        //     'term_ids' => array(
        //         'type'       => 'textfield',
        //         'heading'    => 'Terms ids',
        //         'description' => 'ID cách nhau bởi dấu phẩy',
        //         'default' => '',
        //     ),
        // ];
        $a->general_element();

    }
}



