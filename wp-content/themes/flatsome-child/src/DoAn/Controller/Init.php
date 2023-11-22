<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\DoAn\Controller;
class Init {
    
    function __construct() {
        $this->custom_element_duannoibat();
        $this->custom_element_doantieubieu();
        $this->create_widget_single_layout();      
        $this->set_query_args();  
    }

    function create_widget_single_layout(){
        register_sidebar( array(
            'name'          => __( 'Đồ Án detail', 'sconnect' ),
            'id'            => 'doan-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<span class="widget-title doan-sidebar">',
            'after_title'   => '</span><div class="is-divider small"></div>',
        ) );
    }

    function custom_element_duannoibat(){
        add_action( 'fbc_flatsome_custom_blog_col_inner_after', function($repeater,$the_query){
            if(!isset($the_query->query['post_type']) or $the_query->query['post_type'] !== 'doan') return;
            if($repeater['style'] !=='none') return;
            ?>
            <a href="<?php the_permalink();?> ">
                <div class="doanabsolue dark">
                    
                    <div class="wrap">
                        <div>
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
                    
                </div>
            </a>
            <?php
        },10,2 );
        
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
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-end;
                    align-items: flex-start;
                    padding: 15px;
                    background: linear-gradient(180deg, rgba(14, 17, 15, 0.00) 0.22%, #0E110F 99.78%);
                    transition: all 0.3s ease-out;
                    opacity: 0;
                }
                .blog-posts-custom-element-wrapper.doan .post-item.grid-col .col-inner:hover .doanabsolue{
                    opacity: 1;
                }
                .blog-posts-custom-element-wrapper.doan .post-item.grid-col .col-inner .doanabsolue .wrap{
                    display: flex;
                    gap: 10px;
                }
                .blog-posts-custom-element-wrapper.doan .post-item.grid-col .col-inner .doanabsolue .wrap:before{
                    content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 18 18' fill='none'%3E%3Crect x='0.5' y='0.5' width='17' height='17' rx='8.5' fill='%230E110F' stroke='%230FB239'/%3E%3Cpath d='M8.99999 9.8869C7.60341 9.8869 6.36144 10.5479 5.57073 11.5736C5.40055 11.7943 5.31546 11.9047 5.31824 12.0539C5.32039 12.1691 5.39423 12.3145 5.48675 12.3857C5.6065 12.4778 5.77245 12.4778 6.10434 12.4778H11.8956C12.2275 12.4778 12.3935 12.4778 12.5132 12.3857C12.6058 12.3145 12.6796 12.1691 12.6817 12.0539C12.6845 11.9047 12.5994 11.7943 12.4293 11.5736C11.6386 10.5479 10.3966 9.8869 8.99999 9.8869Z' stroke='%230FB239' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M8.99999 8.59144C10.0949 8.59144 10.9825 7.72145 10.9825 6.64826C10.9825 5.57507 10.0949 4.70508 8.99999 4.70508C7.9051 4.70508 7.01751 5.57507 7.01751 6.64826C7.01751 7.72145 7.9051 8.59144 8.99999 8.59144Z' stroke='%230FB239' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
                }
            </style>
            <?php
        });
    }

    // related bỏ qua đồ án hiện tại
    function set_query_args(){        
        add_filter('custom_blog_posts_args',function($args){
            if(get_post_type() == 'doan'){
                $args['post__not_in'] = [get_the_ID()];
            }
            return $args;
        },10,1);
    }
    

    function custom_element_doantieubieu(){
        add_action('fbc_flatsome_custom_blog_col_inner_before', function($repeater,$the_query){
            if(!isset($the_query->query['post_type']) or $the_query->query['post_type'] !== 'doan') return;
            if($repeater['style'] !=='default') return;

            

            add_action('flatsome_custom_blog_title_before', [$this,'set_flatsome_custom_blog_title_before'],10,1);
        },10,2);
    }

    function set_flatsome_custom_blog_title_before($args){
        $terms = wp_get_post_terms( get_the_ID(), 'bo-mon' );
        echo '<div class="__bomon_doantieubieu">';
        if(!empty($terms) and is_array($terms)){
            foreach ($terms as $key => $value) {
                if($key){
                    break;
                }
                echo $value->name;
            }
        }
        echo '</div>';
    }
}



