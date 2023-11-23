<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\KhoaHoc\Controller;
class Init {
    public $sync;
    
    function __construct() {
        $this->sync = $this->sync____chuong_trinh();
        $this->custom_element_chuongtrinhdaotao();
    }
    
    function custom_element_chuongtrinhdaotao(){
        add_action('fbc_flatsome_custom_blog_col_inner_after', function($repeater,$the_query){
            if(!isset($the_query->query['post_type']) or $the_query->query['post_type'] !== 'khoa_hoc') return;
            if(!isset($repeater['style']) or $repeater['style'] !== 'default') return;
            $term = $this->sync->get_terms(get_the_ID());
            $color = get_field('color');
            if(!$color){
                $color = 'var(--primary-color)';
            }
            ?>
            <div 
                class=custom_element_chuongtrinhdaotao
                style="background-color: <?php echo esc_attr($color); ?>"
                >
                <div class="inner col text-center">
                    <div class="h3 uppercase mb heading">
                        <?php 
                            the_title();
                            $main_id = get_the_ID(); // Khắc phục lỗi ko gọi được get_the_ID()
                        ?>
                    </div>
                    <div class="items mb">
                        <?php
                            $args = [
                                'post_type' => 'bo_mon',
                                'post_status' => ['publish'],
                                'posts_per_page' => -1,
                                'tax_query' => [
                                    'relation' => 'AND',
                                    [
                                        'taxonomy' => '_khoa_hoc',
                                        'field' => 'id',
                                        'terms' => [$term->term_id],
                                        'include_children'=> false,
                                        'operator' => 'IN'
                                    ]
                                ]                                
                            ];
                            $the_query = new \WP_Query( $args );
                            if ( $the_query->have_posts() ) :
                                while ( $the_query->have_posts() ) : $the_query->the_post();
                                    get_template_part( 'template-parts/single-bomon', 'item', ['term_id'=> $term->term_id] );
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            
                        ?>
                    </div>
                    <a class="button is-outline" href="<?php the_permalink($main_id); ?>">
                        <?php echo __('Tìm hiểu thêm', 'sconnect'); ?>
                    </a>
                </div>
            </div>
            <?php
        },10,2);

        add_action( 'flatsome_custom_blog_before_title', function($repeater){
            if(!isset($repeater['class']) or $repeater['class'] !== 'chuongtrinhdaotao_class') return;
            $term_id = get_field('sync_chuongtrinh');
            $icon = get_field('icon','term_'.$term_id);
            if(!$icon) return;
            echo '<span class=icon_chuongtrinh>';
            echo wp_get_attachment_image( $icon, 'full', false, ['style' => 'max-height: 26px; width: auto; margin-right: 10px;'] );
            echo '</span>';
        } );

        add_action( 'wp_footer', function(){
            ?>
            <style type="text/css">
                .blog-posts-custom-element-wrapper.khoa_hoc .post-item .col-inner{
                    position: relative;
                } 
                .blog-posts-custom-element-wrapper.khoa_hoc .post-item .col-inner .custom_element_chuongtrinhdaotao{
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    height: 100%;
                    transition: all 0.3s ease-out;
                    opacity: 0;
                    display: flex;
                    /* align-items: center; */
                }
                .blog-posts-custom-element-wrapper.khoa_hoc .post-item .col-inner:hover .custom_element_chuongtrinhdaotao{
                    opacity: 1;
                }
            </style>
            <?php
        } );
    }

    function sync____chuong_trinh(){
        $sync = new \Adminz\Helper\ADMINZ_Helper_Taxonomy_Sync;
        $sync->taxname = '_khoa_hoc';
        $sync->post_type = 'khoa_hoc';
        $sync->init();
        return $sync;
    }

    
}



