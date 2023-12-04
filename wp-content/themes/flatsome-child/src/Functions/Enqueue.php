<?php
namespace Sconnect\Functions;
class Enqueue {
    
    function __construct() {
        add_action( 'wp_enqueue_scripts', function(){
// // <<<<<<< HEAD
            
// //             wp_enqueue_style( 'sconnect-base', Sconnect_Url."/assets/css/base.css", [], null, 'all' );
// //             wp_enqueue_style( 'sconnect-base-woo', Sconnect_Url."/assets/css/base-woo.css", [], null, 'all' );
// // =======
// //             // CSS
// //             wp_enqueue_style( 'sconnect-style', Sconnect_Url."/assets/css/flatsome-main.css", [], null, 'all' );
// //             wp_enqueue_style( 'sconnect-custom-classes', Sconnect_Url."/assets/css/custom-classes.css", [], null, 'all' );
// //             wp_enqueue_style( 'sconnect-elements', Sconnect_Url."/assets/css/flatsome-elements.css", [], null, 'all' );
// //             wp_enqueue_style( 'sconnect-woo-main', Sconnect_Url."/assets/css/woocommerce-main.css", [], null, 'all' );
// //             wp_enqueue_style( 'sconnect-woo-cart-checkout', Sconnect_Url."/assets/css/woocommerce-cart-checkout.css", [], null, 'all' );
// //             wp_enqueue_style( 'sconnect-single-product', Sconnect_Url."/assets/css/woocommerce-single-product.css", [], null, 'all' );
// //             wp_enqueue_style( 'tai-custom-style', Sconnect_Url."/assets/css/tai-custom-style.css", [], null, 'all' );
// //             wp_enqueue_style( 'dat-css', Sconnect_Url."/assets/css/dat.css", [], null, 'all' );
// >>>>>>> f7de6f0 (Add:tuyensinh)

            if(!isset($_GET['dev'])){
                wp_enqueue_style( 'dat-css', Sconnect_Url."/assets/css/dat.css", [], null, 'all' );
                wp_enqueue_style( 'sconnect-base', Sconnect_Url."/assets/css/base.css", [], null, 'all' );
                wp_enqueue_style( 'sconnect-base-woo', Sconnect_Url."/assets/css/base-woo.css", [], null, 'all' );
                wp_enqueue_style( 'tai-custom-style', Sconnect_Url."/assets/css/__tai-custom-style.css", [], null, 'all' );
                wp_enqueue_style( 'tai-base-css', Sconnect_Url."/assets/css/__tai-base-css.css", [], null, 'all' );
            }
            
        } );
    }
}
