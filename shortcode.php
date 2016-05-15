<?php


function custom_type_list_shortcode( $atts ) {

	extract(shortcode_atts(array(
		'type' => 'news',
		'pagenum' => 2
	), $atts));

	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 0;
								
	$args = array(
		'post_type' => $type,
		'showposts' => $pagenum,
		'offset'    => $offset,
		'paged'     => $paged
	);

	query_posts($args);

	while (have_posts()) : the_post();  ?>

		<p>									
			<a href="<?php echo the_permalink() ?>" target="_blank"><?php echo get_the_title(); ?></a>
			<span class="data"><?php the_time('Y-m-d G-H');?> </span>
		</p>	

	<?php endwhile;

	wp_pagenavi();
	wp_reset_postdata();


	//return 
	//return var_dump($categories_data);
}

add_shortcode('custom_type_list', 'custom_type_list_shortcode');

function custom_type_tax_list_shortcode( $atts ) {

	extract(shortcode_atts(array(
		'type' => 'news',
		'tax' => 'news_category',
		'category' => 'group',
		'pagenum' => 10
	), $atts));

	$category = ( get_query_var('category') ) ? get_query_var('category') : 'group';
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 0;
								
	$args = array(
		'post_type' => $type,
		'tax_query' => array(
            array(
                'taxonomy' => $tax,
                'field'    => 'slug',
                'terms'    => $category
                ),
            ),
		'showposts' => $pagenum,
		'offset'    => $offset,
		'paged'     => $paged
	);

	query_posts($args);

	while (have_posts()) : the_post();  ?>

		<p>									
			<a href="<?php echo the_permalink() ?>" target="_blank"><?php echo get_the_title(); ?></a>
			<span class="data"><?php the_time('Y-m-d G-H');?> </span>
		</p>	

	<?php endwhile;

	wp_pagenavi();
	wp_reset_postdata();


	//return 
	//return var_dump( $paged.'|'.$category );
}

add_shortcode('custom_type_tax_list', 'custom_type_tax_list_shortcode');

class Walker_Simple_Example extends Walker_Category {  

    function start_lvl(&$output, $depth=0, $args=array()) {  
        $output .= "\n<ul class=\"product_cats\">\n";  
    }  

    function end_lvl(&$output, $depth=0, $args=array()) {  
        $output .= "</ul>\n";  
    }  

    function start_el(&$output, $item, $depth=0, $args=array()) {  
		if ( get_query_var('category') == $item->slug ) {
		  $output .= "<dd class=\"hover\"><span><a class=\"\" href=\"/news/".esc_attr( $item->slug )."/page/1\">".esc_attr( $item->name );
		} else {
		  $output .= "<dd class=\"\"><span><a class=\"\" href=\"/news/".esc_attr( $item->slug )."/page/1\">".esc_attr( $item->name );
		}        
    }  

    function end_el(&$output, $item, $depth=0, $args=array()) {  
        $output .= "</a></span></dd>\n";  
    }  
} 

function custom_type_category_list_shortcode( $atts ) {

	extract(shortcode_atts(array(
		'taxonomy' => 'news_category'
	), $atts));

							
	$args = array(
		'taxonomy' => $taxonomy,
		'walker' => new Walker_Simple_Example,
		'title_li' => __( '' ),
		'orderby' => 'id',
		'depth' => 1
	);

	wp_list_categories($args);


	


	//return wp_list_categories($args);
	//return var_dump( $paged.'|'.$category );
}

add_shortcode('custom_type_category_list', 'custom_type_category_list_shortcode');

function custom_type_content_shortcode( $atts ) {

	extract(shortcode_atts(array(
		'type' => 'news',
		'taxonomy' => 'news_category'
	), $atts));

	$args = array(
        'post_type' => $type,
		'p' => get_the_ID()
    );
	
    $result = '';

	$template = '
	<div class="main-title">
		<h2>TITLE</h2>
		<div class="post-meta">
			 <span class="cat-links">分类： TYPE</span>
			 <span class="posted-on">时间： TIME</span>
		</div>
	</div> 	
	<div class="content">
		CONTENT
	</div>
	';

	$custom_type_content = new WP_Query($args);

	while ( $custom_type_content->have_posts()) : $custom_type_content->the_post();  

		$old_str = array (
			'TITLE', 'TYPE', 'TIME', 'CONTENT'
		);
		$new_str = array (
			get_the_title(), $type, get_the_time("Y年m月d日"), get_the_content()
		);
		$result = $result.str_replace($old_str, $new_str, $template);

	endwhile;

	wp_reset_postdata();


	return $result;
	//return var_dump( $args );
	//return var_dump( $custom_type_content );
}

