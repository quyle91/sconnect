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
                'taxonomy' => '_bo_mon'
            ]);

            if(!empty($terms) and is_array($terms)){
                ?>
                [tabgroup align="center" class="<?php echo sconnect_get_file_class(__FILE__); ?>"]
                    <?php
                    foreach ($terms as $key => $term) {
                        $name = trim(str_replace(__('Bộ môn','sconnect'), '', $term->name));
                        ?>
                        [tab title="<?php echo esc_attr($name); ?>"]
                            [custom_blog_posts 
                                style="normal" 
                                type="row" 
                                columns="3" 
                                columns__sm="1" 
                                columns__md="2" 
                                post_type="giang_vien" 
                                __taxonomy_giang_vien="_bo_mon" 
                                __term__bo_mon_giang_vien="<?php echo esc_attr($term->term_id); ?>" 
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



