<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\DoAn\Controller;
class Init {
    
    function __construct() {
        $this->custom_element_duannoibat();
        
    }

    function custom_element_duannoibat(){
        add_action( 'fbc_flatsome_custom_blog_col_inner_after', function($repeater){
            if(!isset($repeater['class']) or $repeater['class'] !== 'duannoibat_class') return;
            ?>
            <a href="<?php the_permalink();?> ">
                <div class="doanabsolue">
                    
                    <div class="wrap">
                        <div class='doanabsolue__1'>
                            <?php
                                echo get_field('hocvien');
                            ?>
                        </div>
                        <div class='doanabsolue__2'>
                            <span class='t'>
                                <?php echo __('Học viên','sconnect'); ?>
                            </span>
                            <span class='dot'></span>
                            <span>
                                <?php echo __('khoá', 'sconnect'); ?>
                                <?php echo get_field('khoa_do_an') ?>
                            </span>
                        </div>
                    </div>
                    
                </div>
            </a>
            <?php
        },10,1 );
        
        add_action('wp_footer', function(){
            ?>
            <style type="text/css">
                .blog-posts-custom-element-wrapper.doan .post-item.grid-col .col-inner{
                    position: relative;
                }
                .blog-posts-custom-element-wrapper.doan .post-item.grid-col .col-inner .doanabsolue{
                    position: absolute;
                    width: 100%;
                    height: 100%;
                }
            </style>
            <?php
        });
    }
}



