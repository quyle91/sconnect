<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
/**
 * 
 */
namespace Sconnect\Shortcodes;
class TinTuyenDung {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-tintuyendung';
        $a->shortcode_title = 'Sconnect Tin tuyển dụng';
        $a->shortcode_callback = function() use($a){
            ob_start();
            global $Sconnect_TinTuyenDung;
            $sync = $Sconnect_TinTuyenDung->sync;
            $term = $sync->get_term_sync(get_the_ID());

            // switch (get_post_type()) {
            //     case 'tin_tuyen_dung':
            //         global $Sconnect_TinTuyenDung;
            //         $sync = $Sconnect_TinTuyenDung->sync;
            //         $term = $sync->get_term_sync(get_the_ID());
            //         break;
            // }
            if(isset($term)){
                ob_start();
                ?>
                __taxonomy_tin_tuyen_dung="<?php echo esc_attr($term->taxonomy);?>" 
                __term_<?php echo esc_attr($term->taxonomy);?>_tin_tuyen_dung="<?php echo esc_attr($term->term_id);?>" 
                <?php
                $condition = ob_get_clean();
            }else{
                $condition = '';
            }
            
            $terms = array('taxonomy' => 'tin_tuyen_dung'); 
            foreach ($terms as $term){
                $args = [
                    'post_type' => ['tin_tuyen_dung'],
                    'post_status' => ['publish'],
                    'posts_per_page' => -1,
                    // 'tax_query' => [
                    //     'relation' => 'AND',
                    //     [
                    //         'taxonomy' => 'tin_tuyen_dung',
                    //         'field' => 'id',
                    //         'terms' => [$term->term_id],
                    //         'include_children'=> false,
                    //         'operator' => 'IN'
                    //     ]
                    // ]                                
                ];
                $the_query = new \WP_Query( $args );
                while($the_query->have_posts()){
                    $the_query->the_post();
                    $custom = get_post_custom( get_the_ID() ); 
                    echo"<pre>";print_r($custom);   
                   
                    //get_template_part( 'template-parts/single-tintuyendung', 'item', ['term_id'=> $term->term_id] );
                     // // Post's title
                    // the_title();
                    // // Post's featured image
                    // the_post_thumbnail('thumbnail');
                ?>  
                    <div class="col medium-4 small-12">
                        <a href="<?php echo the_permalink();?>">
                            <?php if ( has_post_thumbnail() ) { ?>
                                <img src="#">
                            <?php }else{ ?>
                                    <img src="#">
                            <?php } ?>
                        </a>
                        <a href="<?php the_permalink()?>"> <?php the_title();?></a>
                        
                        <?php //echo"<pre>";print_r($infoCustom); ?>
                        <p><?php echo get_the_post_type_description();?></p>
                        <p><?php echo($custom->luong);?></p>
                        <p><?php echo $custom['dia_diem'][0];?></p>
                        
                    </div>
                <?php }
            }
            wp_reset_postdata();
            return do_shortcode(ob_get_clean());
        };
        $a->options = [
            'text' => array(
                'type'       => 'textfield',
                'heading'    => 'Text ',
                'default' => 'Text',
            ),
        ];
        $a->general_element();

    }
}



