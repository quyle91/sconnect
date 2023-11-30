<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class ChuongTrinhDaoTaoKhoa {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-chuong-trinh-dao-tao-khoa';
        $a->shortcode_title = 'Sconnect Chương Trình đào tạo Khoa';
        $a->shortcode_callback = function() use($a){
            ob_start();
            ?>
                [section 
                    class="<?php echo sconnect_get_file_class(__FILE__); ?> section-BGR-CUSTOM-XX " 
                    bg_color="var(--primary-color)" 
                    dark="true"]

                    [title style="center" text="<?php echo __('Chương trình đào tạo','sconnect'); ?>" tag_name="h2"]

                    [row]

                        [col span__sm="12" align="left"]                          
                            [tabgroup type="vertical" class="chuongtrinhdaotaokhoatab"]
                                <?php
                                    $chuongtrinhdaotaokhoa = get_field('chuongtrinhdaotaokhoa');
                                    if(empty($chuongtrinhdaotaokhoa)){
                                        $chuongtrinhdaotaokhoa = [
                                            [
                                                'icon' => Sconnect_Default_image,
                                                'ztitle' => 'GIỚI THIỆU TỔNG QUAN',
                                                'block' => ''
                                            ],
                                            [
                                                'icon' => Sconnect_Default_image,
                                                'ztitle' => 'GIỚI THIỆU TỔNG QUAN',
                                                'block' => ''
                                            ],
                                            [
                                                'icon' => Sconnect_Default_image,
                                                'ztitle' => 'GIỚI THIỆU TỔNG QUAN',
                                                'block' => ''
                                            ],
                                            [
                                                'icon' => Sconnect_Default_image,
                                                'ztitle' => 'GIỚI THIỆU TỔNG QUAN',
                                                'block' => ''
                                            ],
                                            [
                                                'icon' => Sconnect_Default_image,
                                                'ztitle' => 'GIỚI THIỆU TỔNG QUAN',
                                                'block' => ''
                                            ]
                                        ];
                                    }
                                    if(!empty($chuongtrinhdaotaokhoa) and is_array($chuongtrinhdaotaokhoa)){
                                        foreach ($chuongtrinhdaotaokhoa as $key => $item) {
                                            ?>
                                            [tab title="<?php echo esc_attr($item['ztitle']) ?>"]
                                                [block id="<?php echo esc_attr($item['block']) ?>"]
                                            [/tab]
                                            <?php 
                                        }
                                    }                                    
                                ?>
                            [/tabgroup]
                            <?php
                                $icons = [];
                                if(!empty($chuongtrinhdaotaokhoa) and is_array($chuongtrinhdaotaokhoa)){
                                    foreach ($chuongtrinhdaotaokhoa as $key => $item) {
                                        $icons [] = $item['icon'];
                                    }
                                }  
                            ?>
                            [adminz_tab_icons tab_class="chuongtrinhdaotaokhoatab" ids="<?php echo implode(',',$icons); ?>"]

                        [/col]
                        [col span__sm="12" align="center"]

                            [button color="success" text="<?php echo __("Đăng ký tuyển sinh ngay",'sconnect'); ?>" link="#dangkytuyensinh"]

                        [/col]

                    [/row]

                    [row]

                        [col span__sm="12"]

                            [title style="center" text="<?php echo __('Hỗ trợ sau tốt nghiệp','sconnect'); ?>" tag_name="h2"]

                            [row_inner v_align="middle" h_align="center"]
                                <?php
                                    $hotrosautotnghiep = get_field('hotrosautotnghiep');
                                    if(empty($hotrosautotnghiep)){
                                        $hotrosautotnghiep = [
                                            [
                                                'thumbnail' => Sconnect_Default_image,
                                                'icon' => Sconnect_Default_image,
                                                'ztitle' => '100% CÓ CƠ HỘI THỰC TẬP NGAY SAU TỐT NGHIỆP'
                                            ],
                                            [
                                                'thumbnail' => Sconnect_Default_image,
                                                'icon' => Sconnect_Default_image,
                                                'ztitle' => '100% CÓ CƠ HỘI THỰC TẬP NGAY SAU TỐT NGHIỆP'
                                            ],
                                            [
                                                'thumbnail' => Sconnect_Default_image,
                                                'icon' => Sconnect_Default_image,
                                                'ztitle' => '100% CÓ CƠ HỘI THỰC TẬP NGAY SAU TỐT NGHIỆP'
                                            ]
                                        ];
                                    }
                                    if(!empty($hotrosautotnghiep) and is_array($hotrosautotnghiep)){
                                        foreach ($hotrosautotnghiep as $key => $item) {
                                            ?>
                                            [col_inner span="4" span__sm="6"]

                                                [ux_image id="<?php echo esc_attr( $item['thumbnail'] ) ?>" height="55%" class="mb-0"]

                                                [row_inner_1 style="collapse" col_bg="var(--primary-color)"]

                                                    [col_inner_1 span__sm="12" align="center"]

                                                        [row_inner_2 style="collapse"]

                                                            [col_inner_2 span__sm="12" margin="-30px 0px 0px 0px" align="center"]

                                                                [ux_image id="<?php echo esc_attr($item['icon']) ?>" width="16"]

                                                            [/col_inner_2]

                                                        [/row_inner_2]
                                                        [gap]
                                                        <p class="mb-0"><?php echo esc_attr($item['ztitle']) ?></p>
                                                        [gap]

                                                    [/col_inner_1]

                                                [/row_inner_1]

                                            [/col_inner]
                                            <?php
                                        }
                                    }
                                ?>

                            [/row_inner]

                        [/col]

                    [/row]

                [/section]
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



