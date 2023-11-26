<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class ChuongTrinhDaoTaoChiTiet {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-chuongtrinh-daotao-chi-tiet';
        $a->shortcode_title = 'Sconnect Chương Trình Đào Tạo Chi Tiết';
        $a->shortcode_callback = function() use($a){
            ob_start();
            echo '<div 
                class="'.sconnect_get_file_class(__FILE__).'" 
                style="
                    background-image: url('.get_stylesheet_directory_uri().'/assets/images/Rectangle188.png);
                    background-color: var(--secondary-color);
                ">';

            ?>
                [row padding="15px 15px 15px 15px" class="top"]
                    [col span__sm="12" color="light"]
                        <?php
                            $chitietchuongtrinh = get_field('chitietchuongtrinh');
                            if(!empty($chitietchuongtrinh) and is_array($chitietchuongtrinh)){
                                foreach ($chitietchuongtrinh as $key => $item) {
                                    ?>
                                    [row_inner class="zitem key_<?php echo esc_attr($key); ?>"]
                                        [col_inner span__sm="12"]

                                            [title 
                                                text="<?php echo esc_attr($item['ztitle']); ?>" 
                                                class="ztitle <?php echo str_replace("-","",sanitize_title( $item['ztitle'] )) ?>"
                                                ]
                                            <?php
                                                if($item['icon']){
                                                    $icon = wp_get_attachment_image_src($item['icon'],'thumbnail');
                                                    ?>
                                                    <style type="text/css">
                                                        .ChuongTrinhDaoTaoChiTiet .top .key_<?php echo esc_attr($key);?> .ztitle .section-title-main::before{
                                                            background-image: url(<?php echo esc_url($icon[0]); ?>);
                                                        }
                                                    </style>
                                                    <?php
                                                }
                                            ?>
                                            
                                            [row_inner_1 v_align="middle"]

                                                [col_inner_1 span="3" span__sm="12" align="center"]
                                                    [ux_image id="<?php echo esc_attr($item['thumbnail']); ?>" width="67"]
                                                [/col_inner_1]

                                                [col_inner_1 span="8" span__sm="12" align="center"]
                                                    [block id="<?php echo esc_attr($item['zblock']); ?>"]
                                                [/col_inner_1]

                                            [/row_inner_1]
                                        [/col_inner]
                                    [/row_inner]
                                    <?php
                                }
                            }
                        ?>           
                    [/col]
                [/row]
                [row col_bg="#008444" h_align="right" class="bot"]
                    [col span="7" span__sm="12" margin="-80px 0px 0px 0px" class="bgr-zzzz-8888"]

                        [row_inner v_align="bottom" padding="30px 0px 10px 20px" padding__md="30px 0px 10px 10px" class="row-nopaddingbottom"]

                            [col_inner span="5" span__sm="12" span__md="7" margin="0px 0px 0px 0px" margin__sm="0px 0px -35px 0px" margin__md="0px 0px 0px 0px" color="light"]

                                [title text="KIỂM TRA HƯỚNG NGHIỆP" class="mb-0"]


                            [/col_inner]
                            [col_inner span="7" span__sm="12" span__md="5" class="pt-0"]

                                [button text="Làm bài test" color="success" link="https://sconnect.htecom.com/bai-test-huong-nghiep/"]


                            [/col_inner]

                        [/row_inner]

                    [/col]
                [/row]
            <?php

            echo '</div>';
            return do_shortcode(ob_get_clean());
        };
        $a->options = [
            // 'post_type' => array(
            //     'type'       => 'select',
            //     'heading'    => 'Text ',
            //     'default' => 'khoa',
            //     'options' => [
            //         'khoa' => 'Khoa',
            //         'lop' => 'Lớp',
            //         'bo_mon' => 'Bộ môn'
            //     ]
            // ),
        ];
        $a->general_element();

    }
}



