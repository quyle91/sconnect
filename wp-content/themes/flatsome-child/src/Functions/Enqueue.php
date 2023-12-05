<?php
namespace Sconnect\Functions;
class Enqueue {
    
    function __construct() {
        add_action( 'wp_enqueue_scripts', function(){

            // ko sửa css ở đây nhé.
            wp_enqueue_style( 'sconnect-base', Sconnect_Url."/assets/css/base.css", [], null, 'all' );
            wp_enqueue_style( 'sconnect-base-woo', Sconnect_Url."/assets/css/base-woo.css", [], null, 'all' );
            if(get_current_user_id(  ) == 1) return; // quy

            wp_enqueue_style( 'dat-css', Sconnect_Url."/assets/css/dat.css", [], null, 'all' );
            wp_enqueue_style( 'tai-custom-style', Sconnect_Url."/assets/css/__tai-custom-style.css", [], null, 'all' );
            wp_enqueue_style( 'tai-base-css', Sconnect_Url."/assets/css/__tai-base-css.css", [], null, 'all' );
            wp_enqueue_style('quan-css', Sconnect_Url . "/assets/css/quan.css", [], null, 'all');
            
        } );
    }
}