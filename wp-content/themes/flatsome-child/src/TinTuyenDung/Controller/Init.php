<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\TinTuyenDung\Controller;
class Init {
    
    function __construct() {
        
        $this->sync = $this->sync____tin_tuyen_dung();
        $this->custom_element_tintuyendung();
        
    }
    function sync____tin_tuyen_dung(){
        $sync = new \Adminz\Helper\ADMINZ_Helper_Taxonomy_Sync;
        $sync->taxname = '_tin_tuyen_dung';
        $sync->post_type = 'tin_tuyen_dung';
        $sync->init();
        return $sync;
    }

    function custom_element_tintuyendung(){
        // if(isset($the_query->query['post_type']) or $the_query->query['post_type'] == 'tin_tuyen_dung'){
        //     $args = [
        //         'post_type' => ['tin_tuyen_dung'],
        //         'post_status' => ['publish'],
        //         'posts_per_page' => -1,
        //         'tax_query' => [
        //             // 'relation' => 'AND',
        //             // [
        //                 // 'taxonomy' => 'tin_tuyen_dung',
        //                 // 'field' => 'id',
        //                 // 'terms' => [$term->term_id],
        //                 // 'include_children'=> false,
        //                 // 'operator' => 'IN'
        //             // ]
        //         ]                                
        //     ];
        //     $the_query = new \WP_Query( $args );
        //     // echo"<pre>";print_r($the_query->posts); 
        //     // die();
        //     if ( $the_query->have_posts() ) :
        //         // echo"<pre>";print_r($the_query->posts); 
                
        //         while ( $the_query->have_posts() ) : $the_query->the_post();
        //             get_template_part( 'template-parts/single-tintuyendung', 'item', ['term_id'=> $term->term_id] );
        //         endwhile;
        //         wp_reset_postdata();
        //     endif;
        // }                

        add_action( 'fbc_flatsome_custom_blog_col_inner_after', function($repeater,$the_query){
            if(!isset($the_query->query['post_type']) or $the_query->query['post_type'] !== 'tin_tuyen_dung') return;
            if($repeater['style'] !=='none') return;
            $term = $this->sync->get_terms(get_the_ID());
            $args = [
                'post_type' => ['tin_tuyen_dung'],
                'post_status' => ['publish'],
                'posts_per_page' => -1,
                //'tax_query' => [
                    // 'relation' => 'AND',
                    // [
                    //     'taxonomy' => 'tin_tuyen_dung',
                    //     'field' => 'id',
                    //     'terms' => [$term->term_id],
                    //     'include_children'=> false,
                    //     'operator' => 'IN'
                    // ]
                //]                                
            ];
            $the_query = new \WP_Query( $args );
            // echo"<pre>";print_r($the_query->posts); 
            // die();
            if ( $the_query->have_posts() ) :
                // echo"<pre>";print_r($the_query->posts); 
                
                while ( $the_query->have_posts() ) : $the_query->the_post();
                    get_template_part( 'template-parts/single-tintuyendung', 'item', ['term_id'=> $term->term_id] );
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
            
            <?php
        },10,2 );

        add_action( 'flatsome_custom_blog_before_title', function($repeater){
            if(!isset($repeater['class']) or $repeater['class'] !== 'tintuyendung_class') return;
            $term_id = get_field('sync_tintuyendung');
            $icon = get_field('icon','term_'.$term_id);
            if(!$icon) return;
            echo '<span class=icon_tintuyendung>';
            echo wp_get_attachment_image( $icon, 'full', false, ['style' => 'max-height: 26px; width: auto; margin-right: 10px;'] );
            echo '</span>';
        } );

        add_action( 'wp_footer', function(){
            ?>
            <style type="text/css">
                .blog-posts-custom-element-wrapper.tin_tuyen_dung .post-item .col-inner{
                    position: relative;
                } 
                .blog-posts-custom-element-wrapper.tin_tuyen_dung .post-item .col-inner .custom_element_tintuyendung{
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 33.33%;
                    /* height: 25%; */
                    transition: all 0.3s ease-out;
                    opacity: 0;
                    display: flex;
                    /* align-items: center; */
                }
                .blog-posts-custom-element-wrapper.tin_tuyen_dung .post-item .col-inner:hover .custom_element_tintuyendung{
                    opacity: 1;
                }
                .blog-posts-custom-element-wrapper.tin_tuyen_dung .post-item{
                    width: 25%;
                }
            </style>
            <?php
        } );
    }
}



