<?php
    $__post_id = get_the_ID(); // Lưu lại id trước khi thực hiện bất kỳ một query nào khác
?>
[col span__sm="12" span="12" color="light" class="<?php echo sconnect_get_file_class(__FILE__); ?> section-BGR-BOTTOM-RIGHT-A"]
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

                    <!-- block 1 -->
                    [title text="<?php echo __('Mục tiêu đào tạo', 'sconnect') ?>"]
                    [divider width="100%" margin="0" height="2px"]

                    <p><?php echo do_shortcode(get_field('muctieudaotao'));?></p>
                    

                    <!-- block 2 -->
                    [title text="<?php echo __('Đối tượng học', 'sconnect') ?>"]
                    [divider width="100%" margin="0" height="2px"]
                    
                    [row_inner_1]
                        <?php
                            $khoahocdanhchoai = get_field('khoahocdanhchoai');
                            if(empty($khoahocdanhchoai)){
                                $khoahocdanhchoai = [
                                    [ 'text' => 'Lorem ipsum dolor sit amet, cons1' ], 
                                    [ 'text' => 'Lorem ipsum dolor sit amet, cons2' ], 
                                    [ 'text' => 'Lorem ipsum dolor sit amet, cons3' ], 
                                    [ 'text' => 'Lorem ipsum dolor sit amet, cons4' ], 
                                    [ 'text' => 'Lorem ipsum dolor sit amet, cons5' ], 
                                    [ 'text' => 'Lorem ipsum dolor sit amet, cons6' ],
                                ];
                            }
                            $max_rows_1 = count($khoahocdanhchoai)  / 2;

                        ?>
                        [col_inner_1 span="5" span__sm="12" visibility="hide-for-small"]

                            <ul>
                                <?php
                                    if(!empty($khoahocdanhchoai) and is_array($khoahocdanhchoai)){
                                        foreach ($khoahocdanhchoai as $key => $value) {
                                            if(($key +1)<= $max_rows_1){
                                                ?>
                                                    <li class="bullet-checkmark"><?php echo esc_attr($value['text']); ?></li>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </ul>

                        [/col_inner_1]
                        [col_inner_2 span="7" span__sm="12" visibility="hide-for-small"]

                        <ul>
                            <?php
                                if(!empty($khoahocdanhchoai) and is_array($khoahocdanhchoai)){
                                    foreach ($khoahocdanhchoai as $key => $value) {
                                        if(($key +1)> $max_rows_1){
                                            ?>
                                                <li class="bullet-checkmark"><?php echo esc_attr($value['text']); ?></li>
                                            <?php
                                        }
                                    }
                                }
                            ?>
                        </ul>

                        [/col_inner_2]
                        [col_inner_1 span="6" span__sm="12" visibility="show-for-small"]

                            <ul>
                                <?php
                                    if(!empty($khoahocdanhchoai) and is_array($khoahocdanhchoai)){
                                        foreach ($khoahocdanhchoai as $key => $value) {
                                            ?>
                                            <li class="bullet-checkmark"><?php echo esc_attr($value['text']); ?></li>
                                            <?php
                                        }
                                    }
                                ?>
                            </ul>

                        [/col_inner_1]

                    [/row_inner_1]
                    

                    <!-- block 3 -->
                    [divider width="100%" margin="0" height="2px"]

                    [row_inner_2]
                        <?php
                            $thongkekhac = get_field('thongkekhac');
                            if(empty($thongkekhac)){
                                $thongkekhac = [
                                    [
                                        'ztitle' => __('Thời gian học','sconnect'),
                                        'text' => '12',
                                        'unit' => 'buổi'
                                    ],
                                    [
                                        'ztitle' => __('học phí','sconnect'),
                                        'text' => '12000000',
                                        'unit' => 'VNĐ'
                                    ]
                                    ];
                            }
                            if(!empty($thongkekhac) and is_array($thongkekhac)){
                                foreach ($thongkekhac as $key => $value) {
                                    $span = 5;
                                    if(($key)%2 ==1) $span = 7;
                                    ?>
                                        [col_inner_1 span="<?php echo esc_attr($span) ?>" span__sm="12"]

                                        [title text="<?php echo esc_attr($value['ztitle']); ?>" tag_name="h4" class="is-small"]

                                        [ux_text text_color="#008444"]

                                        <p>
                                            <strong>
                                                <span class="count-up" style="font-size: 200%;">
                                                    <?php echo esc_attr($value['text']) ?>
                                                </span> 
                                                <?php echo esc_attr($value['unit']) ?>
                                            </strong>
                                        </p>
                                        [/ux_text]

                                        [/col_inner_1]
                                    <?php
                                }
                            }
                        ?>
                        

                    [/row_inner_2]

                    <!-- block 4 -->
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