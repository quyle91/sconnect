<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
/**
 * Lấy top 3 giảng viên dựa theo trang hiện tại
 */
namespace Sconnect\Shortcodes;
class GiangVien {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-giangvien';
        $a->shortcode_title = 'Sconnect Giảng Viên';
        $a->shortcode_callback = function() use($a){
            ob_start();
            
            switch (get_post_type()) {
                case 'khoa':
                    global $Sconnect_Khoa;
                    $sync = $Sconnect_Khoa->sync;
                    $term = $sync->get_term_sync(get_the_ID());
                    break;
                case 'lop':
                    global $Sconnect_Lop;
                    $sync = $Sconnect_Lop->sync;
                    $term = $sync->get_term_sync(get_the_ID());
                    break;
                case 'bo_mon':
                    global $Sconnect_BoMon;
                    $sync = $Sconnect_BoMon->sync;
                    $term = $sync->get_term_sync(get_the_ID());
                    break;
            }

            if(isset($term)){
                ob_start();
                ?>
                __taxonomy_giang_vien="<?php echo esc_attr($term->taxonomy);?>" 
                __term_<?php echo esc_attr($term->taxonomy);?>_giang_vien="<?php echo esc_attr($term->term_id);?>" 
                <?php
                $condition = ob_get_clean();
            }else{
                $condition = '';
            }

            ?>

            
            [row]
                [col span__sm="12"]                  
                    
                    [custom_blog_posts 
                        style="vertical" 
                        is_paged="false" 
                        columns="1" 
                        columns__md="1" 
                        slider_nav_style="simple" 
                        slider_bullets="true" 
                        post_type="giang_vien" 
                        <?php echo esc_attr($condition); ?>
                        posts="3" 
                        show_divider="false" 
                        image_height="56.25%" 
                        image_width="33" 
                        text_align="left" 
                        text_bg="rgb(0, 132, 68)" 
                        text_color="dark" 
                        class="sconnect-box-giangvien"
                    ]

                [/col]
            [/row]
            
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

    }
}



