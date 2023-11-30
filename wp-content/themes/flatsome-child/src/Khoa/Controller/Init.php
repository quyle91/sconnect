<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Khoa\Controller;
class Init {
    public $sync;
    
    function __construct() {
        $this->sync = $this->sync____khoa();
    }

    function sync____khoa(){
        $sync = new \Adminz\Helper\ADMINZ_Helper_Taxonomy_Sync;
        $sync->taxname = '_khoa';
        $sync->post_type = 'khoa';
        $sync->init();
        return $sync;
    }

    
}



