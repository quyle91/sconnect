<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class HoTroSauKhoaHoc {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-hotrosaukhoahoc';
        $a->shortcode_title = 'Sconnect Hỗ Trợ Sau Khoá học';
        $a->shortcode_callback = function() use($a){
            ob_start();
            ?>
            <div class="<?php echo sconnect_get_file_class(__FILE__); ?>">
                [title style="center" text="HỖ TRỢ SAU KHÓA HỌC" tag_name="h4"]
                [row_inner_1 col_bg="rgba(0, 0, 0, 0.122)" padding="20px 20px 20px 20px"]
                    <?php
                        $hotrosautotnghiep = get_field('hotrosautotnghiep');
                        if(empty($hotrosautotnghiep)){
                            $hotrosautotnghiep = [
                                [
                                    'icon' => 7,
                                    'ztitle' => "Sed ut perspiciatis unde omnis iste natus",
                                    'zcontent' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.'
                                ],
                                [
                                    'icon' => 7,
                                    'ztitle' => "Sed ut perspiciatis unde omnis iste natus",
                                    'zcontent' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.'
                                ],
                                [
                                    'icon' => 7,
                                    'ztitle' => "Sed ut perspiciatis unde omnis iste natus",
                                    'zcontent' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.'
                                ]
                            ];
                        }
                        if(!empty($hotrosautotnghiep) and is_array($hotrosautotnghiep)){
                            foreach ($hotrosautotnghiep as $key => $value) {
                                ?>
                                [col_inner_1 span="4" span__sm="12" span__md="4" align="center"]

                                    [ux_image id="<?php echo esc_attr($value['icon']) ?>" width="27" margin="-30px 0px 0px 0px"]

                                    <p class="lead"><?php echo esc_attr($value['ztitle']) ?></p>
                                    <p><?php echo esc_attr($value['zcontent']) ?></p>

                                [/col_inner_1]
                                <?php
                            }
                        }
                    ?>

                [/row_inner_1]
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

    }
}



