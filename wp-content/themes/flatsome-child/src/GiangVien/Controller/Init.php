<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\GiangVien\Controller;
class Init {
    
    function __construct() {
        $this->custom_element_thongtinhocbong();
    }

    function custom_element_thongtinhocbong(){
        add_action( 'fbc_flatsome_custom_blog_col_inner_after', function($repeater,$the_query){
            
            if(!isset($the_query->query['post_type']) or $the_query->query['post_type'] !== 'giang_vien') return;
            add_filter( 'excerpt_length', '__custom_excerpt_length_25' );

            ?>
            <a href="<?php the_permalink();?> ">
                <div class="giangvien_custom dark">                    
                    <div class="col text-center">
                        <div class="title">
                            <?php the_title(); ?>
                        </div>
                        <div class="vitri">
                            <?php echo get_field('vitri') ?>
                        </div>
                        <div class="excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>    
                </div>
            </a>
            <?php
            remove_filter( 'excerpt_length', '__custom_excerpt_length_25' );
        },10,2 );
        
        add_action('wp_footer', function(){
            ?>
            <style type="text/css">
                .blog-posts-custom-element-wrapper.giang_vien .col-inner{
                    position: relative;
                }
                .blog-posts-custom-element-wrapper.giang_vien .col-inner .giangvien_custom{
                    opacity: 0;
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    top: 0px;
                    left: 0px;                    
                    align-items: flex-start;
                    display: flex;
                    overflow: auto;
                    transition: all 0.3s ease-out;
                    background: rgba(0, 132, 68, 0.85);
                }
                .blog-posts-custom-element-wrapper.giang_vien .col-inner:hover .giangvien_custom{
                    opacity: 1;
                }
                @media (min-width: 768px){
                    .blog-posts-custom-element-wrapper.giang_vien .col-inner .giangvien_custom{
                        align-items: center;
                    }
                }
            </style>
            <?php
        });
    }
}



