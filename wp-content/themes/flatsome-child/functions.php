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

if(!function_exists('get_field')){
    return;
}


add_action( 'after_setup_theme', function () {
    load_child_theme_textdomain( 'sconnect', get_stylesheet_directory() . '/languages' );
} );






define('Sconnect_Url', get_stylesheet_directory_uri());
define('Sconnect_Dir', get_stylesheet_directory());
define('Sconnect_Default_image', 440);

require __DIR__ ."/helpers.php";
require __DIR__ ."/hooks.php";
require __DIR__ ."/vendor/autoload.php";


// Functions
new \Sconnect\Functions\Enqueue;
new \Sconnect\Functions\AutoViewMore;
new \Sconnect\Functions\BannerFlyout;

// Integration
new \Sconnect\Integration\Flatsome;
new \Sconnect\Integration\FlatsomeCustomBlog;
new \Sconnect\Integration\AdministratorZ;
new \Sconnect\Integration\ImageMapPro;

// Woocommerce
new \Sconnect\Woocommerce\AccountPage;

// Post type
$Sconnect_Page = new  \Sconnect\Page\Controller\Init;
$Sconnect_Lop = new  \Sconnect\Lop\Controller\Init;
$Sconnect_Khoa = new  \Sconnect\Khoa\Controller\Init;
$Sconnect_DoAn = new  \Sconnect\DoAn\Controller\Init;
$Sconnect_BoMon = new  \Sconnect\BoMon\Controller\Init;
$Sconnect_HocBong = new  \Sconnect\HocBong\Controller\Init;
$Sconnect_GiangVien = new  \Sconnect\GiangVien\Controller\Init;
$Sconnect_ChuongTrinh = new  \Sconnect\ChuongTrinh\Controller\Init;


// Shortcodes
new \Sconnect\Shortcodes\TrendingTopic;
new \Sconnect\Shortcodes\TuKhoaNoiBat; // custom yes or no?
new \Sconnect\Shortcodes\HoiDongHocThuat;
new \Sconnect\Shortcodes\GiaiDapThacMac;
new \Sconnect\Shortcodes\CauHoiThuongGap;
new \Sconnect\Shortcodes\MapView;
new \Sconnect\Shortcodes\BlogSmall;
new \Sconnect\Shortcodes\DoiNguGiangVien;
new \Sconnect\Shortcodes\GiangVienContent;
new \Sconnect\Shortcodes\PolylangCustomSwitcher;
new \Sconnect\Shortcodes\ChuongTrinhDaoTaoItem;
new \Sconnect\Shortcodes\ChuongTrinhDaoTaoChiTiet;
new \Sconnect\Shortcodes\TestHuongNghiep;
new \Sconnect\Shortcodes\KetQuaTestDISC;
new \Sconnect\Shortcodes\ChuongTrinhDaoTaoKhoa;
new \Sconnect\Shortcodes\GiangVien;
new \Sconnect\Shortcodes\QuyenLoiHocVien;
new \Sconnect\Shortcodes\TongQuanKhoaHoc;
new \Sconnect\Shortcodes\HoTroSauKhoaHoc;
new \Sconnect\Shortcodes\TraCuuDiemThiSA;
