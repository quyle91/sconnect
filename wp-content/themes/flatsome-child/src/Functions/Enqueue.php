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


            // JS - GLobal Js
            
        } );
    }
}
