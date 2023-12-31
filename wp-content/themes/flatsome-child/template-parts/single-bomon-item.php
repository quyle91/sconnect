<div class="<?php echo sconnect_get_file_class(__FILE__); ?> term_id_<?php echo esc_attr($args['term_id']); ?>">
    <a href="<?php the_permalink(); ?>">
        <?php
            $avatar = get_field('avatar');
            ?>
            <span class=avatar>
                <?php
                    echo wp_get_attachment_image( 
                        $avatar, 
                        'full', 
                        false, 
                        [
                            'style'=> 'height: 130px; width: auto;'
                        ] 
                    );
                ?>
            </span>

        <?php
            $icon = get_field('icon');
            if(!$icon){ 
                $icon = Sconnect_Default_image;
            }
            ?>
            <span class="icon" style="min-width: 40px; display: inline-block;">
                <?php
                    echo wp_get_attachment_image( 
                        $icon, 
                        'full', 
                        false, 
                        [
                            'style'=> 'height: 26px; width: auto;'
                        ] 
                    );
                ?>
            </span>
            <?php
        ?>
        <span>
            <?php the_title() ?>
        </span>
        <i class="icon-angle-right"></i>
    </a>
</div>