<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class PolylangCustomSwitcher {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'polylang-custom-switcher';
        $a->shortcode_title = 'PolylangCustomSwitcher';
        $a->shortcode_callback = function() use($a){
            $args = array(
                'dropdown' => 0,              
                'show_names' => 0,            
                'display_names_as' => 'name', 
                'show_flags' => 1,            
                'hide_if_empty' => 1,         
                'force_home' => 0,            
                'echo' => 1,                  
                'hide_if_no_translation' => 0,
                'hide_current' => 1,         
                'raw' => 0                    
            );
            pll_the_languages($args);
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



