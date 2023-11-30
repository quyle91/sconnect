<?php 
    $__post_id = get_the_ID();
?>
[col span="4" span__sm="12" color="light" class="<?php echo sconnect_get_file_class(__FILE__); ?>"]

    [title style="center" text="<?php echo get_the_title($__post_id); ?>" class="ztitle"]
    <style type="text/css">
        <?php
            $icon = wp_get_attachment_image_src(get_field('icon'),'thumbnail');
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

    [ux_image id="7" height="56.25%"]

    <ul>
        <?php
            $khoahocdanhchoai = get_field('khoahocdanhchoai', $__post_id);
            if(empty($khoahocdanhchoai)){
                $khoahocdanhchoai = [
                    ['text'=>'Khóa học dành cho ai'],
                    ['text'=>'Lợi ích đầu ra là gì'],
                    ['text'=>'USP'],
                ];
            }

            if(!empty($khoahocdanhchoai) and is_array($khoahocdanhchoai)){
                foreach ($khoahocdanhchoai as $key => $value) {
                    ?>
                    <li class="bullet-checkmark">
                        <?php echo esc_attr($value['text']) ?>
                    </li>
                    <?php
                }
            }
        ?>
    </ul>
    [button class="mb-0" text="<?php echo __('Tìm hiểu thêm', 'sconnect'); ?>" expand="true" link="<?php echo get_the_permalink($__post_id); ?>"]
[/col]
