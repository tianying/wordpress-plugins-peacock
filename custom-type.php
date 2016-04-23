<?php

add_action( 'init', array( 'news', 'init' ) );

// Define custom modules
function custom_post_news() {
  $labels = array(
    'name'               => _x( '新闻动态', '' ),
    'singular_name'      => _x( '新闻动态', '' ),
    'add_new'            => _x( '新建新闻动态', '添加新内容的链接名称' ),
    'add_new_item'       => __( '新建一个新闻动态' ),
    'edit_item'          => __( '编辑新闻动态' ),
    'new_item'           => __( '新新闻动态' ),
    'all_items'          => __( '所有新闻动态' ),
    'view_item'          => __( '查看新闻动态' ),
    'search_items'       => __( '搜索新闻动态' ),
    'not_found'          => __( '没有找到有关新闻动态' ),
    'not_found_in_trash' => __( '回收站里面没有相关新闻动态' ),
    'parent_item_colon'  => '',
    'menu_name'          => '新闻动态'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => '新闻动态',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive'   => true
  );
  register_post_type( 'news', $args );
}
add_action( 'init', 'custom_post_news' );

// Add Taxonomy Classification
function taxonomies_news_classification() {
  $labels = array(
    'name'              => _x( '新闻动态分类', '' ),
    'singular_name'     => _x( '分类', '' ),
    'search_items'      => __( '搜索分类' ),
    'all_items'         => __( '所有分类' ),
    'parent_item'       => __( '该分类的上级分类' ),
    'parent_item_colon' => __( '该分类的上级分类：' ),
    'edit_item'         => __( '编辑分类' ),
    'update_item'       => __( '更新分类' ),
    'add_new_item'      => __( '添加新的分类' ),
    'new_item_name'     => __( '新分类' ),
    'menu_name'         => __( '分类' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'news_category', 'news', $args );
}
add_action( 'init', 'taxonomies_news_classification', 0 );

add_action( 'init', array( 'responsibility', 'init' ) );

// Define custom modules
function custom_post_responsibility() {
  $labels = array(
    'name'               => _x( '社会责任', '' ),
    'singular_name'      => _x( '社会责任', '' ),
    'add_new'            => _x( '新建社会责任', '添加新内容的链接名称' ),
    'add_new_item'       => __( '新建一个社会责任' ),
    'edit_item'          => __( '编辑社会责任' ),
    'new_item'           => __( '新社会责任' ),
    'all_items'          => __( '所有社会责任' ),
    'view_item'          => __( '查看社会责任' ),
    'search_items'       => __( '搜索社会责任' ),
    'not_found'          => __( '没有找到有关社会责任' ),
    'not_found_in_trash' => __( '回收站里面没有相关社会责任' ),
    'parent_item_colon'  => '',
    'menu_name'          => '社会责任'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => '社会责任信息',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive'   => true
  );
  register_post_type( 'responsibility', $args );
}
add_action( 'init', 'custom_post_responsibility' );

add_action( 'init', array( 'culture', 'init' ) );

// Define custom modules
function custom_post_culture() {
  $labels = array(
    'name'               => _x( '企业文化', '' ),
    'singular_name'      => _x( '企业文化', '' ),
    'add_new'            => _x( '新建企业文化', '添加新内容的链接名称' ),
    'add_new_item'       => __( '新建一个企业文化' ),
    'edit_item'          => __( '编辑企业文化' ),
    'new_item'           => __( '新企业文化' ),
    'all_items'          => __( '所有企业文化' ),
    'view_item'          => __( '查看企业文化' ),
    'search_items'       => __( '搜索企业文化' ),
    'not_found'          => __( '没有找到有关企业文化' ),
    'not_found_in_trash' => __( '回收站里面没有相关企业文化' ),
    'parent_item_colon'  => '',
    'menu_name'          => '企业文化'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => '企业文化信息',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive'   => true
  );
  register_post_type( 'culture', $args );
}
add_action( 'init', 'custom_post_culture' );
