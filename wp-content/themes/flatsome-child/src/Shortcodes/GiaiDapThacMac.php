<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class GiaiDapThacMac {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-giaidapthacmac';
        $a->shortcode_title = 'Sconnect Giải đáp thắc mắc';
        $a->shortcode_callback = function() use($a){
            // sử dụng element tab
            
            ob_start();
            ?>
            <div class="giaidapthacmac">
                <?php
                    $data = get_field('giai_dap_thac_mac_pho_bien','option'); // Sử dụng data ở đây
                    echo "<pre class=sconnectpre>"; 
                    echo '<h4>Element name: '.$a->shortcode_name ."</h4>"; 
                    print_r(__FILE__); 
                    echo "</pre>";
                ?>
            </div>
            <style type="text/css">
                .giaidapthacmac{

                }
            </style>
            <?php
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



