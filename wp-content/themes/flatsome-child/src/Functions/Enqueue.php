<?php

<<<<<<< Updated upstream
            if(!isset($_GET['dev'])){
                wp_enqueue_style( 'tai-custom-style', Sconnect_Url."/assets/css/__tai-custom-style.css", [], null, 'all' );
                wp_enqueue_style( 'tai-base-css', Sconnect_Url."/assets/css/__tai-base-css.css", [], null, 'all' );
            }
            
        } );
    }
=======
namespace Sconnect\Functions;

class Enqueue
{

  function __construct()
  {
    add_action('wp_enqueue_scripts', function () {

      wp_enqueue_style('sconnect-base', Sconnect_Url . "/assets/css/base.css", [], null, 'all');
      wp_enqueue_style('sconnect-base-woo', Sconnect_Url . "/assets/css/base-woo.css", [], null, 'all');

      if (!isset($_GET['dev'])) {
        wp_enqueue_style('tai-custom-style', Sconnect_Url . "/assets/css/tai-custom-style.css", [], null, 'all');
        wp_enqueue_style('tai-base-css', Sconnect_Url . "/assets/css/tai-base-css.css", [], null, 'all');
        wp_enqueue_style('quan-css', Sconnect_Url . "/assets/css/quan.css", [], null, 'all');
      }
    });
  }
>>>>>>> Stashed changes
}
