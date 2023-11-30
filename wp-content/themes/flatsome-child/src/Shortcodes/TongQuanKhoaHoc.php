<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Shortcodes;
class TongQuanKhoaHoc {
    
    function __construct() {
        $a = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Shortcodes;
        $a->shortcode_name = 'sconnect-tongquan-khoahoc';
        $a->shortcode_title = 'Sconnect Tổng Quan Khoá Học';
        $a->shortcode_callback = function() use($a){
            ob_start();
            $tongquankhoahoc = get_field('tongquankhoahoc');
            if(empty($tongquankhoahoc)){
                $tongquankhoahoc = [
                    [
                        'ztitle' => 'khoá basic',
                        'block' => 1682
                    ],
                    [
                        'ztitle' => 'khoá master',
                        'block' => 1684
                    ],
                ];
            }
            ?>
                [section class="<?php echo sconnect_get_file_class(__FILE__); ?>]
                    [title style="center" text="<?php echo __('Tổng quan khoá học', 'sconnect'); ?>" tag_name="h2"]
                    [tabgroup nav_size="large" align="center"]
                        <?php
                            if(!empty($tongquankhoahoc) and is_array($tongquankhoahoc)){
                                foreach ($tongquankhoahoc as $key => $khoahoc) {
                                    ?>
                                        [tab title="<?php echo esc_attr($khoahoc['ztitle']);?>"] 
                                            [block id="<?php echo esc_attr($khoahoc['block']);?>"]
                                        [/tab]
                                    <?php
                                }
                            }
                        ?>
                    [/tabgroup]
                [/section]
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



