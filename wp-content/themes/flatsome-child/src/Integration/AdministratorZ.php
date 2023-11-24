<?php
namespace Sconnect\Integration;
class AdministratorZ {
    
    function __construct() {
        $this->setup_banner_helper();        
        $this->setup_css_round_pack();
    }

    function setup_css_round_pack(){
        /* :root {
            --big-radius: <?php echo apply_filters('adminz_pack1_big-radius','10px'); ?>;
            --small-radius: <?php echo apply_filters('adminz_pack1_small-radius','5px'); ?>;
            --form-controls-rarius: <?php echo apply_filters('adminz_pack1_form-controls-radius','5px'); ?>;;
            --main-gray: <?php echo apply_filters('adminz_pack1_main-gray','#0000000a'); ?>;
            --border-color: <?php echo apply_filters('adminz_pack1_border-color','transparent'); ?>;
        } */
        add_filter('adminz_pack1_big-radius', function(){
            return '6px';
        });
        add_filter('adminz_pack1_small-radius', function(){
            return '6px';
        });
        add_filter('adminz_pack1_enable_sidebar', function(){
            return false;
        });
    }
    
    function setup_banner_helper(){
        $sa = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Acf_Banner;
        $sa->init();
        
    }    
}
