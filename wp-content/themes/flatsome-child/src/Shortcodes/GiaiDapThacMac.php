<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class GiaiDapThacMac {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-giaidapthacmac';
        $a->shortcode_title = 'Sconnect Giải đáp thắc mắc';
        $a->shortcode_callback = function() use($a){
            // sử dụng element tab
            
            ob_start();
            ?>
            <div class="<?php echo sconnect_get_file_class(__FILE__); ?>">
                <div class="row">
                <?php
                    $option = get_field('giai_dap_thac_mac_pho_bien','option');
                    $data = $option['data'];
                    $form = $option['form'];

                    if(!empty($data) and is_array($data)){
                        ?>
                        <div class="data col">
                            <?php
                                echo '[tabgroup style="simple" type="vertical" class="giaidapthacmacphobien"]';
                                $icon_array = [];
                                foreach ($data as $key => $item) {
                                    $icon_array[] = $item['icon'];
                                    ?>
                                    [tab title="<?php echo esc_attr($item['title']) ?>"]
                                        <?php echo '[block id="'.$item['content'].'"]' ?>
                                    [/tab]
                                    <?php
                                }
                                echo '[/tabgroup]';
                                echo '[adminz_tab_icons tab_class="giaidapthacmacphobien" ids="'.implode(",",$icon_array).'"]';
                            ?>
                        </div>
                        <?php
                    }


                    if($form){
                        ?>
                        <div class="form col">
                            [row class="row-nopaddingbottom"]
                                [col span__sm="12" padding="15px 15px 15px 15px" bg_color="var(--xanh-nhat)"]
                                    [title icon="icon-angle-right" text="<?php echo esc_attr($option['form_title']) ?>"]
                                    [contact-form-7 id="<?php echo esc_attr($form) ?>"]
                                [/col]
                            [/row]
                        </div>
                        <?php
                    }

                ?>
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

    }
}



