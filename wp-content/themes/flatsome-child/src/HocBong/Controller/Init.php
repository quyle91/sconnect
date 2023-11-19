<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\HocBong\Controller;
class Init {
    
    function __construct() {
        $this->custom_element_thongtinhocbong();
    }

    function custom_element_thongtinhocbong(){
        add_action( 'fbc_flatsome_custom_blog_col_inner_after', function($repeater, $the_query){
            if(!isset($the_query->query['post_type']) or $the_query->query['post_type'] !== 'hoc_bong') return;
            // add_filter( 'excerpt_length', '__custom_excerpt_length_25' );
            ?>
            <a href="<?php the_permalink();?> ">
                <div class="thongtinhocbong_custom">                    
                    <div class="col text-center">
                        <div class="title">
                            <?php the_title(); ?>
                        </div>
                        <div class="excerpt">
                            <?php echo the_excerpt(); ?>
                        </div>
                        <div class="zbutton">
                            <button class="button is-outline">
                                <?php echo __("Xem chi tiết",'sconnect'); ?>
                            </a>
                        </div>
                    </div>    
                </div>
            </a>
            <?php
            // remove_filter( 'excerpt_length', '__custom_excerpt_length_25' );
        },10,2 );
        
        add_action('wp_footer', function(){
            ?>
            <style type="text/css">
                .blog-posts-custom-element-wrapper.hoc_bong .col-inner{
                    position: relative;
                }
                .blog-posts-custom-element-wrapper.hoc_bong .col-inner .thongtinhocbong_custom{
                    opacity: 0;
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    top: 0px;
                    left: 0px;                    
                    align-items: center;
                    display: flex;
                    overflow: auto;
                    background: linear-gradient(180deg, rgba(0, 132, 68, 0.47) -16.44%, #008444 89.76%);
                    transition: all 0.3s ease-out;
                }
                .blog-posts-custom-element-wrapper.hoc_bong .col-inner:hover .thongtinhocbong_custom{
                    opacity: 1;
                }
            </style>
            <?php
        });
    }
}



