<a href="<?php the_permalink(); ?>">
    <div class="single-hoidonghocthuat-item row row-collapse row-equal">
        <div class="col small-12 large-6 left ">
            <div class="col-inner">
                <?php
                    echo get_the_post_thumbnail(  )
                ?>
            </div>
        </div>
        <div class="col small-12 large-6 right dark bgr-zzzz-9999 ThongTinThanhVien ">
            <div class="col-inner">
                <p class="mb-half h4 ten-giang-vien">
                    <?php the_title() ?>
                </p>
                <div class="mb-half meta vitri">
                    <?php 
                        echo get_field('vitri');
                    ?>
                </div>
                <div class="mb-half meta thanhtuukhac">
                    <?php 
                        echo get_field('thanhtuukhac');
                    ?>
                </div>
                <div class="mb-half meta kinhnghiemgiangday">
                    <?php
                        echo get_field('kinhnghiemgiangday')
                    ?>
                </div>
            </div>
        </div>
    </div>
</a>