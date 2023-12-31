<?php
// class test. Tạo 1 file Test.php trong folder src/Controller
namespace Sconnect\Page\Controller;
class Init {
    
    function __construct() {
        $this->create_widget_single_page();      
        $this->create_widget_single_blog();      
        
    }

    function create_widget_single_page(){
        register_sidebar( array(
            'name'          => __( 'Page detail', 'sconnect' ),
            'id'            => 'page-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<span class="widget-title page-sidebar">',
            'after_title'   => '</span><div class="is-divider small"></div>',
        ) );
    }
    
    function create_widget_single_blog(){
        register_sidebar( array(
            'name'          => __( 'Blog Sidebar', 'sconnect' ),
            'id'            => 'blog-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<span class="widget-title page-sidebar blog-sidebar">',
            'after_title'   => '</span><div class="is-divider small"></div>',
        ) );
    }
}



