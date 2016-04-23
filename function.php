<?php


function custom_fields_enqueue() {
    wp_enqueue_script( 'images-upload', plugin_dir_url( __FILE__ ) . 'upload.js' );
}
add_action( 'admin_enqueue_scripts', 'custom_fields_enqueue' );


function create_from_code( $define, $catid ) {

	// 创建临时隐藏表单，为了安全
    wp_nonce_field( $define['name'], $define['name'].'_nonce' );

	foreach ($define['fields'] as $value) {
		echo '<h4>'.$value['label'].'</h4>';

		// 获取之前存储的值
		$get_fields_value = get_post_meta( $catid, $value['name'].'_value', true);

		if ( $value['type'] == 'text' ) {			
			if ( $get_fields_value == null && $value['default_value'] != null ) {
				echo '<div><input type="text" id="'.$value['id'].'" name="'.$value['name'].'" class="form-control" size="40" value="'.$value['default_value'].'" placeholder="'.$value['placeholder'].'" style="width: 100%;"></div>';
			} else {
				echo '<div><input type="text" id="'.$value['id'].'" name="'.$value['name'].'" class="form-control" size="40" value="'.$get_fields_value.'" placeholder="'.$value['placeholder'].'" style="width: 100%;"></div>';
			}	
		} elseif ( $value['type'] == 'select' ) {
			if ( $get_fields_value == null && $value['default_value'] != null ) { ?>
				<select id="<?php echo $value['id']; ?>" name="<?php echo $value['name']; ?>" class="postform" style="width: 30%;">
					<?php  eval('echo '.$value['calls_default_value']) ?>
				</select>
			<?php } else {  ?>
				<select id="<?php echo $value['id']; ?>" name="<?php echo $value['name']; ?>" class="postform" style="width: 30%;">
					<?php  eval('echo '.$value['calls_get_value']) ?>
				</select>
			<?php }	  	
		} elseif ( $value['type'] == 'checkbox' ) {
			if ( $get_fields_value == null && $value['default_value'] != null ) { ?>
				<div class="form-box">
				</div>
			<?php } else {  ?>
				<div class="form-box">
				</div>
			<?php }	
		} elseif ( $value['type'] == 'image' ) {
			if ( $get_fields_value == null && $value['default_value'] != null ) { ?>
				<input id="<?php echo $value['id']; ?>" class="text" type="text" size="40"  name="<?php echo $value['name']; ?>" value="<?php echo $value['default_value']; ?>"/>
				<input id="<?php echo $value['button_id']; ?>" class="button" type="button" value="上传"/>'
				<script> imagesUpdate("<?php echo '#'.$value['id']; ?>", "<?php echo '#'.$value['button_id']; ?>"); </script>
			<?php } else {  ?>
				<input id="<?php echo $value['id']; ?>" class="text" type="text" size="40"  name="<?php echo $value['name']; ?>" value="<?php echo $get_fields_value; ?>"/>
				<input id="<?php echo $value['button_id']; ?>" class="button" type="button" value="上传"/>			
				<script> imagesUpdate("<?php echo '#'.$value['id']; ?>", "<?php echo '#'.$value['button_id']; ?>"); </script>
			<?php }	
		} elseif ( $value['type'] == 'textarea' ) {
			if ( $get_fields_value == null && $value['default_value'] != null ) {
				echo '<textarea rows="1" cols="40" id="'.$value['id'].'" name="'.$value['name'].'" style="width: 100%; height: 4em;">'.$value['default_value'].'</textarea>';
			} else {
				echo '<textarea rows="1" cols="40" id="'.$value['id'].'" name="'.$value['name'].'" style="width: 100%; height: 4em;">'.$get_fields_value.'</textarea>';
			}				
		} elseif ( $value['type'] == 'editor' ) {
			if ( $get_fields_value == null && $value['default_value'] != null ) {
				wp_editor(
					$value['default_value'], 
					$value['name'].'_value', 
					$settings = array(
						quicktags=>0,//取消html模式
						tinymce=>1,//可视化模式  
						media_buttons=>0,//取消媒体上传  
						textarea_rows=>5,//行数设为5  
						textarea_name=>$value['name'],
						editor_class=>""
						) 
				);
			} else {
				wp_editor(
					$get_fields_value, 
					$value['name'].'_value', 
					$settings = array(
						quicktags=>0,//取消html模式
						tinymce=>1,//可视化模式  
						media_buttons=>0,//取消媒体上传  
						textarea_rows=>5,//行数设为5  
						textarea_name=>$value['name'],
						editor_class=>""
						) 
				); 
			}				
		}

	}

}
