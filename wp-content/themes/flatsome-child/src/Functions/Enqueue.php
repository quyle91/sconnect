<?php
namespace Sconnect\Functions;
class Enqueue {
    
    function __construct() {
        add_action( 'wp_enqueue_scripts', function(){
            // CSS
            wp_enqueue_style( 'sconnect-style', Sconnect_Url."/assets/css/flatsome-main.css", [], null, 'all' );
            wp_enqueue_style( 'sconnect-custom-classes', Sconnect_Url."/assets/css/custom-classes.css", [], null, 'all' );
            wp_enqueue_style( 'sconnect-elements', Sconnect_Url."/assets/css/flatsome-elements.css", [], null, 'all' );
            wp_enqueue_style( 'sconnect-woo-main', Sconnect_Url."/assets/css/woocommerce-main.css", [], null, 'all' );
            wp_enqueue_style( 'sconnect-woo-cart-checkout', Sconnect_Url."/assets/css/woocommerce-cart-checkout.css", [], null, 'all' );
            wp_enqueue_style( 'sconnect-single-product', Sconnect_Url."/assets/css/woocommerce-single-product.css", [], null, 'all' );

            $is_quy = false;
            if(is_user_logged_in() and wp_get_current_user()->data->user_login == 'quyle'){
                $is_quy = true;
            }
            
            if(!$is_quy){
                wp_enqueue_style( 'tai-custom-style', Sconnect_Url."/assets/css/tai-custom-style.css", [], null, 'all' );
            }

            // JS - GLobal Js
            
        } );
    }
}
