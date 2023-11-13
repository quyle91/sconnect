<div class="single-bomon-item term_id_<?php echo esc_attr($args['term_id']); ?>">
    <a href="<?php the_permalink(); ?>">
        <?php
            if($avatar = get_field('avatar')):
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
            endif;
        ?>

        <?php
            $icon = get_field('icon');
            if(1==1):
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
            endif;
        ?>
        <span>
            <?php the_title() ?>
        </span>
        <i class="icon-angle-right"></i>
    </a>
</div>