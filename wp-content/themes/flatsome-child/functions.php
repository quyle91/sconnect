<?php 
/**
Sprint 1: 
    làm Frontend nhưng ko có Css, 
    Dùng ảnh placeholder, 
    làm white frame, 
    Build ACF, custom post type để làm frontend

Sprint 2: 
    "Code backend cho các chức năng như form
    tạo logic"

Sprint 3:
    "Css
    Tối ưu lại acf, Site option
    Bổ sung các element còn thiếu"

Sprint 4:
    Xem feedback và fix lỗi

*/



defined( 'ABSPATH' ) || exit;

if(!function_exists('WC')){
    return;
}

if(!defined( 'ADMINZ' )){
    return;
}


add_action( 'after_setup_theme', function () {
    load_child_theme_textdomain( 'sconnect', get_stylesheet_directory() . '/languages' );
} );






define('Sconnect_Url', get_stylesheet_directory_uri());
define('Sconnect_Dir', get_stylesheet_directory());

require __DIR__ ."/helpers.php";
require __DIR__ ."/hooks.php";
require __DIR__ ."/vendor/autoload.php";


// Functions
new \Sconnect\Functions\Enqueue;
new \Sconnect\Functions\AutoViewMore;
new \Sconnect\Functions\BannerFlyout;

// Shortcodes
new \Sconnect\Shortcodes\TrendingTopic;
new \Sconnect\Shortcodes\HoiDongHocThuat;
new \Sconnect\Shortcodes\GiaiDapThacMac;
new \Sconnect\Shortcodes\MapView;
new \Sconnect\Shortcodes\BlogSmall;
new \Sconnect\Shortcodes\DoiNguGiangVien;
new \Sconnect\Shortcodes\GiangVienContent;
new \Sconnect\Shortcodes\PolylangCustomSwitcher;

// Integration
new \Sconnect\Integration\Flatsome;
new \Sconnect\Integration\FlatsomeCustomBlog;
new \Sconnect\Integration\AdministratorZ;
new \Sconnect\Integration\ImageMapPro;

// Woocommerce
new \Sconnect\Woocommerce\AccountPage;

// Post type
new  \Sconnect\DoAn\Controller\Init;
new  \Sconnect\BoMon\Controller\Init;
new  \Sconnect\HocBong\Controller\Init;
new  \Sconnect\GiangVien\Controller\Init;
new  \Sconnect\KhoaHoc\Controller\Init;