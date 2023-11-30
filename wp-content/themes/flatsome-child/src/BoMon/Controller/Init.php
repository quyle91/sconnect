<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\BoMon\Controller;
class Init {
    
    function __construct() {
        
        $this->sync = $this->sync____bo_mon_do_an();
        
    }

    
    

    function sync____bo_mon_do_an(){
        $sync = new \Adminz\Helper\ADMINZ_Helper_Taxonomy_Sync;
        $sync->taxname = '_bo_mon';
        $sync->post_type = 'bo_mon';
        $sync->init();
        return $sync;
    }
}



