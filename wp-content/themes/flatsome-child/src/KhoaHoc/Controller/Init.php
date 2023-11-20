<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\KhoaHoc\Controller;
class Init {
    
    function __construct() {
        $this->sync____chuong_trinh();
    }

    function sync____chuong_trinh(){
        $sync = new \Adminz\Helper\ADMINZ_Helper_Taxonomy_Sync;
        $sync->taxname = 'chuong_trinh';
        $sync->post_type = 'khoa_hoc';
        $sync->init();
    }

    
}



