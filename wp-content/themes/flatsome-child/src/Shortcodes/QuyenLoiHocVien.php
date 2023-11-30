<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class QuyenLoiHocVien {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-quyenloi-hocvien';
        $a->shortcode_title = 'Sconnect Quyền Lợi Học Viên Row';
        $a->shortcode_callback = function() use($a){
            ob_start();
            ?>
            [row class="<?php echo sconnect_get_file_class(__FILE__); ?>]

                [col span__sm="12"]

                    [title style="center" text="<?php echo __('Quyền lợi học viên','sconnect'); ?>" tag_name="h2"]

                    [row_inner v_align="middle" h_align="center"]
                        <?php
                            $quyenloihocvien = get_field('quyenloihocvien');
                            if(empty($quyenloihocvien)){
                                $quyenloihocvien = [
                                    [
                                        'thumbnail' => Sconnect_Default_image,
                                        'icon' => Sconnect_Default_image,
                                        'ztitle' => 'Sự kiện Gặp gỡ chuyên gia hàng tháng'
                                    ],
                                    [
                                        'thumbnail' => Sconnect_Default_image,
                                        'icon' => Sconnect_Default_image,
                                        'ztitle' => 'Chương trình Coaching 1 - 1 tcùng Giảng viên'
                                    ],
                                    [
                                        'thumbnail' => Sconnect_Default_image,
                                        'icon' => Sconnect_Default_image,
                                        'ztitle' => 'Trao học bổng cho học viên tài năng'
                                    ]
                                ];
                            }
                            if(!empty($quyenloihocvien) and is_array($quyenloihocvien)){
                                foreach ($quyenloihocvien as $key => $item) {
                                    ?>
                                    [col_inner span="4" span__sm="6" color="light"]

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



