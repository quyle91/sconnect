<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Lop\Controller;
class Init {
    public $sync;
    
    function __construct() {
        $this->sync = $this->sync____lop();
    }

    function sync____lop(){
        $sync = new \Adminz\Helper\ADMINZ_Helper_Taxonomy_Sync;
        $sync->taxname = '_lop';
        $sync->post_type = 'lop';
        $sync->init();
        return $sync;
    }

    
}



