<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class GiangVienContent {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-giangvien-content';
        $a->shortcode_title = 'Sconnect Giảng Viên Content';
        $a->shortcode_callback = function() use($a){
            ob_start();
            $content = get_field('content');
            if(!empty($content) and is_array($content)){
                ?>
                    [section]
                    <?php
                    foreach ($content as $key => $item) {
                        
                        ob_start();
                        ?>
                        [col span="6" span__sm="12"]
                            [row_inner h_align="center"]
                                [col_inner span="7" span__sm="12"]
                                <p>
                                    <?php echo do_shortcode( $item['content'] ) ?>
                                </p>
                                [/col_inner]

                            [/row_inner]
                        [/col]
                        <?php
                        $image = ob_get_clean();


                        
                        ob_start();
                        ?>
                        [col span="6" span__sm="12" force_first="small"]
                            [ux_image id="<?php echo do_shortcode($item['image']); ?>"]
                        [/col]
                        <?php
                        
                        $content = ob_get_clean();

                        // Méo nghĩ ra dc tên biến nào. :v
                        $____________________ = $image.$content;
                        if($key%2 == 1){
                            $____________________ = $content.$image;
                        }


                        ?>
                        [row width="full-width" v_align="middle"]
                            <?php echo wp_kses_post($____________________) ?>
                        [/row]
                        <?php
                    }
                    ?>
                    [/section]
                <?php
            }
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



