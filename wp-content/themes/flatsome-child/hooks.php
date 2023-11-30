<?php 
/**
 * Hook thay đổi wordpress
 */


add_filter( 'excerpt_length', function($return){
    if(get_post_type() == 'giang_vien'){
        return 25;
    }    
    return $return;
} );