<?php
namespace Sconnect\Integration;
class ImageMapPro {
    
    public function __construct() {
        add_action( 'admin_menu', [$this, 'kh_add_menu_page'] );
        add_action( 'admin_enqueue_scripts', [$this, 'add_stype_image_map_admin'] );
        

        if( function_exists('acf_add_options_page') ) {
            acf_add_options_page(
                array(
                    'menu_title' => __('Thông tin tòa nhà', 'sconnect'),
                    'page_title'    => __('Thông tin tòa nhà', 'sconnect'),
                    'menu_slug'     => 'info-building',
                    'capability' => 'edit_posts',
                    'position' => 3,
                    'icon_url' => 'dashicons-building',
                    'redirect' => true,
                    'post_id' => 'building',
                )
            );

            add_filter( 'acf/load_field/name=choose_bulding', [$this, 'my_acf_load_field'] );
        }
    }

    public function kh_add_menu_page() {
        add_menu_page(
            __( 'Bản đồ vị trí', 'sconnect' ),
            'Bản đồ vị trí',
            'edit_posts',
            'map-editor', // Unique identifier
            [$this, 'kh_map_editor'], // Callback function to get the contents
            'dashicons-location',
            2
        );
    }

    public function kh_map_editor() {
        echo '<script type="text/javascript">window.location = "/wp-admin/plugins.php?page=image-map-pro-wordpress";</script>';
    }

    public function my_acf_load_field( $field ) {
        $map_pro = get_option('image-map-pro-wordpress-admin-options');
        if (empty($map_pro['saves'])) return $field;

        $field['choices'] = array();

        $saved = $map_pro['saves'];
        $json = $saved[$map_pro['last_save_id']];

        $json = str_replace('\\\n', "", $json); // Remove new line characters inside tooltip contents
        $json = str_replace('\"', '"', $json); // Replace \" with "
        $json = str_replace("\\'", "'", $json); // Replace \' with '
        $json = str_replace('\\\"', '\"', $json); // Replace \\" with \"

        $json_str = $json['json'];
        $parsed = json_decode($json_str, true);

        $value = '';
        $label = '-----'.__('Chọn tòa nhà', 'sconnect').'-----';
        // append to choices
        $field['choices'][ $value ] = $label;
        foreach ($parsed['spots'] as $spot) {
            $value = $spot['id'];
            $label = $spot['title'];
            
            // append to choices
            $field['choices'][ $value ] = $label;
        }
        return $field;
    }

    public function add_stype_image_map_admin() {
        if(isset( $_GET['page']) && $_GET['page'] == 'image-map-pro-wordpress') {
            wp_register_style('image-map-admin', Sconnect_Url . "/assets/css/admin/image-map-admin.css", false, 'all');
            wp_enqueue_style('image-map-admin');
        }
    }

}
