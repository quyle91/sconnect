<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class HoiDongHocThuat {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-hoidonghocthuat';
        $a->shortcode_title = 'Sconnect Hội đồng học thuật';
        $a->shortcode_callback = function() use($a){          


            ob_start();
            ?>
            <div class="hoidonghocthuat">
                <?php
                    $option = get_field('hoidonghocthuat','options');
                    if(isset($option['vitrigiangvien']) and is_array($option['vitrigiangvien'])){
                        $vitrigiangvien = $option['vitrigiangvien'];
                        echo '[tabgroup style="simple" align="center"]';                            
                            if(!empty($vitrigiangvien) and is_array($vitrigiangvien)){
                                foreach ($vitrigiangvien as $key => $term) {
                                    
                                    $args = [
                                        'post_type' => 'giang_vien',
                                        'post_status' => ['publish'],
                                        'posts_per_page' => 4,
                                        'tax_query' => [
                                            'relation' => 'AND',
                                            [
                                                'taxonomy' => 'vi_tri_giang_vien',
                                                'field' => 'id',
                                                'terms' => [$term->term_id],
                                                'include_children'=> false,
                                                'operator' => 'IN'
                                            ]
                                        ],
                                    ];
                                    $the_query = new \WP_Query( $args );
                                    if ( $the_query->have_posts() ) :
                                        echo '[tab title="'.$term->name.'"]';
                                            echo '<div class="row row-full-width row-collapse">';
                                                while ( $the_query->have_posts() ) : $the_query->the_post();
                                                    echo '<div class="item col medium-6 small-12 large-6">';
                                                        get_template_part( 'template-parts/single-hoidonghocthuat', 'item' );
                                                    echo '</div>';
                                                endwhile;
                                            echo '</div>';
                                        echo '[/tab]';
                                        wp_reset_postdata();
                                    endif;

                                }
                            }                            
                        echo '[/tabgroup]';
                    }                
                ?>
                <div class="thongtinthem">
                    <div class="row row-collapse row-full-width">
                        <div class="col large-6 hide-for-small"></div>
                        <div class="col large-6 primary dark" style="padding: 15px !important;">
                            <div class="row row-nopaddingbottom">
                                <div class="col large-6 small-7">
                                    [title icon="icon-angle-right" text="<?php echo esc_attr($option['form_title']) ?>"]                         
                                </div>
                                <div class="col large-6 small-5">
                                    <a href="#datlich" class="button is-outline">
                                        <?php echo __("Đặt lịch", 'sconnect'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
            
            <?php
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

        add_action( 'wp_footer', function(){
            ?>
            <style type="text/css">
                .hoidonghocthuat{
                    
                }
                @media (max-width: 850px){
                    .hoidonghocthuat{
                        padding-left: 15px;
                        padding-right: 15px;
                    }
                }
                .hoidonghocthuat .thongtinthem{

                }
                .hoidonghocthuat .single-hoidonghocthuat-item{
                    background: var(--primary-color);
                }
                .hoidonghocthuat .item:nth-child(4n+2) .single-hoidonghocthuat-item{
                    background: var(--secondary-color);
                }
                .hoidonghocthuat .item:nth-child(4n+3) .single-hoidonghocthuat-item{
                    background: var(--success-color);
                }
                .hoidonghocthuat .item:nth-child(4n+4) .single-hoidonghocthuat-item{
                    background: var(--alert-color);
                }
                .hoidonghocthuat .single-hoidonghocthuat-item .meta{
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                }
                .hoidonghocthuat .single-hoidonghocthuat-item .right .col-inner{
                    padding: 30px;
                }
                @media (min-width: 1200px){
                    .hoidonghocthuat .single-hoidonghocthuat-item .right .col-inner{
                        padding: 70px;
                    }
                }

                .hoidonghocthuat .single-hoidonghocthuat-item .left{
                    background: #F4F4F4;
                }

                .hoidonghocthuat .single-hoidonghocthuat-item .left .col-inner{
                    height: 100%;
                    display: flex;
                    justify-content: center;
                    align-items: flex-end;
                }
                @media (min-width: 1200px){
                    .hoidonghocthuat .item:nth-child(4n) .single-hoidonghocthuat-item,
                    .hoidonghocthuat .item:nth-child(4n-1) .single-hoidonghocthuat-item{
                        flex-direction: row-reverse;
                    }
                }
            </style>
            <?php
        } );

    }
}



