<?php


$life_seo_meta_boxs = array (
	'id' => 'life-seo-information',
	'title' => 'SEO 信息',
	'callback'  => 'life_seo_meta_box',
	'screen' => 'news',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array (array (
		'key' => 'field_56c1c4480662b',
		'label' => '标题',
		'name' => 'title',
		'type' => 'text',
		'default_value' => '',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'formatting' => 'none',
		'maxlength' => '',
		),
		array (
		'key' => 'field_56c1c33006629',
		'label' => '关键词',
		'name' => 'keywords',
		'type' => 'text',
		'instructions' => 'SEO 关键词。关键词之间用,号分隔。',
		'default_value' => '',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '',
		),
		array (
		'key' => 'field_56c1c3da0662a',
		'label' => '描述',
		'name' => 'description',
		'type' => 'textarea',
		'instructions' => '网页描述。在180个字以内。',
		'default_value' => '',
		'placeholder' => '',
		'maxlength' => '',
		'rows' => '',
		'formatting' => 'br',
		),
		array (
		'key' => 'field_56c1c3da0257c',
		'label' => '作者',
		'name' => 'author',
		'type' => 'text',
		'instructions' => '作者。',
		'default_value' => '',
		'placeholder' => '',
		'maxlength' => '',
		'rows' => '',
		'formatting' => 'br',
		),
	),
	'location' => array (
		array (
		array (
			'param' => 'post_type',
			'operator' => '==',
			'value' => 'post',
			'order_no' => 0,
			'group_no' => 0,
		),
		),
	),
	'options' => array (
		'position' => 'normal',
		'layout' => 'default',
		'hide_on_screen' => array (
		),
	),
	'menu_order' => 0
);

function seo_meta_box_add()
{
	global $life_seo_meta_boxs;
	add_meta_box( $life_seo_meta_boxs['id'], $life_seo_meta_boxs['title'], $life_seo_meta_boxs['callback'], $life_seo_meta_boxs['screen'], $life_seo_meta_boxs['context'], $life_seo_meta_boxs['priority'] );
}
add_action( 'add_meta_boxes', 'seo_meta_box_add' );

function life_seo_meta_box( $post )
{

	global $life_seo_meta_boxs;
 
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('my-upload');
    wp_enqueue_style('thickbox');  

	create_from_code( $define = $life_seo_meta_boxs, $catid = $post -> ID);

}

$life_create_from_save_template = '
	function FUNCTIONNAME( $post_id ) {

		global DEFINE;

		// 安全检查
		// 检查是否发送了一次性隐藏表单内容（判断是否为第三者模拟提交）
		if ( ! isset( $_POST[DEFINE["name"]."_nonce"] ) ) {
		    return;
		}
		// 判断隐藏表单的值与之前是否相同
		if ( ! wp_verify_nonce( $_POST[DEFINE["name"]."_nonce"], DEFINE["name"] ) ) {
		    return;
		}
		// 判断该用户是否有权限
		if ( ! current_user_can( "edit_post", $post_id ) ) {
		    return;
		}

		   foreach (DEFINE["fields"] as $value) {

		           // 判断 Meta Box 是否为空
		           if ( ! isset( $_POST[$value["name"]] ) ) {
		               return;
		           }

		           DEFINE_fields = sanitize_text_field( $_POST[$value["name"]] );
		           update_post_meta( $post_id, $value["name"]."_value", DEFINE_fields );

		   }

	}
	 
	add_action("save_post", "FUNCTIONNAME");
	';


$old_str = array (
	'FUNCTIONNAME', 'DEFINE'
);
$new_str = array (
	'life_seo_meta_box_save', '$life_seo_meta_boxs'
);

eval(''.str_replace($old_str, $new_str, $life_create_from_save_template));

$life_index_images_meta_boxs = array (
	'id' => 'life-index-images',
	'title' => '首页调用信息',
	'callback'  => 'life_index_images_meta_box',
	'screen' => 'life',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array (array (
		'id' => 'index_life_images',
		'button_id' => 'field_life_images_button',
		'label' => '缩略图: 尺寸大小 50 X 50',
		'name' => 'index_life_images',
		'type' => 'image',
		'instructions' => '首页调用',
		'default_value' => '',
		'placeholder' => '尺寸大小 50 X 50',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '',
		)
	),
	'location' => array (
		array (
		array (
			'param' => 'post_type',
			'operator' => '==',
			'value' => 'post',
			'order_no' => 0,
			'group_no' => 0,
		),
		),
	),
	'options' => array (
		'position' => 'normal',
		'layout' => 'default',
		'hide_on_screen' => array (
		),
	),
	'menu_order' => 0
);

function life_index_meta_box_add()
{
	global $life_index_images_meta_boxs;
	add_meta_box( $life_index_images_meta_boxs['id'], $life_index_images_meta_boxs['title'], $life_index_images_meta_boxs['callback'], $life_index_images_meta_boxs['screen'], $life_index_images_meta_boxs['context'], $life_index_images_meta_boxs['priority'] );
}
add_action( 'add_meta_boxes', 'life_index_meta_box_add' );

