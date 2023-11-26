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
            echo "<pre class=sconnectpre>"; 
            echo '<h4>Element name: '.$a->shortcode_name ."</h4>"; 
            print_r(__FILE__); 
            echo "</pre>";
            return ob_get_clean();
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



