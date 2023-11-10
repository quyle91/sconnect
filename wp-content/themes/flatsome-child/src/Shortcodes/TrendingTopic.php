<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class TrendingTopic {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-trending-topic';
        $a->shortcode_title = 'Sconnect Trending Topic';
        $a->shortcode_callback = function() use($a){
            ob_start();
            echo "<pre class=sconnectpre>"; 
            echo '<h4>Element name: '.$a->shortcode_name ."</h4>"; 
            print_r("<span>".__FILE__."</span>"); 
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



