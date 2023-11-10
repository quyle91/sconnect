<?php 
add_action( 'wp_ajax_ajax_custom_blog_posts', 'ajax_custom_blog_posts' );
add_action( 'wp_ajax_nopriv_ajax_custom_blog_posts', 'ajax_custom_blog_posts' );
function ajax_custom_blog_posts(){
    ob_start();
    echo do_shortcode(str_replace("\'", '"', sanitize_text_field($_POST['shortcode'])));
    $html = ob_get_clean();
    wp_send_json_success($html);
    wp_die();
}