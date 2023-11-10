<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Woocommerce;
class AccountPage {
    
    function __construct() {
        add_action( 'init', [$this,'tach_dangnhap_dangky'] );
    }

    function tach_dangnhap_dangky(){

        add_action('woocommerce_login_form_end',function(){
            ?>
            Chưa có tài khoản
            <a href="?action=register">
                Đăng ký
            </a>
            <?php
        });

        add_action( 'woocommerce_register_form_end', function(){
            ?>
            Đã có tài khoản
            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                Đăng nhập
            </a>
            <?php
        } );


        add_action( 'wp_footer', function(){
            ?>
            <style type="text/css">
                #customer_login>.large-6{
                    margin: auto;
                }
                #customer_login>.col-2{
                    border: none;
                }

                #customer_login>.col-2{
                    display: none;
                }


                <?php if(isset($_GET['action']) and $_GET['action'] == 'register'): ?>            
                    #customer_login>.col-1{
                        display: none;
                    }
                    #customer_login>.col-2{
                        display: block;
                    }
                <?php endif; ?>
            </style>
            <?php
        } );
    }
}
