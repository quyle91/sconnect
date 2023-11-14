<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class MapView {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-mapview';
        $a->shortcode_title = 'Sconnect Map View';

        add_action( 'wp_enqueue_scripts', [$this, 'add_stype_image_map_frontend'] );

        $a->shortcode_callback = function() use($a){
            ob_start();
            ?>
            <div class="mapview">
                <div class="kh_map_container">
                    <?php echo do_shortcode('[Sconnect-MapView]') ?>
                    <div class="kh_list_building">
                        <?php  
                        if (have_rows('buildings', 'building')) {
                            while (have_rows('buildings', 'building')) {
                                the_row();
                                $choose_bulding = get_sub_field('choose_bulding');
                                // print_r($choose_bulding);
                                
                                ob_start();
                                ?>
                                <div class="kh_item_building">
                                    <div class="modal-content">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="far fa-times"></i></button>
                                        <div class="modal-body">
                                            <div class="kh_inner_building row">
                                                <figure class="kh_avt_building col-md-6 col-sm-12">
                                                    <img src="<?php the_sub_field('avt_building') ?>" class="img-fluid" alt="<?php echo $choose_bulding['label'] ?>">
                                                </figure>
                                                <div class="kh_info_building col-md-6 col-sm-12">
                                                    <div class="kh_inner_info">
                                                        <div class="kh_title_building"><img src="<?php echo Sconnect_Url.'/assets/images/default.png' ?>" class="img-fluid"><?php echo $choose_bulding['label'] ?></div>
                                                        <div class="kh_des_building"><?php the_sub_field('des_building') ?></div>
                                                        <a href="javascript:void(0)" class="kh_open_paroname" data-src="<?php the_sub_field('img_panorama') ?>"><?php _e('Khám phá', 'sconnect') ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $building_content = ob_get_clean();
                                echo do_shortcode('[button text="" class="hidden map_open_lightbox btn-'.$choose_bulding['value'].'" link="#kh-'.$choose_bulding['value'].'"][lightbox id="kh-'.$choose_bulding['value'].'" width="600px" padding="20px"]'.$building_content.'[/lightbox]');
                            }
                        }
                        ?>
                    </div>
                    <div id="kh_paronama"></div>
                </div>
            </div>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photo-sphere-viewer@4/dist/photo-sphere-viewer.min.css"/>
            <script src="https://cdn.jsdelivr.net/npm/three/build/three.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/uevent@2/browser.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/photo-sphere-viewer@4/dist/photo-sphere-viewer.min.js"></script>
            <style type="text/css">
                .mapview{

                }
            </style>
            <?php
            return ob_get_clean();
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

    public function add_stype_image_map_frontend() {
        wp_register_style( 'image-map-style', Sconnect_Url . "/assets/css/image-map.css", [], null, 'all' );
        wp_enqueue_style('image-map-style');  

        wp_register_script( 'image-map-script', Sconnect_Url  . "/assets/js/image-map.js", array('jquery'), '', true );
        wp_enqueue_script('image-map-script');
    }
}



