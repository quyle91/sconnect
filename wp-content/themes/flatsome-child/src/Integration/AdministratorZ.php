<?php
namespace Sconnect\Integration;
class AdministratorZ {
    
    function __construct() {
        $this->setup_banner_helper();
    }
    
    function setup_banner_helper(){
        $sa = new \Adminz\Helper\ADMINZ_Helper_Flatsome_Acf_Banner;
        $sa->init();
    }
}