function life_index_images_meta_box( $post )
{

	global $life_index_images_meta_boxs;
 
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('my-upload');
    wp_enqueue_style('thickbox');  

	create_from_code( $define = $life_index_images_meta_boxs, $catid = $post -> ID);

}

$index_life_images_create_from_save_template = '
	function FUNCTIONNAME( $post_id ) {

		global DEFINE;

		// 安全检查
		// 检查是否发送了一次性隐藏表单内容（判断是否为第三者模拟提交）
		if ( ! isset( $_POST[DEFINE["name"]."_nonce"] ) ) {
		    return;
		}
		// 判断隐藏表单的值与之前是否相同
		if ( ! wp_verify_nonce( $_POST[DEFINE["name"]."_nonce"], DEFINE["name"] ) ) {
		    return;
		}
		// 判断该用户是否有权限
		if ( ! current_user_can( "edit_post", $post_id ) ) {
		    return;
		}

		   foreach (DEFINE["fields"] as $value) {

		           // 判断 Meta Box 是否为空
		           if ( ! isset( $_POST[$value["name"]] ) ) {
		               return;
		           }

		           DEFINE_fields = sanitize_text_field( $_POST[$value["name"]] );
		           update_post_meta( $post_id, $value["name"]."_value", DEFINE_fields );

		   }

	}
	 
	add_action("save_post", "FUNCTIONNAME");
	';


$old_str = array (
	'FUNCTIONNAME', 'DEFINE'
);
$new_str = array (
	'life_index_images_meta_box_save', '$life_index_images_meta_boxs'
);

eval(''.str_replace($old_str, $new_str, $index_life_images_create_from_save_template));

$culture_index_images_meta_boxs = array (
	'id' => 'culture-index-images',
	'title' => '首页调用信息',
	'callback'  => 'culture_index_images_meta_box',
	'screen' => 'culture',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array (array (
		'id' => 'index_culture_images',
		'button_id' => 'field_culture_images_button',
		'label' => '缩略图: 尺寸大小 65 X 65',
		'name' => 'index_culture_images',
		'type' => 'image',
		'instructions' => '首页调用',
		'default_value' => '',
		'placeholder' => '尺寸大小 65 X 65',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '',
		)
	),
	'location' => array (
		array (
		array (
			'param' => 'post_type',
			'operator' => '==',
			'value' => 'post',
			'order_no' => 0,
			'group_no' => 0,
		),
		),
	),
	'options' => array (
		'position' => 'normal',
		'layout' => 'default',
		'hide_on_screen' => array (
		),
	),
	'menu_order' => 0
);

function culture_index_meta_box_add()
{
	global $culture_index_images_meta_boxs;
	add_meta_box( $culture_index_images_meta_boxs['id'], $culture_index_images_meta_boxs['title'], $culture_index_images_meta_boxs['callback'], $culture_index_images_meta_boxs['screen'], $culture_index_images_meta_boxs['context'], $culture_index_images_meta_boxs['priority'] );
}
add_action( 'add_meta_boxes', 'culture_index_meta_box_add' );

function culture_index_images_meta_box( $post )
{

	global $culture_index_images_meta_boxs;
 
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('my-upload');
    wp_enqueue_style('thickbox');  

	create_from_code( $define = $culture_index_images_meta_boxs, $catid = $post -> ID);

}

$index_culture_images_create_from_save_template = '
	function FUNCTIONNAME( $post_id ) {

		global DEFINE;

		// 安全检查
		// 检查是否发送了一次性隐藏表单内容（判断是否为第三者模拟提交）
		if ( ! isset( $_POST[DEFINE["name"]."_nonce"] ) ) {
		    return;
		}
		// 判断隐藏表单的值与之前是否相同
		if ( ! wp_verify_nonce( $_POST[DEFINE["name"]."_nonce"], DEFINE["name"] ) ) {
		    return;
		}
		// 判断该用户是否有权限
		if ( ! current_user_can( "edit_post", $post_id ) ) {
		    return;
		}

		   foreach (DEFINE["fields"] as $value) {

		           // 判断 Meta Box 是否为空
		           if ( ! isset( $_POST[$value["name"]] ) ) {
		               return;
		           }

		           DEFINE_fields = sanitize_text_field( $_POST[$value["name"]] );
		           update_post_meta( $post_id, $value["name"]."_value", DEFINE_fields );

		   }

	}
	 
	add_action("save_post", "FUNCTIONNAME");
	';


$old_str = array (
	'FUNCTIONNAME', 'DEFINE'
);
$new_str = array (
	'culture_index_images_meta_box_save', '$culture_index_images_meta_boxs'
);

eval(''.str_replace($old_str, $new_str, $index_culture_images_create_from_save_template));