add_shortcode('custom_type_content', 'custom_type_content_shortcode');

function custom_type_related_articles_shortcode( $atts ) {

	extract(shortcode_atts(array(
		'type' => 'news'
	), $atts));

	$args = array(
        'post_type' => $type,
		'post__not_in' => array(get_the_ID()), 
		'showposts' => 4
    );
	
    $result = '';    

	$template = '
	<li>
		<a href="URL" target="_blank">TITLE</a>
	</li>
	';


	$categories_data = new WP_Query($args);

	while ( $categories_data->have_posts() ) :

		$categories_data->the_post();
		$custom_data = get_post_custom(get_the_id());

		$old_str = array (
			'URL', 'TITLE'
		);
		$new_str = array (
			get_permalink( get_the_id() ), get_the_title()
		);
		$result = $result.str_replace($old_str, $new_str, $template);		

	endwhile;


	wp_reset_postdata();

	return $result;
	//return var_dump($categories_data);
}

add_shortcode('custom_type_related_articles', 'custom_type_related_articles_shortcode');

function news_index_list_shortcode() {

	$args = array(
        'post_type' => 'news',
		'showposts' => 3
    );
	
    $result = '';    

	$template = '
	<dd>
		<a href="URL" title="TITLE">TITLE</a>
		<span class="date">[DATE]</span>
	</dd>
	';


	$categories_data = new WP_Query($args);

	while ( $categories_data->have_posts() ) :

		$categories_data->the_post();
		$custom_data = get_post_custom(get_the_id());

		$old_str = array (
			'URL', 'TITLE', 'DATE' 
		);
		$new_str = array (
			get_permalink( get_the_id() ), get_the_title(), get_the_time('Y-m-d')
		);
		$result = $result.str_replace($old_str, $new_str, $template);		

	endwhile;


	wp_reset_postdata();

	return $result;
}

add_shortcode('news_index_list', 'news_index_list_shortcode');

function news_index_headlines_shortcode() {

	$args = array(
        'post_type' => 'news',
		'showposts' => 1
    );
	
    $result = '';    

	$template = '
	<h2 class="text-color-blue">
		<a href="URL" title="TITLE">TITLE</a>
	</h2>
	<div class="introduction">
		EXCERPT
		<a title="TITLE" href="URL">[详细内容]</a>
	</div>
	';


	$categories_data = new WP_Query($args);

	while ( $categories_data->have_posts() ) :

		$categories_data->the_post();
		$custom_data = get_post_custom(get_the_id());

		$old_str = array (
			'URL', 'TITLE', 'DATE', 'EXCERPT'
		);
		$new_str = array (
			get_permalink( get_the_id() ), get_the_title(), get_the_time('Y-m-d'), get_the_excerpt()
		);
		$result = $result.str_replace($old_str, $new_str, $template);		

	endwhile;


	wp_reset_postdata();

	return $result;
}

add_shortcode('news_index_headlines', 'news_index_headlines_shortcode');

function culture_index_shortcode() {

	$args = array(
        'post_type' => 'culture',
		'showposts' => 1
    );
	
    $result = '';    

	$template = '
	<div class="grids-g">
		<div class="grids-u-6-24">
			<div class="img">
				<a href="URL" title="TITLE">									
					<img src="IMAGES">				
				</a>
			</div>
		</div>
		<div class="grids-u-18-24">
			<div class="text">
				<a href="URL" title="TITLE">TITLE</a>
			</div>
		</div>
	</div>
	';


	$categories_data = new WP_Query($args);

	while ( $categories_data->have_posts() ) :

		$categories_data->the_post();
		$custom_data = get_post_custom(get_the_id());

		$old_str = array (
			'URL', 'TITLE', 'DATE', 'IMAGES'
		);
		$new_str = array (
			get_permalink( get_the_id() ), get_the_title(), get_the_time('Y-m-d'), $custom_data['index_culture_images_value'][0]
		);
		$result = $result.str_replace($old_str, $new_str, $template);		

	endwhile;


	wp_reset_postdata();

	return $result;
}

add_shortcode('culture_index', 'culture_index_shortcode');
