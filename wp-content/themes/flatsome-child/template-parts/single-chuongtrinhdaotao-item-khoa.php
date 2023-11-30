<?php
    $__post_id = get_the_ID(); // Lưu lại id trước khi thực hiện bất kỳ một query nào khác
?>
[col span__sm="12" span="12" color="light" class="<?php echo sconnect_get_file_class(__FILE__); ?>"]
    [row_inner class="row-nopaddingbottom"]
        <?php
            // ======================= LEFT ========================
            ob_start();
            ?>                
                [col_inner span="5" span__sm="12" force_first="small" class="left"]                        
                    [title style="center" text="<?php the_title() ?>" class="ztitle"]                    
                    <style type="text/css">
                        <?php
                            $icon = wp_get_attachment_image_src(get_field('icon', $__post_id),'thumbnail');
                            if(isset($icon[0])){
                                ?>
                                    .__post_id_<?php echo esc_attr($__post_id);?> .ztitle .section-title-main::before{
                                        content: "";
                                        display: inline-block;
                                        background-image: url(<?php echo esc_url($icon[0]); ?>);
                                        background-size: contain;
                                        background-repeat: no-repeat;
                                        width: 22px;
                                        height: 22px;
                                    }
                                <?php
                            }
                        ?>
                        
                    </style>
                    <div class="gallery_wrap relative">
                        <?php
                            $data_gallery = get_field('data_gallery', $__post_id);
                            if(empty($data_gallery)){
                                $data_gallery = [Sconnect_Default_image,Sconnect_Default_image,Sconnect_Default_image,Sconnect_Default_image,Sconnect_Default_image,Sconnect_Default_image,Sconnect_Default_image,Sconnect_Default_image,Sconnect_Default_image];
                            }

                            if(!empty($data_gallery) and is_array($data_gallery)){
                                $slide_id = "__slide_".wp_rand();
                                ?>
                                [ux_slider nav_color="dark" hide_nav="true" bullets="false" class="<?php echo esc_attr($slide_id);?>"]
                                <?php
                                    foreach ($data_gallery as $key => $value) {
                                        ?>
                                        [ux_image id="<?php echo esc_attr($value); ?>" height="90%"]
                                        <?php
                                    }
                                ?>
                                [/ux_slider]
                                [adminz_slider_custom bullets="false" slide_width="20%" as_nav_for=".<?php echo esc_attr($slide_id);?>" slide_item_padding="3px" slide_align="left"]
                                <?php
                                    foreach ($data_gallery as $key => $value) {
                                        ?>
                                        [adminz_slider_custom_item_wrap]
                                            [ux_image id="<?php echo esc_attr($value) ?>" height="100%"]
                                        [/adminz_slider_custom_item_wrap]
                                        <?php 
                                    }
                                ?>
                                [/adminz_slider_custom]
                                <?php
                            }
                        ?>
                    </div>
                [/col_inner]
            <?php
            $left_html = ob_get_clean();



            // ======================= RIGHT ===============================                
            ob_start();
            ?>
                [col_inner span="7" span__sm="12" class="right"]
                    [gap visibility="show-for-small"]

                    [title text="<?php echo __('Cơ hội Sự nghiệp', 'sconnect') ?>"]
                    [divider width="100%" margin="0" height="2px"]

                    [row_inner_1 style="large" class="cohoinghenghiep"]

                        <?php
                            $cohoisunghiep = get_field('cohoisunghiep', $__post_id);                            
                            if(empty($cohoisunghiep)){
                                $cohoisunghiep= [
                                    [
                                        'icon' => Sconnect_Default_image,
                                        'ztitle' => 'THIẾT KẾ GAME',
                                        'mucluong' => '15 - 20 triệu'
                                    ],
                                    [
                                        'icon' => Sconnect_Default_image,
                                        'ztitle' => 'THIẾT KẾ GAME',
                                        'mucluong' => '15 - 20 triệu'
                                    ],
                                    [
                                        'icon' => Sconnect_Default_image,
                                        'ztitle' => 'THIẾT KẾ GAME',
                                        'mucluong' => '15 - 20 triệu'
                                    ],
                                    [
                                        'icon' => Sconnect_Default_image,
                                        'ztitle' => 'THIẾT KẾ GAME',
                                        'mucluong' => '15 - 20 triệu'
                                    ],
                                ];
                            }

                            if(!empty($cohoisunghiep) and is_array($cohoisunghiep)){
                                foreach ($cohoisunghiep as $key => $value) {
                                    ?>
                                    [col_inner_1 span="3" span__sm="6" span__md="6" align="center" class="item"]

                                        [ux_image id="<?php echo esc_attr($value['icon']);?>" width="70"]

                                        <h4><?php echo esc_attr($value['ztitle']) ?></h4>
                                        <p data-opacity="0.8"><?php echo __('Mức lương','sconnect'); ?></p>
                                        <p><span data-text-color="success"><?php echo esc_attr($value['mucluong']); ?></span></p>

                                    [/col_inner_1]
                                    <?php
                                }
                            }
                        ?>

                    [/row_inner_1]
                    
                    [title text="<?php echo __('Chương trình học', 'sconnect') ?>"]
                    [divider width="100%" margin="0" height="2px"]

                    [row_inner_1 class="chuongtrinhhoc"]

                        [col_inner_1 span__sm="12"]                            
                            <ul>
                                <?php
                                    global $Sconnect_Khoa;
                                    $sync = $Sconnect_Khoa->sync;
                                    $term = $sync->get_term_sync($__post_id);                                    

                                    if(!is_wp_error( $term )){
                                        $__args = [
                                            'post_type' => ['bo_mon'],
                                            'post_status' => ['publish'],
                                            'posts_per_page' => -1,
                                            'tax_query' => [
                                                'relation' => 'AND',
                                                [
                                                    'taxonomy' => $sync->taxname,
                                                    'field' => 'id',
                                                    'terms' => [$term->term_id],
                                                    'include_children'=> false,
                                                    'operator' => 'IN'
                                                ]
                                            ],
                                        ];                                        
                                        $__the_query = new \WP_Query( $__args );
                                        if ( $__the_query->have_posts() ) :
                                            while ( $__the_query->have_posts() ) : $__the_query->the_post();
                                                ?>
                                                <li class="list-style-none">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php
                                                            $icon = get_field('icon');
                                                            if(!$icon){ 
                                                                $icon = Sconnect_Default_image;
                                                            }
                                                            echo wp_get_attachment_image( 
                                                                $icon, 
                                                                'full', 
                                                                false, 
                                                                [
                                                                    'style'=> 'height: 26px; width: auto;'
                                                                ] 
                                                            );
                                                        ?>
                                                        <?php the_title(); ?>
                                                    </a>
                                                </li>
                                                <?php
                                            endwhile;
                                            wp_reset_postdata();
                                        endif;
                                    }
                                ?>
                            </ul>

                        [/col_inner_1]

                    [/row_inner_1]
                    [button text="<?php echo __('Tìm hiểu thêm', 'sconnect') ?>" expand="true" link="<?php echo get_the_permalink($__post_id); ?>" class="mb-0"]


                [/col_inner]
            <?php
            $right_html = ob_get_clean();

            // truyền the_query từ loop            
            $current_post = $args['the_query']->current_post;
            if($current_post%2 == 0){
                echo $left_html;
                echo $right_html;
            }else{
                echo $right_html;
                echo $left_html;
            }
        
        ?>
    [/row_inner]
[/col]