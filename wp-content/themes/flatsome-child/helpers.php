<?php 
/**
Wordpress lỗi excerpt leng ko hoạt động với ajax
https://core.trac.wordpress.org/ticket/59702
============ KO FIX ========================
 */


function sconnect_get_file_class($file){
    $classes = [];
    $filename = wp_basename($file);
    $fileinfo = pathinfo($filename);
    $classes[] = $fileinfo['filename'];

    $classes[] = '__post_type_'.get_post_type();
    $classes[] = '__post_id_'.get_the_ID();
    $classes = apply_filters('sconnect_get_file_class', $classes);
    
    return implode(' ',$classes);
}