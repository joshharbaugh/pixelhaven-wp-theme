<?php
//Custom Post Types

add_action( 'init', 'theme_create_post_types');
function theme_create_post_types(){
	$labels=array(
		'name' => __( 'Portfolio' ),
		'singular_name' => __( 'Portfolio' )
	);

	$args=array(
		'labels' => $labels,
		'label' => __('Portfolio'),
		'singular_label' => __('Portfolio'),
		'public' => true,
		'show_ui' => true,
		'_builtin' => false,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => false,
		'supports' => array('title','editor','excerpt','revisions','thumbnail'),
		'taxonomies' => array('portfolio_cat', 'post_tag'),
		'menu_icon' => get_bloginfo('template_directory').'/functions/img/icon.png'
	);

	if(function_exists('register_post_type')):
		register_post_type('portfolio', $args);
	endif;
}



//Custom Post Type columns
add_filter("manage_edit-portfolio_columns", "theme_portfolio_columns");
add_action("manage_posts_custom_column",  "theme_portfolio_custom_columns");
function theme_portfolio_columns($columns){
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => _x("Portfolio Title", "portfolio title column", 'theme'),
			"author" => _x("Author", "portfolio author column", 'theme'),
			"portfolio_cats" => _x("Portfolio Categories", "portfolio categories column", 'theme'),
			"date" => _x("Date", "portfolio date column", 'theme')
		);

		return $columns;
}

function theme_portfolio_custom_columns($column){
		global $post;
		switch ($column)
		{
			case "author":
				the_author();
				break;
			case "portfolio_cats":
				echo get_the_term_list( $post->ID, 'portfolio_cat', '', ', ', '' );
				break;
		}
}





//Nav Menus
if(function_exists('register_nav_menu')):
	register_nav_menu( 'main_menu', __( 'Main Menu', 'theme' ));
endif;




//Custom taxonomies
add_action('init', 'theme_taxonomies', 0);

function theme_taxonomies(){

	$labels = array(
		'name' => _x( 'Portfolio Categories', 'taxonomy general name', 'theme' ),
		'singular_name' => _x( 'Portfolio Category', 'taxonomy singular name', 'theme' ),
		'search_items' =>  __( 'Search Portfolio', 'theme' ),
		'all_items' => __( 'All Portfolio Categories', 'theme' ),
		'parent_item' => __( 'Parent Portfolio Category', 'theme' ),
		'parent_item_colon' => __( 'Parent Portfolio Category:', 'theme' ),
		'edit_item' => __( 'Edit Portfolio Category', 'theme' ),
		'update_item' => __( 'Update Portfolio Category', 'theme' ),
		'add_new_item' => __( 'Add New Portfolio Category', 'theme' ),
		'new_item_name' => __( 'New Portfolio Category Name', 'theme' )
	);

	register_taxonomy('portfolio_cat',array('portfolio'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio_categories' )

	));


}
