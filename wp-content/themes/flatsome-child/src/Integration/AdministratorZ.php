<?php
namespace Sconnect\Integration;
class AdministratorZ {
    
    function __construct() {
        $this->setup_banner_helper();
        $this->setup_banner_doan();
        $this->setup_css_round_pack();
    }

    function setup_css_round_pack(){
        /* :root {
            --big-radius: <?php echo apply_filters('adminz_pack1_big-radius','10px'); ?>;
            --small-radius: <?php echo apply_filters('adminz_pack1_small-radius','5px'); ?>;
            --form-controls-rarius: <?php echo apply_filters('adminz_pack1_form-controls-radius','5px'); ?>;;
            --main-gray: <?php echo apply_filters('adminz_pack1_main-gray','#0000000a'); ?>;
            --border-color: <?php echo apply_filters('adminz_pack1_border-color','transparent'); ?>;
        } */
        add_filter('adminz_pack1_big-radius', function(){
            return '6px';
        });
        add_filter('adminz_pack1_small-radius', function(){
            return '6px';
        });
        add_filter('adminz_pack1_enable_sidebar', function(){
            return false;
        });
    }
    
    function setup_banner_helper(){
        $sa = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Acf_Banner;
        $sa->init();
        
    }

    function setup_banner_doan(){
        add_action('adminz_acf_banner_after', function($obj){            
            ob_start();
                $video = get_field('video_preview');
                $gallery = get_field('gallery');

                if($video){
                ?>
                    [row h_align="center"]
                        [col span="9" span__sm="12"]
                            [ux_video url="<?php echo esc_url($video);?>"]
                        [/col]
                    [/row]
                <?php
                }

                if($gallery and !$video){
                    ?>
                    [row h_align="center"]
                        [col span="9" span__sm="12"]
                            <?php
                                if(!empty($gallery) and is_array($gallery)){
                                    ?>
                                    [ux_slider class="gallery-doan"]
                                        <?php
                                            foreach ($gallery as $key => $id) {
                                                ?>
                                                [ux_image id="439" height="56.25%"]
                                                <?php
                                            }
                                        ?>
                                    [/ux_slider]
                                    [gap height="8px"]
                                    [adminz_slider_custom slide_width="16.67%" slide_width__sm="33%" slide_width__md="25%" as_nav_for=".gallery-doan" slide_item_padding="4px" slide_align="left"]
                                        <?php
                                            foreach ($gallery as $key => $id) {
                                                ?>
                                                [adminz_slider_custom_item_wrap]
                                                    [ux_image id="437" height="56.25%"]
                                                [/adminz_slider_custom_item_wrap]
                                                <?php
                                            }
                                        ?>
                                    [/adminz_slider_custom]
                                    <?php                                    
                                }
                            ?>
                        [/col]
                    [/row]
                    <?php
                }
            echo ob_get_clean();
        },10,1);
    }
}
