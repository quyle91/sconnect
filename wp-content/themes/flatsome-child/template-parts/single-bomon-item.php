<div class="single-bomon-item term_id_<?php echo esc_attr($args['term_id']); ?>">
    <a href="<?php the_permalink(); ?>">
        <?php
            // Ngoại lệ cho 17?
            if($args['term_id'] == 17){
                $avatar = get_field('avatar');
                if(!$avatar){
                    $avatar = 305;
                }
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
            }
        ?>

        <?php
            $icon = get_field('icon');
            if(!$icon){ $icon = 7;}
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