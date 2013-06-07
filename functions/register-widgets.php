<?php

          if(function_exists('register_sidebar')){
                    register_sidebar(array(
			'name' => __( 'Primary Widget Area', 'latest' ),
			'id' => 'primary-widget-area',
			'description' => __( 'The primary widget area', 'latest' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>' )
		);
		register_sidebar(array(
			'name' => __( 'First Footer Widget Area', 'latest' ),
			'id' => 'first-footer-widget-area',
			'description' => __( 'The first footer widget area', 'latest' ),
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>' )
		);
		register_sidebar(array(
			'name' => __( 'Portfolio Widget Area', 'latest' ),
			'id' => 'portfolio-widget-area',
			'description' => __( 'The portfolio widget area', 'latest' ),
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '',
			'after_title' => '' )
		);
	}
?>
