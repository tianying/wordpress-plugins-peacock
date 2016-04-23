<?php


// 定义站点公告内容页面
function news_include_template_function( $template_path ) {
    if ( get_post_type() == 'news' ) {
        if ( is_single() ) {

            if ( $theme_file = locate_template( array ( 'template/news-content.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . 'template/news-content.php';
            }
        }
        else {

        }
    }
    return $template_path;
}

add_filter( 'template_include', 'news_include_template_function', 1 );

// 定义山里生活内容页面
function responsibility_include_template_function( $template_path ) {
    if ( get_post_type() == 'responsibility' ) {
        if ( is_single() ) {

            if ( $theme_file = locate_template( array ( 'template/responsibility-content.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . 'template/responsibility-content.php';
            }
        }
        else {

        }
    }
    return $template_path;
}

add_filter( 'template_include', 'responsibility_include_template_function', 1 );
