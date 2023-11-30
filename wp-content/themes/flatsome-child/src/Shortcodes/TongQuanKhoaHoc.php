<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class TongQuanKhoaHoc {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-tongquan-khoahoc';
        $a->shortcode_title = 'Sconnect Tổng Quan Khoá Học';
        $a->shortcode_callback = function() use($a){
            ob_start();
            echo "<pre class=sconnectpre>"; 
            echo '<h4>Element name: '.$a->shortcode_name ."</h4>"; 
            print_r(__FILE__); 
            echo "</pre>";
            return ob_get_clean();
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



