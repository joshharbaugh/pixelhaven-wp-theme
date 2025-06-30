<?php
class Theme_Latest_Portfolio extends WP_Widget {

	function Theme_Latest_Portfolio(){
		$widget_ops = array( 'classname' => 'latest_portfolio', 'description' => 'Show the latest portfolio piece, with an image and excerpt.' );
		$this->WP_Widget( 'theme_portfolio', 'Theme Latest Portfolio', $widget_ops );
	}
	
	
	function widget($args, $instance) { 
		extract($args);
						
		$title = apply_filters('widget_title', $instance['title']);		
		if ( empty($title) ) $title = false;
		
		
		echo $before_widget;
		if($title):
			echo $before_title;
			echo $title;
			echo $after_title;	
		endif;
		
		
		$args = array(
				'post_type' => 'portfolio',
				'posts_per_page' => '6'
				);
		
		$portfolio_posts_query = new WP_Query($args);
		
		if($portfolio_posts_query->have_posts()): while($portfolio_posts_query->have_posts()): $portfolio_posts_query->the_post();
                              global $post;
			$terms = get_the_terms( $post->ID, 'portfolio_cat' );

			if ( $terms && ! is_wp_error( $terms ) ) :

				$terms_links = array();

				foreach ( $terms as $term ) {
					$terms_links[] = $term->name;
				}

				$taxonomy = join( " ", $terms_links );
                              endif;
		?>
			<li class="thumbnail <?php echo strtolower($taxonomy); ?>" style="min-width: 199px; width: 100%;" data-categories="<?php echo strtolower($taxonomy); ?>">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<img src="<?php echo portfolio_thumbnail(); ?>" alt="<?php the_title(); ?>" />
				</a>
			</li>
<?php		endwhile; endif;
	
		
		
		echo $after_widget;
			
	}
	
	
	
	
	

	function form($instance) {	
	
	
	
        $title= esc_attr($instance['title']);		
		
?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
               Title:
            </label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		
		<p>
			<code><em>This widget shows your latest portfolio post.</em></code>
		</p>
		

<?php
	}

	
	
	function update($new_instance, $old_instance) {
        $instance=$old_instance;		
		
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;

    }
	
}
?>
